<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ListingRequestRequest;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\ListingRequest;
use App\Models\Person;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ListingRequestCrudController
 * @package App\Http\Controllers\Admin
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
        if(!backpack_user()->can('manage listing requests')) {
            abort(403);
        }

        CRUD::setModel(ListingRequest::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/listingrequest');
        CRUD::setEntityNameStrings('listing request', 'listing requests');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addClause('where', 'status', '=', 'open');
        CRUD::addColumn(['name' => 'status', 'label' => 'Status', 'type' => 'string']);
        CRUD::addColumn(['name' => 'type', 'label' => 'Type', 'type' => 'string']);
        CRUD::addColumn(['name' => 'is_update', 'label' => 'Update?', 'type' => 'boolean']);
        CRUD::addColumn(['name' => 'entity_name', 'label' => 'Entity',  'type' => 'string']);
        CRUD::addColumn(['name' => 'name', 'label' => 'Submitted by', 'type' => 'string']);
        CRUD::addColumn(['name' => 'created_at', 'label' => 'Request created', 'type' => 'date']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @retur void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ListingRequestRequest::class);
    }

    protected function setupShowOperation()
    {
        $requestId = Route::current()->parameter('id');
        $listingRequest = ListingRequest::find($requestId);

        $entity = $this->getEntityModel($listingRequest);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.show_original_entity',
            'entity' => $entity,
            'isUpdate' => $listingRequest->is_update,
            'entityType' => $listingRequest->type,
        ])->to('after_content');

        if ($entity != null OR $listingRequest->is_update == false) {
            $this->crud->addButtonFromModelFunction('line', 'accept', 'generateAcceptButton', 'beginning');
            $this->crud->addButtonFromModelFunction('line', 'decline', 'generateDeclineButton', 'beginning');
        } else {
            $this->crud->removeButton('delete');
        }
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupPublishRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{id}/publish', [
            'as'        => $routeName.'.getPublish',
            'uses'      => $controller.'@getPublishForm',
            'operation' => 'publish',
        ]);
        Route::post($segment.'/{id}/publish', [
            'as'        => $routeName.'.postPublish',
            'uses'      => $controller.'@postPublishForm',
            'operation' => 'publish',
        ]);
    }

    protected function setupDeclineRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{id}/decline', [
            'as'        => $routeName.'.getDecline',
            'uses'      => $controller.'@getDeclineForm',
            'operation' => 'decline',
        ]);
        Route::post($segment.'/{id}/decline', [
            'as'        => $routeName.'.postdecline',
            'uses'      => $controller.'@postDeclineForm',
            'operation' => 'decline',
        ]);
    }

    public function getDeclineForm($id)
    {
        $this->crud->setOperation('Decline');

        $this->data['id'] = $id;
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'Decline Listing Request';

        return view('vendor.backpack.crud.listing_requests.decline', $this->data);
    }

    public function postDeclineForm($id)
    {
        $this->crud->setOperation('Decline');

        $this->data['crud'] = $this->crud;

        $listingRequest = ListingRequest::find($id);
        $listingRequest->status = 'declined';
        $listingRequest->save();

        return view('vendor.backpack.crud.listing_requests.declined', $this->data);

    }

    public function getPublishForm($id)
    {
        $this->crud->setOperation('Publish');

        $listingRequest = ListingRequest::findOrFail($id);
        $changes = json_decode($listingRequest->entity_data);
        $entity = null;

        if($listingRequest->is_update)
        {
            $entity = $this->getEntityModel($listingRequest);
        }

        $focusCategories = Focus::orderBy('name')->get();
        $focusIdsSelected = isset($changes->focus_ids) ? $changes->focus_ids : [];

        $this->data['id'] = $listingRequest->id;
        $this->data['type'] = $listingRequest->type;
        $this->data['update'] = ((bool) $listingRequest->is_update) ? 'yes' : 'no';
        $this->data['changes'] = $changes;
        $this->data['original'] = $entity;
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'Publish Listing Request';
        $this->data['focusCategories'] = $focusCategories;
        $this->data['focusIdsSelected'] = $focusIdsSelected;
        $this->data['declineButton'] = $listingRequest->generateDeclineButton();

        return view('vendor.backpack.crud.listing_requests.publish', $this->data);

    }

    public function postPublishForm(Request $request, $id)
    {
        $this->crud->setOperation('Publish');

        $data = $request->all();

        $listingRequest = ListingRequest::find($id);

        $entity = null;

        if($listingRequest->is_update)
        {
            $entity = $this->getEntityModel($listingRequest);
        }

        $entityData = $this->createDummyEntityData($data['type'], $data);

        $object = $this->saveDummyEntityData($data['type'], $entityData, $entity);

        $this->data['crud'] = $this->crud;
        $this->data['object'] = $object;


        $listingRequest = ListingRequest::find($id);
        $listingRequest->status = 'accepted';
        $listingRequest->save();

        return view('vendor.backpack.crud.listing_requests.finish', $this->data);
    }

    private function saveDummyEntityData($type, $data = [], $entity = null)
    {
        $object = $this->{'saveDummy'.$type}($data, $entity);

        if($entity === null)
        {
            $object->save();
        }
        else
        {
            $object->update();
        }

        if (!empty($data['focus_ids']) && method_exists($object, 'focus')) {
            $object->focus()->sync($data['focus_ids']);
        }

        return $object;
    }

    private function saveDummyOrganization($data, $entity = null) {
        $organisation = $entity;

        if($organisation === null)
        {
            $organisation = new Company();
        }

        $organisation->name = $data['name'];
        $organisation->slug = $data['slug'];
        $organisation->ownership = $data['ownership'];
        $organisation->website = $data['website'];
        $organisation->summary = $data['summary'];
        $organisation->founded_date = $data['founded_date'];
        $organisation->valuation = $data['valuation'];
        $organisation->number_employees = $data['number_employees'];
        $organisation->total_funding_amount = $data['total_funding_amount'];
        $organisation->last_funding_date = $data['last_funding_date'];
        $organisation->ticker_symbol = $data['ticker_symbol'];

        if($data['logo'] !== null)
        {
            $organisation->logo = $data['logo'];
        }

        return $organisation;
    }

    private function saveDummyEvent($data, $entity = null) {
        $event = $entity;

        if($event === null)
        {
            $event = new Event();
        }

        $event->name = $data['name'];
        $event->slug = $data['slug'];
        $event->start_date = $data['start'];
        $event->end_date = $data['end'];
        $event->event_url = $data['website'];
        $event->registration_url = $data['registration'];
        $event->description = $data['description'];

        return $event;
    }

    private function saveDummyInvestor($data, $entity = null) {
        $investor = $entity;

        if($investor === null)
        {
            $investor = new Investor();
        }

        $investor->name = $data['name'];
        $investor->slug = $data['slug'];;
        $investor->website = $data['website'];
        $investor->type = $data['type'];

        return $investor;
    }

    private function saveDummyPerson($data, $entity = null) {
        $person = $entity;

        if($person === null)
        {
            $person = new Person();
        }

        $person->name = $data['name'];
        $person->slug = $data['slug'];
        $person->email = $data['email'];
        $person->website = $data['website'];
        if($data['photo'] !== null)
        {
            $person->photo = $data['photo'];
        }
        $person->linkedin = $data['linkedin'];
        $person->facebook = $data['facebook'];
        $person->twitter = $data['twitter'];
        $person->bio = $data['bio'];
        $person->secondary_email = $data['secondary_email'];

        return $person;
    }

    private function createDummyEntityData($type, $data)
    {
        return $this->{'createDummy'.$type}($data);
    }

    private function createDummyOrganization($data)
    {
        $logo = '';

        switch($data['entity_what_logo'])
        {
            case 'shown':
                $logo = $this->moveFile('logos', $data['entity_logo']);
                break;
            case 'new':
                $logo = $this->handleFileUpload('logos', $data['entity_new_logo']);
                break;
            case 'none':
                $logo = '';
                break;
            case 'original':
                $logo = null;
                break;
        }

        $resourceData = [
            'name' => $data['entity_name'],
            'slug' => $data['entity_slug'],
            'ownership' => $data['entity_ownership'],
            'website' => $data['entity_website'],
            'summary' => $data['entity_summary'],
            'founded_date' => $data['entity_founded_date'],
            'valuation' => $data['entity_valuation'],
            'number_employees' => $data['entity_number_employees'],
            'total_funding_amount' => $data['entity_total_funding_amount'],
            'last_funding_date' => $data['entity_last_funding_date'],
            'ticker_symbol' => $data['entity_ticker'],
            'focus_ids' => $data['entity_focus'],
            'logo' => $logo
        ];

        return $resourceData;
    }

    private function createDummyEvent($data)
    {
        $resourceData = [
            'name' => $data['entity_name'],
            'slug' => $data['entity_slug'],
            'website' => $data['entity_website'],
            'registration' => $data['entity_registration'],
            'start' => $data['entity_start'],
            'end' => $data['entity_end'],
            'description' => $data['entity_description'],
            'focus_ids' => $data['entity_focus'],
        ];

        return $resourceData;
    }

    private function createDummyInvestor($data)
    {
        $resourceData = [
            'name' => $data['entity_name'],
            'slug' => $data['entity_slug'],
            'website' => $data['entity_website'],
            'type' => $data['entity_type']
        ];

        return $resourceData;
    }

    private function createDummyPerson($data)
    {
        $photo = '';

        switch($data['entity_what_photo'])
        {
            case 'shown':
                $photo = $this->moveFile('people', $data['entity_photo']);
                break;
            case 'new':
                $photo = $this->handleFileUpload('people', $data['entity_new_photo']);
                break;
            case 'none':
                $photo = '';
                break;
            case 'original':
                $photo = null;
                break;
        }

        $secondary_email = '';

        if(array_key_exists('entity_secondary_email', $data))
        {
            $secondary_email = $data['entity_secondary_email'];
        }

        $resourceData = [
            'name' => $data['entity_name'],
            'slug' => $data['entity_slug'],
            'email' => $data['entity_email'],
            'website' => $data['entity_website'],
            'linkedin' => $data['entity_linkedin'],
            'facebook' => $data['entity_facebook'],
            'twitter' => $data['entity_twitter'],
            'bio' => $data['entity_bio'],
            'secondary_email' => $secondary_email,
            'photo' => $photo,
        ];

        return $resourceData;
    }

    private function getEntityModel($request)
    {
        return $this->{'get'.$request->type.'Model'}($request->to_update_id);
    }

    private function getOrganizationModel($id)
    {
        return Company::with('focus')->find($id);
    }

    private function getPersonModel($id)
    {
        return Person::find($id);
    }

    private function getEventModel($id)
    {
        return Event::with('focus')->find($id);
    }

    private function getInvestorModel($id)
    {
        return Investor::find($id);
    }

    private function handleFileUpload($path, $file)
    {
        return Storage::disk('public')->putFileAs($path, $file, $file->getClientOriginalName());
    }

    private function moveFile($path, $file)
    {
        $newFile = $this->generateFilePath($path, $file);
        Storage::disk('public')->move($file, $newFile);

        return $newFile;
    }

    private function generateFilePath($path, $file)
    {
        $fileName = preg_split('/\//', $file)[1];
        return $path . '/' .$fileName;
    }

    private function deleteTemporaryFile($path)
    {
        Storage::delete($path);
    }
}
