<?php
/**
 * Plugin Name: TP Recipe
 * Plugin URI: http://www.themepalace.com/plugins/tp-recipe
 * Description: This Plugin provides you an Food Item Recipe and it's ingredients forms to uplift your Restaurant Website with your prominent item recipes.
 * Version: 1.1.5
 * Author: Theme Palace
 * Author URI: http://themepalace.com
 * Requires at least: 4.5
 * Tested up to: 6.0
 *
 * Text Domain: tp-recipe
 * Domain Path: /languages/
 *
 * @package TP Recipe
 * @category Core
 * @author Theme Palace
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'TP_Recipe' ) ) :

	final class TP_Recipe {

		public function __construct()
		{
			$this->tp_recipe_constant();
			$this->tp_recipe_includes();
			$this->tp_recipe_hooks();
		}

		public function tp_recipe_constant()
		{
			define( 'TP_RECIPE_BASE_PATH', dirname(__FILE__ ) );
			define( 'TP_RECIPE_URL_PATH', plugin_dir_url(__FILE__ ) );
			define( 'TP_RECIPE_PLUGIN_BASE_PATH', plugin_basename(__FILE__) );
		}

		public static function tp_recipe_install_uninstall_hook()
		{
	        register_activation_hook( TP_RECIPE_URL_PATH, array( 'TP_Recipe', 'TP_Recipe_Rewrite' ) );
	        register_deactivation_hook( TP_RECIPE_URL_PATH, array( 'TP_Recipe', 'TP_Recipe_Rewrite' ) );
	    }

		public function tp_recipe_hooks()
		{
			add_action( 'admin_enqueue_scripts', array( $this, 'tp_recipe_enqueue_scripts' ) );

			// custom template
			add_filter( 'template_include', array( $this, 'tp_recipe_set_template' ) );
		}

		public function tp_recipe_includes()
		{
			/*
			 * Include files
			 */
			require_once( 'tp-post-type/class-tp-recipe.php' );
			require_once( 'tp-post-type/class-tp-ingredient.php' );
			require_once( 'tp-metabox/class-tp-recipe-metabox.php' );
			require_once( 'include/tp-functions.php' );
			require_once( 'templates/template-part/tp-content-single.php' );
			include_once( 'include/tp-rewrite.php' );

		}

		public function tp_recipe_set_template( $template )
		{
			if ( is_post_type_archive( 'tp-recipe' ) || is_tax('tp-recipe-category') ) :
				if ( locate_template( 'tp-recipe/tp-archive-recipe.php' ) != '' )
					$template = locate_template( 'tp-recipe/tp-archive-recipe.php' );
				else
					$template = TP_RECIPE_BASE_PATH . '/templates/tp-archive-recipe.php';
			endif;

			if( is_singular( 'tp-recipe' ) ) :
				if ( locate_template( 'tp-recipe/tp-single-recipe.php' ) != '' )
					$template = locate_template( 'tp-recipe/tp-single-recipe.php' );
				else
					$template = TP_RECIPE_BASE_PATH . '/templates/tp-single-recipe.php';
			endif;

			return $template;
		}

		public function tp_recipe_enqueue_scripts( $hook )
		{
			/*
			 * Enqueue scripts
			 */
	        if( $hook == 'post.php' || $hook == 'post-new.php'  ){
	            //Scripts
	            wp_enqueue_script( 'tp-recipe-metabox', TP_RECIPE_URL_PATH . 'assets/js/metabox.js', array( 'jquery', 'jquery-ui-tabs' ), '' , true );
	            wp_enqueue_script( 'chosen-select', TP_RECIPE_URL_PATH . 'assets/js/chosen.jquery.min.js', array( 'jquery' ), '' , true );
				wp_enqueue_script( 'tp-recipe-custom', TP_RECIPE_URL_PATH . 'assets/js/custom.min.js', array( 'jquery', 'chosen-select' ), '' , true );

				// upload script
				wp_enqueue_media();
				wp_enqueue_script( 'tp-recipe-upload', TP_RECIPE_URL_PATH . 'assets/js/upload.min.js', array( 'jquery' ), '' , true );

	            //CSS Styles
	            wp_enqueue_style( 'tp-recipe-metabox-tabs', TP_RECIPE_URL_PATH . 'assets/css/metabox.min.css' );
	            wp_enqueue_style( 'chosen-select-style', TP_RECIPE_URL_PATH . 'assets/css/chosen.min.css' );
	        }
	        return;
	    }

	}

	new TP_Recipe();

endif;
