<?php
/**
 * The template for displaying all single recipe posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 * @subpackage TP Recipe
 * @since TP Recipe 1.0
 */

get_header(); ?>
	<div class="wrapper page-section">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
				/**
				 * tp_recipe_article_hook hook.
				 *
				 * @hooked tp_recipe_article - 10
				 */
				do_action( 'tp_recipe_article_hook' );

				the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .wrapper/.page-section-->

<?php
get_sidebar();
get_footer();
