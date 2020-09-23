<?php

namespace App\Http\Controllers\Admin;

use App\Models\LogEmbed;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class LogEmbedCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        if(!backpack_user()->can('view logs')) {
            abort(403);
        }

        $this->crud->setModel(LogEmbed::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/log-embed');
        $this->crud->setEntityNameStrings('Embed log', 'Embed logs');
    }

    public function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'entity_id',
            'type' => 'integer',
            'label' => 'Entity Id'
        ]);

        $this->crud->addColumn([
            'name' => 'entity_type',
            'type' => 'text',
            'label' => 'Entity Type'
        ]);

        $this->crud->addColumn([
            'name' => 'referer_url',
            'type' => 'text',
            'label' => 'Referer URL'
        ]);

        $this->crud->addColumn([
            'name' => 'created_at',
            'type' => 'datetime',
            'label' => 'Date'
        ]);
    }
}
