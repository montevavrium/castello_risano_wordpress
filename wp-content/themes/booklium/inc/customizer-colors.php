<?php

function booklium_get_default_colors() {
	return [
		'accent'            => '#13b0bb',
		'header'            => '#17181a',
		'header_hover'      => '#13b0bb',
		'button_bg'         => '#13b0bb',
		'button'            => '#ffffff',
		'hb_accent'         => '#ffce00',
		'hb_calendar_bg'    => '#e7f7f8',
		'hb_calendar_color' => '#13b0bb'
	];
}

function booklium_get_default_color( $color ) {
	$colors = booklium_get_default_colors();

	if ( ! array_key_exists( $color, $colors ) ) {
		return false;
	}

	return $colors[ $color ];
}

function booklium_customizer_color_settings( WP_Customize_Manager $wp_customize ) {

	$default_colors = booklium_get_default_colors();
	// Color settings
	$wp_customize->add_setting( 'booklium_accent_color', array(
		'default'           => $default_colors['accent'],
		'type'              => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'booklium_accent_color', array(
		'label'   => esc_html__( 'Accent Color', 'booklium' ),
		'section' => 'colors',
		'setting' => 'booklium_accent_color'
	) ) );

	$wp_customize->add_setting( 'booklium_header_color', array(
		'default'           => $default_colors['header'],
		'type'              => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'booklium_header_color', array(
		'label'   => esc_html__( 'Header Menu Color', 'booklium' ),
		'section' => 'colors',
		'setting' => 'booklium_header_color'
	) ) );

	$wp_customize->add_setting( 'booklium_header_hover_color', array(
		'default'           => $default_colors['header_hover'],
		'type'              => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'booklium_header_hover_color', array(
		'label'   => esc_html__( 'Header Menu Hover Color', 'booklium' ),
		'section' => 'colors',
		'setting' => 'booklium_header_hover_color'
	) ) );

	$wp_customize->add_setting( 'booklium_button_bg_color', array(
		'default'           => $default_colors['button_bg'],
		'type'              => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'booklium_button_bg_color', array(
		'label'   => esc_html__( 'Button Background Color', 'booklium' ),
		'section' => 'colors',
		'setting' => 'booklium_button_bg_color'
	) ) );

	$wp_customize->add_setting( 'booklium_button_color', array(
		'default'           => $default_colors['button'],
		'type'              => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'booklium_button_color', array(
		'label'   => esc_html__( 'Button Color', 'booklium' ),
		'section' => 'colors',
		'setting' => 'booklium_button_color'
	) ) );

	if ( class_exists( 'HotelBookingPlugin' ) ) {
		$wp_customize->add_setting( 'booklium_hb_accent_color', array(
			'default'           => $default_colors['hb_accent'],
			'type'              => 'theme_mod',
			'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'booklium_hb_accent_color', array(
			'label'   => esc_html__( 'HB Accent Color', 'booklium' ),
			'section' => 'colors',
			'setting' => 'booklium_hb_accent_color'
		) ) );

		$wp_customize->add_setting( 'booklium_calendar_bg_color', array(
			'default'           => $default_colors['hb_calendar_bg'],
			'type'              => 'theme_mod',
			'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'booklium_calendar_bg_color', array(
			'label'   => esc_html__( 'HB Calendar Available Date Background', 'booklium' ),
			'section' => 'colors',
			'setting' => 'booklium_calendar_bg_color'
		) ) );

		$wp_customize->add_setting( 'booklium_calendar_color', array(
			'default'           => $default_colors['hb_calendar_color'],
			'type'              => 'theme_mod',
			'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'booklium_calendar_color', array(
			'label'   => esc_html__( 'HB Calendar Available Date Color', 'booklium' ),
			'section' => 'colors',
			'setting' => 'booklium_calendar_color'
		) ) );
	}

}

add_action( 'customize_register', 'booklium_customizer_color_settings' );

