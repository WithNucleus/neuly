<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ApiUserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

/**
 * Class ApiUserCrudController.
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ApiUserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ApiUser::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/api-user');
        CRUD::setEntityNameStrings('API User', 'API Users');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'email',
            ],
            [
                'name' => 'access_token',
                'label' => 'Access Token',
                'type' => 'text',
                'limit' => 80,
            ],
            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'boolean',
                'options' => [
                    0 => 'Inactive',
                    1 => 'Active',
                ],
            ],
            [
                'name' => 'created_at',
                'label' => 'Created at',
                'type' => 'datetime',
            ],
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ApiUserRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'email',
            ],
            [
                'name' => 'access_token',
                'label' => 'Access Token',
                'type' => 'token_generator',
                'default' => Str::random(60),
                'attributes' => [
                    'readonly' => 'readonly',
                ],
            ],
            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'radio',
                'default' => 1,
                'options' => [
                    0 => 'Inactive',
                    1 => 'Active',
                ],
            ],
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
}
