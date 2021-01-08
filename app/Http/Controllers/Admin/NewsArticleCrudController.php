<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendNotification;
use App\Http\Requests\NewsArticleRequest;
use App\Models\Focus;
use App\Models\NewsArticle;
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
        if(!backpack_user()->can('edit news articles')) {
            abort(404);
        }

        CRUD::setModel(NewsArticle::class);
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
        $this->crud->addColumn([
            'name'  => 'date',
            'label' => 'Date',
            'type'  => 'date'
        ]);
        $this->crud->addColumn([
            'name'  => 'name',
            'label' => 'Title',
            'type'  => 'text'
        ]);
        $this->crud->addColumn([
            'name'  => 'publisher',
            'label' => 'Publisher',
            'type'  => 'text'
        ]);
        $this->crud->addColumn([
           'label'     => 'Focus',
           'type'      => 'select_multiple',
           'name'      => 'focus',
           'entity'    => 'focus',
           'attribute' => 'name',
           'model'     => 'App\Models\Focus',
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
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
        $this->crud->addColumn([
            'name'  => 'url',
            'label' => 'URL',
        ]);
        $this->crud->addColumn([
            'name'      => 'image',
            'label'     => 'Image',
            'type'      => 'image',
            'prefix'    => 'storage/'
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
        CRUD::setValidation(NewsArticleRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'label' => 'Title',
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'name'  => 'publisher',
            'label' => 'Publisher',
            'type'  => 'text'
        ]);
        $this->crud->addField([
            'name'  => 'date',
            'label' => 'Date',
            'type'  => 'date_picker',
            'date_picker_options' => [
                'format' => config('app.datepicker_input_format'),
            ],
        ]);
        $this->crud->addField([
            'name'  => 'url',
            'label' => 'URL',
            'type'  => 'url'
        ]);
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
        $this->crud->addField([
            'label'        => "Image",
            'name'         => "image",
            'type'         => 'image',
            'upload'       => true,
            'crop'         => true,
            'aspect_ratio' => 0,
            'disk'      => 'local',
        ]);
    }

    public function store()
    {
        $response = $this->traitStore();
        $request = $response->getRequest();

        if($request->has('focus') && $request->input('focus') !== null) {
            foreach($request->input('focus') as $focusId) {
                $focus = Focus::find($focusId);
                SendNotification::dispatch($focus, 'A new article has been added to focus.', 'some long description');
            }
        }

        return $response;
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

    public function update()
    {
        $originalArticle = $this->getOriginalModel($this->crud);
        $oldFocus = $this->getFocusIds($originalArticle);

        $response = $this->traitUpdate();
        $request = $response->getRequest();

        $article = $this->data['entry'];

        $newFocus = $this->getFocusIds($article);

        $addedFocus = array_diff($newFocus, $oldFocus);
        $removedFocus = array_diff($oldFocus, $newFocus);

        if($addedFocus !== [])
        {
            foreach($addedFocus as $key => $focusId)
            {
                $title = 'Focus was added to article';

                $focus = Focus::find($focusId);
                SendNotification::dispatch($focus, $title, 'some long description');
            }
        }

        if($removedFocus !== [])
        {
            foreach($removedFocus as $key => $focusId)
            {
                $title = 'Focus was removed from article';

                $focus = Focus::find($focusId);
                SendNotification::dispatch($focus, $title, 'some long description');
            }
        }

        return $response;
    }

    private function getFocusIds($model)
    {
        return $model->focus()->pluck('focus_id')->toArray();
    }

    private function getOriginalModel($crud)
    {
        $request = $crud->validateRequest();
        return NewsArticle::find($request->get($crud->model->getKeyName()));
    }
}
