<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PersonClaimRequest;
use App\Models\RaisedClaim;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClaimPersonCrudControllerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClaimPersonCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if(!backpack_user()->can('edit person claims')) {
            abort(404);
        }
        CRUD::setModel(RaisedClaim::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/person-claim');
        CRUD::setEntityNameStrings('person claim', 'person claims');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'person_id', 'label' => 'Person', 'type' => 'select', 'entity' => 'person', 'attribute' => 'name']);
        CRUD::addColumn(['name' => 'user_id', 'label' => 'User Firstname', 'type' => 'model_function', 'function_name' => 'getUserName']);
        CRUD::addColumn(['name' => 'verification_token', 'label' => 'Verification Token', 'type' => 'string']);
        CRUD::addColumn(['name' => 'created_at', 'label' => 'Request created', 'type' => 'date']);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PersonClaimRequest::class);

        $users = User::all();
        $userSelectArray = [];

        foreach($users as $user)
        {
            $userSelectArray[$user->id] = $user->name . ' ' . $user->last_name;
        }

        $this->crud->addField([
            'label'     => "Person",
            'type'      => 'select2',
            'name'      => 'person_id',
            'entity'    => 'person',
            'attribute' => 'name',
            'pivot'     => false,
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'     => "App\Models\Person", // foreign key model
        ]);

        $this->crud->addField([
            'label'         => "User",
            'type'          => 'select2_from_array',
            'name'          => 'user_id',
            'allows_null'   => false,
            'options'       => $userSelectArray,
        ]);

        $this->crud->addField([
            'name' => 'verification_token',
            'type' => 'hidden',
            'value' =>
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
}
