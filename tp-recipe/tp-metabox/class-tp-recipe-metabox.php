<?php
/**
 * Recipe Options Metabox
 *
 * @class       TP_Recipe_Metabox
 * @since       1.0
 * @package     TP Recipe
 * @category    Recipe
 * @author      Theme Palace
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class TP_Recipe_Metabox {

    public function __construct()
    {
        add_action( 'add_meta_boxes', array( $this, 'tp_recipe_options_meta') );
        add_action( 'save_post', array( $this, 'tp_recipe_options_save' ) );
    }

    public function tp_recipe_options_meta( $post_type )
    {
        /**
         * Add meta box
         */
        $post_types = array( 'tp-recipe' );
        if ( in_array( $post_type, $post_types ) ) :
            add_meta_box( 'tp-recipe-class-options', esc_html__( 'Recipe Options', 'tp-recipe' ), array( $this, 'tp_recipe_options' ), $post_types, 'normal', 'high' );
        endif;
    }

    public function tp_recipe_options( $post )
    {
        /**
         * Outputs the content of the meta options
         */
        wp_nonce_field( 'tp_recipe_options_nonce', 'recipe_options_nonce' );
        $tp_recipe_prep = get_post_meta( $post->ID, 'tp_recipe_prep_value', true );
        $recipe_prep = ! empty( $tp_recipe_prep ) ? $tp_recipe_prep : '';
        $tp_recipe_cook = get_post_meta( $post->ID, 'tp_recipe_cook_value', true );
        $recipe_cook = ! empty( $tp_recipe_cook ) ? $tp_recipe_cook : '';
        $tp_recipe_ready = get_post_meta( $post->ID, 'tp_recipe_ready_value', true );
        $recipe_ready = ! empty( $tp_recipe_ready ) ? $tp_recipe_ready : '';
        $tp_recipe_shop_link = get_post_meta( $post->ID, 'tp_recipe_shop_link_value', true );
        $recipe_shop_link = ! empty( $tp_recipe_shop_link ) ? $tp_recipe_shop_link : '';
        ?>

        <div id="tp-recipe-ui-tabs" class="ui-tabs">
            <ul class="tp-recipe-ui-tabs-nav" id="tp-recipe-ui-tabs-nav">
                <li><a href="#frag1"><?php esc_html_e( 'Recipe Details', 'tp-recipe' ); ?></a></li>
                <li><a href="#frag2"><?php esc_html_e( 'Ingredients Details', 'tp-recipe' ); ?></a></li>
            </ul> 
            <div id="frag1" class="catch_ad_tabhead">
                <table id="recipe-details" class="form-table" width="100%">
                    <tbody>
                        <tr>
                            <label class="tp-label" for="tp_recipe_prep_value"><b><?php esc_html_e( 'Preparation Time', 'tp-recipe' ); ?>: </b></label><br>
                            <input type="text" name="tp_recipe_prep_value" id="tp_recipe_prep_id" placeholder="<?php esc_attr_e( '15 mins', 'tp-recipe' ); ?>" value="<?php echo esc_attr( $recipe_prep ); ?>" />

                            <br><br>

                            <label class="tp-label" for="tp_recipe_cook_value"><b><?php esc_html_e( 'Cooking Time', 'tp-recipe' ); ?>: </b></label><br>
                            <input type="text" name="tp_recipe_cook_value" id="tp_recipe_cook_id" placeholder="<?php esc_attr_e( '35 mins', 'tp-recipe' ); ?>" value="<?php echo esc_attr( $recipe_cook ); ?>" />

                            <br><br>

                            <label class="tp-label" for="tp_recipe_ready_value"><b><?php esc_html_e( 'Ready Time', 'tp-recipe' ); ?>: </b></label><br>
                            <input type="text" name="tp_recipe_ready_value" id="tp_recipe_ready_id" placeholder="<?php esc_attr_e( '55 mins', 'tp-recipe' ); ?>" value="<?php echo esc_attr( $recipe_ready ); ?>" />

                            <br><br>

                            <label class="tp-label" for="tp_recipe_shop_link_value"><b><?php esc_html_e( 'Shop Product Link', 'tp-recipe' ); ?>: </b></label><br>
                            <small><i><?php esc_html_e( 'NOTE: Input Url of this product shop page.', 'tp-recipe' ); ?></i></small><br>
                            <input type="url" name="tp_recipe_shop_link_value" placeholder="http://" id="tp_recipe_shop_link_id" value="<?php echo esc_attr( $recipe_shop_link ); ?>" />

                            <br><br>
                            <?php
                            $field_names = array( 'tp_recipe_file' );
                            foreach ( $field_names as $name ) {
                                $value = $rawvalue = get_post_meta( $post->ID, $name, true );
                                $name = esc_attr( $name );
                                $value = esc_attr( $name );
                                echo "<input type='hidden' id='$name-value' class='small-text'       name='tp_recipe_file[$name]' value='$value' />";
                                echo "<input type='button' id='$name' class='button tp-recipe-upload-button' value='Upload File' />";
                                echo "<input type='button' id='$name-remove' class='button tp-recipe-upload-button-remove' value='Remove File' />";
                                $image = ! $rawvalue ? '' : wp_get_attachment_image( $rawvalue, 'thumbnail', false, array('style' => 'max-width:100%;height:auto;') );
                                echo "<div class='image-preview'>$image</div>";
                            }

                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php  

            $tp_recipe_ingr_count = get_post_meta( $post->ID, 'tp_recipe_ingr_count_value', true );
            $recipe_ingr_count = ! empty( $tp_recipe_ingr_count ) ? $tp_recipe_ingr_count : 3;

            ?>

            <div id="frag2" class="catch_ad_tabhead">
                <table id="sidebar-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>
                            <label class="tp-label" for="tp_recipe_ingr_count_value"><b><?php esc_html_e( 'No of Ingredients', 'tp-recipe' ); ?>: </b></label><br>
                            <small><i><?php esc_html_e( 'NOTE: Input number and publish/update the post to get the change.', 'tp-recipe' ); ?></i></small><br>
                            <input type="number" name="tp_recipe_ingr_count_value" id="tp_recipe_ingr_count_id" min="1" max="50" placeholder="<?php esc_attr_e( '3', 'tp-recipe' ); ?>" value="<?php echo esc_attr( $recipe_ingr_count ); ?>" />

                            <br><br>

                            <?php 
                            $posts = get_posts( array( 'post_type' => 'tp-ingredient', 'posts_per_page' => -1 ) );
                            for( $i = 1; $i <= $recipe_ingr_count; $i++ ) : 

                                $tp_recipe_ingr = get_post_meta( $post->ID, 'tp_recipe_ingr_' . $i, true );
                                $recipe_ingr = ! empty( $tp_recipe_ingr ) ? $tp_recipe_ingr : '';
                                $tp_recipe_qty = get_post_meta( $post->ID, 'tp_recipe_ingr_qty_' . $i, true );
                                $recipe_qty = ! empty( $tp_recipe_qty ) ? $tp_recipe_qty : '';
                                ?>
                                <label class="tp-label" for="tp_recipe_ingr_<?php echo $i; ?>"><?php printf( esc_html__( 'Select Ingredient %d', 'tp-recipe' ), $i ) ; ?>: </label><br>
                                <select data-placeholder="Select Ingredient" name="tp_recipe_ingr_<?php echo $i; ?>" class="chosen-select" style="width:350px;" tabindex="2">
                                    <option value=""></option>
                                    <?php foreach( $posts as $query ) {
                                        echo '<option value="' . $query->ID . '" ' . selected( $query->ID, $recipe_ingr ) . '>' . $query->post_title . '</option>';    
                                    } 
                                    wp_reset_postdata();
                                    ?>
                                </select>

                                <br>

                                <label class="tp-label" for="tp_recipe_ingr_qty_<?php echo $i; ?>"><?php printf( esc_html__( 'Quantity %d', 'tp-recipe' ), $i ) ; ?>: </label><br>
                                <input type="text" name="tp_recipe_ingr_qty_<?php echo $i; ?>"  placeholder="<?php esc_attr_e( '3 Tea Spoon', 'tp-recipe' ); ?>" value="<?php echo esc_attr( $recipe_qty ); ?>" />

                                <br><br>
                            <?php endfor; ?>
                        </tr>
                    </tbody>
                </table>        
            </div>

        </div>


        <?php    
    }


    public function tp_recipe_options_save( $post_id )
    {
        /**
         * Saves the mata input value
         */
        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
         
        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['recipe_options_nonce'] ) || !wp_verify_nonce( $_POST['recipe_options_nonce'], 'tp_recipe_options_nonce' ) ) return;
         
        // if our current user can't edit this post, bail
        if( !current_user_can( 'edit_post' ) ) return;
         
        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_recipe_prep_value'] ) ) :
            $value = isset($_POST['tp_recipe_prep_value']) ? $_POST['tp_recipe_prep_value'] : '';
            update_post_meta( $post_id, 'tp_recipe_prep_value', sanitize_text_field( $value ) );   
        endif;   

        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_recipe_cook_value'] ) ) :
            $value = isset($_POST['tp_recipe_cook_value']) ? $_POST['tp_recipe_cook_value'] : '';
            update_post_meta( $post_id, 'tp_recipe_cook_value', sanitize_text_field( $value ) );   
        endif;  

        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_recipe_ready_value'] ) ) :
            $value = isset($_POST['tp_recipe_ready_value']) ? $_POST['tp_recipe_ready_value'] : '';
            update_post_meta( $post_id, 'tp_recipe_ready_value', sanitize_text_field( $value ) );   
        endif; 

        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_recipe_shop_link_value'] ) ) :
            $value = isset($_POST['tp_recipe_shop_link_value']) ? $_POST['tp_recipe_shop_link_value'] : '';
            update_post_meta( $post_id, 'tp_recipe_shop_link_value', esc_url_raw( $value ) );   
        endif; 

        $new_value = array_map( 'intval', $_POST['tp_recipe_file'] ); //sanitize
        foreach ( $new_value as $key => $value ) {
            update_post_meta( $post_id, $key, $value ); //save
        } 

        // Make sure your data is set before trying to save it
        if( isset( $_POST['tp_recipe_ingr_count_value'] ) ) :
            $value = isset($_POST['tp_recipe_ingr_count_value']) ? $_POST['tp_recipe_ingr_count_value'] : 3;
            update_post_meta( $post_id, 'tp_recipe_ingr_count_value', absint( $value ) );   
        endif; 

        $tp_recipe_ingr_count = get_post_meta( $post_id, 'tp_recipe_ingr_count_value', true );
        $recipe_ingr_count = ! empty( $tp_recipe_ingr_count ) ? $tp_recipe_ingr_count : 3;

        for( $i = 1; $i <= $recipe_ingr_count; $i++ ) {
            // Make sure your data is set before trying to save it
            if( isset( $_POST['tp_recipe_ingr_' . $i] ) ) :
                $value = isset($_POST['tp_recipe_ingr_' . $i]) ? $_POST['tp_recipe_ingr_' . $i] : '';
                update_post_meta( $post_id, 'tp_recipe_ingr_' . $i, absint( $value ) );   
            endif;

            // Make sure your data is set before trying to save it
            if( isset( $_POST['tp_recipe_ingr_qty_' . $i] ) ) :
                $value = isset($_POST['tp_recipe_ingr_qty_' . $i]) ? $_POST['tp_recipe_ingr_qty_' . $i] : '';
                update_post_meta( $post_id, 'tp_recipe_ingr_qty_' . $i, sanitize_text_field( $value ) );   
            endif;
        }

    }

}

new TP_Recipe_Metabox();
