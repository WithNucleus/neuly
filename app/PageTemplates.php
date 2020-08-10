<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */

    // private function services()
    // {
    //     $this->crud->addField([   // CustomHTML
    //                     'name' => 'metas_separator',
    //                     'type' => 'custom_html',
    //                     'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
    //                 ]);
    //     $this->crud->addField([
    //                     'name' => 'meta_title',
    //                     'label' => trans('backpack::pagemanager.meta_title'),
    //                     'fake' => true,
    //                     'store_in' => 'extras',
    //                 ]);
    //     $this->crud->addField([
    //                     'name' => 'meta_description',
    //                     'label' => trans('backpack::pagemanager.meta_description'),
    //                     'fake' => true,
    //                     'store_in' => 'extras',
    //                 ]);
    //     $this->crud->addField([
    //                     'name' => 'meta_keywords',
    //                     'type' => 'textarea',
    //                     'label' => trans('backpack::pagemanager.meta_keywords'),
    //                     'fake' => true,
    //                     'store_in' => 'extras',
    //                 ]);
    //     $this->crud->addField([   // CustomHTML
    //                     'name' => 'content_separator',
    //                     'type' => 'custom_html',
    //                     'value' => '<br><h2>'.trans('backpack::pagemanager.content').'</h2><hr>',
    //                 ]);
    //     $this->crud->addField([
    //                     'name' => 'content',
    //                     'label' => trans('backpack::pagemanager.content'),
    //                     'type' => 'wysiwyg',
    //                     'placeholder' => trans('backpack::pagemanager.content_placeholder'),
    //                 ]);
    // }

    private function default()
    {

        $this->crud->addField([
            'name' => 'content',
            'label' => trans('backpack::pagemanager.content'),
            'type' => 'wysiwyg',
            'placeholder' => trans('backpack::pagemanager.content_placeholder'),
        ]);

        $this->crud->addField([
            'name' => 'meta_title',
            'label' => trans('backpack::pagemanager.meta_title'),
            'fake' => true,
            'store_in' => 'extras',
            // 'suffix' => ' | Neuly',
            'hint' => '60 characters or less; used for open graph and Twitter title, you should include Neuly in here somewhere'
        ]);
        $this->crud->addField([
            'name' => 'meta_description',
            'label' => trans('backpack::pagemanager.meta_description'),
            'fake' => true,
            'store_in' => 'extras',
            'type' => 'textarea',
            'hint' => 'Google typically truncates to ~155-160 characters'
        ]);
        $this->crud->addField([
            'name' => 'meta_image',
            'label' => 'Meta Image',
            //'fake' => true,
            //'store_in' => 'extras',
            'type' => 'image',
        ]);
    }

    private function seo()
    {

        $this->crud->addField([
            'name' => 'meta_title',
            'label' => trans('backpack::pagemanager.meta_title'),
            'fake' => true,
            'store_in' => 'extras',
            // 'suffix' => ' | Neuly',
            'hint' => '60 characters or less; used for open graph and Twitter title, you should include Neuly in here somewhere'
        ]);

        $this->crud->addField([
            'name' => 'meta_description',
            'type' => 'textarea',
            'label' => trans('backpack::pagemanager.meta_description'),
            'fake' => true,
            'store_in' => 'extras',
            'hint' => 'Google typically truncates to ~155-160 characters'
        ]);

        $this->crud->addField([
            'name' => 'meta_image',
            'label' => 'Meta Image',
            //'fake' => true,
            //'store_in' => 'extras',
            'type' => 'image',
            'crop' => true,
        ]);
    }
}