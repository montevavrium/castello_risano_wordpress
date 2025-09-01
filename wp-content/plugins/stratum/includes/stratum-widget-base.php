<?php
/**
 * Class: Stratum_Widget_Base
 */
namespace Stratum;

use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class Stratum_Widget_Base extends Widget_Base {

	public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
    }

	public function get_name() {
		return 'stratum-'.$this->widget_name;
	}

	public function render_widget( $type = 'php', $extra_params = array() ) {
		if ( $type == 'php' ) {
			//Get all settings
			$settings = $this->get_settings();
		}

		$file_name = stratum_get_plugin_path( '/includes/templates/' . $this->widget_name . '.php' );

		if ( !is_readable( $file_name ) ) return;

        ob_start();
			require ($file_name);
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/*
	 * Optimized Widget DOM
	 * https://developers.elementor.com/docs/widgets/widget-inner-wrapper/
	 */
	public function has_widget_inner_wrapper(): bool {

		return ! \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}

}
