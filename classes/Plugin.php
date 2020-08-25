<?php 

namespace NasaPlugin;

class Plugin 
{
	
	public static function activation() {
		
		if( !get_option('nasa_plugin_last_date') )
			self::load_data();
		
		Cron::activate();
				
	}
	
	public static function deactivation() {
		
	}
	
	public static function uninstall() {
		
		delete_option('nasa_plugin_last_date');
		Repository::init();
		Repository::destroy();
		
	}
	
	public static function init() {
				
		Options::init();
		Repository::init();
		Shortcodes::init();
		Cron::init();

	}
	
	private static function load_data() {
		
		$dates = get_last_five_dates();
		
		$repository = new Repository();
		$requestProvider = new RequestProvider();
		
		foreach( $dates as $date ) {
			
			if( $post_args = $requestProvider->getPictureOfTheDay( $date ) ) {
				
				$repository->create($post_args);
		
			}						
			
		}		
		
		update_option('nasa_plugin_last_date', get_current_date());
		
	}
	
}