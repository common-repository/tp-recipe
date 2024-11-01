<?php
/**
 * Functions & Hooks
 *
 * @since       1.0
 * @package     TP Recipe
 * @category    Recipe
 * @author      Theme Palace
 */

// Hooks
add_action( 'tp_recipe_prep_time_action', 'tp_recipe_prep_time', 10 );
add_action( 'tp_recipe_cook_time_action', 'tp_recipe_cook_time', 10 );
add_action( 'tp_recipe_ready_time_action', 'tp_recipe_ready_time', 10 );
add_action( 'tp_recipe_shop_link_action', 'tp_recipe_shop_link', 10 );
add_action( 'tp_recipe_upload_link_action', 'tp_recipe_upload_file', 10 );
add_action( 'tp_recipe_ingredients_action', 'tp_recipe_ingredients', 10 );


if ( ! function_exists( 'tp_recipe_prep_time' ) ) :
	function tp_recipe_prep_time( $post_id = '' ) {
		/*
		 * Output recipe preparation time
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		$tp_recipe_prep = get_post_meta( $post_id, 'tp_recipe_prep_value', true );
        $recipe_prep = ! empty( $tp_recipe_prep ) ? $tp_recipe_prep : '';
        if( !empty ( $recipe_prep ) ) {
        	echo '<span class="time">' . esc_html( $recipe_prep ) . '</span>';
		}
	}
endif;

if ( ! function_exists( 'tp_recipe_cook_time' ) ) :
	function tp_recipe_cook_time( $post_id = '' ) {
		/*
		 * Output recipe cooking time
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		$tp_recipe_cook = get_post_meta( $post_id, 'tp_recipe_cook_value', true );
        $recipe_cook = ! empty( $tp_recipe_cook ) ? $tp_recipe_cook : '';
        if( !empty ( $recipe_cook ) ) {
        	echo '<span class="time">' . esc_html( $recipe_cook ) . '</span>';
		}
	}
endif;

if ( ! function_exists( 'tp_recipe_ready_time' ) ) :
	function tp_recipe_ready_time( $post_id = '' ) {
		/*
		 * Output recipe ready time
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		$tp_recipe_ready = get_post_meta( $post_id, 'tp_recipe_ready_value', true );
        $recipe_ready = ! empty( $tp_recipe_ready ) ? $tp_recipe_ready : '';
        if( !empty ( $recipe_ready ) ) {
        	echo '<span class="time">' . esc_html( $recipe_ready ) . '</span>';
		}
	}
endif;

if ( ! function_exists( 'tp_recipe_shop_link' ) ) :
	function tp_recipe_shop_link( $post_id = '' ) {
		/*
		 * Output recipe product shop link
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		$tp_recipe_shop_link = get_post_meta( $post_id, 'tp_recipe_shop_link_value', true );
        $recipe_shop_link = ! empty( $tp_recipe_shop_link ) ? $tp_recipe_shop_link : '';
        if( !empty ( $recipe_shop_link ) ) { 

        	echo '<a href="' . esc_url( $recipe_shop_link ) . '" target="_blank"><i class="fa fa-shopping-basket"></i>' . esc_html__( 'Buy Now','tp-recipe' ) .'</a>';
    	}
	}
endif;

if ( ! function_exists( 'tp_recipe_upload_file' ) ) :
	function tp_recipe_upload_file( $post_id = '' ) {
		/*
		 * Output recipe product shop link
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		$tp_recipe_upload_file = get_post_meta( $post_id, 'tp_recipe_file', true );
		$tp_recipe_upload_file = wp_get_attachment_url( $tp_recipe_upload_file);
        $recipe_upload_link = ! empty( $tp_recipe_upload_file ) ? $tp_recipe_upload_file : '';
        if( !empty ( $recipe_upload_link ) ) { 

        	echo '<a href="' . esc_url( $recipe_upload_link ) . '"><i class="fa fa-folder-open"></i>' . esc_html__( 'Save File','tp-recipe' ) .'</a>';
    	}
	}
endif;

if ( ! function_exists( 'tp_recipe_ingredients' ) ) :
	function tp_recipe_ingredients( $post_id = '' ) {
		/*
		 * Output recipe ingredients and its quantity
		 */
		if ( empty( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		$tp_recipe_ingr_count = get_post_meta( $post_id, 'tp_recipe_ingr_count_value', true );
        $recipe_ingr_count = ! empty( $tp_recipe_ingr_count ) ? $tp_recipe_ingr_count : 3;
        
        $ingredients 	= array();
        $quantity 		= array();

        for ( $i = 1; $i <= $recipe_ingr_count; $i++ ) {
        	$tp_recipe_ingr = get_post_meta( $post_id, 'tp_recipe_ingr_' . $i, true );
        	$tp_recipe_qty = get_post_meta( $post->ID, 'tp_recipe_ingr_qty_' . $i, true );
        	$recipe_qty = ! empty( $tp_recipe_qty ) ? $tp_recipe_qty : '';
        	if ( ! empty( $tp_recipe_ingr ) ) {
        		$ingredients[] 	= $tp_recipe_ingr;
        		$quantity[]		= $recipe_qty;
        	}
        }
        if( ! empty( $ingredients ) ){
        	$args = array(
        		'post_type'	=> 'tp-ingredient',
        		'post__in'	=> $ingredients,
        		'orderby'	=> 'post__in',	
        		'posts_per_page' => count( $ingredients ),
        	);
    	}
        if( ! empty( $args ) ){
	        $posts = get_posts( $args );

	        $i = 0;
	        foreach ( $posts as $query ) :
	        	if ( has_post_thumbnail( $query->ID ) ) {
	                $img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $query->ID ), 'thumbnail' );
	            } else {
	                $img_url[0] =  TP_RECIPE_URL_PATH .'/assets/uploads/no-featured-image-200x200.jpg';
	            }
	            ?>
	            <div class="slider-item">
	                <img src="<?php echo esc_url( $img_url[0] ); ?>" alt="<?php esc_attr( get_the_title( $query->ID ) ); ?>">
	                <div class="ingredient-contents">
	                  <h4><?php echo esc_html( get_the_title( $query->ID ) ); ?></h4>
	                  <span><?php echo esc_html( $quantity[$i] ); ?></span>
	                </div><!-- end .tasty-contents -->
	            </div><!-- end .tasty-item -->

	            <?php $i++;
	    	endforeach;
	    }
	}
