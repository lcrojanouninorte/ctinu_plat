<?php
/**
 * Category Grid Shortcode Widget
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pciwgas_Pro_Cat_Grid_Shrt extends Pciwgas_Pro_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_id			= 'pciwgas-cat-grid-shrt';
		$this->widget_cssclass		= 'pciwgas-cat-grid-shrt';
		$this->widget_name			= __( 'Category Grid - Shortcode', 'post-category-image-with-grid-and-slider' );
		$this->widget_description	= __( 'Display category in a grid view. Category Grid shortcode.', 'post-category-image-with-grid-and-slider' );
		$this->widget_title			= __( 'Category Grid', 'post-category-image-with-grid-and-slider' );
		$this->settings				= pci_cat_grid_shortcode_fields();
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

		echo pciwgas_pro_render_cat_grid( $instance );

		$this->widget_end( $args, $instance );
	}
}