<?php
/**
 * Booklium Theme Customizer
 *
 * @package Booklium
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function booklium_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_control( 'header_textcolor' )->label     = esc_html__('Site Title Color', 'booklium');

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'booklium_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'booklium_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_panel( 'booklium_theme_options', array(
		'title' => esc_html__( 'Theme Options', 'booklium' ),
	) );

	$wp_customize->add_section( 'booklium_general_options', array(
		'title' => esc_html__( 'General Options', 'booklium' ),
		'panel' => 'booklium_theme_options'
	) );

	$wp_customize->add_setting( 'booklium_blog_layout', array(
		'default'           => '',
		'sanitize_callback' => 'booklium_sanitize_select'
	) );
	$wp_customize->add_control( 'booklium_blog_layout', array(
		'type'    => 'select',
		'section' => 'booklium_general_options',
		'label'   => esc_html__( 'Blog layout', 'booklium' ),
		'choices' => array(
			''              => esc_html__( 'Default', 'booklium' ),
			'blog-featured' => esc_html__( 'Featured', 'booklium' ),
			'blog-masonry'  => esc_html__( 'Masonry', 'booklium' ),
		),
	) );

	$wp_customize->add_setting( 'booklium_site_layout', array(
		'default'           => 'site-menu-left',
		'sanitize_callback' => 'booklium_sanitize_select'
	) );
	$wp_customize->add_control( 'booklium_site_layout', array(
		'type'    => 'select',
		'section' => 'booklium_general_options',
		'label'   => esc_html__( 'Site layout', 'booklium' ),
		'choices' => array(
			'site-menu-left' => esc_html__( 'Menu left', 'booklium' ),
			'site-wide'      => esc_html__( 'Menu top, wide', 'booklium' ),
			'site-boxed'     => esc_html__( 'Menu top, boxed', 'booklium' ),
		),
	) );

	$wp_customize->add_section( 'booklium_menu_options', array(
		'title' => esc_html__( 'Menu Options', 'booklium' ),
		'panel' => 'booklium_theme_options'
	) );

	$wp_customize->add_setting( 'booklium_show_menu_image', array(
		'default'           => true,
		'transport'         => 'refresh',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'booklium_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'booklium_show_menu_image', array(
			'label'    => esc_html__( 'Display default or featured image in menu when "Menu left" layout is set.', 'booklium' ),
			'section'  => 'booklium_menu_options',
			'type'     => 'checkbox',
			'settings' => 'booklium_show_menu_image',
		)
	);

	$wp_customize->add_setting( 'booklium_primary_menu_image', array(
		'default'           => get_template_directory_uri() . '/img/default_menu.jpg',
		'sanitize_callback' => 'booklium_sanitize_image'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'booklium_primary_menu_image', array(
		'label'    => esc_html__( 'Default image of the left menu', 'booklium' ),
		'section'  => 'booklium_menu_options',
		'settings' => 'booklium_primary_menu_image',
	) ) );

	$wp_customize->add_section( 'booklium_footer_options', array(
		'title' => esc_html__( 'Footer Options', 'booklium' ),
		'panel' => 'booklium_theme_options'
	) );

	$wp_customize->add_setting( 'booklium_show_footer_text', array(
		'default'           => true,
		'transport'         => 'refresh',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'booklium_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'booklium_show_footer_text', array(
			'label'    => esc_html__( 'Show Footer Text?', 'booklium' ),
			'section'  => 'booklium_footer_options',
			'type'     => 'checkbox',
			'settings' => 'booklium_show_footer_text'
		)
	);

	$default_footer_text = esc_html_x( '%1$s &copy; %2$s All Rights Reserved', 'Default footer text, %1$s - blog name, %2$s - current year', 'booklium' );
	$wp_customize->add_setting( 'booklium_footer_text', array(
		'default'           => $default_footer_text,
		'transport'         => 'postMessage',
		'type'              => 'theme_mod',
		'sanitize_callback' => 'booklium_sanitize_textarea'
	) );

	$wp_customize->add_control( 'booklium_footer_text', array(
			'label'       => esc_html__( 'Footer Text', 'booklium' ),
			'description' => esc_html__( 'Use %1$s to insert the blog name, %2$s to insert the current year. Doesn`t work for Live Preview.', 'booklium' ),
			'section'     => 'booklium_footer_options',
			'type'        => 'textarea',
			'settings'    => 'booklium_footer_text'
		)
	);

}

add_action( 'customize_register', 'booklium_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function booklium_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function booklium_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function booklium_customize_preview_js() {
	wp_enqueue_script( 'booklium-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), booklium_get_theme_version(), true );
}

add_action( 'customize_preview_init', 'booklium_customize_preview_js' );

function booklium_sanitize_checkbox( $checked ) {

	//returns true if checkbox is checked
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function booklium_sanitize_textarea( $string ) {
	return wp_kses_post( $string );
}

function booklium_sanitize_image( $input, $setting ) {
	return esc_url_raw( booklium_validate_image( $input, $setting->default ) );
}

function booklium_validate_image( $input, $default = '' ) {
	// Array of valid image file types
	// The array includes image mime types
	// that are included in wp_get_mime_types()
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
	);
	// Return an array with file extension
	// and mime_type
	$file = wp_check_filetype( $input, $mimes );
	// If $input has a valid mime_type,
	// return it; otherwise, return
	// the default.
	return ( $file['ext'] ? $input : $default );
}

function booklium_sanitize_select( $input, $setting ) {

	//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	$input = sanitize_key( $input );

	//get the list of possible select options
	$choices = $setting->manager->get_control( $setting->id )->choices;

	//return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}
