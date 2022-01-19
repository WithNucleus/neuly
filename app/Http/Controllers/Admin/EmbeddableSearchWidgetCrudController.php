<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmbeddableSearchWidgetRequest;
use App\Models\EmbeddableSearchWidget;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

/**
 * Class EmbeddableSearchWidgetCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmbeddableSearchWidgetCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(EmbeddableSearchWidget::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/embeddable-search-widget');
        CRUD::setEntityNameStrings('embeddable search widget', 'embeddable search widgets');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        Widget::add()
            ->to('before_content')
            ->type('card')
            ->wrapper(['class' => ''])
            ->content(['body' => $this->getHelpBlockHtml()]);

        $this->crud->addColumn(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'code', 'type' => 'text', 'label' => 'Code']);
        $this->crud->addColumn(['name' => 'tabs', 'type' => 'array', 'label' => 'Tabs']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmbeddableSearchWidgetRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Name'
        ]);

        $this->crud->addField([
            'name' => 'code',
            'type' => 'text',
            'label' => 'Code',
            'default' => Str::random(32),
            'attributes' => [
                'readonly' => 'readonly'
            ]
        ]);

        $this->crud->addField([
            'name' => 'tabs',
            'label' => 'Tabs',
            'type' => 'select_from_array',
            'options' => array_combine(EmbeddableSearchWidget::TABS, EmbeddableSearchWidget::TABS),
            'allows_null' => false,
            'default' => 'one',
            'allows_multiple' => true,
        ]);

        $this->crud->addField([
            'label' => 'Logo',
            'name' => 'logo',
            'type' => 'image',
            'upload' => true,
            'crop' => true,
            'aspect_ratio' => 0,
            'prefix' => Storage::disk('public')->url('embed_search_widget/'),
        ]);
    }

    public function store()
    {
        $response = $this->traitStore();
        $request = $response->getRequest();
        $entry = $this->data['entry'];

        //TODO remove example after added dynamic focuses
//        $entry->filters = [
//            'companies' => [
//                'focus' => [
//                    'prefilter' => [
//                        'Psilocybin'
//                    ]
//                ]
//            ],
//            'people' => [
//                'focus' => [
//                    'prefilter' => [
//                        'Psilocybin'
//                    ]
//                ]
//            ],
//        ];

        $entry->save();

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
        $response = $this->traitUpdate();
        $request = $response->getRequest();
        $entry = $this->data['entry'];

        return $response;
    }

    //TODO move to separate widget file
    private function getHelpBlockHtml()
    {
        return '
<p>1. Place this code of the button which will open search window:</p>
<pre style="padding: 10px; background-color: lightgrey;">
&lt;button id="nes-open-modal-btn" class="nes-open-modal-btn"&gt;Search&lt;/button&gt;
</pre>
<p>2. Paste this code to the end of the web page (after jQuery library which is required):</p>
<pre style="padding: 10px; background-color: lightgrey;">
&lt;link href="' . asset('/css/external/embed-search.css') . '" rel="stylesheet" type="text/css"&gt;
&lt;script src="'. asset('/js/external/embed-search.js') .'"&gt;&lt;/script&gt;
&lt;script&gt;
    $("#nes-open-modal-btn").neulyEmbedSearch("' . URL::to('/') . '","{{widget code}}");
&lt;/script&gt;
</pre>
<p>3. Replace <code>{{widget code}}</code> with the "Code" value of the widget.</p>
<p>4. (optional) You can use your custom link/button and initialize <code>neulyEmbedSearch()</code> for it with jQuery selector.</p>
';
    }
}
