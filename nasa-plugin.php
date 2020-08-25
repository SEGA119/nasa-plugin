<?php

/*
Plugin Name: NASA Plugin
Plugin URI: ---
Description: Test plugin to create NASA gallery on your website.
Version: 0.1
Author: Sergey Shumakov
Author URI: https://github.com/SEGA119
License: GPLv2 or later
Text Domain: nasa-plugin
*/

namespace NasaPlugin;

/**
 * Define plugin main constans
 */
define( 'NASA_PLUGIN_VERSION', '0.1' );
define( 'NASA_PLUGIN__MINIMUM_WP_VERSION', '5.0' );
define( 'NASA__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NASA__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'NASA__PLUGIN_VIEW', NASA__PLUGIN_DIR . '/views/' );

/**
 * Register base plugin hooks
 */
register_activation_hook( __FILE__, array( 'NasaPlugin\Plugin', 'activation' ) );
register_deactivation_hook( __FILE__, array( 'NasaPlugin\Plugin', 'deactivation' ) );
register_uninstall_hook( __FILE__, array( 'NasaPlugin\Plugin', 'uninstall' )  );

/**
 * Including helpfull functions
 */
require_once( NASA__PLUGIN_DIR . '/helpers/dates.php' );
require_once( NASA__PLUGIN_DIR . '/helpers/media.php' );

/**
 * Including all important classes
 */
require_once( NASA__PLUGIN_DIR . '/classes/Cron.php' );
require_once( NASA__PLUGIN_DIR . '/classes/Options.php' );
require_once( NASA__PLUGIN_DIR . '/classes/Shortcodes.php' );
require_once( NASA__PLUGIN_DIR . '/classes/RequestProvider.php' );
require_once( NASA__PLUGIN_DIR . '/classes/Plugin.php' );
require_once( NASA__PLUGIN_DIR . '/classes/Repository.php' );

/** 
 * Initialize plugin
 */
Plugin::init();
