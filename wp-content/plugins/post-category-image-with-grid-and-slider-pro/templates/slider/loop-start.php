<?php
/**
 * Template for Slider Loop - Start
 *
 * This template can be overridden by copying it to yourtheme/post-category-image-with-grid-and-slider-pro/slider/loop-start.php
 *
 * @package Post Category Image With Grid and Slider Pro
 * @version 1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div class="pciwgas-cat-wrap pciwgas-slick-wrap pciwgas-cat-slider-wrap <?php echo esc_attr( $main_wrap_cls ); ?> pciwgas-clearfix">
	<div id="pciwgas-cat-slider-<?php echo esc_attr( $unique ); ?>" class="pciwgas-cat-slider-main" data-conf="<?php echo htmlspecialchars( json_encode( $slider_conf ) ); ?>">