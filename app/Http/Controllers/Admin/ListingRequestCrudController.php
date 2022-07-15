<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Entity\FieldsMapping;
use App\Helpers\EntityHelper;
use App\Helpers\ListingRequestHelper;
use App\Models\Company;
use App\Models\ListingRequest;
use App\Models\Person;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * Class ListingRequestCrudController.
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ListingRequestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if (! backpack_user()->can('manage listing requests')) {
            abort(403);
        }

        $this->crud->setModel(ListingRequest::class);
        $this->crud->setRoute(config('backpack.base.route_prefix').'/listingrequest');
        $this->crud->setEntityNameStrings('listing request', 'listing requests');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addClause('where', 'status', '=', 'open');
        $this->crud->addColumn(['name' => 'status', 'label' => 'Status', 'type' => 'string']);
        $this->crud->addColumn(['name' => 'entity_type', 'label' => 'Type', 'type' => 'string']);
        $this->crud->addColumn([
            'name' => 'to_update_id',
            'label' => 'Update?',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->to_update_id ? 'Yes' : 'No';
            }, ]);
        $this->crud->addColumn(['name' => 'entity_name', 'label' => 'Entity', 'type' => 'string']);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Submitted by',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->name . ( $entry->user_id === null ? ' (Guest)' : ' (Registered)' );
            }, ]);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Request created', 'type' => 'date']);
    }

    protected function setupShowOperation()
    {
        $this->crud->setFromDb();
        $this->crud->modifyColumn('user_id', [
            'name' => 'user_id',
            'label' => 'Registered user?',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->user_id ? 'Yes' : ' No';
            }, ]);
        $this->crud->modifyColumn('to_update_id', [
            'name' => 'to_update_id',
            'label' => 'Update?',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->to_update_id ? 'Yes' : 'No';
            }, ]);
        $this->crud->removeColumn('status');

        $listingRequest = $this->crud->getCurrentEntry();
        $entityClass = ListingRequestHelper::getEntityClassByType($listingRequest->entity_type);
        $mapping = $entityClass::getListingRequestMapping();
        $originalEntity = null;

        if ($listingRequest->to_update_id) {
            $originalEntity = $entityClass::findOrFail($listingRequest->to_update_id);
        }

        $this->crud->addButtonFromModelFunction('line', 'accept', 'generateAcceptButton', 'beginning');
        $this->crud->addButtonFromModelFunction('line', 'decline', 'generateDeclineButton', 'beginning');

        Widget::add([
            'type'           => 'view',
            'view'           => 'admin.listing_requests.widget.show_original_entity',
            'originalEntity' => $originalEntity,
            'mapping'        => $mapping,
        ])->to('after_content');
    }

    public function getDeclineForm($id)
    {
        $this->crud->setOperation('Decline');

        $this->data['id'] = $id;
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'Decline Listing Request';

        return view('admin.listing_requests.decline', $this->data);
    }

    public function postDeclineForm($id)
    {
        $this->crud->setOperation('Decline');

        $listingRequest = ListingRequest::findOrFail($id);
        $listingRequest->update(['status' => ListingRequest::STATUS_DECLINED]);

        $this->data['crud'] = $this->crud;
        $this->data['message'] = 'Listing Request has been declined successfully.';

        return view('admin.listing_requests.finish', $this->data);
    }

    public function getAcceptForm($id)
    {
        $this->crud->setOperation('Accept');

        $listingRequest = ListingRequest::findOrFail($id);
        $entityClass = ListingRequestHelper::getEntityClassByType($listingRequest->entity_type);
        $relationValues = ListingRequestHelper::getEntityRelationValuesByType($listingRequest->entity_type);
        $mapping = $entityClass::getListingRequestMapping();
        $originalEntity = null;

        if ($listingRequest->to_update_id) {
            $originalEntity = $entityClass::findOrFail($listingRequest->to_update_id);
        }

        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'Accept Listing Request';
        $this->data['id'] = $listingRequest->id;
        $this->data['type'] = $listingRequest->entity_type;
        $this->data['declineButton'] = $listingRequest->generateDeclineButton();
        $this->data['requestData'] = $listingRequest->entity_data;
        $this->data['relationValues'] = $relationValues;
        $this->data['mapping'] = $mapping;
        $this->data['originalEntity'] = $originalEntity;

        return view('admin.listing_requests.accept', $this->data);
    }

    public function postAcceptForm(Request $request, $id)
    {
        $this->crud->setOperation('Accept');

        $listingRequest = ListingRequest::findOrFail($id);
        $entityClass = ListingRequestHelper::getEntityClassByType($listingRequest->entity_type);
        $rules = ListingRequestHelper::getRulesByEntityClass($entityClass, $listingRequest->to_update_id);

        Validator::make($request->all(), $rules)->validate();

        $this->applyListingRequestData($request, $entityClass, $listingRequest->to_update_id);

        $this->data['crud'] = $this->crud;
        $this->data['message'] = 'Listing Request has been accepted successfully.';

        $listingRequest->update(['status' => ListingRequest::STATUS_ACCEPTED]);

        return view('admin.listing_requests.finish', $this->data);
    }

    private function applyListingRequestData(Request $request, $entityClass, $toUpdateId = null)
    {
        if ($toUpdateId) {
            $entity = $entityClass::findOrFail($toUpdateId);
            $sourceFlags = $request->input('source');
        } else {
            $entity = new $entityClass;
            $sourceFlags = [];
        }

        $mapping = $entityClass::getListingRequestMapping();
        $relationsData = [];

        foreach ($mapping as $field => $options) {
            //if sourceFlag set to 'original' - skip this field
            if ($sourceFlags !== [] && $sourceFlags[$field] === ListingRequestHelper::SOURCE_ORIGINAL) {
                continue;
            }

            $inputData = $request->input($field);

            switch ($options['type']) {
                case FieldsMapping::TYPE_DATE:
                    $entity->{$field} = Carbon::parse($inputData)->format('Y-m-d');
                    break;
                case FieldsMapping::TYPE_IMAGE:
                    $this->handleImageUpload($request, $entity, $field);
                    break;
                case FieldsMapping::TYPE_RELATION:
                    $relationsData[$field] = $inputData;
                    break;
                default:
                    $entity->{$field} = $inputData;
                    break;
            }
        }

        if ($request->has('slug')) {
            $entity->slug = $request->input('slug');
        }

        $entitiesWithVisibility = [
            Company::class,
            Person::class,
        ];

        if (in_array($entityClass, $entitiesWithVisibility)) {
            $entity->visibility = 'public';
            $entity->visibility_code = NULL;
        }

        $this->handleOneToOneRelationData($entity, $mapping, $relationsData);
        $entity->save();

        $this->handleManyToManyRelationData($entity, $mapping, $relationsData);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param object $entity
     * @param string $field
     */
    private function handleImageUpload(Request $request, $entity, $fieldName)
    {
        $filePath = $request->input($fieldName);
        $imageAction = $request->input('image_action');
        $imageImportSettings = $entity::getImageImportSettings();
        $destinationFolderPath = $imageImportSettings['folder'].DIRECTORY_SEPARATOR;
        $diskName = 'public';

        switch ($imageAction) {
            case 'shown':
                $fileName = $this->getFilenameFromPath($filePath);
                $destinationFilePath = $destinationFolderPath.$fileName;

                if (Storage::disk($diskName)->exists($filePath) === false) {
                    $entity->{$fieldName} = null;
                    break;
                }

                if (Storage::disk($diskName)->exists($destinationFilePath) === true) {
                    Storage::disk($diskName)->delete($destinationFilePath);
                }

                Storage::disk($diskName)->move($filePath, $destinationFilePath);
                $entity->{$fieldName} = $fileName;
                break;

            case 'uploaded':
                $uploadedImage = $request->file('entity_image_uploaded');

                if (! $uploadedImage) {
                    $entity->{$fieldName} = null;
                    break;
                }

                $fileName = $uploadedImage->getClientOriginalName();
                Storage::disk($diskName)->putFileAs($destinationFolderPath, $uploadedImage, $fileName);
                $entity->{$fieldName} = $fileName;
                break;

            case 'none':
            default:
                $entity->{$fieldName} = null;
                break;
        }

        //clean request's image
        if ($filePath !== null && Storage::disk($diskName)->exists($filePath)) {
            Storage::disk($diskName)->delete($filePath);
        }
    }

    /**
     * @param string $filepath
     * @return string
     */
    private function getFilenameFromPath($filepath)
    {
        $filepathParts = explode('/', $filepath);

        return array_pop($filepathParts);
    }

    /**
     * @param object $entity
     * @param array $mapping
     * @param array $relationsData
     */
    private function handleOneToOneRelationData($entity, $mapping, $relationsData)
    {
        foreach ($relationsData as $key => $data) {
            $options = $mapping[$key];

            switch ($options['relation']) {
                case FieldsMapping::RELATION_ONE_ONE:
                    $entity->{$key} = $data;
                    break;

                case FieldsMapping::RELATION_ONE_ONE_MORPHABLE:
                    $entity->{$options['morphableFieldId']} = $data['id'];
                    $entity->{$options['morphableFieldType']} = EntityHelper::getClassByAlias($data['type']);
                    break;
            }
        }
    }

    private function handleManyToManyRelationData($entity, $mapping, $relationsData)
    {
        $entityUpdated = false;

        foreach ($relationsData as $key => $data) {
            $options = $mapping[$key];

            switch ($options['relation']) {
                case FieldsMapping::RELATION_N_N:
                case FieldsMapping::RELATION_N_N_MORPHABLE:
                    $entity->{$key}()->sync($data);
                    $entityUpdated = true;
                    break;
            }
        }

        if ($entityUpdated) {
            $entity->touch();
        }
    }
}
