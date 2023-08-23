<?php

class DECM_EventFilter extends ET_Builder_Module {

	public $slug       = 'decm_event_filter';
	public $vb_support = 'on';

	public function init() {
		$this->name = esc_html__( 'Events Filter', 'decm-divi-event-calendar-module' );
		$this->child_slug = 'decm_event_filter_child';
	}


	public function get_settings_modal_toggles() {
		return array(

			'gerneral' => array(
				'toggles' => array(
	      		'decm_layout' => array(
						'priority' => 1,
						'title' => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					),
					// 'background' => array(
					// 	'priority' => 19,
					// 	'title' => esc_html__( 'Background', 'decm-divi-event-calendar-module' ),
					// ),								
					'decm_connection_id' => array(
						'priority' => 25,
						'title' => esc_html__( 'Connection', 'decm-divi-event-calendar-module' ),
					),	
				),
			),
			
			  'advanced' => array(
				  'toggles' => array(
					 // 'layout'  => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					  'filters_search'  => esc_html__( 'Filters', 'decm-divi-event-calendar-module' ),
					  'filters_active'  => esc_html__( 'Active Filters', 'decm-divi-event-calendar-module' ),	
					  'filters_dropdown'  => esc_html__( 'Filters Dropdown', 'decm-divi-event-calendar-module' ),	
					  'filters_dropdown_text'  => esc_html__( 'Filters Dropdown Text', 'decm-divi-event-calendar-module' ),		
					  'filters_collapse'  => esc_html__( 'Collapse Filters', 'decm-divi-event-calendar-module' ),			  
				  ),
			  ),
		  );
	  }

