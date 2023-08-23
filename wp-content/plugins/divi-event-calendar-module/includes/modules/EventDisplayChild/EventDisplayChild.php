<?php

class DECM_EventDisplayChild extends ET_Builder_Module {

	public $slug                     = 'decm_event_filter_child';
	public $type                     = 'child';
	public $child_title_var          = 'events_filter';
	public $vb_support = 'on';

	function init() {

		$this->name             = esc_html__( 'Filter', 'decm-divi-event-calendar-module' );
		$this->advanced_setting_title_text = esc_html__( 'Add Filter','decm-divi-event-calendar-module'  );

		// Module item's modal title
		$this->settings_text = esc_html__( 'Filter Settings', 'decm-divi-event-calendar-module' );
		$this->main_css_element = '.dec-filter-bar %%order_class%%';

		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Filter', 'decm-divi-event-calendar-module' ),
					'filters_selection' => esc_html__( 'Selection', 'decm-divi-event-calendar-module' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'filter_layout'  => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					'filter_text'  => esc_html__( 'Filter Text', 'decm-divi-event-calendar-module' ),	
				//	'spacing_child'  => esc_html__( 'Spacing', 'decm-divi-event-calendar-module' ),				
				),
			),
		);
	}

	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {
		return array(

		'events_filter' => array(
			'label'           => esc_html__( 'Filters', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Here you can choose to add any of the available filters and rearrange them as needed.', 'decm-divi-event-calendar-module' ),
			'type'            => 'select',
			'options'		=>[
				'Search'   => esc_html__( 'Search', 'decm-divi-event-calendar-module' ),
				'Category'   => esc_html__( 'Category', 'decm-divi-event-calendar-module' ),    
				'Tag'   => esc_html__( 'Tag ', 'decm-divi-event-calendar-module' ),
				'Organizer'   => esc_html__( 'Organizer', 'decm-divi-event-calendar-module' ),  
				'Venue'   => esc_html__( 'Venue ', 'decm-divi-event-calendar-module' ),
				'City'   => esc_html__( 'City ', 'decm-divi-event-calendar-module' ),
				'Country'   => esc_html__( 'Country ', 'decm-divi-event-calendar-module' ),
				'State'   => esc_html__( 'State/Province', 'decm-divi-event-calendar-module' ),
				'Location'   => esc_html__( 'Location ', 'decm-divi-event-calendar-module' ),  
				'Cost'   => esc_html__( 'Cost ', 'decm-divi-event-calendar-module' ),
				'Year'   => esc_html__( 'Year ', 'decm-divi-event-calendar-module' ),  
				'Month '   => esc_html__( 'Month', 'decm-divi-event-calendar-module' ),
				'Day'   => esc_html__( 'Day ', 'decm-divi-event-calendar-module' ),  
				'Time'   => esc_html__( 'Time ', 'decm-divi-event-calendar-module' ),
				'Date Range'   => esc_html__( 'Date Range ', 'decm-divi-event-calendar-module' ),  
				'Order By'   => esc_html__( 'Order By', 'decm-divi-event-calendar-module' ),            
			],
			'default' => 'Search',
			'option_category' => 'basic_option',
			'tab_slug' => 'general',
			'toggle_slug'     => 'main_content',	
		),


		'filter_multiple_select' => array(
			'label'           => esc_html__( 'Selection Method', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Choose to allow filtering by selecting only single items or by selecting multiple items with checkboxes.', 'decm-divi-event-calendar-module' ),
			'type'            => 'select',	
			//'type'            => 'select',
			'option_category' => 'layout',
			'options'		=>[
				'single'   => __( 'Single', 'decm-divi-event-calendar-module' ),
				'multi'   => __(  'Multi', 'decm-divi-event-calendar-module' ),               
			],
			//'mobile_options'  => true,
			'tab_slug'		  => 'general',
			'toggle_slug'     => 'filters_selection',
			'show_if_not'     => array(
				'events_filter' => [
					'Search',
					'Order By',
					'Date Range',
					'Time',
					'Cost',
			],
			),

			'default' => 'single',
		),

		'filter_fullwidth'=> array(
			'label'				=> esc_html__( 'Make Fullwidth', 'decm-divi-event-calendar-module' ),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'view_more',
			'options'			 => array(
				'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
			),
			'description'		=> esc_html__( 'Choose to show the filter item as 100% width of the content area. Otherwise, it will show inline.', 'decm-divi-event-calendar-module' ),
			'tab_slug'		  => 'advanced',
		//	'mobile_options'  => true,
			'toggle_slug'     => 'filter_layout',
			'default'			=> 'off',
			'default_on_phone' => 'on',
			'show_if_not'     => array(
				'events_filter' => 'Search',
			),				
			'computed_affects'   => array(
				'events_filter',
			),
		),

		'filter_fullwidth_search'=> array(
			'label'				=> esc_html__( 'Make Fullwidth', 'decm-divi-event-calendar-module' ),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'view_more',
			'options'			 => array(
				'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
			),
			'description'		=> esc_html__( 'Choose to show the filter item as 100% width of the content area. Otherwise, it will show inline.', 'decm-divi-event-calendar-module' ),
			'tab_slug'		  => 'advanced',
			//'mobile_options'  => true,
			'toggle_slug'     => 'filter_layout',
			'default'			=> 'on',
			'show_if'     => array(
				'events_filter' => 'Search',
			),				
			'computed_affects'   => array(
				'events_filter',
			),
		),
	
		'get_filters_data' => array(
			'type' => 'computed',
			'computed_callback' => array( 'DECM_EventDisplayChild', 'get_filter_data' ),
			'computed_depends_on' => array(
				'',
			),
		),
	
	   );
	}

	function get_advanced_fields_config() {
		return array(
			'text'           => false,
			'button'         => false,	
			'filters'        => false,	
			'link_options'   => false,
			'transform'      => false,
		
			'margin_padding' => array(
				'draggable_margin'  => false,
				'draggable_padding' => false,
				'css'               => array(
					'margin'  => "%%order_class%% .dec-filter-label",
					'padding' => "%%order_class%% .dec-filter-label",
					'important' => 'all',
				),
			),

			'background'            => array(
				'has_background_color_toggle' => true,
				'css'                  => array(
					'main' =>  "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-select > button",
					'important' => 'all',
				),
				'options' => array(
					'background_color' => array(
						'depends_show_if'  => 'on',
						'default'          => 'Transparent',
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
							'border_radii' => "%%order_class%% .dec-filter-label",
							'border_styles' => "%%order_class%% .dec-filter-label",	
						),
						'important' => 'all',
					),
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
			),

			),

			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-label",
						'important' => 'all',
					),
				),

			),

			'fonts'     => array(
				'label' => array(
					'css'          => array(
						'main'      =>  "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-label > span, %%order_class%%  .dec-filter-container > ::placeholder ",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Filter', 'decm_event_filter' ),
					'description'     => esc_html__( 'Customize and style the lable text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'filter_text',
				),	
			),
					
		);
	}

	/**
	 * Render module output
	 *
	 * @since 1.0.0
	 *
	 * @param array  $attrs       List of unprocessed attributes
	 * @param string $content     Content being processed
	 * @param string $render_slug Slug of module that is used for rendering output
	 *
	 * @return string module's rendered output
	 */

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

		$filter_select =  $this->props['filter_multiple_select'];
	    $filter_titles	= $this->props['events_filter'];
		$dec_filter_fullwidth	= $this->props['filter_fullwidth'];
		$dec_filter_fullwidth_search	= $this->props['filter_fullwidth_search'];
        // $filter_fullwidth_responsive_active = isset($this->props["filter_fullwidth"]) && et_pb_get_responsive_status($this->props["filter_fullwidth_last_edited"]);
        // $filter_fullwidth_tablet = $filter_fullwidth_responsive_active && $this->props["filter_fullwidth_tablet"] ? $this->props["filter_fullwidth_tablet"] : $filter_fullwidth;
        // $filter_fullwidth_phone = $filter_fullwidth_responsive_active && $this->props["filter_fullwidth_phone"] ? $this->props["filter_fullwidth_phone"] : $filter_fullwidth_tablet;	

		if($dec_filter_fullwidth_search == "off"){
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%%",
				'declaration' => "display:inline-block !important;",
			]);
		}

		// if($filter_fullwidth_phone == "on"){
		// 	\ET_Builder_Element::set_style($render_slug, [
		// 		'selector'    => "%%order_class%%",
		// 		'declaration' => "display:block !important;",
		// 		'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		// 	]);
		// }

		if($dec_filter_fullwidth == "on"){
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%%",
			'declaration' => "display:block !important;",
        ]);

	
	    }

		$filter_output = '';
		$keyword=__('Keyword','decm-divi-event-calendar-module');
		$search=__('Search','decm-divi-event-calendar-module');
		   switch ($filter_titles){
			case 'Search':
			$filter_output .= "<div class='dec-filter-header'>
				<div class='dec-filter-container'>	
						<input class='dec-filter-search__input dec-filter-label' name='dec-filter-search__input'  type='text' id='dec-filter-search__input'  placeholder='".$keyword."' />
						</div>
						<button type='submit' id='dec-find-events' class='dec-search-filter-button'>".$search."</button>	
					</div>";
			break;
			case 'Venue':
				$venue_keyword=__('Venue','decm-divi-event-calendar-module');
				$args = array(
					'post_type' => 'tribe_venue',
				);
				$loop = new WP_Query($args);

				if($filter_select == 'multi'){
						$output = "<ul>";
						while($loop->have_posts()): $loop->the_post();	
						$output .= '<li class="dec-venue-checkbox"><label for='.get_the_ID().' >
						<input type=\'checkbox\' name=\'dec_filter_venue\' id='.get_the_ID().' value='.get_the_title().'  /> '.get_the_title().'</label></li>';
						endwhile;
						wp_reset_postdata();
						$output .= "</ul>";	
				}else{
						$output = "<ul>";
						while($loop->have_posts()): $loop->the_post();	
						$output .= '<li class="dec-venue-list" data-id='.get_the_ID().'>'.get_the_title().'</li>';
						endwhile;
						wp_reset_postdata();
						$output .= "</ul>";
				}

				$filter_output .= "<div class='dec-filter-bar dec-venue-filter'>
				<div class='dec-filter-label'>
				<span>".$venue_keyword."</span><span id='dec-venue-current-select'></span>
				<button type='button' class ='dec-venue-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-venue-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
				
			break;

			case 'Cost':
				$cost_keyword=__('Cost','decm-divi-event-calendar-module');
				$maximum_cost = tribe_get_maximum_cost();
				$filter_output .=   "
				<div class='dec-filter-bar dec-filter-cost'>
						<div class='dec-filter-label'>
							<span >".$cost_keyword."</span><span id='dec-price-current-select'></span>
							<button type='button' class ='dec-price-remove'>×</button>
						</div>      
				</div>";
				$filter_output .= "<div class='dec-price-filter-list dec-filter-list'>
                            <input type='text' id='Eventprice' style='border:0; font-weight:bold;' readonly >
							<input type='hidden' id='EventcostValue' name='EventcostValue' value=".$maximum_cost.">
							<div id='eventCostslider'></div>";
				$filter_output .= '</div>';

			break;
			case 'Order By':
				$orderBy_keyword=__('Order By','decm-divi-event-calendar-module');
				$filter_output .=   "
				<div class='dec-filter-bar dec-filter-order-by'>
						<div class='dec-filter-label'>
							<span >".$orderBy_keyword."</span><span id='dec-order-current-select'></span>
							<button type='button' class ='dec-order-remove'>×</button>
			     		</div> ";

				$filter_output .= "<div class='dec-order-filter-list dec-filter-list'>";
			
				if($filter_select == 'multi'){
					$filter_output .= "<ul><li><input type='checkbox' class ='order' name='order' id='DESC' value='Descending'  />
					<label for='DESC'>'".__('Descending','decm-divi-event-calendar-module')."</label><br></li>
					<li><input type='checkbox' name='order' class ='order' id='ASC' value='Ascending'  />
					<label for='ASC'>'".__('Ascending','decm-divi-event-calendar-module')."</label><br></li> 
					</ul>";
				}else{
					$filter_output .= "<ul><li data-id='ASC'>Descending</li>
				    <li data-id='DESC'>Ascending</li></ul>";
				}
				
				$filter_output .= '</div></div>';
			break;
			case 'Location':
				$location_keyword=__('Location','decm-divi-event-calendar-module');
				$args = array(
					'post_type' => 'tribe_venue',
				);
				$loop = new WP_Query($args);

				if($filter_select == 'multi'){
					        $output = "<ul>";
							while($loop->have_posts()): $loop->the_post();
							if(!empty(tribe_get_address(get_the_ID()))){	
							$output .= '<li class="dec-location-checkbox"><label for='.get_the_ID().'_1'.' >
							<input type=\'checkbox\' name=\'dec_filter_location\' id='.get_the_ID().'_1'.'  value="'.tribe_get_address(get_the_ID()).'" /> '.tribe_get_address(get_the_ID()).'</label></li>';
							}
							endwhile;
							wp_reset_postdata();
							$output .= "</ul>";		
			    }else{
							$output = "<ul>";
							while($loop->have_posts()): $loop->the_post();	
							if(!empty(tribe_get_address(get_the_ID()))){
							$output .= '<li class="dec-location-list" data-id='.get_the_ID().'>'.tribe_get_address(get_the_ID()).'</li>';
							}
							endwhile;
							wp_reset_postdata();
							$output .= "</ul>";
			    }
				$filter_output .= "
				<div class='dec-filter-bar dec-filter-location'>
						<div class='dec-filter-label'>
							<span >".$location_keyword."</span><span id='dec-location-current-select'></span>
							<button type='button' class ='dec-location-remove'>×</button>
						</div>";

				$filter_output .= "<div class='dec-location-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
			break;
			case 'Date Range':
				$dateRange_keyword=__('Date Range','decm-divi-event-calendar-module');
				$filter_output .= "
				<div class='dec-filter-bar dec-filter-date-range'>
						<div class='dec-filter-label' id='reportrange'>
								<span id='dec-date-current-select'>".$dateRange_keyword."</span>
								<button type='button' class ='dec-date-range-remove'>×</button>
						</div>    
				</div>";
			break;
			case 'City':
				$city_keyword =__('City','decm-divi-event-calendar-module');
				$args = array(
					'post_type' => 'tribe_venue',
				);
				$loop = new WP_Query($args);

				if($filter_select == 'multi'){
							$output = "<ul>";
							while($loop->have_posts()): $loop->the_post();	
							if(!empty(tribe_get_city(get_the_ID()))){
							$output .= '<li class="dec-city-checkbox"><label for='.get_the_ID().'_2'.' >
							<input type=\'checkbox\' name=\'dec_filter_city\' id='.get_the_ID().'_2'.'  value="'.tribe_get_city(get_the_ID()).'" /> '.tribe_get_city(get_the_ID()).'</label></li>';
							}
							endwhile;
							wp_reset_postdata();
							$output .= "</ul>";	
					}else{

							$output = "<ul>";
							while($loop->have_posts()): $loop->the_post();	
							if(!empty(tribe_get_city(get_the_ID()))){
							$output .= '<li class="dec-city-list" data-id='.get_the_ID().'>'.tribe_get_city(get_the_ID()).'</li>';
							}
							endwhile;
							wp_reset_postdata();
							$output .= "</ul>";
			    }

				$filter_output .= "<div class='dec-filter-bar dec-city-filter'>
				<div class='dec-filter-label'>
				<span>".$city_keyword."</span><span id='dec-city-current-select'>
				</span>
				<button type='button' class ='dec-city-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-city-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
			break;
			case 'Country':
				$country_keyword=__('Country','decm-divi-event-calendar-module');
				$args = array(
					'post_type' => 'tribe_venue',
				);
				$loop = new WP_Query($args);
				$countryArray = array();
				while($loop->have_posts()): $loop->the_post();	
				$countryArray[get_the_ID()] = tribe_get_country(get_the_ID());
				endwhile;
				wp_reset_postdata();

				$countries = array_filter(array_unique($countryArray));

			if($filter_select == 'multi'){
					$output = "<ul>";
					foreach((array) $countries as $index => $value) {
						$output .= '<li  class="dec-country-checkbox"><label for='.$index.'_3'.' >
						<input type=\'checkbox\' name=\'dec_filter_country\' id='.$index.'_3'.'  value="'.$value.'" /> '.$value.'</label></li>';
					  }	
					$output .= "</ul>";	
			}else{
				$output = "<ul>";
				foreach((array) $countries as $index => $value) {
				   $output .= '<li  class="dec-country-list" data-id='.$index.'>'.$value.'</li>';
				}
				$output .= "</ul>";
			}

				$filter_output .= "<div class='dec-filter-bar dec-country-filter'>
				<div class='dec-filter-label'>
				<span>".$country_keyword."</span><span id='dec-country-current-select'></span>
				<button type='button' class ='dec-country-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-country-filter-list dec-filter-list'>
				<span class='dec-country-filter-selection-list'></span>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
			break;
			case 'State':
				$state_keyword=__('State/Province','decm-divi-event-calendar-module');
				$args = array(
					'post_type' => 'tribe_venue',
				);
				$loop = new WP_Query($args);

				if($filter_select == 'multi'){
							$output = "<ul>";
							while($loop->have_posts()): $loop->the_post();	
							if(!empty(tribe_get_province(get_the_ID()))){
							$output .= '<li  class="dec-state-checkbox"><label for='.get_the_ID().'_4'.' >
							<input type=\'checkbox\' name=\'dec_filter_state\' id='.get_the_ID().'_4'.'  value="'.tribe_get_province(get_the_ID()).'" /> '.tribe_get_province(get_the_ID()).'</label></li>';
							}
							endwhile;
							wp_reset_postdata();
							$output .= "</ul>";		
		        }else{
							$output = "<ul>";
							while($loop->have_posts()): $loop->the_post();	
							if(!empty(tribe_get_province(get_the_ID()))){
							$output .= '<li  class="dec-state-list" data-id='.get_the_ID().'>'.tribe_get_province(get_the_ID()).'</li>';
							}
							endwhile;
							wp_reset_postdata();
							$output .= "</ul>";

			     }

				$filter_output .= "<div class='dec-filter-bar dec-state-filter'>
				<div class='dec-filter-label'><span>".$state_keyword."</span><span id='dec-state-current-select'></span>
				<button type='button' class ='dec-state-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-state-filter-list dec-filter-list'>
				<span class='dec-state-filter-selection-list'></span>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
			break;
			case 'Year':
				$year_keyword=__('Year','decm-divi-event-calendar-module');
				$decm_filters_years = array(
					'2019'  => '2019',
					'2020'  => '2020',
					'2021'  => '2021',
					'2022'  => '2022',	
				);


				$filter_output .= "<div class='dec-filter-bar dec-filter-year'>
				<div  class='dec-filter-label'>
				<span >".$year_keyword."</span><span id='dec-year-current-select'></span>
				<button type='button' class ='dec-year-remove'>×</button>
				 </div>";				
				$filter_output .= "<div class='dec-year-filter-list dec-filter-list'>";
				if($filter_select == 'multi'){
    				foreach((array) $decm_filters_years as $index => $value) {
						$filter_output .=  "<li class='dec-years-checkbox' ><label for=".$index." >
						<input type='checkbox' name='dec_filter_years' id=".$index." value=".$index."  /> ".$value."</label></li>";
					  }	
				}else{
					foreach((array) $decm_filters_years as $index => $value) {
						$filter_output .=  "<li class='dec-years-list'  data-id=".$index.">". $value."</li>";
					  }			
				}	
				$filter_output .= '</div></div>';
			break;
			case 'Month ':
				$month_keyword=__('Month','decm-divi-event-calendar-module');
				$decm_filters_months = array(
				  '01'  => __('January','decm-divi-event-calendar-module'),
				  '02'  =>__('February','decm-divi-event-calendar-module'), 
				  '03'  =>__('March','decm-divi-event-calendar-module'),
				  '04'  =>__('April','decm-divi-event-calendar-module'), 
				  '05'  =>__('May','decm-divi-event-calendar-module'), 
				  '06'  => __('June','decm-divi-event-calendar-module'),
				  '07'  => __('July','decm-divi-event-calendar-module'),
				  '08'  => __('August','decm-divi-event-calendar-module'),
				  '09'  =>__('September','decm-divi-event-calendar-module'), 
				  '10'  => __('October','decm-divi-event-calendar-module'),
				  '11'  => __('November','decm-divi-event-calendar-module'),
				  '12'  =>__('December','decm-divi-event-calendar-module'), 
				);
				$filter_output .= "<div class='dec-filter-bar dec-filter-month'>
				<div  class='dec-filter-label'>
				<span >".$month_keyword."</span><span id='dec-month-current-select'></span>
				<button type='button' class ='dec-month-remove'>×</button>
				 </div>";

				$filter_output .= "<div class='dec-month-filter-list dec-filter-list'>";

				if($filter_select == 'multi'){
    				foreach((array) $decm_filters_months as $index => $value) {
						$filter_output .=  "<li  class='dec-months-checkbox'><label for=".$index." >
						<input type='checkbox' name='dec_filter_months' id=".$index." value=".$value."  /> ".$value."</label></li>";
					  }	
				}else{
					foreach((array) $decm_filters_months as $index => $value) {
						$filter_output .=  "<li  class='dec-months-list' data-id=".$index.">". $value."</li>";
					  }	
					
				}

				$filter_output .= '</div></div>';

			break;
			case 'Organizer':
				$organizers = tribe_get_organizers();
				if($filter_select == 'multi'){
					    $output = "<ul>";
							foreach ((array) $organizers as $organizer ) {
								$output .= '<li class="dec-organizer-checkbox"><label for='.$organizer->ID.' >
								<input type=\'checkbox\' name=\'dec_filter_organizer\' id='.$organizer->ID.'  value="'.$organizer->post_title.'" /> '.$organizer->post_title.'</label></li>';
								}
					    $output .= "</ul>";		
					}else{
						$output = "<ul>";
							foreach ((array) $organizers as $organizer ) {
								$output .= '<li class="dec-organizer-list" data-id='.$organizer->ID.'>'.$organizer->post_title.'</li>';
							}
		        		$output .= "</ul>";		
				}
		
				$filter_output .= "<div class='dec-filter-bar dec-organizer-filter'>
				<div class='dec-filter-label'>
				<span>".__('Organizer','decm-divi-event-calendar-module')."</span><span id='dec-organizer-current-select'></span>
				<button type='button' class = 'dec-organizer-remove'>×</button></div>";
				
				$filter_output .= "<div class='dec-organizer-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
				
			break;
			case 'Category':
				$categories = get_categories( array(
					'taxonomy' => 'tribe_events_cat',
				) );

				if($filter_select == 'multi'){
					$output = "<ul>";
					foreach ((array)  $categories as $category ) {
							$output .= '<li class="decm-filter-catrgory-checkbox"><label for='.$category->term_id.' >
							<input type=\'checkbox\' name=\'dec_filter_category\' id='.$category->term_id.'  value="'.$category->name.'" /> '.$category->name.'</label></li>';
							}
					$output .= "</ul>";		
				}else{

					$output = "<ul>";
					foreach ((array)  $categories as $category ) {
						$output .= '<li class ="decm-filter-catrgory-list" data-id='.$category->term_id.'>'.$category->name.'</li>';
					}
					$output .= "</ul>";

				}

				$filter_output .= "<div class=' dec-filter-bar dec-filter-event-category'>
				<div  class=' dec-filter-label'><span>".__('Category','decm-divi-event-calendar-module')."</span><span id='dec-event-current-select'></span>
				<button type='button' class = 'dec-category-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-event-category-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';		

			break;

			case 'Tag':
				$tag_keyword=__('Tag','decm-divi-event-calendar-module');
				$tags = get_categories( array(
					'taxonomy' => 'post_tag',
				) );

				if($filter_select == 'multi'){
					$output = "<ul>";
					foreach ((array)  $tags as $tag ) {
							$output .= '<li class ="dec-tag-checkbox"><label for='.$tag->term_id.' >
							<input type=\'checkbox\' name=\'dec_filter_tag\' id='.$tag->term_id.'  value="'.$tag->name.'" /> '.$tag->name.'</label></li>';
							}
					$output .= "</ul>";		
				}else{

					$output = "<ul>";
					foreach ((array)  $tags as $tag ) {
						$output .= '<li class ="dec-tag-list" data-id='.$tag->term_id.'>'.$tag->name.'</li>';
					}
					$output .= "</ul>";
				}


				$filter_output .= "<div class='dec-filter-bar dec-filter-tag'>
				<div  class='dec-filter-label'>
				<span >".$tag_keyword."</span><span id='dec-tag-current-select'></span>
				<button type='button' class = 'dec-tag-remove'>×</button>
				 </div>";
				
				$filter_output .= "<div class='dec-tag-filter-list  dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';
			break;	
			case 'Day':
				$day_keyword=__('Day','decm-divi-event-calendar-module');
				$decm_filters_days = array(
					'Sunday'  => __('Sunday','decm-divi-event-calendar-module'),
					'Monday'  =>  __('Monday','decm-divi-event-calendar-module'),
					'Tuesday'  =>  __('Tuesday','decm-divi-event-calendar-module'),
					'Wednesday'  => __('Wednesday','decm-divi-event-calendar-module'), 
					'Thursday'  =>  __('Thursday','decm-divi-event-calendar-module'),
					'Friday'  =>  __('Friday','decm-divi-event-calendar-module'),
					'Saturday'  =>  __('Saturday','decm-divi-event-calendar-module'),
				  );

				$filter_output .= "<div class='dec-filter-bar dec-filter-day'>
				<div  class='dec-filter-label'>
				<span >".$day_keyword."</span><span id='dec-day-current-select'></span>
				<button type='button' class = 'dec-day-remove'>×</button>
				 </div>";

				$filter_output .= "<div class='dec-day-filter-list dec-filter-list'>";
				 if($filter_select == 'multi'){
    				foreach((array) $decm_filters_days as $index => $value) {
						$filter_output .=  "<li class ='dec-days-checkbox'><label for=".$index." >
						<input type='checkbox' name='dec_filter_days' id=".$index." value=".$value."  /> ".$value."</label></li>";
					  }	
				}else{
					foreach((array) $decm_filters_days as $index => $value) {
						$filter_output .=  "<li class ='dec-days-list'  data-id=".$index.">". $value."</li>";
					  }	
				}	
				$filter_output .= '</div></div>';

			break;	
			case 'Time':
				$time_keyword=__('Time','decm-divi-event-calendar-module');
				$decm_filters_Days = array(
					'allDays'  =>__('All Day','decm-divi-event-calendar-module'),
					'morning'  => __('Morning','decm-divi-event-calendar-module'),
					'afternoon'  =>__('Afternoon','decm-divi-event-calendar-module'),
					'evening'  => __('Evening','decm-divi-event-calendar-module'),
					'night'  =>__('Night','decm-divi-event-calendar-module') ,	
				  );

				$filter_output .= "<div class='dec-filter-bar dec-filter-time'>
				<div  class='dec-filter-label'>
				<span >".$time_keyword."</span><span id='dec-time-current-select'></span>
				<button type='button' class = 'dec-time-remove'>×</button>
				 </div>";
				 $filter_output .= "<div class='dec-time-filter-list dec-filter-list'><ul>";

				//  if($filter_select == 'multi'){
    			// 	foreach((array) $decm_filters_Days as $index => $value) {
				// 		$filter_output .=  "<li><input type='checkbox' name='time' id=".$index." value=".$value."  />
				// 		<label for=".$index." >".$value."</label><br></li>";
				// 	  }	
				// }else{
				  foreach((array) $decm_filters_Days as $index => $value) {
						$filter_output .=  "<li class='dec-time-list' data-id=".$index.">". $value."</li>";
				  }				
				//}

				$filter_output .= '</div></div>';
			break;

		}

		return sprintf('%s', $filter_output);		 
		//$filter_titles_html .=  $filter_output;		
		 //  return  $this->_render_module_wrapper( $filter_output, $render_slug );		 
		}

		public function get_filter_data($post_args){

			$decm_tag_array = array();
			$decm_event_category = array();
			$decm_venue = array();
			$decm_venueCity = array();
			$decm_venueCountry = array();
			$decm_venueState = array();
			$decm_venueAddress = array();
			$decm_organizerData = array();
			$maximum_cost = tribe_get_maximum_cost();


			$tags = get_categories( array(
				'taxonomy' => 'post_tag',
			) );
			
			foreach ((array)  $tags as $tag ) {
				$decm_tag_array[] = $tag->name;
			}

			$categories = get_categories( array(
				'taxonomy' => 'tribe_events_cat',
			) );
		
			foreach ((array)  $categories as $category ) {
				$decm_event_category[] = $category->name;
			}

			$args = array(
				'post_type' => 'tribe_venue',
			);
			$loop = new WP_Query($args);
			while($loop->have_posts()): $loop->the_post();	
					$decm_venue[] = get_the_title();
					$decm_venueCity[] =  tribe_get_city(get_the_ID());
					$decm_venueCountry[] =  tribe_get_country(get_the_ID());
					$decm_venueState[] =  tribe_get_province(get_the_ID());
					$decm_venueAddress[] =  tribe_get_address(get_the_ID());
			endwhile;

			$organizers = tribe_get_organizers();
		
			foreach ((array) $organizers as $organizer ) {
				$decm_organizerData[] = $organizer->post_title;
			}
			
			$decm_filterData = array(
				'tag' => $decm_tag_array, 
				'category' => $decm_event_category,
				'venue' => $decm_venue,
				'city' => $decm_venueCity,
				'country' => $decm_venueCountry,
				'state' => $decm_venueState,
				'address' => $decm_venueAddress,
				'organizer' => $decm_organizerData,
				'maxCost' => $maximum_cost,
			);
			return $decm_filterData;
	}
	
}

new DECM_EventDisplayChild;
