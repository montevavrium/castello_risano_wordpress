<?php

function booklium_mphb_scripts() {
	wp_enqueue_style( 'booklium-mphb', get_template_directory_uri() . '/css/hotel-booking.css', array(), booklium_get_theme_version() );
}

add_action( 'wp_enqueue_scripts', 'booklium_mphb_scripts' );

add_filter( 'mphb_loop_room_type_gallery_use_nav_slider', 'booklium_remove_mphb_nav_gallery' );
function booklium_remove_mphb_nav_gallery() {
	return false;
}

add_filter( 'mphb_loop_room_type_thumbnail_size', 'booklium_loop_room_type_gallery_image_size' );
add_filter( 'mphb_loop_room_type_gallery_main_slider_image_size', 'booklium_loop_room_type_gallery_image_size' );
function booklium_loop_room_type_gallery_image_size() {
	return 'booklium-square';
}


remove_action( 'mphb_render_single_room_type_metas', array( '\MPHB\Views\SingleRoomTypeView', 'renderGallery' ), 10 );
add_action( 'mphb_render_single_room_type_metas', 'booklium_render_single_room_attributes_wrapper_open', 15 );
add_action( 'mphb_render_single_room_type_metas', 'booklium_render_single_room_attributes_wrapper_close', 25 );

function booklium_render_single_room_attributes_wrapper_open() {
	?>
    <div class="single-room-attributes-wrapper">
	<?php
}

function booklium_render_single_room_attributes_wrapper_close() {
	?>
    </div>
	<?php
}

add_action( 'mphb_render_single_room_type_metas', 'booklium_render_single_room_calendar_wrapper_open', 35 );
add_action( 'mphb_render_single_room_type_metas', 'booklium_render_single_room_calendar_wrapper_close', 45 );

function booklium_render_single_room_calendar_wrapper_open() {
	?>
    <div class="single-room-calendar-wrapper">
	<?php
}

function booklium_render_single_room_calendar_wrapper_close() {
	?>
    </div>
	<?php
}

remove_action( 'mphb_render_single_room_type_metas', array(
	'\MPHB\Views\SingleRoomTypeView',
	'renderDefaultOrForDatesPrice'
), 30 );
add_action( 'mphb_render_single_room_type_metas', 'booklium_render_single_room_form_wrapper_open', 45 );
add_action( 'mphb_render_single_room_type_metas', array(
	'\MPHB\Views\SingleRoomTypeView',
	'renderDefaultOrForDatesPrice'
), 47 );
add_action( 'mphb_render_single_room_type_metas', 'booklium_render_single_room_form_wrapper_close', 55 );

function booklium_render_single_room_form_wrapper_open() {
	?>
    <div class="single-room-form-container">
    <div class="single-room-form-wrapper">
	<?php
}

function booklium_render_single_room_form_wrapper_close() {
	?>
    </div>
    </div>
	<?php
}

add_action( 'booklium_render_single_room_gallery', 'booklium_before_single_room_type_gallery', 5 );
add_action( 'booklium_render_single_room_gallery', 'booklium_single_room_type_gallery_wrapper_open', 7 );
add_action( 'booklium_render_single_room_gallery', array( '\MPHB\Views\LoopRoomTypeView', 'renderGallery' ), 10 );
add_action( 'booklium_render_single_room_gallery', 'booklium_single_room_type_gallery_wrapper_close', 13 );
add_action( 'booklium_render_single_room_gallery', 'booklium_after_single_room_type_gallery', 15 );

function booklium_before_single_room_type_gallery() {
	add_filter( 'mphb_loop_room_type_gallery_main_slider_flexslider_options', 'booklium_single_room_gallery_params' );
	add_filter( 'mphb_loop_room_type_gallery_main_slider_image_size', 'booklium_single_room_type_gallery_size' );
	add_filter( 'mphb_loop_room_type_gallery_main_slider_image_link', 'booklium_single_room_type_gallery_link' );
}

function booklium_after_single_room_type_gallery() {
	remove_filter( 'mphb_loop_room_type_gallery_main_slider_flexslider_options', 'booklium_single_room_gallery_params' );
	remove_filter( 'mphb_loop_room_type_gallery_main_slider_image_size', 'booklium_single_room_type_gallery_size' );
	remove_filter( 'mphb_loop_room_type_gallery_main_slider_image_link', 'booklium_single_room_type_gallery_link' );
}

function booklium_single_room_gallery_params( $params ) {
	$params['minItems']   = 1;
	$params['maxItems']   = 3;
	$params['itemWidth']  = 396;
	$params['itemMargin'] = 20;
	$params['controlNav'] = true;

	return $params;
}

