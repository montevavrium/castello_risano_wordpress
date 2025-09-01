<?php
/**
 *
 * Avaialable variables
 * - DateTime $checkInDate
 * - DateTime $checkOutDate
 * - int $adults
 * - int $children
 * - bool $isShowGallery
 * - bool $isShowImage
 * - bool $isShowTitle
 * - bool $isShowExcerpt
 * - bool $isShowDetails
 * - bool $isShowPrice
 * - bool $isShowViewButton
 * - bool $isShowBookButton
 *
 * @version 2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	$isShowGallery = $isShowImage = $isShowDetails = $isShowPrice = $isShowViewButton = $isShowBookButton = false;
}

do_action( 'mphb_sc_search_results_before_room' );

$wrapperClass = apply_filters( 'mphb_sc_search_results_room_type_class', join( ' ', mphb_tmpl_get_filtered_post_class( 'mphb-room-type' ) ) );
?>
    <div class="<?php echo esc_attr( $wrapperClass ); ?>">

		<?php do_action( 'mphb_sc_search_results_room_top' ); ?>
        <div class="loop-room-wrapper">
			<?php
			if ( $isShowGallery && mphb_tmpl_has_room_type_gallery() ) {
				?>
                <div class="loop-room-images-wrapper">
					<?php
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderGallery - 10
					 */
					do_action( 'mphb_sc_search_results_render_gallery' );
					?>
                </div>
				<?php
			} else if ( $isShowImage && has_post_thumbnail() ) {
				?>
                <div class="loop-room-images-wrapper">
					<?php
					/**
					 * @hooked \MPHB\Views\LoopRoomTypeView::renderFeaturedImage - 10
					 */
					do_action( 'mphb_sc_search_results_render_image' );
					?>
                </div>
				<?php
			}

			do_action( 'mphb_sc_search_results_before_info' );

			if ( $isShowTitle || $isShowExcerpt || $isShowDetails ) {
				?>
                <div class="loop-room-info-wrapper">
					<?php
					if ( $isShowTitle ) {
						/**
						 * @hooked \MPHB\Views\LoopRoomTypeView::renderTitle - 10
						 */
						do_action( 'mphb_sc_search_results_render_title' );
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
						do_action( 'mphb_sc_search_results_render_excerpt' );
					}

					if ( $isShowDetails ) {
						/**
						 * @hooked \MPHB\Views\LoopRoomTypeView::renderAttributes - 10
						 */
						do_action( 'mphb_sc_search_results_render_details' );
					}
					?>
                </div>
				<?php
			}
			if ( $isShowPrice || $isShowViewButton || $isShowBookButton ) {
				?>
                <div class="loop-room-book-wrapper">
					<?php
					if ( $isShowPrice ) {
						/**
						 * @hooked \MPHB\Views\LoopRoomTypeView::renderPriceForDates - 10
						 */
						do_action( 'mphb_sc_search_results_render_price', $checkInDate, $checkOutDate );
					}

					if ( $isShowViewButton ) {
						/**
						 * @hooked \MPHB\Views\LoopRoomTypeView::renderViewDetailsButton - 10
						 */
						do_action( 'mphb_sc_search_results_render_view_button' );
					}

					if ( $isShowBookButton ) {
						/**
						 * @hooked \MPHB\Views\LoopRoomTypeView::renderBookButton - 10
						 */
						do_action( 'mphb_sc_search_results_render_book_button' );
					}
					?>
                </div>
				<?php
			}
			do_action( 'mphb_sc_search_results_after_info' );
			?>
        </div>
		<?php do_action( 'mphb_sc_search_results_room_bottom' ); ?>

    </div>
<?php
do_action( 'mphb_sc_search_results_after_room' );
