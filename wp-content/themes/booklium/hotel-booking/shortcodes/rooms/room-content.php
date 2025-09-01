<?php
/**
 *
 * Avaialable variables
 * - bool $isShowGallery
 * - bool $isShowImage
 * - bool $isShowTitle
 * - bool $isShowExcerpt
 * - bool $isShowDetails
 * - bool $isShowPrice
 * - bool $isShowViewButton
 * - bool $isShowBookButton
 *
 * @version 1.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( post_password_required() ) {
	$isShowGallery = $isShowImage = $isShowDetails = $isShowPrice = $isShowViewButton = $isShowBookButton = false;
}
$wrapperClass = apply_filters( 'mphb_sc_rooms_item_wrapper_class', join( ' ', mphb_tmpl_get_filtered_post_class( 'mphb-room-type' ) ) );
?>

<div class="<?php echo esc_attr( $wrapperClass ); ?>">

	<?php do_action( 'mphb_sc_rooms_item_top' ); ?>

    <div class="loop-room-wrapper">
		<?php
		if ( $isShowGallery && mphb_tmpl_has_room_type_gallery() ) {
			?>
            <div class="loop-room-images-wrapper">
				<?php
                booklium_loop_room_categories();
				/**
				 * @hooked \MPHB\Views\LoopRoomTypeView::renderGallery - 10
				 */
				do_action( 'mphb_sc_rooms_render_gallery' );
				?>
            </div>
			<?php
		} else if ( $isShowImage && has_post_thumbnail() ) {
			?>
            <div class="loop-room-images-wrapper">
				<?php
				booklium_loop_room_categories();
				/**
				 * @hooked \MPHB\Views\LoopRoomTypeView::renderFeaturedImage - 10
				 */
				do_action( 'mphb_sc_rooms_render_image' );
				?>
            </div>
			<?php
		}

		if ( $isShowTitle || $isShowExcerpt || $isShowDetails ):
			?>
            <div class="loop-room-info-wrapper">
				<?php

				if ( $isShowTitle ) {
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderTitle - 10
					 */
					do_action( 'mphb_sc_rooms_render_title' );
				}

				if ( $isShowDetails ) {
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderAttributes - 10
					 */
					do_action( 'mphb_sc_rooms_render_short_details' );
				}

				if ( $isShowExcerpt ) {
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderExcerpt - 10
					 */
					do_action( 'mphb_sc_rooms_render_excerpt' );
				}

				if ( $isShowDetails ) {
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderAttributes - 10
					 */
					do_action( 'mphb_sc_rooms_render_details' );
				}

				?>
            </div>
		<?php
		endif;
		if ( $isShowPrice || $isShowViewButton || $isShowBookButton ):
			?>
            <div class="loop-room-book-wrapper">
				<?php
				if ( $isShowPrice ) {
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderPrice - 10
					 */
					do_action( 'mphb_sc_rooms_render_price' );
				}

				if ( $isShowBookButton ) {
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderBookButton - 10
					 */
					do_action( 'mphb_sc_rooms_render_book_button' );
				}

				if ( $isShowViewButton ) {
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderViewDetailsButton - 10
					 */
					do_action( 'mphb_sc_rooms_render_view_button' );
				}
				?>
            </div>
		<?php
		endif;
		?>

    </div>
	<?php
	do_action( 'mphb_sc_rooms_item_bottom' );
	?>

</div>