function booklium_enqueue_colors_style() {

	$css = '';

	$css .= booklium_generate_accent_color_css();
	$css .= booklium_generate_header_colors_css();
	$css .= booklium_generate_button_colors_css();

	if ( $css ) {
		wp_add_inline_style( 'booklium-style', $css );
	}

	if ( class_exists( 'HotelBookingPlugin' ) ) {
		$hb_css = booklium_generate_hotel_booking_css();
		if ( $hb_css ) {
			wp_add_inline_style( 'booklium-mphb', $hb_css );
		}
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$woo_css = booklium_generate_woocommerce_css();
		if ( $woo_css ) {
			wp_add_inline_style( 'booklium-woocommerce-style', $woo_css );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'booklium_enqueue_colors_style' );

function booklium_editor_customizer_styles() {

	$css = '';

	$css .= booklium_generate_accent_color_css( true );
	$css .= booklium_generate_button_colors_css( true );

	if ( class_exists( 'HotelBookingPlugin' ) ) {
		$css .= booklium_generate_hotel_booking_css( true );
	}

	if ( class_exists( 'WooCommerce' ) ) {
		$css .= booklium_generate_woocommerce_css( true );
	}

	if ( $css ) {
		//register fake stylesheet which allow add inline style
		wp_register_style( 'booklium-editor-customizer', false );
		wp_enqueue_style( 'booklium-editor-customizer' );
		wp_add_inline_style( 'booklium-editor-customizer', $css );
	}
}

add_action( 'enqueue_block_editor_assets', 'booklium_editor_customizer_styles' );

function booklium_generate_accent_color_css( $is_editor = false ) {

	$prefix = '';

	if ( $is_editor ) {
		$prefix = '.editor-block-list__layout .editor-block-list__block-edit';
	}

	$css           = '';
	$default_color = booklium_get_default_color( 'accent' );
	$color         = get_theme_mod( 'booklium_accent_color', $default_color );

	if ( ! $default_color || $color === $default_color ) {
		return '';
	}

	if ( ! $is_editor ) {
		$css .= <<<CSS
		.footer-menu a:hover,
		.navigation.pagination .page-numbers.prev:hover,
		.navigation.pagination .page-numbers.next:hover,
		.woocommerce-pagination .page-numbers.prev:hover,
		.woocommerce-pagination .page-numbers.next:hover,
		.widget_nav_menu a:hover,
		.entry-title a:hover,
		.entry-meta a:hover,
		.entry-meta .cat-links a,
		.post-navigation-wrapper a:hover .post-title,
		.mphb_sc_account .mphb-account-menu li a:hover {
		  color: {$color};
		}

		.tags-links a:hover,
		.post-navigation-wrapper .nav-previous:hover:before,
		.post-navigation-wrapper .nav-previous:hover:after,
		.post-navigation-wrapper .nav-next:hover:before,
		.post-navigation-wrapper .nav-next:hover:after {
		  background: {$color};
		}

		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus,
		select:focus,
		.tags-links a:hover,
		.navigation.pagination .page-numbers:hover,
		.woocommerce-pagination .page-numbers:hover,
		.mphb_sc_account nav.mphb-account-menu {
		  border-color: {$color};
		}
CSS;
	}

	$css .= <<<CSS
	{$prefix} a,
	{$prefix} .wp-block-getwid-recent-posts .wp-block-getwid-recent-posts__post .wp-block-getwid-recent-posts__post-title a:hover,
	{$prefix} .wp-block-getwid-recent-posts .wp-block-getwid-recent-posts__post .wp-block-getwid-recent-posts__entry-meta a:hover,
	{$prefix} .wp-block-getwid-recent-posts .wp-block-getwid-recent-posts__post .wp-block-getwid-recent-posts__post-categories a,
	{$prefix} .wp-block-getwid-toggle .wp-block-getwid-toggle__row .wp-block-getwid-toggle__header:hover a,
	{$prefix} .wp-block-getwid-toggle .wp-block-getwid-toggle__row .wp-block-getwid-toggle__header:hover .wp-block-getwid-toggle__icon,
	{$prefix} .wp-block-getwid-toggle .wp-block-getwid-toggle__row .wp-block-getwid-toggle__icon,
	{$prefix} .wp-block-getwid-toggle .wp-block-getwid-toggle__row.is-active .wp-block-getwid-toggle__header a,
	{$prefix} .wp-block-getwid-tabs .wp-block-getwid-tabs__nav-links .wp-block-getwid-tabs__nav-link.ui-tabs-active a,
	{$prefix} .wp-block-getwid-tabs .wp-block-getwid-tabs__nav-links .wp-block-getwid-tabs__nav-link:hover a,
	{$prefix} .wp-block-getwid-advanced-heading a:hover,
	{$prefix} .wp-block-getwid-social-links .wp-block-getwid-social-links__link:hover .wp-block-getwid-social-links__wrapper,
	{$prefix} .wp-block-getwid-progress-bar .wp-block-getwid-progress-bar__progress:not(.has-text-color),
	{$prefix} .wp-block-getwid-counter .wp-block-getwid-counter__wrapper .wp-block-getwid-counter__number:not(.has-text-color),
	{$prefix} .wp-block-getwid-post-slider .wp-block-getwid-post-slider__post-title a:hover,
	{$prefix} .wp-block-getwid-post-carousel .wp-block-getwid-post-carousel__post-title a:hover,
	{$prefix} .wp-block-getwid-custom-post-type .wp-block-getwid-custom-post-type__post-title a:hover {
	  color: {$color};
	}

	{$prefix} .wp-block-pullquote.is-style-solid-color:not([class*="has-"]),
	{$prefix} .wp-block-getwid-social-links.has-icons-stacked .wp-block-getwid-social-links__wrapper:hover {
	  background: {$color};
	}

	{$prefix} .wp-block-getwid-social-links.has-icons-stacked .wp-block-getwid-social-links__wrapper:hover {
		color: #fff;
	}

	{$prefix} .wp-block-getwid-tabs .wp-block-getwid-tabs__nav-links,
	{$prefix} .wp-block-pullquote,
	{$prefix} .wp-block-getwid-price-box.featured {
	  border-color: {$color};
	}

	{$prefix} .wp-block-getwid-tabs .wp-block-getwid-tabs__nav-links .wp-block-getwid-tabs__nav-link.ui-tabs-active a:after {
	  border-bottom-color: {$color};
	}

	{$prefix} .wp-block-getwid-tabs.has-layout-vertical-right .wp-block-getwid-tabs__nav-links {
	  border-left-color: {$color};
	}

	{$prefix} .wp-block-getwid-tabs.has-layout-vertical-left .wp-block-getwid-tabs__nav-links {
	  border-right-color: {$color};
	}
CSS;

	return $css;
}

function booklium_generate_header_colors_css() {

	$css           = '';
	$default_color = booklium_get_default_color( 'header' );
	$color         = get_theme_mod( 'booklium_header_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS
		.main-navigation a,
		.main-navigation button {
		  color: {$color};
		}

		.social-menu-toggle,
		.social-menu a:before {
		  color: {$color};
		}
CSS;
	}

	$default_color = booklium_get_default_color( 'header_hover' );
	$color         = get_theme_mod( 'booklium_header_hover_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS
		.main-navigation li:hover > a,
		.main-navigation li:hover > button, .main-navigation li.focus > a,
		.main-navigation li.focus > button,
		.main-navigation .current_page_item > *,
		.main-navigation .current-menu-item > *,
		.main-navigation .current_page_ancestor > *,
		.main-navigation .current-menu-ancestor > * {
		  color: {$color};
		}

		.site-menu-left .primary-menu > li > ul li:hover > a {
		  border-color: {$color};
		}

		.social-menu-toggle:hover,
		.social-menu a:hover:before {
		  background: {$color};
		  border-color: {$color};
		}
CSS;
	}

	return $css;
}

function booklium_generate_button_colors_css( $is_editor = false ) {

	$prefix = '';

	if ( $is_editor ) {
		$prefix = '.editor-block-list__layout .editor-block-list__block-edit';
	}

	$css           = '';
	$default_color = booklium_get_default_color( 'button_bg' );
	$color         = get_theme_mod( 'booklium_button_bg_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		if ( ! $is_editor ) {
			$css .= <<<CSS
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.more-link,
			.mphb_sc_account table.mphb-account-bookings .booking-actions a {
			  background-color: {$color};
			}

			button:hover,
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			.more-link:hover,
			.page-footer .post-edit-link:hover,
		    .mphb_sc_account table.mphb-account-bookings .booking-actions a:hover {
			  border-color: {$color};
			}
CSS;
		}

		$css .= <<<CSS
		{$prefix} .button,
		{$prefix} .wp-block-button__link:not(.has-background),
		{$prefix} .wp-block-file .wp-block-file__button:not(.has-background),
		{$prefix} .wp-block-getwid-images-slider .slick-prev,
		{$prefix} .wp-block-getwid-images-slider .slick-next,
		{$prefix} .wp-block-getwid-images-slider .slick-dots li.slick-active button,
		{$prefix} .wp-block-getwid-images-slider .slick-dots li button:hover,
		{$prefix} .wp-block-getwid-media-text-slider .slick-prev,
		{$prefix} .wp-block-getwid-media-text-slider .slick-next,
		{$prefix} .wp-block-getwid-media-text-slider .slick-dots li.slick-active button,
		{$prefix} .wp-block-getwid-media-text-slider .slick-dots li button:hover,
		{$prefix} .wp-block-getwid-post-slider .slick-prev,
		{$prefix} .wp-block-getwid-post-slider .slick-next,
		{$prefix} .wp-block-getwid-post-slider .slick-dots li.slick-active button,
		{$prefix} .wp-block-getwid-post-slider .slick-dots li button:hover,
		{$prefix} .wp-block-getwid-post-carousel .slick-prev,
		{$prefix} .wp-block-getwid-post-carousel .slick-next,
		{$prefix} .wp-block-getwid-post-carousel .slick-dots li.slick-active button,
		{$prefix} .wp-block-getwid-post-carousel .slick-dots li button:hover {
		  background-color: {$color};
		}

		{$prefix} .button:hover,
		{$prefix} .wp-block-button__link:hover,
		{$prefix} .wp-block-file .wp-block-file__button:hover,
		{$prefix} .is-style-outline .wp-block-button__link:hover,
		{$prefix} .wp-block-getwid-images-slider .slick-prev:hover,
		{$prefix} .wp-block-getwid-images-slider .slick-next:hover,
		{$prefix} .wp-block-getwid-images-slider .slick-dots li.slick-active button:after,
		{$prefix} .wp-block-getwid-images-slider .slick-dots li button:hover:after,
		{$prefix} .wp-block-getwid-media-text-slider .slick-prev:hover,
		{$prefix} .wp-block-getwid-media-text-slider .slick-next:hover,
		{$prefix} .wp-block-getwid-media-text-slider .slick-dots li.slick-active button:after,
		{$prefix} .wp-block-getwid-media-text-slider .slick-dots li button:hover:after,
		{$prefix} .wp-block-getwid-post-slider .slick-prev:hover,
		{$prefix} .wp-block-getwid-post-slider .slick-next:hover,
		{$prefix} .wp-block-getwid-post-slider .slick-dots li.slick-active button:after,
		{$prefix} .wp-block-getwid-post-slider .slick-dots li button:hover:after,
		{$prefix} .wp-block-getwid-post-carousel .slick-prev:hover,
		{$prefix} .wp-block-getwid-post-carousel .slick-next:hover,
		{$prefix} .wp-block-getwid-post-carousel .slick-dots li.slick-active button:after,
		{$prefix} .wp-block-getwid-post-carousel .slick-dots li button:hover:after {
		  border-color: {$color};
		}

		{$prefix} .wp-block-getwid-images-slider.has-arrows-inside .slick-prev:hover,
		{$prefix} .wp-block-getwid-images-slider.has-arrows-inside .slick-next:hover {
		  background: {$color};
		}
CSS;

		if ( $is_editor ) {
			$css .= <<<CSS
			{$prefix} .mphb_sc_search-wrapper .button,
			{$prefix} .mphb_sc_rooms-wrapper .button,
			{$prefix} .mphb_sc_booking_form-wrapper .button,
			{$prefix} .mphbr-accommodation-rating .button{
			  background-color: {$color} !important;
	    	  border-color: {$color} !important;
			}
CSS;
		}
	}

	$default_color = booklium_get_default_color( 'button' );
	$color         = get_theme_mod( 'booklium_button_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		if ( ! $is_editor ) {
			$css .= <<<CSS
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.more-link,
			.mphb_sc_account table.mphb-account-bookings .booking-actions a {
			  color: {$color};
			}
CSS;
		}

		$css .= <<<CSS
		{$prefix} .button,
		{$prefix} .wp-block-button__link:not(.has-background),
		{$prefix} .wp-block-file .wp-block-file__button:not(.has-background),
		{$prefix} .wp-block-getwid-images-slider .slick-prev,
		{$prefix} .wp-block-getwid-images-slider .slick-next,
		{$prefix} .wp-block-getwid-media-text-slider .slick-prev,
		{$prefix} .wp-block-getwid-media-text-slider .slick-next,
		{$prefix} .wp-block-getwid-post-slider .slick-prev,
		{$prefix} .wp-block-getwid-post-slider .slick-next,
		{$prefix} .wp-block-getwid-post-carousel .slick-prev,
		{$prefix} .wp-block-getwid-post-carousel .slick-next {
		  color: {$color};
		}
CSS;

		if ( $is_editor ) {
			$css .= <<<CSS
			{$prefix} .mphb_sc_search-wrapper .button,
			{$prefix} .mphb_sc_rooms-wrapper .button,
			{$prefix} .mphb_sc_booking_form-wrapper .button,
			{$prefix} .mphbr-accommodation-rating .button{
			  color: {$color} !important;
			}
CSS;
		}
	}

	return $css;
}

