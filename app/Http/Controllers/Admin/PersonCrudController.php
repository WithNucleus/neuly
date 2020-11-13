<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PersonRequest;
use App\Models\Person;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Route;

/**
 * Class PersonCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PersonCrudController extends CrudController
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
        if(!backpack_user()->can('edit people')) {
            abort(404);
        }

        CRUD::setModel(Person::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/person');
        CRUD::setEntityNameStrings('person', 'people');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'name']);
        $this->crud->addColumn([
           'label'     => 'Organizations',
           'type'      => 'select_multiple',
           'name'      => 'companies',
           'entity'    => 'companies',
           'attribute' => 'name',
           'model'     => 'App\Models\Company',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
           'label'     => 'Investors',
           'type'      => 'select_multiple',
           'name'      => 'investors',
           'entity'    => 'investors',
           'attribute' => 'name',
           'model'     => 'App\Models\Investor',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
           'label'     => 'Locations',
           'type'      => 'select_multiple',
           'name'      => 'locations',
           'entity'    => 'locations',
           'attribute' => 'name',
           'model'     => 'App\Models\Location',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
            'label'    => 'Created',
            'type'     => 'date',
            'name'     => 'created_at',
        ]);
        $this->crud->addColumn([
            'label'    => 'Updated',
            'type'     => 'date',
            'name'     => 'updated_at',
        ]);
    }

    protected function setupShowOperation()
    {
        $personId = Route::current()->parameter('id');
        $person = Person::find($personId);

        Widget::add([
            'type'   => 'view',
            'view'   => 'customwidget.person_show_widget',
            'person' => $person
        ])->to('before_content');

        $this->crud->addColumn([
            'name'          => 'name',
            'type'          => 'model_function',
            'function_name' => 'getShowLink'
        ]);
        $this->crud->addColumn([
            'name'  => 'email',
            'type'  => 'email',
            'label' => 'Email'
        ]);
        $this->crud->addColumn([
            'name'  => 'secondary_email',
            'type'  => 'email',
            'label' => 'Secondary email'
        ]);
        $this->crud->addColumn([
            'name'  => 'website',
            'type'  => 'text',
            'label' => 'Website'
        ]);
        $this->crud->addColumn([
            'name'          => 'linkedin',
            'type'          => 'model_function',
            'function_name' => 'getLinkedIn'
        ]);
        $this->crud->addColumn([
            'name'          => 'facebook',
            'type'          => 'model_function',
            'function_name' => 'getFacebook'
        ]);
        $this->crud->addColumn([
            'name'          => 'twitter',
            'type'          => 'model_function',
            'function_name' => 'getTwitter'
        ]);
        $this->crud->addColumn([
            'label'     => 'Organizations',
            'type'      => 'select_multiple',
            'name'      => 'companies',
            'entity'    => 'companies',
            'attribute' => 'name',
            'model'     => 'App\Models\Company',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
            'label'     => 'Locations',
            'type'      => 'select_multiple',
            'name'      => 'locations',
            'entity'    => 'locations',
            'attribute' => 'name',
            'model'     => 'App\Models\Location',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
            'label'     => 'Investors',
            'type'      => 'select_multiple',
            'name'      => 'investors',
            'entity'    => 'investors',
            'attribute' => 'name',
            'model'     => 'App\Models\Investor',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addColumn([
            'label'  => "Photo",
            'name'   => "photo",
            'type'   => 'image',
            'prefix' => Person::getImageUrlPrefix()
        ]);

        $this->crud->addButtonFromModelFunction('line', 'show_entity', 'getShowEntityPageButton', 'beginning');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PersonRequest::class);

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.updateSlug'
        ])->to('after_content');

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name'
        ]);
        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'Page Slug'
        ]);
        $this->crud->addField([
            'name' => 'email',
            'type' => 'text',
            'label' => 'Email'
        ]);
        $this->crud->addField([
            'name' => 'secondary_email',
            'type' => 'text',
            'label' => 'Secondary email'
        ]);
        $this->crud->addField([
            'name' => 'website',
            'type' => 'text',
            'label' => 'Website'
        ]);
        $this->crud->addField([
            'name' => 'linkedin',
            'type' => 'text',
            'label' => 'Linked In',
            'prefix'     => "https://www.linkedin.com/in/",
        ]);
        $this->crud->addField([
            'name' => 'facebook',
            'type' => 'text',
            'label' => 'Facebook',
            'prefix'     => "https://www.facebook.com/",
        ]);
        $this->crud->addField([
            'name' => 'twitter',
            'type' => 'text',
            'label' => 'Twitter',
            'prefix'     => "https://www.twitter.com/",
        ]);
        $this->crud->addField([
            'name' => 'bio',
            'type' => 'wysiwyg',
            'label' => 'Bio',
        ]);
        $this->crud->addField([
            'label'     => "Locations",
            'type'      => 'select2_multiple',
            'name'      => 'locations',
            'entity'    => 'locations',
            'attribute' => 'name',
            'pivot'     => true,
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'     => "App\Models\Location",
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
        $this->crud->addField([
            'label'        => "Photo",
            'name'         => "photo",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true,
            'aspect_ratio' => 1,
            'disk'         => 'local',
        ]);

        $this->setupCreateOperation();
    }
}
