<?php
// Avoid direct calls to this file
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


/**
 * set 'time' setting to false to hide time in event date
 *
 * @author bojana
 * @param array $setting
 *
 * @return array
 */
function tribe_events_event_schedule_details_formatting_hidetime($settings)
{
	 $settings['time'] = false;
	 return $settings;
	 
}

//echo get_locale();

function get_event_categories() {
	$event_posts = tribe_get_events();
	$event_posts = apply_filters( 'ecs_filter_events_after_get', $event_posts, '' );
	/**
	 * Show Categories of every events
	 *
	 * @author bojana
	 */
	$categories = new stdClass();
	$categories->total_count = 0;
	$categories->object = array();
	if ( $posts or apply_filters( 'ecs_always_show', false, $atts ) ) {
		foreach( (array) $event_posts as $post_index => $event_post ) {
			setup_postdata( $event_post->ID );
			
			if ( apply_filters( 'ecs_skip_event', false, $atts, $event_post ) )
				continue;
			
			$category_list = get_the_terms( $event_post, 'tribe_events_cat' );
			
			
			if ( is_array( $category_list ) ) {
				foreach ( (array) $category_list as $category ) {
					/**
					 * Show Categories of every events
					 *
					 * @author bojana
					 */
					$category->id = $category->term_id;
					$category->name = $category->name;
					$categories->object[] = $category;
				}
			}
		}
	}

	$categories->total_count = count($categories->object);
	
	return $categories;
}

global $gl_decm_dateFormatStr;

function setDateFormat($attr) {
	global $gl_decm_dateFormatStr;
	$gl_decm_dateFormatStr = $attr;
}
function getDateFormat($attr) {
	global $gl_decm_dateFormatStr;

	return $gl_decm_dateFormatStr;
}


class DECM_EventDisplay extends ET_Builder_Module {

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @see	 add_shortcode()
	 */
	
	//public $slug       = 'decm_event_display';
	//public $child_slug = 'decm_event_display_child';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'Pee-Aye Creative',
		'author_uri' => 'www.peeayecreative.com',
	);

	public function init() {
		$this->name = esc_html__( 'Events Feed', 'decm-divi-event-calendar-module' );
		$this->plural    = esc_html__( 'Events Feed', 'decm-divi-event-calendar-module' );
		// $this->name       = esc_html__( 'Accordion', 'et_builder' );
		// $this->plural     = esc_html__( 'Accordions', 'et_builder' );
		 $this->slug       = 'decm_event_display';
		// $this->vb_support = 'on';
		// $this->child_slug = 'dicm_cta_child';

		// $this->slug             = 'decm_event_display';
		// $this->main_class = '%%order_class%%';
		// $this->child_slug = 'decm_event_display_child';	
		 //$this->child_item_text  = esc_html__( 'Filter', 'decm-divi-event-calendar-module');

	}

	public function get_settings_modal_toggles() {
	  return array(
		
			'gerneral' => array(
				'toggles' => array(
								
					'decm_content' => array(
						'priority' => 1,
						'title' => esc_html__( 'Content', 'decm-divi-event-calendar-module' ),
					),	
					'elements' => array(
						'priority' => 2,
						'title' => esc_html__( 'Elements', 'decm-divi-event-calendar-module' ),
					),
					'layout' => array(
						'priority' => 12,
						'title' => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					),	
					'callout_box' => array(
						'priority' => 15,
						'title' => esc_html__( 'Callout Box', 'decm-divi-event-calendar-module'),
					),			

					'details_toggle' => array(
						'priority' => 18,
						'title' => esc_html__( 'Details', 'decm-divi-event-calendar-module'),
					),
				
					'excerpt_toggle' => array(
						'priority' => 19,
						'title' => esc_html__( 'Excerpt', 'decm-divi-event-calendar-module'),
					),
				
					'more_info_button' => array(
						'priority' => 20,
						'title' => esc_html__( 'More Info Button', 'decm-divi-event-calendar-module'),
					),
					
					'pagination_options' => array(
						'priority' => 40,
						'title' => esc_html__( 'Pagination', 'decm-divi-event-calendar-module'),
					),
					
					'no_results_message' => array(
						'priority' => 45,
						'title' => esc_html__( 'No Results Message', 'decm-divi-event-calendar-module'),
					),
					'google_calendar_button' => array(
						'priority' => 49,
						'title' => esc_html__( 'Google Calendar Button', 'decm-divi-event-calendar-module'),
					),
					'ical_export_button' => array(
						'priority' => 65,
						'title' => esc_html__( 'ICAL Export Button', 'decm-divi-event-calendar-module'),
					),

					'decm_connection_id' => array(
						'priority' => 71,
						'title' => esc_html__( 'Connection', 'decm-divi-event-calendar-module'),
					),
					
				),
			),
			'advanced' => array(
				'toggles' => array(
					//'layout'  => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					//'filters_search'  => esc_html__( 'Filters', 'decm-divi-event-calendar-module' ),
					//'filters_dropdown'  => esc_html__( 'Filters Dropdown', 'decm-divi-event-calendar-module' ),
					//'filters_active'  => esc_html__( 'Active Filters', 'decm-divi-event-calendar-module' ),
					'event'  => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
					'thumbnail'  => esc_html__( 'Image', 'decm-divi-event-calendar-module' ),
					'details'  => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					'callout'  => esc_html__( 'Callout', 'decm-divi-event-calendar-module' ),					
				),
			),
		);
	}
