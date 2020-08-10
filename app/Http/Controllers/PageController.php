<?php

namespace App\Http\Controllers;

//use Backpack\PageManager\app\Models\Page;
use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug, $subs = null)
    {
        $page = Page::findBySlug($slug);

        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
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