function booklium_single_room_type_gallery_link() {

	if ( MPHB()->settings()->main()->isUseSingleRoomTypeGalleryMagnific() ) {
		return 'file';
	}

	return 'none';
}

function booklium_single_room_type_gallery_size() {
	return 'booklium-square';
}

function booklium_single_room_type_gallery_wrapper_open() {
	?>
    <div class="single-room-gallery">
	<?php
}

function booklium_single_room_type_gallery_wrapper_close() {
	?>
    </div>
	<?php
}

remove_action( 'mphb_render_loop_room_type_before_attributes', array( '\MPHB\Views\LoopRoomTypeView',	'_renderAttributesTitle' ), 10 );
remove_action( 'mphb_render_loop_room_type_attributes', array( '\MPHB\Views\LoopRoomTypeView', 'renderTotalCapacity' ), 5 );
remove_action( 'mphb_render_loop_room_type_attributes', array( '\MPHB\Views\LoopRoomTypeView', 'renderAdults' ), 10 );
remove_action( 'mphb_render_loop_room_type_attributes', array( '\MPHB\Views\LoopRoomTypeView', 'renderChildren' ), 20 );
remove_action( 'mphb_render_loop_room_type_attributes', array(	'\MPHB\Views\LoopRoomTypeView',	'renderFacilities' ), 30 );
remove_action( 'mphb_render_loop_room_type_attributes', array( '\MPHB\Views\LoopRoomTypeView', 'renderSize' ), 50 );

add_action( 'mphb_render_loop_room_type_attributes', array( '\MPHB\Views\LoopRoomTypeView', 'renderFacilities' ), 75 );

add_action( 'mphb_sc_rooms_render_short_details', 'booklium_loop_room_short_details_before', 10 );
add_action( 'mphb_sc_rooms_render_short_details', 'booklium_render_room_short_rating', 20 );
add_action( 'mphb_sc_rooms_render_short_details', array( '\MPHB\Views\LoopRoomTypeView', 'renderTotalCapacity' ), 25 );
add_action( 'mphb_sc_rooms_render_short_details', array( '\MPHB\Views\LoopRoomTypeView', 'renderAdults' ), 30 );
add_action( 'mphb_sc_rooms_render_short_details', array( '\MPHB\Views\LoopRoomTypeView', 'renderChildren' ), 40 );
add_action( 'mphb_sc_rooms_render_short_details', array( '\MPHB\Views\LoopRoomTypeView', 'renderSize' ), 50 );
add_action( 'mphb_sc_rooms_render_short_details', 'booklium_loop_room_short_details_after', 60 );

function booklium_loop_room_short_details_before() {
	?>
    <ul class="loop-room-short-attributes">
	<?php
}

function booklium_loop_room_short_details_after() {
	?>
    </ul>
	<?php
}

add_action( 'mphb_sc_rooms_before_loop', 'booklium_loop_rooms_wrapper_open', 2 );
function booklium_loop_rooms_wrapper_open() {
	?>
    <div class="loop-rooms-wrapper">
	<?php
}

add_action( 'mphb_sc_rooms_after_loop', 'booklium_loop_rooms_wrapper_close', 2 );
function booklium_loop_rooms_wrapper_close() {
	?>
    </div>
	<?php
}

function booklium_loop_room_categories() {
	echo get_the_term_list( get_the_ID(), 'mphb_room_type_category', '<div class="loop-room-categories">', ' ', '</div>' );
}

remove_action( 'mphb_sc_search_render_form_top', array( '\MPHB\Views\GlobalView', 'renderRequiredFieldsTip' ) );

add_filter( 'mphb_pagination_args', 'booklium_rooms_pagination_atts' );
function booklium_rooms_pagination_atts( $atts ) {

	$atts['prev_text'] = esc_html__( 'Previous', 'booklium' );
	$atts['next_text'] = esc_html__( 'Next', 'booklium' );

	return $atts;
}

function booklium_mphbr_list_comments_args_filter( $args ) {
	$args['callback']    = 'booklium_comment_callback';
	$args['avatar_size'] = 70;

	return $args;
}

add_filter( 'mphbr_list_comments_args', 'booklium_mphbr_list_comments_args_filter' );

