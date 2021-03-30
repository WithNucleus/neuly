<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SearchLocationGeocoding;
use App\Models\Location;
use App\Models\LocationsGeocoding;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class LocationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LocationGeocodingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if (!backpack_user()->can('edit locations')) {
            abort(404);
        }

        CRUD::setModel(LocationsGeocoding::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/location-geocoding');
        CRUD::setEntityNameStrings('location geocoding', 'locations geocoding');
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
            'name' => 'created_at',
            'type' => 'datetime',
        ]);
        $this->crud->addColumn([
            'name' => 'payload',
            'type' => 'array_count',
            'label' => 'Total',
        ]);
        $this->crud->addColumn([
            'name' => 'processed',
            'type' => 'array_count',
        ]);
        $this->crud->addColumn([
            'name' => 'failed',
            'type' => 'array_count',
        ]);
        $this->crud->addColumn([
            'name' => 'finished_at',
            'type' => 'datetime',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->crud->addColumn([
            'name' => 'processed',
            'type' => 'table',
            'columns' => [
                'name' => 'Name',
                'longitude' => 'Longitude',
                'latitude' => 'Latitude',
            ],
        ]);
        $this->crud->addColumn([
            'name' => 'failed',
            'type' => 'table-geocoding',
            'columns' => [
                'name' => 'Name',
                'message' => 'Message',
            ],
        ]);
    }

    public function runGeocoding()
    {
        $limit = config('services.opencage.requests_per_day');
        $locations = Location::emptyCoordinates()->limit($limit)->pluck('name', 'id');

        if ($locations !== []) {
            $geocoding = new LocationsGeocoding;
            $geocoding->payload = $locations;
            $geocoding->save();

            SearchLocationGeocoding::dispatch($geocoding);
            Alert::success('Geocoding was started successfully!')->flash();
        }

        return redirect()->route('location-geocoding.index');
    }
}
