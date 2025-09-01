<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Booklium
 */

if ( ! function_exists( 'booklium_loop_post_meta' ) ) :
	function booklium_loop_post_meta() {

		if ( is_sticky() ):
			?>
            <span class="featured"><?php echo esc_html__( 'Featured', 'booklium' ); ?></span>
		<?php
		endif;

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>'; // WPCS: XSS OK.

		$categories_list = get_the_category_list( esc_html__( ', ', 'booklium' ) );
		if ( $categories_list ) {
			printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
		}

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'booklium' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);

	}
endif;

if ( ! function_exists( 'booklium_single_post_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function booklium_single_post_meta() {


		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			if ( is_sticky() ):
				?>
                <span class="featured"><?php echo esc_html__( 'Featured', 'booklium' ); ?></span>
			<?php
			endif;
			?>
            <span class="byline">
                <span class="author vcard">
                    <i class="fas fa-feather-alt"></i>
                    <a class="url fn n"
                       href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                        <?php echo esc_html( get_the_author() ); ?></a>
                </span>
            </span>
			<?php

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( DATE_W3C ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( DATE_W3C ) ),
				esc_html( get_the_modified_date() )
			);

			echo '<span class="posted-on"><i class="far fa-calendar"></i>' . $time_string . '</span>'; // WPCS: XSS OK.

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'booklium' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				echo '<span class="cat-links"><i class="far fa-bookmark"></i>' . $categories_list . '</span>'; // WPCS: XSS OK.
			}

		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="far fa-comments"></i>';
			comments_popup_link(
				sprintf(
					wp_kses(
					/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'booklium' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'booklium' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link"><i class="far fa-edit"></i>',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'booklium_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param $size
	 *
	 */
	function booklium_post_thumbnail( $size = 'post-thumbnail' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

            <div class="post-thumbnail">
				<?php the_post_thumbnail( $size ); ?>
            </div><!-- .post-thumbnail -->

		<?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail( $size, array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					) ),
				) );
				?>
            </a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'booklium_posts_pagination' ) ):
	function booklium_posts_pagination() {
		the_posts_pagination( array(
			'mid_size'  => 1,
			'prev_text' => esc_html__( 'Previous', 'booklium' ),
			'next_text' => esc_html__( 'Next', 'booklium' ),
		) );
	}
endif;

if ( ! function_exists( 'booklium_single_post_footer' ) ) :

	function booklium_single_post_footer() {

		$tags_list = get_the_tag_list( '', '' );
		if ( $tags_list ) :
			?>
            <footer class="entry-footer">
				<?php
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><span class="tags-links-title">' . esc_html__( 'Tags:', 'booklium' ) . '</span>%1$s</span>', $tags_list ); // WPCS: XSS OK.
				?>
            </footer>
		<?php
		endif;

	}

endif;

if ( ! function_exists( 'booklium_the_post_navigation' ) ) {
	function booklium_the_post_navigation() {

		if ( ! apply_filters( 'booklium_show_post_navigation', false ) ) {
			return;
		}

		if ( ! ! ! get_next_post() && ! ! ! get_previous_post() ) {
			return;
		}

		$class = "";
		if ( ! ! ! get_next_post() || ! ! ! get_previous_post() ) {
			$class = "has-one-link";
		};
		?>
        <div class="post-navigation-wrapper <?php echo esc_attr( $class ); ?>">
			<?php
			the_post_navigation( array(
				'next_text' => '<span class="arrow"></span>' .
				               '<span class="post-title">%title</span>',
				'prev_text' => '<span class="arrow"></span>' .
				               '<span class="post-title">%title</span>'
			) );
			?>
        </div>
		<?php
	}
}