function booklium_generate_hotel_booking_css( $is_editor = false ) {

	$prefix = '';

	if ( $is_editor ) {
		$prefix = '.editor-block-list__layout .editor-block-list__block-edit';
	}

	$css           = '';
	$default_color = booklium_get_default_color( 'button_bg' );
	$color         = get_theme_mod( 'booklium_button_bg_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS
		{$prefix} .flexslider.mphb-flexslider ul.flex-direction-nav .flex-next,
		{$prefix} .flexslider.mphb-flexslider ul.flex-direction-nav .flex-prev {
		  background-color: {$color};
		}

		{$prefix} .single-room-gallery .flexslider ol.flex-control-nav li .flex-active,
		{$prefix} .single-room-gallery .flexslider ol.flex-control-nav li a:hover {
		  background-color: {$color} !important;
		}

		{$prefix} .flexslider.mphb-flexslider ul.flex-direction-nav .flex-next:hover,
		{$prefix} .flexslider.mphb-flexslider ul.flex-direction-nav .flex-prev:hover,
		{$prefix} .single-room-gallery .flexslider ol.flex-control-nav li .flex-active:after,
		{$prefix} .single-room-gallery .flexslider ol.flex-control-nav li a:hover:after{
			border-color: {$color};
		}
CSS;
	}

	$default_color = booklium_get_default_color( 'button' );
	$color         = get_theme_mod( 'booklium_button_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS
		{$prefix} .flexslider.mphb-flexslider ul.flex-direction-nav .flex-next,
		{$prefix} .flexslider.mphb-flexslider ul.flex-direction-nav .flex-prev {
		  color: {$color};
		}
CSS;
	}

	$default_color = booklium_get_default_color( 'accent' );
	$color         = get_theme_mod( 'booklium_accent_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS
		{$prefix} .mphb-single-room-type-attributes a:hover,
		{$prefix} .mphb-loop-room-type-attributes a:hover,
		{$prefix} .loop-room-short-attributes a:hover,
		{$prefix} .mphb-single-room-type-attributes li:before,
		{$prefix} .datepick .datepick-nav a:hover:not(.datepick-disabled),
		{$prefix} .datepick .datepick-nav .datepick-cmd-today,
		{$prefix} .datepick .datepick-ctrl a:hover,
		{$prefix} .mphb_sc_services-wrapper .mphb-service .mphb-service-title a:hover {
		  color: {$color};
		}
CSS;
	}

	$default_color = booklium_get_default_color( 'hb_calendar_bg' );
	$color         = get_theme_mod( 'booklium_calendar_bg_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS
		{$prefix} .mphb-calendar .datepick-month td .mphb-available-date {
			background: {$color};
		}

		{$prefix} .mphb-calendar .datepick-month td .mphb-mark-as-unavailable--check-in,
		{$prefix} .mphb-calendar .datepick-month td .mphb-mark-as-unavailable--check-out,
		{$prefix} .mphb-calendar .datepick-month td .mphb-out-of-season-date--check-in,
		{$prefix} .mphb-calendar .datepick-month td .mphb-out-of-season-date--check-out {
			background: transparent;
		}

		{$prefix} .mphb-calendar .datepick-month td .mphb-mark-as-unavailable--check-in:after,
		{$prefix} .mphb-calendar .datepick-month td .mphb-out-of-season-date--check-in:after {
			background: linear-gradient(to top left, rgba(255,255,255,0) 50%, {$color} 50%);
		}
		{$prefix} .mphb-calendar .datepick-month td .mphb-mark-as-unavailable--check-out:after,
		{$prefix} .mphb-calendar .datepick-month td .mphb-out-of-season-date--check-out:after {
			background: linear-gradient(to bottom right, rgba(255,255,255,0) 50%, {$color} 50%);
		}
CSS;
	}

	$default_color = booklium_get_default_color( 'hb_calendar_color' );
	$color         = get_theme_mod( 'booklium_calendar_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS

		{$prefix} .mphb-calendar .datepick-month td .mphb-mark-as-unavailable--check-in,
		{$prefix} .mphb-calendar .datepick-month td .mphb-mark-as-unavailable--check-out,
		{$prefix} .mphb-calendar .datepick-month td .mphb-out-of-season-date--check-in,
		{$prefix} .mphb-calendar .datepick-month td .mphb-out-of-season-date--check-out,
		{$prefix} .mphb-calendar .datepick-month td .mphb-available-date {
		  color: {$color};
		}

		{$prefix} .mphb-calendar .datepick-month td .mphb-unselectable-date--check-in,
		{$prefix} .mphb-calendar .datepick-month td .mphb-unselectable-date--check-out {
		  color: #ebebec;
		}

		{$prefix} .mphb-calendar .datepick-month td .datepick-highlight,
		{$prefix} .mphb-calendar .datepick-month td .mphb-selected-date,
		{$prefix} .mphb-calendar .datepick-month td .datepick-selected {
		  color: {$color};
		}
CSS;
	}

	$default_color = booklium_get_default_color( 'hb_accent' );
	$color         = get_theme_mod( 'booklium_hb_accent_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS
		{$prefix} .mphb-booking-form input[type="text"],
		{$prefix} .mphb-booking-form select,
		{$prefix} .mphb_sc_search-wrapper input[type="text"],
		{$prefix} .mphb_sc_search-wrapper select,
		{$prefix} .mphb_sc_booking_form-wrapper input[type="text"],
		{$prefix} .mphb_sc_booking_form-wrapper select,
		{$prefix} .widget_mphb_search_availability_widget input[type="text"],
		{$prefix} .widget_mphb_search_availability_widget select,
		{$prefix} .mphb-calendar .datepick-month td .datepick-highlight,
		{$prefix} .mphb-calendar .datepick-month td .mphb-selected-date,
		{$prefix} .mphb-calendar .datepick-month td .datepick-selected,
		{$prefix} .mphb-datepick-popup .datepick-month td a.datepick-highlight,
		{$prefix} .mphb-datepick-popup .datepick-month td a.mphb-selected-date,
		{$prefix} .mphb-datepick-popup .datepick-month td a.datepick-selected,
		{$prefix} .mphb-datepick-popup,
		{$prefix} .mphb_sc_search_results-wrapper .mphb-reserve-room-section .mphb-rooms-reservation-message-wrapper,
		{$prefix} .mphb_sc_checkout-wrapper .mphb-reserve-rooms-details .mphb-adults-chooser select,
		{$prefix} .mphb_sc_checkout-wrapper .mphb-reserve-rooms-details .mphb-children-chooser select,
		{$prefix} .mphb_sc_checkout-wrapper #mphb-billing-details .mphb-billing-fields .mphb-stripe-element,
		{$prefix} .mphb_sc_checkout-wrapper #mphb-billing-details .mphb-billing-fields input[data-beanstream-id] {
		  border-color: {$color};
		}

		{$prefix} .mphb-calendar .datepick-month td .datepick-highlight,
		{$prefix} .mphb-calendar .datepick-month td .mphb-selected-date,
		{$prefix} .mphb-calendar .datepick-month td .datepick-selected,
		{$prefix} .mphb-datepick-popup .datepick-month td a.datepick-highlight,
		{$prefix} .mphb-datepick-popup .datepick-month td a.mphb-selected-date,
		{$prefix} .mphb-datepick-popup .datepick-month td a.datepick-selected {
		  background: {$color};
		}
CSS;
	}

	return $css;
}

