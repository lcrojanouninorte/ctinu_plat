<?php
/**
 * Function 
 * Handles the script and style functionality of plugin
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Get plugin default settings
 * 
 * @since 1.0
 */
function pciwgas_get_default_sett() {

	$pciwgas_options = apply_filters( 'pciwgas_pro_opts_default_values', array(
								'default_img'		=> '',
								'pciwgas_category'  => array( 'category' ),
								'custom_css' 		=> '',
							));

	return $pciwgas_options;
}

/**
 * Update default settings
 * 
 * @since 1.0
 */
function pciwgas_pro_set_default_sett() {

	global $pciwgas_pro_opts;

	$pciwgas_pro_opts = pciwgas_get_default_sett();

	// Update default options
	update_option( 'pciwgaspro_options', $pciwgas_pro_opts );
}

/**
 * Get Settings From Option Page
 * Handles to return all settings value
 * 
 * @since 1.0.0
 */
function pciwgas_pro_get_settings() {

	$options 	= get_option( 'pciwgaspro_options' );
	$settings	= is_array( $options ) ? $options : array();

	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @since 1.0.0
*/
function pciwgas_pro_get_opt( $key = '', $default = false ) {

	global $pciwgas_pro_opts;

	$default_setting = pciwgas_get_default_sett();

	if( ! isset( $pciwgas_pro_opts[ $key ] ) && isset( $default_setting[ $key ] ) && ! $default ) {

		$value = $default_setting[ $key ];

	} else {

		$value = ! empty( $pciwgas_pro_opts[ $key ] ) ? $pciwgas_pro_opts[ $key ] : $default;
	}

	$value = apply_filters( 'pciwgas_pro_get_opt', $value, $key, $default );

	return apply_filters( 'pciwgas_pro_get_opt_' . $key, $value, $key, $default );
}

/**
 * Function to unique number value
 * 
 * @since 1.0.0
 */
function pciwgas_pro_get_unique() {

	static $unique = 0;
	$unique++;

	// For Elementor & Beaver Builder
	if( ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' )
	|| ( class_exists('FLBuilderModel') && ! empty( $_POST['fl_builder_data']['action'] ) )
	|| ( function_exists('vc_is_inline') && vc_is_inline() ) ) {
		$unique = current_time('timestamp') . '-' . rand();
	}

	return $unique;
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @since 1.3
 */
function pciwgas_pro_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'pciwgas_pro_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash($data);
	}
}

/**
 * Sanitize URL
 * 
 * @since 1.3
 */
function pciwgas_pro_clean_url( $url ) {
	return esc_url_raw( trim( $url ) );
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @since 1.3
 */
function pciwgas_pro_clean_number( $var, $fallback = null, $type = 'int' ) {

	$var = trim( $var );
	$var = is_numeric( $var ) ? $var : 0;

	if ( $type == 'number' ) {
		$data = intval( $var );
	} else if ( $type == 'abs' ) {
		$data = abs( $var );
	} else if ( $type == 'float' ) {
		$data = (float)$var;
	} else {
		$data = absint( $var );
	}

	return ( empty( $data ) && isset( $fallback ) ) ? $fallback : $data;
}

/**
 * Sanitize Hex Color
 * 
 * @since 1.0
 */
function pciwgas_pro_clean_color( $color, $fallback = null ) {

	if ( false === strpos( $color, 'rgba' ) ) {
		
		$data = sanitize_hex_color( $color );

	} else {

		$red	= 0;
		$green	= 0;
		$blue	= 0;
		$alpha	= 0.5;

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		$data = 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
	}

	return ( empty( $data ) && $fallback ) ? $fallback : $data;
}

/**
 * Sanitize Multiple HTML classes
 * 
 * @since 1.3
 */
function pciwgas_pro_sanitize_html_classes($classes, $sep = " ") {
	$return = "";

	if( ! is_array($classes) ) {
		$classes = explode( $sep, $classes );
	}

	if( ! empty( $classes ) ) {
		foreach( $classes as $class ) {
			$return .= sanitize_html_class($class) . " ";
		}
		$return = trim( $return );
	}

	return $return;
}

/**
 * Function to add array after specific key
 * 
 * @since 1.2
 */
function pciwgas_pro_add_array(&$array, $value, $index, $from_last = false) {

	if( is_array( $array ) && is_array( $value ) ) {

		if( $from_last ) {
			$total_count	= count($array);
			$index			= (! empty( $total_count ) && ($total_count > $index)) ? ($total_count - $index) : $index;
		}

		$split_arr	= array_splice( $array, max(0, $index) );
		$array		= array_merge( $array, $value, $split_arr );
	}

	return $array;
}

/**
 * Function to get image URL from attachment id
 * 
 * @since 1.2
 */
function pciwgas_pro_get_image_src( $attachment_id = '', $size = 'full', $default_img = false ) {

	$size	= ! empty( $size ) ? $size : 'full';
	$image	= wp_get_attachment_image_src( $attachment_id, $size );

	if( ! empty( $image ) ) {
		$image = isset( $image[0] ) ? $image[0] : '';
	}

	// Getting default image
	if( $default_img && empty( $image ) ) {
		$image = pciwgas_pro_get_opt( 'default_img' );
	}

	return apply_filters( 'pciwgas_pro_get_image_src', $image, $attachment_id, $size, $default_img );
}

/**
 * Backword compatible
 * 
 * @since 1.2
 */
function pciwgas_pro_term_image( $term_id = 0, $size = 'full', $default_img = false ) {

	$prefix 		= PCIWGASPRO_META_PREFIX;
	$size   		= ! empty( $size ) ? $size : 'full';
	$attachment_id	= get_term_meta( $term_id, $prefix.'cat_thumb_id', true );

	// Backword compatibility
	if ( empty( $attachment_id ) ) {
		$attachment_id = get_option( 'pciwgas_categoryimage_'.$term_id );
	}

	$image = pciwgas_pro_get_image_src( $attachment_id, $size, $default_img );

	return $image;
}

/**
 * Function to get post external link or permalink
 * 
 * @since 1.3
 */
function pciwgas_pro_get_term_link( $term = '', $taxonomy = '' ) {

	$term_link = '';

	if( ! empty( $term ) ) {

		$prefix 	= PCIWGASPRO_META_PREFIX;
		$term_link	= get_term_meta( $term->term_id, $prefix.'custom_link', true );

		if( empty( $term_link ) ) {
			$term_link	= get_term_link( $term, $taxonomy );
		}
	}

	return $term_link;
}

/**
 * Function to get public file script vars
 * 
 * @since 1.6
 */
function pciwgas_pro_public_script_vars() {

	global $post;

	// Determine Elementor Preview Screen
	// Check elementor preview is there
	$elementor_preview = ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_GET['elementor-preview'] ) && $post->ID == (int) $_GET['elementor-preview'] ) ? 1 : 0;

	$script_vars = array(
			'elementor_preview'	=> $elementor_preview,
			'is_mobile' 		=> ( wp_is_mobile() )	? 1 : 0,
			'is_rtl' 			=> ( is_rtl() )			? 1 : 0,
			'is_avada' 			=> ( class_exists( 'FusionBuilder' ) ) ? 1 : 0,
		);

	return apply_filters( 'pciwgas_pro_public_script_vars', $script_vars );
}

