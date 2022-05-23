<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OauthAccessTokenCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OauthAccessTokenCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
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

        CRUD::setModel(\App\Models\OauthAccessToken::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/oauth-access-token');
        CRUD::setEntityNameStrings('oauth access token', 'oauth access tokens');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'user',
            'type' => 'relationship',
            'label' => 'User email',
            'attribute' => 'email',
        ]);
        CRUD::column('client');
        CRUD::column('scopes');
        CRUD::column('revoked');
        CRUD::column('created_at');
        CRUD::column('expires_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }
}
