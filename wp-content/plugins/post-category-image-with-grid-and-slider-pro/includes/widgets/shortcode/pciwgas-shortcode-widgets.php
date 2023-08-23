<?php
/**
 * Shortcode Widget Functionality
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once( PCIWGASPRO_DIR . '/includes/widgets/shortcode/class-pciwgas-abstract-widget.php' );
require_once( PCIWGASPRO_DIR . '/includes/widgets/shortcode/class-pciwgas-grid.php' );
require_once( PCIWGASPRO_DIR . '/includes/widgets/shortcode/class-pciwgas-slider.php' );

/**
 * Register Shortcode Widgets
 */
function pciwgas_pro_register_shortcode_widgets() {
	register_widget( 'Pciwgas_Pro_Cat_Grid_Shrt' );
	register_widget( 'Pciwgas_Pro_Cat_Slider_Shrt' );
}
add_action( 'widgets_init', 'pciwgas_pro_register_shortcode_widgets' );