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
		?>
    </header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
