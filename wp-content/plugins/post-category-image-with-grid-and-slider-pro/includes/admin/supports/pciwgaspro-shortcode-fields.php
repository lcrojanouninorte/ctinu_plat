<?php
/**
 * Shortcode Fields for Shortcode Preview   
 *
 * @package Post Category Image With Grid and Slider Pro 
 * @since 1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Generate 'pci-cat-grid' shortcode fields for preview
 * 
 * @since 1.3
 */
if( ! function_exists('pci_cat_grid_shortcode_fields') ) {
	function pci_cat_grid_shortcode_fields() { 

		$fields = array(
				// General fields
				'general' => array(
						'title'		=> __('General Parameters', 'post-category-image-with-grid-and-slider'),
						'params'	=>  array(
										// General settings
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Design', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'design',
												'value'		=> array(
																	'design-1'	=> __( 'Grid Design 1', 'post-category-image-with-grid-and-slider' ),
																	'design-2'	=> __( 'Grid Design 2', 'post-category-image-with-grid-and-slider' ),
																	'design-3'	=> __( 'Grid Design 3', 'post-category-image-with-grid-and-slider' ),
																	'design-4'  => __( 'Grid Design 4', 'post-category-image-with-grid-and-slider' ),
																	'design-5'  => __( 'Grid Design 5', 'post-category-image-with-grid-and-slider' ),
																	'design-6'  => __( 'Grid Design 6', 'post-category-image-with-grid-and-slider' ),
																	'design-7'  => __( 'Grid Design 7', 'post-category-image-with-grid-and-slider' ),
																	'design-8'  => __( 'Grid Design 8', 'post-category-image-with-grid-and-slider' ),
																	'design-9'  => __( 'Grid Design 9', 'post-category-image-with-grid-and-slider' ),
																	'design-10' => __( 'Grid Design 10', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Choose design.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Grid', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'columns',
												'value'		=> array(
																	'1'		=> __( 'Grid 1', 'post-category-image-with-grid-and-slider' ),
																	'2'		=> __( 'Grid 2', 'post-category-image-with-grid-and-slider' ),
																	'3'		=> __( 'Grid 3', 'post-category-image-with-grid-and-slider' ),
																	'4'		=> __( 'Grid 4', 'post-category-image-with-grid-and-slider' ),
																	'5'		=> __( 'Grid 5', 'post-category-image-with-grid-and-slider' ),
																	'6'		=> __( 'Grid 6', 'post-category-image-with-grid-and-slider' ),
																	'7'		=> __( 'Grid 7', 'post-category-image-with-grid-and-slider' ),
																	'8'		=> __( 'Grid 8', 'post-category-image-with-grid-and-slider' ),
																	'9'		=> __( 'Grid 9', 'post-category-image-with-grid-and-slider' ),
																	'10'	=> __( 'Grid 10', 'post-category-image-with-grid-and-slider' ),
																	'11'	=> __( 'Grid 11', 'post-category-image-with-grid-and-slider' ),
																	'12'	=> __( 'Grid 12', 'post-category-image-with-grid-and-slider' ),
																),
												'default'	=> 3,
												'desc'		=> __( 'Choose number to be displayed post per row.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Show Title', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'show_title',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Display category title.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Show Count', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'show_count',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Display category count post number.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Show Description', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'show_desc',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Display category description.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Link Behaviour', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'link_target',
												'value'		=> array(
																	'self'		=> __( 'Same Window', 'post-category-image-with-grid-and-slider' ),
																	'blank'		=> __( 'New Window', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Choose link behaviour.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'			=> 'number',
												'heading'		=> __( 'Image Wrap Height', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'img_wrap_height',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Control height of the category image. You can enter any numeric number. e.g. 250. Leave empty for default height.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Image Size', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'size',
												'value'			=> 'full',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Choose WordPress registered image size. e.g.', 'post-category-image-with-grid-and-slider' ).' thumbnail, medium, large, full.',
											),
											array(
												'type'			=> 'dropdown',
												'heading'		=> __( 'Image Fit', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'image_fit',
												'value'			=> array(
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'			=> __( 'Fill the post image in a whole container.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Extra Class', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'extra_class',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Enter extra CSS class for design customization.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('Note: Extra class added as parent so using extra class you customize your design.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
								)
				),

				//Data Settings	
				'data' => array(
						'title'		=> __('Data Parameters', 'post-category-image-with-grid-and-slider'),
						'params'	=> array(
										//Data Settings
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Taxonomy', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'taxonomy',
												'value'			=> 'category',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
											array(
												'type'		=> 'number',
												'heading'	=> __( 'Total Items Limit', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'limit',
												'value'		=> 25,
												'desc'		=> __( 'Enter number to be displayed.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Category Order By', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'orderby',
												'value'		=> array(
																	'name'			=> __( 'Name', 'post-category-image-with-grid-and-slider' ),
																	'term_id'		=> __( 'Term ID', 'post-category-image-with-grid-and-slider' ),
																	'slug'			=> __( 'Slug', 'post-category-image-with-grid-and-slider' ),
																	'term_group'	=> __( 'Term Group', 'post-category-image-with-grid-and-slider'),
																	'description'	=> __( 'Description', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Select category order type.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Category Order', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'order',
												'value'		=> array(
																	'asc'	=> __( 'Ascending', 'post-category-image-with-grid-and-slider' ),
																	'desc'	=> __( 'Descending', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Display category order.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Display Specific category', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'term_id',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Enter category id to display categories wise.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Exclude Category', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'exclude_cat',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Display Parent Category', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'parent_id',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Enter parent category ID to retrieve direct-child terms of.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'text',
												'heading'	=> __( 'Display Child Of Category', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'child_of',
												'value'		=> 0,
												'desc'		=> __( 'Enter category id to retrieve child terms of. If multiple taxonomies are passed, this will be ignored.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Hide Empty', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'hide_empty',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Whether to hide categories that do not have any posts attached to them.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type' 		=> 'dropdown',
												'heading' 	=> __( 'Pagination', 'post-category-image-with-grid-and-slider' ),
												'name' 		=> 'pagination',
												'value' 	=> array(
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ) ,
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc' 		=> __( 'Display pagination.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'number',
												'heading'	=> __( 'Offset', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'offset',
												'value'		=> '',
												'min'		=> 0,
												'desc'		=> __( 'Exclude number of category from starting.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('e.g. if you pass 5 then it will skip first five categories.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
								)
				),
		);
		return $fields;
	}
}

/**
 * Generate 'pci-cat-slider' shortcode fields for preview
 * 
 * @since 1.3
 */
if( ! function_exists('pci_cat_slider_shortcode_fields') ) {
	function pci_cat_slider_shortcode_fields() {

		$fields = array(
				// General fields
				'general' => array(
						'title'		=> __('General Parameters', 'post-category-image-with-grid-and-slider'),
						'params'	=>  array(
										// General settings
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Design', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'design',
												'value'		=> array(
																	'design-1'	=> __( 'Grid Design 1', 'post-category-image-with-grid-and-slider' ),
																	'design-2'	=> __( 'Grid Design 2', 'post-category-image-with-grid-and-slider' ),
																	'design-3'	=> __( 'Grid Design 3', 'post-category-image-with-grid-and-slider' ),
																	'design-4'	=> __( 'Grid Design 4', 'post-category-image-with-grid-and-slider' ),
																	'design-5'	=> __( 'Grid Design 5', 'post-category-image-with-grid-and-slider' ),
																	'design-6'	=> __( 'Grid Design 6', 'post-category-image-with-grid-and-slider' ),
																	'design-7'	=> __( 'Grid Design 7', 'post-category-image-with-grid-and-slider' ),
																	'design-8'	=> __( 'Grid Design 8', 'post-category-image-with-grid-and-slider' ),
																	'design-9'	=> __( 'Grid Design 9', 'post-category-image-with-grid-and-slider' ),
																	'design-10'	=> __( 'Grid Design 10', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Choose design.', 'post-category-image-with-grid-and-slider' ),
											),
											 array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Show Title', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'show_title',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Display category title.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Show Count', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'show_count',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Display category count post number.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Show Description', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'show_desc',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Display category description.', 'post-category-image-with-grid-and-slider' ),
											),
											 array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Link Behaviour', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'link_target',
												'value'		=> array(
																	'self'		=> __( 'Same Window', 'post-category-image-with-grid-and-slider' ),
																	'blank'		=> __( 'New Window', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Choose link behaviour.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'			=> 'number',
												'heading'		=> __( 'Image Wrap Height', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'img_wrap_height',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Control height of the category image. You can enter any numeric number. e.g. 250. Leave empty for default height.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Image Size', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'size',
												'value'			=> 'full',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Choose WordPress registered image size. e.g.', 'post-category-image-with-grid-and-slider' ).' thumbnail, medium, large, full.',
											),
											array(
												'type'			=> 'dropdown',
												'heading'		=> __( 'Image Fit', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'image_fit',
												'value'			=> array(
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'			=> __( 'Fill the post image in a whole container.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Extra Class', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'extra_class',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Enter extra CSS class for design customization.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('Note: Extra class added as parent so using extra class you customize your design.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
									)
				),
				//Slider Settings
				'slider' => array(
						'title'		=> __('Slider Parameters', 'post-category-image-with-grid-and-slider'),
						'params'	=> 	array(
											//Slider Settings
											array(
												'type'		=> 'number',
												'heading'	=> __( 'Slides To Show', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'slidestoshow',
												'value'		=> 3,
												'desc'		=> __( 'Enter number for Slide to show at a time.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type' 		=> 'number',
												'heading' 	=> __( 'Slides Row', 'post-category-image-with-grid-and-slider' ),
												'name' 		=> 'rows',
												'value' 	=> 1,
												'min'		=> 1,
												'desc' 		=> __( 'Enter number of rows for slider.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'number',
												'heading'	=> __( 'Slides To Scroll', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'slidestoscroll',
												'value'		=> 1,
												'desc'		=> __( 'Enter number to scroll slider at a time.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Show Dots', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'dots',
												'value'		=> array(
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Show pagination dots.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Show Arrows', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'arrows',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Show Prev - Next arrows.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Autoplay', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'autoplay',
												'value'		=> array( 
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Enable autoplay.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'number',
												'heading'	=> __( 'Autoplay Interval', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'autoplay_interval',
												'value'		=> 3000,
												'desc'		=> __( 'Enter autoplay speed.', 'post-category-image-with-grid-and-slider' ),
												'dependency'=> array(
																	'element'	=> 'autoplay',
																	'value'		=> array( 'true' ),
																),
											),
											array(
												'type'		=> 'number',
												'heading'	=> __( 'Speed', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'speed',
												'value'		=> 300,
												'desc'		=> __( 'Enter slide speed.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Loop', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'loop',
												'value'		=> array(
																	'true'  => __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false' => __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Enable infinite loop for continuous sliding.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Slider Centermode', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'centermode',
												'value'		=> array(
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'default'	=> 'false',
												'desc'		=> __( 'Enable centered view with partial prev/next slides. Use with odd numbered `Slides to Scroll` and `Slider Column` counts.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type' 			=> 'dropdown',
												'heading' 		=> __( 'Pause On Hover', 'post-category-image-with-grid-and-slider' ),
												'name' 			=> 'hover_pause',
												'value' 		=> array(
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'dependency' 	=> array(
																		'element' 	=> 'autoplay',
																		'value' 	=> array( 'true' ),
																		),
												'desc' 			=> __( 'Pause slider autoplay on hover.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Pause On Focus', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'focus_pause',
												'value'		=> array(
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'default'	=> 'false',
												'desc'		=> __( 'Pause slider autoplay when slider element is focused.', 'post-category-image-with-grid-and-slider' ),
												'dependency'=> array(
																	'element' 	=> 'autoplay',
																	'value' 	=> array( 'true' ),
																),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Slider Lazyload', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'lazyload',
												'value'		=> array(
																	''				=> __( 'Select Lazyload', 'post-category-image-with-grid-and-slider' ),
																	'ondemand'		=> __( 'Ondemand', 'post-category-image-with-grid-and-slider' ),
																	'progressive'	=> __( 'Progressive', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Select option to use lazy loading in slider.', 'post-category-image-with-grid-and-slider' ),
											),
									)
				),

				//Data Settings
				'data' => array(
						'title'		=> __('Data Settings', 'post-category-image-with-grid-and-slider'),
						'params'	=> array(
											//Data Settings
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Taxonomy', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'taxonomy',
												'value'			=> 'category',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
											array(
												'type'		=> 'number',
												'heading'	=> __( 'Total Items Limit', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'limit',
												'value'		=> 20,
												'desc'		=> __( 'Enter number to be displayed.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Category Order By', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'orderby',
												'value'		=> array(
																	'name'			=> __( 'Name', 'post-category-image-with-grid-and-slider' ),
																	'term_id'		=> __( 'Term ID', 'post-category-image-with-grid-and-slider' ),
																	'slug'			=> __( 'Slug', 'post-category-image-with-grid-and-slider' ),
																	'term_group'	=> __( 'Term Group', 'post-category-image-with-grid-and-slider'),
																	'description'	=> __( 'Description', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Select category order type.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Category Order', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'order',
												'value'		=> array(
																	'asc'	=> __( 'Ascending', 'post-category-image-with-grid-and-slider' ),
																	'desc'	=> __( 'Descending', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Display category order.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Display Specific category', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'term_id',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Enter category id to display categories wise.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Exclude Category', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'exclude_cat',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Exclude post category. Works only if `Category` field is empty.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
											array(
												'type'			=> 'text',
												'heading'		=> __( 'Display Parent Category', 'post-category-image-with-grid-and-slider' ),
												'name'			=> 'parent_id',
												'value'			=> '',
												'refresh_time'	=> 1000,
												'desc'			=> __( 'Enter parent category ID to retrieve direct-child terms of.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'text',
												'heading'	=> __( 'Display Child Of Category', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'child_of',
												'value'		=> 0,
												'desc'		=> __( 'Enter category id to retrieve child terms of. If multiple taxonomies are passed, this will be ignored.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'dropdown',
												'heading'	=> __( 'Hide Empty', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'hide_empty',
												'value'		=> array(
																	'true'	=> __( 'True', 'post-category-image-with-grid-and-slider' ),
																	'false'	=> __( 'False', 'post-category-image-with-grid-and-slider' ),
																),
												'desc'		=> __( 'Whether to hide categories that do not have any posts attached to them.', 'post-category-image-with-grid-and-slider' ),
											),
											array(
												'type'		=> 'number',
												'heading'	=> __( 'Offset', 'post-category-image-with-grid-and-slider' ),
												'name'		=> 'offset',
												'value'		=> '',
												'min'		=> 0,
												'desc'		=> __( 'Exclude number of category from starting.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('e.g. if you pass 5 then it will skip first five categories.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
											),
									)
				),
		);
		return $fields;
	}
}