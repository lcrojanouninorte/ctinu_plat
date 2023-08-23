<?php

class DECM_DiviEventCalendar extends ET_Builder_Module {

	public $slug       = 'decm_divi_event_calendar';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Calendar',  'decm-divi-event-calendar-module');
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
		'borders'               => array(
			'default' => array(
				'css'   => array(
				  'main' => array (
						  'border_radii' => '%%order_class%%',
						  'border_styles' => '%%order_class%%',  
					 ),
				   ),
				   
			  ), 
			'upcoming_events_border'   => array(
				'css'          => array(
					'main' => array(
						'border_radii'  => '%%order_class%% a.fc-event',
						'border_styles' => '%%order_class%% a.fc-event',
					),
					'important' => 'all',
				),			
				'label_prefix' => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Add and customize the border for the upcoming events with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'upcoming_event',
				'defaults' => array(
					'border_radii' => 'on|4px|4px|4px|4px',
				),
				
			),
			'navigation_border'   => array(
				'css'          => array(
					'main' => array(
						'border_radii'  => '%%order_class%% .fc-today-button,%%order_class%% .fc-prev-button,%%order_class%% .fc-next-button',
						'border_styles' => '%%order_class%% .fc-today-button,%%order_class%% .fc-prev-button,%%order_class%% .fc-next-button',
					
					),
					'important' => 'all',
				),			
				'label_prefix' => esc_html__( 'Navigation Buttons', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Add and customize the border for the calendar month navigation with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'navigation',
				'defaults' => array(
					'border_radii' => 'on|4px|4px|4px|4px',
				),
			),
			'view_button_border'   => array(
				'css'          => array(
					'main' => array(
						'border_radii'  => '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button',
						'border_styles' => '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button',	
					),
					'important' => 'all',
				),			
				'label_prefix' => esc_html__( 'View Buttons', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Add and customize the border for the calendar month navigation with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'view_button',
				'defaults' => array(
					'border_radii' => 'on|4px|4px|4px|4px',
				),
			),
			'tooltip_border'   => array(
				'css'          => array(
					'main' => array(
						'border_radii'  => '.tooltip,.decm__react_component_tooltip',
						'border_styles' => '.tooltip,.decm__react_component_tooltip',
					),
					'important' => 'all',
				),
		
							
				'label_prefix' => esc_html__( 'Tooltip', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Add and customize the border for the calendar month navigation with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'tooltip_style',
				'defaults' => array(
					'border_radii' => 'on|6px|6px|6px|6px',
				),
			),
		  'tooltip_image_border'   => array(
			  'css'          => array(
				  'main' => array(
					'border_radii'  => '.tooltip_main .feature_img .wp-post-image',
					'border_styles' => '.tooltip_main .feature_img .wp-post-image',
				  ),
				  'important' => 'all',
			  ),
			  'label_prefix' => esc_html__( 'Tooltip Image', 'decm-divi-event-calendar-module' ),
			  'description'		=> esc_html__( 'Add and customize the border for the tooltip image with all the standard border settings.', 'decm-divi-event-calendar-module' ),
			  'tab_slug'     => 'advanced',
			  'toggle_slug'  => 'tooltip_image',
			  'defaults' => array(
				'border_radii' => 'on|4px|4px|4px|4px',
			),
		  
		  ),),

		    'fonts'          => array(
				
				'month' => array(
				'css'          => array(
					'main'      => "%%order_class%% .fc-center h2",
					'important' => 'all',
				),
				'label'        => esc_html__( 'Heading', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Customize and style the calendar Heading text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				'font_size'   => array(
					'default' => et_get_option( 'body_font_size', '2000' )  . 'px !iportant',
				),
				'show_if'      => array( 'show_feature_image'=>"on"),
				'tab_slug'     => 'advanced',
					'toggle_slug'  => 'month_text_style',
				//'disable_toggle' => false,
			),
			'days' => array(
				'css'          => array(
					'main'      => "%%order_class%% th.fc-day-header span,%%order_class%% th.fc-day-header",
					'important' => 'all',
				),
				'label'        => esc_html__( 'Days of the Week', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Customize and style the days of the week text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'day_text_style',
				'disable_toggle' => false,
			),
			'cal_days' => array(
				'css'          => array(
					'main'      => "%%order_class%% .fc-day-number,.fc-day-top,%%order_class%% td.fc-day",
					'important' => 'all',
				),
				'label'        => esc_html__( 'Calendar Days', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Customize and style the days on the calendar number text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'calendar_days',
				'disable_toggle' => false,
		  ),
		  'up_events' => array(
			'css'          => array(
				'main'      => "%%order_class%% .fc-event,%%order_class%% .fc-calendar-title a",
				'important' => 'all',
			),
			'label'        => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Customize and style the upcoming events text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
			'toggle_slug'  => 'upcoming_event',
			'disable_toggle' => false,
			),
		
			'tooltip_title' => array(
				'css'          => array(
					'main'      => ".tooltip_main .event_detail_style .event_title_style .title_text",
					'important' => 'all',
				),
				
				'label'        => esc_html__( 'Tooltip Title', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Customize and style the tooltip title text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'tooltip_title',
				'disable_toggle' => false,
				'show_if_not' => array(
					'show_feature_image' => 'on',
				),
				
		  ),

			'tooltip_detail' => array(
				'css'          => array(
					'main'      => ".tooltip_main .event_detail_style .event_price_style,.tooltip_main .event_detail_style .start_time,.tooltip_main .event_detail_style .end_time,.tooltip_main .event_detail_style .tooltip_event_time,.tooltip_main .event_detail_style .event_category_style,.tooltip_main .event_detail_style .event_website_url_style,.tooltip_main .event_detail_style .event_venue_style,.tooltip_main .event_detail_style .event_organizer_style,.tooltip_main .event_detail_style .event_address_style",
					'important' => 'all',
				),
				
				'label'        => esc_html__( 'Tooltip Details', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'tooltip_detail',
				'disable_toggle' => false,
		),
			'tooltip_excerpt' => array(
				'css'          => array(
					'main'      => ".tooltip_main .event_detail_style .event_excerpt_style",
					'important' => 'all',
				),
				
				'label'        => esc_html__( 'Tooltip Excerpt', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'tooltip_excerpt',
				'disable_toggle' => false,
		),
		
		),
		'box_shadow'     => array(
			'default' => array(
				'css' => array(
					'main' => "%%order_class%%",
				),
			),
			
		'navigation_box_shadow'     => array(
				'css' => array(
					'main' => '%%order_class%% .fc-today-button,.fc-prev-button,.fc-next-button',
				),
				'label'         => esc_html__( 'Navigation Button Box Shadow Settings', 'decm-divi-event-calendar-module' ),
				'description'        => esc_html__( 'Add and customize the box shadow for the event featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'navigation',
				//'default'          => 'solid',
				// 'show_if_not'     => array(
				// 	'layout' => 'cover',
				// ),
			),
			'view_box_shadow'     => array(
				'css' => array(
					'main' =>  '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button',
				),
				'label'         => esc_html__( 'View Buttons Box Shadow Settings', 'decm-divi-event-calendar-module' ),
				'description'        => esc_html__( 'Add and customize the box shadow for the event featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'view_button',
				//'default'          => 'solid',
				// 'show_if_not'     => array(
				// 	'layout' => 'cover',
				// ),
			),
		),
		);
		
		
	}

	public function get_settings_modal_toggles() {
		return array(
			
			'gerneral' => array(
				'toggles' => array(		
					'decm_contents' => array(
						'priority' => 1,
						'title' => esc_html__( 'Content', 'decm-divi-event-calendar-module' ),
					),
					'calendar_views' => array(
						'priority' => 2,
						'title' => esc_html__( 'Views', 'decm-divi-event-calendar-module' ),
					),
					'element' => array(
						'priority' => 3,
						'title' => esc_html__( 'Tooltip', 'decm-divi-event-calendar-module' ),
					),
					'link_show' => array(
						'priority' => 65,
						'title' => esc_html__( 'Links', 'decm-divi-event-calendar-module'),
					),
				),
			),
			
			  'advanced' => array(
				'toggles' => array(
					'month_text_style'  => esc_html__( 'Heading Text', 'decm-divi-event-calendar-module' ),
					'day_text_style'  => esc_html__( 'Days of the Week', 'decm-divi-event-calendar-module' ),
					'calendar_days'  => esc_html__( 'Calendar Days', 'decm-divi-event-calendar-module' ),
					'upcoming_event'  => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
					'navigation'  => esc_html__( 'Navigation Buttons', 'decm-divi-event-calendar-module' ),
					'view_button'  => esc_html__( 'View Buttons', 'decm-divi-event-calendar-module' ),
					'tooltip_style'  => esc_html__( 'Tooltip', 'decm-divi-event-calendar-module' ),
					'tooltip_image'  => esc_html__( 'Tooltip Image', 'decm-divi-event-calendar-module' ),
					'tooltip_title'  => esc_html__( 'Tooltip Title Text', 'decm-divi-event-calendar-module' ),
					'tooltip_detail'  => esc_html__( 'Tooltip Details Text', 'decm-divi-event-calendar-module' ),
					'tooltip_excerpt'  => esc_html__( 'Tooltip Excerpt Text', 'decm-divi-event-calendar-module' ),
				),
			),
			 
		  );
	  }

	public function get_fields() {
		return array(
			'link'           => false,

			'event_calendar_lang' => array(
				
				'type'              => 'hidden',
				'option_category' => 'basic_option',
				'toggle_slug'       => 'decm_contents',
				'default'           => explode("_",get_locale())[0],
				
			),
			'show_dynamic_content'=> array(
				'label'				=> esc_html__( 'Dynamic Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to turn on or off dynamic content for the module, which allows you to place the module in a Divi Theme Builder layout to dynamically display events for the current category or page.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'off',
				// 'affects'           => array(
				// 	'included_categories',
				// ),
				// 	'show_if' => array(
				// 	//'use_shortcode'=>'off',
				// 	'show_dynamic_content'=>'on',
				// ),
				
			),

			'show_calendar_event_date'=> array(
				'label'				=> esc_html__( 'Show Upcoming Event Time In Calendar', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the upcoming event time above the title.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'calendar_default_view'                      => array(
				'label'           => esc_html__( 'Default View', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose which view is set by default.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'dayGridMonth'         => esc_html__( 'Month View', 'decm-divi-event-calendar-module' ),
					'timeGridWeek'             => esc_html__( 'Week View', 'decm-divi-event-calendar-module' ),
					'timeGridDay' => esc_html__( 'Days View', 'decm-divi-event-calendar-module' ),
					'listWeek' => esc_html__( 'List View', 'decm-divi-event-calendar-module' ),
				),
				'mobile_options'  => true,
				'default'         => 'dayGridMonth',
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_views',
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),

			'show_month_view_button'=> array(
				'label'				=> esc_html__( 'Show Month View Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button that toggles the month view.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),
			'show_week_view_button'=> array(
				'label'				=> esc_html__( 'Show Week View Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button that toggles the week view.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),	
			'show_day_view_button'=> array(
				'label'				=> esc_html__( 'Show Day View Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button that toggles the day view.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),

			'show_list_view_button'=> array(
				'label'				=> esc_html__( 'Show List View Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button that toggles the list view.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),
			
			'show_tooltip'=> array(
				'label'				=> esc_html__( 'Show Tooltip', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the entire tooltip.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'affects'         => array(
					'show_feature_image',
					'show_tooltip_title',
					'show_tooltip_date',
					'show_tooltip_time',
					'show_time_zone',
					'show_tooltip_excerpt',
					'show_tooltip_price',
					'show_tooltip_category',
				),
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),
			'show_feature_image'=> array(
				'label'				=> esc_html__( 'Show Tooltip Image', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event featured image in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_title'=> array(
				'label'				=> esc_html__( 'Show Tooltip Title', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event title in the tooltip.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'show_tooltip_date'=> array(
				'label'				=> esc_html__( 'Show Tooltip Date', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event date in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),	
			'date_format' => array(
				'label'             => esc_html__( 'Tooltip Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				'computed_affects'  => array(
					'event_calendar_view',
				),
					//'default'           => get_option('date_format'),
				
			),
		
			'show_tooltip_time'=> array(
				'label'				=> esc_html__( 'Show Tooltip Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	//'use_shortcode'=>'off',
				// 	'show_tooltip_date'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'time_format' => array(
				'label'             => esc_html__( 'Tooltip Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				'computed_affects'  => array(
					'event_calendar_view',
				),
					//'default'           => get_option('date_format'),
				
			),
			'show_end_time'=> array(
				'label'				=> esc_html__( 'Show Tooltip End Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event end time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// 	//'show_date'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),
			
			'show_time_zone'=> array(
				'label'				=> esc_html__( 'Show Tooltip Time Zone', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone in the tooltip', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_venue'=> array(
				'label'				=> esc_html__( 'Show Tooltip Venue', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_location'=> array(
				'label'				=> esc_html__( 'Show Tooltip Location', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location in the tooltip.', 'decm-divi-event-calendar-module' ),
				'affects'         => array(
					'show_tooltip_street',
					'show_tooltip_locality',
					'show_tooltip_postal',
					'show_tooltip_country',
				),
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_street'=> array(
				'label'				=> esc_html__( 'Show Tooltip Location Street Address', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location street address in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),		
				'show_tooltip_locality'=> array(
				'label'				=> esc_html__( 'Show Tooltip Location Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location locality in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),		
				'show_tooltip_postal'=> array(
				'label'				=> esc_html__( 'Show Tooltip Location Postal Code', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location postal code in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_country'=> array(
				'label'				=> esc_html__( 'Show Tooltip Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location country in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_organizer'=> array(
				'label'				=> esc_html__( 'Show Tooltip Organizer', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event Organizer in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_price'=> array(
				'label'				=> esc_html__( 'Show Tooltip Price', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event price in the tooltip.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_category'=> array(
				'label'				=> esc_html__( 'Show Tooltip Category', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event excerpt in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			
			'show_tooltip_weburl'=> array(
				'label'				=> esc_html__( 'Show Tooltip Website', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event website URL in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_excerpt'=> array(
				'label'				=> esc_html__( 'Show Tooltip Excerpt', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event excerpt in the tooltip.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),


			'included_categories' => array(
				'label'            => esc_html__( 'Included Categories', 'decm-divi-event-calendar-module' ),
				'type'             => 'categories',
// 				'meta_categories'  => array(
// 					'all'     => esc_html__( 'All Categories', 'decm-divi-event-calendar-module' ),
// // 					'current' => esc_html__( 'Current Category', 'decm-divi-event-calendar-module' ),
// 				),
				'option_category'  => 'configuration',
				'renderer_options' => array(
					'use_terms' => true,
					'term_name' => 'tribe_events_cat',
					
				),
				'description'      => esc_html__( 'Choose which event categories you would like to show in the calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_contents',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				'show_if' => array(
					'show_dynamic_content'=>'off',
				),
			),
			'event_start_date' => array(
				'label'             => esc_html__( 'Number Of Past Months To Load', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter a number of months to set the limit on how far in the past events should load and show in the calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'decm_contents',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
					'default'           => 1,
				
			),
			'event_end_date' => array(
				'label'             => esc_html__( 'Number Of Future Months To Load', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter a number of months to set the limit on how far in the future events should load and show in the calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'decm_contents',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
					'default'           => 6,
				
			),
			'show_feature_event'=> array(
				'label'				=> esc_html__( 'Only Show Featured Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to only show featured events in the calendar.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'off',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'day_of_the_week_name'                      => array(
				'label'           => esc_html__( 'Day of the Week Name', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose whether the days of the week should be abbreviated to show the full name.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'short' => esc_html__( 'Abbreviated', 'decm-divi-event-calendar-module' ),
					'long' => esc_html__( 'Full Name', 'decm-divi-event-calendar-module' ),
				),
				'default'         => 'short',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'day_text_style',
				'mobile_options'    => true,
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'week_background_color' => array(
				'label'             => esc_html__( 'Days of Week Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Add a background color to the days of the week.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
			
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'day_text_style',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'days_background_color' => array(
				'label'             => esc_html__( 'Calendars Days Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Add a background color to the days on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'current_days_background_color' => array(
				'label'             => esc_html__( 'Current Calendar Day Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the current day on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'current_day_text_color' => array(
				'label'             => esc_html__( 'Current Calendar Day Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the current day on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'past_days_background_color' => array(
				'label'             => esc_html__( 'Past Calendar Days Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the past days on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'past_days_text_color' => array(
				'label'             => esc_html__( 'Past Calendar Days Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the past days on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'events_background_color' => array(
				'label'             => esc_html__( 'Events Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the upcoming events.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'upcoming_event',
				 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'navigate_background_color' => array(
				'label'             => esc_html__( 'Navigation Button Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the calendar navigation.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'navigation',
				'hover'           => 'tabs',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'navigate_text_color' => array(
				'label'             => esc_html__( 'Navigation Button Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the calendar navigation.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'navigation',
				'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			

			'view_background_color' => array(
				'label'             => esc_html__( 'View Buttons Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the view buttons.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'view_button',
				'hover'           => 'tabs',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'view_text_color' => array(
				'label'             => esc_html__( 'View Buttons Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the view buttons.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'view_button',
				'hover'             => 'tabs',
		
				
				//'mobile_options'    => true,
			),
			'view_current_tab_color' => array(
				'label'             => esc_html__( 'Current View Button Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the current view button.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'view_button',
				
				//'hover'           => 'tabs',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
		

			'view_current_tab_text_color' => array(
				'label'             => esc_html__( 'Current View Button Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the current view button.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'view_button',
				//'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'tooltip_background_color' => array(
				'label'             => esc_html__( 'Tooltip Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the calendar tooltip.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'tooltip_style',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'tooltip_detail_link_color' => array(
				'label'             => esc_html__( 'Tooltip Details Link Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the link text in the event tooltip details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'tooltip_detail',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			
			'upcoming_margin' => array(
				'label' => __('Events Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the upcoming events.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'upcoming_event',
				'mobile_options'  => true,
					'default' => 'auto|auto|auto|auto|false|false',
			),
			'upcoming_padding' => array(
				'label' => __('Events Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the upcoming events.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'upcoming_event',
				'default' => '4px|6px|4px|6px|false|false',
				'mobile_options'  => true,
			),
			'calendar_border_width' => array(
				'label' => __('Calendar Days Border Width', 'decm-divi-event-calendar-module'),
				'type' => 'range',
				'description' => __('Set the border width for the days on the calendar.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'calendar_days',
				'default'    => '1px',
				'default_unit'    => 'px',
				'mobile_options'  => true,
			),
			'calendar_border_color' => array(
				'label'             => esc_html__( 'Calendar Days Border Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a border color for the days on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'week_days_border_width' => array(
				'label' => __('Days of Week Border Width', 'decm-divi-event-calendar-module'),
				'type' => 'range',
				'description' => __('Set the border width for the days of the week.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'day_text_style',
				'default'     => '1px',
				'default_unit'    => 'px',
				'mobile_options'  => true,
			),
			'week_days_border_color' => array(
				'label'             => esc_html__( 'Days of Week Border Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a border color for the days of the week.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'day_text_style',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'week_start_on' => array(
				'label'             => esc_html__( 'Week Start On', 'decm-divi-event-calendar-module' ),
				'type'              => 'hidden',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_contents',
		        'default'           => get_option('start_of_week'),
				
			),


			'calendar_eventorder'                      => array(
				'label'           => esc_html__( 'Same Day Event Order', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose the criteria for showing the order of events in a single day grid from top to bottom. ', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'start'         => esc_html__( 'Start Time', 'decm-divi-event-calendar-module' ),
					'-duration'             => esc_html__( 'Duration', 'decm-divi-event-calendar-module' ),
					'allDay' => esc_html__( 'All Day', 'decm-divi-event-calendar-module' ),
					'title' => esc_html__( 'Title', 'decm-divi-event-calendar-module' ),
				),
				'default'         => 'start',
				'tab_slug'        => 'general',
				'toggle_slug'     => 'decm_contents',
			),

			'show_recurring_event'=> array(
				'label'				=> esc_html__( 'Show Recurring Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show all recurring events in the calendar. ', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'off',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
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
				'computed_affects'  => array(
					'event_calendar_view',
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => 'default',
			),
			'disable_event_calendar_title_link'      => array(
				'label'            => esc_html__( 'Disable Event Calendar Title Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event calendar title from linking to the single event page.',  'decm-divi-event-calendar-module' ),
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
			'disable_event_title_link'      => array(
				'label'            => esc_html__( 'Disable Event Tooltip Title Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event tooltip title from linking to the single event page.',  'decm-divi-event-calendar-module' ),
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
				'label'            => esc_html__( 'Disable Event Tooltip Image Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event tooltip featured image from linking to the single event page.',  'decm-divi-event-calendar-module' ),
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
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),
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
			'enable_category_link'=> array(
				'label'				=> esc_html__( 'Enable Category Links', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the categories to link to their own archive pages.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'event_calendar_view',
				),
				'default'			=> 'on',
				'show_if' => array(
					'show_tooltip_category'=>"on",
				)
			),
			'custom_category_link_target' => array(
				'label'           => esc_html__( 'Category Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the category page links open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],
				'computed_affects'   => array(
					'event_calendar_view',
				),
				'show_if' => array(
					'enable_category_link'=>"on",
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
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
					'event_calendar_view',
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
					'event_calendar_view',
				),
			),	

			'custom_website_link_target' => array(
				'label'           => esc_html__( 'Website Link Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the custom single event page link opens in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],
				// 'show_if' => array(
				// 	'website_link'=>'custom_text',
				// ),
				'computed_affects' => array(
					'event_calendar_view',
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
			),

			'thumbnail_width' => array(
				'label'           => esc_html__( 'Tooltip Image Width', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'tooltip_image',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '800',
				'allow_empty'     => true,
				'responsive'      => true,
				'computed_affects'  => array(
					'event_calendar_view',
				),
				'mobile_options'  => true,
				
			),
			'thumbnail_height' => array(
				'label'           => esc_html__( 'Tooltip Image Height', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'tooltip_image',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '800',
				'allow_empty'     => true,
				'responsive'      => true,
				'computed_affects'  => array(
					'event_calendar_view',
				),	
				'mobile_options'  => true,
				
			),
			'event_calendar_view'         => array(
				'type'              => 'computed',
				'computed_callback' => array( 'DECM_DiviEventCalendar', 'get_events' ),
				'computed_depends_on'  => array(		
                    'show_feature_image',
					'show_tooltip_excerpt',
                    'show_tooltip_price',
					'show_tooltip_title',
                    'show_tooltip_date',
					'show_tooltip_time',
					'date_format',
					'time_format',
					'show_time_zone',
					'show_tooltip_venue',
					'show_tooltip_location',
					'show_tooltip_locality',
					'show_tooltip_street',
					'show_tooltip_city',
					'show_tooltip_postal',
					'show_tooltip_country',
					'show_tooltip_organizer',
					'show_tooltip_category',
					'show_tooltip_weburl',
					//'tooltip_background_color',
					'included_categories' ,
					'show_feature_event',
					'show_calendar_event_date',
					'calendar_default_view',
					'show_recurring_event',
					'show_end_time',
					'single_event_page_link',
					'custom_event_link_url',
					'enable_category_link',
					'custom_category_link_target',
					'website_link',
					'custom_website_link_text',
					'custom_website_link_target',
					'thumbnail_width',
					'thumbnail_height',
					'day_of_the_week_name',

				),
			),

		);
	}

static function get_events($atts = array(), $conditional_tags = array(), $current_page = array())
{
	
	
			$atts['event_tax']='';
if ( $atts['included_categories'] ) {
	if ( strpos( $atts['included_categories'] , "," ) !== false ) {
		$atts['included_categories']  = explode( ",", $atts['included_categories'] );
		$atts['included_categories']  = array_map( 'trim', $atts['included_categories'] );
	} else {
		$atts['included_categories']  = array( trim( $atts['included_categories'] ) );
	}

	$atts['event_tax'] = array(
		'relation' => 'OR',
	);

	foreach ( $atts['included_categories']  as $cat ) {
		$atts['event_tax'][] = array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $cat,
			);
			
	}
}

	// print_r($start_date);
	$event_data = array();
	$args =array(  
		'posts_per_page' => -1,
	'tax_query'=> $atts['event_tax'],
	'included_categories' => $atts['included_categories'],
	'hide_subsequent_recurrences'=>$atts['show_recurring_event']=="on"?false:true,
	);
	if($atts['show_feature_event']=="on"){
		$args['featured']="true";
	
	}
	else{}
	$events=tribe_get_events($args);
// Loop through the events, displaying the title and content for each
foreach ( $events as $event ) {
	
	$category_names = array();
	$category_list = get_the_terms( $event->ID, 'tribe_events_cat' );
	if ( is_array( $category_list ) ) {
		foreach ( (array) $category_list as $category ) {
			/**
			 * Show Categories of every events
			 *
			 * @author bojana
			 */
			$categories_link =$atts['show_tooltip_category']=="on"? $atts['enable_category_link']=="on" ?'<a href="'.get_category_link( $category->term_id ).'" target="'.$atts['custom_category_link_target'].'" >'.$category->name.'</a>' : $category->name:"";
			$category_names[] = $categories_link;
		}
	}

  $e = array();
  $e['custom_event_link_url']=$atts['single_event_page_link']=="default" || ($atts['single_event_page_link']=="replace_link" &&$atts['custom_event_link_url']=="")?tribe_get_event_link($event->ID):(($atts['single_event_page_link']=="redirect_link")?$result: $atts['custom_event_link_url']);
  $e['custom_website_link_text']=$atts['custom_website_link_text']==""?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];
  $e["title"]='<a href="'.get_permalink($event->ID,$leavename = false).'">'.$event->post_title .'</a>';
  $e["tooltip_title"]=$atts['show_tooltip_title']=="on"?$event->post_title:"" ;
  $e["start"] =tribe_get_start_time( $event->ID,"H:i")!=""? tribe_get_start_date($event->ID,false,'Y-m-d')."T".tribe_get_start_time( $event->ID,"H:i"):tribe_get_start_date($event->ID,false,'Y-m-d');
  $e["end"] = tribe_get_end_time( $event->ID,"H:i")!=""?tribe_get_end_date( $event->ID,false,'Y-m-d')."T".tribe_get_end_time( $event->ID,"H:i"):gmdate('Y-m-d', strtotime( tribe_get_end_date($event->ID,false,'Y-m-d') . " +1 days"));
  $e["cost"] =$atts['show_tooltip_price']=="on"? tribe_get_cost($event->ID,null, true):"" ;
  $e["category_data"] =get_the_terms($event->ID,'tribe_events_cat');
  $e["tooltip_category"]= $e["tooltip_category"]='<div class ="event_category_style">'.implode(", ", $category_names).'</div>';
  $e["event_start_date"]= tribe_get_start_date( $event->ID,null,get_option('date_format'));
  $e["event_end_date"]=tribe_get_start_date($event->ID,null,get_option( 'date_format' ))!= tribe_get_end_date($event->ID,null,get_option( 'date_format' ))?"-".tribe_get_end_date( $event->ID,null,get_option('date_format')):"" ;
  $e["event_start_time"]=tribe_get_start_time( $event->ID,get_option('time_format'));
  $e["event_end_time"]=tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' ))?"-".tribe_get_end_time( $event->ID,get_option('time_format')):"" ;
  $e["post_event_excerpt"] =$atts['show_tooltip_excerpt']=="on"? $event->post_excerpt:"";
  $e['featured_class'] = ( get_post_meta( $event->ID , '_tribe_featured', true ) ? ' decm-featured-event ' : '' );
  $e['dateTimeSeparator']=tribe_get_option( 'dateTimeSeparator', ' @ ' );
  $e['timeRangeSeparatorEnd']=$atts['show_end_time']=="on"?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";
  $e['timeRangeSeparator']=tribe_get_option( 'timeRangeSeparator', ' - ' );(tribe_get_start_date($event->ID,null,get_option( 'date_format' ))!= tribe_get_end_date($event->ID,null,get_option( 'date_format' )))&&$atts['show_end_time']=="off"?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";
 $e['show_calendar_event_date']= $atts['show_calendar_event_date'];
 $e["venue"]=$atts['show_tooltip_venue']=="on"   && tribe_get_venue($event->ID)!=null ?'<div class="event_venue_style"><span> '.tribe_get_venue($event->ID).' </span></div>':"";
  $e["street"]=$atts['show_tooltip_street']=="on" && $atts['show_tooltip_location']=="on" && tribe_get_address($event->ID)!=null?tribe_get_address($event->ID):"";
  $e["locality"]=$atts['show_tooltip_locality']=="on" && $atts['show_tooltip_location']=="on" && tribe_get_city($event->ID)!=null?" ".tribe_get_city($event->ID):""; 
  $e["postal"]=$atts['show_tooltip_postal']=="on"&& $atts['show_tooltip_location']=="on" &&  tribe_get_zip($event->ID)!=null?" ".tribe_get_zip($event->ID):""; 
  $e["country"]=$atts['show_tooltip_country']=="on" && $atts['show_tooltip_location']=="on" && tribe_get_country($event->ID)!=null?" ".tribe_get_country($event->ID):""; 
  $e["organizer"]=$atts['show_tooltip_organizer']=="on" && tribe_get_organizer($event->ID)!=null?'<div class="event_organizer_style"><span> '.tribe_get_organizer($event->ID).' </span></div>':""; 
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' )))
  { 
  $e["start_date"]=$atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$atts['date_format']):"";
  $e["end_date"]= $atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_end_date( $event->ID,null,get_option('date_format')):tribe_get_end_date( $event->ID,null,$atts['date_format']):"";
  $e["start_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"? $atts['time_format'] == ""?$e['dateTimeSeparator']." ".tribe_get_start_time( $event->ID,get_option('time_format')) :$e['dateTimeSeparator']." ".tribe_get_start_time($event->ID,$atts['time_format']):""):"";
  $e["end_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?$e['dateTimeSeparator']." ". tribe_get_end_time( $event->ID,get_option('time_format')):$e['dateTimeSeparator']." ".tribe_get_end_time($event->ID,$atts['time_format']):""):"All Day Event" ;
  $e["time_zone"]=$atts['show_time_zone'] == 'off'?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
  }
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))== tribe_get_end_time($event->ID,get_option( 'time_format' )))
  {
	$e["start_date"]=$atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$atts['date_format']):"";
	$e["end_date"]= "";
	$e["start_time"]= "";
	$e["end_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?$e['dateTimeSeparator']." ". tribe_get_end_time( $event->ID,get_option('time_format')):$e['dateTimeSeparator'].tribe_get_end_time($event->ID,$atts['time_format']):""):"All Day Event" ;
	$e["time_zone"]=$atts['show_time_zone'] == 'off'?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
  }
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' )))
{
	$e["start_date"]=$atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$atts['date_format']):"";
	$e["end_date"]="";
	$e["start_time"]=!tribe_event_is_all_day($event->ID)? ($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?$e['dateTimeSeparator']." ".tribe_get_start_time( $event->ID,get_option('time_format')) :$e['dateTimeSeparator'].tribe_get_start_time($event->ID,$atts['time_format']):""):"";
	$e["end_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?$e['dateTimeSeparator']." ". tribe_get_end_time( $event->ID,get_option('time_format')):$e['dateTimeSeparator'].tribe_get_end_time($event->ID,$atts['time_format']):""):"All Day Event" ;
	$e["time_zone"]=$atts['show_time_zone'] == 'off'?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
	}
	if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))== tribe_get_end_time($event->ID,get_option( 'time_format' )))
	{
		$e["start_date"]=$atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$atts['date_format']):"";
		$e["end_date"]= $atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_end_date( $event->ID,null,get_option('date_format')):tribe_get_end_date( $event->ID,null,$atts['date_format']):"";
		$e["start_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"? $atts['time_format'] == ""?$e['dateTimeSeparator']." ".tribe_get_start_time( $event->ID,get_option('time_format')) :$e['dateTimeSeparator'].tribe_get_start_time($event->ID,$atts['time_format']):""):"";
		$e["end_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?$e['dateTimeSeparator']." ". tribe_get_end_time( $event->ID,get_option('time_format')):$e['dateTimeSeparator'].tribe_get_end_time($event->ID,$atts['time_format']):""):"All Day Event" ;
		$e["time_zone"]=$atts['show_time_zone'] == 'off'?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
		}
  //$e['size']='large';
  //$e["img_src"]=wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), $e['size'] );
  $e['tooltip_weburl']=$atts['show_tooltip_weburl']=="on" && tribe_get_event_website_link($event->ID)!=null?($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<a href="'.tribe_get_event_meta($event->ID, '_EventURL', true ).'" target="'.$atts['custom_website_link_target'].'">'.$e['custom_website_link_text'].'</a>':'<a href="'.tribe_get_event_meta($event->ID, '_EventURL', true ).'" target="'.$atts['custom_website_link_target'].'">'.tribe_get_event_website_url($event->ID).'</a>':""; 
  $e["feature_image"]=$atts['show_feature_image']=="on"?get_the_post_thumbnail($event->ID,array($atts['thumbnail_height'],$atts['thumbnail_width'])):"";
  $e["post_event_permalink"] = tribe_get_event_link($event->ID);
  $e["currency"] =$atts['show_tooltip_price']=="on"? tribe_get_event_meta( $event->ID, '_EventCurrencySymbol', true ):"";
  //  $e["post_event_image"] = tribe_event_featured_image($event->ID);
  $e["html"] = '<div class="tooltip_main" ><div class="feature_img">'.$e["feature_image"].'</div><div class="event_detail_style" ><div class="event_title_style"><h3 class="title_text"> <a href="'.$e["post_event_permalink"].'">'.$e["tooltip_title"].'</a></h3></div><div class="start_time" ><span>'.$e["start_date"].' '.$e["start_time"] .' </span></div><div class="end_time" ><span>'.$e['timeRangeSeparator'].$e['timeRangeSeparatorEnd'].$e["end_date"].' '.$e["end_time"].' '.$e['time_zone'].'</span>'.$e["venue"].'<div class="event_address_style"><span>'.$e["street"].$e["locality"].$e["postal"].$e["country"].'</span></div>'.$e["organizer"].'<div class="event_price_style"><span>'.$e["currency"].
  $e["cost"].'</span></div>'.trim($e["tooltip_category"],":").'<div class="event_website_url_style">'.$e['tooltip_weburl'].'</div><div class="event_excerpt_style"><span>'.$e["post_event_excerpt"].'</span></div></div></div></div>'; 
  
  array_push($event_data, $e);
}

return json_encode($event_data);


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

 
	public function render( $attrs, $content = null, $render_slug ) {
 	// echo'<pre>';
	//  print_r($this->props);
	//  echo'</pre>'; 
	//  exit;
	// global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
	// $post_type = get_post_type();
	// print_r($wp_query);
		
		$atts = array();
		$date_format                            = $this->props['date_format'];
		$time_format                            = $this->props['time_format'];
		$show_time_zone                         = $this->props['show_time_zone'];
		$included_categories                    = $this->props['included_categories'];
		$show_feature_event						= $this->props['show_feature_event'];
		$week_background_color                  = $this->props['week_background_color'];
		$days_background_color                  = $this->props['days_background_color'];
		$current_days_background_color			= $this->props['current_days_background_color'];
		$current_day_text_color					= $this->props['current_day_text_color'];
		$past_days_background_color				= $this->props['past_days_background_color'];
		$past_days_text_color					= $this->props['past_days_text_color'];
		$events_background_color = $this->props["events_background_color"];
		$single_event_page_link = $this->props['single_event_page_link'];
		$disable_event_title_link = $this->props['disable_event_title_link'];
		$disable_event_image_link = $this->props['disable_event_image_link'];
		//$disable_event_button_link = $this->props['disable_event_button_link'];
		$custom_event_link_url = $this->props['custom_event_link_url'];
		$custom_event_link_target = $this->props['custom_event_link_target'];
        $events_background_color_responsive_active = isset($this->props["events_background_color"]) && et_pb_get_responsive_status($this->props["events_background_color_last_edited"]);
        $events_background_color_tablet = $events_background_color_responsive_active && $this->props["events_background_color_tablet"] ? $this->props["events_background_color_tablet"] : $events_background_color;
        $events_background_color_phone = $events_background_color_responsive_active && $this->props["events_background_color_phone"] ? $this->props["events_background_color_phone"] : $events_background_color_tablet;
		$events_background_color__hover         = et_pb_hover_options()->get_value('events_background_color', $this->props, '' );
		$events_background_color__hover_enabled = et_builder_is_hover_enabled( 'events_background_color', $this->props );
		$navigate_background_color				= $this->props['navigate_background_color'];
		$navigate_background_color__hover       = et_pb_hover_options()->get_value('navigate_background_color', $this->props, '' );
		$navigate_background_color__hover_hover_enabled = et_builder_is_hover_enabled( 'navigate_background_color', $this->props );
		$navigate_text_color__hover         	= et_pb_hover_options()->get_value('navigate_text_color', $this->props, '' );
		$navigate_text_color__hover_hover_enabled = et_builder_is_hover_enabled( 'navigate_text_color', $this->props );
		$navigate_text_color					= $this->props['navigate_text_color'];
		$view_background_color				    = $this->props['view_background_color'];
		$view_background_color__hover           = et_pb_hover_options()->get_value('view_background_color', $this->props, '' );
		$view_background_color__hover_enabled   = et_builder_is_hover_enabled( 'view_background_color', $this->props );
		$view_current_tab_color				    = $this->props['view_current_tab_color'];
		$view_text_color						= $this->props['view_text_color'];
		$view_text_color__hover        			= et_pb_hover_options()->get_value('view_text_color', $this->props, '' );
		$view_text_color__hover_enabled 		= et_builder_is_hover_enabled( 'view_text_color', $this->props );

		$view_current_tab_text_color            = $this->props['view_current_tab_text_color'];
		$view__current_text_color__hover       	= et_pb_hover_options()->get_value('view_current_tab_text_color', $this->props, '' );
		$view_current_text_color__hover_enabled = et_builder_is_hover_enabled( 'view_current_tab_text_color', $this->props );
		$tooltip_background_color				= $this->props['tooltip_background_color'];
		$tooltip_detail_link_color				= $this->props['tooltip_detail_link_color'];
    	$upcoming_padding						= $this->props['upcoming_padding']; 
		$upcoming_margin						= $this->props['upcoming_margin']; 
		$calendar_border_width 					= $this->props ['calendar_border_width' ];
        $calendar_border_width_responsive_active= isset($this->props["calendar_border_width"]) && et_pb_get_responsive_status($this->props["calendar_border_width_last_edited"]);
        $calendar_border_width_tablet 			= $calendar_border_width_responsive_active && $this->props["calendar_border_width_tablet"] ? $this->props["calendar_border_width_tablet"] : $calendar_border_width;
        $calendar_border_width_phone 			= $calendar_border_width_responsive_active && $this->props["calendar_border_width_phone"] ? $this->props["calendar_border_width_phone"] : $calendar_border_width_tablet;
		$calendar_border_color 					= $this->props ['calendar_border_color' ];
        $calendar_border_color_responsive_active= isset($this->props["calendar_border_color"]) && et_pb_get_responsive_status($this->props["calendar_border_color_last_edited"]);
        $calendar_border_color_tablet 			= $calendar_border_color_responsive_active && $this->props["calendar_border_color_tablet"] ? $this->props["calendar_border_color_tablet"] : $calendar_border_color;
        $calendar_border_color_phone 			= $calendar_border_color_responsive_active && $this->props["calendar_border_color_phone"] ? $this->props["calendar_border_color_phone"] : $calendar_border_color_tablet;
		$week_days_border_width 				= $this->props ['week_days_border_width' ];
        $week_days_border_width_responsive_active = isset($this->props["week_days_border_width"]) && et_pb_get_responsive_status($this->props["week_days_border_width_last_edited"]);
        $week_days_border_width_tablet 			= $week_days_border_width_responsive_active && $this->props["week_days_border_width_tablet"] ? $this->props["week_days_border_width_tablet"] : $week_days_border_width;
        $week_days_border_width_phone 			= $week_days_border_width_responsive_active && $this->props["week_days_border_width_phone"] ? $this->props["week_days_border_width_phone"] : $week_days_border_width_tablet;
	
		$week_days_border_color 				= $this->props ['week_days_border_color' ];
        $week_days_border_color_responsive_active = isset($this->props["week_days_border_color"]) && et_pb_get_responsive_status($this->props["week_days_border_color_last_edited"]);
        $week_days_border_color_tablet 			= $week_days_border_color_responsive_active && $this->props["week_days_border_color_tablet"] ? $this->props["week_days_border_color_tablet"] : $week_days_border_color;
        $week_days_border_color_phone 			= $week_days_border_color_responsive_active && $this->props["week_days_border_color_phone"] ? $this->props["week_days_border_color_phone"] : $week_days_border_color_tablet;
		$tooltip_title_font                     = $this->props['tooltip_title_font'];
		$show_tooltip                           = $this->props['show_tooltip'];
		$show_feature_image                     = $this->props['show_feature_image'];
		$show_tooltip_excerpt                   = $this->props['show_tooltip_excerpt'];
		$show_tooltip_price                   	= $this->props['show_tooltip_price'];
		$show_tooltip_title                   	= $this->props['show_tooltip_title'];
		$show_tooltip_date                   	= $this->props['show_tooltip_date'];
		$show_tooltlip_time                   	= $this->props['show_tooltip_time'];
		
		// print_r( ET_Builder_Element::get_media_query('max_width_767'));
		// exit;
		if ( '' !== $week_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-day-header',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $week_background_color )
				),
			) );
		}
		if ( '' !== $days_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-day.fc-past,.fc-day.fc-future',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $days_background_color )
				),
			) );
		}
		if ( '' !== $current_days_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-day.fc-today',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $current_days_background_color )
				),
			) );
		}
		if ( '' !== $current_day_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-today .fc-day-number',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $current_day_text_color )
				),
			) );
		}
		if ( '' !== $past_days_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-day.fc-past',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $past_days_background_color )
				),
			) );
		}
		if ( '' !== $past_days_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-past .fc-day-number',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $past_days_text_color )
				),
			) );
		}
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    =>  '%%order_class%% .fc-event',
            'declaration' => "background-color: {$events_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    =>  '%%order_class%% .fc-event',
            'declaration' => "background-color: {$events_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    =>  '%%order_class%% .fc-event',
            'declaration' => "background-color: {$events_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
		
		if ( '' !== $events_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-event',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $events_background_color )
				),
			) );
		}
		
		if ( $events_background_color__hover  != '' && $events_background_color__hover_enabled ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-event:hover',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $events_background_color__hover )
				),
			) );
		}
		
		
		if ( '' !== $navigate_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  "%%order_class%% .fc-today-button,.fc-prev-button,.fc-next-button",
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $navigate_background_color )
				),
			) );
		}

		if ( '' !== $navigate_background_color__hover ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .fc-today-button:hover,.fc-prev-button:hover,.fc-next-button:hover",
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $navigate_background_color__hover)
				),
			) );
		}

		
		if ( '' !== $navigate_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  "%%order_class%% .fc-today-button,.fc-prev-button,.fc-next-button",
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $navigate_text_color )
				),
			) );
		}
		if ( '' !== $navigate_text_color__hover ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .fc-today-button:hover,.fc-prev-button:hover,.fc-next-button:hover",
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $navigate_text_color__hover )
				),
			) );
		}
		if ( '' !== $tooltip_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '.tooltip',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $tooltip_background_color )
				),
			) );
		}
		if ( '' !== $tooltip_detail_link_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '.tooltip_main .event_category_style a ,.event_website_url_style a',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $tooltip_detail_link_color )
				),
			) );
		}

		if ( '' !== $view_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $view_background_color )
				),
			) );
		}
		if ( '' !== $view_background_color__hover ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  '%%order_class%% .fc-dayGridMonth-button:hover,.fc-timeGridWeek-button:hover,.fc-timeGridDay-button:hover,.fc-listWeek-button:hover',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html($view_background_color__hover)
				),
			) );
		}
		if ( '' !== $view_current_tab_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-button-active',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $view_current_tab_color )
				),
			) );
		}
		if ( '' !== $view_current_tab_text_color  ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-button-active',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $view_current_tab_text_color )
				),
			) );
		}



		
		if ( '' !== $view_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $view_text_color )
				),
			) );
		}
		if ( '' !== $view_text_color__hover ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  '%%order_class%% .fc-dayGridMonth-button:hover,.fc-timeGridWeek-button:hover,.fc-timeGridDay-button:hover,.fc-listWeek-button:hover',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $view_text_color__hover )
				),
			) );
		}
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day',
            'declaration' => "border-width: {$calendar_border_width} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day',
            'declaration' => "border-width: {$calendar_border_width_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day',
            'declaration' => "border-width: {$calendar_border_width_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-week,%%order_class%% .fc-day',
            'declaration' => "border-color: {$calendar_border_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-week,%%order_class%% .fc-day',
            'declaration' => "border-color: {$calendar_border_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-week,%%order_class%% .fc-day',
            'declaration' => "border-color: {$calendar_border_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-width: {$week_days_border_width} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-width: {$week_days_border_width_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-width: {$week_days_border_width_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-color: {$week_days_border_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-color: {$week_days_border_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-color: {$week_days_border_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		$this->apply_custom_margin_padding($render_slug, 'upcoming_margin', 'margin', 
		'%%order_class%% .fc-not-end,.fc-end');
		$this->apply_custom_margin_padding($render_slug, 'upcoming_padding', 'padding', 
		'%%order_class%% a.fc-day-grid-event');
		
		
// echo '<pre>';
// 		print_r($this->props);
// 		exit;
 $attrs = array(
		'date_format'                            =>$date_format,
		'time_format'                            =>$time_format,
		'show_time_zone'                         =>$show_time_zone,
	    'included_categories'                    => $included_categories,
	    'week_background_color'                  => $week_background_color,
		'days_background_color '                 => $days_background_color,
		'events_background_color '               => $events_background_color,
		'navigate_background_color '             => $navigate_background_color,
		'navigate_text_color'                    => $navigate_text_color,
		'upcoming_padding'                       => $upcoming_padding, 
		'upcoming_margin'                        => $upcoming_margin,
		'calendar_border_width '                 => $calendar_border_width,
		'calendar_border_color'                  => $calendar_border_color ,
		'event_tax'                              => '',
);
$categslug="";
$categId="";
global $wp_query;
$disable_event_title_link = $this->props['disable_event_title_link']=="on"?" decm_disable_event_link ":"";
$disable_event_image_link = $this->props['disable_event_image_link']=="on"?" decm_disable_event_link ":"";
$disable_event_calendar_title_link = $this->props['disable_event_calendar_title_link']=="on"?" decm_disable_event_link ":"";
$cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
$categslug = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->slug:"";
$categId = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->term_id:"";
wp_register_script("calendar_show",'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.2.4/js/EventCalendar/calender_show.js');
//    print_r(EVENT_DIR);
// localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
wp_enqueue_script('main_1', 'https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.3.1/main.min.js', array(), null, false);
wp_enqueue_script('main_2', 'https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.js', array(), null, false);
wp_enqueue_script('main_3', 'https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js', array(), null, false);
wp_enqueue_script('main_4', 'https://cdn.jsdelivr.net/npm/@fullcalendar/list@4.3.0/main.min.js', array(), null, false);
wp_enqueue_script('main_6', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.1.2/js/EventCalendar/main_6.js', array(), null, false);
wp_enqueue_script('main_7', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.1.2/js/EventCalendar/main_7.js', array(), null, false);
if(get_locale()!="en_US"){
	wp_enqueue_script('main_8', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.2.3/js/EventCalendar/locales-all.min.js', array(), null, false);
}

wp_localize_script( 'calendar_show', 'myAjax', 
array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
'date_format'=>$this->props['date_format'],
'time_format'=>$this->props['time_format'],
'show_time_zone'=>$this->props['show_time_zone'],
'included_categories'=>$this->props['included_categories'],
'show_feature_event' => $this->props['show_feature_event'],
'show_tooltip'  =>$this->props['show_tooltip'],
'show_image'=>$this->props['show_feature_image'],
'show_excerpt'=>$this->props['show_tooltip_excerpt'],
'show_price' =>$this->props['show_tooltip_price'],
'show_title' =>$this->props['show_tooltip_title'],
'show_date'  =>$this->props['show_tooltip_date'],
'show_time'  =>$this->props['show_tooltip_time'],
'show_venue'=>$this->props['show_tooltip_venue'],
'show_location'=>$this->props['show_tooltip_location'],
'show_address'=>$this->props['show_tooltip_street'],
'show_locality'=>$this->props['show_tooltip_locality'],
'show_postal'=>$this->props['show_tooltip_postal'],
'show_country'=>$this->props['show_tooltip_country'],
'show_organizer'=>$this->props['show_tooltip_organizer'],
'calendar_eventorder' => $this->props['calendar_eventorder'],
'calendar_default_view'=> $this->props['calendar_default_view'],
'calendar_default_view_tablet'=> $this->props['calendar_default_view_tablet'],
'calendar_default_view_phone'=> $this->props['calendar_default_view_phone'],
'id' =>get_the_id(),
'show_month_view_button' => $this->props['show_month_view_button'],
'show_month_view_button_tablet' => $this->props['show_month_view_button_tablet'],
'show_month_view_button_phone' => $this->props['show_month_view_button_phone'],
'show_list_view_button' => $this->props['show_list_view_button'],
'show_list_view_button_tablet' => $this->props['show_list_view_button_tablet'],
'show_list_view_button_phone' => $this->props['show_list_view_button_phone'],
'show_week_view_button' => $this->props['show_week_view_button'],
'show_week_view_button_tablet' => $this->props['show_week_view_button_tablet'],
'show_week_view_button_phone' => $this->props['show_week_view_button_phone'],
'show_day_view_button' => $this->props['show_day_view_button'],
'show_day_view_button_tablet' => $this->props['show_day_view_button_tablet'],
'show_day_view_button_phone' => $this->props['show_day_view_button_phone'],
'categslug'     =>$categslug,
'categId'     =>$categId,
'show_dynamic_content'=> $this->props['show_dynamic_content'],
'show_tooltip_category' =>$this->props['show_tooltip_category'],
'custom_category_link_target'=>$this->props['custom_category_link_target'],
'show_tooltip_weburl'=> $this->props['show_tooltip_weburl'],
'week_start_on'			=>$this->props['week_start_on'],
'show_calendar_event_date'=> $this->props['show_calendar_event_date'],
'show_calendar_event_date_tablet'=> $this->props['show_calendar_event_date_tablet'],
'show_calendar_event_date_phone'=> $this->props['show_calendar_event_date_phone'],
'show_recurring_event' => $this->props['show_recurring_event'],
'event_start_date'   => $this->props['event_start_date'],
'event_end_date'   => $this->props['event_end_date'],
'day_of_the_week_name' => $this->props['day_of_the_week_name'],
'day_of_the_week_name_tablet' => $this->props['day_of_the_week_name_tablet'],
'day_of_the_week_name_phone' => $this->props['day_of_the_week_name_phone'],
'events_background_color' => $this->props["events_background_color"],
'single_event_page_link' => $this->props['single_event_page_link'],
'disable_event_title_link' => $disable_event_title_link,
'disable_event_image_link' => $disable_event_image_link,
'disable_event_calendar_title_link' => $disable_event_calendar_title_link,
'custom_event_link_url' => $this->props['custom_event_link_url'],
'custom_event_link_target' => $this->props['custom_event_link_target'],
'show_end_time'=> $this->props['show_end_time'],
'enable_category_link'=> $this->props['enable_category_link'],
'website_link'=> $this->props['website_link'],
'custom_website_link_text'=> $this->props['custom_website_link_text'],
'custom_website_link_target'=>$this->props['custom_website_link_target'],
'thumbnail_width' => $this->props['thumbnail_width'],
'thumbnail_height' => $this->props['thumbnail_height'],
));        


	 wp_enqueue_script("calendar_show",'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.2.4/js/EventCalendar/calender_show.js', array('main_7'), null, false);
	 		wp_localize_script('calendar_show', 'calendar_show_url', array(
			'pluginsUrl' => plugin_dir_url( __FILE__ ),
			'WpworpdressUrl' => get_home_path().'wp-load.php',
		));
		return sprintf("<div id='calendar'></div>
			");
		
	}
	
	
}

new DECM_DiviEventCalendar;
