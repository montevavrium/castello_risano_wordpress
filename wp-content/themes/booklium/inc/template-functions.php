<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Booklium
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function booklium_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_home() ) {
		$classes[] = get_theme_mod( 'booklium_blog_layout', '' );
	}

	if ( is_tax() ) {
		$classes[] = 'taxonomy-archive';
	}

	if ( is_admin_bar_showing() ) {
		$classes[] = 'admin-bar-shown';
	}

	$classes[] = get_theme_mod( 'booklium_site_layout', 'site-menu-left' );

	return $classes;
}

add_filter( 'body_class', 'booklium_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function booklium_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'booklium_pingback_header' );

function booklium_comment_callback( $comment, $args, $depth ) {

	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

	$commenter = wp_get_current_commenter();
	if ( $commenter['comment_author_email'] ) {
		$moderation_note = esc_html__( 'Your comment is awaiting moderation.', 'booklium' );
	} else {
		$moderation_note = esc_html__( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.', 'booklium' );
	}

	?>
    <<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'parent' : '', $comment ); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <footer class="comment-meta">
            <div class="comment-author vcard">
				<?php
				if ( 0 != $args['avatar_size'] ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				}

				printf( '<span class="fn">%s</span>', get_comment_author_link( $comment ) );
				?>
            </div><!-- .comment-author -->
        </footer><!-- .comment-meta -->

        <div class="comment-content">
			<?php if ( '0' == $comment->comment_approved ) : ?>
                <em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
			<?php endif; ?>
            <div class="comment-text">
				<?php comment_text(); ?>
            </div>
            <div class="comment-metadata">

				<?php
				if ( class_exists( 'WooCommerce' ) ) {
					woocommerce_review_display_rating();
				}

				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);

				if ( function_exists( 'MPHBR' ) ) {
					$review = MPHBR()->getReviewRepository()->findById( $comment->comment_ID );
					if ( $review ) {
						?>
                        <div class="mphbr-review-rating"><?php echo mphbr_render_rating( $review->getAvgRating() ); ?></div>
						<?php
					}
				}

				?>

                <time class="comment-time" datetime="<?php comment_time( 'c' ); ?>">
					<?php
					/* translators: %s: human-readable comment time difference */
					printf( esc_html_x( '%s ago', '%s: human-readable comment time difference', 'booklium' ), esc_html( human_time_diff( get_comment_time( 'U' ) ) ) );
					?>
                </time>

				<?php edit_comment_link( __( 'Edit', 'booklium' ), '<span class="edit-link">', '</span>' ); ?>

            </div><!-- .comment-metadata -->
        </div><!-- .comment-content -->

    </article><!-- .comment-body -->
	<?php

}

add_filter( 'comment_form_default_fields', 'booklium_comment_form_default_fields' );
function booklium_comment_form_default_fields( $fields ) {

	unset( $fields['url'] );

	return $fields;
}

function booklium_add_ellipses_to_nav( $nav_menu, $args ) {
	if ( 'menu-1' === $args->theme_location && get_theme_mod( 'booklium_site_layout', 'site-menu-left' ) !== 'site-menu-left' ) :
		$nav_menu .= '<div class="primary-menu-more">';
		$nav_menu .= '<ul class="menu">';
		$nav_menu .= '<li class="menu-item menu-item-has-children">';
		$nav_menu .= '<button class="submenu-expand primary-menu-more-toggle is-empty" tabindex="-1" aria-label="' . esc_html__( 'More', 'booklium' ) . '" aria-haspopup="true" aria-expanded="false">';
		$nav_menu .= '<span class="screen-reader-text">' . esc_html__( 'More', 'booklium' ) . '</span>';
		$nav_menu .= '<i class="fas fa-ellipsis-h"></i>';
		$nav_menu .= '</button>';
		$nav_menu .= '<ul class="sub-menu hidden-links">';
		$nav_menu .= '</ul>';
		$nav_menu .= '</li>';
		$nav_menu .= '</ul>';
		$nav_menu .= '</div>';
	endif;

	return $nav_menu;
}

add_filter( 'wp_nav_menu', 'booklium_add_ellipses_to_nav', 10, 2 );

function booklium_render_header_menu_image() {

	global $wp_query;

	if ( get_theme_mod( 'booklium_site_layout', 'site-menu-left' ) == 'site-menu-left'
         && get_theme_mod('booklium_show_menu_image', true) ):
		?>
        <div class="main-navigation-image-wrapper">
            <img class="default-menu-image"
                 src="<?php echo esc_url(get_theme_mod( 'booklium_primary_menu_image', get_template_directory_uri() . '/img/default_menu.jpg' )); ?>"
                 alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
			<?php
			$term         = $wp_query->get_queried_object();
			$term_id      = null;
			$term_name    = null;

			if ( isset( $term->term_id ) ) {
				$term_id   = $term->term_id;
				$term_name = $term->name;
			}

			if ( ( is_singular() && has_post_thumbnail( get_the_ID() ) )
			     || ( function_exists( 'z_taxonomy_image_url' ) && z_taxonomy_image_url( $term_id ) )
			):
				$img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
				$alt_text = get_the_title();
				if ( function_exists( 'z_taxonomy_image_url' ) && z_taxonomy_image_url( $term_id ) ) {
					$img_url  = z_taxonomy_image_url( $term_id );
					$alt_text = $term_name;
				}
				?>
                <img class="menu-image"
                     src="<?php echo esc_url( $img_url ); ?>"
                     alt="<?php echo esc_attr( $alt_text ); ?>">
			<?php
			endif;
			?>
        </div>
	<?php
	endif;
}

function booklium_get_image_url_by_name( $name ) {
	$args = array(
		'post_type'      => 'attachment',
		'name'           => $name,
		'posts_per_page' => 1,
		'post_status'    => 'inherit',
	);

	$_image = get_posts( $args );

	return $_image ? array_pop( $_image ) : null;
}