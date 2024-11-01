<?php
/**
 * Ingredient Post Type
 *
 * @class       TP_Ingredient_Post_type
 * @since       1.0
 * @package     TP Ingredient
 * @category    Ingredient
 * @author      Theme Palace
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class TP_Ingredient_Post_type {

    public function __construct(){
        add_action( 'init', array( $this, 'tp_ingredient_post_type' ) );
    }

    public function tp_ingredient_post_type() {

        $ingredient_labels = array(
            'name'               => esc_html_x( 'Ingredients', 'post type general name', 'tp-ingredient' ),
            'singular_name'      => esc_html_x( 'Ingredient', 'post type singular name', 'tp-ingredient' ),
            'menu_name'          => esc_html_x( 'Ingredients', 'admin menu', 'tp-ingredient' ),
            'name_admin_bar'     => esc_html_x( 'Ingredient', 'add new on admin bar', 'tp-ingredient' ),
            'add_new'            => esc_html_x( 'Add New', 'Ingredient', 'tp-ingredient' ),
            'add_new_item'       => esc_html__( 'Add New Ingredient', 'tp-ingredient' ),
            'new_item'           => esc_html__( 'New Ingredient', 'tp-ingredient' ),
            'edit_item'          => esc_html__( 'Edit Ingredient', 'tp-ingredient' ),
            'view_item'          => esc_html__( 'View Ingredient', 'tp-ingredient' ),
            'all_items'          => esc_html__( 'All Ingredients', 'tp-ingredient' ),
            'search_items'       => esc_html__( 'Search Ingredients', 'tp-ingredient' ),
            'parent_item_colon'  => esc_html__( 'Parent Ingredients:', 'tp-ingredient' ),
            'not_found'          => esc_html__( 'No Ingredients Found.', 'tp-ingredient' ),
            'not_found_in_trash' => esc_html__( 'No Ingredients Found in Trash.', 'tp-ingredient' )
        );
        $ingredient_args = array(
            'labels'             => $ingredient_labels,
            'description'        => esc_html__( 'Description.', 'tp-ingredient' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'tp-ingredient', 'with_front' => false ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-image-filter',
            'supports'           => array( 'title', 'thumbnail' ),
        );
        register_post_type( 'tp-ingredient', $ingredient_args );

    }
    
}

new TP_Ingredient_Post_type();