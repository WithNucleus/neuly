<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ClaimPersonHelper;
use App\Http\Requests\PersonClaimRequest;
use App\Models\Person;
use App\Models\RaisedClaim;
use App\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClaimPersonCrudControllerCrudController
 *
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
        if (! backpack_user()->can('edit person claims')) {
            abort(404);
        }
        CRUD::setModel(RaisedClaim::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/person-claim');
        CRUD::setEntityNameStrings('person claim', 'person claims');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'person_id', 'label' => 'Person', 'type' => 'select', 'entity' => 'person', 'attribute' => 'name']);
        CRUD::addColumn(['name' => 'user_id', 'label' => 'User', 'type' => 'select', 'entity' => 'user', 'attribute' => 'fullname']);
        CRUD::addColumn(['name' => 'verification_token', 'label' => 'Verification Token', 'type' => 'string']);
        CRUD::addColumn(['name' => 'comment', 'label' => 'Comment', 'type' => 'text']);
        CRUD::addColumn(['name' => 'created_at', 'label' => 'Request created', 'type' => 'date']);
        CRUD::addButtonFromModelFunction('line', 'approve_claim', 'getApproveButton', 'beginning');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     *
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PersonClaimRequest::class);

        $this->crud->addField([
            'label' => 'Person',
            'type' => 'select2',
            'name' => 'person_id',
            'entity' => 'person',
            'attribute' => 'name',
            'pivot' => false,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'label' => 'Person',
            'type' => 'select2',
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => 'fullname',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'name' => 'verification_token',
            'type' => 'hidden',
            'value' => RaisedClaim::generateToken(),
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     *
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function approve(RaisedClaim $claim)
    {
        $user = User::find($claim->user_id);
        $person = Person::find($claim->person_id);
        ClaimPersonHelper::acceptClaim($user, $person, $claim);

        return view('admin.person-claim.approve');
    }
}
