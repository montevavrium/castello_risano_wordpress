<?php
/**
 * The template for displaying room type category archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Booklium
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

			<?php if ( have_posts() ) :

				$class = '';
				if ( function_exists( 'z_taxonomy_image_url' ) && z_taxonomy_image_url() ) {
					$class = 'has-image';
				}

				?>
                <header class="page-header <?php echo esc_attr( $class ); ?>">
                    <div class="page-info-wrapper">
                        <h1 class="page-title"><?php single_term_title(); ?></h1>
						<?php
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
                    </div>

					<?php
					if ( function_exists( 'z_taxonomy_image_url' ) && z_taxonomy_image_url() ) :
						?>
                        <div class="page-image">
                            <img src="<?php echo esc_url( z_taxonomy_image_url() ); ?>"
                                 alt="<?php echo esc_attr( get_the_archive_title() ); ?>">
                        </div>
					<?php
					endif;
					?>
                </header><!-- .page-header -->

                <div class="taxonomy-items-wrapper">
                    <div class="taxonomy-items-inner-wrapper">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content-taxonomy', get_post_type() );

						endwhile;
						?>
                    </div>
                </div>
				<?php

				booklium_posts_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