function booklium_generate_woocommerce_css( $is_editor = false ) {

	$prefix = '';

	if ( $is_editor ) {
		$prefix = '.editor-block-list__layout .editor-block-list__block-edit';
	}

	$css           = '';
	$default_color = booklium_get_default_color( 'accent' );
	$color         = get_theme_mod( 'booklium_accent_color', $default_color );

	if ( $default_color && $color !== $default_color ) {
		$css .= <<<CSS
		{$prefix} table.shop_table_responsive tr td.product-remove a:hover,
		{$prefix} ul.products li.product .woocommerce-loop-product__title:hover,
		{$prefix} ul.products li.product .woocommerce-loop-category__title:hover,
		{$prefix} ul.products li.product .button:hover,
		{$prefix} .woocommerce-product-rating .woocommerce-review-link:hover,
		{$prefix} p.stars a:before,
		{$prefix} .woocommerce-tabs ul.tabs li a:hover,
		{$prefix} .woocommerce-tabs ul.tabs li.active a,
		{$prefix} .widget .product_list_widget .product-title:hover,
		{$prefix} .widget .widget_shopping_cart_content .woocommerce-mini-cart .woocommerce-mini-cart-item .remove:hover,
		{$prefix} .widget .widget_shopping_cart_content .woocommerce-mini-cart__buttons .button:hover,
		{$prefix} .woocommerce-MyAccount-navigation ul li.is-active a,
		{$prefix} .woocommerce-MyAccount-navigation ul a:hover {
		  color: {$color};
		}

		{$prefix} .woocommerce-tabs ul.tabs,
		{$prefix} .woocommerce-tabs ul.tabs li.active a:after {
		  border-bottom-color: {$color};
		}

		{$prefix} .widget_price_filter .ui-slider .ui-slider-handle,
		{$prefix} .widget_price_filter .ui-slider .ui-slider-range {
		  background: {$color};
		}
CSS;
	}

	return $css;
}
