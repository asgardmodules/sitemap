<?php
namespace Asgard\Sitemaphtml\Controllers;

class SitemapController extends \Asgard\Core\Controller {
	/**
	@Route('sitemap.html')
	*/
	public function indexAction() {
		$news = array();
		#example
		// foreach(Actualite::all() as $a)
		// 	$news[$a->__toString()] = $a->url();

		$this->sitemap = array(
			'Home'	=>	\Asgard\Core\App::get('url')->to(''),
			#example
			// 'News'	=>	array('_link'=>\Asgard\Core\App::get('url')->to('actualites')) + $news,
		);
	}

	public function showSitemap($sitemap, $name=null) {
		if($name) {
			if(isset($sitemap['_link']))
				echo '<li><a href="'.$sitemap['_link'].'">'.$name.'</a>';
			else
				echo '<li>'.$name;
		}
		unset($sitemap['_link']);
		echo '<ul>'."\n";
		foreach($sitemap as $name=>$item) {
			if(is_array($item))
				$this->showSitemap($item, $name);
			else
				echo '<li><a href="'.$item.'">'.$name.'</a></li>';
		}
		echo '</ul>'."\n";
		if($name)
			echo '</li>';
	}
}