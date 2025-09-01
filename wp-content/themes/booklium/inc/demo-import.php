<?php

/**
 *
 * Demo data
 *
 **/

function booklium_ocdi_import_files() {
	$import_notice = '<h4>' . __( 'Important note before importing sample data.', 'booklium' ) . '</h4>';
	$import_notice .= __( 'Data import is generally not immediate and can take up to 10 minutes.', 'booklium' ) . '<br/>';
	$import_notice .= __( 'After you import this demo, you will have to configure the Instagram API key and Google Maps API key separately.', 'booklium' );

	$import_notice = wp_kses(
		$import_notice,
		array(
			'a'  => array(
				'href' => array(),
			),
			'ol' => array(),
			'li' => array(),
			'h4' => array(),
			'br' => array(),
		)
	);

	// array of demos slug => title
	$demos_short = array(
		'booklium-default'           => 'Booklium Default',
		'booklium-bed-and-breakfast' => 'Booklium Bed and Breakfast',
		'booklium-villa'             => 'Booklium Single Villa',
		'booklium-hostel'            => 'Booklium Hostel',
		'booklium-apartment'         => 'Booklium Single Apartment'
	);

	$demos = array();

	foreach ( $demos_short as $slug => $title ) {
		$demos[] = array(
			'import_file_name'         => $title,
			'local_import_file'        => trailingslashit( get_template_directory() ) . 'assets/demo-data/' . $slug . '/booklium.xml',
			'local_import_widget_file' => trailingslashit( get_template_directory() ) . 'assets/demo-data/' . $slug . '/booklium-widgets.wie',
			'import_preview_image_url' => trailingslashit( get_template_directory_uri() ) . 'assets/demo-data/' . $slug . '/screenshot.jpg',
			'import_notice'            => $import_notice,
			'preview_url'              => 'https://themes.getmotopress.com/' . $slug,
		);
	}

	return $demos;

}

add_filter( 'ocdi/import_files', 'booklium_ocdi_import_files' );

function booklium_ocdi_after_import_setup( $selected_import ) {

	// Assign menus to their locations.
	$menu1 = get_term_by( 'slug', 'primary', 'nav_menu' );
	$menu2 = get_term_by( 'slug', 'socials', 'nav_menu' );
	$menu3 = get_term_by( 'slug', 'footer', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'menu-1' => $menu1->term_id,
			'menu-2' => $menu2->term_id,
			'menu-3' => $menu3->term_id,
		)
	);

	$menu4           = get_term_by( 'name', 'Company', 'nav_menu' );
	$menu5           = get_term_by( 'name', 'Explore Booklium', 'nav_menu' );
	$nav_menu_widget = get_option( 'widget_nav_menu' );

	if ( $nav_menu_widget ) {
		if ( $menu4 && ! empty( $nav_menu_widget[2] ) ) {
			$nav_menu_widget[2]['nav_menu'] = $menu4->term_id;
		}
		if ( $menu5 && ! empty( $nav_menu_widget[3] ) ) {
			$nav_menu_widget[3]['nav_menu'] = $menu4->term_id;
		}
	}

	// Assign front page and posts page (blog page).
	$front_page = booklium_get_page_by_title( 'Home' );
	$blog_page  = booklium_get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );

	if ( $front_page ) {
		update_option( 'page_on_front', $front_page->ID );
	}

	if ( $blog_page ) {
		update_option( 'page_for_posts', $blog_page->ID );
	}

	// Assign Hotel Booking default pages.
	$search_results_page       = booklium_get_page_by_title( 'Search Results' );
	$booking_confirmation_page = booklium_get_page_by_title( 'Booking Confirmation' );
	$terms_conditions_page     = booklium_get_page_by_title( 'Terms & Conditions' );
	$booking_confirmed_page    = booklium_get_page_by_title( 'Booking Confirmed' );
	$booking_cancelled_page    = booklium_get_page_by_title( 'Booking Cancelled' );
	$booking_received          = booklium_get_page_by_title( 'Reservation Received' );
	$booking_failed            = booklium_get_page_by_title( 'Transaction Failed' );

	if ( $search_results_page ) {
		update_option( 'mphb_search_results_page', $search_results_page->ID );
	}

	if ( $booking_confirmation_page ) {
		update_option( 'mphb_checkout_page', $booking_confirmation_page->ID );
	}

	if ( $terms_conditions_page ) {
		update_option( 'mphb_terms_and_conditions_page', $terms_conditions_page->ID );
	}

	if ( $booking_confirmed_page ) {
		update_option( 'mphb_booking_confirmation_page', $booking_confirmed_page->ID );
	}

	if ( $booking_cancelled_page ) {
		update_option( 'mphb_user_cancel_redirect_page', $booking_cancelled_page->ID );
	}

	if ( $booking_received ) {
		update_option( 'mphb_payment_success_page', $booking_received->ID );
	}

	if ( $booking_failed ) {
		update_option( 'mphb_payment_failed_page', $booking_failed->ID );
	}

	// skip hotel booking wizard
	update_option( 'mphb_wizard_passed', true );

	// Guest Management: Disable "adults" and "children" options for my website.
	// 'disable-children', 'disable-all', 'allow-all'
	update_option( 'mphb_guest_management', 'disable-children' );

	// Hide "adults" and "children" fields within search availability forms.
	// update_option( 'mphb_hide_guests_on_search', 1);

	// enable direct booking
	// update_option('mphb_direct_booking', 1);

	update_option( 'getwid_section_content_width', 1350 );

	//update taxonomies
	$update_taxonomies = array(
		'post_tag',
		'category'
	);

	foreach ( $update_taxonomies as $taxonomy ) {
		booklium_ocdi_update_taxonomy( $taxonomy );
	}

	//set site default logo
	$logo = booklium_get_image_url_by_name( 'logo-24' );
	if ( $logo ) {
		set_theme_mod( 'custom_logo', $logo->ID );
	}

	if ( 'Booklium Bed and Breakfast' == $selected_import['import_file_name'] || 'Booklium Hostel' == $selected_import['import_file_name'] ) {
		set_theme_mod( 'booklium_site_layout', 'site-wide' );
	}

	if ( 'Booklium Single Villa' == $selected_import['import_file_name'] || 'Booklium Single Apartment' == $selected_import['import_file_name'] ) {
		set_theme_mod( 'booklium_site_layout', 'site-boxed' );
		update_option( 'mphb_direct_booking', 1 );
	}

	if ( 'Booklium Default' == $selected_import['import_file_name'] ) {
		$room_categories = [
			'italy'    => wp_get_attachment_image_url( booklium_get_image_url_by_name( 'italy' )->ID, 'large' ),
			'france'   => wp_get_attachment_image_url( booklium_get_image_url_by_name( 'france' )->ID, 'large' ),
			'maldives' => wp_get_attachment_image_url( booklium_get_image_url_by_name( 'maldives' )->ID, 'large' ),
			'usa'      => wp_get_attachment_image_url( booklium_get_image_url_by_name( 'usa' )->ID, 'large' ),
		];
		booklium_add_images_to_room_categories( $room_categories );
	}

}

