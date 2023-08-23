<?php
/**
 * Category Slider Shortcode Widget
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pciwgas_Pro_Cat_Slider_Shrt extends Pciwgas_Pro_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_id			= 'pciwgas-cat-slider-shrt';
		$this->widget_cssclass		= 'pciwgas-cat-slider-shrt';
		$this->widget_name			= __( 'Category Slider - Shortcode', 'post-category-image-with-grid-and-slider' );
		$this->widget_description	= __( 'Display category in a slider view. Category Slider shortcode.', 'post-category-image-with-grid-and-slider' );
		$this->widget_title			= __( 'Category Slider', 'post-category-image-with-grid-and-slider' );
		$this->settings				= pci_cat_slider_shortcode_fields();
		$this->defaults				= $this->default_settings();

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {

		$instance = wp_parse_args( (array)$instance, $this->defaults );
		
		$this->widget_start( $args, $instance );

		echo pciwgas_pro_render_cat_slider( $instance );

		$this->widget_end( $args, $instance );
	}
}