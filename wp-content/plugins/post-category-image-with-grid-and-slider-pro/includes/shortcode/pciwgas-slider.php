<?php
/**
 * 'pci-cat-slider' Shortcode
 * 
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function pciwgas_pro_render_cat_slider( $atts, $content = '' ) {

	// SiteOrigin Page Builder Gutenberg Block Tweak - Do not Display Preview
	if( isset( $_POST['action'] ) && ($_POST['action'] == 'so_panels_layout_block_preview' || $_POST['action'] == 'so_panels_builder_content_json') ) {
		return '<div class="pciwgas-builder-shrt-prev">
					<div class="pciwgas-builder-shrt-title"><span>'.esc_html__('Post Category Image Slider - Shortcode', 'post-category-image-with-grid-and-slider').'</span></div>
					[pci-cat-slider]
				</div>';
	}

	// Divi Frontend Builder - Do not Display Preview
	if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_POST['is_fb_preview'] ) && isset( $_POST['shortcode'] ) ) {
		return '<div class="pciwgas-builder-shrt-prev">
					<div class="pciwgas-builder-shrt-title"><span>'.esc_html__('Post Category Image Slider - Shortcode', 'post-category-image-with-grid-and-slider').'</span></div>
					pci-cat-slider
				</div>';
	}

	// Fusion Builder Live Editor - Do not Display Preview
	if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) || ( isset( $_POST['action'] ) && $_POST['action'] == 'get_shortcode_render' )) ) {
		return '<div class="pciwgas-builder-shrt-prev">
					<div class="pciwgas-builder-shrt-title"><span>'.esc_html__('Post Category Image Slider - Shortcode', 'post-category-image-with-grid-and-slider').'</span></div>
					pci-cat-slider
				</div>';
	}

	// Shortcode Parameter
	$atts = shortcode_atts(array(
			'taxonomy'				=> 'category',
			'design'				=> 'design-1',
			'limit'					=> 25,
			'show_title'			=> 'true',
			'show_count'			=> 'true',
			'show_desc'				=> 'true',
			'link_target'			=> 'self',
			'img_wrap_height'		=> '',
			'size'					=> 'full',
			'image_fit'				=> 'true',
			'term_id'				=> null,
			'parent_id'				=> '',
			'exclude_cat'			=> array(),
			'orderby'				=> 'name',
			'order'					=> 'ASC',
			'hide_empty'			=> 'true',
			'slidestoshow'			=> 3,
			'slidestoscroll'		=> 1,
			'rows' 					=> 1,
			'centermode'			=> 'false',
			'loop'					=> 'true',
			'dots'					=> 'true',
			'arrows'				=> 'true',
			'autoplay'				=> 'true',
			'autoplay_interval'		=> 3000,
			'speed'					=> 300,
			'hover_pause'			=> 'true',
			'focus_pause'			=> 'false',
			'rtl'					=> '',
			'child_of'				=> 0,
			'offset'				=> '',
			'lazyload'				=> '',
			'extra_class'			=> '',
			'className'				=> '',
			'align'					=> '',
			'dev_param_1'			=> '',
			'dev_param_2'			=> '',
	), $atts,'pci_cat_slider');

	$cat_designs				= pciwgas_pro_cat_designs();
	$supported_taxonomy			= pciwgas_pro_get_opt( 'pciwgas_category', array() );
	$atts['unique']				= pciwgas_pro_get_unique();
	$atts['limit']				= pciwgas_pro_clean_number( $atts['limit'], 0 );
	$atts['slidestoshow']		= pciwgas_pro_clean_number( $atts['slidestoshow'], 3 );
	$atts['slidestoscroll']		= pciwgas_pro_clean_number( $atts['slidestoscroll'], 1 );
	$atts['rows']				= pciwgas_pro_clean_number( $atts['rows'], 1 );
	$atts['autoplay_interval']	= pciwgas_pro_clean_number( $atts['autoplay_interval'], 3000 );
	$atts['speed']				= pciwgas_pro_clean_number( $atts['speed'], 300 );
	$atts['offset'] 			= pciwgas_pro_clean_number( $atts['offset'], 0 );
	$atts['img_wrap_height'] 	= pciwgas_pro_clean_number( $atts['img_wrap_height'], '' );
	$atts['height_css']			= ! empty( $atts['img_wrap_height'] )	? "height:{$atts['img_wrap_height']}px;" : '';
	$atts['taxonomy']			= ( ! empty( $atts['taxonomy'] ) && in_array( $atts['taxonomy'], $supported_taxonomy ) ) ? $atts['taxonomy']	: '';
	$atts['design']				= ( $atts['design'] && ( array_key_exists( trim( $atts['design'] ), $cat_designs ) ) ) ? trim($atts['design']) : 'design-1';
	$atts['show_title']			= ( $atts['show_title'] == 'true' )		? true								: false;
	$atts['show_count']			= ( $atts['show_count'] == 'true' )		? true								: false;
	$atts['show_desc']			= ( $atts['show_desc'] == 'true' )		? true								: false;
	$atts['link_target']		= ( $atts['link_target'] == 'blank' )	? '_blank'							: '_self';
	$atts['size']				= ! empty( $atts['size'] )				? $atts['size']						: 'full';
	$atts['parent_id']			= ! empty( $atts['parent_id'] )			? $atts['parent_id']				: '';
	$atts['term_id']			= ! empty( $atts['term_id'] )			? explode( ',', $atts['term_id'] )	: '';
	$atts['exclude_cat']		= ! empty( $atts['exclude_cat'] )		? explode( ',', $atts['exclude_cat'] )	: array();
	$atts['hide_empty']			= ( $atts['hide_empty'] == 'false' )	? false								: true;
	$atts['image_fit']			= ( $atts['image_fit'] == 'false' )		? 0									: 1;
	$atts['loop']				= ( $atts['loop'] == 'false' )			? 'false'							: 'true';
	$atts['centermode']			= ( $atts['centermode'] == 'true' )		? 'true'							: 'false';
	$atts['dots']				= ( $atts['dots'] == 'false' )			? 'false'							: 'true';
	$atts['arrows']				= ( $atts['arrows'] == 'false' )		? 'false'							: 'true';
	$atts['autoplay']			= ( $atts['autoplay'] == 'false' )		? 'false'							: 'true';
	$atts['hover_pause'] 		= ( $atts['hover_pause'] == 'false' ) 	? 'false' 							: 'true';
	$atts['focus_pause'] 		= ( $atts['focus_pause'] == 'true' ) 	? 'true' 							: 'false';
	$atts['lazyload'] 			= ( $atts['lazyload'] == 'ondemand' || $atts['lazyload'] == 'progressive' ) ? pciwgas_pro_clean( $atts['lazyload'] ) : '';
	$atts['align']				= ! empty( $atts['align'] )				? 'align'.$atts['align'] : '';
	$atts['extra_class']		= $atts['extra_class'] .' '. $atts['align'] .' '. $atts['className'];
	$atts['extra_class']		= pciwgas_pro_sanitize_html_classes( $atts['extra_class'] );
	$atts['dev_param_1']		= ! empty( $atts['dev_param_1'] )	? $atts['dev_param_1']	: '';
	$atts['dev_param_2']		= ! empty( $atts['dev_param_2'] )	? $atts['dev_param_2']	: '';

	extract( $atts );

	// Return if no valid taxonomy
	if( empty( $taxonomy ) ) {
		return $content;
	}

	// For RTL
	if( empty( $rtl ) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Enqueue required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'pciwgas-public-script' );

	// Tweak when offset is present and limit is set to show all then override limit with big number
	// To make offset work
	if( $offset && $limit == 0 ) {
		$limit = 9999;
	}

	// get terms and workaround WP bug with parents/pad counts
	$args = array(
			'taxonomy'		=> $taxonomy,
			'number'		=> $limit,
			'orderby'		=> $orderby,
			'order'			=> $order,
			'include'		=> $term_id,
			'exclude'		=> $exclude_cat,
			'hide_empty'	=> $hide_empty,
			'parent'		=> $parent_id,
			'child_of'		=> $child_of,
			'offset'		=> $offset,
			'hierarchical'	=> ( ! $child_of && '' === $parent_id ) ? false : true,
		);

	$args 				= apply_filters( 'pci_cat_query_args', $args, $atts, 'pci_cat_slider' );
	$args 				= apply_filters( 'pci_cat_slider_query_args', $args, $atts );
	$post_categories 	= get_terms( $args );

	ob_start();

	if ( ! is_wp_error( $post_categories ) && ! empty( $post_categories ) ) {

		$found_taxonomy = count( $post_categories );
		$slidestoshow	= ( $found_taxonomy <= $slidestoshow ) ? $found_taxonomy : $slidestoshow;
		$centermode		= ( $centermode == 'true' && $slidestoshow % 2 != 0 && $slidestoshow != $found_taxonomy ) ? 'true' : 'false';

		$atts['main_wrap_cls']	= "pciwgas-{$design} pciwgas-col-{$slidestoshow} {$extra_class}";
		$atts['main_wrap_cls']	.= ( $centermode == "true" )	? ' pciwgas-center-mode'	: '';
		$atts['main_wrap_cls']	.= ( $image_fit )				? ' pciwgas-image-fit'		: '';
		$atts['main_wrap_cls']	.= ( $rows > 1 )				? ' pciwgas-row-slider'		: '';

		// Slider configuration
		$atts['slider_conf'] = compact( 'slidestoshow', 'slidestoscroll', 'rows', 'centermode', 'loop', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'hover_pause', 'focus_pause', 'rtl', 'lazyload' );

		pciwgas_pro_get_template('slider/loop-start.php', $atts);

		foreach ( $post_categories as $category ) {

			$atts['term_link']		= pciwgas_pro_get_term_link( $category, $taxonomy );
			$atts['category_image']	= pciwgas_pro_term_image( $category->term_id, $size, true );
			$atts['category_name']	= $category->name;
			$atts['category_desc']	= $category->description;
			$atts['category_count'] = $category->count;

			// wrapper class
			$atts['wrapper_cls']	= "pciwgas-post-cat-grid pciwgas-cat-{$category->term_id}";
			$atts['wrapper_cls']	.= ( ! $atts['category_image'] ) ? ' pciwgas-no-img' : '';

			// Include shortcode html file
			pciwgas_pro_get_template("slider/{$design}.php", $atts, null, null, "designs/{$design}.php");
		}

		pciwgas_pro_get_template('slider/loop-end.php', $atts);
	}

	$content .= ob_get_clean();
	return $content;
}

// Category Slider Shortcode
add_shortcode( 'pci-cat-slider', 'pciwgas_pro_render_cat_slider' );