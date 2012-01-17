<?php 

/**
 * @package DebugConsole
 */

/*
Plugin Name: Wordpress Debug Console
Plugin URI: http://www.sinapsa.co.il
Description: Debug Log console - for working with the debug.log file
Version: 0.1
Author: Elisha Shpiro
Author URI: http://www.sinapsa.co.il
License: GPLv2 or later
*/

function mytheme_admin_bar_render() {
	
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		//'parent' => 'new-content',
		'id' => 'wp-debugger',
		'meta' => array('class' => 'wp-debugger console'),
		'title' => 'Debug Console',
		'href' => false // admin_url( 'media-new.php')
	) );


	// echo WP_PLUGIN_URL . '/wp-debug-console/js/jquery.1.7.1.min.js';

}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );





function register_scripts_n_styles(){
	
	// JvaScript
	wp_register_script('jq-min',    WP_PLUGIN_URL . '/wp-debug-console/js/jquery-1.7.1.min.js', '', '1.7.1', true );
	wp_register_script('jq-ui-min', WP_PLUGIN_URL . '/wp-debug-console/js/jquery-ui-1.8.17.custom.min.js', array('jq-min'), '1.8.17', true );
	wp_register_script('util',    WP_PLUGIN_URL . '/wp-debug-console/js/util.js', '', '', true );
	wp_register_script('onload',    WP_PLUGIN_URL . '/wp-debug-console/js/onload.js', array('jq-min', 'jq-ui-min', 'util'), '0.1', true );
	
	wp_enqueue_script('jq-min');
	wp_enqueue_script('jq-ui-min');
	wp_enqueue_script('util');
	wp_enqueue_script('onload');

	// CSS
	wp_register_style('debugger', WP_PLUGIN_URL . '/wp-debug-console/css/debugger.css');
	wp_register_style('jquery-ui', WP_PLUGIN_URL . '/wp-debug-console/css/jquery-ui-1.8.17.custom.css');
	wp_enqueue_style('debugger');
	wp_enqueue_style('jquery-ui');
}
add_action( 'init', 'register_scripts_n_styles' );




function register_debug_menu(){
	add_menu_page( 'wp-debug-console', 'Debug Console Settings', 'admin', 'debugger', 'debug_dash' );
}

add_action('admin_menu', 'register_debug_menu');













function debug_dash(){
	echo 'This is the debug console settings page';
}
