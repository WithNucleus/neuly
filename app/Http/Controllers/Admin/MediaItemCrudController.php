<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MediaItemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MediaItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MediaItemCrudController extends CrudController
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
        CRUD::setModel(\App\Models\MediaItem::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/media-item');
        CRUD::setEntityNameStrings('media item', 'media items');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name'    => 'name',
            'label'   => 'Name',
            'type'    => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'url',
            'label'   => 'URL',
            'type'    => 'text',
            'wrapper' => [
                'element' => 'a',
                'href' => function ($crud, $column, $entry, $related_key) {
                    return $entry->url;
                },
                    'target' => '_blank',
                    'rel'=> 'noopener noreferrer'
            ],
        ]);

        $this->crud->addColumn([
            'name'    => 'status',
            'label'   => 'Status',
            'type'    => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'media_type',
            'label'   => 'Media Type',
            'type'    => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'source',
            'label'   => 'Source',
            'type'    => 'relationship',
        ]);

        $this->crud->addColumn([
            'name'    => 'focus',
            'label'   => 'Focus',
            'type'    => 'relationship',
        ]);

        $this->crud->addColumn([
            'name'    => 'date',
            'label'   => 'Publish Date',
            'type'    => 'date',
        ]);

        $this->crud->addColumn([
            'name'    => 'created_at',
            'label'   => 'Created',
            'type'    => 'date',
        ]);

//        CRUD::setFromDb(); // columns
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MediaItemRequest::class);

        $this->crud->addField([
            'name'    => 'name',
            'label'   => 'Name',
            'type'    => 'text',
        ]);

        $this->crud->addField([
            'name'    => 'url',
            'label'   => 'URL',
            'type'    => 'url',
        ]);

        $this->crud->addField([
            'name'    => 'status',
            'label'   => 'Status',
            'type'    => 'text',
        ]);

        $this->crud->addField([
            'name'    => 'media_type',
            'label'   => 'Media Type',
            'type'    => 'text',
        ]);


        $this->crud->addField([
            'label'     => "Focus",
            'type'      => 'select2_multiple',
            'name'      => 'focus',
            'entity'    => 'focus',
            'attribute' => 'name',
            'pivot'   => true,
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'model'   => "App\Models\Focus",
        ]);

        CRUD::setFromDb(); // fields

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
