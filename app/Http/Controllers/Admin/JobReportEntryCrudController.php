<?php

namespace App\Http\Controllers\Admin;

use App\Models\JobReportEntry;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class JobReportEntriesCrudController
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class JobReportEntryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        if (! backpack_user()->can('manage job reports')) {
            abort(403);
        }

        CRUD::setModel(JobReportEntry::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/jobreportentries');
        CRUD::setEntityNameStrings('job report entry', 'job report entries');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'name', 'type' => 'text']);
        CRUD::addColumn(['name' => 'email', 'type' => 'text']);
        CRUD::addColumn(['name' => 'company', 'type' => 'text']);
        CRUD::addColumn(['name' => 'position', 'type' => 'text']);
        CRUD::addColumn([
            'name' => 'currently_hiring',
            'type' => 'select_from_array',
            'options' => JobReportEntry::getCurrentlyHiringValues(),
        ]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::addColumn(['name' => 'job_listing_src', 'type' => 'text', 'label' => 'If you are hiring, where can we find the job listings?']);
        CRUD::addColumn(['name' => 'job_listing_url', 'type' => 'text', 'label' => 'Please provide the URL(s) to your job listings']);
        CRUD::addColumn(['name' => 'total_employees', 'type' => 'text', 'label' => 'How many employees does your company current have?']);
        CRUD::addColumn(['name' => 'most_important_role', 'type' => 'text', 'label' => 'What Role is most important for you to fill today?']);
        CRUD::addColumn(['name' => 'holding_from_expanding', 'type' => 'text', 'label' => 'What, if anything, is currently holding you back from expanding your workforce?']);
        CRUD::addColumn(['name' => 'job_growth_forecast', 'type' => 'text', 'label' => 'What is your 12-24 month forecast concerning psychedelic industry job growth?']);
    }
}
