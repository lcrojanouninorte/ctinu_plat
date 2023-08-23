<?php
/**
 * WPBakery Class
 * Handles the WPBakery shortcode functionality of plugin
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pciwgas_Pro_Vc {

	function __construct() {

		// Action to add 'pci-cat-grid' shortcode in vc
		add_action( 'vc_before_init', array( $this, 'pciwgas_pro_integrate_vc' ) );
	}

	/**
	 * Function to add plugin shortcode in WPBakery Page Builder
	 * 
	 * @since 1.3
	 */
	function pciwgas_pro_integrate_vc() {

		// 'pci-cat-grid' Shortcode
		vc_map( array(
			'name'			=> 'WPOS - '.__( 'Categories in Grid View', 'post-category-image-with-grid-and-slider' ),
			'base'			=> 'pci-cat-grid',
			'icon'			=> 'icon-wpb-wp',
			'class'			=> '',
			'category'		=> __( 'Content', 'post-category-image-with-grid-and-slider'),
			'description'	=> __( 'Display post category in a grid view with various layouts.', 'post-category-image-with-grid-and-slider' ),
			'params'		=> array(
								// General settings
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Design', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'design',
									'value'			=> array(
															__( 'Grid Design 1', 'post-category-image-with-grid-and-slider' )	=> 'design-1',
															__( 'Grid Design 2', 'post-category-image-with-grid-and-slider' )	=> 'design-2',
															__( 'Grid Design 3', 'post-category-image-with-grid-and-slider' )	=> 'design-3',
															__( 'Grid Design 4', 'post-category-image-with-grid-and-slider' )	=> 'design-4',
															__( 'Grid Design 5', 'post-category-image-with-grid-and-slider' )	=> 'design-5',
															__( 'Grid Design 6', 'post-category-image-with-grid-and-slider' )	=> 'design-6',
															__( 'Grid Design 7', 'post-category-image-with-grid-and-slider' )	=> 'design-7',
															__( 'Grid Design 8', 'post-category-image-with-grid-and-slider' )	=> 'design-8',
															__( 'Grid Design 9', 'post-category-image-with-grid-and-slider' )	=> 'design-9',
															__( 'Grid Design 10', 'post-category-image-with-grid-and-slider' )	=> 'design-10',
														),
									'description'	=> __( 'Choose design.', 'post-category-image-with-grid-and-slider' ),
									'admin_label'	=> true,
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Grid', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'columns',
									'value'			=> array(
															__( 'Grid 1', 'post-category-image-with-grid-and-slider' )	=> '1',
															__( 'Grid 2', 'post-category-image-with-grid-and-slider' )	=> '2',
															__( 'Grid 3', 'post-category-image-with-grid-and-slider' )	=> '3',
															__( 'Grid 4', 'post-category-image-with-grid-and-slider' )	=> '4',
															__( 'Grid 5', 'post-category-image-with-grid-and-slider' )	=> '5',
															__( 'Grid 6', 'post-category-image-with-grid-and-slider' )	=> '6',
															__( 'Grid 7', 'post-category-image-with-grid-and-slider' )	=> '7',
															__( 'Grid 8', 'post-category-image-with-grid-and-slider' )	=> '8',
															__( 'Grid 9', 'post-category-image-with-grid-and-slider' )	=> '9',
															__( 'Grid 10', 'post-category-image-with-grid-and-slider' )	=> '10',
															__( 'Grid 11', 'post-category-image-with-grid-and-slider' )	=> '11',
															__( 'Grid 12', 'post-category-image-with-grid-and-slider' )	=> '12',
														),
									'std'			=> 3,
									'description'	=> __( 'Choose number to be displayed post per row.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Show Title', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'show_title',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Display category title.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Show Count', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'show_count',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Display category count post number.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Show Description', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'show_desc',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Display category description.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Link Behaviour', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'link_target',
									'value'			=> array(
															__( 'Same Window', 'post-category-image-with-grid-and-slider' )	=> 'self',
															__( 'New Window', 'post-category-image-with-grid-and-slider' )	=> 'blank',
														),
									'description'	=> __( 'Choose link behaviour.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Image Wrap Height', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'img_wrap_height',
									'value'			=> '',
									'description'	=> __( 'Control height of the category image. You can enter any numeric number. e.g. 250. Leave empty for default height.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Image Size', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'size',
									'value'			=> 'full',
									'description'	=> __( 'Choose WordPress registered image size. e.g.', 'post-category-image-with-grid-and-slider' ).' thumbnail, medium, large, full.',
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Image Fit', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'image_fit',
									'value'			=> array(
														__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
														__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
													),
									'description'	=> __( 'Fill the post image in a whole container.', 'post-category-image-with-grid-and-slider' )
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Extra Class', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'extra_class',
									'value'			=> '',
									'description'	=> __( 'Enter extra CSS class for design customization.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('Note: Extra class added as parent so using extra class you customize your design.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
								),

								//Data Settings
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Taxonomy', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'taxonomy',
									'value'			=> 'category',
									'description'	=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Total Items Limit', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'limit',
									'value'			=> 25,
									'description'	=> __( 'Enter number to be displayed.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Category Order By', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'orderby',
									'value'			=> array(
															__( 'Name', 'post-category-image-with-grid-and-slider' )		=> 'name',
															__( 'Term ID', 'post-category-image-with-grid-and-slider' )		=> 'term_id',
															__( 'Slug', 'post-category-image-with-grid-and-slider' )		=> 'slug',
															__( 'Term Group', 'post-category-image-with-grid-and-slider')	=> 'term_group',
															__( 'Description', 'post-category-image-with-grid-and-slider' )	=> 'description',
														),
									'description'	=> __( 'Select category order type.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Category Order', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'order',
									'value'			=> array(
															__( 'Ascending', 'post-category-image-with-grid-and-slider' )	=> 'asc',
															__( 'Descending', 'post-category-image-with-grid-and-slider' )	=> 'desc',
														),
									'description'	=> __( 'Display category order.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Display Specific category', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'term_id',
									'value'			=> '',
									'description'	=> __( 'Enter category id to display categories wise.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Exclude Category', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'exclude_cat',
									'value'			=> '',
									'description'	=> __( 'Exclude post category. Works only if `Category` field is empty.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Display Parent ID', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'parent_id',
									'value'			=> '',
									'description'	=> __( 'Enter parent category ID to retrieve direct-child terms of.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Display Child Category', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'child_of',
									'value'			=> 0,
									'description'	=> __( 'Enter parent category ID to retrieve all child terms of.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Hide Empty', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'hide_empty',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Whether to hide categories that do not have any posts attached to them.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class'			=> '',
									'heading' 		=> __( 'Pagination', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'pagination',
									'value' 		=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description' 	=> __( 'Display pagination.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Offset', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'offset',
									'value'			=> '',
									'min'			=> 0,
									'description'	=> __( 'Exclude number of category from starting.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('e.g. if you pass 5 then it will skip first five post. Note: This will not work with pagination=true.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
							)
		));

		
		// 'pci-cat-slider' Shortcode
		vc_map( array(
			'name'			=> 'WPOS - '.__( 'Categories in Slider View', 'post-category-image-with-grid-and-slider' ),
			'base'			=> 'pci-cat-slider',
			'icon'			=> 'icon-wpb-wp',
			'class'			=> '',
			'category'		=> __( 'Content', 'post-category-image-with-grid-and-slider'),
			'description'	=> __( 'Display post category in a slider view with various layouts.', 'post-category-image-with-grid-and-slider' ),
			'params'		=> array(
								// General settings
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Design', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'design',
									'value'			=> array(
															__( 'Grid Design 1', 'post-category-image-with-grid-and-slider' )	=> 'design-1',
															__( 'Grid Design 2', 'post-category-image-with-grid-and-slider' )	=> 'design-2',
															__( 'Grid Design 3', 'post-category-image-with-grid-and-slider' )	=> 'design-3',
															__( 'Grid Design 4', 'post-category-image-with-grid-and-slider' )	=> 'design-4',
															__( 'Grid Design 5', 'post-category-image-with-grid-and-slider' )	=> 'design-5',
															__( 'Grid Design 6', 'post-category-image-with-grid-and-slider' )	=> 'design-6',
															__( 'Grid Design 7', 'post-category-image-with-grid-and-slider' )	=> 'design-7',
															__( 'Grid Design 8', 'post-category-image-with-grid-and-slider' )	=> 'design-8',
															__( 'Grid Design 9', 'post-category-image-with-grid-and-slider' )	=> 'design-9',
															__( 'Grid Design 10', 'post-category-image-with-grid-and-slider' )	=> 'design-10',
														),
									'description'	=> __( 'Choose design.', 'post-category-image-with-grid-and-slider' ),
									'admin_label'	=> true,
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Show Title', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'show_title',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Display category title.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Show Count', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'show_count',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Display category count post number.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Show Description', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'show_desc',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Display category description.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Link Behaviour', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'link_target',
									'value'			=> array(
															__( 'Same Window', 'post-category-image-with-grid-and-slider' )	=> 'self',
															__( 'New Window', 'post-category-image-with-grid-and-slider' )	=> 'blank',
														),
									'description'	=> __( 'Choose link behaviour.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Image Wrap Height', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'img_wrap_height',
									'value'			=> '',
									'description'	=> __( 'Control height of the category image. You can enter any numeric number. e.g. 250. Leave empty for default height.', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Image Size', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'size',
									'value'			=> 'full',
									'description'	=> __( 'Choose WordPress registered image size. e.g.', 'post-category-image-with-grid-and-slider' ).' thumbnail, medium, large, full.',
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Image Fit', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'image_fit',
									'value'			=> array(
														__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
														__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
													),
									'description'	=> __( 'Fill the post image in a whole container.', 'post-category-image-with-grid-and-slider' )
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Extra Class', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'extra_class',
									'value'			=> '',
									'description'	=> __( 'Enter extra CSS class for design customization.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('Note: Extra class added as parent so using extra class you customize your design.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
								),

								//Slider Settings
								array(
									'type'			=> 'textfield',
									'class'			=> '',  
									'heading'		=> __( 'Slides To Show', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'slidestoshow',
									'value'			=> 3,
									'description'	=> __( 'Enter number for Slide to show at a time.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type' 			=> 'textfield',
									'class' 		=> '',
									'heading' 		=> __( 'Slides Row', 'post-category-image-with-grid-and-slider' ),
									'param_name' 	=> 'rows',
									'value' 		=> 1,
									'description' 	=> __( 'Enter number of rows for slider.', 'post-category-image-with-grid-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Slides To Scroll', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'slidestoscroll',
									'value'			=> 1,
									'description'	=> __( 'Enter number to scroll slider at a time.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Show Dots', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'dots',
									'value'			=> array(
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Show pagination dots.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Show Arrows', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'arrows',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Show Prev - Next arrows.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Autoplay', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'autoplay',
									'value'			=> array(
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Enable autoplay.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Autoplay Interval', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'autoplay_interval',
									'value'			=> 3000,
									'description'	=> __( 'Enter autoplay speed.', 'post-category-image-with-grid-and-slider' ),
									'dependency'	=> array(
															'element'	=> 'autoplay',
															'value'		=> array( 'true' ),
														),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Speed', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'speed',
									'value'			=> 300,
									'description'	=> __( 'Enter slide speed.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Loop', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'loop',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Enable infinite loop for continuous sliding.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Slider Centermode', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'centermode',
									'value'			=> array(
														__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
														__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
													),
									'std'			=> 'false',
									'description'	=> __( 'Enable centered view with partial prev/next slides. Use with odd numbered `Slides to Scroll` and `Slider Column` counts.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Pause On Hover', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'hover_pause',
									'value'			=> array(
															__( 'True', 'post-category-image-with-grid-and-slider' ) 	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' ) 	=> 'false',
														),
									'dependency' 	=> array(
															'element' 	=> 'autoplay',
															'value' 	=> array( 'true' ),
															),
									'description'	=> __( 'Pause slider autoplay on hover.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Pause On Focus', 'post-category-image-with-grid-and-slider' ),
									'param_name' 	=> 'focus_pause',
									'value' 		=> array(
															__( 'True', 'post-category-image-with-grid-and-slider' ) 	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' ) => 'false',
														),
									'dependency' 	=> array(
														'element' 	=> 'autoplay',
														'value' 	=> array( 'true' ),
														),
									'std'			=> 'false',
									'description' 	=> __( 'Pause slider autoplay when slider element is focused.', 'post-category-image-with-grid-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type' 			=> 'dropdown',
									'class' 		=> '',
									'heading' 		=> __( 'Slider Lazyload', 'post-category-image-with-grid-and-slider' ),
									'param_name' 	=> 'lazyload',
									'value' 		=> array(
															__( 'Select Lazyload', 'post-category-image-with-grid-and-slider' )	=> '',
															__( 'Ondemand', 'post-category-image-with-grid-and-slider' ) 		=> 'ondemand',
															__( 'Progressive', 'post-category-image-with-grid-and-slider' ) 	=> 'progressive',
														),
									'description' 	=> __( 'Select option to use lazy loading in slider.', 'post-category-image-with-grid-and-slider' ),
									'group' 		=> __( 'Slider Settings', 'post-category-image-with-grid-and-slider' ),
								),

								//Data Settings
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Taxonomy', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'taxonomy',
									'value'			=> 'category',
									'description'	=> __( 'Enter registered taxonomy name. You can find it on plugin setting page.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('Note: Be sure you have added valid taxonomy name otherwise no result will be displayed.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Total Items Limit', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'limit',
									'value'			=> 25,
									'description'	=> __( 'Enter number to be displayed.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Category Order By', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'orderby',
									'value'			=> array(
															__( 'Name', 'post-category-image-with-grid-and-slider' )		=> 'name',
															__( 'Term ID', 'post-category-image-with-grid-and-slider' )		=> 'term_id',
															__( 'Slug', 'post-category-image-with-grid-and-slider' )		=> 'slug',
															__( 'Term Group', 'post-category-image-with-grid-and-slider')	=> 'term_group',
															__( 'Description', 'post-category-image-with-grid-and-slider' )	=> 'description',
														),
									'description'	=> __( 'Select category order type.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Category Order', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'order',
									'value'			=> array(
															__( 'Ascending', 'post-category-image-with-grid-and-slider' )	=> 'asc',
															__( 'Descending', 'post-category-image-with-grid-and-slider' )	=> 'desc',
														),
									'description'	=> __( 'Display category order.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Display Specific category', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'term_id',
									'value'			=> '',
									'description'	=> __( 'Enter category id to display categories wise.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Exclude Category', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'exclude_cat',
									'value'			=> '',
									'description'	=> __( 'Exclude post category. Works only if `Category` field is empty.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('You can pass multiple ids with comma seperated. You can find id at relevant category listing page.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Display Parent ID', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'parent_id',
									'value'			=> '',
									'description'	=> __( 'Enter parent category ID to retrieve direct-child terms of.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Display Child Category', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'child_of',
									'value'			=> 0,
									'description'	=> __( 'Enter parent category ID to retrieve all child terms of.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'dropdown',
									'class'			=> '',
									'heading'		=> __( 'Hide Empty', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'hide_empty',
									'value'			=> array( 
															__( 'True', 'post-category-image-with-grid-and-slider' )	=> 'true',
															__( 'False', 'post-category-image-with-grid-and-slider' )	=> 'false',
														),
									'description'	=> __( 'Whether to hide categories that do not have any posts attached to them.', 'post-category-image-with-grid-and-slider' ),
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
								array(
									'type'			=> 'textfield',
									'class'			=> '',
									'heading'		=> __( 'Offset', 'post-category-image-with-grid-and-slider' ),
									'param_name'	=> 'offset',
									'value'			=> '',
									'min'			=> 0,
									'description'	=> __( 'Exclude number of category from starting.', 'post-category-image-with-grid-and-slider' ) . '<label title="'.__('e.g. if you pass 5 then it will skip first five post. Note: This will not work with pagination=true.', 'post-category-image-with-grid-and-slider').'"> [?]</label>',
									'group'			=> __( 'Data Settings', 'post-category-image-with-grid-and-slider' ),
								),
							)
		));
	}
}

$pciwgas_pro_vc = new Pciwgas_Pro_Vc();