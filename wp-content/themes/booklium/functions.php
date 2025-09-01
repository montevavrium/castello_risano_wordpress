<?php
/**
 * Booklium functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Booklium
 */

if ( ! function_exists( 'booklium_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function booklium_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Booklium, use a find and replace
		 * to change 'booklium' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'booklium', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 892 );
		add_image_size( 'booklium-large', 1350 );
		add_image_size( 'booklium-square', 892, 892, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'booklium' ),
			'menu-2' => esc_html__( 'Socials', 'booklium' ),
			'menu-3' => esc_html__( 'Footer', 'booklium' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'booklium_custom_background_args', array(
			'default-color' => 'fafafa',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 25,
			'width'       => 25,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_post_type_support( 'page', array( 'excerpt' ) );

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_editor_style( array( 'css/editor-style.css', booklium_fonts_url() ) );
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Light Sea Green', 'booklium' ),
				'slug'  => 'light-sea-green',
				'color' => '#13b0bb'
			),
			array(
				'name'  => esc_html__( 'Tangerine Yellow', 'booklium' ),
				'slug'  => 'tangerine-yellow',
				'color' => '#ffce00'
			),
			array(
				'name'  => esc_html__( 'White Smoke', 'booklium' ),
				'slug'  => 'white-smoke',
				'color' => '#ededed'
			),
			array(
				'name'  => esc_html__( 'White Lilac', 'booklium' ),
				'slug'  => 'white-lilac',
				'color' => '#ebebec'
			),
			array(
				'name'  => esc_html__( 'Storm Grey', 'booklium' ),
				'slug'  => 'storm-grey',
				'color' => '#767b80'
			),
			array(
				'name'  => esc_html__( 'Arsenic', 'booklium' ),
				'slug'  => 'arsenic',
				'color' => '#3b4249'
			),
			array(
				'name'  => esc_html__( 'Black', 'booklium' ),
				'slug'  => 'black',
				'color' => '#000000'
			),
			array(
				'name'  => esc_html__( 'White', 'booklium' ),
				'slug'  => 'white',
				'color' => '#ffffff'
			),
		) );

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' => esc_html__( 'Small', 'booklium' ),
				'size' => 14,
				'slug' => 'small'
			),
			array(
				'name' => esc_html__( 'Normal', 'booklium' ),
				'size' => 16,
				'slug' => 'normal'
			),
			array(
				'name' => esc_html__( 'Large', 'booklium' ),
				'size' => 36,
				'slug' => 'large'
			),
			array(
				'name' => esc_html__( 'Huge', 'booklium' ),
				'size' => 50,
				'slug' => 'huge'
			)
		));

	}
endif;
add_action( 'after_setup_theme', 'booklium_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function booklium_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'booklium_content_width', 892 );
}

add_action( 'after_setup_theme', 'booklium_content_width', 0 );

function booklium_adjust_content_width() {
	global $content_width;

	if ( is_page_template( 'template-wide-page.php' ) ) {
		$content_width = 1120;
	}

	if ( is_page_template( 'template-wider-page.php' ) || is_page_template( 'template-canvas-page.php' ) ) {
		$content_width = 1350;
	}

}

