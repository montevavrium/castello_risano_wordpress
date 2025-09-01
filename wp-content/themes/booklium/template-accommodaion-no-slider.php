<?php
/**
 * The template for displaying single accommodations without slider
 *
 * Template Name: Without Slider
 * Template Post Type: mphb_room_type
 *
 * @package Booklium
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content-mphb_room_type', 'no-slider');

				booklium_the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;


			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();