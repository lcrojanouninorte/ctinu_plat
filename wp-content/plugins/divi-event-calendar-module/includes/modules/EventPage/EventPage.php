<?php

class DIEC_EventPage extends ET_Builder_Module {

	public $slug       = 'diec_event_page';
	public $vb_support = 'on';
	

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Page', 'decm-divi-event-calendar-module' );
		$this->main_class = '%%order_class%%';

	}

	public function get_settings_modal_toggles() {
		return array(
		  
			  'gerneral' => array(
				  'toggles' => array(
					  'decm_content' => array(
						  'priority' => 1,
						  'title' => esc_html__( 'Content', 'decm-divi-event-calendar-module' ),
					  ),	
					  'decm_details' => array(
						  'priority' => 2,
						  'title' => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					  ),
					  'link_show' => array(
						'priority' => 22,
						'title' => esc_html__( 'Links', 'decm-divi-event-calendar-module'),
					),
					  'google_maps' => array(
						'priority' => 49,
						'title' => esc_html__( 'Google Maps', 'decm-divi-event-calendar-module' ),
					),
					  'calendar_link' => array(
						  'priority' => 65,
						  'title' => esc_html__( 'Add To Calendar Buttons', 'decm-divi-event-calendar-module'),
					  ),	  
				  ),
			  ),
			  'advanced' => array(
				  'toggles' => array(
					'past_event_message'=>esc_html__('Past Event Message Text','decm-divi-event-calendar-module'), 
					'event_description'  => esc_html__( 'Description Text', 'decm-divi-event-calendar-module' ),
					  'event'  => esc_html__( 'Details Text', 'decm-divi-event-calendar-module' ),
					  'detail_label'  => esc_html__( 'Details Labels Text', 'decm-divi-event-calendar-module' ),	  
					  'child_filters_map'  => esc_html__( 'Map', 'decm-divi-event-calendar-module' ),
					  'add_to_calendar_button'=>esc_html__( 'Add To Calendar Button', 'decm-divi-event-calendar-module' ),
					  'add_to_calendar_link'=>esc_html__( 'Add To Calendar Links', 'decm-divi-event-calendar-module' ),
					  
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
			  'button'         =>false,
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
				  'map_border'   => array(
					  'css'          => array(
						  'main' => array(
							  'border_radii'  => "%%order_class%% .ecs_google_map iframe",
							  'border_styles' => "%%order_class%% .ecs_google_map iframe",
							  
						  ),
						  'important' => 'all',
					  ),
					  'label_prefix' => esc_html__( 'Map Border', 'decm-divi-event-calendar-module' ),
					  'description'        => esc_html__( 'Add and customize the box shadow for the event location map with all the standard box border settings.', 'decm-divi-event-calendar-module' ),
					  'tab_slug'     => 'advanced',
					  'toggle_slug'  => 'child_filters_map',
					 
				  ),
				  'pass_event_border'   => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% div.tribe-events-notices",
							'border_styles' =>"%%order_class%% div.tribe-events-notices",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Pasts Events Message', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the border for the past events message with all the standard border settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'past_event_message',
				   
				),
			  ),
		  
			  'box_shadow'     => array(
				  'default' => array(
					  'css' => array(
						  'main' => "%%order_class%%",
					  ),
				  ),
				  
			  'map_box_shadow'     => array(
					  'css' => array(
						  'main' => "%%order_class%% .ecs_google_map iframe",
					  ),
					  'label'         => esc_html__( 'Map Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					  'description'        => esc_html__( 'Add and customize the box shadow for the event location map with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					  'tab_slug'     => 'advanced',
					  'toggle_slug'  => 'child_filters_map',
					  //'default'          => 'solid',
				  ),
				  'pass_event_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% div.tribe-events-notices",
					),
					'label'         => esc_html__( 'Past Events Message Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the past events message with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'past_event_message',
					//'default'          => 'solid',
				),

			  ),

			'filters'        => array(
				'css' => array(
					'main' =>'%%order_class%%',
				),
			),

			  'fonts'          => array(
				'description' => array(
					'css'          => array(
						'main'      => "%%order_class%% div.ecs-event-description p",
						'important' => 'all',
					),
					
					'label'        => esc_html__( 'Description', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'event_description',

				),
				'pass_event' => array(
					'css'          => array(
						'main'      => "%%order_class%% div.tribe-events-notices",
						'important' => 'all',
					),
					
					'label'        => esc_html__( 'Past Events Message', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'past_event_message',

				),
				'details_labels' => array(
					'css'          => array(
						'main'      => "%%order_class%% .ecs-detail-label",
						'important' => 'all',
					),
					
					'label'        => esc_html__( 'Details Label', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'detail_label',

				),
				  'duration' => array(
					  'css'          => array(
						  'main'      => "%%order_class%% div.decm-show-detail-center,%%order_class%% span.duration,%%order_class%% span.ecs-venue,%%order_class%% span.location, %%order_class%% span.ecs-organizer,%%order_class%% span.ecs-price,%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a",
						  'important' => 'all',
					  ),
					  'toggle_priority' => 80,
					  'label'        => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					  //'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					  'disable_toggle' => false,
					  'tab_slug'     => 'advanced',
					  'toggle_slug'  => 'event',
					  'add_to_calendar_link'
				  ),
				  'calendar_link' => array(
					'css'          => array(
						'main'      => "%%order_class%% p.ecs-show_calendar a,%%order_class%% p.ecs-showical-export a,%%order_class%% p.ecs-showoutlook-link a,%%order_class%% .ecs-calendar_link_align",
						'important' => 'all',
					),
					'toggle_priority' => 80,
					'label'        => esc_html__( 'Add To Calendar Link', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'add_to_calendar_link',
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
				'add_to_calendar_button' => array(
					'label'         => __( 'Add To Calendar Button', 'decm-divi-event-calendar-module' ),
					'use_alignment' => true,
					'box_shadow'    => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'add_to_calendar_button',
					'css'           => array(
						'main'        => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .act-add_to_calendar",
						'plugin_main' => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .act-add_to_calendar",
						'alignment'   => "%%order_class%% .diec_add_to_calendar",
						'important' => 'all',
					),
					'margin_padding' => array(
						'css' => array(
							'margin' => "%%order_class%% p.diec_add_to_calendar",
							 'padding' => "%%order_class%% .act-add_to_calendar",
							'important' => 'all',
						),
						'custom_margin' => array(
					'default' => '15px|auto|15px|auto|false|false',
				),
					),
				),					
				  
  
			  ),
  
		  );
	  }
	  public function get_fields() {
		  return array(
  
			'link'           => false,
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
				  'toggle_slug'     => 'decm_details',
			  ),
			  'shortcode_param' => array(
				  'label'             => esc_html__( 'shortcode_param', 'decm-divi-event-calendar-module' ),
				  'type'              => 'text',
				  'option_category'   => 'configuration',
				  'description'       => esc_html__( 'Total number of events to show.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'       => 'decm_details',
				  'default'           => '',
				  'show_if' => array(
					  'use_shortcode'=>'on',
				  )
			  ),
			  'use_current_loop'=> array(
				  'label'				=> esc_html__( 'Dynamic Event Content', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'layout',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to turn on or off dynamic content for the module, which allows you to place the module in a Divi Theme Builder layout to dynamically display event categories for the current category or page. This will also work on the single event pages and for the Theme Builder search results page!', 'decm-divi-event-calendar-module' ),
				  
				  'toggle_slug'     => 'decm_content',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),

			  'passed_event_notice'=> array(
				'label'				=> esc_html__( 'Show Passed Event Notice', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the past event notice. If enabled, the notice will show in this module when the event has passed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),

  
  			'description'=> array(
				'label'				=> esc_html__( 'Show Event Description', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event description. The event description is the text written within the backend text editor of the single event pages using the classic WordPress editor. This Show Event Description setting is intended for simple text descriptions and is not recommended in most cases. Instead, you should use the Divi Post Content module, which is much more suited for showing content from pages build with Gutenberg or the Divi Builder.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),

			'Show_description_placeholder'=> array(
				'label'				=> esc_html__( 'Show Event Description', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				// 'options'			 => array(
				// 	'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
				// 	'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				// ),
				'description'		=> esc_html__( 'Choose to show or hide the description of the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> "Your dynamic event description will display here. ",
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),
			  'show_feature_image'=> array(
				  'label'				=> esc_html__( 'Show Featured Image', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event featured image.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
  
			  'show_title'=> array(
				  'label'				=> esc_html__( 'Show Title', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event title.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
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
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),

			  'date_format' => array(
				'label'             => esc_html__( 'Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
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
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
					  //'show_date'=>'on',
				  )
			  ),

			  'time_format' => array(
				'label'             => esc_html__( 'Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
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
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_time'=> 'on',
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
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
					  'show_time'=>'on',
					  //'show_date'=>'on',
				  ),
				  'computed_affects'   => array(
					  '__getEvents',
				  ),
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
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  ),
				  'affects' => array(
					'show_street',
					'show_locality',
					'show_postal',
					'show_country',
				),
			  ),
			  
			'show_street'=> array(
				'label'				=> esc_html__( 'Show Location Street Address', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location street address in the tooltip.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',

				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),		
				'show_locality'=> array(
				'label'				=> esc_html__( 'Show Location Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location locality in the tooltip.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',

				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),		
				'show_postal'=> array(
				'label'				=> esc_html__( 'Show Location Postal Code', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location postal code in the tooltip.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',
	
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_country'=> array(
				'label'				=> esc_html__( 'Show Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location country in the tooltip.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',
	
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			  'google_link'=> array(
				'label'				=> esc_html__( 'Show Google Map Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location Google Map link.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'google_maps',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
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
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			
			'venue_phone'=> array(
				'label'				=> esc_html__( 'Show Venue Phone', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'venue_weburl'=> array(
				'label'				=> esc_html__( 'Show Venue Website', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				  'toggle_slug'		=> 'decm_details',
				  'computed_affects'   => array(
					  '__posts',
					  '__getEvents',
				  ),
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
			 
			  'organizer_phone'=> array(
				'label'				=> esc_html__( 'Show Organizer Phone', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'organizer_email'=> array(
				'label'				=> esc_html__( 'Show Organizer Email', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'organizer_weburl'=> array(
				'label'				=> esc_html__( 'Show Organizer website', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
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
				  'toggle_slug'		=> 'decm_details',
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
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
			 
			  'event_tag' => array(
				'label'				=> esc_html__( 'Show Event Tags', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event tags.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'off',
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
				  'toggle_slug'		=> 'decm_details',
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
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event excerpt.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
			  
			  'show_detail'=> array(
				  'label'				=> esc_html__( 'Show More Info Button', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event more info button.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
			  'show_add_calendar_button'=> array(
				'label'				=> esc_html__( 'Show Add To Calendar Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the add to calendar button and links.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_link',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',

				),
						'affects'         => array(
							'show_google_calendar',
							'show_outlook_link',
							'show_ical_export'
						),
						'display'=> array(
							'show_google_calendar'=>'on'
						)
			),
			  /* Elements from event calendar shortcode pluin */
			  'show_google_calendar'=> array(
				  'label'				=> esc_html__( 'Show Google Calendar Link', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'yes_no_button',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( "Choose to show or hide the link for adding the event to the the visitor's Google Calendar.", 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'calendar_link',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
					  'show_add_calendar_button'=>'on'
					  )
			  ),
			  'show_ical_export'=> array(
				  'label'				=> esc_html__( 'Show Apple Calendar Link', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'yes_no_button',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( "Choose to show or hide the link for adding the event to the the visitor's Apple Calendar.", 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'calendar_link',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
					  'show_add_calendar_button'=>'on'
				  )
			  ),
			  'show_outlook_link'=> array(
				'label'				=> esc_html__( 'Show Outlook Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( "Choose to show or hide the link for adding the event to the the visitor's Outlook calendar.", 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_link',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_add_calendar_button'=>'on'
				)
			),
			'googlemap'=> array(
				'label'				=> esc_html__( 'Show Google Map', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location map. Remember to have an active Google Maps API key entered in the Divi Theme Options.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'google_maps',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
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
				  'toggle_slug'		=> 'decm_details',
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
				  'toggle_slug'     => 'decm_details',
				  'default'			=> 'on',
				  'affects'         => array(
					  'show_icon_label',
					  'stack_label_icon',
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
				  'toggle_slug'     => 'decm_details',
				   'default' => 'none',
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
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				),
				'show_if_not' => array(
					'show_icon_label'=>'none',
					'show_data_one_line'=>'off',
				)
			),
			 

			  /* Content Options from Blog Module */
			  'event_count' => array(
				  'label'             => esc_html__( 'Events Count', 'decm-divi-event-calendar-module' ),
				  'type'              => 'hidden',
				  'option_category'   => 'configuration',
				  'description'       => esc_html__( 'Choose the total number of events to show in the feed. Remember, you can use pagination options as well for the website visitor to load more events.', 'decm-divi-event-calendar-module' ),
				  'computed_affects'   => array(
					  '__posts',
					  '__getEvents',
				  ),
				  'toggle_slug'       => 'decm_content',
				  'default'           => 1,
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),

			  'included_categories' => array(
				  'label'            => esc_html__( 'Included Categories', 'decm-divi-event-calendar-module' ),
				  'type'             => 'hidden',
				  'meta_categories'  => array(
					  'all'     => esc_html__( 'All Categories', 'decm-divi-event-calendar-module' ),
				  'current' => esc_html__( 'Current Category', 'decm-divi-event-calendar-module' ),
				  ),
				  
				  'option_category'  => 'configuration',
				  'renderer_options' => array(
					  'use_terms' => true,
					  'term_name' => 'tribe_events_cat',
				  ),
				  'description'      => esc_html__( 'Choose which event categories you would like to show in the feed.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'      => 'decm_content',
				  'computed_affects' => array(
					  '__posts',
					  '__getEvents',
  
				  ),
				  'show_if' => array(
					  'use_current_loop'=>'off',
				  )
			  ),

			  'render_Classes' => array(
				  'type'             => 'hidden',
				  'option_category'  => 'configuration',
				  'toggle_slug'      => 'decm_content',
				  'default'		   =>  $this->module_classname( 'decm_event_display' ),
			  ),
			 
			 
			  'google_api_key_customize' => array(
				'label'             => esc_html__( 'Google Maps API Key', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter your Google Maps API key. Please note that this is not necessary if you are using the default API key provided in The Events Calendar settings.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'google_maps',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => 'AIzaSyDNsicAsP6-VuGtAb1O9riI3oc_NOb7IOU',	
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
	
			'add_url' => array(
				'label'             => esc_html__( 'Add Custom Api key', 'decm-divi-event-calendar-module' ),
				'type'              => 'hidden',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_content',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => 'https://www.google.com/maps/embed/v1/place?key=',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
  
			  'excerpt_length' => array(
				  'label'             => esc_html__( 'Excerpt Length', 'decm-divi-event-calendar-module' ),
				  'type'              => 'hidden',
				  'option_category'   => 'configuration',
				  'description'       => esc_html__( 'If you are showing the event excerpt, this setting allows you to set a specific character limit for the text. The WordPress default is 270 characters.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'       => 'decm_content',
				  'default'           => '270',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
			  'blog_offset' => array(
				  'label'             => esc_html__( 'Events Offset Number', 'decm-divi-event-calendar-module' ),
				  'type'              => 'hidden',
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
			  'show_past'=> array(
				  'label'				=> esc_html__( 'Only Show Past Events', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to use the module to show an archive of past events instead of upcoming events.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_content',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  ),
				  'computed_affects'   => array(
					  '__getEvents',
				  ),
			  ),

			  'columns' => array(
				  'label'           => esc_html__( 'Columns', 'decm-divi-event-calendar-module' ),
				  'description'		=> esc_html__( 'Choose the number of columns you want to use to display your events. Note that the number of columns is sometimes dependent on the alignment options chosen.', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'layout',
				  'options'		=>[
					  '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
					  '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
					  '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
					  '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
				  ],
				  
				  'tab_slug'		  => 'advanced',
				  //'mobile_options'  => true,
				  'toggle_slug'     => 'event',
				  'computed_affects' => array(
					  '__posts',
					  '__getEvents',
				  ),
				   'default' => '1',
			  ),
			  
			  'image_align' => array(
				  'label'           => esc_html__( 'Alignment', 'decm-divi-event-calendar-module' ),
				  'description'		=> esc_html__( 'Choose the alignment of the event featured image and details. Note that the alignment is sometimes dependent on the number of columns chosen.', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'layout',
				  'options'		=>[
					  'leftimage_rightdetail'   => __( 'Image Left, Details Right',  'decm-divi-event-calendar-module' ),
					  'topimage_bottomdetail'   => __( 'Image Top,  Details  Bottom',  'decm-divi-event-calendar-module' ),
					  'rightimage_leftdetail'   => __( 'Image Right, Details Left',  'decm-divi-event-calendar-module' ),
					  //'centerimage_bottomdetail'   => __( 'Image Top Center, Details Bottom',  'decm-divi-event-calendar-module' ),
  
					  // 'blog_layout'   => __( 'Like blog posts', 'act-divi' ),
				  ],
				  'default'         => 'leftimage_rightdetail',
				  'tab_slug'		  => 'advanced',
				 // 'mobile_options'  => false,
				  'toggle_slug'     => 'event',
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
				  'type'              => 'hidden',
				  'custom_color'      => true,
				  'tab_slug'          => 'advanced',
				  'toggle_slug'       => 'event',
				  // 'hover'             => 'tabs',
				  'mobile_options'    => true,
			  ),
		
			  'details_link_color' => array(
				  'label'             => esc_html__( 'Details Link Color', 'decm-divi-event-calendar-module' ),
				  'description'       => esc_html__( 'Choose a color for the link text in the event details.', 'decm-divi-event-calendar-module' ),
				  'type'              => 'color-alpha',
				  'custom_color'      => true,
				  
				  'tab_slug'          => 'advanced',
				  'toggle_priority' => 12,
				  'toggle_slug'       => 'event',
				  'priority' => 20,
				  // 'hover'             => 'tabs',
				  'mobile_options'    => true,
			  ),
			  'past_event_message_background_color' => array(
				'label'             => esc_html__( 'Past Events Message Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the past events message.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'past_event_message',
				
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
		
			  'details_icon_color' => array(
				'label'             => esc_html__( 'Details Icon Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the icons in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'event',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'details_label_color' => array(
				'label'             => esc_html__( 'Details Label Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the label text in the event details.', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'detail_label',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			  
			  
			  'cards_spacing' => array(
				  'label'           => esc_html__( 'Event Margin', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
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
				  'type'            => 'hidden',
				  'option_category' => 'basic_option',
				  'description'     => esc_html__( 'Adjust the spacing around the inside of the individual events.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'     => 'event',
				  'tab_slug'		  => 'advanced',
				  'mobile_options'  => true,
				  'computed_affects' => array(
					  '__posts',
				  ),
  
			  ),
			  
			  'pass_event_message_margin' => array(
                'label'           => esc_html__( 'Past Events Message Margin', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the outside of the past events message.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'past_event_message',
				'tab_slug'		  => 'advanced',
				'mobile_options'    => true,
                'computed_affects' => array(
                    '__posts',
                ),

            ),
			
            'pass_event_message_padding' => array(
                'label'           => esc_html__( 'Past Events Message Padding', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the inside of the past events message.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'past_event_message',
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
				  'computed_callback' => array( 'DIEC_EventPage', 'get_blog_posts_events' ),
				  'computed_depends_on'  => array(
					  'event_count',
					  'date_format',
					  'time_format',
					  'show_name',
					  'enable_organizer_link',
					  'enable_venue_link',
					  'show_past',
					  'blog_offset',
					  'included_categories',
					  'organizer_email_linkable',
					  'website_link',
					  'custom_website_link_text',
					  'custom_website_link_target',
					  'enable_category_link',
					  //'google_api_key_customize',
					  
					  //'header_level',
					  
  
				  ),
			  ),
  
			  //Extra Design settings
			  'view_more_text' => array(
				  'label'           => esc_html__( 'More Info Button Text', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'basic_option',
				  'description'     => esc_html__( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'     => 'decm_details',
				  'default'         => 'More Info',
				  'dynamic_content'  => 'text',
				  'mobile_options'   => true,
				  'hover'            => 'tabs',
				  'computed_affects' => array(
					  '__posts',
				  ),
  
			  ),
			  'view_more_icons_list' => array(
				  'label'           => esc_html__( 'Button Text', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'basic_option',
				  'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'     => 'decm_details',
				  'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			  ),
			  'align' => array(
				  'label'           => esc_html__( 'Image Alignment', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'layout',
				  'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				  'default_on_front' => 'left',
				  'tab_slug'        => 'advanced',
				  'toggle_slug'     => 'event',
				  'description'     => esc_html__( 'Choose to align the event featured image to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				  'options_icon'    => 'module_align',
				  //'mobile_options'  => true,
			  ),
			  'thumbnail_margin' => array(
				  'label' => __('Image Margin', 'decm-divi-event-calendar-module'),
				  'type' => 'hidden',
				  'description' => __('Adjust the spacing around the outside of the event featured image.', 'decm-divi-event-calendar-module'),
				  'tab_slug'        => 'advanced',
				  'toggle_slug' => 'event',
				  'mobile_options'  => true,
			  ),
			  'thumbnail_padding' => array(
				  'label' => __('Image Padding', 'decm-divi-event-calendar-module'),
				  'type' => 'hidden',
				  'description' => __('Adjust the spacing around the inside of the event featured image.', 'decm-divi-event-calendar-module'),
				  'tab_slug'        => 'advanced',
				  'toggle_slug' => 'event',
				  'mobile_options'  => true,
			  ),
			  'thumbnail_width' => array(
				  'label'           => esc_html__( 'Image Width', 'decm-divi-event-calendar-module' ),
				  'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				  'type'            => 'hidden',
				  'option_category' => 'layout',
				  'tab_slug'        => 'advanced',
				  'toggle_slug'     => 'event',
				  'validate_unit'   => true,
				  'depends_show_if' => 'off',
				  'default_unit'    => 'px',
				  'default'         => '800',
				  'allow_empty'     => true,
				  'responsive'      => true,
				  'mobile_options'  => true,
				  
			  ),

			  'button_align'=> array(
				  'label'				=> esc_html__( 'Align To Bottom', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'view_more',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to align the button to the bottom.', 'decm-divi-event-calendar-module' ),
				  'tab_slug'		  => 'advanced',
				 // 'mobile_options'  => true,
				  'toggle_slug'     => 'event',
				  'default'			=> 'off',
				  
				  'computed_affects'   => array(
					  '__getEvents',
				  ),
			  ),

			//   ),
			  'add_to_calendar_text' => array(
				'label'           => __( 'Add To Calendar Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Add To Calendar', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_link',
			),
			'add_to_calendar_icons_list' => array(
				'label'           => esc_html__( 'Add To Calendar Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'calendar_link',
				'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			),
			  'google_calendar_text' => array(
				  'label'           => __( 'Google Calendar Link Text', 'decm-divi-event-calendar-module' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'default'         => __( 'Google Calendar', 'decm-divi-event-calendar-module' ),
			  
				  'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				  'tab_slug'        => 'general',
				  'toggle_slug'     => 'calendar_link',
			  ),
			  'ical_text' => array(
				  'label'           => __( 'Apple Calendar Link Text', 'decm-divi-event-calendar-module' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'default'         => __( 'Apple Calendar', 'decm-divi-event-calendar-module' ),
			  
				  'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				  'tab_slug'        => 'general',
				  'toggle_slug'     => 'calendar_link',
			  ),
			  'outlook_link_text' => array(
				'label'           => __( 'Outlook Calendar Link Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Outlook', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_link',
			),

			'use_grayscale_filter'      => array(
				'label'            => esc_html__( 'Use Grayscale Filter', 'et_builder' ),
				'description'      => esc_html__( 'Apply a grayscale filter to change the event location map to black and white.', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'affects'          => array(
					'grayscale_filter_amount',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'child_filters_map',
				'default_on_front' => 'off',
			),
			'grayscale_filter_amount'   => array(
				'label'           => esc_html__( 'Grayscale Filter Amount (%)', 'et_builder' ),
				'description'     => esc_html__( 'Adjust the grayscale filter to change the color saturation of the event location map.', 'et_builder' ),
				'type'            => 'range',
				'default'         => '0',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'child_filters_map',
				'depends_show_if' => 'on',
				'unitless'        => false,
				//'mobile_options'  => true,
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
				'description'		=> esc_html__( 'Choose whether the custom single event page link opens in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
				],
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
			),
			'enable_organizer_link'=> array(
				'label'				=> esc_html__( 'Enable Organizer Links', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the organizers to link to their own archive pages.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					//'use_shortcode'=>'off',
					'show_name'=>"on",
				)
			),
			
			'enable_venue_link'=> array(
				'label'				=> esc_html__( 'Enable Venue Links', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the venues to link to their own archive pages.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					// 'use_shortcode'=>'off',
					'show_venue'=>"on",
				)
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
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_category'=>"on",
				)
			),
			'organizer_email_linkable'=> array(
				'label'				=> esc_html__( 'Enable Email Address Links', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the email addresses to link to their mailto URL.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'organizer_email'=>'on',
				)
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
		//   echo '<pre>';
		//   print_r($this->props);
		//   exit;
		  $atts = array();
		  $use_shortcode = $this->props['use_shortcode'];
		  $shortcode_param = $this->props['shortcode_param'];
		  $show_feature_image = $this->props['show_feature_image'];
		  $show_title = $this->props['show_title'];
		  $show_name = $this->props['show_name'];
		  $enable_organizer_link = $this->props['enable_organizer_link'];
		  $show_price = $this->props['show_price'];
		  $show_weburl = $this->props['show_weburl'];	
		   $show_date = $this->props['show_date'];
		  $show_time = $this->props['show_time'];
		  $show_end_time = $this->props['show_end_time'];
		  $show_timezone = $this->props['show_timezone'];
		  $googlemap      = $this->props['googlemap'];
		  $description    = $this->props['description'];
		  $show_venue = $this->props['show_venue'];
		  $enable_venue_link = $this->props['enable_venue_link'];
		  $google_link = $this->props['google_link'];
		  $venue_phone = $this->props['venue_phone'];
		  $venue_weburl = $this->props['venue_weburl'];
		  $show_location = $this->props['show_location'];

		  $show_street = $this->props['show_street'];
		  $show_locality = $this->props['show_locality'];
		  $show_postal = $this->props['show_postal'];
		  $show_country = $this->props['show_country'];
		  $organizer_phone = $this->props['organizer_phone'];
		  $organizer_email = $this->props['organizer_email'];
		  $organizer_email_linkable = $this->props['organizer_email_linkable'];
		  $organizer_weburl = $this->props['organizer_weburl'];
		  $show_excerpt = $this->props['show_excerpt'];
		  $show_category = $this->props['show_category'];
		  $enable_category_link= $this->props['enable_category_link'];
		  $event_tag = $this->props['event_tag'];
		  $show_add_calendar_button = $this->props['show_add_calendar_button'];
		  $show_ical_export=$this->props['show_ical_export'];
		  $show_google_calendar=$this->props['show_google_calendar'];
		  $show_outlook_link= $this->props['show_outlook_link'];
		  $show_detail = $this->props['show_detail'];
		  $google_api_key_customize = $this->props['google_api_key_customize'];
		  $add_url =$this->props['add_url'];
		  $website_link = $this->props['website_link'];
		  $custom_website_link_text = $this->props['custom_website_link_text'];
		  $custom_website_link_target = $this->props['custom_website_link_target'];
		  $past_event_message_background_color=$this->props['past_event_message_background_color'];
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
		  $show_data_one_line = $this->props['show_data_one_line'];
		  
		  $event_count = $this->props['event_count'];
		  $included_categories = $this->props['included_categories'];
		  $date_format = $this->props['date_format'];
		  $time_format = $this->props['time_format'];
		  //'time_format',
		  $excerpt_length = $this->props['excerpt_length'];
		  $blog_offset = $this->props['blog_offset'];
		  // $layout = $this->props['layout'];
		  $layout = '';
		  //$columns_phone = $this->props['columns_phone'];
		  $columns_tablet = '';
		  $Column_Type = $this->props['columns'] == '' ? 1 : $this->props['columns'];
		  $image_align = $this->props['image_align'];
		  $button_align = $this->props['button_align'];
		  $cards_spacing = $this->props['cards_spacing'];
		  $event_inner_spacing = $this->props['event_inner_spacing'];
		  $view_more_text = $this->props['view_more_text'];
		 // $ajax_load_more_text = $this->props['ajax_load_more_text'];
		  $add_to_calendar_text =$this->props['add_to_calendar_text'];
		  $ical_text = $this->props['ical_text'];
		  $google_calendar_text = $this->props['google_calendar_text'];
		  $outlook_link_text= $this->props['outlook_link_text'];
		 // $show_pagination = $this->props['show_pagination'];
		  $background_color                = $this->props['background_color'];
		  $show_preposition = $this->props['show_preposition'];
		  $use_current_loop = $this->props['use_current_loop'] ;
		//  $pagination_type  = $this->props['pagination_type'];
		  $align            = $this->props['align'];
		  $show_icon_label = $this->props['show_icon_label'];
		  $stack_label_icon = $this->props[ 'stack_label_icon'];
		  $use_grayscale_filter = $this->props['use_grayscale_filter'];
		  $grayscale_filter_amount= $this->props['grayscale_filter_amount'];
		  $Show_description_placeholder = $this->props['Show_description_placeholder'];
	
		//  $custom_icon_add_calendar_values              = et_pb_responsive_options()->get_property_values( $this->props, 'add_to_calendar_button_icon' );
		  $custom_icon_add_calendar_array  =  $this->props['add_to_calendar_button_icon'] != "" ? $this->props['add_to_calendar_button_icon'] : '';
		  $custom_icon_add_calendar_phone_array  =  $this->props['add_to_calendar_button_icon_phone'] != "" ? $this->props['add_to_calendar_button_icon_phone'] : '';
		  $custom_icon_add_calendar_tablet_array  =  $this->props['add_to_calendar_button_icon_tablet'] != "" ? $this->props['add_to_calendar_button_icon_tablet'] : '';
		  $custom_icon_add_calendar = explode("|",$custom_icon_add_calendar_array);
		  $custom_icon_add_calendar_phone = explode("|",$custom_icon_add_calendar_phone_array);
		  $custom_icon_add_calendar_tablet = explode("|",$custom_icon_add_calendar_tablet_array);
		 
		//   $custom_icon_add_calendar_tablet              = isset( $custom_icon_add_calendar_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_add_calendar_values['tablet'] ) ) : '';
		//   $custom_icon_add_calendar_phone               = isset( $custom_icon_add_calendar_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_add_calendar_values['phone'] ) ) : '';
		//   $custom_icon_add_calendar_values              = et_pb_responsive_options()->get_property_values( $this->props, 'add_to_calendar_button_icon' );
  
		  $background_layout               = '';
		  $background_layout_hover         = et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
		  $background_layout_hover_enabled = et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
		  $use_background_color            = $this->props['use_background_color'];
		  $module_class = $this->module_classname( $render_slug );
		  $video_background = $this->video_background();
		  $parallax_image_background = $this->get_parallax_image_background();
		  
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
            'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a,%%order_class%% .ecs-venue-google-link a,%%order_class%% .ecs-organizer-weburl a,%%order_class%% .ecs-event-tag a,%%order_class%% .ecs-venue-weburl a,%%order_class%% .ecs-organizer-email a,%%order_class%% .ecs-venue a",
            'declaration' => "color: {$details_link_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a,%%order_class%% .ecs-venue-google-link a,%%order_class%% .ecs-organizer-weburl a,%%order_class%% .ecs-event-tag a,%%order_class%% .ecs-venue-weburl a",
            'declaration' => "color: {$details_link_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a,%%order_class%% .ecs-venue-google-link a,%%order_class%% .ecs-organizer-weburl a,%%order_class%% .ecs-event-tag a,%%order_class%% .ecs-venue-weburl a",
            'declaration' => "color: {$details_link_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before",
            'declaration' => "color: {$details_icon_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before",
            'declaration' => "color: {$details_icon_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before",
            'declaration' => "color: {$details_icon_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);


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
		  if ( 'on' === $use_grayscale_filter ) {
		  if ( '' !== $grayscale_filter_amount ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .ecs_google_map",
				'declaration' =>'filter: grayscale('.$grayscale_filter_amount.'%);',
					
			) );
		}}
		if ( '' !== $past_event_message_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% div.tribe-events-notices',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $past_event_message_background_color)
				),
			) );
		}
  
  
		  //Margin & Padding
		$this->apply_custom_margin_padding($render_slug, 'pass_event_message_margin', 'margin', 
		"%%order_class%% div.event_passed_notice");
		$this->apply_custom_margin_padding($render_slug, 'pass_event_message_padding', 'padding', 
		"%%order_class%% div.tribe-events-notices");
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_margin', 'margin', 
		'%%order_class%% img.wp-post-image');
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_padding', 'padding', 
		'%%order_class%% img.wp-post-image', false);
		$this->apply_custom_width($render_slug, 'thumbnail_width', 'width', 
		'%%order_class%% img.wp-post-image');
		$this->apply_custom_margin_padding($render_slug, 'event_inner_spacing', 'padding', 
		" {$this->main_css_element} .ecs-event-list  .ecs-event .act-post .row");
  
		  
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
			  
			  
			  $contentorder = 'title, title2,show_past_notification,description, date, venue, location, google_link, venue_phone, venue_weburl, organizer, organizer_phone, organizer_email, organizer_weburl, event_tag, price,categories, excerpt,weburl,addcalendarbutton,showcalendar,showical,showoutlook,googlemap,showdetail';
			  if($image_align == 'rightimage_leftdetail')
			  $contentorder .= ',thumbnail';
			  else
			  $contentorder = 'thumbnail,'.$contentorder;
			  
			  $attr = array(
				  'cat' => $included_categories,
				  'month' => '',
				  'limit' => $event_count,
				  'eventdetails' => $show_date == 'on' ? 'true' : 'false',
				  'showtime' => $show_time == 'on' ? 'true' : 'false',
				  'show_end_time'=>$show_end_time == 'on'?'true':'false',
				  'show_timezone' =>$show_timezone == 'on' ? 'true' : 'false',
				  //'show_pagination'=>$show_pagination == 'on' ? 'true' : 'false',
				  'showtitle' => $show_title == 'on' ? 'true' : 'false',
				  'googlemap' => ($googlemap == 'on' ? 'true' : 'false'),
				  'description' => ($description == 'on' ? 'true' : 'false'),
				  'time' => null,
				  'past' => ($show_past === 'on' ? 'yes' : ''),
				  'venue' => ($show_venue === 'on' ? 'true' : 'false'),
				  'enable_venue_link'=>($enable_venue_link == 'on' ? 'true':'false'),
				  'google_link'=> ($google_link === 'on' ? 'true' : 'false'),
				  'venue_phone'=> ($venue_phone === 'on' ? 'true' : 'false'),
				  'venue_weburl'=> ($venue_weburl === 'on' ? 'true' : 'false'),
				  'location' => ($show_location === 'on' ? 'true' : 'false'),

				  'street' => ($show_street === 'on' ? 'true' : 'false'),
				  'locality' => ($show_locality === 'on' ? 'true' : 'false'),
				  'postal' => ($show_postal === 'on' ? 'true' : 'false'),
				  'country' => ($show_country === 'on' ? 'true' : 'false'),
				  'organizer' => $show_name == 'on' ? 'true' : 'false',
				  'enable_organizer_link'=>($enable_organizer_link == 'on' ? 'true':'false'),
				  'organizer_phone'=> ($organizer_phone === 'on' ? 'true' : 'false'),
				  'organizer_email'=> ($organizer_email === 'on' ? 'true' : 'false'),
				  'organizer_email_linkable'=>($organizer_email_linkable === 'on'? 'true':'false'),
				  'organizer_weburl'=> ($organizer_weburl === 'on' ? 'true' : 'false'),
				  'price' => $show_price == 'on' ? 'true' : 'false',
				  'weburl' => $show_weburl == 'on' ? 'true' : 'false',
				  'website_link'=> $website_link,
				  'custom_website_link_text'=>$custom_website_link_text,
				  'custom_website_link_target'=>$custom_website_link_target,
				  'categories' => $show_category == 'on' ? 'true' : 'false',
				  'enable_category_link'=>($enable_category_link=="on"?'true':'false'),
				  'event_tag' =>($event_tag === 'on' ? 'true' : 'false'),
				  'button_align' => ($button_align === 'on' ? 'true' : 'false'),
				  'show_data_one_line' => ($show_data_one_line== 'on' ? 'true' : 'false'),
				  'stack_label_icon' => ($stack_label_icon=='on'? 'true':'false'), 
				  'show_preposition' => ($show_preposition== 'on' ? 'true' : 'false'),
				  'show_add_calendar_button' =>($show_add_calendar_button== 'on'?'true':'false'),
				  'show_ical_export'=>($show_ical_export == 'on'?'true':'false'),
				  'show_google_calendar'=>($show_google_calendar=='on'?'true':'false'),
				  'show_outlook_link'=>($show_outlook_link=='on'?'true':'false'),
				  'schema' => 'true',
				  'message' => 'This event has passed.',
				  'key' => 'End Date',
				  'order' => 'ASC',
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
				  'layout' => $layout,
				  'columns' => $Column_Type,
				  'cards_spacing' => $cards_spacing,
				  'image_align' => $image_align,
				  'button_align'=>$button_align,
				  'event_inner_spacing' => $event_inner_spacing,
				  'view_more_text' => $view_more_text,
				 // 'ajax_load_more_text'=>$ajax_load_more_text,
				  'add_to_calendar_text'=> $add_to_calendar_text,
				  'google_calendar_text'=>$google_calendar_text,
				  'ical_text'          =>$ical_text,
				  'outlook_link_text' => $outlook_link_text,
				  'open_toggle_background_color' => $open_toggle_background_color,
				  'details_link_color' =>  $details_link_color,
				  'details_icon_color' =>  $details_icon_color,
				  'details_label_color' =>  $details_label_color,
				  'grayscale_filter_amount' =>$grayscale_filter_amount,
				  'use_grayscale_filter'=>($use_grayscale_filter=='on'?'true':'false'),
				  'included_categories' => $included_categories,
				  'use_current_loop' => ($use_current_loop === 'on' ? 'true' : 'false'),
				  //'custom_icon' => $custom_icon,
				  'add_to_calendar_button_icon'=>$custom_icon_add_calendar[0],
				  'add_to_calendar_button_icon_tablet'=>$custom_icon_add_calendar_tablet[0],
				  'add_to_calendar_button_icon_phone'=>$custom_icon_add_calendar_phone[0],
				 // 'add_to_calendar_button_icon_font_weight'=>$custom_icon_add_calendar[4],

				   'custom_add_to_calendar_button' => $this->props['custom_add_to_calendar_button'],
	
				  'align'           => $align,
				  'show_icon_label'=>$show_icon_label,

				  'google_api_key_customize' =>$google_api_key_customize,
				  'add_url' => $add_url,

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
  // print_r($agentBrowser);
  // exit;
		  if(strlen(strstr($agentBrowser,"safari")) > 0 ){      
			  $customCss .= '.row_equal{display:flexbox}';
		  }
  
		  if(strlen(strstr($agentBrowser,"chrome")) > 0){      
		  
			  $customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
		  }
		  if(strlen(strstr($agentBrowser,"firefox")) > 0){      
		  
			  $customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
		  }
		  $discard_passed_notice ='';
		  $discard_passed_notice='jQuery(\'.event_passed_notice:not(:first)\').remove()';
		  $Addlinebreak =  ' ';
		  $AddButtonBottom =  '';
		  //jQuery('.oneofthetwodivs').eq(1).remove();
		  if($button_align == 'on')
		  {
			  if($Column_Type == 4)
			  $AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"89.5%" });';
			  else if($Column_Type == 3)
			  $AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"92%" });';
			  else
			  $AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"94.7%" });';
		  }
		  $customCss.='</style>';
		  $AddCustomHeight = '';
		  if(($Column_Type == '2' || $Column_Type == 1) &&  $image_align != 'topimage_bottomdetail' && $image_align != 'centerimage_bottomdetail')
		  {
			  if($image_align == 'leftimage_rightdetail')
			  $AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',"100%");';
			  else
			  $AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').css(\'height\',"100%");';
		  }
		  else
		  {
			  if($show_feature_image == 'on')
			  {
				  $AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';		
			  }
			  else 
			  {
				  $AddCustomHeight = 'var tempHeight = parseInt(column_height);jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';		
			  }
		  }
  
		  // print_r($pagination_type);
		  // exit;
  
			

		  return sprintf( '
				  %9$s<div%2$s class="%4$s %5$s">
					  %6$s
					  %7$s
					  <div class= "">
						  %1$s
					  </div>
					  </div>
					 
				  <script>
				  jQuery(document).ready(function(){
				  jQuery(\''.$renderClassName.' .diec_add_to_calendar\').click(function() { 
					event.preventDefault();
					jQuery(\''.$renderClassName.' .ecs-show_calendar\').css("display","inline");
					jQuery(\''.$renderClassName.' .ecs-showical-export\').css("display","inline");
					jQuery(\''.$renderClassName.' .ecs-showoutlook-link\').css("display","inline");
				});
				  '.$discard_passed_notice.'	  
				  var setHeightColumns = function(){ 
					var column_loop_row = 0;
					var column_height = 0;
					var ids = [];
					var total_Count = 0;
					var total_Events = jQuery(\'%13$s .ecs-event-posts\').length; 
					jQuery(\'%13$s .ecs-event-posts\').each(function(){
					++column_loop_row;
					++total_Count;
					var Event_id = jQuery(this).children(\'article\')[0].id;
					ids.push(Event_id);
					column_height = jQuery(this).find(\'#\'+Event_id).children(\'.row\').height() >= column_height ? jQuery(this).find(\'#\'+Event_id).children(\'.row\').height() : column_height;

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
				setTimeout(5000);
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
			  
			  
			  
			  , $this->ecs_fetch_events( $attr)
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
			  ,$discard_passed_notice
		  );
	  }
  
  
  
	  /**
	   * Fetch and return required events.
	   * @param  array $atts 	shortcode attributes
	   * @return string 	shortcode output
	   */
  
	  
		  public function ecs_fetch_events( $atts, $conditional_tags = array(), $current_page = array() ) {
			  global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
			  $post_type = get_post_type();

		  /**
		   * Check if events calendar plugin method exists
		   */
		  if ( !function_exists( 'tribe_get_events' ) ) {
			  return '\'The Events Calendar\' plugin should exist';
		  }
  
		  $output = '';
	  
  $custom_icon='';
  $custom_icon_load='';
		  $atts = shortcode_atts( apply_filters( 'ecs_shortcode_atts', array(
			  'show_data_one_line'=> 'false',
			  'cat' => '',
			  'month' => '',
			  'limit' => 5,
			  'stack_label_icon' => 'true',
			  'eventdetails' => 'true',
			  'showtime' => 'true',
			  'show_end_time'=> 'true',
			  'show_timezone' => 'true',
			  'showtitle' => 'true',
			  //'show_pagination'=>'true',
			  'show_add_calendar_button'=>'true',
			  'show_ical_export'=>'true',
			  'show_google_calendar'=>'true',
			  'show_outlook_link'=>'true',
			  'googlemap'=>'true',
			  'description'=>'true',
			  'time' => null,
			  'past' => '',
			  'venue' => 'false',
			  'enable_venue_link'=>'true',
			  'google_link'=>'false',
			  'venue_phone'=>'false',
			  'venue_weburl'=>'false',
			  'location' => 'false',
			 
			  'street' => 'false',
			  'locality' => 'false',
			  'postal' => 'false',
			  'country' => 'false',
			  'organizer' => null,
			  'enable_organizer_link'=>'true',
			  'organizer_phone'=>'false',
			  'organizer_email'=>'false',
			  'organizer_email_linkable'=>'false',
			  'organizer_weburl'=>'false',
			  'price' => null,
			  'weburl' => null,
			  'website_link'=>'',
			  'custom_website_link_text'=>'',
			  'custom_website_link_target'=>'',
			  'categories' => 'false',
			  'enable_category_link'=>'true',
			  'event_tag' =>'false',
			  'schema' => 'true',
			  'message' => 'There are no upcoming %s at this time.',
			  'key' => 'End Date',
			  'order' => 'ASC',
			  'orderby' => 'startdate',
			  'viewall' => 'false',
			  'excerpt' => 'false',
			  'showdetail' => 'false',
			  'thumb' => 'false',
			  'thumbsize' => '',
			  'thumbwidth' => '800',
			  'thumbheight' => '800',
			  'contentorder' => apply_filters( 'ecs_default_contentorder', ' thumbnail,title, title2,show_past_notification,description, date, venue, location, google_link, venue_phone, venue_weburl, organizer, organizer_phone, organizer_email, organizer_weburl, event_tag, price, categories, excerpt,weburl,googlemap, showdetail', $atts ),
			  'event_tax' => '',
			  'dateformat' => '',
			  'timeformat' => '',
			  'layout' => '',
			  'columns' => '',
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
			  'grayscale_filter_amount'=>'',
			  'use_grayscale_filter'=>'true',
			  'columns_phone' => '',
			  'columns_tablet' => '',
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
			  'add_to_calendar_button_icon'=>'',
			  'add_to_calendar_button_icon_tablet'=>'',
			  'add_to_calendar_button_icon_phone'=>'',
			  'add_to_calendar_button_icon_font_weight'=>'',
			  'custom_add_to_calendar_button'=>'',

			  'add_to_calendar_text'=>"Add To Calendar",
			  'google_calendar_text'=>"Google Calendar",
			  'ical_text' =>"+ Ical Export",
			  'outlook_link_text'=>" Outlook",
			//  'pagination_type'=> '',
			  'align'     => '',
			  'show_icon_label'=>'',
			  'google_api_key_customize'=>'',
			  'add_url'=>'',
			  
  
		  ), $atts ), $atts, 'ecs-list-events' );
  
	  
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
  
		  if ( $atts['time'] == 'past' || !empty( $atts['past'] ) ) {
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
  
  
  
		  if($atts['past']== 'yes'){
			  $atts['order']="DESC";
		  }
		  else{
			  $atts['order']="ASC";
		  }
  
		  $atts = apply_filters( 'ecs_atts_pre_query', $atts );
		  
  
		  $cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
		  $categslug =$cat_slug->slug;
		  $categId = $cat_slug->term_id;
  
  
		  $event_id = get_the_ID();
  
		  $args = apply_filters( 'ecs_get_events_args', array(
			//   'post_status' => 'publish',
			'post_status' => is_user_logged_in()?array( 'publish', 'private'):'publish',
			  'posts_per_page' => $atts['limit'],
			  'tax_query'=> $atts['event_tax'],
			  'order' => $atts['order'],
			  'offset' => $atts['blog_offset'],
			  'start_date'   => '1900-10-01 00:01',
			  'end_date'     => '3030-10-31 23:59',
			  'included_categories' => $atts['included_categories'],
			  
		  ), $atts );
		  

  
		  if($atts['use_current_loop'] == "true"){	
  
		  if($post_type == 'tribe_events'){
			  $args['ID'] = $event_id;
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
		  }
	  }
	//   	echo '<pre>';
	//    print_r(tribe_get_organizer_object($event_post->ID));
	//    exit;
	  $max_page_find_args = $args;
	  if($atts['limit'] > 0){
		  $max_page_find_args['posts_per_page'] = -1;
		  $max_pages = ceil(count(tribe_get_events( $max_page_find_args ))/$atts['limit']);
	  }
	//   echo '<pre>';
	//   print_r($wp_query);
		  $event_posts = tribe_get_events( $args );
		 // echo '<pre>';
		 //  print_r(tribe_get_event_meta( $event_post,'_CostDescription',true));
		  $event_posts = apply_filters( 'ecs_filter_events_after_get', $event_posts, $atts );
  
  
  
		  if ( $event_posts or apply_filters( 'ecs_always_show', false, $atts ) ) {
				  
			  $output = apply_filters( 'ecs_beginning_output', $output, $event_posts, $atts );
  
					  $cardoverStyle = '';
					  $excerptLength = '';
					  
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
  

					  
			  $output .= apply_filters( 'ecs_start_tag', '<div class=" append_events row_equal row ecs-event-list"' . 
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
				  $featured_class = ( get_post_meta( $event_post->ID , '_tribe_featured', true ) ? ' ecs-featured-event' : '' );
				  if ( is_array( $category_list ) ) {
					  foreach ( (array) $category_list as $category ) {
						  $category_slugs[] = ' ' . $category->slug . '_ecs_category';
						  /**
						   * Show Categories of every events
						   *
						   * @author bojana
						   */
						  $category_names[] =$atts['enable_category_link']=="true"?'<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>':$category->name;
					  }
				  }
				  // style="'.$eventInnerStyle.'"
  
				  $event_output .= apply_filters( 'ecs_event_start_tag', '<div class=" '.$columns_desktop.' '.$columns_tablet.' '.$columns_phone.' ecs-event ecs-event-posts clearfix' . implode( '', $category_slugs ) . $featured_class . apply_filters( 'ecs_event_classes', '', $atts, $post ) . '" style="'.$cardInnerStyletop.'" "><article id="event_article_'.$event_post->ID.'" class="act-post et_pb_with_border"  style="'.$cardoverStyle.''.$cardInnerStyle.'" " ><div class="row" style="" > ', $atts, $post );
				  
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
				 $dateTimeSeparator=tribe_get_option( 'dateTimeSeparator', ' @ ' );
				 $timeRangeSeparator=tribe_get_option( 'timeRangeSeparator', ' - ' );
				 $timeRangeSeparatorEnd=$atts['show_end_time']=="true"?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";	
			   $start_time='';
			   $end_time ='';
			   $set_timezone='';
			   $set_timezone=$atts['show_timezone']=='true'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):"";
			   $start_time=$atts['timeformat']==''? tribe_get_start_time($event_post->ID,get_option( 'time_format' )):tribe_get_start_time($event_post->ID,$atts['timeformat']);  
			   $end_time=$atts['timeformat']==''? tribe_get_end_time($event_post->ID,get_option( 'time_format' )):tribe_get_end_time($event_post->ID,$atts['timeformat']);
			   $end_time=$atts['show_end_time']=="true"?$end_time.$set_timezone:$set_timezone;
			   $start_date='';
			   $end_date ='';
			   
			  $start_date= $atts['dateformat']==""? tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' )):tribe_get_start_date( $event_post->ID,null,$atts['dateformat']);
			  $end_date=$atts['dateformat']==""?$timeRangeSeparator. tribe_get_end_date($event_post->ID,null, get_option( 'date_format' )):$timeRangeSeparator.tribe_get_end_date( $event_post->ID,null,$atts['dateformat']);  
			  
 
			  $showicondate ="";
			  $showicontime="";
			  $showicon="";
			  $showlabel="";
			  $showlabeldate="";
			  $showlabeltime="";
			  //print_r(tribe_get_zip($event_post->ID)==null?"kk":"ll");
			  $street=$atts['street']=="true" && $atts['location']=="true" && tribe_get_address($event_post->ID)!=null?tribe_get_address($event_post->ID):"";
			  $locality=$atts['locality']=="true" && $atts['location']=="true" && tribe_get_city($event_post->ID)!=null?" ".tribe_get_city($event_post->ID).",":""; 
			  $postal=$atts['postal']=="true"&& $atts['location']=="true" &&  tribe_get_zip($event_post->ID)!=null?" ".tribe_get_zip($event_post->ID):""; 
			  $country=$atts['country']=="true" && $atts['location']=="true" && tribe_get_country($event_post->ID)!=null?" ".tribe_get_country($event_post->ID):""; 

			  $showlabeltime=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']=="label")  && $atts['show_data_one_line'] == 'true' && !is_null(tribe_get_start_time($event_post->ID))?'<span class=ecs-detail-label>'.__('Time','decm-divi-event-calendar-module')." </span>":"";
			  $showlabeldate=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']=="label") && $atts['show_data_one_line'] == 'true'?'<span class=ecs-detail-label>'.__('Date','decm-divi-event-calendar-module')." </span>":"";
			  $showicontime=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']=="icon") && $atts['show_data_one_line'] == 'true' && !is_null(tribe_get_start_time($event_post->ID))?"eventTime-ecs-icon":"";
			  $showicondate=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']=="icon") && $atts['show_data_one_line'] == 'true'?"eventDate-ecs-icon":"";
			  $stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
			  $custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];
			  $link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_event_website_link($event_post->ID), $result);
			  $result =  isset($result['href'][0]) ? sanitize_text_field( wp_unslash($result['href'][0]) ) : sanitize_text_field( wp_unslash("") );
			  $organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;
//  print_r($atts['website_link']);
 //exit;
$get_end_time_offset=Tribe__Events__Timezones::event_end_timestamp( $event_post->ID);

$get_current_time_offset=strtotime( gmdate('Y-m-d H:i:s')) + get_option( 'gmt_offset' ) * 3600 ;


if($get_end_time_offset < $get_current_time_offset) {
	?>
	<script>
	document.addEventListener("DOMContentLoaded", function(){
		jQuery(".append_events").addClass("ecs-is_past_event"); 
});
	</script>
	<?php

	if($this->props['passed_event_notice'] == 'on'){
		$event_output .= apply_filters( 'ecs_no_events_found_message','<div class="event_passed_notice"><div class="tribe-events-notices">'.sprintf(esc_html__('This event has passed.' , 'decm-divi-event-calendar-module' ).'</div></div>'), $atts );
	}
}

			  if ( !empty( $atts['dateformat'] ) ) {
  
				  $showdate=setDateFormat($atts['dateformat']);
				  
			  }
			  else{
				  $showdate= get_option('date_format');
			  }
				  foreach ( apply_filters( 'ecs_event_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					  
					  switch ( trim( $contentorder ) ) {
						  
						  case 'title':
							  if ( self::isValid( $atts['showtitle'] ) ) {
							  $event_output .= '<div class="col-md-'.(($atts['columns'] > 2 ? '12' : $atts['image_align'] == 'topimage_bottomdetail' || $atts['image_align'] == 'centerimage_bottomdetail' || $atts['thumb'] == 'false') ? '12' : '8').'">'.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							  }	
							  else{
								  $event_output .= '<div class="col-md-'.(($atts['columns'] > 2 ? '12' : $atts['image_align'] == 'topimage_bottomdetail' || $atts['image_align'] == 'centerimage_bottomdetail' || $atts['thumb'] == 'false') ? '12' : '8').'">';
							  }
						  break;
						  
						  case 'title2':
							  $event_output .= apply_filters( 'ecs_event_title_tag_start', '<h4 class="entry-title title2 summary">', $atts, $event_post ) .
											  apply_filters( 'ecs_event_list_title_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $event_post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .
										 apply_filters( 'ecs_event_title_tag_end', '</h4>', $atts, $event_post );
							  break;
							  case 'description':
								$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['description'])) {
								$event_output .= apply_filters( 'ecs_event_title_tag_start', '<div class="ecs-event-description">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_title_link_start',preg_replace('/\[\/?et_pb.*?\]/', '',tribe_get_the_content($event_post->ID,$strip_teaser = true)), $atts, $event_post ) .
										   apply_filters( 'ecs_event_title_tag_end', '</div>', $atts, $event_post );
								}
								
								break;

								
						  /**
						   * Show Author Name of every events
						   *
						   * @author bojana
						   */

						case 'organizer':
							if ( self::isValid( $atts['organizer'] ) ) {
								if(tribe_get_organizer($event_post->ID) != null){
									
							  //	do_action( 'tribe_events_single_meta_organizer_section_start' );
							  $organizer_ids = tribe_get_organizer_ids($event_post->ID);
							  $multiple = count( $organizer_ids ) > 1;
								  foreach ( $organizer_ids as $organizer ) {
									  if ( ! $organizer ) {
										  continue;
									  }
									  $enable_organizer_link =$atts['enable_organizer_link']=="true"?tribe_get_organizer($organizer):tribe_get_organizer($organizer);
			$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"organizer-ecs-icon":"";
									$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Organizer','decm-divi-event-calendar-module')." </span>":"";
						            $stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$event_output .= apply_filters( 'ecs_event_organizer_tag_start', '<span class="'.$classShowDataOneLine.' ecs-organizer '.$showicon.'">', $atts, $event_post ) .
											   apply_filters( 'ecs_event_organizer',($atts['show_preposition'] == 'true' ?$showlabel.$stacklabel.__( ' by ', 'decm-divi-event-calendar-module') : $showlabel.$stacklabel )." ". $enable_organizer_link, $atts, $event_post, $excerptLength ) .
											   apply_filters( 'ecs_event_organizer_tag_end', '</span>', $atts, $event_post );
						  //$evnt_organizer= tribe_get_organizer_link( $organizer ) ;
								 }
						  
							  	if ( ! $multiple ) { 
									// $showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"organizer-ecs-icon":"";
									// $showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?"<span class=ecs-detail-label>Organizer </span>":"";
						            // $stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									// $event_output .= apply_filters( 'ecs_event_organizer_tag_start', '<span class="'.$classShowDataOneLine.' ecs-organizer '.$showicon.'">', $atts, $event_post ) .
									// 		   apply_filters( 'ecs_event_organizer',($atts['show_preposition'] == 'true' ?$showlabel.$stacklabel. __( ' by ', 'decm-divi-event-calendar-module') : " ".$showlabel.$stacklabel ). tribe_get_organizer($event_post->ID), $atts, $event_post, $excerptLength ) .
									// 		   apply_filters( 'ecs_event_organizer_tag_end', '</span>', $atts, $event_post );
							  	}//end if
						  
								  //do_action( 'tribe_events_single_meta_organizer_section_end' );
								  
							}
							//else{}
						}
							
							
							break;
							  case 'organizer_phone':
								//$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['organizer_phone'])) {
									if(tribe_get_organizer_phone($event_post->ID)!=null){
											//	do_action( 'tribe_events_single_meta_organizer_section_start' );
			  
												// foreach ( $organizer_ids as $organizer ) {
												// 	if ( ! $organizer ) {
												// 		continue;
												// 	}
										$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"organizer-phone-ecs-icon":"";
										$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Organizer Phone','decm-divi-event-calendar-module')." </span>":"";
										$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
								$event_output .= apply_filters( 'ecs_event_title_tag_start', '<span class="'.$classShowDataOneLine.'ecs-organizer-phone '.$showicon.'">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_title_link_start',$showlabel.$stacklabel. " ".tribe_get_organizer_phone($event_post->ID), $atts, $event_post ) .
										   apply_filters( 'ecs_event_title_tag_end', '</span>', $atts, $event_post );
							//	}
							  //	if ( ! $multiple ) { 
							  //	}/
							}
							}
								break;
								case 'organizer_email':
									//$event_output .= '<div class="decm-show-detail-center">';
									if ( self::isValid( $atts['organizer_email'])) {
										if(tribe_get_organizer_email($event_post->ID)!=null){
											$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"organizer-email-ecs-icon":"";
											$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Organizer Email','decm-divi-event-calendar-module')." </span>":"";
											$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$event_output .= apply_filters( 'ecs_event_title_tag_start', '<span class="'.$classShowDataOneLine.'ecs-organizer-email '.$showicon.'">', $atts, $event_post ) .
													apply_filters( 'ecs_event_list_title_link_start',$showlabel.$stacklabel. " ", $atts, $event_post ) .
													apply_filters( 'ecs_event_list_title_link_start',$atts['organizer_email_linkable']=="true"?'<a href="mailto:'.tribe_get_organizer_email($event_post->ID).'">'.tribe_get_organizer_email($event_post->ID).'</a>':tribe_get_organizer_email($event_post->ID), $atts, $event_post ) .
													apply_filters( 'ecs_event_title_tag_end', '</span>', $atts, $event_post );
									}}
									break;
									case 'organizer_weburl':
										//$event_output .= '<div class="decm-show-detail-center">';
										if ( self::isValid( $atts['organizer_weburl'])) {
											if(tribe_get_organizer_website_link($event_post->ID)!=null){
												$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"organizer-weburl-ecs-icon":"";
												$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Organizer Website','decm-divi-event-calendar-module')." </span>":"";
												$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
												$event_output .= apply_filters( 'ecs_event_title_tag_start', '<span class="'.$classShowDataOneLine.'ecs-organizer-weburl '.$showicon.'">', $atts, $event_post ) .
														apply_filters( 'ecs_event_list_title_link_start',$showlabel.$stacklabel. " ".tribe_get_organizer_website_link($event_post->ID), $atts, $event_post ) .
												   apply_filters( 'ecs_event_title_tag_end', '</span>', $atts, $event_post );
										}}
										break;
										case 'event_tag':
											//$event_output .= '<div class="decm-show-detail-center">';
											if ( self::isValid( $atts['event_tag'])) {
												if(get_the_term_list( $event_post->ID, 'post_tag',$before = '', $sep = ',', $after = '' )!=null){
													$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"event-tag-ecs-icon":"";
													$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Event Tags','decm-divi-event-calendar-module')." </span>":"";
													$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
											$event_output .= apply_filters( 'ecs_event_title_tag_start', '<span class="'.$classShowDataOneLine.'ecs-event-tag '.$showicon.'">', $atts, $event_post ) .
															apply_filters( 'ecs_event_list_title_link_start',$showlabel.$stacklabel. " ".get_the_term_list( $event_post->ID, 'post_tag',$before = '', $sep = ', ', $after = '' ), $atts, $event_post ) .
													   apply_filters( 'ecs_event_title_tag_end', '</span>', $atts, $event_post );
											}
										}
											break;
							  case 'price':
								  if ( self::isValid( $atts['price'] ) ) {
									  if(tribe_get_cost( $event_post->ID, true )!=null){
										$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"price-ecs-icon":"";
										$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Price','decm-divi-event-calendar-module')." </span>":"";
										$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
										$event_output .= apply_filters( 'ecs_event_price_tag_start', '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">', $atts, $event_post ) .
												 apply_filters( 'ecs_event_price',$showlabel .$stacklabel. " ".tribe_get_cost( $event_post->ID, true ), $atts, $event_post, $excerptLength ) .
												 apply_filters( 'ecs_event_price_tag_end', '</span>', $atts, $event_post );
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

								 else{
								  $event_output.='<div class="'.$image_center.' col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
								  $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
									  $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
								 }
								  
								  if( !empty( $thumbWidth ) ) {
									  if ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'ecs_event_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) ) ) {
										  $event_output .= apply_filters( 'ecs_event_thumbnail_link_start', '<a href="' . tribe_get_event_link($event_post->ID).'">', $atts, $event_post );
										  $event_output .= apply_filters( 'ecs_event_thumbnail', $thumb, $atts, $event_post );
										  $event_output .= apply_filters( 'ecs_event_thumbnail_link_end', '</a>', $atts, $event_post );
									  }
								  } else {
							
									  if ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'ecs_event_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) ) ) {
										  $event_output .= apply_filters( 'ecs_event_thumbnail_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '">', $atts, $event_post );
										  $event_output .= apply_filters( 'ecs_event_thumbnail', $thumb, $atts, $event_post );
										  $event_output .= apply_filters( 'ecs_event_thumbnail_link_end', '</a>', $atts, $event_post );
									  }
								  }
								  $event_output.='</div>';
							  }
							  break;
  
						  case 'excerpt':
							  if ( self::isValid( $atts['excerpt'] ) ) {
								  
								  $excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 100;
								  if(self::get_excerpt($event_post,$excerptLength )!=null){
								  $event_output .= apply_filters( 'ecs_event_excerpt_tag_start', '<p class="'.$classShowDataOneLine.' ecs-excerpt">', $atts, $event_post ) .
											 apply_filters( 'ecs_event_excerpt', self::get_excerpt($event_post, $excerptLength ), $atts, $event_post, $excerptLength ) .
											 apply_filters( 'ecs_event_excerpt_tag_end', '</p>', $atts, $event_post );
							  }
							  //else{}
						  }
							  
							  break;
						  
						  case 'weburl':
							  if ( self::isValid( $atts['weburl'] ) ) {
								  if ( tribe_get_event_website_link($event_post)!=null){
									$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"weburl-ecs-icon":"";
									$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Website','decm-divi-event-calendar-module')." </span>":"";
									$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$event_output .='<div class="decm-show-detail-center">'. apply_filters( 'ecs_event_weburl_tag_start', '<p class="'.$classShowDataOneLine.' ecs-weburl '.$showicon.'">', $atts, $event_post ) .
											 apply_filters( 'ecs_event_weburl',$showlabel.$stacklabel." ", $atts, $event_post) .
											 apply_filters( 'ecs_event_weburl',($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<a href="'.$result.'" target="'.$atts['custom_website_link_target'].'">'.$custom_website_link_text.'</a>':'<a href="'.$result.'" target="'.$atts['custom_website_link_target'].'">'.tribe_get_event_website_url($event_post->ID).'</a>', $atts, $event_post) .
											 apply_filters( 'ecs_event_weburl_tag_end', '</p>', $atts, $event_post ).
											 apply_filters( 'ecs_event_weburl_tag_end', '</div>', $atts, $event_post );
							  }
							  //else{}'custom_website_link_text'website_link
						  }
							  
							  //$event_output.='</div></br>';
							  break;
  
							  case 'date':
								$event_output .= '<div class="decm-show-detail-center">';
								//if ( self::isValid( $atts['eventdetails'] ) ) {
									if($atts['showtime']== 'true'){
										
									if($atts['show_data_one_line'] == 'true'){
										
										//	if($atts['show_icon_label']=="label" && $atts['show_data_one_line'] == 'true'){$showlabeldate="<span class=ecs-detail-label>Date: </span>";$showlabeltime="<span class=ecs-detail-label>Time: </span>";}
									//elseif($atts['show_icon_label']=="icon" && $atts['show_data_one_line'] == 'true'){$showicondate="eventDate-ecs-icon"; $showicontime="eventTime-ecs-icon"; }
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{       if($atts['eventdetails']== 'true'){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$showlabeldate.	$stacklabel." ".$start_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
						}
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel." ". $dateTimeSeparator." ".$start_time : $showlabeltime.$stacklabel." ".$start_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$timeRangeSeparatorEnd.$end_time :$timeRangeSeparatorEnd. $end_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );}
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{           if($atts['eventdetails']== 'true'){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel." ".$start_date, $atts, $event_post ) .
									//apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
						}
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									//apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?" @ ".$start_time : $start_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel." ".$dateTimeSeparator.$end_time :$showlabeltime."".$stacklabel. $end_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
									}
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{ 
							if($atts['eventdetails']== 'true'){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel." ".$start_date, $atts, $event_post ) .
									//apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
						}
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel. $dateTimeSeparator ." ".$start_time : $showlabeltime.$stacklabel." ".$start_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$timeRangeSeparatorEnd.$end_time :$timeRangeSeparatorEnd. $end_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
								}
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{
							if($atts['eventdetails']== 'true'){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$showlabeldate.$stacklabel.$start_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
							}
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.$dateTimeSeparator.$start_time : $showlabeltime.$stacklabel.$start_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details', ($atts['show_preposition'] == 'true') ?$timeRangeSeparatorEnd.$end_time :$timeRangeSeparatorEnd. $end_time, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
									}
						}
					}
									
									elseif($atts['show_data_one_line']=="false"){
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
											if($atts['eventdetails']== 'true'){
									$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											}
										$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? $dateTimeSeparator .$start_time:" ".$start_time,  $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );	
									if($atts['eventdetails']== 'true'){
									$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
									}
									$event_output.=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
									apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ?$dateTimeSeparator .$end_time:" ".$end_time,  $atts, $event_post ) .
									apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
									}
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
										if($atts['eventdetails']== 'true'){
										$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
										}
										$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? $dateTimeSeparator .$end_time:" ".$end_time,  $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
										}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
											if($atts['eventdetails']== 'true'){
											$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											}
												$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ? " $dateTimeSeparator ".$start_time:" ".$start_time,  $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );	
											if($atts['eventdetails']== 'true'){
											$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											}
											$event_output.=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ?  $dateTimeSeparator .$end_time:" ".$end_time,  $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											}
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
												if($atts['eventdetails']== 'true'){
												$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
												apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
												}
													$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ?  $dateTimeSeparator .$start_time:" ".$start_time,  $atts, $event_post ) .
												apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );	
				
												$event_output .=apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_details',($atts['show_preposition'] == 'true') ?  $timeRangeSeparatorEnd .$end_time:" $timeRangeSeparatorEnd ".$end_time,  $atts, $event_post ) .
												apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
												}
									}
								}
									elseif($atts['showtime']=="false"){
										if($atts['eventdetails']== 'true'){
									if($atts['show_data_one_line'] == 'true'){
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
										$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$showlabeldate.$start_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
										}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
											$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',$showlabeldate.$start_date, $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											}
										}
										
										elseif($atts['show_data_one_line']=="false"){
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
										$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post ).
										 apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
										apply_filters( 'ecs_event_list_details',$end_date, $atts, $event_post ) .
										apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
										}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
											$event_output .= apply_filters( 'ecs_event_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
											apply_filters( 'ecs_event_list_details',$start_date, $atts, $event_post ) .
											apply_filters( 'ecs_event_date_tag_end', '</span>', $atts, $event_post );
											}
										}
									}
									}
								
								//}
								// $event_output.='</div>';
								break;
							  
  
						  case 'venue':
							  if ( self::isValid( $atts['venue'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								  if(tribe_get_venue($event_post->ID)!=null){
									$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"venue-ecs-icon":"";
									$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Venue','decm-divi-event-calendar-module')." </span>":"";
									$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$enable_venue_link =$atts['enable_venue_link']=="true"?tribe_get_venue($event_post->ID):tribe_get_venue($event_post->ID);
									$event_output .= apply_filters( 'ecs_event_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-venue duration venue '.$showicon.'">', $atts, $event_post ) .

											 apply_filters( 'ecs_event_venue_at_text',($atts['show_preposition'] == 'true' ? $showlabel.$stacklabel.' <em>'.__('at','decm-divi-event-calendar-module').'</em>' :$showlabel.$stacklabel ), $atts, $event_post ) .

											 apply_filters( 'ecs_event_list_venue', " ". $enable_venue_link, $atts, $event_post ) .
											 apply_filters( 'ecs_event_venue_tag_end', '</span>', $atts, $event_post );		   
								   
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

									$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"event-location-ecs-icon":"";
									$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Location','decm-divi-event-calendar-module')." </span>":"";
									$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
								
									$event_output .= apply_filters( 'ecs_event_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-location duration venue '.$showicon.'">'.$showlabel.$stacklabel, $atts, $event_post ) .
											 apply_filters( 'ecs_event_list_location_int_tag_start', '<em> ', $atts, $event_post ) .
											 apply_filters( 'ecs_event_venue_in_text',( $atts['show_preposition']=='true'?__('in','decm-divi-event-calendar-module'):''), $atts, $event_post ) .
											 apply_filters( 'ecs_event_list_location_int_tag_end', ' </em>', $atts, $event_post ) .
											 apply_filters( 'ecs_event_list_location',($atts['show_data_one_line'] =='false'? $street.$locality.$postal.$country : str_replace('<br>','',$street.$locality.$postal.$country)), $atts, $event_post)  .	
											 apply_filters( 'ecs_event_venue_tag_end', '</span>', $atts, $event_post );
							  }
							  // else{}
							  }
							  
							  break;
							  case 'google_link':
								//$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['google_link'])) {
									if(tribe_get_map_link_html($event_post->ID)!=null){
										$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"google-link-ecs-icon":"";
										$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Venue Google Map Link','decm-divi-event-calendar-module')." </span>":"";
										$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$event_output .= apply_filters( 'ecs_event_title_tag_start',get_post_meta( $event_post->ID, '_EventShowMapLink', true )=="1"? '<span class="'.$classShowDataOneLine.'ecs-venue-google-link '.$showicon.'">':"", $atts, $event_post ) .
												apply_filters( 'ecs_event_list_title_link_start',$showlabel.$stacklabel." ".tribe_get_map_link_html( $event_post->ID ), $atts, $event_post ) .
										   apply_filters( 'ecs_event_title_tag_end', '</span>', $atts, $event_post );
								}}
								break;
							  case 'venue_phone':
								//$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['venue_phone'])) {
									if(tribe_get_phone($event_post->ID)!=null){
										$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"venue-phone-ecs-icon":"";
										$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Venue Phone','decm-divi-event-calendar-module')." </span>":"";
										$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
								$event_output .= apply_filters( 'ecs_event_title_tag_start', '<span class="'.$classShowDataOneLine.'ecs-venue-phone '.$showicon.'">', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_title_link_start',$showlabel.$stacklabel." ".tribe_get_phone($event_post->ID), $atts, $event_post ) .
										   apply_filters( 'ecs_event_title_tag_end', '</span>', $atts, $event_post );
								}}
								break;
								case 'venue_weburl':
									//$event_output .= '<div class="decm-show-detail-center">';
									if ( self::isValid( $atts['venue_weburl'])) {
										if(tribe_get_venue_website_link($event_post->ID)!=null){
											$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"venue-weburl-ecs-icon":"";
											$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Venue Website','decm-divi-event-calendar-module')." </span>":"";
											$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$event_output .= apply_filters( 'ecs_event_title_tag_start', '<span class="'.$classShowDataOneLine.'ecs-venue-weburl '.$showicon.'">', $atts, $event_post ) .
													apply_filters( 'ecs_event_list_title_link_start',$showlabel.$stacklabel." ".tribe_get_venue_website_link($event_post->ID), $atts, $event_post ) .
											   apply_filters( 'ecs_event_title_tag_end', '</span>', $atts, $event_post );
									}}
									break;
						  /**
						   * Show categories of every events
						   *
						   * @author bojana
						   */
						  case 'categories':
							  if ( self::isValid( $atts['categories'] ) ) {
								  $categories = implode(', ', $category_names);
								  $categories_separator = $categories ? ' | ' : '';
							  if(et_core_esc_wp( $categories )!=null){
								$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"categories-ecs-icon":"";
								$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Category','decm-divi-event-calendar-module')." </span>":"";
								$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
								  $event_output .= apply_filters( 'ecs_event_categories_tag_start', '<span class="'.$classShowDataOneLine.'ecs-categories '.$showicon.'">', $atts, $event_post ) .
											  et_core_intentionally_unescaped($showlabel.$stacklabel. ($atts['show_preposition'] == 'true' ? $categories_separator  : " "), 'fixed_string' ) .
											  apply_filters( 'ecs_event_categories', et_core_esc_wp( $categories ), 
											  $atts, $event_post, $excerptLength ) .
											  apply_filters( 'ecs_event_categories_tag_end', '</span>', $atts, $event_post );
							  }
							  else{}
						  }
							  
							  $event_output.='</div>';
							  break;
							 case 'addcalendarbutton': 
								if ( self::isValid( $atts['show_add_calendar_button']) ) {
									if($atts['show_add_calendar_button']=='true'){
									$button_classes ="act-add_to_calendar et_pb_button";
									$button_classes = ($atts['custom_add_to_calendar_button'] == 'on') ? $button_classes." et_pb_custom_button_icon " : $button_classes;
									$show_left_right=$atts['columns']=="1" ?"col-md-6":"";
									$event_output .= apply_filters( 'ecs_event_showcalendar_tag_start', '<p class="diec_add_to_calendar et_pb_button_wrapper  '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													apply_filters( 'ecs_event_list_showcalendar_link_start', '<a  style="font-weight:'.$atts['add_to_calendar_button_icon_font_weight'].';" class="'.$button_classes.' " href=""  rel="bookmark"  data-icon="'.$atts['add_to_calendar_button_icon'].'" data-icon-tablet="'.$atts['add_to_calendar_button_icon_tablet'].'" data-icon-phone="'.$atts['add_to_calendar_button_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['add_to_calendar_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdcalendar_link_end', '</a>', $atts, $event_post ) .
											apply_filters( 'ecs_event_showcalendar_tag_end', '</p>', $atts, $event_post );
								}}
								//$event_output.='</div>';
								break;
						  /**
						   * Show more in detail of every events
						   *
						   * @author bojana
						   */
						  case 'showcalendar':
							if( $atts['show_add_calendar_button']=='true'){
							$event_output .='<div class= "ecs-calendar_link_align">';
							}
							if ( self::isValid( $atts['show_google_calendar']) ) {
								if($atts['show_google_calendar']=='true' && $atts['show_add_calendar_button']=='true'){
									
								$button_classes ="act-google_calendar";
								$show_left_right=$atts['columns']=="1" ?"col-md-4":"";
								$event_output .= apply_filters( 'ecs_event_showcalendar_tag_start', '<p class="ecs-show_calendar '.$show_left_right. '  '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_showcalendar_link_start', '<a class="'.$button_classes.' " target="_blank" href="' . Tribe__Events__Main::instance()->esc_gcal_url( tribe_get_gcal_link($event_post->ID) ) . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['google_calendar_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdcalendar_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'ecs_event_showcalendar_tag_end', '</p>', $atts, $event_post );
							}}
							//$event_output.='</div>';
							break;

							  case 'showical':
								  if ( self::isValid( $atts['show_ical_export']) ) {
									  if($atts['show_ical_export']=='true' && $atts['show_add_calendar_button']=='true'){
									  $button_classes ="act-ical-export";
									  $show_left_right=$atts['columns']=="1" ?"col-md-4":"";
									  $event_output .= apply_filters( 'ecs_event_showical_tag_start', '<p class="ecs-showical-export '.$show_left_right.' '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													  apply_filters( 'ecs_event_list_showical_link_start', '<a class="'.$button_classes.' " target="_blank"  href="' . tribe_get_event_link($event_post->ID).'?ical=2&amp;tribe_display=" rel="bookmark">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['ical_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showical_link_end', '</a>', $atts, $event_post ) .
											  apply_filters( 'ecs_event_showical_tag_end', '</p>', $atts, $event_post );
								  }}
							  break;

						  case 'showoutlook':
							if ( self::isValid( $atts['show_outlook_link']) ) {
								if($atts['show_outlook_link']=='true' && $atts['show_add_calendar_button']=='true'){
								$button_classes ="act-outlook_link";
								$show_left_right=$atts['columns']=="1" ?"col-md-4":"";
								$event_output .= apply_filters( 'ecs_event_show_outlook_tag_start', '<p class="ecs-showoutlook-link '.$show_left_right.' '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'ecs_event_list_outlook_link_start', '<a class="'.$button_classes.' " target="_blank"  href="' . tribe_get_event_link($event_post->ID).'?ical=2&amp;tribe_display=" rel="bookmark">', $atts, $event_post ) . apply_filters( 'ecs_event_list_outlook_link', $atts['outlook_link_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_outlook_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'ecs_event_show_outlook_tag_end', '</p>', $atts, $event_post );
							}}
							if( $atts['show_add_calendar_button']=='true'){
							$event_output.='</div>';
							}
							break;
							case 'showdetail':
							  if ( self::isValid( $atts['showdetail']) ) {
								  $button_classes ="act-view-more et_pb_button";
								  $view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
								  $icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
								  $button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
	
								  $event_output .= apply_filters( 'ecs_event_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												  apply_filters( 'ecs_event_list_showdetail_link_start', '<a class="'.$button_classes.' " href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdetail_link_end', '</a>', $atts, $event_post ) .
										  apply_filters( 'ecs_event_showdetail_tag_end', '</p>', $atts, $event_post );
							  }
							  
							  break;
							  case 'googlemap':
								if ( self::isValid( $atts['googlemap'])) {
									//$event_output .= apply_filters( 'ecs_event_date_thumb', '<div class="ecs_google_map">'.tribe_get_embedded_map($event_post->ID).'</div>', $atts, $event_post );
									$event_output .= apply_filters( 'ecs_event_date_thumb',get_post_meta( $event_post->ID, '_EventShowMap', true )=="1"? '<div class="ecs_google_map"><iframe width="100%" height="350px" frameborder="0" style="border:0" src='.$atts['add_url'].$atts['google_api_key_customize'].'&q='.str_replace(' ','+',tribe_get_address( $event_post->ID)).'+'.str_replace(' ','+',tribe_get_city($event_post->ID)).'+'.str_replace(' ','+',tribe_get_region($event_post->ID)).'+'.str_replace(' ','+',tribe_get_zip($event_post->ID)).' allowfullscreen=""></iframe></div>':"", $atts, $event_post );
								}
								break;
							// 	case "show_past_notification":
							// 	if($get_end_time_offset < $get_current_time_offset) {
							// 		$event_output .= apply_filters( 'ecs_no_events_found_message','<div class="tribe-events-notices"><ul><li>'.sprintf( translate( $atts['message'], 'the-events-calendar' ).'</li></ul></div>'), $atts );
							// 	}
							// break;
							  
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
				  
				  
							  
				  
				  // $event_output .= apply_filters( 'ecs_event_end_tag', '</li>', $atts, $post );
				  $event_output .= apply_filters( 'ecs_event_end_tag', '</article></div>', $atts, $event_post );
  
				  $output .= apply_filters( 'ecs_single_event_output', $event_output, $atts, $event_post, $post_index, $event_post );
				  
								  
  
				  
			  }
			  // $output .= apply_filters( 'ecs_end_tag', '</ul>', $atts );
			  $output .= apply_filters( 'ecs_end_tag', '</div>', $atts );
			  //$output = apply_filters( 'ecs_ending_output', $output, $posts, $atts );
			  
			  if( self::isValid( $atts['viewall'] ) ) {
				  $output .= apply_filters( 'ecs_view_all_events_tag_start', '<span class="ecs-all-events">', $atts ) .
							 '<a href="' . apply_filters( 'ecs_event_list_viewall_link', tribe_get_events_link(), $atts ) .'" rel="bookmark">' . apply_filters( 'ecs_view_all_events_text', sprintf( __( 'View All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ), $atts ) . '</a>';
				  $output .= apply_filters( 'ecs_view_all_events_tag_end', '</span>' );
			  }
		  } else { //No Events were Found
			if(get_post_status( $event_post->ID)=="private"){}
			else{
			  $output .= apply_filters( 'ecs_no_events_found_message', sprintf( translate( $atts['message'], 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() ), $atts );
			}
			} // endif
  
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
  
	  //	$atts  = array();
  
  
		  
		  global $post;
		  $output = '';
		//   if (!  class_exists( 'Tribe__Tickets__Main' ) ) {
		// 	return '\'Event Tickets\' plugin should exist';
		// }
		  $atts = shortcode_atts( apply_filters( 'ecs_shortcode_atts', array(
			  'cat' => $atts['included_categories'],
			  'month' => '',
			  'limit' => $atts['event_count'],
			  'eventdetails' => 'true',
			  'showtime' => 'true',
			  'show_timezone' => 'true',
			  'website_link'=> $atts['website_link'],
			  'organizer_email_linkable'=>$atts['organizer_email_linkable'],
			  'custom_website_link_text'=>$atts['custom_website_link_text'],
			  'custom_website_link_target'=>$atts['custom_website_link_target'],
			  'time' => null,
			  'show_google_map'=>'true',
			  'past' => ($atts['show_past'] === 'on' ? 'yes' : ''),
			  'venue' => 'false',
			  'enable_venue_link'=>$atts['enable_venue_link'],
			  'google_link'=>'false',
			  'venue_phone'=>'false',
			  'venue_weburl'=>'false',
			  'location' => 'false',
			  'street' => 'false',
			  'locality'=>'false',
			  'postal'=>'false',
			  'country'=>'false',
			  'organizer' => null,
			  'enable_organizer_link'=>$atts['enable_organizer_link'],
			  'organizer_phone'=>'false',
			  'organizer_email'=>'false',
			  'organizer_weburl'=>'false',
			  'price' => null,
			  'weburl' => null,
			  'categories' => 'false',
			  'enable_category_link'=>$atts['enable_category_link'],
			  'event_tag' =>'false',
			  'schema' => 'true',
			  'message' => 'This event has passed.',
			  'key' => 'End Date',
			  'order' => 'ASC',
			  'orderby' => 'startdate',
			  'viewall' => 'false',
			  'excerpt' => 'false',
			  'showdetail' => 'false',
			  'thumb' => 'false',
			  'thumbsize' => '',
			  'thumbwidth' => '800',
			  'thumbheight' => '800',
			  'contentorder' => apply_filters( 'ecs_default_contentorder', ' thumbnail,pass_message,title, title2,description, date, venue, location, google_link,google_link_check, venue_phone, venue_weburl, organizer, organizer_phone, organizer_email, organizer_weburl, event_tag, price, categories, excerpt,weburl,checkgooglemaplink,googlemap,dateTimeSeparator,timeRangeSeparator, showdetail', $atts ),
			  'event_tax' => '',
			  'date_format' => '',
			  'time_format' => '',
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
			  //'ajax_load_more_button_icon'=>'',
			  //'pagination_type' =>'',
			  'align'    => '',
			  'show_icon_label'=>'',
			  'google_api_key_customize'=>'',
			  'add_url'=>'',
			   
  
		  ), $atts ), $atts, 'ecs-list-events' );
  
	  
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
  
		  if ( $atts['time'] == 'past' || !empty( $atts['past'] ) ) {
			  $meta_date_compare = '<';
			  $atts['order'] = 'ASC';
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
			  //$atts['past']='';
			  if($atts['past']=='yes'){
				  $atts['order']="DESC";
			  }
			  else{
				  $atts['order']='ASC';
			  }
  
		  $atts = apply_filters( 'ecs_atts_pre_query', $atts, $meta_date_date, $meta_date_compare );
		  
	  
		  
  
		  $post_type = get_post_type( $current_page['id'] );
		  
		  $args = apply_filters( 'ecs_get_events_args', array(
			  'post_status' => 'publish',
			  'posts_per_page' => $atts['limit'],
			  'tax_query'=> $atts['event_tax'],
			 
			   'order' => $atts['order'],
			  'offset' => $atts['blog_offset'],
			  'included_categories' =>  $atts['included_categories'],
			  'meta_query' => apply_filters( 'ecs_get_meta_query', array( $atts['meta_date'] ), $atts, $meta_date_date, $meta_date_compare ),
		  ), $atts, $meta_date_date, $meta_date_compare );
		  //et_body_layout
		  if($atts['use_current_loop'] == "false"){
		  if($post_type == 'tribe_events')
		  {
			  $args['ID'] = $current_page['id'];
		  }
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
						   */
						  $category_names[] =$atts['enable_category_link']=="on"?'<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>':$category->name;
						  
					  }
				  }
				  $get_end_time_offset=Tribe__Events__Timezones::event_end_timestamp( $event_post->ID);

				  $get_current_time_offset=strtotime( gmdate('Y-m-d H:i:s')) + get_option( 'gmt_offset' ) * 3600 ;
				 
				  $custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];


				  foreach ( apply_filters( 'ecs_event_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					  switch ( trim( $contentorder ) ) {
						case'pass_message':
							// if($get_end_time_offset < $get_current_time_offset) {
								$atts['posts'][$index]['pass_message'] =$atts['message'];
							//}
							break;  
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
							  $atts['posts'][$index]['price']= " ".tribe_get_cost($event_post->ID, true );
						  break;
						  case 'weburl':
							  
							  $atts['posts'][$index]['weburl' ]=($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<a href="'.tribe_get_event_meta($event_post->ID, '_EventURL', true ).'" target="'.$atts['custom_website_link_target'].'">'.$custom_website_link_text.'</a>':tribe_get_event_website_link($event_post);
						  break;
						  case 'organizer':
							$organizers = tribe_get_organizer_ids($event_post->ID );
			                    $orgName = array();
								foreach ($organizers as $key => $organizerId) {
									$orgName[$key]=$atts['enable_organizer_link']=="on"?tribe_get_organizer($organizerId):tribe_get_organizer($organizerId);
							}
							$atts['posts'][$index]['organizer'] = $orgName;
								//$event_output.='</div>';
							break;
			;
						
							  case 'organizer_phone':
						
								  $atts['posts'][$index]['organizer_phone'] =" ".tribe_get_organizer_phone($event_post->ID);
						
							  break;
						  case 'organizer_weburl':
						
								  $atts['posts'][$index]['organizer_weburl'] =" ".tribe_get_organizer_website_link($event_post->ID);
						
							  break;
						  case 'organizer_email':
						
								  $atts['posts'][$index]['organizer_email'] =$atts['organizer_email_linkable']=="on"?'<a href="mailto:'.tribe_get_organizer_email($event_post->ID).'">'.tribe_get_organizer_email($event_post->ID).'</a>':tribe_get_organizer_email($event_post->ID);
						
							  break;
						  case 'event_tag':
						
								  $atts['posts'][$index]['event_tag'] =" ".get_the_term_list( $event_post->ID, 'post_tag',$before = '', $sep = ', ', $after = '' );
					  
							  break;	  
								  
						  case 'thumbnail':
							  $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
							  $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
  
							  $atts['posts'][$index]['thumb'] = get_the_post_thumbnail_url($event_post->ID,array( 800, $thumbHeight ));
							  break;
  
						  case 'excerpt':
								  $excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 270;
								  $atts['posts'][$index]['excerpt'] =self::get_excerpt($event_post->ID, $excerptLength ); 
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
  
						  case 'venue':
							  if (  function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								  $atts['posts'][$index]['venue'] =tribe_get_venue($event_post->ID);
							  }
							  break;
						  case 'venue_phone':
							 
							  $atts['posts'][$index]['venue_phone'] =" ".tribe_get_phone($event_post->ID);
							
							  break;
							case 'venue_weburl':
							  
								  $atts['posts'][$index]['venue_weburl'] =" ".tribe_get_venue_website_link($event_post->ID);
							  
							  break;
							case 'google_link':
							  
							  $atts['posts'][$index]['google_link'] =" ".tribe_get_map_link_html( $event_post->ID );
							
							  break;
							  case 'google_link_check':
							  
								$atts['posts'][$index]['google_link_check'] = get_post_meta( $event_post->ID, '_EventShowMapLink', true );
							  
								break;
							 
						  /**
						   * Show location of venue
						   *
						   * @author bojana
						   *
						   */
						  case 'location':
							  if ( function_exists( 'tribe_get_full_address' ) and tribe_get_full_address($event_post->ID)) {
								  $atts['posts'][$index]['location'] = tribe_get_address($event_post->ID).','.tribe_get_city($event_post->ID).','.tribe_get_zip($event_post->ID).','.tribe_get_country($event_post->ID); 
							  }
							  break;
						  /**
						   * Show categories of every events
						   *
						   * @author bojana
						   */
						  case 'categories':
							  $excerptLength='';
								  $categories = implode(', ', $category_names);
								  $categories_separator = $categories ? '|' : '';
								  $atts['posts'][$index]['categories'] = apply_filters( 'ecs_event_categories_tag_start', '<span class="ecs-categories">', $atts, $event_post ) .
								  et_core_intentionally_unescaped( $categories_separator, 'fixed_string' ) .
								  apply_filters( 'ecs_event_categories', et_core_esc_wp( $categories ), 
								  $atts, $event_post, $excerptLength ) .
								  et_core_intentionally_unescaped( $categories_separator, 'fixed_string' );
								  apply_filters( 'ecs_event_categories_tag_end', '</span>', $atts, $event_post );
							  break;
						  /**
						   * Show more in detail of every events
						   *
						   * @author bojana
						   */
							case 'checkgooglemaplink':
								$atts['posts'][$index]['checkgooglemaplink']=get_post_meta( $event_post->ID, '_EventShowMap', true );
								break;

						  case 'googlemap':
							$atts['posts'][$index]['googlemap']=get_post_meta( $event_post->ID, '_EventShowMap', true )=="1"? str_replace(' ','+',tribe_get_address( $event_post->ID)).'+'.str_replace(' ','+',tribe_get_city($event_post->ID)).'+'.str_replace(' ','+',tribe_get_region($event_post->ID)).'+'.str_replace(' ','+',tribe_get_zip($event_post->ID)):"";
							//$atts['posts'][$index]['googlemap'] =tribe_get_embedded_map($event_post->ID); 
							//$atts['posts'][$index]['googlemap'] ='<iframe width="100%" height="350px" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key='.$atts['google_api_key_customize'].'&q=Johar+town+lahore+punjab+5200+" allowfullscreen="">
							//	</iframe>'; 		
						break; 
						case 'dateTimeSeparator':
							$atts['posts'][$index]['dateTimeSeparator'] =tribe_get_option( 'dateTimeSeparator', ' @ ' );		
						break; 
						case 'timeRangeSeparator':
							$atts['posts'][$index]['timeRangeSeparator'] =tribe_get_option( 'timeRangeSeparator', ' - ' );		
						break; 
						case 'description':
							$atts['posts'][$index]['description'] =get_the_content($event_post->ID); 		
						break;  
						  case 'date_thumb':
								  $atts['posts'][$index]['date_thumb']['M'] =tribe_get_start_date( null, false, 'M' ); 
								  $atts['posts'][$index]['date_thumb']['J'] =tribe_get_start_date( null, false, 'j' ); 
								  
							  break;
						  default:
						  $atts['posts'][$index]['contentorder'] = strtolower( trim( $contentorder ) );
					  }
				  }
			  }
			  

		  }  // endif

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
  
		  $excerpt = preg_replace( " (\[.*?\])", '', $excerpt );
		  $excerpt = wp_strip_all_tags( strip_shortcodes($excerpt) );
		  $excerpt = trim( preg_replace( '/\s+/', ' ', $excerpt ) );
		  if ( strlen( $excerpt ) > $limit ) {
			  $excerpt = substr( $excerpt, 0, $limit );
			  $excerpt .= '...';
		  }
		  
		  return $excerpt;
		  
	  }
  
				  
  }

new DIEC_EventPage;
