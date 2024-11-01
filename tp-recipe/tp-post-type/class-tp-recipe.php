<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Recipe Post Type
 *
 * @class       TP_Recipe_Post_type
 * @since       1.0
 * @package     TP recipe
 * @category    Recipe
 * @author      Theme Palace
 */

class TP_Recipe_Post_type {

    public function __construct(){
        add_action( 'init', array( $this, 'tp_recipe_post_type' ) );
    }

    public function tp_recipe_post_type() {

        $recipe_labels = array(
            'name'               => esc_html_x( 'Recipes', 'post type general name', 'tp-recipe' ),
            'singular_name'      => esc_html_x( 'Recipe', 'post type singular name', 'tp-recipe' ),
            'menu_name'          => esc_html_x( 'Recipes', 'admin menu', 'tp-recipe' ),
            'name_admin_bar'     => esc_html_x( 'Recipe', 'add new on admin bar', 'tp-recipe' ),
            'add_new'            => esc_html_x( 'Add New', 'Recipe', 'tp-recipe' ),
            'add_new_item'       => esc_html__( 'Add New Recipe', 'tp-recipe' ),
            'new_item'           => esc_html__( 'New Recipe', 'tp-recipe' ),
            'edit_item'          => esc_html__( 'Edit Recipe', 'tp-recipe' ),
            'view_item'          => esc_html__( 'View Recipe', 'tp-recipe' ),
            'all_items'          => esc_html__( 'All Recipes', 'tp-recipe' ),
            'search_items'       => esc_html__( 'Search Recipes', 'tp-recipe' ),
            'parent_item_colon'  => esc_html__( 'Parent Recipes:', 'tp-recipe' ),
            'not_found'          => esc_html__( 'No Recipes Found.', 'tp-recipe' ),
            'not_found_in_trash' => esc_html__( 'No Recipes Found in Trash.', 'tp-recipe' )
        );
        $recipe_args = array(
            'labels'             => $recipe_labels,
            'description'        => esc_html__( 'Description.', 'tp-recipe' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'tp-recipe', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-carrot',
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        register_post_type( 'tp-recipe', $recipe_args );

        // Add new taxonomy for Recipes
        $recipe_cat_labels = array(
            'name'              => esc_html_x( 'Recipe Categories', 'taxonomy general name', 'tp-recipe' ),
            'singular_name'     => esc_html_x( 'Recipe Category', 'taxonomy singular name', 'tp-recipe' ),
            'search_items'      => esc_html__( 'Search Recipe Categories', 'tp-recipe' ),
            'all_items'         => esc_html__( 'All Recipe Categories', 'tp-recipe' ),
            'parent_item'       => esc_html__( 'Parent Recipe Category', 'tp-recipe' ),
            'parent_item_colon' => esc_html__( 'Parent Recipe Category:', 'tp-recipe' ),
            'edit_item'         => esc_html__( 'Edit Recipe Category', 'tp-recipe' ),
            'update_item'       => esc_html__( 'Update Recipe Category', 'tp-recipe' ),
            'add_new_item'      => esc_html__( 'Add New Recipe Category', 'tp-recipe' ),
            'new_item_name'     => esc_html__( 'New Recipe Category Name', 'tp-recipe' ),
            'menu_name'         => esc_html__( 'Recipe Category', 'tp-recipe' ),
        );

        $recipe_cat_args = array(
            'hierarchical'      => true,
            'labels'            => $recipe_cat_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'tp-recipe-category' ),
        );

        register_taxonomy( 'tp-recipe-category', array( 'tp-recipe' ), $recipe_cat_args );
  
    }
    
}

new TP_Recipe_Post_type();