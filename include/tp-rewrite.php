<?php
/**
 * TP Recipe Custom Post Type Date Archive rewrite rules
 *
 * @package TP Recipe
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TP_Recipe_Rewrite {

	public function __construct() {
		add_action( 'generate_rewrite_rules', array( $this, 'tp_recipe_rewrite_rules' ) );
	}

	public function tp_recipe_rewrite_rules( $wp_rewrite )
	{
		// recipe rewrite rules
	    // Here we're hardcoding the post type recipe
	    $rules = $this->tp_recipe_generate_date_archives( 'tp-recipe', $wp_rewrite );
	    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
	    return $wp_rewrite;
	}

	private function tp_recipe_generate_date_archives( $input, $wp_rewrite )
	{
		/**
		 * Generate date archive rewrite rules for a given custom post type
		 * @param  string $input slug of the custom post type
		 * @return rules       returns a set of rewrite rules for WordPress to handle
		 */
		
	    $rules = array();

	    $post_type = get_post_type_object( $input );
	    $slug_archive = $post_type->has_archive;
	    if ( $slug_archive === false ) {
	        return $rules;
	    }
	    if ( $slug_archive === true ) {
	        // Here's my edit to the original function, let's pick up
	        // custom slug from the post type object if user has
	        // specified one.
	        $slug_archive = $post_type->rewrite['slug'];
	    }

	    $dates = array(
	        array(
	            'rule' => "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})",
	            'vars' => array('year', 'monthnum', 'day')
	        ),
	        array(
	            'rule' => "([0-9]{4})/([0-9]{1,2})",
	            'vars' => array('year', 'monthnum')
	        ),
	        array(
	            'rule' => "([0-9]{4})",
	            'vars' => array('year')
	        )
	    );

	    foreach ( $dates as $data ) {
	        $query = 'index.php?post_type='.$input;
	        $rule = $slug_archive.'/'.$data['rule'];

	        $i = 1;
	        foreach ( $data['vars'] as $var ) {
	            $query.= '&'.$var.'='.$wp_rewrite->preg_index( $i );
	            $i++;
	        }

	        $rules[$rule."/?$"] = $query;
	        $rules[$rule."/feed/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index( $i );
	        $rules[$rule."/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index( $i );
	        $rules[$rule."/page/([0-9]{1,})/?$"] = $query."&paged=".$wp_rewrite->preg_index( $i );
	    }
	    return $rules;
	}

}

new TP_Recipe_Rewrite();