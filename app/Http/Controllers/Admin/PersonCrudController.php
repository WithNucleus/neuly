<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PersonRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

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

        // Check Guard
        if(!backpack_user()->can('edit people')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\Person::class);
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

        // Company -- Relationship
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

        // Investor -- Relationship
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

        // Location -- Relationship
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
        CRUD::setValidation(PersonRequest::class);

        // CRUD::setFromDb(); // fields

        // Update Slug Widget
        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.updateSlug'
        ])->to('after_content');
        // Name
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name'
        ]);

        // Page Slug
        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'Page Slug'
        ]);

        // Email
        $this->crud->addField([
            'name' => 'email',
            'type' => 'text',
            'label' => 'Email'
        ]);

        // Secondary email
        $this->crud->addField([
            'name' => 'secondary_email',
            'type' => 'text',
            'label' => 'Secondary email'
        ]);

        // Website
        $this->crud->addField([
            'name' => 'website',
            'type' => 'text',
            'label' => 'Website'
        ]);

        // Linked In
        $this->crud->addField([
            'name' => 'linkedin',
            'type' => 'text',
            'label' => 'Linked In',
            'prefix'     => "https://www.linkedin.com/in/",
        ]);

        // Facebook
        $this->crud->addField([
            'name' => 'facebook',
            'type' => 'text',
            'label' => 'Facebook',
            'prefix'     => "https://www.facebook.com/",
        ]);

        // Twitter
        $this->crud->addField([
            'name' => 'twitter',
            'type' => 'text',
            'label' => 'Twitter',
            'prefix'     => "https://www.twitter.com/",
        ]);

        // Bio
        $this->crud->addField([
            'name' => 'bio',
            'type' => 'wysiwyg',
            'label' => 'Bio',
        ]);

        // Locations
        $this->crud->addField([    // Select2Multiple = n-n relationship (with pivot table)
             'label'     => "Locations",
             'type'      => 'select2_multiple',
             'name'      => 'locations', // the method that defines the relationship in your Model
             'entity'    => 'locations', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user

             'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
             // 'select_all' => true, // show Select All and Clear buttons?
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),

             // optional
             'model'     => "App\Models\Location", // foreign key model
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    protected function setupShowOperation()
    {

        $request = \Request::getPathInfo();
        $request_array = explode('/', $request);
        $this_person_id = $request_array[3];
        $person = \App\Models\Person::find($this_person_id);

        // Company People Widget
        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.person_show_widget',
            'person' => $person
        ])->to('before_content');

        $fields = $this->getFieldsOperation();

        foreach($fields as $field){
            $this->crud->addColumn($field);
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

        // Photo
        $this->crud->addField([
            'label'        => "Photo",
            'name'         => "photo",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            'disk'         => 'local', // in case you need to show images from a different disk
            // 'prefix'       => 'storage/',
        ]);
        
        $this->setupCreateOperation();
    }

    /**
     * List of fields available.
     *
     * @return Array of fields
     */
    private function getFieldsOperation()
    {
        return array(
            'name' => [
                'name' => 'name',
                'type' => 'model_function',
                'function_name' => 'linkToShow'
            ],
            'email' => [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email'
            ],
            'secondary_email' => [
                'name' => 'secondary_email',
                'type' => 'email',
                'label' => 'Secondary email'
            ],
            'website' => [
                'name' => 'website',
                'type' => 'text',
                'label' => 'Website'
            ],
            'linkedin' => [
                'name' => 'linkedin',
                'type' => 'model_function',
                'function_name' => 'getLinkedIn'
            ],
            'facebook' => [
                'name' => 'facebook',
                'type' => 'model_function',
                'function_name' => 'getFacebook'
            ],
            'twitter' => [
                'name' => 'twitter',
                'type' => 'model_function',
                'function_name' => 'getTwitter'
            ],
            // Companies -- Relationship
            'companies' => [
               'label'     => 'Organizations',
               'type'      => 'select_multiple',
               'name'      => 'companies',
               'entity'    => 'companies',
               'attribute' => 'name',
               'model'     => 'App\Models\Company',
               // 'orderable' => true,
               'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ],
            // Locations -- Relationship
            'locations' => [
               'label'     => 'Locations',
               'type'      => 'select_multiple',
               'name'      => 'locations',
               'entity'    => 'locations',
               'attribute' => 'name',
               'model'     => 'App\Models\Location',
               // 'orderable' => true,
               'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ],
            // Investor -- Relationship
            'investors' => [
               'label'     => 'Investors',
               'type'      => 'select_multiple',
               'name'      => 'investors',
               'entity'    => 'investors',
               'attribute' => 'name',
               'model'     => 'App\Models\Investor',
               // 'orderable' => true,
               'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ],
            'photo' => [
                'label'        => "Photo",
                'name'         => "photo",
                'type'         => 'image',
                'prefix'       => 'storage/'
            ],
        );
    }
}
