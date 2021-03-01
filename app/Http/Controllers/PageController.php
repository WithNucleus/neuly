<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function index($slug, $subs = null)
    {
        $page = Page::findBySlugOrFail($slug);

        if (view()->exists('pages.' . $page->template) === false) {
            abort(404);
        }

        $this->data['page-title'] = $page->title;
        $this->data['page'] = $page->withFakes();

        $this->data['metas'] = array(
            'title'         => $page->extras['meta_title'],
            'description'   => $page->extras['meta_description'],
            'image'         => $page->meta_image,
        );

        return view('pages.'.$page->template, $this->data);
    }
}
