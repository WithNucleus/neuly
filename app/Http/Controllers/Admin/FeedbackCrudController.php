<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FeedbackCrudRequest;
use App\Models\Feedback;
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
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if(!backpack_user()->can('edit feedback')) {
            abort(404);
        }

        $this->crud->setModel(Feedback::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/feedback');
        $this->crud->setEntityNameStrings('feedback', 'feedback ');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'status', 'label' => 'Status', 'type' => 'text']);
        CRUD::addColumn(['name' => 'type', 'label' => 'Type', 'type' => 'text']);
        CRUD::addColumn(['name' => 'assignee_name', 'label' => 'Assignee', 'type' => 'text']);
        CRUD::addColumn(['name' => 'title', 'label' => 'Title', 'type' => 'string']);
        CRUD::addColumn(['name' => 'user_name', 'label' => 'User Name', 'type' => 'text']);
        CRUD::addColumn(['name' => 'user_email', 'label' => 'User Email', 'type' => 'text']);
    }

    protected function setupUpdateOperation()
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
            'name'      => 'assignee_id',
            'entity'    => 'assignee',
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }
}
