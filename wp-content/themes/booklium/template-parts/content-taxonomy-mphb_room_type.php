<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Booklium
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ( has_post_thumbnail() ):
		?>
        <div class="post-thumbnail-wrapper">
            <div class="room-meta-wrapper">
				<?php
				booklium_loop_room_categories();
				?>
            </div>
			<?php
			booklium_post_thumbnail( 'booklium-square' );
			?>
        </div>
	<?php
	endif;
	?>

    <header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		do_action('mphb_sc_rooms_render_short_details');

		mphb_tmpl_the_room_type_default_price();

		?>
    </header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
