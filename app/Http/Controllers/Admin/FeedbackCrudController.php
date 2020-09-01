<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FeedbackCrudRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FocusCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FeedbackCrudController extends CrudController
{

    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {

        // Check Guard
        if(!backpack_user()->can('edit feedback')) {
            abort(404);
        }

        $this->crud->setModel('App\Models\Feedback');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/feedback');
        $this->crud->setEntityNameStrings('feedback', 'feedback ');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'status', 'label' => 'Status', 'type' => 'model_function', 'function_name' => 'getStatusName']);
        CRUD::addColumn(['name' => 'type', 'label' => 'Type', 'type' => 'model_function', 'function_name' => 'getTypeName']);
        CRUD::addColumn(['name' => 'assignee', 'label' => 'Assignee', 'type' => 'model_function', 'function_name' => 'getAssigneeName']);
        CRUD::addColumn(['name' => 'title', 'label' => 'Title', 'type' => 'string']);
        CRUD::addColumn(['name' => 'user name', 'label' => 'User Name', 'type' => 'model_function', 'function_name' => 'getUserName']);
        CRUD::addColumn(['name' => 'user email', 'label' => 'User Email', 'type' => 'model_function', 'function_name' => 'getUserEmail']);
        CRUD::removeButton('create');
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FeedbackCrudRequest::class);

        CRUD::addField([
            'name'        => 'type',
            'label'       => "Type",
            'type'        => 'select2_from_array',
            'options'     => ['problem' => 'Problem', 'feedback' => 'Feedback', 'bug' => 'Bug', 'suggestion' => 'Suggestion', 'feature request' => 'Feature Request'],
            'allows_null' => false,
        ]);
        CRUD::addField([
            'name'        => 'status',
            'label'       => "Status",
            'type'        => 'select2_from_array',
            'options'     => ['open' => 'Open','awaiting response' => 'Awaiting response', 'in progress' => 'In progress', 'closed' => 'Closed'],
            'allows_null' => false,
        ]);
        CRUD::addField([
            'label'     => "Assigne",
            'type'      => 'select2',
            'name'      => 'assignee_id', // the db column for the foreign key

            // optional
            'entity'    => 'assignee', // the method that defines the relationship in your Model
            'model'     => "App\User", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user

            // also optional
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