add_action( 'template_redirect', 'booklium_adjust_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function booklium_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Top Left', 'booklium' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'booklium' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Top Right', 'booklium' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'booklium' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom 1', 'booklium' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'booklium' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom 2', 'booklium' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'booklium' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom 3', 'booklium' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here.', 'booklium' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom 4', 'booklium' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Add widgets here.', 'booklium' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'booklium_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function booklium_scripts() {

	//font-awesome
	wp_enqueue_style( 'font-awesome-free', get_template_directory_uri() . '/assets/fontawesome-free/css/all.min.css', array(), '5.9.0' );

	//google fonts
	wp_enqueue_style( 'booklium-fonts', booklium_fonts_url() );

	//style.css
	wp_enqueue_style( 'booklium-style', get_stylesheet_uri(), array(), booklium_get_theme_version() );

	$dependencies = array(
		'jquery',
	);

	if ( is_home() && ( get_theme_mod( 'booklium_blog_layout', false ) === 'blog-masonry' ) ) {
		$dependencies[] = 'imagesloaded';
		$dependencies[] = 'masonry';
	}

	wp_enqueue_script( 'booklium-functions', get_template_directory_uri() . '/js/functions.js', $dependencies, booklium_get_theme_version(), true );

	wp_enqueue_script( 'booklium-navigation', get_template_directory_uri() . '/js/navigation.js', array(), booklium_get_theme_version(), true );

	wp_enqueue_script( 'booklium-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), booklium_get_theme_version(), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'booklium_scripts' );

function booklium_block_editor_assets() {

	wp_enqueue_script( 'booklium-blocks', get_template_directory_uri() . '/js/blocks.js', array(
		'wp-blocks',
		'wp-dom'
	), booklium_get_theme_version(), true );

	wp_localize_script('booklium-blocks', 'booklium_editor_data', [
		'canRegisterSectionStyle' => is_wp_version_compatible('5.3')
	]);

	wp_enqueue_style( 'font-awesome-free', get_template_directory_uri() . '/assets/fontawesome-free/css/all.min.css', array(), '5.9.0' );

}

add_action( 'enqueue_block_editor_assets', 'booklium_block_editor_assets' );

/**
 * Autoload
 */
require get_template_directory() . '/inc/autoload.php';

/**
 * Notices
 */
require get_template_directory() . '/inc/notices.php';

/**
 * Demo data import
 */
require get_template_directory() . '/inc/demo-import.php';

/**
 * Required plugins installer
 */
require get_template_directory() . '/inc/tgmpa-init.php';

/**
 * MotoPress Hotel Booking settings
 */
if ( class_exists( 'HotelBookingPlugin' ) ) {
	require get_template_directory() . '/inc/mphb-functions.php';
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer color additions.
 */
require get_template_directory() . '/inc/customizer-colors.php';

if ( ! function_exists( 'booklium_theme_updater' ) ) :
	/**
	 * Theme Updater
	 * Easy Digital Downloads.
	 *
	 * Action is used so that child themes can easily disable.
	 */
	function booklium_theme_updater() {
		if ( current_user_can( 'update_themes' ) ) {
			require get_template_directory() . '/inc/updater/theme-updater.php';
		}
	}
endif;
add_action( 'after_setup_theme', 'booklium_theme_updater' );

/**
 * Get theme vertion.
 *
 * @access public
 * @return string
 */
function booklium_get_theme_version() {
	$theme_info = wp_get_theme( get_template() );

	return $theme_info->get( 'Version' );
}

if ( ! function_exists( 'booklium_fonts_url' ) ) :
	/**
	 * Register Google fonts for booklium.
	 *
	 * Create your own booklium_fonts_url() function to override in a child theme.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function booklium_fonts_url() {
		$fonts_url     = '';
		$font_families = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by Montserrat, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$font1 = esc_html_x( 'on', 'Montserrat font: on or off', 'booklium' );
		if ( 'off' !== $font1 ) {
			$font_families[] = 'Montserrat:400,400i,500,500i,600,600i,700,700i';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext,cyrillic' ),
		);
		if ( $font_families ) {
			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

add_action( 'getwid/icons-manager/init', 'booklium_getwid_add_custom_icons' );
function booklium_getwid_add_custom_icons( $manager ) {

	$beach_icons = [
		'icons'            => require( get_template_directory() . '/inc/lnr-icons.php' ),
		'style'            => 'linearicons-free',
		'enqueue_callback' => 'booklium_enqueue_linearicons_style'
	];

	$manager->registerFont( 'linearicons-free', $beach_icons );

}

function booklium_enqueue_linearicons_style() {

	wp_enqueue_style( 'linearicons-free', get_template_directory_uri() . '/assets/linearicons-free/style.css' );

}
