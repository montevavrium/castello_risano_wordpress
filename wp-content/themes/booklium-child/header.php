<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Booklium
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'booklium' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-branding">
            <?php the_custom_logo(); ?>
            <?php
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title screen-reader-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
            else :
                ?>
                <p class="site-title screen-reader-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php
            endif;
            $booklium_description = get_bloginfo( 'description', 'display' );
            if ( $booklium_description || is_customize_preview() ) :
                ?>
                <p class="site-description screen-reader-text"><?php echo wp_kses_post( $booklium_description ); /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->

        <?php
        if ( has_nav_menu( 'menu-1' ) ):
            $has_image = get_theme_mod('booklium_show_menu_image', true);
            $site_nav_classes[] = 'main-navigation-wrapper';
            if(!$has_image){
                $site_nav_classes[] = 'no-image';
            }
            ?>
            <div id="site-navigation" class="<?php echo esc_attr(implode(" ", $site_nav_classes));?>">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="line"></span>
                    <span class="line"></span>
                </button>
                <nav class="main-navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'menu-1',
                        'menu_id'         => 'primary-menu',
                        'menu_class'      => 'menu primary-menu',
                        'container_class' => 'primary-menu-container'
                    ) );

                    booklium_render_header_menu_image();

                    if ( has_nav_menu( 'menu-2' ) ) {
                        wp_nav_menu( array(
                            'theme_location'  => 'menu-2',
                            'menu_id'         => 'mobile-social-menu',
                            'menu_class'      => 'social-menu',
                            'container_class' => 'social-menu-wrapper mobile-social-menu',
                            'link_before'     => '<span class="menu-text">',
                            'link_after'      => '</span>',
                            'depth'           => 1
                        ) );
                    }
                    ?>
                    
                        <div class="menu-button">
        <a href="#" class="event-button" aria-label="Book Now">
            <i class="fas fa-phone-alt"></i> Book Now
        </a>
    </div>
                    
                    
                </nav><!-- #site-navigation -->
            </div>
        <?php
        endif;

        if ( has_nav_menu( 'menu-2' ) ) :
            ?>
            <div class="social-menu-wrapper">
                <button id="social-menu-toggle" class="social-menu-toggle">
                    <i class="fas fa-share-alt"></i>
                </button>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-2',
                    'menu_id'        => 'social-menu',
                    'menu_class'     => 'social-menu',
                    'container'      => false,
                    'link_before'    => '<span class="menu-text">',
                    'link_after'     => '</span>',
                    'depth'          => 1
                ) );
                ?>
            </div>
        <?php
        endif;
        ?>

    </header><!-- #masthead -->

    <div id="content" class="site-content">