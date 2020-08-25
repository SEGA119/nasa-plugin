<?php

namespace NasaPlugin;

class Cron 
{
	
	public static function job() {
		
		$date = get_current_date();
		
		if( $date == get_option('nasa_plugin_last_date') ) 
			return FALSE;
		
		$repository = new Repository();
		$requestProvider = new RequestProvider();
		
		if( $post_args = $requestProvider->getPictureOfTheDay( $date ) ) {
			
			$repository->create($post_args);
			update_option('nasa_plugin_last_date', $date);

		}
		
	}
	
	public static function init() {
		
		add_action( 'nasa_gallery_sync', array( 'NasaPlugin\Cron', 'job' ), 10 );		
		
	}
	
	public static function activate() {
		
		if( !wp_next_scheduled('nasa_gallery_sync' ) )
			wp_schedule_event( time(), 'daily', 'nasa_gallery_sync' );		
		
	}
	
	public static function deactivate() {
		
		wp_clear_scheduled_hook('nasa_gallery_sync');
		
	}
	
}