/**
 * Function to get pagination
 * 
 * @since 1.3
 */
function pciwgas_pro_pagination( $args = array() ) {

	$add_fragment = apply_filters( 'pciwgas_pro_paging_add_fragment', true, $args );

	$paging = array(
		'base'			=> esc_url_raw( add_query_arg( 'pciwgas-term-page', '%#%', false ) ),
		'format'		=> '?pciwgas-term-page=%#%',
		'current'		=> max( 1, $args['paged'] ),
		'total'			=> $args['total'],
		'prev_next'		=> true,
		'prev_text'		=> '&laquo; '.__('Previous', 'post-category-image-with-grid-and-slider'),
		'next_text'		=> __('Next', 'post-category-image-with-grid-and-slider').' &raquo;',
		'add_fragment' 	=> $add_fragment ? '#pciwgas-cat-'.esc_attr( $args['unique'] ) : false,
	);

	return paginate_links( apply_filters('pciwgaspro_paging_args', $paging ) );
}

/**
 * Function to get category shortcode designs
 * 
 * @since 1.0
 */
function pciwgas_pro_cat_designs() {
	$design_arr = array(
				'design-1'	=> __('Design 1', 'post-category-image-with-grid-and-slider'),
				'design-2'	=> __('Design 2', 'post-category-image-with-grid-and-slider'),
				'design-3'	=> __('Design 3', 'post-category-image-with-grid-and-slider'),
				'design-4'	=> __('Design 4', 'post-category-image-with-grid-and-slider'),
				'design-5'	=> __('Design 5', 'post-category-image-with-grid-and-slider'),
				'design-6'	=> __('Design 6', 'post-category-image-with-grid-and-slider'),
				'design-7'	=> __('Design 7', 'post-category-image-with-grid-and-slider'),
				'design-8'	=> __('Design 8', 'post-category-image-with-grid-and-slider'),
				'design-9'	=> __('Design 9', 'post-category-image-with-grid-and-slider'),
				'design-10'	=> __('Design 10', 'post-category-image-with-grid-and-slider'),
			);
	return apply_filters( 'pciwgas_pro_cat_designs', $design_arr );
}

/**
 * Function to get shortocdes registered in plugin
 * 
 * @since 1.3
 */
function pciwgas_pro_registered_shortcodes() {
	$shortcodes = array(
					'pci-cat-grid'		=> __('Categories Grid', 'post-category-image-with-grid-and-slider'),
					'pci-cat-slider'	=> __('Categories Slider', 'post-category-image-with-grid-and-slider'),  
				);
	return apply_filters( 'pciwgas_pro_registered_shortcodes', (array)$shortcodes );
}