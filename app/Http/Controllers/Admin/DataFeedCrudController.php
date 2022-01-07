<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DataFeedRequest;
use App\Models\DataFeed;
use App\Models\MediaItem;
use App\Models\Person;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use SimplePie;
use Stevebauman\Purify\Facades\Purify;
use Symfony\Component\VarDumper\Cloner\Data;
use Vedmant\FeedReader\Facades\FeedReader;

/**
 * Class DataFeedCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DataFeedCrudController extends CrudController
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
        CRUD::setModel(\App\Models\DataFeed::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/datafeed');
        CRUD::setEntityNameStrings('data feed', 'data feeds');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns
        $this->crud->query->withCount('mediaItems');
        $this->crud->addColumn([
            'name'      => 'media_items_count', // name of relationship method in the model
            'type'      => 'text',
            'label'     => 'Media Items', // Table column heading
        ]);

        $this->crud->addButtonFromView('line', 'datafeed.get-feed', 'datafeed.get-feed', 'beginning');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    protected function setupShowOperation()
    {
        $id = Route::current()->parameter('id');
        $dataFeed = DataFeed::with('mediaItems')->find($id);

        $this->setupListOperation();

        Widget::add([
            'type' => 'view',
            'view' => 'customwidget.datafeed.media-items-list',
            'dataFeed' => $dataFeed,
        ])->to('after_content');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DataFeedRequest::class);

        $this->crud->addField([
            'name'  => 'name',
            'label' => 'Title',
            'type'  => 'text'
        ]);

        $this->crud->addField([
            'name'  => 'url',
            'label' => 'URL',
            'type'  => 'text'
        ]);

        $this->crud->addField([
            'name'    => 'feed_type',
            'type'    => 'select2_from_array',
            'label'   => 'Feed Type',
            'options' => DataFeed::getFeedTypes(),
            'allows_null'  => false,
        ]);

        $this->crud->addField([
            'name'    => 'media_type',
            'type'    => 'select2_from_array',
            'label'   => 'Media Type',
            'options' => DataFeed::getMediaTypes(),
            'allows_null'  => false,
        ]);

        $this->crud->addField([
            'name'    => 'source_category',
            'type'    => 'select2_from_array',
            'label'   => 'Source Category',
            'options' => DataFeed::getSourceCategories(),
            'allows_null'  => false,
        ]);

        CRUD::setFromDb(); // fields

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
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Gets the items from a data feed and creates/updates media items
     */
    public function getFeedItems($id): \Illuminate\Http\RedirectResponse
    {
        $dataFeed = DataFeed::findOrFail($id);
        $feed = $this->setupSimplePieFeed($dataFeed);
        $feedName = $this->formatFeedName($feed->get_title());

        foreach ($feed->get_items() as $item) {

            $date = Carbon::parse($item->get_date())->format('Y-m-d');
            $feedImage = $feed->get_image_url();

            $title = $item->get_title();
            $description = Purify::clean($item->get_content());

            $summary = $this->formatFeedItemSummary($item->get_content(), $feedName, $title);

            $attributes = [
                'name' => $title,
                'type' => 'Article',
                'url' => $item->get_link(),
                'summary' => $summary,
                'content' => $description,
                'icon_url' => $feedImage,
                'source_type' => DataFeed::class,
                'source_id' => $dataFeed->id,
                'date' => $date
            ];

            MediaItem::updateOrCreate(
                [
                    'url' => $item->get_link(),
                    'source_type' => DataFeed::class,
                    'source_id' => $dataFeed->id,
                ],
                $attributes
            );

        }

        return redirect()->route('admin.datafeed.show', $id);
    }

    private function setupSimplePieFeed($dataFeed): SimplePie
    {
        $feed = new SimplePie();
        $feed->set_feed_url($dataFeed->url . '?format=xml');
        $feed->set_useragent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36');
        $feed->set_cache_location(storage_path() . '/rss-feeds');

        $stripHtmlTags = $feed->strip_htmltags;
        array_splice($stripHtmlTags, array_search('iframe', $stripHtmlTags), 1);

        $feed->strip_htmltags($stripHtmlTags);

        $feed->init();
        $feed->handle_content_type();

        return $feed;
    }

    private function formatFeedName($originalName): string
    {

        $feedName = html_entity_decode($originalName, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $charactersToReplace = [
            '–' => '-'
        ];

        foreach ($charactersToReplace as $old => $new) {
            $feedName = str_replace($old, $new, $feedName);
        }

        return $feedName;
    }

    private function formatFeedItemSummary($content, $feedName, $title): string
    {
        $summary = str_replace(["\r", "\n"], '', Purify::clean($content));
        $summary = strip_tags($summary, ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']);

        $summary = str_replace(['</p>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'], ' ', $summary);
        $summary = str_replace(['<p>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>'], '', $summary);

        $stringsToRemove = [
            'The post ' . $title . ' appeared first on ' . $feedName . '.',
            'The article ' . $title . ' was originally published on ' . $feedName . '.',
            'Continue reading ' . $title
        ];

        $summary = str_replace($stringsToRemove, '', $summary);

        if (strlen($summary) > 300) {
            $summary = wordwrap($summary, 300);
            $summary = substr($summary, 0, strpos($summary, "\n")) . '...';
        }

        return $summary;
    }
}
