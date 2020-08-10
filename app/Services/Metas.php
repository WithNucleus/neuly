<?php

namespace App\Services;

use App\Models\Page;

class Metas 
{
	/**
	 * Clean up the meta tags values.
	 */
	public static function process($values)
	{
		if(!empty($values['image'])){
			$values['image'] = asset($values['image']);
		}
		if(!empty($values['description']) && strlen($values['description']) > 150){
			$values['description'] = substr($values['description'], 0, 150).'...';
		}
		return $values;
	}

	/**
	 * Allow to get the SEO meta tags from a specific Page.
	 *
	 * @param string Slug
	 * @return array Meta tags
	 */
	public static function fromPage($slug)
	{		
		$page = Page::findBySlug($slug);
		
		$metas = array(
			'page-title' 	=> '',
			'title'			=> '',
			'description' 	=> '',
			'image' 		=> '',
		);

		if(!$page){
			return $metas;
		}

		$metas['page-title'] = $page->title;
		$metas['title'] = $page->extras['meta_title'];
		$metas['description'] = $page->extras['meta_description'];
		$metas['image'] = $page->meta_image;

		return self::process($metas);
	}
}