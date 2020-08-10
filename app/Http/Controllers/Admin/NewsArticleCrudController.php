<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsArticleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NewsArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NewsArticleCrudController extends CrudController
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
        if(!backpack_user()->can('edit news articles')) {
            abort(404);
        }

        CRUD::setModel(\App\Models\NewsArticle::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/newsarticle');
        CRUD::setEntityNameStrings('news article', 'news articles');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

        // Date
        $this->crud->addColumn([
            'name'  => 'date',
            'label' => 'Date',
            'type'  => 'date'
        ]);

        // Name
        $this->crud->addColumn([
            'name'  => 'name',
            'label' => 'Title',
            'type'  => 'text'
        ]);

        // Publisher
        $this->crud->addColumn([
            'name'  => 'publisher',
            'label' => 'Publisher',
            'type'  => 'text'
        ]);

        // Focus -- Relationship
        $this->crud->addColumn([
           'label'     => 'Focus',
           'type'      => 'select_multiple',
           'name'      => 'focus',
           'entity'    => 'focus',
           'attribute' => 'name',
           'model'     => 'App\Models\Focus',
           // 'orderable' => true,
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
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
        CRUD::setValidation(NewsArticleRequest::class);

        // Name
        $this->crud->addField([
            'name'  => 'name',
            'label' => 'Title',
            'type'  => 'text'
        ]);

        // Publisher
        $this->crud->addField([
            'name'  => 'publisher',
            'label' => 'Publisher',
            'type'  => 'text'
        ]);

        // Date
        $this->crud->addField([
            'name'  => 'date',
            'label' => 'Date',
            'type'  => 'date'
        ]);

        // URL
        $this->crud->addField([
            'name'  => 'url',
            'label' => 'URL',
            'type'  => 'url'
        ]);

        // Focus
        $this->crud->addField([  
             'label'     => "Focus",
             'type'      => 'select2_multiple',
             'name'      => 'focus',
             'entity'    => 'focus',
             'attribute' => 'name',
             'pivot'     => true,
             'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
             'model'     => "App\Models\Focus",
        ]);

        // Image
        $this->crud->addField([
            'label'        => "Image",
            'name'         => "image",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            'disk'      => 'local', // in case you need to show images from a different disk
            // 'prefix'    => 'storage/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
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
    protected function setupShowOperation()
    {
        $this->setupListOperation();

        // URL
        $this->crud->addColumn([
            'name'  => 'url',
            'label' => 'URL',
        ]);

        // Image
        $this->crud->addColumn([
            'name'      => 'image',
            'label'     => 'Image',
            'type'      => 'image',
            'prefix'    => 'storage/'
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
