<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package WordPress
 * @subpackage Boklium
 * @since Boklium 1.0.0
 */
// Includes the files needed for the theme updater
if ( ! class_exists( 'Boklium_EDD_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}
$booklium_info           = wp_get_theme( get_template() );
$booklium_name           = $booklium_info->get( 'Name' );
$booklium_slug           = get_template();
$booklium_version        = $booklium_info->get( 'Version' );
$booklium_author         = $booklium_info->get( 'Author' );
$booklium_remote_api_url = $booklium_info->get( 'AuthorURI' );
// Loads the updater classes
$booklium_updater = new Boklium_EDD_Updater_Admin(

// Config settings
	$booklium_config = array(
		'remote_api_url' => $booklium_remote_api_url, // Site where EDD is hosted
		'item_name'      => $booklium_name, // Name of theme
		'theme_slug'     => $booklium_slug, // Theme slug
		'version'        => $booklium_version, // The current version of this theme
		'author'         => $booklium_author, // The author of this theme
		'download_id'    => '', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$booklium_strings = array(
		'theme-license'             => esc_html__( 'Theme License', 'booklium' ),
		'enter-key'                 => esc_html__( 'Enter your theme license key.', 'booklium' ),
		'license-key'               => esc_html__( 'License Key', 'booklium' ),
		'license-action'            => esc_html__( 'License Action', 'booklium' ),
		'deactivate-license'        => esc_html__( 'Deactivate License', 'booklium' ),
		'activate-license'          => esc_html__( 'Activate License', 'booklium' ),
		'status-unknown'            => esc_html__( 'License status is unknown.', 'booklium' ),
		'renew'                     => esc_html__( 'Renew?', 'booklium' ),
		'unlimited'                 => esc_html__( 'unlimited', 'booklium' ),
		'license-key-is-active'     => esc_html__( 'License key is active.', 'booklium' ),
		'expires%s'                 => esc_html__( 'Expires %s.', 'booklium' ),
		'expires-never'             => esc_html__( 'Lifetime License.', 'booklium' ),
		'%1$s/%2$-sites'            => esc_html__( 'You have %1$s / %2$s sites activated.', 'booklium' ),
		'license-key-expired-%s'    => esc_html__( 'License key expired %s.', 'booklium' ),
		'license-key-expired'       => esc_html__( 'License key has expired.', 'booklium' ),
		'license-keys-do-not-match' => esc_html__( 'License keys do not match.', 'booklium' ),
		'license-is-inactive'       => esc_html__( 'License is inactive.', 'booklium' ),
		'license-key-is-disabled'   => esc_html__( 'License key is disabled.', 'booklium' ),
		'site-is-inactive'          => esc_html__( 'Site is inactive.', 'booklium' ),
		'license-status-unknown'    => esc_html__( 'License status is unknown.', 'booklium' ),
		'update-notice'             => esc_html__( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'booklium' ),
		'update-available'          => wp_kses(__( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s" %6$s>update now</a>.', 'booklium' ), array( 'strong' => array(), 'a' => array( 'class' => array(),'href' => array(),'title' => array() ) )),
	)

);
