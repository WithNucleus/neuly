<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OauthClientsRequest;
use App\Models\OauthClient;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OauthClientsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OauthClientsCrudController extends CrudController
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
        if (!backpack_user()->can('edit users')) {
            abort(404);
        }

        CRUD::setModel(OauthClient::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/oauth-clients');
        CRUD::setEntityNameStrings('oauth clients', 'oauth clients');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('redirect');
        CRUD::addColumn([
            'name' => 'secret',
            'label' => 'Secret Key',
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'revoked',
            'label' => 'Revoked?',
            'type' => 'boolean',
            'options' => [
                0 => 'No',
                1 => 'Yes',
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
        CRUD::setValidation(OauthClientsRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Client name',
                'type' => 'text',
                'required' => true,
            ],
            [
                'name' => 'redirect',
                'label' => 'Redirect URL',
                'type' => 'text',
                'required' => true,
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'textarea',
            ],
            [
                'name' => 'logo',
                'label' => 'Logo',
                'type' => 'image',
            ],
            [
                'name' => 'revoked',
                'label' => 'Revoked',
                'type' => 'boolean',
                'default' => 0,
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