endif;

if( ! function_exists( 'tp_recipe_post_type_date_link' ) ):
	/**
	 * This allows us to generate any archive link - plain, yearly, monthly, daily
	 * 
	 * @param string $post_type
	 * @param int $year
	 * @param int $month (optional)
	 * @param int $day (optional)
	 * @return string
	 */
	function tp_recipe_post_type_date_link( $post_type, $year, $month = 0, $day = 0 ) {
	    global $wp_rewrite;
	    $post_type_obj = get_post_type_object( $post_type );
	    $post_type_slug = $post_type_obj->rewrite['slug'] ? $post_type_obj->rewrite['slug'] : $post_type_obj->name;
	    if( $day ) { // day archive link
	        // set to today's values if not provided
	        if ( !$year )
	            $year = gmdate( 'Y', current_time( 'timestamp' ) );
	        if ( !$month )
	            $month = gmdate( 'm', current_time( 'timestamp' ) );
	        $link = $wp_rewrite->get_day_permastruct();
	    } else if ( $month ) { // month archive link
	        if ( !$year )
	            $year = gmdate( 'Y', current_time( 'timestamp' ) );
	        $link = $wp_rewrite->get_month_permastruct();
	    } else { // year archive link
	        $link = $wp_rewrite->get_year_permastruct();
	    }
	    if ( !empty($link) ) {
	        $link = str_replace( '%year%', $year, $link );
	        $link = str_replace( '%monthnum%', zeroise( intval( $month ), 2 ), $link );
	        $link = str_replace('%day%', zeroise( intval( $day ), 2 ), $link );
	        return home_url( "$post_type_slug$link" );
	    }
	    return home_url( "$post_type_slug" );
	}
endif;