	public function get_fields() {
		return array(
			// 'heading'     => array(
			// 	'label'           => esc_html__( 'Heading', 'decm-divi-event-calendar-module' ),
			// 	'type'            => 'text',
			// 	'option_category' => 'basic_option',
			// 	'description'     => esc_html__( 'Input your desired heading here.', 'decm-divi-event-calendar-module' ),
			// 	'toggle_slug'     => 'background',
			// ),
			'filter_background_color' => array(
				'label'             => esc_html__( 'Filters Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the individual event filters.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'filters_search',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			
			'filter_margin' => array(
				'label' => __('Filters Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event filter.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'filters_search',	
				'mobile_options'  => true,
			),
	
			'filter_padding' => array(
				'label' => __('Filters Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event filter.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'filters_search',	
				'mobile_options'  => true,
			),
			'active_filters_background_color' => array(
				'label'             => esc_html__( 'Active Filters Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the individual active event filters.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'filters_active',
				'default'           => '#000719',	
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			
			'dropdown_filters_background_color' => array(
				'label'             => esc_html__( 'Filters Dropdown Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the event filters dropdown.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'filters_dropdown',
			//	'default'           => '#000719',	
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'active_filter_margin' => array(
				'label' => __('Active Filters Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the active event filters.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'filters_active',	
				'mobile_options'  => true,
			),

			'active_filter_padding' => array(
				'label' => __('Active Filters Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the active event filters.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'filters_active',	
				'mobile_options'  => true,
			),

			// dropdown filter
			// 'filter_dropdown_margin' => array(
			// 	'label' => __('Filters Dropdown Margin', 'decm-divi-event-calendar-module'),
			// 	'type' => 'custom_margin',
			// 	'description' => __('Adjust the spacing around the outside of the event filters dropdown.', 'decm-divi-event-calendar-module'),
			// 	'tab_slug'        => 'advanced',
			// 	'toggle_slug' => 'filters_dropdown',	
			// 	'mobile_options'  => true,
			// ),

			'filter_dropdown_padding' => array(
				'label' => __('Filters Dropdown Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event filters dropdown.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'filters_dropdown',	
				'default'         => '14px|20px|14px|20px',
				'mobile_options'  => true,
			),

		

			'events_filter_layouts' => array(
				'label'           => esc_html__( 'Filter Layout', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the layout orientation of the filters.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'horizontal'   => __( 'Horizontal', 'decm-divi-event-calendar-module' ),
					//'vertical'   => __( 'Vertical', 'decm-divi-event-calendar-module' ),               
				],
				//'mobile_options'  => true,
				'tab_slug'		  => 'general',
				'toggle_slug'     => 'decm_layout',
				'default' => 'horizontal',
			),

			// 'filter_multiple_select' => array(
			// 	'label'           => esc_html__( 'Single & Multiple Select', 'decm-divi-event-calendar-module' ),
			// 	'description'		=> esc_html__( 'Choose to Filter Single & Multi  in the  event feed.', 'decm-divi-event-calendar-module' ),
			// 	'type'            => 'select',	
			// 	//'type'            => 'select',
			// 	'option_category' => 'layout',
			// 	'options'		=>[
			// 		'single'   => __( 'Single', 'decm-divi-event-calendar-module' ),
			// 		'multi'   => __(  'Multiple', 'decm-divi-event-calendar-module' ),               
			// 	],
			// 	//'mobile_options'  => true,
			// 	'tab_slug'		  => 'general',
			// 	'toggle_slug'     => 'decm_layout',
			// 	'default' => 'single',
			// ),


			'filter_scroll_background_color' => array(
				'label'             => esc_html__( 'Filters Dropdown Scrollbar Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the event filters dropdown scrollbar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'filters_dropdown',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'dropdown_text_background_color' => array(
				'label'             => esc_html__( 'Filters  Dropdown  Text Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the event filters dropdown text.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'filters_dropdown_text',
				'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'filter_text_dropdown_padding' => array(
				'label' => __('Filters Text Dropdown Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event filters dropdown text.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'filters_dropdown_text',	
				'default'         => '8px|12px|8px|12px',
				'mobile_options'  => true,
			),

			'show_collapse_options'=> array(
				'label'				=> esc_html__( 'Show Option To Collapse Filters', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the Collapse Filters.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'advanced',
				'toggle_slug'		=> 'filters_collapse',
				'mobile_options'  => true,
				'default'			=> 'off',

			),
	                                                                                    
			'show_collapse_options_default'=> array(
				'label'				=> esc_html__( 'Collapse Filters By Default', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Set the default open or closed state for the collapse filter option.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        =>  'advanced',
				'toggle_slug'		=> 'filters_collapse',
				'mobile_options'  => true,
				'default'			=> 'off',
			),	

		
			'collapse_filters_background_color' => array(
				'label'             => esc_html__( 'Collapse Filters Icon Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the color for the filter icon.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'filters_collapse',
				'hover'             => 'tabs',
				// 'show_if' => array(
				// 	'show_collapse_options'=>'on',
				// ),
				'mobile_options'    => true,
			),

			'collapse_icon_font_size'                 => array(
				'label'            => esc_html__( 'Collapse Filters Icon Font Size', 'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Control the size of the icon by increasing or decreasing the font size.', 'et_builder' ),
				'type'             => 'range',
				'option_category'  => 'font_option',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'filters_collapse',
				'default'          => '24px',
				'default_unit'     => 'px',
				'default_on_front' => '',
				'range_settings'   => array(
					'min'  => '1',
					'max'  => '100',
					'step' => '1',
				),
				'mobile_options'   => true,
				'sticky'           => true,
				'depends_show_if'  => 'on',
				// 'show_if' => array(
				// 	'show_collapse_options'=>'on',
				// ),
				//'hover'            => 'tabs',
			),

			'module_css_class'     => array(
				'label'           => esc_html__( 'Connection ID', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a module connection identification keyword to link the functionality of multiple modules together.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'decm_connection_id',
			),
		);
	}

	function get_advanced_fields_config() {
		return array(
			'text'           => false,
			'button'         => false,	
			'filters'        => false,
			'link_options'        => false,

			'background'            => array(
				'has_background_color_toggle' => true,
				'css'                  => array(
					'main' =>  "%%order_class%%",
				),
				// 'options' => array(
				// 	'background_color' => array(
				// 		'depends_show_if'  => 'on',
				// 		'default'          => 'Transparent',
				// 	),
				// 	'use_background_color' => array(
				// 		'default'          => 'on',
						
				// 	),
				// ),
			),

			'sizing'        => array(
				'use_alignment' => false,
		    ),

			
			'borders'        => array(
				'default' => array(
					'css'      => array(
						'main' => array (
							'border_radii' => "%%order_class%%",
							'border_styles' => "%%order_class%%",					
						),
						//'important' => 'all',
					),
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
			),

			'filter_border'   => array(
				'css'          => array(
					'main' => array (
							'border_radii' => "%%order_class%% .dec-filter-label,%%order_class%% .dec-filter-container input[type=text]",
							'border_styles' => "%%order_class%% .dec-filter-label,%%order_class%% .dec-filter-container input[type=text]",		
					),
					// 'important' => 'all',
				),
				'label_prefix' => esc_html__( 'Filter', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Customize and style the event filters with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'filters_search',
				'defaults' => array(
					'border_radii' => 'on|50px|50px|50px|50px',
					'border_styles' => array(
						'width' =>  '2px',
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
				'label_prefix' => esc_html__( 'Filters Dropdown', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'filters_dropdown',
				'defaults' => array(
					'border_radii' => 'on|6px|6px|6px|6px',
					'border_styles' => array(
						'width' => '2px',
						'color' => '#ffffff',
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
				'label_prefix' => esc_html__( 'Active Filters', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Customize and style the active event filters with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'filters_active',
				'defaults' => array(
					'border_radii' => 'on|50px|50px|50px|50px',
					'border_styles' => array(
						'width' => '2px',
						'color' => '##000719',
						'style' => 'solid',
					),
				),
		    ),


			'filter_text_border'   => array(
				'css'          => array(
					'main' => array (
							'border_radii' => "%%order_class%% .dec-filter-list li,  .daterangepicker .ranges ul li",
							'border_styles' => "%%order_class%% .dec-filter-list li,  .daterangepicker .ranges ul li",
						
					),
					'important' => 'all',
				),
				'label_prefix' => esc_html__( 'Filters Text', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Customize and style the active event filters with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'filters_dropdown_text',
				'defaults' => array(
					'border_radii' => 'on|4px|4px|4px|4px',
					'border_styles' => array(
						'width' => '',
						'color' => '',
						'style' => '',
					),
				),
		    ),
	
	
			),
							
			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main'      =>  "%%order_class%%",
					),
				),

				'filter_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-label",
					),
					
					'label'         => esc_html__( 'Filters Box Shadow', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Customize and style the event filters with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_search',
					//'default'          => 'solid',
				),

				'active_filter_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-select",
					),
					
					'label'         => esc_html__( 'Active Filters Box Shadow', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Customize and style the active event filters with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_active',
					//'default'          => 'solid',
				),

				'dropdown_filter_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-list",
					),	
					'label'         => esc_html__( 'Filters Dropdown Box Shadow', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Customize and style the event filters dropdown with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_dropdown',
					//'default'          => 'solid',
				),

				'dropdown_filter_text_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-list li, .daterangepicker .ranges ul li",
					),	
					'label'         => esc_html__( 'Filters Dropdown Text Box Shadow', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Customize and style the event filters dropdown text with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_dropdown_text',
					//'default'          => 'solid',
				),
			),

			'fonts'     => array(

				'label' => array(
					'css'          => array(
						'main'      =>  "%%order_class%% .dec-filter-label, %%order_class%%  .dec-filter-container > ::placeholder ",
						//'important' => 'all',
					),
					'label'        => esc_html__( 'Filters', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event filters label text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				//	'disable_toggle' => false,
					'hide_text_align'   	=> true,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'filters_search',
				),

				'filter_dropdown_label' => array(
					'css'          => array(
						'main'      =>  "%%order_class%% .dec-filter-list li, .daterangepicker .ranges ul li",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Filters Dropdown', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event filters dropdown text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'filters_dropdown_text',
				),

				'filter_active_label' => array(
					'css'          => array(
						'main'      =>  "%%order_class%% .dec-filter-select, %%order_class%% .dec-filter-label button",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Active Filters', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the active event filters label text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'hide_text_align'   	=> true,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'filters_active',
					'text_color'  => array(
						'default'        => '#ffffff',
					),
				),

				'collapse_icon_text' => array(
					'css'          => array(
						'main'      =>  "%%order_class%% .dec_collapse_filters_events",	
						'important' => 'all',
					),
					'label'        => esc_html__( 'Collapse Filters', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the Placeholder  text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'filters_collapse',
					'font_size' => array(
						'default' => '24px',
					),
					'show_if' => array(
						'show_collapse_options'=>'on',
					),
				),
						
			),

			'button'         => array(       
				'filter_search_button' => array(
					'label'         => __( 'Filter Search Button', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Enable this feature to customize the appearance of the button.', 'decm-divi-event-calendar-module' ),
					'use_alignment' => false,
					'hide_icon'     => true,
					'box_shadow'    => false,
					'css'           => array(
						'main'      =>  "%%order_class%% .dec-search-filter-button",
						'plugin_main' => "%%order_class%% .dec-search-filter-button",
						// 'alignment'   => " ",
						'important' => 'all',
					),
				//	'depends_show_if' => 'search',
					'tab_slug' => 'advanced',
				),
				
            ),
					
		);
	}


	public function before_render() {
	
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

	public function render( $unprocessed_props, $content = null, $render_slug ) {
	
		// echo '<pre>';
		// print_r($this->props);
		// echo '</pre>';
		// exit;

		$dropdown_text_background_color__hover  = et_pb_hover_options()->get_value('dropdown_text_background_color', $this->props, '' );
		$dropdown_text_background_color__hover_enabled = et_builder_is_hover_enabled( 'dropdown_text_background_color', $this->props );
		$filter_background_color = $this->props["filter_background_color"];
        $filter_background_color_responsive_active = isset($this->props["filter_background_color"]) && et_pb_get_responsive_status($this->props["filter_background_color_last_edited"]);
        $filter_background_color_tablet = $filter_background_color_responsive_active && $this->props["filter_background_color_tablet"] ? $this->props["filter_background_color_tablet"] : $filter_background_color;
        $filter_background_color_phone = $filter_background_color_responsive_active && $this->props["filter_background_color_phone"] ? $this->props["filter_background_color_phone"] : $filter_background_color_tablet;	
		$active_filters_background_color = $this->props["active_filters_background_color"];
        $active_filters_background_color_responsive_active = isset($this->props["active_filters_background_color"]) && et_pb_get_responsive_status($this->props["active_filters_background_color_last_edited"]);
        $active_filters_background_color_tablet = $active_filters_background_color_responsive_active && $this->props["active_filters_background_color_tablet"] ? $this->props["active_filters_background_color_tablet"] : $active_filters_background_color;
        $active_filters_background_color_phone = $active_filters_background_color_responsive_active && $this->props["active_filters_background_color_phone"] ? $this->props["active_filters_background_color_phone"] : $active_filters_background_color_tablet;			
		$dropdown_text_background_color = $this->props["dropdown_text_background_color"];
        $dropdown_text_background_color_responsive_active = isset($this->props["dropdown_text_background_color"]) && et_pb_get_responsive_status($this->props["dropdown_text_background_color_last_edited"]);
        $dropdown_text_background_color_tablet = $dropdown_text_background_color_responsive_active && $this->props["dropdown_text_background_color_tablet"] ? $this->props["dropdown_text_background_color_tablet"] : $dropdown_text_background_color;
        $dropdown_text_background_color_phone = $dropdown_text_background_color_responsive_active && $this->props["dropdown_text_background_color_phone"] ? $this->props["dropdown_text_background_color_phone"] : $dropdown_text_background_color_tablet;
		$filter_scroll_background_color = $this->props["filter_scroll_background_color"];
		$dropdown_filters_background_color = $this->props["dropdown_filters_background_color"];
        $dropdown_filters_background_color_responsive_active = isset($this->props["dropdown_filters_background_color"]) && et_pb_get_responsive_status($this->props["dropdown_filters_background_color_last_edited"]);
        $dropdown_filters_background_color_tablet = $dropdown_filters_background_color_responsive_active && $this->props["dropdown_filters_background_color_tablet"] ? $this->props["dropdown_filters_background_color_tablet"] : $dropdown_filters_background_color;
        $dropdown_filters_background_color_phone = $dropdown_filters_background_color_responsive_active && $this->props["dropdown_filters_background_color_phone"] ? $this->props["dropdown_filters_background_color_phone"] : $dropdown_filters_background_color_tablet;	
	
		$collapse_filters_background_color = $this->props["collapse_filters_background_color"];
		$collapse_filters_background_color_responsive_active = isset($this->props["collapse_filters_background_color"]) && et_pb_get_responsive_status($this->props["collapse_filters_background_color_last_edited"]);
        $collapse_filters_background_color_tablet = $collapse_filters_background_color_responsive_active && $this->props["collapse_filters_background_color_tablet"] ? $this->props["collapse_filters_background_color_tablet"] : $collapse_filters_background_color;
        $collapse_filters_background_color_phone = $collapse_filters_background_color_responsive_active && $this->props["collapse_filters_background_color_phone"] ? $this->props["collapse_filters_background_color_phone"] : $collapse_filters_background_color_tablet;
		$collapse_icon_font_size = $this->props["collapse_icon_font_size"];
		$collapse_icon_font_size_responsive_active = isset($this->props["collapse_icon_font_size"]) && et_pb_get_responsive_status($this->props["collapse_icon_font_size_last_edited"]);
        $collapse_icon_font_size_tablet = $collapse_icon_font_size_responsive_active && $this->props["collapse_icon_font_size_tablet"] ? $this->props["collapse_icon_font_size_tablet"] : $collapse_icon_font_size;
        $collapse_icon_font_size_phone = $collapse_icon_font_size_responsive_active && $this->props["collapse_icon_font_size_phone"] ? $this->props["collapse_icon_font_size_phone"] : $collapse_icon_font_size_tablet;
		

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% #collapse_filters_svg",
			'declaration' => "fill: {$collapse_filters_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% #collapse_filters_svg",
			'declaration' => "fill: {$collapse_filters_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% #collapse_filters_svg",
			'declaration' => "fill: {$collapse_filters_background_color_phone} !important;",
			'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);


		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% #collapse_filters_svg",
			'declaration' => "height: {$collapse_icon_font_size} !important; width: {$collapse_icon_font_size} !important;",
		]);

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% #collapse_filters_svg",
			'declaration' => "height: {$collapse_icon_font_size_tablet} !important; width: {$collapse_icon_font_size_tablet} !important;",
			'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% #collapse_filters_svg",
			'declaration' => "height: {$collapse_icon_font_size_phone} !important; width: {$collapse_icon_font_size_phone} !important;",
			'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		// fnfnb
	
		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%%  .dec-filter-list li, .daterangepicker .ranges ul li",
			//'hover'       => "%%order_class%%  .dec-filter-list li:hover",
			'declaration' => "background-color: {$dropdown_text_background_color} !important;",
		]);


		if ( $dropdown_text_background_color__hover  != '' && $dropdown_text_background_color__hover_enabled ) {
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%%  .dec-filter-list li:hover,  .daterangepicker .ranges ul li:hover",
				//'hover'       => "%%order_class%%  .dec-filter-list li:hover",
				'declaration' => "background-color: {$dropdown_text_background_color__hover} !important;",
			]);
		}
		
		
		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .dec-filter-select, %%order_class%% .dec-filter-select > button",
			'declaration' => "background-color: {$dropdown_text_background_color_tablet} !important;",
			'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
		]);
		
		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .dec-filter-select, %%order_class%% .dec-filter-select > button",
			'declaration' => "background-color: {$dropdown_text_background_color_phone} !important;",
			'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
		

		// fiter text background
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-label button",
            'declaration' => "background-color: {$filter_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-label button",
            'declaration' => "background-color: {$filter_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-label button",
            'declaration' => "background-color: {$filter_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
	

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec-filter-list, %%order_class%% #Eventprice, .daterangepicker .ranges",
            'declaration' => "background-color: {$dropdown_filters_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec-filter-list, %%order_class%% #Eventprice, .daterangepicker .ranges",
            'declaration' => "background-color: {$dropdown_filters_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec-filter-list, %%order_class%% #Eventprice, .daterangepicker .ranges",
            'declaration' => "background-color: {$dropdown_filters_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

				// active filter 

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .dec-filter-select, %%order_class%% .dec-filter-select > button",
			'declaration' => "background-color: {$active_filters_background_color} !important;",
		]);
		
		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .dec-filter-select, %%order_class%% .dec-filter-select > button",
			'declaration' => "background-color: {$active_filters_background_color_tablet} !important;",
			'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
		]);
		
		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .dec-filter-select, %%order_class%% .dec-filter-select > button",
			'declaration' => "background-color: {$active_filters_background_color_phone} !important;",
			'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec-filter-scroll::-webkit-scrollbar-thumb ",
            'declaration' => "background-color: {$filter_scroll_background_color} !important;",
        ]);


		$this->apply_custom_margin_padding($render_slug, 'active_filter_margin', 'margin', 
		'%%order_class%% .dec-filter-select');
		$this->apply_custom_margin_padding($render_slug, 'active_filter_padding', 'padding', 
		'%%order_class%%  .dec-filter-select');

		$this->apply_custom_margin_padding($render_slug, 'filter_text_dropdown_padding', 'padding', 
		'%%order_class%%  .dec-filter-list  li, .daterangepicker .ranges ul li');
		$this->apply_custom_margin_padding($render_slug, 'filter_dropdown_padding', 'padding', 
		'%%order_class%%  .dec-filter-list, .daterangepicker .ranges ul');
		$this->apply_custom_margin_padding($render_slug, 'filter_margin', 'margin', 
		'%%order_class%% .dec-filter-label, %%order_class%% #dec-find-events', false);
		$this->apply_custom_margin_padding($render_slug, 'filter_padding', 'padding', 
		'%%order_class%% .dec-filter-label, %%order_class%% #dec-find-events', false);
	
		wp_enqueue_style( 'dec-date-picker-style', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css' );
		wp_enqueue_style( 'dec-fontawose-style', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style('cost-silder','https://code.jquery.com/ui/1.11.3/themes/hot-sneaks/jquery-ui.css');
		wp_enqueue_script( 'date-range-picker-js','https://cdn.jsdelivr.net/momentjs/latest/moment.min.js');
		wp_enqueue_script( 'date-range-2-js','https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js');
		wp_enqueue_script( 'cost-picker-js', 'https://code.jquery.com/ui/1.11.2/jquery-ui.js');
	    wp_enqueue_script( 'loadfilter-js', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.2.1/js/loadFilter.js', array('date-range-2-js'),'1.0.0', false);
	
		$filter_child_content =  $this->content;
		$filter_css_class =	$this->props['module_css_class'];
		$show_collapse_options = $this->props["show_collapse_options"];
		$show_collapse_options_responsive_active = isset($this->props["show_collapse_options"]) && et_pb_get_responsive_status($this->props["show_collapse_options_last_edited"]);
        $show_collapse_options_tablet = $show_collapse_options_responsive_active && $this->props["show_collapse_options_tablet"] ? $this->props["show_collapse_options_tablet"] : $show_collapse_options;
        $show_collapse_options_phone = $show_collapse_options_responsive_active && $this->props["show_collapse_options_phone"] ? $this->props["show_collapse_options_phone"] : $show_collapse_options_tablet;

		$show_collapse_options_default = $this->props["show_collapse_options_default"];
		$show_collapse_options_default_responsive_active = isset($this->props["show_collapse_options_default"]) && et_pb_get_responsive_status($this->props["show_collapse_options_default_last_edited"]);
        $show_collapse_options_default_tablet = $show_collapse_options_default_responsive_active && $this->props["show_collapse_options_default_tablet"] ? $this->props["show_collapse_options_default_tablet"] : $show_collapse_options_default;
        $show_collapse_options_default_phone = $show_collapse_options_default_responsive_active && $this->props["show_collapse_options_default_phone"] ? $this->props["show_collapse_options_default_phone"] : $show_collapse_options_default_tablet;

		$filter_output = '';

	   if($show_collapse_options == 'on' ||  $show_collapse_options_tablet == 'on' ||  $show_collapse_options_phone == 'on'){

				    $responsive_collapse_desktop ='';
					$responsive_collapse_tablet ='';
					$responsive_collapse_phone ='';

			    if($show_collapse_options == 'off'){
					$responsive_collapse_desktop = "collapse_filter_desktop";
			    }
			
			    if($show_collapse_options_tablet == 'off'){
					$responsive_collapse_tablet =  "collapse_filter_tablet";
			    }

			    if($show_collapse_options_phone == 'off'){
					$responsive_collapse_phone = "collapse_filter_phone";
			    }

		if($show_collapse_options == 'off' ||  $show_collapse_options_tablet == 'off' ||  $show_collapse_options_phone == 'off' ||
		   $show_collapse_options == 'on' ||  $show_collapse_options_tablet == 'on' ||  $show_collapse_options_phone == 'on'){		

				    $responsive_collapse_class = '';
				    $responsive_hide_filter_text = ' dec_collapse_filters_events dec-filter-toggle-text-hide-desktop';
				    $responsive_show_filter_text = 'dec_collapse_filters_events'; 

				if($show_collapse_options_default == 'on'){
					$responsive_collapse_class .= 'show_collapse_desktop';
					$responsive_hide_filter_text = 'dec_collapse_filters_events dec-filter-toggle-text-show-desktop';
					$responsive_show_filter_text = 'dec_collapse_filters_events dec-filter-toggle-text-hide-desktop';		
				}else{
					$responsive_show_filter_text .= ' dec-filter-toggle-text-show-desktop';			
				}

				if($show_collapse_options_default_tablet == 'on'){
					$responsive_collapse_class .= ' show_collapse_tablet';
					$responsive_hide_filter_text .= ' dec-filter-toggle-text-show-tablet';
					$responsive_show_filter_text .= ' dec-filter-toggle-text-hide-tablet';		
				}else{		
					$responsive_hide_filter_text .= ' dec-filter-toggle-text-hide-tablet';
					$responsive_show_filter_text .= ' dec-filter-toggle-text-show-tablet';
				}

				if($show_collapse_options_default_phone == 'on'){
					$responsive_collapse_class .= ' show_collapse_phone';
					$responsive_hide_filter_text .= ' dec-filter-toggle-text-show-phone';
					$responsive_show_filter_text .= ' dec-filter-toggle-text-hide-phone';
				}else{
					$responsive_hide_filter_text .= ' dec-filter-toggle-text-hide-phone';
					$responsive_show_filter_text .= ' dec-filter-toggle-text-show-phone';
				}
 
				$show_filter=__('Show Filters','decm-divi-event-calendar-module');
$hide_filter=__('Hide Filters','decm-divi-event-calendar-module');
				if($show_collapse_options_default == 'off' ||  $show_collapse_options_default_tablet == "off" || $show_collapse_options_default_phone == "off" ){
					$filter_output .= "<button  id='dec-event-filters-icon' class='".$responsive_collapse_desktop.' '.$responsive_collapse_tablet.' '.$responsive_collapse_phone."'><svg  height='24px' width='24px' id=\"collapse_filters_svg\"  fill=\"#000000\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xml:space=\"preserve\" version=\"1.1\" style=\"shape-rendering:geometricPrecision;text-rendering:geometricPrecision;image-rendering:optimizeQuality;\" viewBox=\"0 0 325 310\" x=\"0px\" y=\"0px\" fill-rule=\"evenodd\" clip-rule=\"evenodd\"><g><path class=\"fil0\" d=\"M190 141l95 -116 -245 0 96 116c2,3 3,6 3,9l0 104 47 23 0 -128c0,-3 2,-6 4,-8zm132 -120l-110 133 0 143c0,10 -10,16 -18,12l-73 -35c-4,-2 -8,-6 -8,-12l0 -108 -110 -133c-7,-8 -1,-21 10,-21l299 0c11,0 17,12 10,21z\"></path></g></svg><span  class='".$responsive_show_filter_text."' >$hide_filter</span><span  class='".$responsive_hide_filter_text."' >".$show_filter."</span></button>";
					$filter_output .= "<div  class='dec-search-filter  ".$responsive_collapse_class."'>"; 				
				}else{					
				
					$filter_output .= "<button  id='dec-event-filters-icon' class='".$responsive_collapse_desktop.' '.$responsive_collapse_tablet.' '.$responsive_collapse_phone."'><svg  height='24px' width='24px' id=\"collapse_filters_svg\"  fill=\"#000000\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xml:space=\"preserve\" version=\"1.1\" style=\"shape-rendering:geometricPrecision;text-rendering:geometricPrecision;image-rendering:optimizeQuality;\" viewBox=\"0 0 325 310\" x=\"0px\" y=\"0px\" fill-rule=\"evenodd\" clip-rule=\"evenodd\"><g><path class=\"fil0\" d=\"M190 141l95 -116 -245 0 96 116c2,3 3,6 3,9l0 104 47 23 0 -128c0,-3 2,-6 4,-8zm132 -120l-110 133 0 143c0,10 -10,16 -18,12l-73 -35c-4,-2 -8,-6 -8,-12l0 -108 -110 -133c-7,-8 -1,-21 10,-21l299 0c11,0 17,12 10,21z\"></path></g></svg>
					<span class=\"dec_collapse_filters_events\" >".$show_filter."</span>
					</button>";
					$filter_output .= "<div  class='dec-search-filter ".$responsive_collapse_class."'>";
				}

			}else{
				    $filter_output .= "<div  class='dec-search-filter'>"; 
			}

			}else{
				    $filter_output .= "<div  class='dec-search-filter'>"; 
			}
		$reset_button=__(' Reset ','decm-divi-event-calendar-module');
		$filter_output .= "<div class='dec-filter-wrapper'>";
    
		$filter_output .=  $filter_child_content;

		$filter_output .=   "<span id='dec-filter-remove'><i class='fa fa-undo' aria-hidden='true'></i>".$reset_button."</span></div></div>
		
		<input type='hidden' name='module-css-class' id='module-css-class' value='".$filter_css_class."' />";
		
		return $filter_output;
	}
}

new DECM_EventFilter;


