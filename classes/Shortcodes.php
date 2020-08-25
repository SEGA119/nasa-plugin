<?php

namespace NasaPlugin;

class Shortcodes 
{

	public static function init() {
		
		add_shortcode( 'nasa-gallery-carousel', array('NasaPlugin\Shortcodes', 'shortcode_gallery_carousel') );
		
	}
	
	public static function shortcode_gallery_carousel( $atts, $content = null ) {
		
		$repository = new Repository();
		$posts_array = $repository->last(5);
		
		include NASA__PLUGIN_VIEW . 'gallery-carousel.php';		

	}
	
	
}