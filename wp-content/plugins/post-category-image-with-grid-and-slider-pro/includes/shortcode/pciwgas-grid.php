<?php
/**
 * 'pci-cat-grid' Shortcode
 * 
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function pciwgas_pro_render_cat_grid( $atts, $content = '' ) {

	// SiteOrigin Page Builder Gutenberg Block Tweak - Do not Display Preview
	if( isset( $_POST['action'] ) && ($_POST['action'] == 'so_panels_layout_block_preview' || $_POST['action'] == 'so_panels_builder_content_json') ) {
		return '<div class="pciwgas-builder-shrt-prev">
					<div class="pciwgas-builder-shrt-title"><span>'.esc_html__('Post Category Image Grid - Shortcode', 'post-category-image-with-grid-and-slider').'</span></div>
					[pci-cat-grid]
				</div>';
	}

	// Shortcode Parameter
	$atts = shortcode_atts(array(
			'limit'				=> 25,
			'size'				=> 'full',
			'taxonomy'			=> 'category',
			'term_id'			=> null, 
			'parent_id'			=> '',
			'design'			=> 'design-1',
			'orderby'			=> 'name',
			'order'				=> 'ASC',
			'columns'			=> 3,
			'show_title'		=> 'true',
			'show_count'		=> 'true',
			'show_desc'			=> 'true',
			'hide_empty'		=> 'true',
			'image_fit'			=> 'true',
			'link_target'		=> 'self',
			'img_wrap_height'	=> '',
			'child_of'			=> 0,
			'exclude_cat'		=> array(),
			'offset'			=> '',
			'pagination'		=> 'true',
			'extra_class'		=> '',
			'className'			=> '',
			'align'				=> '',
			'dev_param_1'		=> '',
			'dev_param_2'		=> '',
	), $atts, 'pci_cat_grid');

	$cat_designs			= pciwgas_pro_cat_designs();
	$supported_taxonomy		= pciwgas_pro_get_opt( 'pciwgas_category', array() );
	$atts['unique']			= pciwgas_pro_get_unique();
	$atts['limit']			= pciwgas_pro_clean_number( $atts['limit'], 0 );
	$atts['offset']			= pciwgas_pro_clean_number( $atts['offset'], 0 );
	$atts['img_wrap_height']= pciwgas_pro_clean_number( $atts['img_wrap_height'], '' );
	$atts['columns']		= pciwgas_pro_clean_number( $atts['columns'], 3 );
	$atts['columns']		= ( $atts['columns'] <= 12 )						? $atts['columns']												: 3;
	$atts['height_css']		= ! empty( $atts['img_wrap_height'] )				? "height:{$atts['img_wrap_height']}px;" : '';
	$atts['size']			= ! empty( $atts['size'] )							? $atts['size']													: 'full';
	$atts['taxonomy']		= ( ! empty( $atts['taxonomy'] ) && in_array( $atts['taxonomy'], $supported_taxonomy ) ) ? $atts['taxonomy']		: '';
	$atts['parent_id']		= ! empty( $atts['parent_id'] )						? $atts['parent_id']											: '';	
	$atts['term_id']		= ! empty( $atts['term_id'] )						? explode( ',', $atts['term_id'] )								: '';
	$atts['exclude_cat']	= ! empty( $atts['exclude_cat'] )					? explode( ',', $atts['exclude_cat'] ) 							: array();
	$atts['design']			= ( $atts['design'] && ( array_key_exists( trim( $atts['design'] ), $cat_designs ) ) ) ? trim( $atts['design'] )	: 'design-1';
	$atts['show_title']		= ( $atts['show_title'] == 'true' )					? true															: false;
	$atts['show_count']		= ( $atts['show_count'] == 'true' )					? true															: false;
	$atts['show_desc']		= ( $atts['show_desc'] == 'true' )					? true															: false;
	$atts['hide_empty']		= ( $atts['hide_empty'] == 'false' )				? false															: true;
	$atts['image_fit']		= ( $atts['image_fit'] == 'false' )					? 0																: 1;
	$atts['link_target']	= ( $atts['link_target'] == 'blank' )				? '_blank'														: '_self';
	$atts['pagination']		= ( $atts['pagination'] == 'false' )				? false															: true;
	$atts['paged']			= ! empty( $_GET['pciwgas-term-page'] )				? pciwgas_pro_clean_number( $_GET['pciwgas-term-page'], 1 )		: 1;
	$atts['align']			= ! empty( $atts['align'] )							? 'align'.$atts['align']										: '';
	$atts['extra_class']	= $atts['extra_class'] .' '. $atts['align'] .' '. $atts['className'];
	$atts['extra_class']	= pciwgas_pro_sanitize_html_classes( $atts['extra_class'] );
	$atts['dev_param_1']	= ! empty( $atts['dev_param_1'] )					? $atts['dev_param_1']											: '';
	$atts['dev_param_2']	= ! empty( $atts['dev_param_2'] )					? $atts['dev_param_2']											: '';
	$atts['query_offset']	= $atts['offset'];
	$atts['term_total']		= 0;
	$atts['lazyload'] 		= '';

	extract( $atts );

	// Return if no valid taxonomy
	if( empty( $taxonomy ) ) {
		return $content;
	}

	$count = 1;

	// Tweak when offset is present and limit is set to show all then override limit with big number
	// To make offset work
	if( $offset && $limit == 0 ) {
		$limit = 9999;
	}

	// Taking care of query offset with pagination
	if( $pagination && $paged > 1 ) {
		$query_offset = $offset + ( ($paged - 1) * $limit );
	}

	$atts['main_wrap_cls']	= "pciwgas-{$design} {$extra_class}";
	$atts['main_wrap_cls']	.= ( $image_fit ) ? ' pciwgas-image-fit' : '';

	$args = array(
		'taxonomy'		=> $taxonomy,
		'number'		=> $limit,
		'orderby'		=> $orderby,
		'order'			=> $order,
		'include'		=> $term_id,
		'exclude'		=> $exclude_cat,
		'parent'		=> $parent_id,
		'hide_empty'	=> $hide_empty,
		'child_of'		=> $child_of,
		'offset'		=> $query_offset,
		'hierarchical'	=> ( ! $child_of && '' === $parent_id ) ? false : true,
	);

	// Count Variables
	$args 				= apply_filters( 'pci_cat_query_args', $args, $atts, 'pci_cat_grid' );
	$args 				= apply_filters( 'pci_cat_grid_query_args', $args, $atts );
	$post_categories 	= get_terms( $args );

	ob_start();

	if ( ! is_wp_error( $post_categories ) && ! empty( $post_categories ) ) {

		// If pagination is there then take count of all match terms
		if( $pagination && $limit > 0 && $limit != 9999 ) {
			$args['number']		= 9999;
			$args['fields']		= 'ids';
			$args['offset']		= $offset;

			$pagi_cats			= get_terms( $args );
			$atts['term_total']	= ! is_array( $pagi_cats ) ? $pagi_cats : count( $pagi_cats );
		}

		pciwgas_pro_get_template('grid/loop-start.php', $atts);

		foreach ( $post_categories as $category ) {

			$atts['term_link']		= pciwgas_pro_get_term_link( $category, $taxonomy );
			$atts['category_image']	= pciwgas_pro_term_image( $category->term_id, $size, true );
			$atts['category_name']	= $category->name;
			$atts['category_desc']	= $category->description;
			$atts['category_count']	= $category->count;

			// wrapper class
			$atts['wrapper_cls']	= "pciwgas-post-cat-grid pciwgas-cat-{$category->term_id} pciwgas-medium-{$columns} pciwgas-columns";
			$atts['wrapper_cls']	.= ( $count % $columns == 1 )		? ' pciwgas-first'	: '';
			$atts['wrapper_cls']	.= ( ! $atts['category_image'] )	? ' pciwgas-no-img' : '';

			// Include shortcode html file
			pciwgas_pro_get_template("grid/{$design}.php", $atts, null, null, "designs/{$design}.php");

			$count++;
		}

		pciwgas_pro_get_template('grid/loop-end.php', $atts);
	}

	$content .= ob_get_clean();
	return $content;
}

// Category Grid Shortcode
add_shortcode( 'pci-cat-grid', 'pciwgas_pro_render_cat_grid' );