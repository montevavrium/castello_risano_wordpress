<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Booklium
 */
if( !is_active_sidebar('sidebar-1') && !is_active_sidebar('sidebar-2') &&
    !is_active_sidebar('sidebar-3') && !is_active_sidebar('sidebar-4') &&
    !is_active_sidebar('sidebar-5') && !is_active_sidebar('sidebar-6')){
    return;
}

?>
<div class="footer-widgets">
    <div class="footer-widgets-wrapper">
        <?php
        if(is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-2')):
        ?>
        <div class="top-widgets">
            <?php if(is_active_sidebar('sidebar-1')): ?>
                <div class="widget-area">
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </div>
            <?php endif;
            if(is_active_sidebar('sidebar-2')): ?>
                <div class="widget-area">
                    <?php dynamic_sidebar( 'sidebar-2' ); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        endif;

        if(is_active_sidebar('sidebar-3') || is_active_sidebar('sidebar-4') || is_active_sidebar('sidebar-5') || is_active_sidebar('sidebar-6')):
        ?>
        <div class="bottom-widgets">
            <?php if(is_active_sidebar('sidebar-3')): ?>
                <div class="widget-area">
                    <?php dynamic_sidebar( 'sidebar-3' ); ?>
                </div>
            <?php endif;
            if(is_active_sidebar('sidebar-4')): ?>
                <div class="widget-area">
                    <?php dynamic_sidebar( 'sidebar-4' ); ?>
                </div>
            <?php endif;
            if(is_active_sidebar('sidebar-5')): ?>
                <div class="widget-area">
                    <?php dynamic_sidebar( 'sidebar-5' ); ?>
                </div>
            <?php endif;
            if(is_active_sidebar('sidebar-6')): ?>
                <div class="widget-area">
                    <?php dynamic_sidebar( 'sidebar-6' ); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
        endif;
        ?>
    </div>
</div>