add_action( 'ocdi/after_import', 'booklium_ocdi_after_import_setup' );

// Disable generation of smaller images (thumbnails) during the content import
//add_filter( 'ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

// Disable the branding notice
add_filter( 'ocdi/disable_pt_branding', '__return_true' );

function booklium_ocdi_update_taxonomy( $taxonomy ) {
	$get_terms_args = array(
		'taxonomy'   => $taxonomy,
		'fields'     => 'ids',
		'hide_empty' => false,
	);

	$update_terms = get_terms( $get_terms_args );
	if ( $taxonomy && is_array($update_terms) ) {
		wp_update_term_count_now( $update_terms, $taxonomy );
	}
}

function booklium_ocdi_confirmation_dialog_options( $options ) {
	return array_merge( $options, array(
		'width'       => 500,
		'dialogClass' => 'wp-dialog',
		'resizable'   => false,
		'height'      => 'auto',
		'modal'       => true,
	) );
}

add_filter( 'ocdi/confirmation_dialog_options', 'booklium_ocdi_confirmation_dialog_options', 10, 1 );


function booklium_make_existed_widgets_inactive() {

	$widgets = get_option( 'sidebars_widgets' );

	$sidebars = array(
		'sidebar-1',
		'sidebar-2',
		'sidebar-3',
		'sidebar-4',
		'sidebar-5',
		'sidebar-6',
	);

	foreach ( $sidebars as $sidebar ) {
		if ( is_active_sidebar( $sidebar ) ) {
			$widgets['wp_inactive_widgets'] = array_merge( $widgets['wp_inactive_widgets'], $widgets[ $sidebar ] );
			$widgets[ $sidebar ]            = [];
		}
	}

	update_option( 'sidebars_widgets', $widgets );
}

add_action( 'ocdi/widget_importer_before_widgets_import', 'booklium_make_existed_widgets_inactive' );

function booklium_add_images_to_room_categories( $room_categories ) {
	foreach ( $room_categories as $room_category => $category_image ) {
		$category_id = get_term_by( 'slug', $room_category, 'mphb_room_type_category' )->term_id;
		update_option( 'z_taxonomy_image' . $category_id, $category_image );
		$location_id = get_term_by( 'slug', $room_category, 'mphb_ra_locations' )->term_id;
		update_option( 'z_taxonomy_image' . $location_id, $category_image );
	}
}

function booklium_get_page_by_title( $title ) {
	$query = new WP_Query(
		[
			'post_type'              => 'page',
			'title'                  => $title,
			'post_status'            => 'all',
			'posts_per_page'         => 1,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'orderby'                => 'post_date ID',
			'order'                  => 'ASC',
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
		]
	);

	if ( $query->post ) {
		return $query->post;
	}
	else {
		return null;
	}
}
