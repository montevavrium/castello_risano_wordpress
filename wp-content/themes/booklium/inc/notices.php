<?php

function booklium_init_notices() {
	$booklium_themeinstallation_notices = new \WPTRT\AdminNotices\Notices();

	// Add a notice.
	$booklium_themeinstallation_notices->add(
		'import_demo_data',                                  // Unique ID.
		esc_html__( 'Theme installation steps', 'booklium' ),   // The title for this notice.
		// The content for this notice.
		'<p>' .
		wp_kses(
			sprintf(
				__( '1. Follow the prompts to <a href="%1$s">install required plugins</a>.', 'booklium' ), admin_url( 'themes.php?page=tgmpa-install-plugins' )
			),
			[ 'a' => [ 'href' => [] ] ]
		) . '</p>' .
		'<p>' .
		wp_kses(
			sprintf(
				__( '2. If you create a new website, you may import sample data in <a href="%1$s">Appearance > Import Demo Data</a>.', 'booklium' ), admin_url( 'themes.php?page=pt-one-click-demo-import' )
			),
			[ 'a' => [ 'href' => [] ] ]
		) . '</p>' .
		'<p>' . esc_html__( '3. If your site is already filled with custom content, follow the documentation to configure your theme.', 'booklium' ) . '</p>',
		[
			'scope'         => 'user',      // user/global.
			'screens'       => [ 'themes', 'appearance_page_tgmpa-install-plugins' ],
			'type'          => 'info',      // info, success, warning, error.
			'alt_style'     => false,       // Use alt styles. true/false
			'option_prefix' => 'booklium',
		]
	);

	// Boot things up.
	$booklium_themeinstallation_notices->boot();
}

add_action( 'admin_init', 'booklium_init_notices' );
