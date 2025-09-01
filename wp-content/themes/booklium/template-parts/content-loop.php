<?php
/**
 * Template part for displaying posts in loop
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Booklium
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php booklium_post_thumbnail(); ?>

	<?php
	if ( 'post' === get_post_type() && is_sticky() && get_theme_mod( 'booklium_blog_layout', '' ) == 'blog-featured' ) :
	?>
    <div class="sticky-post-content-wrapper">
    <?php
    endif;
    ?>

        <header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) :
				?>
                <div class="entry-meta">
					<?php
					booklium_loop_post_meta();
					?>
                </div><!-- .entry-meta -->
			<?php endif;

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>

        </header><!-- .entry-header -->

        <div class="entry-content">
			<?php
			the_content( sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'booklium' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'booklium' ),
				'after'  => '</div>',
			) );
			?>
        </div><!-- .entry-content -->

    <?php
    if ( 'post' === get_post_type() && is_sticky() && get_theme_mod( 'booklium_blog_layout', '' ) == 'blog-featured' ) :
    ?>
    </div>
    <?php
    endif;
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
