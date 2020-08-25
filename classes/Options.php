<?php

namespace NasaPlugin;

class Options
{
	
	public static function enqueue() {
				
		add_action( 'wp_enqueue_scripts', function() {
			
			wp_enqueue_style( 'slick-style', NASA__PLUGIN_URL . 'assets/css/slick.css' );
			wp_enqueue_style( 'slick-theme-style', NASA__PLUGIN_URL . 'assets/css/slick-theme.css');
			wp_enqueue_style( 'nasa-gallery-style', NASA__PLUGIN_URL . 'assets/css/styles.css' );

			if( !version_compare( $GLOBALS['wp_version'], '5.5', '<' ) ) {
				wp_enqueue_script('jquery');
			}
						
			wp_enqueue_script( 'slick-script', NASA__PLUGIN_URL . 'assets/js/slick.min.js', 'jquery', '1.0', TRUE );
			wp_enqueue_script( 'nasa-script', NASA__PLUGIN_URL . 'assets/js/functions.js', 'jquery', NASA_PLUGIN_VERSION, TRUE );
			
		});
		
	}
	
	public static function image_sizes() {
		
		add_image_size('nasa_thumb', 500, 300, TRUE);
		
	}

	public static function init() {
		
		self::enqueue();
		self::image_sizes();
		
	}
	
}