add_action( 'mphb_render_single_room_type_metas', 'booklium_render_room_rating', 48 );
function booklium_render_room_rating() {
	if ( ! function_exists( 'MPHBR' ) ) {
		return;
	}
	$roomTypeId       = MPHB()->getCurrentRoomType()->getId();
	$rating           = MPHBR()->getRatingManager()->getGlobalRating( $roomTypeId );
	$maxRating        = MPHBR()->getSettings()->main()->getMaxRating();
	$ratingPercentage = $rating / $maxRating * 100;
	$formattedRating  = number_format( $rating, 2, '.', '' );

	if ( MPHBR()->getRatingManager()->getGlobalRatingsCount( $roomTypeId ) == 0 ) {
		return;
	}
	?>
    <div class="single-room-rating">
        <a href="<?php comments_link(); ?>">
            <span class="room-star-rating">
                <span class="rating" style="<?php echo esc_attr( "width: {$ratingPercentage}%;" ); ?>"></span>
            </span>
            <span class="average-rating">
                <?php
                echo esc_html( $formattedRating );
                ?>
            </span>
        </a>
    </div>
	<?php
}

function booklium_render_room_short_rating() {
	if ( ! function_exists( 'MPHBR' ) ) {
		return;
	}
	$roomTypeId      = MPHB()->getCurrentRoomType()->getId();
	$rating          = MPHBR()->getRatingManager()->getGlobalRating( $roomTypeId );
	$formattedRating = number_format( $rating, 2, '.', '' );

	if ( MPHBR()->getRatingManager()->getGlobalRatingsCount( $roomTypeId ) == 0 ) {
		return;
	}
	?>
    <li class="mphb-room-type-rating">
        <span class="mphb-attribute-title mphb-rating-title"><?php echo esc_html__('Rating:', 'booklium');?></span>
        <span class="mphb-attribute-value">
            <?php
            echo esc_html( $formattedRating );
            ?>
        </span>
    </li>
	<?php
}

add_action( 'mphb_render_single_room_type_metas', 'booklium_single_room_form_divider', 49 );
function booklium_single_room_form_divider() {
	?>
    <div class="divider"></div>
	<?php
}

if ( function_exists( 'MPHBR' ) ) {
	remove_filter( 'comment_text', array(
		\MPHBR\Plugin::getInstance()->frontendReviews(),
		'showRatingInComment'
	), 10 );
}

add_filter( 'mphb_sc_booking_form_wrapper_classes', 'booklium_booking_form_sc_classes' );
function booklium_booking_form_sc_classes( $classes ) {

	if ( get_option( 'mphb_direct_booking' ) == 1 ) {
		$classes .= ' is-direct-booking';
	}

	return $classes;
}

remove_action( 'mphb_sc_services_service_details', array( '\MPHB\Views\LoopServiceView', 'renderPrice' ), 40 );
add_action( 'mphb_sc_services_service_details', array( '\MPHB\Views\LoopServiceView', 'renderPrice' ), 25 );

add_action( 'mphb_sc_services_before_loop', 'booklium_services_wrapper_open', 10 );
function booklium_services_wrapper_open() {
	?>
    <div class="mphb-services-wrapper">
	<?php
}

add_action( 'mphb_sc_services_after_loop', 'booklium_services_wrapper_close', 10 );
function booklium_services_wrapper_close() {
	?>
    </div>
	<?php
}

add_action( 'mphb_sc_services_service_details', 'booklium_loop_service_excerp_wrapper_open', 28 );
function booklium_loop_service_excerp_wrapper_open() {
	?>
    <div class="mphb-loop-service-content">
	<?php
}

add_action( 'mphb_sc_services_service_details', 'booklium_loop_service_excerp_wrapper_close', 33 );
function booklium_loop_service_excerp_wrapper_close() {
	?>
    </div>
	<?php
}

add_action( 'mphb_render_loop_service_before_featured_image', 'booklium_loop_service_image_link_open', 15 );
function booklium_loop_service_image_link_open() {
	?>
    <a href="<?php the_permalink(); ?>">
	<?php
}

add_action( 'mphb_render_loop_service_after_featured_image', 'booklium_loop_service_image_link_close', 5 );
function booklium_loop_service_image_link_close() {
	?>
    </a>
	<?php
}

add_action( 'mphb_render_single_service_before_price', 'booklium_single_service_price_wrapper_open', 5 );
function booklium_single_service_price_wrapper_open() {
	?>
    <div class="mphb-single-service-price-wrapper">
	<?php
}

add_action( 'mphb_render_single_service_after_price', 'booklium_single_service_price_wrapper_close', 15 );
function booklium_single_service_price_wrapper_close() {
	?>
    </div>
	<?php
}
