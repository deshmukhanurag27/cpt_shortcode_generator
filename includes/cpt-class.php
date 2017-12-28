<?php
/**
 * CPT Shortcode Generator 
 * @since 1.0.0
 * @author Anurag Deshmukh
 * @copyright Copyright (c) 2017, Anurag Deshmukh
**/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists('AD_CPTS_Shortcode_Generator') ) :

	class AD_CPTS_Shortcode_Generator
	{
		
		function __construct()
		{
			if (is_admin()) {
				add_action('admin_menu',array(&$this,'ad_cpts_admin_settings'));
				add_action( 'wp_loaded', 'ad_cpts_get_post_types');
				add_filter('widget_text', 'do_shortcode');
			}
		}

		public function ad_cpts_admin_settings()
		{
			add_menu_page('CPT Shortcode','CPT Shortcode','manage_options','cpt_menu_page',array($this,'ad_cpts_add_cpt_menu_page'),'dashicons-welcome-widgets-menus', 6);
		}

		public function ad_cpts_add_cpt_menu_page()
		{
			include('shortcode-form.php');
		}
		public function ad_cpts_get_post_types()
		{
			return get_post_types();
		}
	} // endclass
endif;

$cpt = new AD_CPTS_Shortcode_Generator();