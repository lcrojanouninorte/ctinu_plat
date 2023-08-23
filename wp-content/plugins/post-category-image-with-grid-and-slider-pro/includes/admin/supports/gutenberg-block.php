<?php
/**
 * Blocks Initializer
 * 
 * @package Post Category Image Grid and Slider Pro
 * @since 1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function pciwgas_pro_register_guten_block() {

	// Some Variables
	$shrt_gen_link = add_query_arg( array( 'page' => 'pciwgas-pro-shrt-mapper' ), admin_url('admin.php') );

	wp_register_script( 'pciwgas-block-js', PCIWGASPRO_URL.'assets/js/blocks.build.js', array( 'wp-block-editor', 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components' ), PCIWGASPRO_VERSION, true );
	wp_localize_script( 'pciwgas-block-js', 'PciwgasPro_Block', array(
																	'shrt_gen_link' 		=> $shrt_gen_link,
																	'slider_shrt_gen_link'	=> add_query_arg( array( 'shortcode' => 'pci-cat-slider' ), $shrt_gen_link ),
																));

	// Register block and explicit attributes for grid
	register_block_type( 'pciwgas-pro/pci-cat-grid', array(
		'attributes' => array(
			'align' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'className' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'design' => array(
							'type'		=> 'string',
							'default'	=> 'design-1',
						),
			'columns' => array(
							'type'		=> 'number',
							'default'	=> 3,
						),
			'show_title' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'show_count' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'show_desc' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'link_target' => array(
							'type'		=> 'string',
							'default'	=> 'self',
						),
			'img_wrap_height' => array(
							'type'		=> 'number',
							'default'	=> '',
						),
			'size' => array(
							'type'		=> 'string',
							'default'	=> 'full',
						),
			'image_fit' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'taxonomy' => array(
							'type'		=> 'string',
							'default'	=> 'category',
						),
			'limit' => array(
							'type'		=> 'number',
							'default'	=> 25,
						),
			'orderby' => array(
							'type'		=> 'string',
							'default'	=> 'name',
						),
			'order' => array(
							'type'		=> 'string',
							'default'	=> 'ASC',
						),
			'term_id' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'exclude_cat' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'parent_id' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'child_of' => array(
							'type'		=> 'string',
							'default'	=> '0',
						),
			'hide_empty' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'pagination' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'offset' => array(
							'type'		=> 'number',
							'default'	=> '',
						),
		),
		'render_callback' => 'pciwgas_pro_render_cat_grid',
	));


	// Register block, and explicitly define the attributes for slider
	register_block_type( 'pciwgas-pro/pci-cat-slider', array(
		'attributes' => array(
			'align' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'className' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'design' => array(
							'type'		=> 'string',
							'default'	=> 'design-1',
						),
			'show_title' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'show_count' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'show_desc' => array(
							'type'		=> 'boolean',
							'default'	=> true,
						),
			'link_target' => array(
							'type'		=> 'string',
							'default'	=> 'self',
						),
			'img_wrap_height' => array(
							'type'		=> 'number',
							'default'	=> '',
						),
			'size' => array(
							'type'		=> 'string',
							'default'	=> 'full',
						),
			'image_fit' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'slidestoshow' => array(
							'type'		=> 'number',
							'default'	=> 3,
						),
			'rows' => array(
							'type'		=> 'number',
							'default'	=> 1,
						),
			'slidestoscroll' => array(
							'type'		=> 'number',
							'default'	=> 1,
						),
			'dots' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'arrows' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'autoplay' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'autoplay_interval' => array(
							'type'		=> 'number',
							'default'	=> 3000,
						),
			'speed' => array(
							'type'		=> 'number',
							'default'	=> 300,
						),
			'loop' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'centermode' => array(
							'type'		=> 'string',
							'default'	=> 'false',
						),
			'hover_pause' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'focus_pause' => array(
							'type'		=> 'string',
							'default'	=> 'false',
						),
			'lazyload'	=> array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'taxonomy' => array(
							'type'		=> 'string',
							'default'	=> 'category',
						),
			'limit' => array(
							'type'		=> 'number',
							'default'	=> 25,
						),
			'orderby' => array(
							'type'		=> 'string',
							'default'	=> 'name',
						),
			'order' => array(
							'type'		=> 'string',
							'default'	=> 'ASC',
						),
			'term_id' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'exclude_cat' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'parent_id' => array(
							'type'		=> 'string',
							'default'	=> '',
						),
			'child_of' => array(
							'type'		=> 'string',
							'default'	=> '0',
						),
			'hide_empty' => array(
							'type'		=> 'string',
							'default'	=> 'true',
						),
			'offset' => array(
							'type'		=> 'number',
							'default'	=> '',
						),
		),
		'render_callback' => 'pciwgas_pro_render_cat_slider',
	));

	if ( function_exists( 'wp_set_script_translations' ) ) {
		wp_set_script_translations( 'pciwgas-block-js', 'post-category-image-with-grid-and-slider', PCIWGASPRO_DIR . '/languages' );
	}

}
add_action( 'init', 'pciwgas_pro_register_guten_block' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * 
 * @since 1.4
 */
function pciwgas_pro_editor_assets() {	

	// Block Editor CSS
	if( ! wp_style_is( 'wpos-guten-block-css', 'registered' ) ) {
		wp_register_style( 'wpos-guten-block-css', PCIWGASPRO_URL.'assets/css/blocks.editor.build.css', array( 'wp-edit-blocks' ), PCIWGASPRO_VERSION );
	}

	// Block Editor Script
	wp_enqueue_style( 'wpos-guten-block-css' );
	wp_enqueue_script( 'pciwgas-block-js' );
}
add_action( 'enqueue_block_editor_assets', 'pciwgas_pro_editor_assets' );

/**
 * Adds an extra category to the block inserter
 *
 * @since 1.4
 */
function pciwgas_pro_add_block_category( $categories ) {

	$guten_cats = wp_list_pluck( $categories, 'slug' );

	if( ! in_array( 'wpos_guten_block', $guten_cats ) ) {
		$categories[] = array(
							'slug'	=> 'wpos_guten_block',
							'title'	=> __('WPOS Blocks', 'post-category-image-with-grid-and-slider'),
							'icon'	=> null,
						);
	}

	return $categories;
}
add_filter( 'block_categories_all', 'pciwgas_pro_add_block_category' );