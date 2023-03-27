<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ApiUserCrudController.
 *
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ActivityLogCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Activity::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/activity-log');
        CRUD::setEntityNameStrings('Activity Log', 'Activity Logs');
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
        $this->crud->addColumns([
            [
                'name' => 'created_at',
                'label' => 'Date',
                'type' => 'date',
            ],
            [
                'name' => 'log_name',
                'label' => 'Log Name',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'text',
            ],
            [
                'label' => 'Subject',
                'type' => 'closure',
                'function' => function ($activity) {
                    if ($activity->subject_id == null) {
                        return $activity->subject_type;
                    }
                    try {
                        return $activity->subject->name.'<br>'.'<small>'.$activity->subject_type.' #'.$activity->subject_id.'</small>';
                    } catch (\Throwable $throwable) {
                        return '';
                    }
                },
            ],
            [
                'label' => 'Causer',
                'type' => 'closure',
                'function' => function ($activity) {
                    if ($activity->causer_id == null) {
                        return $activity->causer_type;
                    }
                    try {
                        return $activity->causer->name.' '.$activity->causer->last_name.'<br>'.'<small>'.$activity->causer_type.' #'.$activity->causer_id.'</small>';
                    } catch (\Throwable $throwable) {
                        return '';
                    }
                },
            ],
        ]);

        // Filters
        $this->crud->addFilter([
            'type' => 'date_range',
            'name' => 'created_at',
            'label' => 'Date range',
        ],
            false,
            function ($value) {
                $dates = json_decode($value);
                $this->crud->addClause('where', 'created_at', '>=', $dates->from);
                $this->crud->addClause('where', 'created_at', '<=', $dates->to.' 23:59:59');
            });

        $this->crud->addFilter([
            'name' => 'log',
            'type' => 'select2_multiple',
            'label' => 'Log',
        ], function () {
            return [
                'created' => 'created',
                'updated' => 'updated',
                'pageview' => 'pageview',
            ];
        }, function ($values) { // if the filter is active
        $this->crud->addClause('whereIn', 'description', json_decode($values));
        });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'created',
            'label' => 'Created',
        ],
            false,
            function () {
                $this->crud->addClause('where', 'description', 'created');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'updated',
            'label' => 'Updated',
        ],
            false,
            function () {
                $this->crud->addClause('where', 'description', 'updated');
            });

        $this->crud->addFilter([
            'type' => 'simple',
            'name' => 'pageview',
            'label' => 'Page View',
        ],
            false,
            function () {
                $this->crud->addClause('where', 'log_name', 'pageview');
            });

        $this->crud->addFilter([
            'type' => 'text',
            'name' => 'subject_type',
            'label' => 'Subject Type',
        ],
            false,
            function ($value) { // if the filter is active
            $this->crud->addClause('where', 'subject_type', 'LIKE', "%$value%");
            });

        $this->crud->addFilter([
            'type' => 'text',
            'name' => 'subject_id',
            'label' => 'Subject ID',
        ],
            false,
            function ($value) { // if the filter is active
            $this->crud->addClause('where', 'subject_id', $value);
            });
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     *
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'log_name',
                'label' => 'Log Name',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'text',
            ],
            [
                'label' => 'Subject',
                'type' => 'closure',
                'function' => function ($activity) {
                    if ($activity->subject_id == null) {
                        return $activity->subject_type;
                    }
                    try {
                        return $activity->subject->name.'<br>'.'<small>'.$activity->subject_type.' #'.$activity->subject_id.'</small>';
                    } catch (\Throwable $throwable) {
                        return '';
                    }
                },
            ],
            [
                'label' => 'Causer',
                'type' => 'closure',
                'function' => function ($activity) {
                    if ($activity->causer_id == null) {
                        return $activity->causer_type;
                    }
                    try {
                        return $activity->causer->name.' '.$activity->causer->last_name.'<br>'.'<small>'.$activity->causer_type.' #'.$activity->causer_id.'</small>';
                    } catch (\Throwable $throwable) {
                        return '';
                    }
                },
            ],
            [
                'name' => 'properties',
                'label' => 'Properties',
                'type' => 'json',
            ],
        ]);
    }
}
