<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Booklium
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function booklium_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
//	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'booklium_woocommerce_setup' );

/**
 * Register shop sidebar.
 *
 * @return void
 */
function booklium_woocommerce_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'booklium' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'booklium' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'booklium_woocommerce_widgets_init' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function booklium_woocommerce_scripts() {
	wp_enqueue_style( 'booklium-woocommerce-style', get_template_directory_uri() . '/css/woocommerce.css', array(), booklium_get_theme_version() );
}

add_action( 'wp_enqueue_scripts', 'booklium_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param array $classes CSS classes applied to the body tag.
 *
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function booklium_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter( 'body_class', 'booklium_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function booklium_woocommerce_products_per_page() {
	return 9;
}

add_filter( 'loop_shop_per_page', 'booklium_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function booklium_woocommerce_thumbnail_columns() {
	return 3;
}

add_filter( 'woocommerce_product_thumbnails_columns', 'booklium_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function booklium_woocommerce_loop_columns() {
	return 3;
}

add_filter( 'loop_shop_columns', 'booklium_woocommerce_loop_columns' );
add_filter( 'woocommerce_cross_sells_columns', 'booklium_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 *
 * @return array $args related products args.
 */
function booklium_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'booklium_woocommerce_related_products_args' );

if ( ! function_exists( 'booklium_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function booklium_woocommerce_product_columns_wrapper() {
		$columns = booklium_woocommerce_loop_columns();
		?>
        <div class="products-loop-wrapper">
        <div class="columns-<?php echo absint( $columns ); ?>">
		<?php
	}
}
add_action( 'woocommerce_before_shop_loop', 'booklium_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'booklium_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function booklium_woocommerce_product_columns_wrapper_close() {
		?>
        </div>
		<?php if ( is_active_sidebar( 'shop-sidebar' ) ): ?>
            <aside class="widget-area woocommerce-sidebar">
				<?php
				dynamic_sidebar( 'shop-sidebar' );
				?>
            </aside>
		<?php
		endif;
		?>
        </div>
		<?php
	}
}
add_action( 'woocommerce_after_shop_loop', 'booklium_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'booklium_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function booklium_woocommerce_wrapper_before() {
		?>
        <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <div class="woocommerce-wrapper">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'booklium_woocommerce_wrapper_before' );

if ( ! function_exists( 'booklium_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function booklium_woocommerce_wrapper_after() {
		?>
        </div>
        </main><!-- #main -->
        </div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'booklium_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 * <?php
 * if ( function_exists( 'booklium_woocommerce_header_cart' ) ) {
 * booklium_woocommerce_header_cart();
 * }
 * ?>
 */

if ( ! function_exists( 'booklium_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 *
	 * @return array Fragments to refresh via AJAX.
	 */
	function booklium_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		booklium_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'booklium_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'booklium_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function booklium_woocommerce_cart_link() {
		?>
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>"
           title="<?php esc_attr_e( 'View your shopping cart', 'booklium' ); ?>">
			<?php
			$item_count_text = sprintf(
			/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'booklium' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
            <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span
                    class="count"><?php echo esc_html( $item_count_text ); ?></span>
        </a>
		<?php
	}
}

if ( ! function_exists( 'booklium_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function booklium_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr( $class ); ?>">
				<?php booklium_woocommerce_cart_link(); ?>
            </li>
            <li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
            </li>
        </ul>
		<?php
	}
}

add_filter( 'single_product_archive_thumbnail_size', function () {
	return 'booklium-square';
} );

add_filter( 'subcategory_archive_thumbnail_size', function () {
	return 'booklium-square';
} );

add_filter( 'woocommerce_gallery_thumbnail_size', function () {
	return 'medium';
} );

add_filter( 'woocommerce_gallery_image_size', function () {
	return 'post-thumbnail';
} );

add_action( 'woocommerce_before_shop_loop', 'booklium_before_shop_ordering', 15 );
function booklium_before_shop_ordering() {
	?>
    <div class="shop-ordering-wrapper">
	<?php
}

add_action( 'woocommerce_before_shop_loop', 'booklium_after_shop_ordering', 35 );
function booklium_after_shop_ordering() {
	?>
    </div>
	<?php
}

//remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'booklium_before_loop_product_thumbnail', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'booklium_after_loop_product_thumbnail', 15 );

function booklium_before_loop_product_thumbnail() {
	?>
    <div class="shop-product-thumbnail-wrapper">
	<?php
}

function booklium_after_loop_product_thumbnail() {
	?>
    </div>
	<?php
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
add_action( 'woocommerce_after_shop_loop_item', 'booklium_before_add_to_cart', 7 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 8 );
add_action( 'woocommerce_after_shop_loop_item', 'booklium_after_add_to_cart', 15 );

function booklium_before_add_to_cart() {
	?>
    <div class="add-to-cart-wrapper">
	<?php
}

function booklium_after_add_to_cart() {
	?>
    </div>
	<?php
}

add_filter( 'woocommerce_pagination_args', function ( $args ) {

	$args['mid_size']  = 1;
	$args['prev_text'] = esc_html__( 'Previous', 'booklium' );
	$args['next_text'] = esc_html__( 'Next', 'booklium' );
	$args['type']      = 'plain';

	return $args;
} );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'booklium_single_product_wrapper_open', 10 );
add_action( 'woocommerce_after_single_product_summary', 'booklium_single_product_wrapper_close', 5 );

function booklium_single_product_wrapper_open() {
	?>
    <div class="product-wrapper">
	<?php
}

function booklium_single_product_wrapper_close() {
	?>
    </div>
	<?php
}

add_action( 'woocommerce_before_single_product_summary', 'booklium_before_product_images', 15 );
add_action( 'woocommerce_before_single_product_summary', 'booklium_after_product_images', 25 );

function booklium_before_product_images() {
	?>
    <div class="product-images">
	<?php
}

function booklium_after_product_images() {
	?>
    </div>
	<?php
}

add_action( 'woocommerce_single_product_summary', 'booklium_product_summary_before', 2 );
add_action( 'woocommerce_single_product_summary', 'booklium_product_summary_after', 65 );

function booklium_product_summary_before() {
	?>
    <div class="summary-wrapper">
	<?php
}

function booklium_product_summary_after() {
	?>
    </div>
	<?php
}

add_action( 'woocommerce_single_product_summary', 'booklium_single_product_title_before', 3 );
add_action( 'woocommerce_single_product_summary', 'booklium_single_product_title_after', 12 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 13 );

function booklium_single_product_title_before() {
	?>
    <div class="title-wrapper">
	<?php
}

function booklium_single_product_title_after() {
	?>
    </div>
	<?php
}

// remove "clear" from variations table on single product
add_filter( 'woocommerce_reset_variations_link', function () {
	return '';
} );

//filter woo reviews args
add_filter( 'woocommerce_product_review_list_args', function () {
	return array(
		'style'       => 'ol',
		'short_ping'  => true,
		'avatar_size' => 70,
		'callback'    => 'booklium_comment_callback'
	);
} );

// change reviews title span to h3
add_filter( 'woocommerce_product_review_comment_form_args', function ( $args ) {

	$args['title_reply_before'] = '<h3 id="reply-title" class="comment-reply-title">';
	$args['title_reply_after']  = '</h3>';

	return $args;
} );

//remove thumbnails from mini cart in sidebar/header
add_action( 'woocommerce_before_mini_cart', function () {
	add_filter( 'woocommerce_cart_item_thumbnail', '__return_empty_string', 15, 3 );
} );

add_action( 'woocommerce_after_mini_cart', function () {
	remove_filter( 'woocommerce_cart_item_thumbnail', '__return_empty_string', 15, 3 );
} );

add_action('woocommerce_checkout_before_order_review_heading', 'booklium_woocommerce_before_checkout_order_review', 10);
function booklium_woocommerce_before_checkout_order_review(){
    ?>
    <div class="woocommerce-checkout-order-review">
    <?php
}

add_action('woocommerce_checkout_after_order_review', 'booklium_woocommerce_after_checkout_order_review', 10);
function booklium_woocommerce_after_checkout_order_review(){
    ?>
    </div>
    <?php
}
