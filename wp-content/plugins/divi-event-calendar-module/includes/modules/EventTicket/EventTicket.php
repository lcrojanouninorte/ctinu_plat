<?php

class DCET_EventTicket extends ET_Builder_Module {

	public $slug       = 'dcet_event_ticket';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Ticket', 'decm-divi-event-calendar-module' );
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
  
		  );
	  }
	  public function get_fields() {
		  return array(
  
		  
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

			  'show_price' => array(
				  'label'				=> esc_html__( 'Show Price', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event price.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'elements',
				  'computed_affects'   => array(
					  '__posts',
					  '__getEvents',
				  ),
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),

			 

			  /* Content Options from Blog Module */



  
			  '__posts' => array(
				  'type' => 'computed',
				  'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				  'computed_depends_on' => array(
					  ''
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
				  'computed_callback' => array( 'DCET_EventTicket', 'get_blog_posts_events' ),
				  'computed_depends_on'  => array(
                     '',					  
  
				  ),
			  ),

		  );
	  }
	  
  

	  public function render( $attrs, $content = null, $render_slug ) {
		//   echo '<pre>';
		//   print_r($this->props);
		//   exit;
		  $atts = array();
		  $use_shortcode = $this->props['use_shortcode'];
		  $shortcode_param = $this->props['shortcode_param'];

		  $show_price = $this->props['show_price'];

		
		  //'time_format',
	
		  // $layout = $this->props['layout'];
		  $layout = '';
		  //$columns_phone = $this->props['columns_phone'];
		//   $columns_tablet = '';
		   $Column_Type = "1";

		  $attr = (array)null;
		  if ( $use_shortcode === 'on' ) {
			  parse_str(strtr($shortcode_param, ' ', '&'), $attr);
		  } else {
			  
			  
			  $contentorder = 'title, title2,show_past_notification,description, date, venue, location, google_link, venue_phone, venue_weburl, organizer, organizer_phone, organizer_email, organizer_weburl, event_tag, price,categories, excerpt,weburl,addcalendarbutton,showcalendar,showical,showoutlook,googlemap,showdetail';
			  
			  $attr = array(
				//   'cat' => $included_categories,
				//   'month' => ''
				  'price' => $show_price == 'on' ? 'true' : 'false',

				  'schema' => 'true',
				  'message' => 'This Event has passed.',
				  'key' => 'End Date',
				  'order' => 'ASC',
				  'orderby' => 'meta_value',
				  'viewall' => 'false',
				//   'thumbheight' => '800',
				  'contentorder' => apply_filters( 'ecs_default_contentorder', $contentorder, $atts ),
				  'event_tax' => '',
				  'layout' => $layout,
				  'columns' => $Column_Type,


			  );
		  
	  }
	  
	  wp_enqueue_style('bootstrap_style','https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.1/css/bootstrap.min.css');
	  
		  return sprintf( '%1$s'
			  
			  
			  , $this->ecs_fetch_events( $attr)
			  , $this->module_id()
			   , $this->module_classname( $render_slug )
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

		  if (!  class_exists( 'Tribe__Tickets__Main' ) ) {
			return "";
		}
		  $output = '';
	  
  $custom_icon='';
  $custom_icon_load='';
		  $atts = shortcode_atts( apply_filters( 'ecs_shortcode_atts', array(
			//   'show_data_one_line'=> 'false',
			//   'cat' => '',
			//   'month' => '',
			  'limit' => 5,

			  'price' => null,
	
			  'schema' => 'true',
			  'message' => 'There are no upcoming %s at this time.',
			  'key' => 'End Date',
			  'order' => 'ASC',
			  'orderby' => 'startdate',
			  'viewall' => 'false',

			  'contentorder' => apply_filters( 'ecs_default_contentorder', ' thumbnail,title, title2,show_past_notification,description, date, venue, location, google_link, venue_phone, venue_weburl, organizer, organizer_phone, organizer_email, organizer_weburl, event_tag, price, categories, excerpt,weburl,googlemap, showdetail', $atts ),

			  'layout' => '',
			  'columns' => '',

			  'columns_phone' => '',
			  'columns_tablet' => '',
			//   'act-view-more et_pb_button' => '',
			//   'header_level' => '',
			//   'included_categories' => '',
			//   'show_preposition'=>'false',
			  'use_current_loop' => 'false',
			  
  
		  ), $atts ), $atts, 'ecs-list-events' );
  
  
		  $atts = apply_filters( 'ecs_atts_pre_query', $atts );
		    
  
		  $event_id = get_the_ID();
  
		  $args = apply_filters( 'ecs_get_events_args', array(
			  'post_status' => 'publish',
			  'posts_per_page' => 1,
			  'start_date'   => '1900-10-01 00:01',
			  'end_date'     => '3030-10-31 23:59',
			  
		  ), $atts );
		  	
  
		  if($post_type == 'tribe_events'){
			  $args['ID'] = $event_id;
		  }

		  $event_posts = tribe_get_events( $args );
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
  
  
  
					  
			  $output .= apply_filters( 'ecs_start_tag', '<div class="append_events row_equal row ecs-event-list">', $atts );
			  $atts['contentorder'] = explode( ',', $atts['contentorder'] );

			  foreach( (array) $event_posts as $post_index => $event_post ) {
				  
				  setup_postdata( $event_post->ID );
				  
				  $event_output = '';
				  if ( apply_filters( 'ecs_skip_event', false, $atts, $event_post ) )
					  continue;

  
				  $event_output .= apply_filters( 'ecs_event_start_tag', '<div class=" '.$columns_desktop.' '.$columns_tablet.' '.$columns_phone.' ecs-event ecs-event-posts clearfix"> ', $atts, $post );
				  
// echo '<pre>';
// print_r(Tribe__Tickets__Tickets::get_price_html( $event_post->ID ));


				  foreach ( apply_filters( 'ecs_event_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					  
					  switch ( trim( $contentorder ) ) {
						  
										case 'event_tag':
											$event_output .=(new Tribe__Tickets__Tickets_View)->get_rsvp_block( $event_post->ID,$echo = false);

											break;
							  case 'price':
								  if ( self::isValid( $atts['price'] ) ) {
									  if(tribe_get_cost( $event_post->ID, true )!=null){
									$event_output.=	(new Tribe__Tickets__Tickets_View)->get_tickets_block( $event_post->ID,$echo = false);
								  }
								  //else{}
							  }
								  
								  break;	
		
						  default:
							  $event_output .= apply_filters( 'ecs_event_list_output_custom_' . strtolower( trim( $contentorder ) ), '', $atts, $event_post );
					  }
				  
				  }
				  $event_output .= '</div>';
				  
				  
							  
				  
				  // $event_output .= apply_filters( 'ecs_event_end_tag', '</li>', $atts, $post );
				 // $event_output .= apply_filters( 'ecs_event_end_tag', '</article></div>', $atts, $event_post );
  
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

	$check_event_ticket=!class_exists( 'Tribe__Tickets__Main')?true:false;
		$atts = shortcode_atts( apply_filters( 'ecs_shortcode_atts', array(
			'cat' =>"",
			'month' => '',
			'limit' => "",
			'eventdetails' => 'true',
			'showtime' => 'true',
			'show_timezone' => 'true',
		   // 'show_pagination'=>'true',
			'time' => null,
			'show_google_map'=>'true',
			'past' => "",
			'venue' => 'false',
			'google_link'=>'false',
			'venue_phone'=>'false',
			'venue_weburl'=>'false',
			'location' => 'false',
			'organizer' => null,
			'organizer_phone'=>'false',
			'organizer_email'=>'false',
			'organizer_weburl'=>'false',
			'price' => null,
			'weburl' => null,
			'categories' => 'false',
			'event_tag' =>'false',
			'schema' => 'true',
			'message' => 'This Event has passed.',
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
			'add_url'=>$check_event_ticket,
			 

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
			'posts_per_page' => 1,
			//'tax_query'=> $atts['event_tax'],

			// 'order' => $atts['order'],
			//'offset' => $atts['blog_offset'],
			//'included_categories' =>  $atts['included_categories'],
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
						$category_names[] = '<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>';
						
					}
				}

				$get_end_time_offset=Tribe__Events__Timezones::event_end_timestamp( $event_post->ID,get_option('gmt_offset'));

$get_current_time_offset=strtotime( gmdate('Y-m-d H:i:s')) + get_option( 'gmt_offset' ) * 3600 ;



				foreach ( apply_filters( 'ecs_event_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					switch ( trim( $contentorder ) ) {
					  case'pass_message':
						  if($get_end_time_offset < $get_current_time_offset) {
							  $atts['posts'][$index]['pass_message'] =$atts['message'];
						  }
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
							
							$atts['posts'][$index]['weburl' ]=" ".tribe_get_event_website_link($event_post);
						break;
						case 'organizer':
						  $organizers = tribe_get_organizer_ids($event_post->ID );
							  $orgName = array();
							  foreach ($organizers as $key => $organizerId) {
								  $orgName[$key] = tribe_get_organizer($organizerId);
						  }
						  $atts['posts'][$index]['organizer'] = $orgName;
							  //$event_output.='</div>';
						  break;
					  //   case 'organizer':
					  // 		  $atts['posts'][$index]['organizer']=  " by ".tribe_get_organizer($event_post->ID);
					  // 		  //$event_output.='</div>';
					  // 	  break;
					  
							case 'organizer_phone':
					  
								$atts['posts'][$index]['organizer_phone'] =" ".tribe_get_organizer_phone($event_post->ID);
					  
							break;
						case 'organizer_weburl':
					  
								$atts['posts'][$index]['organizer_weburl'] =" ".tribe_get_organizer_website_link($event_post->ID);
					  
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
								$atts['posts'][$index]['location'] = tribe_get_full_address($event_post->ID); 
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
								$categories_separator = $categories ? ' | ' : '';
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

}

new DCET_EventTicket;