/**
	 * Module's advanced fields configuration
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	
	function get_advanced_fields_config() {
		return array(
			'text'           => false,
			'button'         => false,
			'link_options'          => false,
			
			'background'            => array(
				'has_background_color_toggle' => true,
				'options' => array(

					'background_color' => array(
						'depends_show_if'  => 'on',
						'default'          => 'Transparent',
						//'default'          => et_builder_accent_color(),
					),
					'use_background_color' => array(
						'default'          => 'on',
						
					),
				),
			),
			
			'borders'        => array(
				'default' => array(
					'css'      => array(
						'main' => array (
							'border_radii' => " %%order_class%%",
							'border_styles' => " %%order_class%%",
							
						),
						'important' => 'all',
					),
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
				),
				'thumbnail_border'   => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .ecs-event-list  .ecs-event .act-post  .wp-post-image, %%order_class%%  .decm-cover-image-overlay",
							'border_styles' => "%%order_class%% .ecs-event-list  .ecs-event .act-post  .wp-post-image, %%order_class%%  .decm-cover-image-overlay",
							
						),
						'important' => 'all',
					),
					'show_if_not'         => array(
						'layout' => 'cover',
					),
					'label_prefix' => esc_html__( 'Image Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'thumbnail',
					//'default'          => 'solid',
					'defaults' => array(
						'border_radii' => 'on|4px|4px|4px|4px',
						'border_styles' => array(
							'style' => 'solid',
						),
					),
				),
				'event_border'   => array(
					'css'          => array(
						'main' => array (
							'border_radii' =>"%%order_class%% .ecs-event .act-post",
							'border_styles' =>"%%order_class%%.ecs-event-list,%%order_class%% .ecs-event .act-post",	
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Event Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'event',
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
				),		
				'details_border'   => array(
					'css'          => array(
						'main' => array (
							'border_radii' => "%%order_class%% .decm-events-details, %%order_class%%  .decm-events-details-cover",
							'border_styles' => "%%order_class%% .decm-events-details, %%order_class%%  .decm-events-details-cover",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Details ', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the border for the event details with all the standard border settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'details',
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
				),
				'callout_border'   => array(
					'css'          => array(
						'main' => array (
							'border_radii' => "%%order_class%% .callout-box-grid,%%order_class%%  .callout-box-cover,%%order_class%%  .callout-box-list",
							'border_styles' => "%%order_class%% .callout-box-grid,%%order_class%%  .callout-box-cover,%%order_class%%  .callout-box-list",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Callout', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the border for the event callout box with all the standard border settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'callout',
					'defaults' => array(
						'border_radii' => 'on|4px|4px|4px|4px',
					),
					//'default'          => 'solid',
					// 'defaults' => array(
					// 	'border_radii' => 'on|4px|4px|4px|4px',
					// 	'border_styles' => array(
					// 		'width' => '0px',
					// 		'color' => '#000',
					// 		'style' => 'solid',
					// 	),
					// ),
				),

				'filter_border'   => array(
					'css'          => array(
						'main' => array (
								'border_radii' => "%%order_class%% .dec-filter-label",
								'border_styles' => "%%order_class%% .dec-filter-label",
							
						),
						// 'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Filter Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_search',
					'defaults' => array(
						'border_radii' => 'on|18px|18px|18px|18px',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#d5d5d5',
							'style' => 'solid',
						),
					),
				),

				'filter_dropdown_border'   => array(
					'css'          => array(
						'main' => array (
								'border_radii' => "%%order_class%% .dec-filter-list",
								'border_styles' => "%%order_class%% .dec-filter-list",
							
						),
						// 'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Filter Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_dropdown',
					'defaults' => array(
						'border_radii' => 'on|18px|18px|18px|18px',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#d5d5d5',
							'style' => 'solid',
						),
					),
				),

				'active_filter_border'   => array(
					'css'          => array(
						'main' => array (
								'border_radii' => "%%order_class%% .dec-filter-select",
								'border_styles' => "%%order_class%% .dec-filter-select",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Active Filter Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_active',
					'defaults' => array(
						'border_radii' => 'on|18px|18px|18px|18px',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#000',
							'style' => 'solid',
						),
					),
				),
			),
		
			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main' => "%%order_class%%",
					),
				),
				
			'image_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .ecs-event-list  .ecs-event .act-post  .wp-post-image",
					),
					'label'         => esc_html__( 'Image Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the event featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'thumbnail',
					//'default'          => 'solid',
					'show_if_not'     => array(
						'layout' => 'cover',
					),
				),
				'event_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .ecs-event-list .ecs-event .act-post",
					),
					
					'label'         => esc_html__( 'Event Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the individual events with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'event',
					//'default'          => 'solid',
				),

				'details_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .decm-events-details, %%order_class%%  .decm-events-details-cover",
					),
					
					'label'         => esc_html__( 'Details Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the event details with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'details',
					//'default'          => 'solid',
				),
				'callout_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%%  .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list",
					),		
					'label'         => esc_html__( 'Callout Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the event callout box with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'callout',
					//'default'          => 'solid',
				),

				'filter_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-label",
					),
					
					'label'         => esc_html__( 'Filter Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the individual events with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_search',
					//'default'          => 'solid',
				),

				'filter_dropdown_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-list",
					),
					
					'label'         => esc_html__( 'Filter Dropdown Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the individual events with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_dropdown',
					//'default'          => 'solid',
				),

				'filter_active_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-select",
					),
					
					'label'         => esc_html__( 'Active Filter Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the individual events with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_active',
					//'default'          => 'solid',
				),

			),
			

			'filters'        => array(
				'child_filters_target' => array(
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'image',
				),
				'css'                  => array(
					'main' => '%%order_class%%',
				),
			),
			'fonts'          => array(
				// 'view_more_border_radius'  => array(
				// 	'border_radius' => '91',
				// ),
				'title' => array(
					'css'          => array(
						'main'      => "%%order_class%% .entry-title, %%order_class%% .entry-title a",				
						'important' => 'all',
					),
					'header_level' => array(
						'css'          => array(
							'main'      => "%%order_class%% .entry-title, %%order_class%% .entry-title a",
							'important' => 'all',
						),
					),
					'label'        => esc_html__( 'Title', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event title text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),
				'duration' => array(
					'css'          => array(
						'main'      => "%%order_class%% span.decm_date,%%order_class%% span.decm_time,%%order_class%% span.decm_venue,%%order_class%% span.decm_location, %%order_class%% span.decm_organizer,%%order_class%% span.decm_price,%%order_class%% span.decm_weburl a, %%order_class%% .ecs-categories a",
						'important' => 'all',
					),
					'toggle_priority' => 80,
					'label'        => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),
				'duration_labels' => array(
					'css'          => array(
						'main'      => "%%order_class%% .ecs-detail-label",
						'important' => 'all',
					),
					'toggle_priority' => 80,
					'label'        => esc_html__( 'Details Labels', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),
				'excerpt' => array(
					'css'          => array(
						'main'      => "%%order_class%% p.ecs-excerpt",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Excerpt', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),

				'callout_date' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_date",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Date', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
					'font_size' => array(
						'default' => '26',
					),
					
				),


				'callout_month' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_month",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Month', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),


				'callout_day_of_the_week' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_weekDay",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Day Of The Week', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),
				
				'callout_year' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_year",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Year', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),
				'results_message' => array(
					'css'          => array(
						'main'      => "%%order_class%% .events-results-message",
						'important' => 'all',
					),
					'label'        => esc_html__( 'No Results Message', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event results message text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),
				'event_pagination_numaric' => array(
					'css'          => array(
						'main'      => "%%order_class%% .ecs-event-pagination span, %%order_class%% .ecs-event-pagination a",
						'important' => 'all',
						'text_align' => "%%order_class%% .ecs-event-pagination",
						'hover'  => "%%order_class%% .ecs-event-pagination span:hover, %%order_class%% .ecs-event-pagination a:hover",	
					),
					'label'        => esc_html__( 'Pagination', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event pagination text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),

				'filter_label' => array(
					'css'          => array(
						'main'      =>  "%%order_class%% .dec-filter-label",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Label', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the lable text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'filters_search',
				),

			),

			'max_width'      => array(
				'toggle_title'    => esc_html__( 'Sizing', 'decm-divi-event-calendar-module'),
				'css' => array(
					'main' => "%%order_class%%",
					'important' => 'all',
				),
			),
			
			
			'button'         => array(
                'view_more' => array(
					'label'         => esc_html__( 'More Info Button', 'decm-divi-event-calendar-module' ),
					'description'		=> esc_html__( 'Enable this feature to customize the appearance of the button', 'decm-divi-event-calendar-module' ),
                    'css'           => array(
						'main' => " %%order_class%%.et_pb_button_wrapper,%%order_class%% .act-view-more",
						'plugin_main' =>" %%order_class%%.et_pb_button_wrapper,%%order_class%% .act-view-more",
						'alignment'   => "%%order_class%% p.ecs-showdetail",
						'important' => 'all',	
					),
					//'all_buttons_border_radius'                    => '7',
					'use_alignment' => array(
						'label'         => esc_html__( 'alignment of era', 'decm-divi-event-calendar-module' ),
						'description'		=> esc_html__( 'Enable this feature to customize the appearance of the button', 'decm-divi-event-calendar-module' ),
					),
					'box_shadow'    => false,

					'text_size'           => array(
						'default' => '20px',
					),	
		
					'margin_padding' => array(
						'css' => array(
							'margin' => "%%order_class%% p.ecs-showdetail",
					         'padding' => "%%order_class%% .act-view-more",
							'important' => 'all',
						),
						'custom_margin' => array(
					'default' => '15px|auto|auto|auto|false|false',
				     ),
					),
				
				
				),
				'ajax_load_more_button' => array(
					'label'         => __( 'Load More Button', 'decm-divi-event-calendar-module' ),
					'use_alignment' => true,
					'box_shadow'    => false,
					'css'           => array(
						'main'        => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .ecs-ajax_load_more",
						'plugin_main' => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .ecs-ajax_load_more",
						'alignment'   => "%%order_class%% .event_ajax_load",
						'important' => 'all',
					),
					'margin_padding' => array(
						'css' => array(
							'margin' => "%%order_class%% div.event_ajax_load",
					         'padding' => "%%order_class%% .ecs-ajax_load_more",
							//'main'      => "%%order_class%% .et_pb_button_wrapper,%%order_class%% a.et_pb_button",
							'important' => 'all',
						),
						'custom_margin' => array(
					'default' => '15px|auto|auto|auto|false|false',
				),
				),
				),
				
            ),

		);
	}
	public function get_fields() {
		return array(
			'module_css_class'     => array(
				'label'           => esc_html__( 'Connection ID', 'decm_event_filter' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a module connection identification keyword to link the functionality of multiple modules together.', 'decm_event_filter' ),
				'toggle_slug'     => 'decm_connection_id',
			),
			'use_shortcode' => array(
				'label'           => esc_html__( 'Use Event Calendar Short Code', 'act-divi' ),
				'type'            => 'hidden',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'affects'           => array(
					'src_back',
					'background_color',
				),
				'default' => 'off',
				'description'        => esc_html__( 'Use Event Calendar Short Code ', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'elements',
			),
			'shortcode_param' => array(
				'label'             => esc_html__( 'shortcode_param', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Total number of events to show.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'elements',
				'default'           => '',
				'show_if' => array(
					'use_shortcode'=>'on',
				)
			),

			'use_current_loop'=> array(
				'label'				=> esc_html__( 'Dynamic Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to turn on or off dynamic content which allows you to place the module in a Divi Theme Builder layout to dynamically display events based on the template assignment.', 'decm-divi-event-calendar-module' ),		
				'toggle_slug'     => 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'show_past' => array(
                'label'           => esc_html__( 'Events Status', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to show either future or past events in the feed.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
					'future_events'   => __( 'Future', 'decm-divi-event-calendar-module' ),
                    'past_events'   => __( 'Past', 'decm-divi-event-calendar-module' ),              
                ],
                //'mobile_options'  => true,
                'toggle_slug'     => 'decm_content',
				 'default' => 'future_events',
			),


			'show_feature_image'=> array(
				'label'				=> esc_html__( 'Show Featured Image', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event featured image.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'show_title'=> array(
				'label'				=> esc_html__( 'Show Title', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event title.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_date'=> array(
				'label'				=> esc_html__( 'Show Date', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event date.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'date_format' => array(
				'label'             => esc_html__( 'Details Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			
			'show_time'=> array(
				'label'				=> esc_html__( 'Show Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_date'=>'on',
				)
			),

			'time_format' => array(
				'label'             => esc_html__( 'Details Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'show_end_time'=> array(
				'label'				=> esc_html__( 'Show End Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_time'=>'on',
				)
			),

			'show_timezone'=> array(
				'label'				=> esc_html__( 'Show Time Zone', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_time'=>'on',
					'show_date'=>'on',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),
			'show_venue'=> array(
				'label'				=> esc_html__( 'Show Venue', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_location'=> array(
				'label'				=> esc_html__( 'Show Location', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				// 'affects' => array(
				// 	'show_street',
				// 	'show_locality',
				// 	'show_postal',
				// 	'show_country',
				// ),
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				
			),


			'show_street'=> array(
				'label'				=> esc_html__( 'Show Location Street Address', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location street address.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					 'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),

			'show_locality'=> array(
				'label'				=> esc_html__( 'Show Location Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location locality.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),

			'show_postal'=> array(
				'label'				=> esc_html__( 'Show Location Postal Code', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location postal code.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),

			'show_country'=> array(
				'label'				=> esc_html__( 'Show Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location country.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),

			'show_name'=> array(
				'label'				=> esc_html__( 'Show Organizer', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event organizer.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_price' => array(
				'label'				=> esc_html__( 'Show Price', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event price.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_category'=> array(
				'label'				=> esc_html__( 'Show Category', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event category.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_weburl' => array(
				'label'				=> esc_html__( 'Show Website', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event website URL.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'show_excerpt'=> array(
				'label'				=> esc_html__( 'Show Excerpt', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event excerpt.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'excerpt_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			
			'show_detail'=> array(
				'label'				=> esc_html__( 'Show More Info Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event more info button.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'more_info_button',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

		
			'show_callout_box'=> array(
				'label'				=> esc_html__( 'Show Callout Box', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the callout box.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'on',
				'affects'  => array(
					'show_callout_day_of_week',
					'show_callout_month',
					'show_callout_date',
					'show_callout_year',
					'callout_date_format',
					'callout_week_format',
					'callout_month_format',
					'callout_year_format',
				),
				'show_if_not' => array(
						'list_layout' => array(
							'rightimage_leftdetail',		
							'leftimage_rightdetail',						
							),
			   ),
			),

			'show_callout_date'=> array(
				'label'				=> esc_html__( 'Show Callout Box Date', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout box date.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),
			'callout_date_format' => array(
				'label'             => esc_html__( 'Callout Box Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				
				'default'           => 'd',
				'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_date' => 'on',
				)
			),
			'show_callout_month'=> array(
				'label'				=> esc_html__( 'Show Callout Box Month', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout month.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),

			'callout_month_format' => array(
				'label'             => esc_html__( 'Callout Box Month Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'           => 'F',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_month' => 'on',
				),
				'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
			),



			'show_callout_day_of_week'=> array(
				'label'				=> esc_html__( 'Show Callout Box Day of the Week', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout box day of the week.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				// 'show_if_not'=>array(
				// 	'layout'=>'list',
				// ),
				'show_if' => array(
					'use_shortcode'=>'off',
				
				)
			),

			'callout_week_format' => array(
				'label'             => esc_html__( 'Callout Box Day of the Week Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'callout_box',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => 'D',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_day_of_week'=>'on',
				)
			),

			'show_callout_year'=> array(
				'label'				=> esc_html__( 'Show Callout Box Year', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout box year.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),
			'callout_year_format' => array(
				'label'             => esc_html__( 'Callout Box year Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'callout_box',
				'default'           => 'Y',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_year'=>'on',
				),
				'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
			),
			/* Elements from event calendar shortcode pluin */
			'show_google_calendar'=> array(
				'label'				=> esc_html__( 'Show Google Calendar', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button to add the event to your Google Calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_ical_export'=> array(
				'label'				=> esc_html__( 'Show Ical Export', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button to export the event Apple iCal.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_preposition'=> array(
				'label'				=> esc_html__( 'Show Prepositions & Dividers', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the prepositions and dividers in the event details. This setting is best used with the option to stack event details.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),
			'show_data_one_line'=> array(
				'label'				=> esc_html__( 'Stack Event Details', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to stack each of the event details on their own lines instead of showing them in the default sentence format.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'general',
                //'mobile_options'  => true,
				'toggle_slug'     => 'details_toggle',
				'default'			=> 'on',
				'affects'         => array(
					'show_icon_label'
				),
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
		
			'show_icon_label' => array(
                'label'           => esc_html__( 'Show Labels/Icons', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to add labels or icons before each event item. This setting is best used with the option to stack event details.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'none'   => __( 'None',  'decm-divi-event-calendar-module' ),
                    'label'   => __( 'Labels', 'decm-divi-event-calendar-module' ),
                    'icon'   => __( 'Icons', 'decm-divi-event-calendar-module' ),
					'label_icon'   => __( 'Labels And Icons', 'decm-divi-event-calendar-module' ),
                  
                ],
                
                'tab_slug'		  => 'general',
                //'mobile_options'  => true,
                'toggle_slug'     => 'details_toggle',
				 'default' => 'label_icon',
			),

			'event_order' => array(
                'label'           => esc_html__( 'Events Order', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the order of events in the feed.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
					'DESC'   => __( 'Descending', 'decm-divi-event-calendar-module' ),
                    'ASC'   => __( 'Ascending', 'decm-divi-event-calendar-module' ),                
                ],
                //'mobile_options'  => true,
                'toggle_slug'     => 'decm_content',
				 'default' => 'ASC',
			),
			/* Content Options from Blog Module */
			'event_count' => array(
				'label'             => esc_html__( 'Events Count', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose the total number of events to show in the feed. Remember, you can use pagination options as well for the website visitor to load more events.', 'decm-divi-event-calendar-module' ),
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'toggle_slug'       => 'decm_content',
				'default'           => 6,
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'included_categories' => array(
				'label'            => esc_html__( 'Included Categories', 'decm-divi-event-calendar-module' ),
				'type'             => 'categories',
				'option_category'  => 'configuration',
				'renderer_options' => array(
					'use_terms' => true,
					'term_name' => 'tribe_events_cat',
					
				),
				// 'meta_categories'  => array(
				// 	'ture'     => esc_html__( 'Featured Events', 'decm-divi-event-calendar-module' ),
				// ),
				'description'      => esc_html__( 'Choose which event categories you would like to show in the feed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_content',
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'show_past'=> array(
						'future_events',
						'past_events',
					),
				),
			),

			'featured_events'=> array(
				'label'				=> esc_html__( 'Only Show Featured Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the featured events in the feed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				// 'computed_affects'   => array(
				// 	'__getEvents',
				// ),
			),

			'show_recurring_events'=> array(
				'label'				=> esc_html__( 'Show Recurring Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show all recurring events in the feed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				// 'computed_affects'   => array(
				// 	'__getEvents',
				// ),
			),
			'render_Classes' => array(
				'type'             => 'hidden',
				'option_category'  => 'configuration',
				'toggle_slug'      => 'decm_content',
				'default'		   => $this->module_classname( 'decm_event_display' ),
			),
			

			'excerpt_length' => array(
				'label'             => esc_html__( 'Excerpt Length', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'If you are showing the event excerpt, this setting allows you to set a specific character limit for the text. The WordPress default is 270 characters.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'excerpt_toggle',
				'default'           => '270',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'result_message' => array(
				'label'             => esc_html__( 'No Results Message', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text to show for the no results message.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'no_results_message',
				'default'           => 'There are no upcoming events at this time.',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'blog_offset' => array(
				'label'             => esc_html__( 'Events Offset Number', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose how many events you want to skip in the feed. This is helpful if you want to feature one event at the top in a different module or style, then add a second module and start with the second event by inputting the number 1.', 'decm-divi-event-calendar-module' ),
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'toggle_slug'       => 'decm_content',
				'default'           => 0,
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
		
			
			'layout' => array(
                'label'           => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the type of layout you want to use to display your events.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'grid'   => __( 'Grid',  'decm-divi-event-calendar-module' ),
                    'list'   => __( 'List', 'decm-divi-event-calendar-module' ),
                    'cover'   => __( 'Cover', 'decm-divi-event-calendar-module' ),
                    
                ],              
                'tab_slug'		  => 'general',
               // 'mobile_options'  => true,
                'toggle_slug'     => 'layout',
                'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
				 'default' => 'grid',
			),

			'list_layout' => array(
                'label'           => esc_html__( 'List Type', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose which items to include in your list layout. Each item creates a separate column within each event. The items show in order from left to right.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'leftimage_rightdetail'   => __( 'Image, Details',  'decm-divi-event-calendar-module' ),
                    'calloutleftimage_rightdetail'   => __( 'Callout, Image, Details', 'decm-divi-event-calendar-module' ),
					'calloutleftimage_rightdetailButton'   => __( 'Callout, Image, Details, Button' , 'decm-divi-event-calendar-module' ),
					'rightimage_leftdetail'   => __( 'Details, Image', 'decm-divi-event-calendar-module' ),
					'calloutrightimage_leftdetail'   => __( 'Callout, Details, Image', 'decm-divi-event-calendar-module' ),
					'calloutrightimage_leftdetailButton'   => __( 'Callout, Details, Image, Button', 'decm-divi-event-calendar-module' ),
                    
                ],              
                'tab_slug'		  => 'general',
               // 'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'layout' => array(
						'list',
					),
					
				),
				 'default' => 'calloutleftimage_rightdetail',
			),

			'columns' => array(
                'label'           => esc_html__( 'Number of Columns', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the number of columns for the events layout on each device.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
                    '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
                    '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
                    '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
                ],
                
                'tab_slug'		  => 'general',
                'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'layout' => array(
						'grid',
					),
					
				),
				 'default' => '3',
			),

			'cover_columns' => array(
                'label'           => esc_html__( 'Number of Columns', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the number of columns for the events layout on each device.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
                    '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
                    '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
                    '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
                ],
                
                'tab_slug'		  => 'general',
                'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'layout' => array(
						'cover',
					),	
				),
				 'default' => '3',
			),

			'list_columns' => array(
                'label'           => esc_html__( 'Number of Columns', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the number of columns for the events layout on each device.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
                    '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
                    // '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
                    // '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
                ],
                
                'tab_slug'		  => 'general',
                'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'layout' => array(
						'list',
					),			
				),
				 'default' => '1',
			),
			
			'image_align' => array(
                'label'           => esc_html__( 'Alignment', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the alignment of the event featured image and details. Note that the alignment is sometimes dependent on the number of columns chosen.', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
                'option_category' => 'layout',
                'options'		=>[
					//'leftimage_rightdetail'   => __( 'Image Left, Details Right',  'decm-divi-event-calendar-module' ),
					'topimage_bottomdetail'   => __( 'Image Top,  Details  Bottom',  'decm-divi-event-calendar-module' ),
					//'rightimage_leftdetail'   => __( 'Image Right, Details Left',  'decm-divi-event-calendar-module' ),

                ],
                'default'         => 'topimage_bottomdetail',
                'tab_slug'		  => 'advanced',
               // 'mobile_options'  => false,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'columns' => array(
						'1',
						'2',
					),
					
				 ),
			),

			'open_toggle_background_color' => array(
				'label'             => esc_html__( 'Event Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the individual events.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'event',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),


			'details_background_color' => array(
				'label'             => esc_html__( 'Details Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'details',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'show_image_overlay' => array(
				'label'             => esc_html__( 'Show Image Overlay', 'decm-divi-event-calendar-module' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
				),
				'description'        => esc_html__( 'Choose to show an overlay color over the event featured image.', 'decm-divi-event-calendar-module' ),
				'tab_slug'          => 'advanced',
				'toggle_slug'        => 'thumbnail',
				'show_if'     => array(
					'layout' => 'cover',
					'show_feature_image' => 'on',
				),	
				'default'   => 'on',
			),

			'overlay_image_background_color' => array(
				'label'             => esc_html__( 'Image Overlay Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the image overlay.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'thumbnail',
				'default'           => 'rgba(0,0,0,0.5)',	
				'show_if'           => array(
					'layout' => 'cover',
					'show_image_overlay' => 'on',
					'show_feature_image' => 'on',
				),
				'mobile_options'    => true,
			),
			'callout_background_color' => array(
				'label'             => esc_html__( 'Callout Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the event callout box.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				// 'css'      => array(
				// 	'main' =>"{$this->main_css_element} .ecs-event-list  .ecs-event .act-post",
				// ),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'callout',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'details_link_color' => array(
				'label'             => esc_html__( 'Details Link Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the link text in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,			
				'tab_slug'          => 'advanced',
				'toggle_priority' => 16,
				'toggle_slug'       => 'duration',
				'priority' => 24,
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			

			'details_icon_color' => array(
				'label'             => esc_html__( 'Details Icon Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the icons in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'duration',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'details_label_color' => array(
				'label'             => esc_html__( 'Details Label Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the label text in the event details.', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'duration_labels',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			
            'cards_spacing' => array(
                'label'           => esc_html__( 'Event Margin', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the outside of the individual events.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'event',
				'tab_slug'		  => 'advanced',
				'mobile_options'    => true,
                'computed_affects' => array(
                    '__posts',
                ),

            ),
			
            'event_inner_spacing' => array(
                'label'           => esc_html__( 'Event Padding', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the inside of the individual events.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'event',
                'tab_slug'		  => 'advanced',
				'mobile_options'  => true,
				'computed_affects' => array(
                    '__posts',
                ),

			),

		
			'__posts' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				'computed_depends_on' => array(
					'event_count',
					'date_format',
					'time_format',
					'show_name',
					'use_current_loop',
					
				),
			),
			'__page'          => array(
				'type'              => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				'computed_affects'  => array(
				'__posts',
				),
			),
			'__getEvents'          => array(
				'type'              => 'computed',
				'computed_callback' => array( 'DECM_EventDisplay', 'get_blog_posts_events' ),
				'computed_depends_on'  => array(
					//'events_to_load',
					'show_recurring_events',
					'featured_events',
					'event_count',
					'event_order',
					'date_format',
					'time_format',
					'show_name',
					'show_past',
					'blog_offset',
					'included_categories',
					'total_events',
					'callout_year_format',
					'callout_month_format',
					'callout_week_format',
					'callout_date_format',
					'website_link',
			        'custom_website_link_text',
			        'custom_website_link_target',
					'enable_category_links',
				),
			),

			//Extra Design settings
			'view_more_text' => array(
                'label'           => esc_html__( 'More Info Button Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'more_info_button',
				'default'         => esc_html__( 'More Info', 'decm-divi-event-calendar-module' ),
				'dynamic_content'  => 'text',
				'mobile_options'   => true,
				//'hover'            => 'tabs',
                'computed_affects' => array(
                    '__posts',
                ),

            ),
			'view_more_icons_list' => array(
                'label'           => esc_html__( 'Button Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'more_info_button',
                'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
            ),
			'align' => array(
				'label'           => esc_html__( 'Image Alignment', 'decm-divi-event-calendar-module' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'default_on_front' => 'left',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'thumbnail',
				'description'     => esc_html__( 'Choose to align the event featured image to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				'options_icon'    => 'module_align',
				'show_if'     => array(
					'layout' => 'grid',
				),
				//'mobile_options'  => true,
			),

			'stack_label_icon'=> array(
				'label'				=> esc_html__( 'Stack Labels/Icons', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to stack each of the labels/icons on their own lines above the event detail instead of on the left.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_data_one_line'=>'on',
				),
				'show_if_not' => array(
					'show_icon_label'=>'none',
				)
			),
			'thumbnail_margin' => array(
				'label' => __('Image Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'thumbnail',
				'show_if_not'     => array(
					'layout' => 'cover',
				),
				'default'         => '||14px|',
				'mobile_options'  => true,
			),
			'thumbnail_padding' => array(
				'label' => __('Image Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'thumbnail',
				'show_if_not'     => array(
					'layout' => 'cover',
				),
				'mobile_options'  => true,
			),

			'details_margin' => array(
				'label' => __('Details Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event details.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'details',
				'show_if_not'     => array(
					'layout' => 'cover',
				),	
				'mobile_options'  => true,
			),


			'details_margin_overlay' => array(
				'label' => __('Details Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event details.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'details',
				'show_if'     => array(
					'layout' => 'cover',
				),	
				'mobile_options'  => true,
			),
			'details_padding' => array(
				'label' => __('Details Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event details.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'details',
				'show_if_not'     => array(
					'layout' => 'cover',
				),	
				'mobile_options'  => true,
			),
			'details_padding_overlay' => array(
				'label' => __('Details Padding' , 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event details.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'details',
				'default'         => '20px|20px|20px|20px',
				'computed_affects'   => array(
					'__getEvents',
				),
				'show_if'     => array(
					'layout' => 'cover',
				),		
				'mobile_options'  => true,
			),
			'callout_margin' => array(
				'label' => __('Callout Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event callout box.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'callout',
				'default'         => '||10px|',
				'mobile_options'  => true,
			),
			'callout_padding' => array(
				'label' => __('Callout Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event callout box.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'callout',
				'default'         => '10px|10px|10px|10px',
				'mobile_options'  => true,
			),
			'thumbnail_width' => array(
				'label'           => esc_html__( 'Image Width', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'thumbnail',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '800',
				'allow_empty'     => true,
				'responsive'      => true,
				'show_if_not'     => array(
					'layout' => 'cover',
				),	
				'mobile_options'  => true,
				
			),
			
			'button_align'=> array(
				'label'				=> esc_html__( 'Align To Bottom', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'view_more',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to align the button to the bottom.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'advanced',
                'mobile_options'  => true,
				'toggle_slug'     => 'view_more',
				'default'			=> 'off',
				'show_if_not'     => array(
					'layout' => 'list',
				),				
				'computed_affects'   => array(
					'__getEvents',
				),
			),

			'button_make_fullwidth'=> array(
				'label'				=> esc_html__( 'Make Fullwidth', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'view_more',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to make the more info button fullwidth.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'advanced',
              //  'mobile_options'  => true,
				'toggle_slug'     => 'view_more',
				'default'			=> 'off',
				// 'show_if_not'     => array(
				// 	'layout' => 'list',
				// ),				
				// 'computed_affects'   => array(
				// 	'__getEvents',
				// ),
			),

			'equal_height'=> array(
				'label'				=> esc_html__( 'Equal Height', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'equal_height',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to a equal heights of events.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'advanced',
                'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'default'			=> 'on',
				'show_if'     => array(
					'layout' => 'cover',
				),				
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
			),
			'show_pagination' => array(
				'label'             => esc_html__( 'Show Pagination', 'decm-divi-event-calendar-module' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
				),
				'description'        => esc_html__( 'Choose to use pagination for showing additional events.', 'decm-divi-event-calendar-module' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'        => 'pagination_options',
				'default'   => 'off',
				//'mobile_options'    => true,
				'hover'             => 'tabs',
			),
			'pagination_type'     => array(
				'label'           => __( 'Pagination Type', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'paged'  => __( 'Paged', 'decm-divi-event-calendar-module' ),
					'numeric_pagination' => __( 'Numeric', 'decm-divi-event-calendar-module' ),
					'load_more' => __( 'Load More Button', 'decm-divi-event-calendar-module' ),									
				),
				'default'         => 'load_more',
				'show_if'         => array( 'show_pagination' => 'on' ),
				'description'     => __( 'Choose a method of pagination you would like to use to load additional events. You can choose to use a standard Paged pagination or a Load More Button.', 'decm-divi-event-calendar-module' ),
				//'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
			),
			'events_to_load' => array(
				'label'           => __( 'Number Of Events To Load', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => __( 'Choose the number of events that load each time the load more button is clicked.', 'decm-divi-event-calendar-module' ),
				'show_if'         => array(
					'show_pagination' => 'on',
					'pagination_type' => 'load_more',
					'use_shortcode'=>'off',
				),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
				//'default'           => 2,
			),
			'ajax_load_more_text' => array(
				'label'           => __( 'Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Load More', 'decm-divi-event-calendar-module' ),
				'show_if'         => array(
					'show_pagination' => 'on',
					'pagination_type' => 'load_more',
				),
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
			),
			
			'ajax_load_more_icons_list' => array(
                'label'           => esc_html__( 'Load More Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			),
			'google_calendar_text' => array(
				'label'           => __( 'Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'option_category' => 'configuration',
				'default'         => __( 'Google Calendar', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'load_more',
			),
			'google_calendar_icons_list' => array(
                'label'           => esc_html__( 'google caledar Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			),
			'ical_text' => array(
				'label'           => __( 'Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'option_category' => 'configuration',
				'default'         => __( 'Ical Export', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'load_more',
			),

			'ical_icons_list' => array(
                'label'           => esc_html__( 'ICAL Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			),
			'datetime_separator' => array(
                'label'           => esc_html__( 'Date Time Seprator', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Date Time Seprator', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         =>  tribe_get_option( 'dateTimeSeparator', ' @ ' ),
			),
			'time_range_separator' => array(
                'label'           => esc_html__( 'Time Range Seprator', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Time Range Seprator', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         =>  tribe_get_option( 'timeRangeSeparator', ' - ' ),
			),



			'single_event_page_link' => array(
				'label'           => esc_html__( 'Single Event Page Links', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to disable or replace the links to the single event page.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'default'   => __( 'Default',  'decm-divi-event-calendar-module' ),
					'disable_link'   => __( 'Disable Links', 'decm-divi-event-calendar-module' ),
					'replace_link'   => __( 'Replace With Custom Link', 'decm-divi-event-calendar-module' ),
					'redirect_link'   => __( 'Redirect To Website Link', 'decm-divi-event-calendar-module' ),				  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => 'defualt',
			),
			'disable_event_title_link'      => array(
				'label'            => esc_html__( 'Disable Event Title Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event title from linking to the single event page.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'off',
				'show_if' => array(
					'single_event_page_link'=>'disable_link',
				)
			),
			'disable_event_image_link'      => array(
				'label'            => esc_html__( 'Disable Event Image Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event featured image from linking to the single event page.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'off',
				'show_if' => array(
					'single_event_page_link'=>'disable_link',
				)
			),
			'disable_event_button_link'      => array(
				'label'            => esc_html__( 'Disable Event Button Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event more info button from linking to the single event pages.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'off',
				'show_if' => array(
					'single_event_page_link'=>'disable_link',
				)
			),
			'custom_event_link_url' => array(
				'label'             => esc_html__( 'Custom Single Event Page Link URL', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter a custom URL to use instead of the default single event page link.', 'decm-divi-event-calendar-module' ),
				'tab_slug'			=>'general',
				'toggle_slug'       => 'link_show',
				'show_if' => array(
					'single_event_page_link'=>'replace_link',
				)
			),	

			'custom_event_link_target' => array(
				'label'           => esc_html__( 'Custom Single Event Page Link Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the custom single event page link opens in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
			),

			'enable_category_links'      => array(
				'label'            => esc_html__( 'Enable Category Links',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to add links to the categories to link to their own archive pages.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'on',
			),

			'website_link' => array(
				'label'           => esc_html__( 'Website Link', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose an option for displaying the website link.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'default_text'   => __( 'Show Default Text',  'decm-divi-event-calendar-module' ),
					'url'   => __( 'Show URL', 'decm-divi-event-calendar-module' ),
					'custom_text'   => __( 'Show Custom Text', 'decm-divi-event-calendar-module' ), 
				],
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => 'default_text',
			),
			'custom_website_link_text' => array(
				'label'             => esc_html__( 'Custom Website Link Text', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the website link.', 'decm-divi-event-calendar-module' ),
				'tab_slug'			=>'general',
				'toggle_slug'       => 'link_show',
				'show_if' => array(
					'website_link'=>'custom_text',
				),
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
			),	

			'custom_website_link_target' => array(
				'label'           => esc_html__( 'Website Link Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the website link opens in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],
		
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
			),			
		);
	}
	

	public function get_icon_list($icon_list = array())
	{
		$escapedHtmlAttr = array();
		foreach((array) $icon_list as $icon_html)
		{
			$escapedHtmlAttr[] = esc_attr( $icon_html );
		}
		return json_encode($escapedHtmlAttr);
	}
	
	public function apply_custom_margin_padding($function_name, $slug, $type, $class, $important = true)
	{
		$slug_value = $this->props[$slug];
		$slug_value_tablet = $this->props[$slug . '_tablet'];
		$slug_value_phone = $this->props[$slug . '_phone'];
		$slug_value_last_edited = $this->props[$slug . '_last_edited'];
		$slug_value_responsive_active = et_pb_get_responsive_status($slug_value_last_edited);

		if (isset($slug_value) && !empty($slug_value)) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value, $type, $important),
			));
		}

		if (isset($slug_value_tablet) && !empty($slug_value_tablet) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value_tablet, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
		}

		if (isset($slug_value_phone) && !empty($slug_value_phone) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value_phone, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
		}
	}
	
	public function get_custom_style($slug_value, $type, $important) {
		return  sprintf('%1$s: %2$s%3$s;', $type, $slug_value, $important? ' !important' : '');
	}

	public function apply_custom_width($function_name, $slug, $type, $class, $important = true)
	{
		$slug_value = $this->props[$slug];
		$slug_value_tablet = $this->props[$slug . '_tablet'];
		$slug_value_phone = $this->props[$slug . '_phone'];
		$slug_value_last_edited = $this->props[$slug . '_last_edited'];
		$slug_value_responsive_active = et_pb_get_responsive_status($slug_value_last_edited);

		if (isset($slug_value) && !empty($slug_value)) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value, $type, $important),
			));
		}

		if (isset($slug_value_tablet) && !empty($slug_value_tablet) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value_tablet, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
		}

		if (isset($slug_value_phone) && !empty($slug_value_phone) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value_phone, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
		}
	}



	
	public function getrenderClassNameSelector($Classes,$render_slug){
		foreach((array) explode(' ',$Classes)  as $ClassName){
			if(strpos($ClassName,$render_slug.'_') !== false){
				return '.'.$ClassName;		
			}
		}
	}
	
	
	public function render( $attrs, $content = null, $render_slug ) {

		// echo '<pre>';
		// print_r($this->props);
		// echo '</pre>';

		$atts = array();	
		$no_results_message = $this->props['result_message'];	
		$event_order = $this->props['event_order'];	
		$use_shortcode = $this->props['use_shortcode'];
		$shortcode_param = $this->props['shortcode_param'];
		$show_feature_image = $this->props['show_feature_image'];
		$show_title = $this->props['show_title'];
		$show_name = $this->props['show_name'];
		$show_price = $this->props['show_price'];
		$show_weburl = $this->props['show_weburl'];	
		$website_link = $this->props['website_link'];
		$custom_website_link_text = $this->props['custom_website_link_text'];
		$custom_website_link_target = $this->props['custom_website_link_target'];
     	$show_date = $this->props['show_date'];
		$show_time = $this->props['show_time'];
		$show_end_time = $this->props['show_end_time'];
		$show_timezone = $this->props['show_timezone'];		
		$show_venue = $this->props['show_venue'];
		$show_location = $this->props['show_location'];
		$dec_show_location_street_address = $this->props['show_street'];
		$dec_show_location_locality = $this->props['show_locality'];
		$dec_show_location_postal_code = $this->props['show_postal'];
		$dec_show_location_country = $this->props['show_country'];
		$show_excerpt = $this->props['show_excerpt'];
		$list_layout = $this->props['list_layout'];
		$disable_event_title_link = $this->props['disable_event_title_link'];
		$enable_category_links = $this->props['enable_category_links'];	
		$disable_event_image_link = $this->props['disable_event_image_link'];
		$disable_event_button_link = $this->props['disable_event_button_link'];
		$custom_event_link_url = $this->props['custom_event_link_url'];
		$single_event_page_link = $this->props['single_event_page_link'];
		$custom_event_link_target = $this->props['custom_event_link_target'];
		$decm_show_callout_box = $this->props['show_callout_box'];
		$decm_button_make_fullwidth  = $this->props['button_make_fullwidth'];
		$decm_show_callout_date = $this->props['show_callout_date'];	
		$decm_callout_date_format = $this->props['callout_date_format'];
		$decm_show_callout_month = $this->props['show_callout_month'];
		$decm_callout_month_format = $this->props['callout_month_format'];
		$decm_show_callout_year = $this->props['show_callout_year'];
		$decm_callout_year_format = $this->props['callout_year_format'];
		$decm_show_callout_day_of_week = $this->props['show_callout_day_of_week'];	
		$decm_callout_week_format = $this->props['callout_week_format'];	
		$show_category = $this->props['show_category'];
		$show_ical_export=$this->props['show_ical_export'];
		$show_google_calendar=$this->props['show_google_calendar'];
		$show_detail = $this->props['show_detail'];
		$show_image_overlay = $this->props['show_image_overlay'];
		$datetime_separator = $this->props['datetime_separator'];
		$time_range_separator = $this->props['time_range_separator'];
		$overlay_image_background_color = $this->props["overlay_image_background_color"];
        $overlay_image_background_color_responsive_active = isset($this->props["overlay_image_background_color"]) && et_pb_get_responsive_status($this->props["overlay_image_background_color_last_edited"]);
        $overlay_image_background_color_tablet = $overlay_image_background_color_responsive_active && $this->props["overlay_image_background_color_tablet"] ? $this->props["overlay_image_background_color_tablet"] : $overlay_image_background_color;
        $overlay_image_background_color_phone = $overlay_image_background_color_responsive_active && $this->props["overlay_image_background_color_phone"] ? $this->props["overlay_image_background_color_phone"] : $overlay_image_background_color_tablet;
		$details_background_color = $this->props["details_background_color"];
        $details_background_color_responsive_active = isset($this->props["details_background_color"]) && et_pb_get_responsive_status($this->props["details_background_color_last_edited"]);
        $details_background_color_tablet = $details_background_color_responsive_active && $this->props["details_background_color_tablet"] ? $this->props["details_background_color_tablet"] : $details_background_color;
        $details_background_color_phone = $details_background_color_responsive_active && $this->props["details_background_color_phone"] ? $this->props["details_background_color_phone"] : $details_background_color_tablet;
		$callout_background_color = $this->props["callout_background_color"];
        $callout_background_color_responsive_active = isset($this->props["callout_background_color"]) && et_pb_get_responsive_status($this->props["callout_background_color_last_edited"]);
        $callout_background_color_tablet = $callout_background_color_responsive_active && $this->props["callout_background_color_tablet"] ? $this->props["callout_background_color_tablet"] : $callout_background_color;
        $callout_background_color_phone = $callout_background_color_responsive_active && $this->props["callout_background_color_phone"] ? $this->props["callout_background_color_phone"] : $callout_background_color_tablet;	
		$open_toggle_background_color = $this->props["open_toggle_background_color"];
        $open_toggle_background_color_responsive_active = isset($this->props["open_toggle_background_color"]) && et_pb_get_responsive_status($this->props["open_toggle_background_color_last_edited"]);
        $open_toggle_background_color_tablet = $open_toggle_background_color_responsive_active && $this->props["open_toggle_background_color_tablet"] ? $this->props["open_toggle_background_color_tablet"] : $open_toggle_background_color;
        $open_toggle_background_color_phone = $open_toggle_background_color_responsive_active && $this->props["open_toggle_background_color_phone"] ? $this->props["open_toggle_background_color_phone"] : $open_toggle_background_color_tablet;
		$details_link_color = $this->props["details_link_color"];
        $details_link_color_responsive_active = isset($this->props["details_link_color"]) && et_pb_get_responsive_status($this->props["details_link_color_last_edited"]);
        $details_link_color_tablet = $details_link_color_responsive_active && $this->props["details_link_color_tablet"] ? $this->props["details_link_color_tablet"] : $details_link_color;
        $details_link_color_phone = $details_link_color_responsive_active && $this->props["details_link_color_phone"] ? $this->props["details_link_color_phone"] : $details_link_color_tablet;
		$details_icon_color = $this->props ['details_icon_color' ];
        $details_icon_color_responsive_active = isset($this->props["details_icon_color"]) && et_pb_get_responsive_status($this->props["details_icon_color_last_edited"]);
        $details_icon_color_tablet = $details_icon_color_responsive_active && $this->props["details_icon_color_tablet"] ? $this->props["details_icon_color_tablet"] : $details_icon_color;
        $details_icon_color_phone = $details_icon_color_responsive_active && $this->props["details_icon_color_phone"] ? $this->props["details_icon_color_phone"] : $details_icon_color_tablet;
		$details_label_color = $this->props ['details_label_color' ];
        $details_label_color_responsive_active = isset($this->props["details_label_color"]) && et_pb_get_responsive_status($this->props["details_label_color_last_edited"]);
        $details_label_color_tablet = $details_label_color_responsive_active && $this->props["details_label_color_tablet"] ? $this->props["details_label_color_tablet"] : $details_label_color;
        $details_label_color_phone = $details_label_color_responsive_active && $this->props["details_label_color_phone"] ? $this->props["details_label_color_phone"] : $details_label_color_tablet;	
		$show_past = $this->props['show_past'];
		$featured_events = $this->props['featured_events'];
		$show_data_one_line = $this->props['show_data_one_line'];
		$event_count = $this->props['event_count'];
		$events_to_load = $this->props['events_to_load'];
		$included_categories = $this->props['included_categories'];
		$date_format = $this->props['date_format'];
		$time_format = $this->props['time_format'];
		$excerpt_length = $this->props['excerpt_length'];
		$blog_offset = $this->props['blog_offset'];
		$layout = $this->props['layout'];
		$columns_tablet = '';
		$Column_Type = $this->props['columns'] == '' ? 1 : $this->props['columns'];
		$Column_list_type = $this->props['list_columns'] == '' ? 1 : $this->props['list_columns'];
		$columns_phone = $this->props['columns_phone'];
		$columns_tablet = $this->props['columns_tablet'];
		$list_columns_phone = $this->props['list_columns_phone'];
		$list_columns_tablet = $this->props['list_columns_tablet'];
		$cover_columns_phone = $this->props['cover_columns_phone'];
		$cover_columns_tablet = $this->props['cover_columns_tablet'];
		$cover_columns = $this->props['cover_columns'] == '' ? 1 : $this->props['cover_columns'];
		$image_align = $this->props['image_align'];
		$button_align = $this->props['button_align'];
		$equal_height = $this->props['equal_height'];
		$cards_spacing = $this->props['cards_spacing'];
		$event_inner_spacing = $this->props['event_inner_spacing'];
		$view_more_text = $this->props['view_more_text'];
		$ajax_load_more_text = $this->props['ajax_load_more_text'];
		$ical_text = $this->props['ical_text'];
		$google_calendar_text = $this->props['google_calendar_text'];
		$show_pagination = $this->props['show_pagination'];
		$show_recurring_events = $this->props['show_recurring_events'];
		$background_color                = $this->props['background_color'];
		$header_level  =  $this->props['title_level'] == "" ? 'h4' : $this->props['title_level'];
		$show_preposition = $this->props['show_preposition'];
		$use_current_loop = $this->props['use_current_loop'] ;
		$pagination_type  = $this->props['pagination_type'];
		$align            = $this->props['align'];
		$show_icon_label =  $this->props['show_icon_label'];
		$stack_label_icon = $this->props['stack_label_icon'];

		
	 	$custom_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'view_more_icon' );
		
		$custom_icon                     = isset( $custom_icon_values['desktop'] ) ? $this->props['view_more_icon'] == '' ? '' : esc_attr( et_pb_process_font_icon( $custom_icon_values['desktop'] ) ) : '';
		$custom_icon_tablet              = isset( $custom_icon_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['tablet'] ) ) : '';
		$custom_icon_phone               = isset( $custom_icon_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['phone'] ) ) : '';
		$custom_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'view_more_icon' );
		$custom_icon_load_values              = et_pb_responsive_options()->get_property_values( $this->props, 'ajax_load_more_button_icon' );
		$custom_icon_load                     = isset( $custom_icon_load_values['desktop'] ) ? $this->props['ajax_load_more_button_icon'] == '' ? '' : esc_attr( et_pb_process_font_icon( $custom_icon_load_values['desktop'] ) ) : '';
		$custom_icon_load_tablet              = isset( $custom_icon_load_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_load_values['tablet'] ) ) : '';
		$custom_icon_load_phone               = isset( $custom_icon_load_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_load_values['phone'] ) ) : '';
		$custom_icon_load_values              = et_pb_responsive_options()->get_property_values( $this->props, 'ajax_load_more_button_icon' );
		
		$background_layout               = '';
		$background_layout_hover         = et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
		$background_layout_hover_enabled = et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
		$use_background_color            = $this->props['use_background_color'];
		$module_class = $this->module_classname( $render_slug );
		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();
		//$current_page_no = '<script> jQuery(\'.page-numbers\' ).click(function() { jQuery("input[name=\'eventfeed_current_pagination_page\']").val();}); </script>';	
		// $current_page_no = "hello";
		$data_background_layout       = '';
		$data_background_layout_hover = '';
		$thumbnail_width = $this->props['thumbnail_width'];

		if ( $background_layout_hover_enabled ) {
			$data_background_layout = sprintf(
				' data-background-layout="%1$s"',
				esc_attr( $background_layout )
			);
			$data_background_layout_hover = sprintf(
				' data-background-layout-hover="%1$s"',
				esc_attr( $background_layout_hover )
			);
		}

		if($show_image_overlay == "on" && $show_feature_image == "on"){

			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%% .decm-cover-overlay-details",
				'declaration' => "background-color: {$overlay_image_background_color} !important;",
			]);
	
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%% .decm-cover-overlay-details",
				'declaration' => "background-color: {$overlay_image_background_color_tablet} !important;",
				'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
			]);
	
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%% .decm-cover-overlay-details",
				'declaration' => "background-color: {$overlay_image_background_color_phone} !important;",
				'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
			]);
	
		}
			

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .decm-events-details, %%order_class%% .decm-events-details-cover",
            'declaration' => "background-color: {$details_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .decm-events-details, %%order_class%% .decm-events-details-cover",
            'declaration' => "background-color: {$details_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .decm-events-details, %%order_class%% .decm-events-details-cover",
            'declaration' => "background-color: {$details_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .act-post",
            'declaration' => "background-color: {$open_toggle_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .act-post",
            'declaration' => "background-color: {$open_toggle_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .act-post",
            'declaration' => "background-color: {$open_toggle_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);


		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list",
            'declaration' => "background-color: {$callout_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list",
            'declaration' => "background-color: {$callout_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list",
            'declaration' => "background-color: {$callout_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
		
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% span.decm_weburl a, %%order_class%% .ecs-categories a",
            'declaration' => "color: {$details_link_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% span decm_weburl a, %%order_class%% .ecs-categories a",
            'declaration' => "color: {$details_link_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% span.decm_weburl a, %%order_class%% .ecs-categories a",
            'declaration' => "color: {$details_link_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before",
            'declaration' => "color: {$details_icon_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before",
            'declaration' => "color: {$details_icon_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before",
            'declaration' => "color: {$details_icon_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);
		if ( '' !== $details_icon_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before",
				'declaration' => sprintf(
					'color: %1$s;',
					esc_html( $details_icon_color )
				),
			) );
		}

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-detail-label",
            'declaration' => "color: {$details_label_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-detail-label",
            'declaration' => "color: {$details_label_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-detail-label",
            'declaration' => "color: {$details_label_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		// Responsive Margin Tablet
		if ('' !== $this->props['cards_spacing_tablet'] && '|||' !== $this->props['cards_spacing_tablet']) {
			ET_Builder_Element::set_style($render_slug, array(
			  'selector'    => '%%order_class%% .act-post',
			  'declaration' => sprintf(
				' margin-right: %2$s !important; margin-left: %4$s !important;',
		
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'top', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'right', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'bottom', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'left', '0px'))
			  ),
			  'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
			ET_Builder_Element::set_style($render_slug, array(
				'selector'    => '%%order_class%% .ecs-event',
				'declaration' => sprintf(
				  'margin-top: %1$s !important;  margin-bottom: %3$s !important;',
		  
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'top', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'right', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'bottom', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'left', '0px'))
				),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			  ));
		  }
		  // Responsive Margin Phone
		if ('' !== $this->props['cards_spacing_phone'] && '|||' !== $this->props['cards_spacing_phone']) {
			ET_Builder_Element::set_style($render_slug, array(
			  'selector'    => '%%order_class%% .act-post',
			  'declaration' => sprintf(
				' margin-right: %2$s !important; margin-left: %4$s !important;',
		
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'top', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'right', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'bottom', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'left', '0px'))
			  ),
			  'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
			ET_Builder_Element::set_style($render_slug, array(
				'selector'    => '%%order_class%% .ecs-event',
				'declaration' => sprintf(
				  'margin-top: %1$s !important;  margin-bottom: %3$s !important;',
		  
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'top', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'right', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'bottom', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'left', '0px'))
				),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			  ));
		  }


		//Margin & Padding
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_margin', 'margin', 
		'%%order_class%% img.wp-post-image');
		$this->apply_custom_margin_padding($render_slug, 'details_margin', 'margin', 
		'%%order_class%% .decm-events-details');
		$this->apply_custom_margin_padding($render_slug, 'details_margin_overlay', 'padding', 
		'%%order_class%%  .decm-cover-overlay-details');	
		$this->apply_custom_margin_padding($render_slug, 'callout_margin', 'margin', 
		'%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list');
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_padding', 'padding', 
		'%%order_class%% img.wp-post-image', false);
		$this->apply_custom_margin_padding($render_slug, 'details_padding', 'padding', 
		'%%order_class%% .decm-events-details', false);
		$this->apply_custom_margin_padding($render_slug, 'details_padding_overlay', 'padding', 
		'%%order_class%%  .decm-events-details-cover', false);		
		$this->apply_custom_margin_padding($render_slug, 'callout_padding', 'padding', 
		'%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list', false);
		$this->apply_custom_width($render_slug, 'thumbnail_width', 'width', 
		'%%order_class%% img.wp-post-image');
		$this->apply_custom_margin_padding($render_slug, 'event_inner_spacing', 'padding', 
		"{$this->main_css_element} .ecs-event-list  .ecs-event .act-post .row");
		
		// Module classnames
		$this->add_classname( array(
			"et_pb_bg_layout_{$background_layout}",
			$this->get_text_orientation_classname(),
		) );
		if ( 'on' !== $use_background_color ) {
			$this->add_classname( 'et_pb_no_bg' );
		}

		$attr = (array)null;
		if ( $use_shortcode === 'on' ) {
			parse_str(strtr($shortcode_param, ' ', '&'), $attr);
		} else {
			
			
			$contentorder = 'title, title2, date, venue, location, organizer, price,categories,weburl,excerpt,showcalendar,showical,showdetail';
		
		//echo $this->props['layout'];
			if( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutleftimage_rightdetailButton'){
				$contentorder = 'callout,thumbnail,'.$contentorder.',button';
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'leftimage_rightdetail'){
				$contentorder = 'thumbnail,'.$contentorder;
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'rightimage_leftdetail'){
				$contentorder .= ',thumbnail';
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutleftimage_rightdetail'){
				$contentorder = 'callout,thumbnail,'.$contentorder;
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutrightimage_leftdetail'){
				$contentorder = 'callout,'.$contentorder.',thumbnail';
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutrightimage_leftdetailButton'){
				$contentorder = 'callout,'.$contentorder.',thumbnail,button';
			}else{
				$contentorder = 'thumbnail,'.$contentorder;
			}
			
			//echo $image_align.'t';
			$attr = array(
				'cat' => $included_categories,
				'month' => '',
				'limit' => $event_count,
				'events_to_load' => $events_to_load,
				'eventdetails' => $show_date == 'on' ? 'true' : 'false',
				'showtime' => $show_time == 'on' ? 'true' : 'false',
				'show_end_time'=>$show_end_time == 'on'?'true':'false',
				'show_timezone' =>$show_timezone == 'on' ? 'true' : 'false',
				'show_pagination'=> $show_pagination == 'on' ? 'true' : 'false',
				'show_recurring_events'=> $show_recurring_events,
				'showtitle' => $show_title == 'on' ? 'true' : 'false',

				'disable_event_title_link'=>($disable_event_title_link=='on'?'true':'false'),
				'enable_category_links'=> ($enable_category_links=='on'?'true':'false'),			
				'disable_event_image_link'=>($disable_event_image_link=='on'?'true':'false'),
				'disable_event_button_link'=>($disable_event_button_link=='on'?'true':'false'),
				'custom_event_link_url'=> $custom_event_link_url,
				'single_event_page_link' => $single_event_page_link,
				'custom_event_link_target'=>$custom_event_link_target,

				'show_callout_box' => $decm_show_callout_box == 'on' ? 'true' : 'false',
				'button_make_fullwidth' => $this->props['button_make_fullwidth'],
				'featured_events' => $featured_events == 'on' ? 'true' : 'false',
				'show_callout_date' => $decm_show_callout_date == 'on' ? 'true' : 'false',
				'callout_date_format'=> $decm_callout_date_format,
				'show_callout_month' => $decm_show_callout_month == 'on' ? 'true' : 'false',
				'callout_month_format'=>$decm_callout_month_format,
				'show_callout_day_of_week' => $decm_show_callout_day_of_week == 'on' ? 'true' : 'false',
				'callout_week_format'=> $decm_callout_week_format,
				'show_callout_year' => $decm_show_callout_year == 'on' ? 'true' : 'false',
				'callout_year_format'=>$decm_callout_year_format,
				'time' => null,
				'past' => $show_past,
				//'featured_events' => $featured_events == 'on' ? 'true' : 'false',	
				'venue' => ($show_venue === 'on' ? 'true' : 'false'),
				'location' => ($show_location === 'on' ? 'true' : 'false'),

				'location_street_address' => ($dec_show_location_street_address === 'on' ? 'true' : 'false'),
				'location_locality' => ($dec_show_location_locality === 'on' ? 'true' : 'false'),
				'location_postal_code' => ($dec_show_location_postal_code === 'on' ? 'true' : 'false'),
				'location_country' => ($dec_show_location_country === 'on' ? 'true' : 'false'),

				'organizer' => $show_name == 'on' ? 'true' : 'false',
				'price' => $show_price == 'on' ? 'true' : 'false',
				'weburl' => $show_weburl == 'on' ? 'true' : 'false',
				'website_link'=> $website_link,
				'custom_website_link_text'=>$custom_website_link_text,
				'custom_website_link_target'=>$custom_website_link_target,
				'categories' => $show_category == 'on' ? 'true' : 'false',
				'button_align' => ($button_align === 'on' ? 'true' : 'false'),
				'show_data_one_line' => ($show_data_one_line=== 'on' ? 'true' : 'false'),
				'show_preposition' => ($show_preposition=== 'on' ? 'true' : 'false'),
				'show_ical_export'=>($show_ical_export == 'on'?'true':'false'),
				'show_google_calendar'=>($show_google_calendar=='on'?'true':'false'),
				'stack_label_icon'=> ($stack_label_icon=='on'?'true':'false'),
				'schema' => 'true',
				'message' => $no_results_message,
				'key' => 'End Date',
				'order' => $event_order,
				'orderby' => 'meta_value',
				'viewall' => 'false',
				'excerpt' => ($show_excerpt === 'on' ? 
							($excerpt_length ? $excerpt_length : 'true' ):
							'false'),
				'showdetail' => ($show_detail === 'on' ? 'true' : 'false'),
				'thumb' => ($show_feature_image === 'on' ? 'true' : 'false'),
				'thumbsize' => $thumbnail_width,
				'thumbwidth' => '800',
				'thumbheight' => '800',
				'contentorder' => apply_filters( 'ecs_default_contentorder', $contentorder, $atts ),
				'event_tax' => '',
				'blog_offset' => $blog_offset,
				'dateformat' => $date_format,
				'timeformat' => $time_format, 
				'list_columns' => $Column_list_type,
				'cover_columns' => $cover_columns,
				'layout' => $layout,
				'list_layout' => $list_layout,	
				'columns' => $Column_Type,
				'columns_phone' => $columns_phone,
				'columns_tablet' => $columns_tablet,
				'list_columns_phone' => $list_columns_phone,
				'list_columns_tablet' => $list_columns_tablet,
				'cover_columns_phone' => $cover_columns_phone,
				'cover_columns_tablet' => $cover_columns_tablet,
				'cards_spacing' => $cards_spacing,
				'image_align' => $image_align,
				'button_align'=>$button_align,
				'event_inner_spacing' => $event_inner_spacing,
				'view_more_text' => $view_more_text,
				'ajax_load_more_text'=>$ajax_load_more_text,
				'datetime_separator' => $datetime_separator,
				'time_range_separator' => $time_range_separator,
				'google_calendar_text'=>$google_calendar_text,
				'ical_text'          =>$ical_text,
				'open_toggle_background_color' =>  $open_toggle_background_color,
				'details_link_color' =>  $details_link_color,
				'details_icon_color' =>  $details_icon_color,
				'details_label_color' =>  $details_label_color,
				'included_categories' => $included_categories,
				'header_level'  => $header_level,
				'custom_icon'         => $custom_icon,
				'use_current_loop' => ($use_current_loop === 'on' ? 'true' : 'false'),
				//'custom_icon' => $custom_icon,
				'custom_icon_tablet' => $custom_icon_tablet,
				'custom_icon_phone' => $custom_icon_phone,
				'ajax_load_more_button_icon' => $custom_icon_load,
				'ajax_load_more_button_icon_tablet' => $custom_icon_load_tablet,
				'ajax_load_more_button_icon_phone' => $custom_icon_load_phone,
				'custom_view_more' => $this->props['custom_view_more'],
				'view_more_on_hover'=>$this->props['view_more_on_hover'],
				'custom_ajax_load_more_button' => $this->props['custom_ajax_load_more_button'],
				'ajax_load_more_button_on_hover'=> $this->props['ajax_load_more_button_on_hover'],
				'view_more_icon_placement'   =>$this->props['view_more_icon_placement'],
				'ajax_load_more_button_icon_placement'=>$this->props['ajax_load_more_button_icon_placement'],
				'pagination_type' => $pagination_type,
				'align'           => $align,
				'show_icon_label'=> $show_icon_label,
				'module_css_class'=> $this->props['module_css_class'],		
			);
		
	}

	
		wp_enqueue_style('bootstrap_style',EVENT_DIR.'assets/css/bootstrap.min.css');

		$customCss='<style>';

		
		$renderClassName = $this->getrenderClassNameSelector($this->module_classname( $render_slug ),$render_slug);

		$setHeightFree = '
		jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').css(\'height\',\'100%\');
		jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',\'100%\');
		jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"unset","width":"auto" });
		';
		
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			$agentBrowser =sanitize_key( wp_unslash( $_SERVER['HTTP_USER_AGENT']));
		}

		if(strlen(strstr($agentBrowser,"safari")) > 0 ){      
			$customCss .= '.row_equal{display:flexbox}';
		}

		if(strlen(strstr($agentBrowser,"chrome")) > 0){      
		
			$customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
		}
		if(strlen(strstr($agentBrowser,"firefox")) > 0){      
		
			$customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
		}
		
		$Addlinebreak =  ' ';
		$AddButtonBottom =  '';

		if($button_align == 'on' && $this->props['equal_height'] == 'off'  && $layout == "cover"  ){
			$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"bottom":"10px","width":"100%" });';
		}else if($button_align == 'on')
		{
			if($layout == "grid"){
				if($Column_Type == 4)
			$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"89.5%" });';
			else if($Column_Type == 3 ){
				$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"92%" });';	
			} else if($Column_Type == 2 ){
			 $AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"94.7%" });';
			}
			}else if($layout == "cover"){
				if($cover_columns == 4)
			$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"77.5%" });';
			else if($cover_columns == 3 ){
				$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"83%" });';	
			} else if($cover_columns == 2 ){
				$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"87.7%" });';
			}
			
			}	
		}
		$customCss.='</style>';
		$AddCustomHeight = '';

		
		if(($Column_list_type == 2 || $Column_list_type == 1) && $layout == "list" )
		{
			if($image_align == 'leftimage_rightdetail' ||  $list_layout == 'calloutleftimage_rightdetailButton' || $list_layout != 'calloutleftimage_rightdetail' || $list_layout != 'calloutrightimage_leftdetail' || $list_layout != 'calloutrightimage_leftdetailButton' )
			$AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',"auto");';
			else
			$AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').css(\'height\',"auto");';
		}
		else
		{
			if($show_feature_image == 'on')
			{
				if($layout == "cover"){
					
					if($this->props['equal_height'] == 'on' && $button_align == 'on'){
						$AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\'  .decm-cover-overlay-details\').css(\'height\',overlay_height);';
				//		$AddCustomHeight .= 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row >  div > div:last-child\').css(\'height\',overlay_height);';						
					}elseif($this->props['equal_height'] == 'on'){
						$AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .decm-cover-overlay-details\').css(\'height\',overlay_height);';
						//$AddCustomHeight .= 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row >  div > div:last-child\').css(\'height\',overlay_height);';
					}else{
						$AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div > div > div:last-child\').css(\'height\',"auto");';
						$AddCustomHeight .= 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row >  div > div:last-child\').css(\'height\',"auto");';
					}
					
				}else{

					if($button_align == 'on' ){
					    $AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';
					    $AddCustomHeight .= 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div > div:last-child\').css(\'height\',tempHeight);';	
					}else{
						//$AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';
					    $AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div > div:last-child\').css(\'height\',"auto");';	
					}
					
				}
						
			}
			else 
			{
				$AddCustomHeight = 'var tempHeight = parseInt(column_height);jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';	
					
			}

		}
		//$_REQUEST['s']="";
		$categslug="";
		$categId="";
		global $wp_query;
		$cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
		$categslug = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->slug:"";
        $categId = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->term_id:"";
		$event_id = get_the_ID();

		$term_id = array();
		$getEventCat = get_the_terms( get_the_ID(), 'tribe_events_cat' ); 

		
		if($getEventCat != ""){
			foreach ((array) $getEventCat as $key => $eventInfo ) {
				$term_id[$key] = $eventInfo->term_id;
		   }
		}
		
		
	    $term_id = json_encode($term_id);

			
		wp_register_script( 'loadmore', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.2.4/js/EventFeed/loadmore.js');
	
		global $script_data_array;
	
		$script_data_array = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'atts'=> $attr,
			'categId'=>$categId,
			'categslug'=>$categslug,
			'term_id' => $term_id,
			'pagination_type'=>$pagination_type,
			'class_pagination' => $renderClassName,	
			'module_css_class' => $this->props['module_css_class'],			
		);

		$moduleClassName = $this->props['module_css_class'] != "" ? ' '.$this->props['module_css_class']: $renderClassName;

		//echo $renderClassName;
//		exit;		
		wp_localize_script( 'loadmore', 'eventFeed'.substr($moduleClassName,1,strlen($moduleClassName)), $script_data_array );

		wp_enqueue_script( 'loadmore', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.2.4/js/EventFeed/loadmore.js');
		return sprintf( '
				%9$s<div%2$s class="%4$s %5$s">
					%6$s
					%7$s
					<div class= "">
						%1$s
					</div>
				</div>
				<script>

				jQuery(document).ready(function($) {
			
						$(\'.ecs-event-pagination\').on("click", "a", function () {
							event.preventDefault();
							$(\'#eventfeed_current_pagination_page\').val();
							$("input[name=\'eventfeed_current_pagination_page\']").val($(this).attr("pn"));
						});		    	
		
						$(\'%13$s\').addClass("%15$s");
					
				

				var setHeightColumns = function(){ 
					var column_loop_row = 0;
					var column_height = 0;
					var overlay_height = 0;
					var ids = [];
					var total_Count = 0;
					var total_Events = jQuery(\'%13$s .ecs-event-posts\').length; 
					jQuery(\'%13$s .ecs-event-posts\').each(function(){
					++column_loop_row;
					++total_Count;
					var Event_id = jQuery(this).children(\'article\')[0].id;
					ids.push(Event_id);
					column_height = jQuery(this).find(\'#\'+Event_id).children(\'.row\').height() >= column_height ? jQuery(this).find(\'#\'+Event_id).children(\'.row\').height() : column_height;
					overlay_height =
					jQuery(this).find(\'.decm-cover-overlay-details\').height() >= overlay_height ? jQuery(this).find(\'.decm-cover-image-overlay\').height() : overlay_height;
					if(column_loop_row == %8$s || total_Count == total_Events)
					{      
						ids.map(function(id,index){
							%10$s
							
						});  
						column_loop_row = 0;
						column_height = 0;
						ids = [];
					}
					});
					%11$s
				}

				setTimeout(setHeightColumns, 5000);
				jQuery(window).on(\'resize\',function(){
					var screenWidth = jQuery(this).width();


					if(screenWidth > 1199){
						
						if(document.readyState == \'complete\')
						setHeightColumns();
					}
					else{
						jQuery(\'%13$s .ecs-event-posts\').each(function(){
							var id = jQuery(this).children(\'article\')[0].id;
							%14$s
							});
					}

				});	

			});	
				</script>
				
			'				
			, $this->ecs_fetch_events( $attr ,$render_slug)
			, $this->module_id()
			, $this->module_classname( $render_slug )
			, et_core_esc_previously( $data_background_layout )
			, et_core_esc_previously( $data_background_layout_hover )
			, $parallax_image_background
			, $video_background
			, $Column_Type
			, $customCss
			, $AddCustomHeight
			, $AddButtonBottom
			, $Addlinebreak
			, $renderClassName
			, $setHeightFree
			, $this->props['module_css_class']
		);
	}

	/**
	 * Fetch and return required events.
	 * @param  array $atts 	shortcode attributes
	 * @return string 	shortcode output
	 */

	
		public function ecs_fetch_events( $atts, $render_slug, $conditional_tags = array(), $current_page = array() ) {
			global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
			$post_type = get_post_type();
		
			//$page_hide_other_content        = $this->props['hide_other_content']==="on"?'<script> jQuery(window).on(\'load\', function() { jQuery(\'.'.$this->props['use_custom_class_show_hide'].'\').hide();})</script>':"";

		/**
		 * Check if events calendar plugin method exists
		 */
		if ( !function_exists( 'tribe_get_events' ) ) {
			return '\'The Events Calendar\' plugin should exist';
		}

		
		$output = '';

		// $output = $filter_output;
	
$custom_icon='';
$custom_icon_load='';
		$atts = shortcode_atts( apply_filters( 'ecs_shortcode_atts', array(
			'show_data_one_line'=> 'false',
			'cat' => '',
			'month' => '',
			'limit' => 6,
			'events_to_load' => '',
			'show_callout_box' => 'true',
			'button_make_fullwidth' => 'true',
			'featured_events' => 'ture',
			'disable_event_title_link'=>'true',
			'disable_event_image_link'=>'true',
			'enable_category_links' => 'true',
			'disable_event_button_link'=>'true',
			'single_event_page_link' => '',
			'custom_event_link_url'=>'',
			'custom_event_link_target'=>'',
			'show_callout_date' => 'true',
			'callout_date_format'=>"",
			'show_callout_month' => 'true',		
			'callout_month_format'=>"",
			'show_callout_year' => 'true',	
			'callout_year_format'=>"",
			'show_callout_day_of_week' => 'true',
			'callout_week_format'=>"",
			'eventdetails' => 'true',
			'showtime' => 'true',
			'show_end_time'=> 'true',
			'show_timezone' => 'true',
			'showtitle' => 'true',
			'show_pagination'=>'true',
			'show_recurring_events'=>'true',
			'show_ical_export'=>'true',
			'show_google_calendar'=>'true',
			'stack_label_icon'=>'true',
			'time' => null,
			'past' => '',
			'venue' => 'false',
			'location' => 'false',
			'location_street_address' => 'false',
			'location_locality' => 'false',
			'location_postal_code' => 'false',
			'location_country' => 'false',
			'organizer' => null,
			'price' => null,
			'weburl' => null,
			'website_link'=>'',
			'custom_website_link_text'=>'',
			'custom_website_link_target'=>'',
			'categories' => 'false',
			'schema' => 'true',
			'message' => '',
			'key' => 'End Date',
			'order' => 'ASC',
			'orderby' => 'startdate',
			'viewall' => 'false',
			'excerpt' => 'false',
			'showdetail' => 'false',
			'thumb' => 'false',
			'thumbsize' => '',
			'thumbwidth' => '',
			'thumbheight' => '',
			'contentorder' => apply_filters( 'ecs_default_contentorder', ' thumbnail,title, title2, date, venue, location, organizer, price, categories, excerpt,weburl, showdetail' , $atts ),
			'event_tax' => '',
			'dateformat' => '',
			'timeformat' => '',
			'layout' => '',
			'columns' => '',
			'list_columns' => '',
			'list_layout' => '',
			'cover_columns' => '',
			'cards_spacing' => '',
			'blog_offset' => '',
			'button_align' => '',
			'image_align' => '',
			'event_inner_spacing' => '',
			'view_more_text' => 'View More',
			'open_toggle_background_color'=>'',
			'details_link_color'=>'',
			'details_icon_color'=>'',
			'details_label_color'=>'',
			'columns_phone' => '',
			'columns_tablet' => '',
			'list_columns_phone' => '',
			'list_columns_tablet' => '',
			'cover_columns_phone' => '',
			'cover_columns_tablet' => '',
			'act-view-more et_pb_button' => '',
			'header_level' => '',
			'included_categories' => '',
			'show_preposition'=>'false',
			'use_current_loop' => 'false',
			'custom_icon' => $custom_icon,
			'custom_icon_tablet' => '',
			'custom_icon_phone' => '',
			'custom_view_more' => '',
			'view_more_on_hover'=>'',
			'ajax_load_more_button_on_hover'=>'',
			'view_more_icon_placement'=>'',
			'ajax_load_more_button_icon_placement'=>'',
			'ajax_load_more_button_icon' => $custom_icon_load,
			'ajax_load_more_button_icon_tablet' => '',
			'ajax_load_more_button_icon_phone' => '',
			//'google_calendar_button_icon'=>$custom_icon_google,
		    'google_calendar_button_icon_tablet'=>'',
			'google_calendar_button_icon_phone'=>'',
			'custom_google_calendar_button'=>'',
			'google_calendar_button_icon_placement'=>'',
			'google_calendar_button_on_hover'=>'',
			//'ical_export_button_icon'=>$custom_icon_ical,
			'ical_export_button_icon_tablet'=>'',
			'ical_button_icon_phone'=>'',
			'ical_export_button_icon_placement'=>'',
			'ical_export_button_on_hover'=>'',
			'custom_ical_export_button'=>'',
			//'custom_view_more' => '',
			'custom_ajax_load_more_button'=>'',
			'ajax_load_more_text'=>'Load More',
			'google_calendar_text'=>"Google Calendar",
			'ical_text' =>"+ Ical Export",
			'pagination_type'=> '',
			'align'     => '',
			'show_icon_label'=>'',
			'module_css_class'=>'',
			

		), $atts ), $atts, 'ecs-list-events' );


		// echo '<pre>';
		// print_r($atts);
		// echo '</pre>';
	
		// Category
		if ( $atts['cat'] ) {
			if ( strpos( $atts['cat'], "," ) !== false ) {
				$atts['cats'] = explode( ",", $atts['cat'] );
				$atts['cats'] = array_map( 'trim', $atts['cats'] );
			} else {
				$atts['cats'] = array( trim( $atts['cat'] ) );
			}

			$atts['event_tax'] = array(
				'relation' => 'OR',
			);

			foreach ( $atts['cats'] as $cat ) {
				$atts['event_tax'][] = array(
                        'taxonomy' => 'tribe_events_cat',
                        'field' => 'term_id',
                        'terms' => $cat,
                    );
					
			}
		}


		// Past Event
		$meta_date_compare = '>=';
		$meta_date_date = current_time( 'Y-m-d H:i:s' );

		if ( $atts['time'] == 'past' ||  $atts['past'] ==  'past_events' ) {
			$meta_date_compare = '<';
		}

		// Key, used in filtering events by date
		if ( str_replace( ' ', '', trim( strtolower( $atts['key'] ) ) ) == 'startdate' ) {
			$atts['key'] = '_EventStartDate';
		} else {
			$atts['key'] = '_EventEndDate';
		}

		// Orderby
		if ( str_replace( ' ', '', trim( strtolower( $atts['orderby'] ) ) ) == 'enddate' ) {
			$atts['orderby'] = '_EventEndDate';
		} elseif ( trim( strtolower( $atts['orderby'] ) ) == 'title' ) {
			$atts['orderby'] = 'title';
		} else {
			$atts['orderby'] = '_EventStartDate';
		}

		// Date
		$atts['meta_date'] = array(
			array(
				'key' => $atts['key'],
				'value' => $meta_date_date,
				'compare' => $meta_date_compare,
				'type' => 'DATETIME'
			)
		);
		
		 // Specific Month
		if ( 'current' == $atts['month'] ) {
			$atts['month'] = current_time( 'Y-m' );
		}
		if ( 'next' == $atts['month'] ) {
			$atts['month'] = gmdate( 'Y-m', strtotime( '+1 months', current_time( 'timestamp' ) ) );
		}
		if ($atts['month']) {
			$month_array = explode("-", $atts['month']);
			
			$month_yearstr = $month_array[0];
			$month_monthstr = $month_array[1];
			$month_startdate = gmdate( "Y-m-d", strtotime( $month_yearstr . "-" . $month_monthstr . "-01" ) );
			$month_enddate = gmdate( "Y-m-01", strtotime( "+1 month", strtotime( $month_startdate ) ) );

			$atts['meta_date'] = array(
				'relation' => 'AND',
				array(
					'key' => $atts['key'],
					'value' => $month_startdate,
					'compare' => '>=',
					'type' => 'DATETIME'
				),
				array(
					'key' => $atts['key'],
					'value' => $month_enddate,
					'compare' => '<',
					'type' => 'DATETIME'
				)
			);
		} 
		/**
		 * Hide time if $atts['showtime'] is false
		 *
		 * @author bojana
		 *
		 */
		if ( self::isValid( $atts['eventdetails'] ) ) {
			
			if ( !self::isValid( $atts['showtime'] ) ) {
				add_filter( 'tribe_events_event_schedule_details_formatting', 'tribe_events_event_schedule_details_formatting_hidetime');
			}
		}

		/**
		 * Hide time if $atts['showtime'] is false
		 *
		 * @author bojana
		 *
		 */

		if ( !empty( $atts['dateformat'] ) ) {

			setDateFormat($atts['dateformat']);
			add_filter( 'tribe_date_format', 'getDateFormat');
		}
	

		$atts = apply_filters( 'ecs_atts_pre_query', $atts, $meta_date_date, $meta_date_compare );
		
		// echo 'hello';
		// echo $this->props['included_categories'];

		$cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
		$categslug = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->slug:"";
        $categId = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->term_id:"";
		$event_id = get_the_ID();


	$args = apply_filters( 'ecs_get_events_args', array(
		//'post_type' => 'tribe_events',
		'post_status' => 'publish',
		'posts_per_page' => $atts['limit'],
		'tax_query'=> $atts['event_tax'],
		'order' => $atts['order'],
		//'orderby' => $atts['orderby'],
		'post__not_in'           =>is_single()==true? array(get_the_ID()):"",
		'offset' => $atts['blog_offset'],
		'included_categories' => $atts['included_categories'],
		'hide_subsequent_recurrences'=> $atts['show_recurring_events']=="on"? "false": "true",
		//'featured'=> "false",
		'meta_query' => apply_filters( 'ecs_get_meta_query', array( $atts['meta_date'] ), $atts, $meta_date_date, $meta_date_compare ),
	), $atts, $meta_date_date, $meta_date_compare );


		if($this->props['featured_events'] == "on"){
			$args['featured'] = "true";
		}
	
// if(isset($_REQUEST['s']) && ($_REQUEST['s']!="")) //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
// {
// 	$args['s'] =sanitize_text_field( wp_unslash( $_REQUEST['s'])); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
// }

		if($atts['use_current_loop'] == "true"){	

		if($post_type == 'tribe_events'){
			//$args['ID'] = $event_id;
		}

		$postID = $event_id; 
		$term_id = array();
	
		$getEventCat = get_the_terms( $postID, 'tribe_events_cat' ); 
		if($getEventCat != ""){
			foreach ((array) $getEventCat as $key => $eventInfo ) {
				$term_id[$key] = $eventInfo->term_id;
		   }
		}
		

		if($categslug){
			$args['included_categories'] = $categslug;
			unset($atts['event_tax']);
			$atts['event_tax'][] = array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $categId,
			);
			$args['tax_query'] = $atts['event_tax'];	
		}else if($term_id){
			unset($atts['event_tax']);
			$atts['event_tax'][] = array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $term_id,
			);
			$args['tax_query'] = $atts['event_tax'];	
		}
		
	}


	$max_pages=0;
	$max_page_find_args = $args;
	if($atts['limit'] > 0){
		$max_page_find_args['posts_per_page'] = -1;
		if($atts['pagination_type']== "load_more" &&  $atts['events_to_load'] != "" ){
			$max_pages = ceil((count(tribe_get_events( $max_page_find_args )) - $atts['limit'])/$atts['events_to_load'] + 1);
		}else{
			$max_pages = ceil(count(tribe_get_events( $max_page_find_args ))/$atts['limit']);
		}

	}

	// if($atts['pagination_type']=="numeric_pagination" && $atts['show_pagination']=="true" ){
	// 	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;		
	// 	$args['paged'] = $paged;
	// }
	
	//	$have_post = new WP_Query($args);

		// echo '<pre>';
	    //  print_r($args);
		//  echo '</pre>';

		$event_posts = tribe_get_events( $args );
				
        $event_posts = apply_filters( 'ecs_filter_events_after_get', $event_posts, $atts );


		if ( $event_posts or apply_filters( 'ecs_always_show', false, $atts ) ) {

					
			$output = apply_filters( 'ecs_beginning_output', $output, $event_posts, $atts );

					$cardoverStyle = '';
					$excerptLength = '';

				

				//	$columns_desktop = 'col-lg-12';
					$columns_desktop = 'col-lg-4';
			    	$columns_tablet = 'col-sm-12';
					$columns_phone_xs = 'col-xs-12';


					if($atts['layout'] == "list"){
						if($atts['list_columns_phone'] == "1"){ 
						// $columns_phone = "col-sm-12"; 
						  $columns_phone_xs = "col-xs-12";
						}else if($atts['list_columns_phone'] == "2"){
						//  $columns_phone = "col-sm-6"; 
						  $columns_phone_xs = "col-xs-6";
								}
					  }elseif($atts['layout'] == "cover"){
				  
						if($atts['cover_columns_phone'] == "1"){ 
						// $columns_phone = "col-sm-12"; 
						  $columns_phone_xs = "col-xs-12";
						}else if($atts['cover_columns_phone'] == "2"){
					//	 $columns_phone = "col-sm-6"; 
						  $columns_phone_xs = "col-xs-6";
						  }
						else if($atts['cover_columns_phone'] == "3"){ 
					//	 $columns_phone = "col-sm-4"; 
						  $columns_phone_xs = "col-xs-4";
						}
						else if($atts['cover_columns_phone'] == "4"){ 
					//	 $columns_phone = "col-sm-3"; 
						  $columns_phone_xs = "col-xs-3";
						}
				  
					  }else{
						if($atts['columns_phone'] == "1"){ 
					//	  $columns_phone = "col-sm-12"; 
						  $columns_phone_xs = "col-xs-12";
						}else if($atts['columns_phone'] == "2"){
					//	 $columns_phone = "col-sm-6"; 
						  $columns_phone_xs = "col-xs-6";
						  }
						else if($atts['columns_phone'] == "3"){ 
				//		  $columns_phone = "col-sm-4"; 
						  $columns_phone_xs = "col-xs-4";
						}
						else if($atts['columns_phone'] == "4"){ 
				//		  $columns_phone = "col-sm-3"; 
						  $columns_phone_xs = "col-xs-3";
						}
				  
					  }
						  
					  if($atts['layout'] == "list"){
						if($atts['list_columns_tablet'] == "1"){ 
						  $columns_tablet = "col-sm-12"; 
						}else if($atts['list_columns_tablet'] == "2"){ 
						  $columns_tablet = "col-md-6"; 
						}
					  }elseif($atts['layout'] == "cover"){
				  
						if($atts['cover_columns_tablet'] == "1"){ 
						  $columns_tablet = "col-sm-12"; 
						}else if($atts['cover_columns_tablet'] == "2"){ 
						  $columns_tablet = "col-sm-6"; 
						}else if($atts['cover_columns_tablet'] == "3"){ 
						  $columns_tablet = "col-sm-4"; 
						}else if($atts['cover_columns_tablet'] == "4"){ 
						  $columns_tablet = "col-sm-3"; 	
						}
					  }else{
				  
						if($atts['columns_tablet'] == "1"){ 
						  $columns_tablet = "col-sm-12"; 
						}else if($atts['columns_tablet'] == "2"){ 
						  $columns_tablet = "col-sm-6"; 
						}else if($atts['columns_tablet'] == "3"){ 
						  $columns_tablet = "col-sm-4"; 
						}else if($atts['columns_tablet'] == "4"){ 
						  $columns_tablet = "col-sm-3"; 	
						}
					  }
				  
					  if($atts['layout'] == "list"){
						if($atts['list_columns'] == "1"){ 
						  $columns_desktop = "col-lg-12"; 
						}else if($atts['list_columns'] == "2"){ 
						  $columns_desktop = "col-lg-6"; 
						}
					  }elseif($atts['layout'] == "cover"){
						
						if($atts['cover_columns'] == "1"){ 
						  $columns_desktop = "col-lg-12"; 
						}else if($atts['cover_columns'] == "2"){ 
						  $columns_desktop = "col-lg-6"; 
						}else if($atts['cover_columns'] == "3"){ 
						  $columns_desktop = "col-lg-4"; 
						}else if($atts['cover_columns'] == "4"){ 
						  $columns_desktop = "col-lg-3"; 
						}
				  
					  }else{
				  
						if($atts['columns'] == "1"){ 
						  $columns_desktop = "col-lg-12"; 
						}else if($atts['columns'] == "2"){ 
						  $columns_desktop = "col-lg-6"; 
						}else if($atts['columns'] == "3"){ 					
							$columns_desktop = "col-lg-4"; 					
						}else if($atts['columns'] == "4"){ 
						  $columns_desktop = "col-lg-3"; 
						}
				  
					  }				
					

					
			$output .= apply_filters( 'ecs_start_tag', '<div class="append_events row_equal row ecs-event-list event-display_style"' . 
					($atts['image_align'] == 'blog_layout' ? 'blog_layout': 'leftimage_rightdetail' ) . '">', $atts );
			$atts['contentorder'] = explode( ',', $atts['contentorder'] );
			$Event_Inner_Margin = explode('|', str_replace(array('false'), array('') ,$atts['event_inner_spacing']));
			$Card_Outer_Margin_top = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
			$Card_Outer_Margin_bottom = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
			$Card_Outer_Margin_left = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
			$Card_Outer_Margin_right = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
			//print_r($atts['cards_spacing']);
			$marginArr = array('margin-right','margin-left');
			$marginArrtop = array('margin-top','margin-bottom');
			$eventInnerPadding = array('padding-top','padding-right','padding-bottom','padding-left');
			$Card_Outer_Margin_top = array_slice($Card_Outer_Margin_top,0,1);
			$Card_Outer_Margin_bottomA = array_slice($Card_Outer_Margin_bottom,2,2);
			$Card_Outer_Margin_bottomB = array_slice($Card_Outer_Margin_bottomA,0,1);

			$Card_Outer_Margin_Topbottom = array_merge($Card_Outer_Margin_top,$Card_Outer_Margin_bottomB);
			$Card_Outer_Margin_left = array_slice($Card_Outer_Margin_left,1,1);
			$Card_Outer_Margin_right = array_slice($Card_Outer_Margin_right,3,1);
	
			$Card_Outer_Margin_Leftright = array_merge($Card_Outer_Margin_left,$Card_Outer_Margin_right);


			for($i=0;$i<4;$i++)
			{

				$Event_Inner_Margin_style[$eventInnerPadding[$i]] = @ $Event_Inner_Margin[$i] == '' ? '' : $Event_Inner_Margin[$i]; 
			
			}

			for($i=0;$i<2;$i++){
				$Card_Outer_Margin_style[$marginArr[$i]] = @ $Card_Outer_Margin_Leftright[$i] == '' ? '' : $Card_Outer_Margin_Leftright[$i];
				$Card_Outer_Margin_style_top[$marginArrtop[$i]] = @ $Card_Outer_Margin_Topbottom[$i] == '' ? '' : $Card_Outer_Margin_Topbottom[$i];
			}

			$eventInnerStyle = implode('; ', array_map(
				function ($v, $k) { return sprintf("%s:%s", $k, $v); },
				$Event_Inner_Margin_style,
				array_keys($Event_Inner_Margin_style)
			));
			$cardInnerStyle = implode('; ', array_map(
				function ($v, $k) { return sprintf("%s:%s", $k, $v); },
				$Card_Outer_Margin_style,
				array_keys($Card_Outer_Margin_style)
			));
			$cardInnerStyletop = implode('; ', array_map(
				function ($v, $k) { return sprintf("%s:%s", $k, $v); },
				$Card_Outer_Margin_style_top,
				array_keys($Card_Outer_Margin_style_top)
			));
			$cardoverStyle .= ';background:'.$atts['open_toggle_background_color'].';';
			foreach( (array) $event_posts as $post_index => $event_post ) {
				
				setup_postdata( $event_post->ID );
				
				$event_output = '';
				if ( apply_filters( 'ecs_skip_event', false, $atts, $event_post ) )
				    continue;
				$category_slugs = array();
				$category_list = get_the_terms( $event_post, 'tribe_events_cat' );
				/**
				 * Show Categories of every events
				 *
				 * @author bojana
				 */
				$category_names = array();
				$featured_class = ( get_post_meta( $event_post->ID , '_tribe_featured', true ) ? ' ecs-featured-event ' : '' );
				if ( is_array( $category_list ) ) {
					foreach ( (array) $category_list as $category ) {
						$category_slugs[] = ' ' . $category->slug . '_ecs_category';
						/**
						 * Show Categories of every events
						 *
						 * @author bojana
						 */

						$category_enable_link = $atts['enable_category_links'] == 'true' ? '<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>' : '<span>'.$category->name.'</span>';
						$category_names[] = '<span class= decm_categories ecs_category_'.$category->slug.' >'.$category_enable_link.'</span>';
					}
				}

				
				// exit;
				// style="'.$eventInnerStyle.'"
				$coverImage  =  $atts['layout'] == 'cover' ? "cover-image" : " ";

				$event_output .= apply_filters( 'ecs_event_start_tag', '<div class=" '.$columns_desktop.' '.$columns_tablet.' '.$columns_phone_xs.' '.$coverImage .' ecs-event ecs-event-posts clearfix' . implode( '', $category_slugs ) . $featured_class . apply_filters( 'ecs_event_classes', '', $atts, $post ) . '" style="'.$cardInnerStyletop.'" "><article id="event_article_'.$event_post->ID.'" class="act-post et_pb_with_border"  style="'.$cardoverStyle.''.$cardInnerStyle.'" " ><div class="row" style="" > ', $atts, $post );
				
				

				// Put Values into $event_output
				if ( self::isValid( $atts['thumb'] ) ){
						
				}
				else{
// 					$event_output .= '<div class="col-md-12">';
				}
				$image_center="";
				if($atts['align']=="center"){
					$image_center="decm-show-image-center";
				}
				if($atts['align']=="left"){
					$image_center="decm-show-image-left";
				}
				if($atts['align']=="right"){
					$image_center="decm-show-image-right";
				}
			
			 $classShowDataOneLine ='';
			 $classShowDataOneLine = $atts['show_data_one_line'] == 'true' ? ' decm-show-data-display-block ' : ' ';
			 $start_time='';
			 $end_time ='';
			 $set_timezone='';
			 $set_timezone=$atts['show_timezone']=='true'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):"";
			 $start_time=$atts['timeformat']==''? tribe_get_start_time($event_post->ID,get_option( 'time_format' )):tribe_get_start_time($event_post->ID,$atts['timeformat']);  
			 $end_time=$atts['timeformat']==''? tribe_get_end_time($event_post->ID,get_option( 'time_format' )):tribe_get_end_time($event_post->ID,$atts['timeformat']);
			 $end_time=$atts['show_end_time']=="true"?$end_time.$set_timezone:((tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))?$end_time.$set_timezone:$set_timezone);
			 $start_date='';
			 $end_date ='';
			//  $show_data_on =is_null(tribe_get_start_time($event_post->ID))?"hammad":"arshad";
			//  print_r($show_data_on);
			//  exit;
			$start_date= $atts['dateformat']==""? tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' )):tribe_get_start_date( $event_post->ID,null,$atts['dateformat']);
			$end_date=$atts['dateformat']==""? ' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '. tribe_get_end_date($event_post->ID,null, get_option( 'date_format' )):' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$atts['dateformat']);  

			$showicondate ="";
			$showicontime="";
			$showicon="";
			$showlabel="";
			$showlabeldate="";
			$showlabeltime="";
			$disable_event_title_link=$atts['disable_event_title_link']=="true"?" ecs_disable_event_link ":"";
			$disable_event_image_link=$atts['disable_event_image_link']=="true"?" ecs_disable_event_link ":"";
			$disable_event_button_link=$atts['disable_event_button_link']=="true"?" ecs_disable_event_link ":"";
			$custom_event_link_url = $atts['custom_event_link_url']==""?tribe_get_event_link($event_post->ID):((strpos($atts['custom_event_link_url'], "http") !== 0)?$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?"https" : "http") . "://" .$atts['custom_event_link_url']:$atts['custom_event_link_url']);
			$decm_show_callout_day_of_week = $atts['show_callout_day_of_week'] == "true" ? '<div class="callout_weekDay">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format']).'</div>' : "" ;
			$decm_show_callout_year = $atts['show_callout_year'] == "true" ? '<div class="callout_year">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format']).'</div>' : " " ;
			$decm_show_callout_month = $atts['show_callout_month'] == "true" ? '<div class="callout_month">'.tribe_get_start_date( $event_post->ID,null,$atts['callout_month_format']).'</div>' : " " ;
			$decm_show_callout_date = $atts['show_callout_date'] == "true" ? '<div class="callout_date">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']).'</div>' : " " ;
			$custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];				
			$link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_event_website_link($event_post->ID), $result);
		
			if(isset($result['href'][0])){
					$result =  $result['href'][0];	
					$custom_event_link_url = $atts['single_event_page_link'] == 'redirect_link' ?  $result : $custom_event_link_url;
			}	
			
			if($atts['layout'] == 'cover'){
				$decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-cover">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.'</div>' : '';	
			}else if($atts['layout'] == 'list'){
				$decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-list">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.'</div>' : '';		
			}else{
				$decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-grid">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.'</div>' : '';
			}
			
			if ( !empty( $atts['dateformat'] ) ) {

				$showdate=setDateFormat($atts['dateformat']);
				
			}
			else{
				$showdate= get_option('date_format');
			}

				foreach ( apply_filters( 'ecs_event_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {

					//echo $contentorder;
					
					switch ( trim( $contentorder ) ) {


						case  'callout':
							$event_output .= '<div class="col-md-2 col-3">'.$decm_show_callout_box.'</div>';
						break;
						case 'title':

							$dec_event_title = "";
							if(self::isValid( $atts['showtitle'] )){
								$dec_event_title =  apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ).apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							}
							//echo $dec_event_title."title....";
						

							if((self::isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list') && ($atts['showdetail'] == 'true' || $atts['showdetail'] == 'false' ) ){			
						
								if($atts['list_layout'] == 'calloutrightimage_leftdetail'){
								   $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							   }elseif( self::isValid( $atts['thumb'] ) != " " &&  ($atts['show_callout_box'] == "false" && $atts['showdetail'] == 'false' ) && $atts['list_layout'] == 'leftimage_rightdetail'){
								   $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							   }elseif( self::isValid( $atts['thumb'] ) != " "   && ($atts['list_layout'] == 'leftimage_rightdetail' || $atts['list_layout'] == 'rightimage_leftdetail') ){
								   $event_output .= '<div   class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							   }elseif(self::isValid( $atts['thumb'] ) != " " &&  ($atts['show_callout_box'] == "true" && $atts['showdetail'] == 'true' ) ){
								   $event_output .= '<div class="  col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details ">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							   }elseif(self::isValid( $atts['thumb'] ) != " "  &&  $atts['show_callout_box'] == "true"  ){
								   $event_output .= '<div class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							   }else{
								   $event_output .= '<div class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details ">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							   }							

						   }elseif((self::isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list') && $atts['showdetail'] == 'false' ){

							   $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;

						   }elseif(self::isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list' ){

								$event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );

							}elseif($atts['layout'] == 'list' &&  ($atts['list_layout'] == 'calloutleftimage_rightdetailButton' || $atts['list_layout'] == 'calloutrightimage_leftdetailButton'  )  ){

								$event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '4' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').'"><div class="decm-events-details">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );

							}elseif( $atts['layout'] == 'list' &&  ($atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail') ){

								//echo $this->props['show_feature_image'];
							$event_output .= '<div  class=" col-'.( $atts['list_columns'] <= 2  && $this->props['show_feature_image'] == 'off' ? '10' : '6').'  col-md-'.( $atts['list_columns'] <= 2  && $this->props['show_feature_image'] == 'off' ? '10' : '6').'"><div class="decm-events-details">'.$dec_event_title;	

							}elseif ( self::isValid( $atts['showtitle'] ) &&  $atts['layout'] == 'list' ) {

								$event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );						
							}	
							elseif(  self::isValid( $atts['showtitle'] )  && $atts['layout'] == 'grid'  ){
								
								$event_output .= '<div  class="col-md-'.($atts['columns'] > 2 ? '12' : '12').'"><div class="decm-events-details">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
									
							}elseif( self::isValid( $atts['showtitle'] )  && $atts['layout'] == 'cover'){
								
								 $image = get_the_post_thumbnail_url($event_post->ID,'full');				
								  $background_image	= $this->props['show_feature_image'] == "on" ? "background-image: url($image); background-size: cover;" : "";
								// $image_url = "style = 'background-image: url('.$image.');'";
		
								$event_output .= '<div  class="col-md-'.($atts['columns'] > 2 ? '12' : '12').' "  ><div class="decm-cover-image-overlay"   style = "'.$background_image.'" ><div class="decm-cover-overlay-details"><div class="decm-events-details-cover">'.$decm_show_callout_box .''.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a href="' . $custom_event_link_url . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							}elseif(!self::isValid( $atts['showtitle'] ) &&  $atts['layout'] == 'list'){
								
								$event_output .= '<div check class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details">';	
							}else{
								$event_output .= '<div  class="col-md-'.(($atts['columns'] > 2 ? '12' : $atts['image_align'] == 'topimage_bottomdetail' || $atts['image_align'] == 'centerimage_bottomdetail' || $atts['thumb'] == 'false') ? '12' : '8').'"><div   class="decm-events-details">';
							}
						break;
						case 'title2':
							$event_output .= apply_filters( 'ecs_event_title_tag_start', '<h4 class="entry-title title2 summary">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $event_post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .
							           apply_filters( 'ecs_event_title_tag_end', '</h4>', $atts, $event_post );
							break;
						/**
						 * Show Author Name of every events
						 *
						 * @author bojana
						 */
													
							break;
						
						case 'organizer':
							if ( self::isValid( $atts['organizer'] ) ) {
								if(tribe_get_organizer($event_post->ID) != null){
								
								$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"organizer-ecs-icon":"";
								$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Organizer','decm-divi-event-calendar-module')." </span>":"";
								$stacklabel = $atts['stack_label_icon']==='true'?"<br>":"";
								$organizers = tribe_get_organizer_ids($event_post->ID);
								$orgName = array();

								foreach ($organizers as $key => $organizerId) {
									$orgName[$key] = tribe_get_organizer($organizerId);					
							    }

							 $orgNames	= implode(', ', $orgName);
									$event_output .= apply_filters( 'ecs_event_organizer_tag_start','<span class="'.$classShowDataOneLine.' ecs-organizer '.$showicon.'">', $atts, $event_post ) .
								           apply_filters( 'ecs_event_organizer',($atts['show_preposition'] == 'true' ? $showlabel.$stacklabel.'<span class="decm_organizer">'.__( ' by ','decm-divi-event-calendar-module') : $showlabel.$stacklabel." ".'<span class="decm_organizer">'), $atts, $event_post, $excerptLength );
										   $event_output .=  apply_filters( 'ecs_event_organizer',$orgNames, $atts, $event_post );
										   $event_output .=   apply_filters( 'ecs_event_organizer_tag_end', '</span></span>', $atts, $event_post );
								
							}
							//else{}
						}
							
							
							break;
							case 'price':
								if ( self::isValid( $atts['price'] ) ) {
									if(tribe_get_cost( $event_post->ID, true )!=null){
								$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"price-ecs-icon":"";
								$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Price','decm-divi-event-calendar-module')." </span>":"";
								$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
					
									$event_output .= apply_filters( 'ecs_event_price_tag_start', '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">', $atts, $event_post ) .
											   apply_filters( 'ecs_event_price',$showlabel.$stacklabel." ".'<span class="decm_price">'.tribe_get_cost( $event_post->ID, true ), $atts, $event_post, $excerptLength ) .
											   apply_filters( 'ecs_event_price_tag_end', '</span></span>', $atts, $event_post );
								
									
								}
								//else{}
							}
								
								break;	
							case 'thumbnail':
									if ( self::isValid( $atts['thumb'] ) ) {

										if($atts['image_align'] == 'topimage_bottomdetail' &&  ($atts['columns'] == 1 || $atts['columns'] == 2)){
											$event_output.='<div class="'.$image_center.' col-md-'.($atts['columns'] == 1 ? '12' : '12').'">';
											$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
											
										
										}
										elseif($atts['image_align'] == 'centerimage_bottomdetail' &&  ($atts['columns'] == 1 || $atts['columns'] == 2)){
											$event_output.='<div class="decm-show-image-center col-md-'.($atts['columns'] == 1 ? '12' : '12').'">';
											$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										
										}
			
									   elseif( $atts['layout'] == 'list' &&  ($atts['list_layout'] == 'rightimage_leftdetail' || $atts['list_layout'] == 'leftimage_rightdetail') ){

				
										$event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').' col-'.($atts['list_columns'] <= 2 ? '4' : '12').' ">';
										    $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										
									   }elseif( $atts['layout'] == 'list' && ($atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail')  ){
	
										    $event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').' col-'.($atts['list_columns'] <= 2 ? '4' : '12').'">';
										    $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										
									   }elseif( $atts['layout'] == 'list' && ($atts['list_layout'] == 'calloutleftimage_rightdetailButton' || $atts['list_layout'] ==  'calloutrightimage_leftdetailButton') ){
	
										$event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '3' : '12').' col-'.($atts['list_columns'] <= 2 ? '3' : '12').' ">';
										$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
										$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
									
								      }elseif($atts['layout'] == 'cover'){								
										   $event_output.='<div  style = "display:none;"  class="'.$image_center.' col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
										   $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
									   }else{
											$event_output.='<div  class="'.$image_center.'  col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
											$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
									   }

									   
		
										if( !empty( $thumbWidth ) ) {

											$thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'ecs_event_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) );
											//echo $thumb;

											if( !empty( $thumb ) &&  $atts['layout'] == 'cover' ){
												$event_output .= apply_filters( 'ecs_event_thumbnail_link_start', '<a class="'.$disable_event_image_link.'" style="display:none;" href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post );
												$event_output .= apply_filters( 'ecs_event_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'ecs_event_thumbnail_link_end', '</a>', $atts, $event_post );
											}
											elseif ( !empty( $thumb ) &&  $atts['layout'] == 'grid' ) {
												$event_output .= apply_filters( 'ecs_event_thumbnail_link_start', '<a class="'.$disable_event_image_link.'"  href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post );
												$event_output .= apply_filters( 'ecs_event_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'ecs_event_thumbnail_link_end', ''.$decm_show_callout_box.'</a>', $atts, $event_post );

											}elseif ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'ecs_event_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) ) ) {
												$event_output .= apply_filters( 'ecs_event_thumbnail_link_start', '<a class="'.$disable_event_image_link.'" href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post );
												$event_output .= apply_filters( 'ecs_event_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'ecs_event_thumbnail_link_end', '</a>', $atts, $event_post );
											}

										} else {
											
											if ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'ecs_event_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) ) ) {
												$event_output .= apply_filters( 'ecs_event_thumbnail_link_start', '<a class="'.$disable_event_image_link.'" href="' . $custom_event_link_url . '" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post );
												$event_output .= apply_filters( 'ecs_event_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'ecs_event_thumbnail_link_end', '</a>', $atts, $event_post );
											}
										}
										$event_output.='</div >';
									}
						break;
						case 'excerpt':
							if ( self::isValid( $atts['excerpt'] ) ) {
								
								$excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 100;
								if(self::get_excerpt($event_post,$excerptLength )!=null && has_excerpt($event_post->ID)){
								$event_output .= apply_filters( 'ecs_event_excerpt_tag_start', '<p class="'.$classShowDataOneLine.' ecs-excerpt">', $atts, $event_post ) .
								           apply_filters( 'ecs_event_excerpt', self::get_excerpt($event_post, $excerptLength ), $atts, $event_post, $excerptLength ) .
								           apply_filters( 'ecs_event_excerpt_tag_end', '</p>', $atts, $event_post );
							}
						
						}
							
							break;
						
							case 'weburl':
								if ( self::isValid( $atts['weburl'] ) ) {
									if ( tribe_get_event_website_link($event_post)!=null){
										$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "weburl-ecs-icon":" ";
										$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.__('Website','decm-divi-event-calendar-module')." </span>":"";
										$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
											$event_output .=  apply_filters( 'ecs_event_weburl_tag_start', '<span class="'.$classShowDataOneLine.' ecs-weburl '.$showicon.'">', $atts, $event_post ) .
											   apply_filters( 'ecs_event_weburl',$showlabel.$stacklabel, $atts, $event_post) .
											   apply_filters( 'ecs_event_weburl',($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<span class="decm_weburl"><a href="'.$result.'" target="'.$atts['custom_website_link_target'].'">'.$custom_website_link_text.'</a></span>':'<span class="decm_weburl"><a href="'.$result.'" target="'.$atts['custom_website_link_target'].'">'.tribe_get_event_website_url($event_post->ID).'</a></span>', $atts, $event_post) . 
											   apply_filters( 'ecs_event_weburl_tag_end', '</span></span>', $atts, $event_post );
										
											 //  apply_filters( 'ecs_event_weburl_tag_end', '', $atts, $event_post );
								}
							
							}
							$event_output.='</div>';
								break;
	

							case 'date':
								$datetime_separator       = tribe_get_option( 'dateTimeSeparator', ' @ ' );
			                    $time_range_separator     = tribe_get_option( 'timeRangeSeparator', ' - ' );
								$time_range_separator     = $atts['show_end_time']== "true"? $time_range_separator:"";

								$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['eventdetails'] ) ) {
									if($atts['showtime']== 'true'){
									if($atts['show_data_one_line'] == 'true'){
										$showlabeltime= ($atts['show_icon_label']=="label" || $atts['show_icon_label']=="label_icon" ) && $atts['show_data_one_line'] == 'true' && !is_null(tribe_get_start_time($event_post->ID))?'<span class=ecs-detail-label>'.__('Time','decm-divi-event-calendar-module')." </span>":"";
										$showlabeldate= ($atts['show_icon_label']=="label" || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?'<span class=ecs-detail-label>'.__('Date','decm-divi-event-calendar-module')." </span>":"";
										$showicontime=  ($atts['show_icon_label']=="icon"  || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true' && !is_null(tribe_get_start_time($event_post->ID))?"eventTime-ecs-icon":"";
										$showicondate=  ($atts['show_icon_label']=="icon"  || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?"eventDate-ecs-icon":"";
										$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
										//	if($atts['show_icon_label']=="label" && $atts['show_data_one_line'] == 'true'){$showlabeldate="<span class=ecs-detail-label>Date: </span>";$showlabeltime="<span class=ecs-detail-label>Time: </span>";}
									//elseif($atts['show_icon_label']=="icon" && $atts['show_data_one_line'] == 'true'){$showicondate="eventDate-ecs-icon"; $showicontime="eventTime-ecs-icon"; }
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{

							
								$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ? $showlabeltime.$stacklabel.' '.$datetime_separator.' '.'<span class="decm_time">'.$start_time : $showlabeltime.$stacklabel.'<span class="decm_time">'.$start_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
				        			apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );}

										
						          }
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{	
										$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
										//apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );
										if(!is_null(tribe_get_start_time($event_post->ID))){
										$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
										//apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?" @ ".$start_time : $start_time, $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.'<span class="decm_time">'.$datetime_separator.' '.$end_time :$showlabeltime.$stacklabel."".'<span class="decm_time">'. $end_time, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
									   }
									
									
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{		
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
									//apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.$datetime_separator.'<span class="decm_date">'.' '.$start_time : $showlabeltime.$stacklabel.'<span class="decm_date">'.$start_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );
								}
								
									
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{

									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.'<span class="decm_time">'.$datetime_separator.' '.$start_time : $showlabeltime.$stacklabel.'<span class="decm_time">'.$start_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?" ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );
									}
							
									
						}
					}
									
									elseif($atts['show_data_one_line']=="false"){
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
									$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration decm_date">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
									if(!is_null(tribe_get_start_time($event_post->ID))){
										$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );	
									}
								
									$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output.=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
									}
								}
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
										$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
										if(!is_null(tribe_get_start_time($event_post->ID))){
										$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
										}
									}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
											$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											if(!is_null(tribe_get_start_time($event_post->ID))){	
												$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );	
											}
											$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
										
											if(!is_null(tribe_get_start_time($event_post->ID))){
												$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											}
											}
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
												$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
												apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
												if(!is_null(tribe_get_start_time($event_post->ID))){	
													$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
												apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );	
												}
												if(!is_null(tribe_get_start_time($event_post->ID))){
												$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time:" ".$time_range_separator." ".$end_time,  $atts, $event_post ) .
												apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
												}
											}
									}
								}
									elseif($atts['showtime']=="false"){
									if($atts['show_data_one_line'] == 'true'){

										$showlabeldate= ($atts['show_icon_label']=="label" || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?'<span class=ecs-detail-label>'.__('Date','decm-divi-event-calendar-module')." </span>":"";
										$showicondate=  ($atts['show_icon_label']=="icon"  || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?"eventDate-ecs-icon":" ";
										$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
										$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time  '.$showicondate.'">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );
										}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
											$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span></span>', $atts, $event_post );
											}
										}
										
										elseif($atts['show_data_one_line']=="false"){
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
										$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post ).
										apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
										}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
											$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											}
										}

									}
								
								}
								// $event_output.='</div>';
								break;
							
							

						case 'venue':
							if ( self::isValid( $atts['venue'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								if(tribe_get_venue($event_post->ID)!=null){
								
								$showicon = ($atts['show_icon_label']==="icon" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?"venue-ecs-icon":"";
								$showlabel = ($atts['show_icon_label'] ==="label" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Venue','decm-divi-event-calendar-module')." </span>":"";
								$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
										$event_output .= apply_filters( 'ecs_event_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-venue duration venue '.$showicon.'">', $atts, $event_post ) .
								        //   apply_filters( 'ecs_event_venue_at_tag_start', '<span> ', $atts, $event_post ) .
								           apply_filters( 'ecs_event_venue_at_text',__($atts['show_preposition'] == 'true' ? $showlabel.$stacklabel.'<span class="decm_venue"><em> '.__('at', 'decm-divi-event-calendar-module').' </em>' : $showlabel.$stacklabel.'<span class="decm_venue">' ), $atts, $event_post ) .
								        //   apply_filters( 'ecs_event_venue_at_tag_end', ' </span>', $atts, $event_post ) .
								           apply_filters( 'ecs_event_list_venue',$atts['show_icon_label']==="icon"?"".tribe_get_venue($event_post->ID):" ".tribe_get_venue($event_post->ID), $atts, $event_post ) .
										   apply_filters( 'ecs_event_venue_tag_end', '</span></span>', $atts, $event_post );					   
								 
							}
							//else{}
						}

							
							break;
						/**
						 * Show location of venue
						 *
						 * @author bojana
						 *
						 */
						case 'location':
							
							if ( self::isValid( $atts['location'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								if(tribe_get_full_address($event_post->ID) !="<span class=\"tribe-address\">\n\n\n\n\n\n\n</span>\n" ){
								
					
									$dec_location_street = $atts['location_street_address'] == "true" && $atts['location'] == "true" && tribe_get_address($event_post->ID)!=null? tribe_get_address($event_post->ID)." ":"";
									$dec_location_locality = $atts['location_locality'] == "true" && $atts['location'] == "true" && tribe_get_city($event_post->ID)!=null? tribe_get_city($event_post->ID).', ':""; 
									$dec_location_postal = $atts['location_postal_code'] == "true" && $atts['location'] == "true" && tribe_get_zip($event_post->ID)!=null? tribe_get_zip($event_post->ID)." ":""; 
									$dec_location_country = $atts['location_country'] == "true" && $atts['location'] == "true" && tribe_get_country($event_post->ID)!=null? tribe_get_country($event_post->ID)." ":""; 

									$showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "event-location-ecs-icon":"";
									$showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.__('Location','decm-divi-event-calendar-module')." </span>":"";
									$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
										$event_output .= apply_filters( 'ecs_event_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-location duration venue '.$showicon.'">', $atts, $event_post ) .
								        //    apply_filters( 'ecs_event_list_location_int_tag_start', '<em> ', $atts, $event_post ) .
										   apply_filters( 'ecs_event_venue_in_text',( $atts['show_preposition']=='true'?$showlabel.$stacklabel.'<em><span class="decm_location">'.__('in', 'decm-divi-event-calendar-module').'</em>': $showlabel.$stacklabel.'<span class="decm_location">' ), $atts, $event_post ) .
								        //    apply_filters( 'ecs_event_list_location_int_tag_end', ' </em>', $atts, $event_post ) .
										   apply_filters( 'ecs_event_list_location',($atts['show_data_one_line'] =='false'? $dec_location_street.$dec_location_locality.$dec_location_postal.$dec_location_country : str_replace('','',$dec_location_street.$dec_location_locality.$dec_location_postal.$dec_location_country)), $atts, $event_post)  .	
								           apply_filters( 'ecs_event_venue_tag_end', '</span></span>', $atts, $event_post );
							// else{}
							}
						}
							
							break;
						/**
						 * Show categories of every events
						 *
						 * @author bojana
						 */
						case 'categories':
							if ( self::isValid( $atts['categories'] ) ) {	
									
									 
								// $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
								$categories = implode(", ", $category_names);
								$categories_separator = $categories ? '|' : ' ';
								$categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator :(($atts['show_icon_label']==="icon")? "":" ");
								// $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
							if(et_core_esc_wp( $categories )!=null){
									$showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "categories-ecs-icon":"";
								    $showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.__('Category','decm-divi-event-calendar-module')." </span>":"";
								    $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";

									$event_output .= apply_filters( 'ecs_event_categories_tag_start', '<span class="'.$classShowDataOneLine.'ecs-categories '.$showicon.'">', $atts, $event_post ) .
									et_core_intentionally_unescaped($showlabel.$stacklabel.$categories_sep, 'fixed_string' ).
											apply_filters( 'ecs_event_categories', et_core_esc_wp( $categories ), 
											$atts, $event_post, $excerptLength ) .
								            apply_filters( 'ecs_event_categories_tag_end', '</span>', $atts, $event_post );
								
									
							}
							else{}
						}
							
							//$event_output.='</div>';
							break;
							
						/**
						 * Show more in detail of every events
						 *
						 * @author bojana
						 */
							
						case 'showdetail':
							if ( self::isValid( $atts['showdetail']) ) {

								$button_classes ="act-view-more et_pb_button";
								$button_classes = $this->props['button_make_fullwidth'] ==  'on' ? "act-view-more et_pb_button act-view-more-fullwidth" : $button_classes;
								$view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
                                $icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
								$button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
								
								if($atts['layout'] == 'list' &&  ($atts['list_layout'] == 'rightimage_leftdetail' || $atts['list_layout'] == 'leftimage_rightdetail' || $atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail' ) ){
									$event_output .= apply_filters( 'ecs_event_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdetail_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'ecs_event_showdetail_tag_end', '</p>', $atts, $event_post );
								}elseif($atts['layout'] == 'grid' ){
									$event_output .= apply_filters( 'ecs_event_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdetail_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'ecs_event_showdetail_tag_end', '</p>', $atts, $event_post );
								}else if($atts['layout'] == 'cover'){
									$event_output .= apply_filters( 'ecs_event_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdetail_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'ecs_event_showdetail_tag_end', '</p></div>', $atts, $event_post );

								}
								
							}
												
							$event_output.='</div></div>';
							break;
							case 'button':
								if ( self::isValid( $atts['showdetail']) ) {
									$button_classes ="act-view-more et_pb_button";
									$button_classes ="act-view-more et_pb_button act-view-more-fullwidth";
									$view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
									$icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
									$button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
									

									if($atts['layout'] == 'cover'){
										$event_output .= apply_filters( 'ecs_event_showdetail_tag_start', '<div class="col-md-2 col-2 "><p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													apply_filters( 'ecs_event_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $disable_event_button_link . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdetail_link_end', '</a>', $atts, $event_post ) .
											apply_filters( 'ecs_event_showdetail_tag_end', '</p></div></div></div>', $atts, $event_post );

									 }else{
										$event_output .= apply_filters( 'ecs_event_showdetail_tag_start', '<div class="col-md-2 col-2 "><p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													apply_filters( 'ecs_event_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $disable_event_button_link . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdetail_link_end', '</a>', $atts, $event_post ) .
											apply_filters( 'ecs_event_showdetail_tag_end', '</p></div>', $atts, $event_post );

									 }

								}
								break;
						case 'date_thumb':
							if ( self::isValid( $atts['eventdetails'] ) ) {
								$event_output .= apply_filters( 'ecs_event_date_thumb', '<div class="date_thumb"><div class="month">' . tribe_get_start_date( null, false, 'M' ) . '</div><div class="day">' . tribe_get_start_date( null, false, 'j' ) . '</div></div>', $atts, $event_post );
							}
							break;
						default:
							$event_output .= apply_filters( 'ecs_event_list_output_custom_' . strtolower( trim( $contentorder ) ), '', $atts, $event_post );
					}
				
				}
				

				$event_output .= '</div>';

			//	$event_output.=  ;
				
				$event_output .= apply_filters( 'ecs_event_end_tag', '</article></div>', $atts, $event_post );

				
				
				$output .= apply_filters( 'ecs_single_event_output', $event_output, $atts, $event_post, $post_index, $event_post );					
				
			}
	
			$output .= apply_filters( 'ecs_end_tag', '</div>', $atts );

		
			if( self::isValid( $atts['viewall'] ) ) {
				$output .= apply_filters( 'ecs_view_all_events_tag_start', '<span class="ecs-all-events">', $atts ) .
				           '<a href="' . apply_filters( 'ecs_event_list_viewall_link', tribe_get_events_link(), $atts ) .'" rel="bookmark">' . apply_filters( 'ecs_view_all_events_text', sprintf( __( 'View All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ), $atts ) . '</a>';
				$output .= apply_filters( 'ecs_view_all_events_tag_end', '</span>' );
			}
		} else { //No Events were Found
			$output .= apply_filters( 'ecs_no_events_found_message', sprintf( translate( '<div class="events-results-message">'.$atts['message'].'</div>', 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() ), $atts );
		} // endif

	
		if($atts['pagination_type']=="load_more" && $atts['show_pagination']=="true" && $max_pages > 1){
			
			$button_classes = "ecs-ajax_load_more et_pb_button";
			$icon_align =($atts['ajax_load_more_button_icon_placement']=="left")?"et_pb_ajax_align":"";
		$button_classes = ($atts['custom_ajax_load_more_button'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$icon_align : $button_classes;

		$output .= apply_filters( 'ecs_event_showdetail_tag_start', '<div class="event_ajax_load et_pb_button_wrapper" >', $atts, $event_post ) .
						apply_filters( 'ecs_event_list_showdetail_link_start', '<a class="'.$button_classes.'" href="' . "#" . '" onClick="return false;" rel="bookmark"  data-icon="'.$atts['ajax_load_more_button_icon'].'" data-icon-tablet="'.$atts['ajax_load_more_button_icon_tablet'].'" data-icon-phone="'.$atts['ajax_load_more_button_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['ajax_load_more_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdetail_link_end', '</a>', $atts, $event_post ) .
				apply_filters( 'ecs_event_showdetail_tag_end', '</div>', $atts, $event_post );
		}else if($atts['pagination_type']=="numeric_pagination" && $atts['show_pagination']=="true" &&  $max_pages > 1){
	
			
			  $output .=   '<div class="ecs-event-pagination"></div>';

			// $big = 999999999; 
				
			// 		$current = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
			// 	    $output .= '<div class="ecs-event-pagination"><span>Page '.$current.' of '.$max_pages.'</span> ';
			// 	$output .= paginate_links( array(
			// 		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			// 		'format' => '?paged=%#%',
			// 		'current' => $current,
			// 		'total' => $max_pages,
			// 		'type'   => 'plain',
			// 	) );
			// 	$output .= '</div>';
		
				}else if($atts['pagination_type']=="paged" && $atts['show_pagination']=="true" && $max_pages > 1){
				$output .= '<div class="ecs-event_feed_pagination clearfix" >
					<a class="ecs-page_alignment_left" style="display:none;" onClick="return false;" href="#">'.esc_html__('&laquo; Older Entries','Divi').
					'</a>
					<a class="ecs-page_alignment_right" onClick="return false;" href="#">'.esc_html__('Next Entries &raquo;','Divi').
					'</a>
				</div>';
			}
					
		$output.='
		
		<input type="hidden" name="eventfeed_prev_page" id="eventfeed_prev_page" value="0">
		<input type="hidden" name="eventfeed_current_page" id="eventfeed_current_page" value="1">
		<input type="hidden" name="eventfeed_page" id="eventfeed_page" value="'.$atts["pagination_type"].'">
		<input type="hidden" name="eventfeed_current_pagination_page" id="eventfeed_current_pagination_page" value="1">
		<input type="hidden" name="module_css_feed" id="module_css_feed" value="'.$atts['module_css_class'].'">
		<input type="hidden" name="module-css-class" id="module-css-class" value="'.$this->props['module_css_class'].'" />
		<input type="hidden" name="dec-eventfeed-category" id="dec-eventfeed-category" value="">
		<input type="hidden" name="dec-eventfeed-tag" id="dec-eventfeed-tag" value="">
		<input type="hidden" name="dec-eventfeed-order" id="dec-eventfeed-order" value="">
		<input type="hidden" name="dec-eventfeed-venue" id="dec-eventfeed-venue" value="">
		<input type="hidden" name="dec-eventfeed-organizer" id="dec-eventfeed-organizer" value="">
		<input type="hidden" name="dec-filter-search" id="dec-filter-search" value="">
		<input type="hidden" name="dec-eventfeed-time" id="dec-eventfeed-time" value="">
		<input type="hidden" name="dec-eventfeed-day" id="dec-eventfeed-day" value="">
		<input type="hidden" name="dec-eventfeed-month" id="dec-eventfeed-month" value="">
		<input type="hidden" name="dec-eventfeed-year" id="dec-eventfeed-year" value="">
		<input type="hidden" name="EventcostMin" id="EventcostMin" value="">
		<input type="hidden" name="EventcostMax" id="EventcostMax" value="">
		<input type="hidden" name="EventendDate" id="EventendDate" value="">
		<input type="hidden" name="EventstartDate" id="EventstartDate" value="">
		<input type="hidden" name="dec-eventfeed-country" id="dec-eventfeed-country" value="">
		<input type="hidden" name="dec-eventfeed-city" id="dec-eventfeed-city" value="">
		<input type="hidden" name="dec-eventfeed-state" id="dec-eventfeed-state" value="">
		<input type="hidden" name="dec-eventfeed-address" id="dec-eventfeed-address" value="">
		<input type="hidden" name="dec-eventfeed-page-translation" id="dec-eventfeed-page-translation" value="'.__('Page','decm-divi-event-calendar-module').'">
		<input type="hidden" name="dec-eventfeed-first-translation" id="dec-eventfeed-first-translation" value="'.__('First','decm-divi-event-calendar-module').'">
		<input type="hidden" name="dec-eventfeed-last-translation" id="dec-eventfeed-last-translation" value="'.__('Last','decm-divi-event-calendar-module').'">
		

		<input type="hidden" name="eventfeed_max_page" id="eventfeed_max_page" value="'.$max_pages.'"><input type="hidden" name="eventfeed_load_img" id="eventfeed_load_img" value="'.plugin_dir_url(__FILE__).'ajax-loader.gif">';
		return $output;
		wp_reset_postdata();
		
	}
	
	static function get_blog_posts_events(  $atts = array(), $conditional_tags = array(), $current_page = array()  ) {
		global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;

		/**
		 * Check if events calendar plugin method exists
		 */


		if ( !function_exists( 'tribe_get_events' ) ) {
			return array();
		}
	
		global $post;
		$output = '';
	

		$atts = shortcode_atts( apply_filters( 'ecs_shortcode_atts', array(
			'cat' => $atts['included_categories'],
			'month' => '',
			'limit' => $atts['event_count'],
			//'events_to_load' => $atts['events_to_load'],
			'eventdetails' => 'true',
			'showtime' => 'true',
			'show_timezone' => 'true',
			'disable_event_title_link'=>'false',
			'disable_event_image_link'=>'false',
			'disable_event_button_link'=>'false',
			'enable_category_links' => $atts['enable_category_links'],
			'show_pagination'=>'true',
			'show_recurring_events' => $atts['show_recurring_events'],
			'time' => null,
			'past' => $atts['show_past'],
			'featured_events' => 'false',
			'venue' => 'false',
			'location' => 'false',
			'organizer' => null,
			'price' => null,
			'weburl' => null,
			'website_link'=> $atts['website_link'],
			'custom_website_link_target'=>$atts['custom_website_link_target'],
			'custom_website_link_text'=>$atts['custom_website_link_text'],
			'categories' => 'false',
			'schema' => 'true',
			'message' => '',
			'key' => 'End Date',
			'order' => $atts['event_order'], 
			'orderby' => 'startdate',
			'viewall' => 'false',
			'excerpt' => 'false',
			'showdetail' => 'false',
			'thumb' => 'false',
			'thumbsize' => '',
			'thumbwidth' => '800',
			'thumbheight' => '800',
			'contentorder' => apply_filters( 'ecs_default_contentorder', ' thumbnail,title, title2, date, venue, location, organizer, price, categories, excerpt,weburl, showdetail, callout_date, pagination ,total_count', $atts ),
			'event_tax' => '',
			'date_format' => '',
			'time_format' => '',
			'callout_month_format'=>'',
			'callout_date_format'=>'',
			'callout_week_format'=>'',
			'callout_year_format'=>'',
			'layout' => '',
			'columns' => '',
			'button_align' => 'false',
			'image_align' => '',
			'cards_spacing' => '',
			'blog_offset' => '',
			'view_more_text' => 'View More',
			'columns_phone' => '',
			'columns_tablet' => '',
			'included_categories' => '',
			'header_level' => '',
			'show_data_one_line' => '',
			'show_preposition' => '',
			'render_slug' => '',
			'use_current_loop' => 'false',
			'custom_icon' => '',
			'ajax_load_more_button_icon'=>'',
			'pagination_type' =>'',
			'align'    => '',
			'show_icon_label'=>'',	

		), $atts ), $atts, 'ecs-list-events' );

		//print_r($atts);
		
		$object = new DECM_EventDisplay;
		$atts['render_slug'] = $object->module_classname( 'decm_event_display' );
		// Category
		if ( $atts['cat'] ) {
			if ( strpos( $atts['cat'], "," ) !== false ) {
				$atts['cats'] = explode( ",", $atts['cat'] );
				$atts['cats'] = array_map( 'trim', $atts['cats'] );
			} else {
				$atts['cats'] = array( trim( $atts['cat'] ) );
			}

			$atts['event_tax'] = array(
				'relation' => 'OR',
			);

			foreach ( $atts['cats'] as $cat ) {
				$atts['event_tax'][] = array(
                        'taxonomy' => 'tribe_events_cat',
                        'field' => 'term_id',
                        'terms' => $cat,
                    );
					
			}
		}

		

		// Past Event
		$meta_date_compare = '>=';
		$meta_date_date = current_time( 'Y-m-d H:i:s' );

		if ( $atts['time'] == 'past' || $atts['past'] ==  'past_events' ) {
			$meta_date_compare = '<';
			$atts['order'] = $atts['order'];
			$atts['key'] = 'meta_value';
			$atts['orderby'] = '_EventEndDate';
			
		}
	

		// Key, used in filtering events by date
		if ( str_replace( ' ', '', trim( strtolower( $atts['key'] ) ) ) == 'startdate' ) {
			$atts['key'] = '_EventStartDate';
		} else {
			$atts['key'] = '_EventEndDate';
		}

		// Orderby
		if ( str_replace( ' ', '', trim( strtolower( $atts['orderby'] ) ) ) == 'enddate' ) {
			$atts['orderby'] = '_EventEndDate';
		} elseif ( trim( strtolower( $atts['orderby'] ) ) == 'title' ) {
			$atts['orderby'] = 'title';
		} else {
			$atts['orderby'] = '_EventStartDate';
		}

		// Date
		$atts['meta_date'] = array(
			array(
				'key' => $atts['key'],
				'value' => $meta_date_date,
				'compare' => $meta_date_compare,
				'type' => 'DATETIME'
			)
		);
		
		// Specific Month
		if ( 'current' == $atts['month'] ) {
			$atts['month'] = current_time( 'Y-m' );
		}
		if ( 'next' == $atts['month'] ) {
			$atts['month'] = gmdate( 'Y-m', strtotime( '+1 months', current_time( 'timestamp' ) ) );
		}
		if ($atts['month']) {
			$month_array = explode("-", $atts['month']);
			
			$month_yearstr = $month_array[0];
			$month_monthstr = $month_array[1];
			$month_startdate = gmdate( "Y-m-d", strtotime( $month_yearstr . "-" . $month_monthstr . "-01" ) );
			$month_enddate = gmdate( "Y-m-01", strtotime( "+1 month", strtotime( $month_startdate ) ) );

			$atts['meta_date'] = array(
				'relation' => 'AND',
				array(
					'key' => $atts['key'],
					'value' => $month_startdate,
					'compare' => '>=',
					'type' => 'DATETIME'
				),
				array(
					'key' => $atts['key'],
					'value' => $month_enddate,
					'compare' => '<',
					'type' => 'DATETIME'
				)
			);
		}
		/**
		 * Hide time if $atts['showtime'] is false
		 *
		 * @author bojana
		 *
		 */
		if ( self::isValid( $atts['eventdetails'] ) ) {
			
			if ( !self::isValid( $atts['showtime'] ) ) {

				 add_filter( 'tribe_events_event_schedule_details_formatting', 'tribe_events_event_schedule_details_formatting_hidetime');
			}
		}
	
		

		/**
		 * Hide time if $atts['showtime'] is false
		 *
		 * @author bojana
		 *
		 */
			// if($atts['past']=='yes'){
			// 	$atts['order']="DESC";
			// }
			// else{
			// 	$atts['order']="ASC";
			// }

		$atts = apply_filters( 'ecs_atts_pre_query', $atts, $meta_date_date, $meta_date_compare );
		
	//	$featured = explode( ',', $atts['included_categories'] );

	
		
		$post_type = get_post_type( $current_page['id'] );

		
			$args = apply_filters( 'ecs_get_events_args', array(
				'post_status' => 'publish',
				'posts_per_page' => $atts['limit'],
				'tax_query'=> $atts['event_tax'],
				'order' => $atts['order'],
				'offset' => $atts['blog_offset'],
				'included_categories' =>  $atts['included_categories'],
				'hide_subsequent_recurrences'=> $atts['show_recurring_events']=="on"? "false": "true",
				//'featured'=> "false",
				'meta_query' => apply_filters( 'ecs_get_meta_query', array( $atts['meta_date'] ), $atts, $meta_date_date, $meta_date_compare ),
			), $atts, $meta_date_date, $meta_date_compare );
			 // $featured_events = "false";
		  	
			//print_r($atts);
		if($atts['featured_events'] == "on"){
			$args['featured'] = "true";
		}
		//et_body_layout
		if($atts['use_current_loop'] == "true"){
		if($post_type == 'tribe_events')
		{
			$args['ID'] = $current_page['id'];
		}
	}

	$max_page_find_args = $args;
	if($atts['limit'] > 0){	

		    $max_page_find_args['posts_per_page'] = -1;
			$max_pages = ceil(count(tribe_get_events( $max_page_find_args ))/$atts['limit']);
			$total_events = count(tribe_get_events( $max_page_find_args ));
	}

	if($total_events == 0){
		$atts['posts'] = array(
			'0' => null,
		);
	}


	 
		$event_posts = tribe_get_events( $args );
		
        $event_posts = apply_filters( 'ecs_filter_events_after_get', $event_posts, $atts );
		

		if ( $event_posts or apply_filters( 'ecs_always_show', false, $atts ) ) {
				
			$output = apply_filters( 'ecs_beginning_output', $output, $event_posts, $atts );



						$columns_phone='';
						$columns_tablet='';		
					$columns_device = array('columns','columns_tablet','columns_phone');
					$columns_desktop = 'col-lg-4';
					$columns_tablet = 'col-md-12';
					$columns_phone = 'col-sm-12';
					foreach ($columns_device as $device){
						$columns_class = false;
						if (strpos($device, '_phone')){
							$breakpoint = 'sm';
						}else if (strpos($device, '_table')){
							$breakpoint = 'md';
						}else{
							$breakpoint = 'lg';
						}
						if ($atts[$device]){
							switch ($atts[$device]){
								case 1:
									$columns_class = "col-{$breakpoint}-12";
									break;
								case 2:
									$columns_class = "col-{$breakpoint}-6";
									break;
								case 3:
									$columns_class = "col-{$breakpoint}-4";
									break;
								case 4:
									$columns_class = "col-{$breakpoint}-3";
									break;
								case 5:
									$columns_class = "col-{$breakpoint}-2";
									break;
								case 6:
									$columns_class = "col-{$breakpoint}-2";
									break;
							}
							if (strpos($device, '_phone')){
								$columns_phone = $columns_class;
							}else if (strpos($device, '_table')){
								$columns_tablet = $columns_class;
							}else{
								$columns_desktop = $columns_class;
							}
						}
					}

					$dateformat = '';
					$atts['dateformat'] = $dateformat;
					$atts['posts'] = array();
 			$atts['contentorder'] = explode( ',', $atts['contentorder'] );
			$index = 0;
			foreach( (array) $event_posts as $post_index => $event_post ) {
				setup_postdata( $event_post->ID );
				++$index;
				$event_output = '';
				if ( apply_filters( 'ecs_skip_event', false, $atts, $event_post ) )
				    continue;
				$category_slugs = array();
				$category_list = get_the_terms( $event_post, 'tribe_events_cat' );
				/**
				 * Show Categories of every events
				 *
				 * @author bojana
				 */
				$category_names = array();
				$featured_class = ( get_post_meta( $event_post->ID, '_tribe_featured', true ) ? ' ecs-featured-event' : '' );
				
				$atts['posts'][$index]['featured_class'] =$featured_class;
				if ( is_array( $category_list ) ) {
					foreach ( (array) $category_list as $category ) {
						$category_slugs[] = ' ' . $category->slug . '_ecs_category';
						/**
						 * Show Categories of every events
						 *
						 * @author bojana
						 * 
						 */
						$category_enable_link = $atts['enable_category_links'] == 'on' ? '<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>' : '<span>'.$category->name.'</span>';
						$category_names[] = '<span class= ecs_category_'.$category->slug.' >'.$category_enable_link.'</span>';
						
					}
				}

				$custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];
				// Put Values into $event_output
				foreach ( apply_filters( 'ecs_event_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					switch ( trim( $contentorder ) ) {
						case 'title':
							$atts['posts'][$index]['title']= get_the_title($event_post->ID);
							break;
						case 'title2':
							$atts['posts'][$index]['title2']= get_the_title($event_post->ID);
							break;
						/**
						 * Show Author Name of every events
						 *
						 * @author bojana
						 */
						case 'price':
							$atts['posts'][$index]['price']='<span class="decm_price">'." ".tribe_get_cost($event_post->ID, true ).'</span>';
						break;
						case 'weburl':
							
							$atts['posts'][$index]['weburl' ]=  $atts['posts'][$index]['weburl' ]=($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<span class="decm_weburl"><a href="'.tribe_get_event_meta($event_post->ID, '_EventURL', true ).'" target="'.$atts['custom_website_link_target'].'">'.$custom_website_link_text.'</a></span>':'<span class="decm_weburl">'.tribe_get_event_website_link($event_post).'</span>';
						break;
						case 'organizer':

							$organizers = tribe_get_organizer_ids($event_post->ID );
			                    $orgName = array();
								foreach ($organizers as $key => $organizerId) {
									$orgName[$key] = tribe_get_organizer($organizerId);
							}

							$orgNames	= implode(', ', $orgName);

							$atts['posts'][$index]['organizer'] ='<span class="decm_organizer">'. $orgNames.'</span>';
								//$event_output.='</div>';
							break;
								
						case 'thumbnail':
							$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
							$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';

							$atts['posts'][$index]['thumb'] = get_the_post_thumbnail_url($event_post->ID,array( 800, $thumbHeight ));
							break;

							case 'excerpt':
								$excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 270;
								$atts['posts'][$index]['excerpt'] =has_excerpt($event_post->ID)?self::get_excerpt($event_post->ID, $excerptLength ):""; 
							break;

						case 'date':
							$atts['posts'][$index]['date'] = apply_filters( 'ecs_event_date_tag_start', '<span class="duration time">', $atts, $event_post ) .apply_filters( 'ecs_event_list_details', tribe_events_event_schedule_details($event_post->ID), $atts, $event_post ) .apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
								$Sdate = '';
								$Edate = '';
								$STime = '';
								$ETime = '';
								$set_timezone='';
			                    $set_timezone=" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID );
								if($atts['date_format'])
								{
									$Sdate = tribe_get_start_date($event_post->ID,null,$atts['date_format']);
									$Edate = tribe_get_end_date($event_post->ID,null,$atts['date_format']);
								}
								
								if(empty($atts['date_format']))
								{
									$Sdate = tribe_get_start_date($event_post->ID,null,get_option('date_format'));
									$Edate = tribe_get_end_date($event_post->ID,null,get_option('date_format'));
								}

								if($atts['time_format'])
								{
									$STime = tribe_get_start_time($event_post->ID,$atts['time_format']);
									$ETime = tribe_get_end_time($event_post->ID,$atts['time_format']);
								}
								
								if(empty($atts['time_format']))
								{
									$STime = tribe_get_start_time($event_post->ID,get_option('time_format'));
									$ETime = tribe_get_end_time($event_post->ID,get_option('time_format'));
								}
								
								$atts['posts'][$index]['date'] =$Sdate.' @ '.$STime.'~*~'.$Edate.' @ '.$ETime.'~*~'.$set_timezone;
						break;

						case 'callout_date':							
							    $atts['posts'][$index]['callout_date'] = tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format']).'@'.tribe_get_start_date( $event_post->ID,null, $atts['callout_month_format']).'~*~'.tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format']).'@'.tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']);
						break;


						case 'venue':
							if (  function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								$atts['posts'][$index]['venue'] ='<span class="decm_venue">'.tribe_get_venue($event_post->ID).'</span>';
							}
							break;
						/**
						 * Show location of venue
						 *
						 * @author bojana
						 *
						 */
						case 'location':
							if ( function_exists( 'tribe_get_full_address' ) and  (tribe_get_address($event_post->ID) != "" || tribe_get_city($event_post->ID) != "" || tribe_get_zip($event_post->ID) != "" || tribe_get_country($event_post->ID) != "" ) ) {
								$atts['posts'][$index]['location'] ='<span class="decm_location">'. tribe_get_address($event_post->ID).','.tribe_get_city($event_post->ID).','.tribe_get_zip($event_post->ID).','.tribe_get_country($event_post->ID).'</span>'; 
							}
							break;
						/**
						 * Show categories of every events
						 *
						 * @author bojana
						 */
						case 'categories':
							$excerptLength='';
						
							$categories = implode(", ", $category_names);
									$categories_separator = $categories ? ' | ' : ' ';
							 //$categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
								$atts['posts'][$index]['categories'] = apply_filters( 'ecs_event_categories_tag_start', '<span class="ecs-categories">', $atts, $event_post ) .
								et_core_intentionally_unescaped( $categories_separator, 'fixed_string' ) .
								apply_filters( 'ecs_event_categories', et_core_esc_wp( $categories ), 
								$atts, $event_post, $excerptLength ) .
								//et_core_intentionally_unescaped( $categories_separator, 'fixed_string' );
								apply_filters( 'ecs_event_categories_tag_end', '</span>', $atts, $event_post );
							break;
						/**
						 * Show more in detail of every events
						 *
						 * @author bojana
						 */
						
						case 'date_thumb':
								$atts['posts'][$index]['date_thumb']['M'] =tribe_get_start_date( null, false, 'M' ); 
								$atts['posts'][$index]['date_thumb']['J'] =tribe_get_start_date( null, false, 'j' ); 
								
							break;

							case 'pagination':
								$atts['posts'][$index]['pagination'] = $max_pages;
								
							break;
							// case 'total_count':							
							// 	$atts['total_events'] = $total_events;							
							// break;

						default:
						$atts['posts'][$index]['contentorder'] = strtolower( trim( $contentorder ) );
					}
			}

			}
		}
		wp_reset_postdata();

		return ($atts);
	}

	
	/**
	 * Checks if the plugin attribute is valid
	 *
	 * @since 1.0.5
	 *
	 * @param string $prop
	 * @return boolean
	 */
	public static function isValid( $prop )
	{
		return ( $prop !== 'false' );
	}

	/**
	 * Fetch and trims the excerpt to specified length
	 *
	 * @param integer $limit Characters to show
	 * @param string $source  content or excerpt
	 *
	 * @return string
	 */
	
	
	public static function get_excerpt( $post_id,$limit, $source = null )
	{
		
		$excerpt = get_the_excerpt($post_id);
		if( $source == "content" ) {
			get_the_content($more_link_text = null,$strip_teaser = false,$post_id);
		}

		if ( strlen( $excerpt ) > $limit ) {
			$excerpt = substr( $excerpt, 0, $limit );
			$excerpt .= '...';
		}
		
		return $excerpt;
		
	}

				
}


new DECM_EventDisplay();

