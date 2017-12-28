<?php
/*
	Plugin Name: CPT Shortcode
	Description: A plugin to generate shortcode to display Custom Post Type listing wherever needed.
	Author: Anurag Deshmukh
	Author URI: https://profiles.wordpress.org/anuragdeshmukh/
	Version: 1.0

*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* Constants */

/* Set plugin version constant. */
define( 'AD_CPTS_BASE_VERSION', '1.0.0' );

/* Set constant path to the plugin directory. */
define( 'AD_CPTS_BASE_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );

/* Set the constant path to the plugin directory URI. */
define( 'AD_CPTS_BASE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

define('AD_CPTS_PLUGIN_LINK', plugins_url('', __FILE__));

/* Includes */
require_once( AD_CPTS_BASE_PATH . 'includes/functions.php' );

/* CPT Shortcode Generator */
if( is_admin() ){
	require_once( AD_CPTS_BASE_PATH . 'includes/cpt-class.php' );
}

/* Functions */

function ad_cpts_load_scripts($hook) {
	wp_enqueue_style( 'cpts_custom_css', AD_CPTS_PLUGIN_LINK. '/assets/css/main.css' );
	wp_enqueue_script( 'cpts_custom_js', AD_CPTS_PLUGIN_LINK. '/assets/js/custom.js', array('jquery'), null, true );
}
add_action( 'admin_enqueue_scripts', 'ad_cpts_load_scripts' );

/* Enqueue Script */
add_action( 'wp_enqueue_scripts', 'ad_cpts_front_end_scripts' );

/**
 * Frontend Scripts
 * @since 1.0.0
 */
function ad_cpts_front_end_scripts(){
	if( is_page() ) {
		wp_enqueue_style( 'cpts_front_css', AD_CPTS_PLUGIN_LINK. '/assets/css/front.css' );
	}
}
