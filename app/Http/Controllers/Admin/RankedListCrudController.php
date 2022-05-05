<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\EntityHelper;
use App\Http\Requests\RankedListRequest;
use App\Models\RankedList;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Http\Request;

/**
 * Class RankableListCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RankedListCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if (! backpack_user()->can('manage ranked lists')) {
            abort(404);
        }

        $this->crud->setModel(RankedList::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/rankedList');
        $this->crud->setEntityNameStrings('ranked list', 'ranked lists');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'type'      => 'string',
            'name'      => 'name',
        ]);

        $this->crud->addColumn([
            'type'      => 'relationship_count',
            'name'      => 'entities',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'type'      => 'string',
            'name'      => 'name',
        ]);

        $this->crud->addColumn([
            'type'      => 'string',
            'name'      => 'description',
        ]);

        $entityTypes = array_keys(EntityHelper::getEntities());
        $rankedList = $this->crud->getCurrentEntry();
        $entities = $rankedList->entities()->orderBy('rank')->get();

        Widget::add([
            'type' => 'view',
            'view' => 'admin.widgets.rankedListEntities',
            'entityTypes' => $entityTypes,
            'rankedList' => $rankedList,
            'entities' => $entities
        ])->to('after_content');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RankedListRequest::class);

        CRUD::addField([
            'type'      => 'text',
            'name'      => 'name',
        ]);

        CRUD::addField([
            'type'      => 'textarea',
            'name'      => 'description',
        ]);
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

    public function addEntity(Request $request, $id)
    {
        $rankedList = RankedList::findOrFail($id);
        $id = $request->input('id');
        $alias = $request->input('type');
        $classname = EntityHelper::getClassByAlias($alias);

        $success = $rankedList->attachEntity($id, $classname);

        return response()->json([
                'success' => $success,
                'id' => $id,
                'classname' => $classname,
                'alias' => $alias,
            ]);
    }

    public function updateEntities(Request $request, $id)
    {
        $rankedList = RankedList::findOrFail($id);
        $entities = $request->input('entities', []);

        $rankedList->updateEntities($entities);
    }

    public function removeEntity(Request $request, $id)
    {
        $rankedList = RankedList::findOrFail($id);

        $rankableId = $request->input('rankable_id');
        $rankableType = $request->input('rankable_type');

        $rankedList->detachEntity($rankableId, $rankableType);
    }
}
