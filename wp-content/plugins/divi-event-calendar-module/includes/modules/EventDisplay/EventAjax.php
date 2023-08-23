<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


function event_attr_isValid( $prop )
{
  return ( $prop !== 'false' );
}

function event_attr_get_excerpt( $post_id,$limit, $source = null )
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

// function test(){
//   echo 'test';
// }


function decm_dateRange($begin, $end, $interval = null)
{
    $begin = new DateTime($begin);
    $end = new DateTime($end);
    // Because DatePeriod does not include the last date specified.
    $end = $end->modify('+1 day');
    $interval = new DateInterval($interval ? $interval : 'P1D');

    return iterator_to_array(new DatePeriod($begin, $interval, $end));
}



function decm_dateFilter(array $daysOfTheWeek)
{
    return function ($date) use ($daysOfTheWeek) {
        return in_array($date->format('l'), $daysOfTheWeek);
    };
}

function decm_years_Filter(array $years)
{
    return function ($date) use ($years) {
        return in_array($date->format('Y'), $years);
    };
}

function decm_months_Filter(array $months)
{
    return function ($date) use ($months) {
        return in_array($date->format('m'), $months);
    };
}


function  decm_timeFilter($start_time, $end_time, $time) {

 $start_range_time = strtotime($start_time);

//  print_r($time);

    if(in_array("morning", $time)){ 
      if($start_range_time  >= strtotime('6:00 am') && strtotime('11:59 am') >= $start_range_time ){      
     //  echo 'test value';
        return 'morning';
      }  
    }else if(in_array("afternoon", $time)){
      if($start_range_time  >= strtotime('12:00 pm') && strtotime('4:59 pm') >= $start_range_time ){
        return 'afternoon';
      }  
    }else if(in_array("evening", $time)){
      if($start_range_time  >= strtotime('5:00 pm') && strtotime('8:59 pm') >= $start_range_time ){
        return 'evening';
      } 
    }else if(in_array("night", $time)){
      if(($start_range_time  >= strtotime('9:00 pm') && strtotime('11:59 pm')  >= $start_range_time) ||
         ($start_range_time  >= strtotime('12:00 am') && strtotime('5:59 am') >= $start_range_time) 
      ){
        return 'night';
      } 
    }else{
        return 'allDays';
  }

}

//function display($date) { echo $date->format("Y-m-d H:i")."<br>"; }


function eventfeed_ajax_fetch_events( $atts, $eventfeed_current_pagination_page, $current_page, $categId,$categslug,$term_id, $filter_category, $filter_organizer, $filter_tag ,$filter_venue, $filter_search, $filter_time,$filter_day,$filter_month,$filter_year,$maxCost,$minCost,$event_startDate,$event_endDate, $event_filter_country, 
$event_filter_city,$event_filter_state, $event_filter_address,$event_filter_order,$module_class_check) {
  global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content,$wpdb;
  $post_type = get_post_type();
  $query_args['paged'] = $paged;

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
  'limit' => 6,
  'website_link'=> "",
  'custom_website_link_target'=>"",
  'custom_website_link_text'=>"",
  'custom_event_link_target'=>"",
  'disable_event_title_link'=>"",
  'disable_event_image_link'=>"",
  'disable_event_button_link'=>"",
  'single_event_page_link'=>"",
  'custom_event_link_url'=>'',
  'events_to_load' => 2,
  'show_callout_box' => 'true',
  'button_make_fullwidth'=> '',
  'featured_events' => 'false',
  'show_callout_date' => 'true',
  'show_end_time' => 'true',
  'callout_date_format'=>"",
	'show_callout_month' => 'true',
  'callout_month_format'=>"",		
	'show_callout_year' => 'true',
  'enable_category_links' => 'true',
  'callout_year_format'=>"",	
	'show_callout_day_of_week' => 'true', 
  'callout_week_format'=>"",
  'show_recurring_events'=> '',
  'stack_label_icon'=>'true',
  'eventdetails' => 'true',
  'showtime' => 'true',
  'show_timezone' => 'true',
  'showtitle' => 'true',
  'show_pagination'=>'true',
  'show_ical_export'=>'true',
  'show_google_calendar'=>'true',
  'time' => null,
  'past' => '',
  'venue' => 'false',
  'location' => 'false',
  'location_street_address' => 'true',
	'location_locality' => 'true',
	'location_postal_code' => 'true',
	'location_country' => 'true',
  'organizer' => null,
  'price' => null,
  'weburl' => null,
  'categories' => 'false',
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
  'contentorder' => apply_filters( 'ecs_default_contentorder', ' thumbnail,title, title2, date, venue, location, organizer, price, categories, excerpt,weburl, showdetail', $atts ),
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
  //'custom_view_more' => '',
  'custom_ajax_load_more_button'=>'',
  'ajax_load_more_text'=>'Load More',
  'google_calendar_text'=>"Google Calendar",
  'ical_text' =>"+ Ical Export",
  'pagination_type'=> '',
  'align'     => '',
  'show_icon_label'=>'',
), $atts ), $atts, 'ecs-list-events' );


      

// Past Event
$meta_date_compare = '>=';
$meta_date_date = current_time( 'Y-m-d H:i:s' );


if ( $atts['time'] == 'past' || $atts['past'] == 'past_events' ) {
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


/**
 * Hide time if $atts['showtime'] is false
 *
 * @author bojana
 *
 */



$atts = apply_filters( 'ecs_atts_pre_query', $atts, $meta_date_date, $meta_date_compare );

if( $atts['featured_events'] == "ture"){
  $args['featured'] = "ture";
}

$event_id = get_the_ID();


$atts['meta_key'] = "";


if(!empty($minCost) || !empty($maxCost)){

  $atts['meta_key'] = array(
    array(
      'key' => '_EventCost',
      'value' => [$minCost, $maxCost],
      'compare' => 'BETWEEN',
      'type'   => 'numeric',
    )
  );

}

    $meta_query = array();

    $meta_query[]['relation']  = 'AND';

    
  if(!empty($event_filter_city)){

    $meta_query[] = array(
                'key'     => '_VenueCity',
                'value' => array($event_filter_city),
                'compare' => 'IN'
    );

  }

  if(!empty($event_filter_state)){
    $meta_query[] = array(
        'key'     => '_VenueProvince',
        'value' => array($event_filter_state),
        'compare' => 'IN'
    );
  }
  
  if(!empty($event_filter_country)){
    $meta_query[] = array(
              'key'     => '_VenueCountry',
              'value' => array($event_filter_country),
              'compare' => 'IN'
    );

  }


  if(!empty($event_filter_address)){
    $meta_query[] = array(
              'key'     => '_VenueAddress',
              'value' => array($event_filter_address),
              'compare' => 'IN'
    );

  }


  if(!empty($event_filter_country) || !empty($event_filter_city) || !empty($event_filter_state) || !empty($event_filter_address)){

    $args = array(
      'post_type' => 'tribe_venue',
      'meta_query' => $meta_query,
    );
    $venues = get_posts($args);


    $venue_ids = wp_list_pluck($venues, 'ID');

        $atts['meta_key'] = array(
          array(
            'key' => '_EventVenueID',
            'value' => $venue_ids,
            'compare' => 'IN',
          )
      );

    }


    if(!empty($event_filter_order)){     
      $atts['order'] = $event_filter_order;  
    }

   
    if(!empty($filter_time)){

      if($filter_time == 'allDays'){
        $atts['meta_date'] = array(
          array(
            'key' => '_EventAllDay',
            'value' => 'yes',
            //  'compare' => $meta_date_compare,
            'type' => 'DATETIME'
          )
        );

      }
      
    }

    if($filter_organizer){
      $filter_organizer_arr  = explode(",",$filter_organizer);
    }else{
      $filter_organizer_arr  = "";
    }

    if($filter_venue){
      $filter_venue_arr  = explode(",",$filter_venue);
    }else{
      $filter_venue_arr  = "";
    }

    // $test = array();
 
    if($event_startDate){
      $event_startDate_start =  $event_startDate." 00:01";
      $event_startDate_end =  $event_endDate." 23:59";
    }else{
      $event_startDate_start =  $event_startDate;
      $event_startDate_end =  $event_endDate;
    }
    // print_r($test);
   
if($atts['pagination_type'] == "load_more" ){
  $args = apply_filters( 'ecs_get_events_args', array(
    'post_status' => 'publish',  
    'start_date'   =>   $event_startDate_start,
    'end_date'     =>    $event_startDate_end,
       // 'm' => 202007, 
   // 'day'  => 'Monday',
      //'year' => 2021,
      // 'monthnum' => 4,
    's' => $filter_search,
    'organizer'=> $filter_organizer_arr,
    'venue'=> $filter_venue_arr,
    //'tag' => $filter_tag,
   //'orderby'=> '_EventStartDate',
    'tax_query'=> $atts['event_tax'],
    'order' => $atts['order'],
   // 'offset' => ( ($current_page * $atts['events_to_load']) + $atts['limit']- $atts['events_to_load']) + $atts['blog_offset'],
    'included_categories' => $atts['included_categories'],
    'hide_subsequent_recurrences'=> $atts['show_recurring_events']=="on"? "false": "true",
    //'featured' => "ture",
   // 'date_query' =>  $date_query,
    'meta_query' => apply_filters( 'ecs_get_meta_query', array( $atts['meta_date'] , $atts['meta_key']), $atts, $meta_date_date, $meta_date_compare ),
), $atts, $meta_date_date, $meta_date_compare );

}else{
  $args = apply_filters( 'ecs_get_events_args', array(
    'post_status' => 'publish',
    'start_date'   =>   $event_startDate_start,
    'end_date'     =>    $event_startDate_end,
   // 'm' => 202007, 
   // 'posts_per_page' => $atts['limit'],
   //  'tag' => $filter_tag,
    // 'year' => 2021,
    // 'monthnum' => 4,
    's' => $filter_search,
    'organizer'=> $filter_organizer_arr,
    'venue'=> $filter_venue_arr,
    'tax_query'=> $atts['event_tax'],
    'order' => $atts['order'],
    'post__not_in'           =>is_single()==true? array(get_the_ID()):"",
   // 'offset' => ( ( $eventfeed_current_pagination_page * $atts['limit']) - $atts['limit']) + $atts['blog_offset'],
    'included_categories' => $atts['included_categories'],
    'hide_subsequent_recurrences'=> $atts['show_recurring_events']=="on"? "false": "true",
   // 'date_query' =>  $date_query,
    'meta_query' => apply_filters( 'ecs_get_meta_query', array( $atts['meta_date'] , $atts['meta_key']), $atts, $meta_date_date, $meta_date_compare ),
  ), $atts, $meta_date_date, $meta_date_compare );

}

// if($filter_tag){
//   $args['tag'] = $filter_tag;
// }

// $args['venue'] = $filter_tag;
// 'venue'=> 132,

if($atts['pagination_type'] == "paged" && $module_class_check == "filters-event-module"){
  $args['posts_per_page'] = $atts['limit'];
}else if($atts['pagination_type'] == "load_more" && $module_class_check == "filters-event-module"){
  $args['posts_per_page'] = $atts['limit'];
}else if($atts['pagination_type'] == "load_more" && $atts['events_to_load'] != ""){
   $args['posts_per_page'] = $atts['events_to_load'];
   $args['offset'] = ( ($current_page * $atts['events_to_load']) + $atts['limit'] - $atts['events_to_load']) + $atts['blog_offset'];
 }else if($atts['pagination_type'] == "numeric_pagination" && $module_class_check == "filters-event-module"){
  $args['posts_per_page'] = $atts['limit'];
//  $args['offset'] = (( $eventfeed_current_pagination_page * $atts['limit']) + $atts['blog_offset']); 
 }else if($atts['pagination_type'] == "numeric_pagination"){
  $args['posts_per_page'] = $atts['limit'];
  $args['offset'] = ( ( $eventfeed_current_pagination_page * $atts['limit']) - $atts['limit']) + $atts['blog_offset']; 
 }else{
  $args['posts_per_page'] = $atts['limit'];
  $args['offset'] = (( $current_page * $atts['limit']) + $atts['blog_offset']); 
 // echo 'test';
 }
 
// if($module_class_check != "filters-event-module")

if($atts['featured_events'] == 'true'){
  $args['featured'] = "true";
}



// if($filter_tag){
//   $filter_tag_arr = explode(",",$filter_tag);
// }else{
//   $filter_tag_arr = "";
// }


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
  $args['tax_query'] = $atts['event_tax'];
}

if($filter_tag){
  if($atts['cat']){
   // unset($atts['event_tax']);
  }else{
    unset($atts['event_tax']);
  }
 
  $atts['event_tax'][] = array(
    'taxonomy' => 'post_tag',
    'field' => 'term_id',
    'terms' => explode(",",$filter_tag),
  ); 
  $args['tax_query'] = $atts['event_tax'];
}
if($filter_category){
  unset($atts['event_tax']);
  $atts['event_tax'][] = array(
    'taxonomy' => 'tribe_events_cat',
    'field' => 'term_id',
    'terms' => explode(",",$filter_category),
  ); 
  $args['tax_query'] = $atts['event_tax'];
}

//$event_posts = tribe_get_events( $post_venue );

// exit;
// $the_query = new WP_Query( $post_venue );

// print_r($event_posts );

// if($filter_category){

//   $args['tag'] = "Organizers";

// }

//print_r($args);

//echo $atts['use_current_loop'];

if($atts['use_current_loop'] == "true"){	

if($post_type == 'tribe_events'){
 // $args['ID'] = $event_id;
}


$term_id = json_decode($term_id);

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

  $max_page_find_args = $args;
	if($atts['limit'] > 0){
		$max_page_find_args['posts_per_page'] = -1;
		if($atts['pagination_type']== "load_more" &&  $atts['events_to_load'] != "" ){
			$max_pages = ceil((count(tribe_get_events( $max_page_find_args )) - $atts['limit'])/$atts['events_to_load'] + 1);
		}else{
			$max_pages = ceil(count(tribe_get_events( $max_page_find_args ))/$atts['limit']);
		}

	} 

  // echo $max_pages;

  // echo '<pre>';
  // print_r($args);
  // echo '</pre>';

    $event_posts = tribe_get_events( $args );

    $event_posts = apply_filters( 'ecs_filter_events_after_get', $event_posts, $atts );


if ( $event_posts or apply_filters( 'ecs_always_show', false, $atts ) ) {
    
  $output =
  
  apply_filters( 'ecs_beginning_output', $output, $event_posts, $atts );

      $cardoverStyle = '';
      $excerptLength = '';

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


      // $columns_device = array('columns','columns_tablet','columns_phone');
      // $columns_desktop = 'col-lg-4';
      // $columns_tablet = 'col-md-12';
      // $columns_phone = 'col-sm-12';
      // foreach ($columns_device as $device){
      //   $columns_class = false;
      //   if (strpos($device, '_phone')){
      //     $breakpoint = 'sm';
      //   }else if (strpos($device, '_table')){
      //     $breakpoint = 'md';
      //   }else{
      //     $breakpoint = 'lg';
      //   }
      //   if ($atts[$device]){
      //     switch ($atts[$device]){
      //       case 1:
      //         $columns_class = "col-{$breakpoint}-12";
      //         break;
      //       case 2:
      //         $columns_class = "col-{$breakpoint}-6";
      //         break;
      //       case 3:
      //         $columns_class = "col-{$breakpoint}-4";
      //         break;
      //       case 4:
      //         $columns_class = "col-{$breakpoint}-3";
      //         break;
      //       case 5:
      //         $columns_class = "col-{$breakpoint}-2";
      //         break;
      //       case 6:
      //         $columns_class = "col-{$breakpoint}-2";
      //         break;
      //     }
      //     if (strpos($device, '_phone')){
      //       $columns_phone = $columns_class;
      //     }else if (strpos($device, '_table')){
      //       $columns_tablet = $columns_class;
      //     }else{
      //       $columns_desktop = $columns_class;
      //     }
      //   }
      // }

  $atts['contentorder'] = explode( ',', $atts['contentorder'] );
  $Event_Inner_Margin = explode('|', str_replace(array('false'), array('') ,$atts['event_inner_spacing']));
  $Card_Outer_Margin_top = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
  $Card_Outer_Margin_bottom = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
  $Card_Outer_Margin_left = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
  $Card_Outer_Margin_right = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
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

  $event_not_found = true;

  foreach( (array) $event_posts as $post_index => $event_post ) {
    setup_postdata( $event_post->ID );

 //   $custom_duration_meta_key = get_post_meta($event_post->ID, '_EventDuration',true);

    $events_custom_start_time   = tribe_get_start_time($event_post->ID);
    $events_custom_end_time   = tribe_get_end_time($event_post->ID);

    $filter_months_array = explode(',', $filter_time);

    $custom_time_range = decm_timeFilter($events_custom_start_time,$events_custom_end_time, $filter_months_array);

   // echo $custom_time_range;

    $events_custom_start  =  tribe_get_start_date( $event_post->ID,null, 'Y-m-d');
    $events_custom_end  = tribe_get_end_date( $event_post->ID,null, 'Y-m-d');
  
    $decm_dates = decm_dateRange($events_custom_start, $events_custom_end);

    $filter_day_array = explode(',', $filter_day);

    $filter_years_array = explode(',', $filter_year);

    $filter_months_array = explode(',', $filter_month);

    $date_custom_range  = array_filter($decm_dates, decm_dateFilter($filter_day_array));

    $date_custom_year  = array_filter($decm_dates, decm_years_Filter($filter_years_array));

    $decm_months_Filter  = array_filter($decm_dates, decm_months_Filter($filter_months_array));

    
    $foundDates = array_reduce($date_custom_range, function ($carry, $date) {
      $carry = $date->format('Y-m-d');
      return $carry;
    }, []);

    $foundyears = array_reduce($date_custom_year, function ($carry, $date) {
      $carry = $date->format('Y');
      return $carry;
    }, []);

    $foundMonths = array_reduce($decm_months_Filter, function ($carry, $date) {
      $carry = $date->format('m');
      return $carry;
    }, []);

    
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
            $category_enable_link = $atts['enable_category_links'] == 'true' ? '<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>' : '<span>'.$category->name.'</span>';
						$category_names[] = '<span class= ecs_category_'.$category->slug.' >'.$category_enable_link.'</span>';
      }
    }


if(!empty($foundDates) || $filter_day == ""){

if(!empty($foundyears) || $filter_year == ""){

if(!empty($foundMonths) || $filter_month == ""){

if(!empty($custom_time_range) || $filter_time == ""){


    $event_not_found = false;
    $event_output .= apply_filters( 'ecs_event_start_tag', '<div class=" '.$columns_desktop.' '.$columns_tablet.' '.$columns_phone_xs.' ecs-event ecs-event-posts clearfix' . implode( '', $category_slugs ) . $featured_class . apply_filters( 'ecs_event_classes', '', $atts, $post ) . '" style="'.$cardInnerStyletop.'" "><article id="event_article_'.$event_post->ID.'" class="act-post et_pb_with_border"  style="'.$cardoverStyle.''.$cardInnerStyle.'" " ><div class="row" style="" > ', $atts, $post );
    
    // Put Values into $event_output
    if ( event_attr_isValid( $atts['thumb'] ) ){
        
    }
    else{
// 					$event_output .= '<div class="col-md-12">';
    }
    $custom_website_link_text="";
    $custom_event_link_url="";
    $custom_event_link_url = $atts['custom_event_link_url']==""?tribe_get_event_link($event_post->ID):((strpos($atts['custom_event_link_url'], "http") !== 0)?$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?"https" : "http") . "://" .$atts['custom_event_link_url']:$atts['custom_event_link_url']);
    $custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?"View Events Website":$atts['custom_website_link_text'];				
    $link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_event_website_link($event_post->ID), $result);
    if(isset($result['href'][0])){
      $result =  $result['href'][0];	
      $custom_event_link_url = $atts['single_event_page_link'] == 'redirect_link' ?  $result : $custom_event_link_url;
  }	
    $classShowDataOneLine ='';
     $classShowDataOneLine = $atts['show_data_one_line'] == 'true' ? ' decm-show-data-display-block ' : ' ';
   $start_time='';
   $end_time ='';
   $set_timezone='';
   $image_center='';
   $set_timezone=$atts['show_timezone']=='true'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):"";
   $start_time=$atts['timeformat']==''? tribe_get_start_time($event_post->ID,get_option( 'time_format' )):tribe_get_start_time($event_post->ID,$atts['timeformat']);  
   $end_time=$atts['timeformat']==''? tribe_get_end_time($event_post->ID,get_option( 'time_format' )):tribe_get_end_time($event_post->ID,$atts['timeformat']);
   $end_time=$atts['show_end_time']=="true"?$end_time.$set_timezone:((tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))?$end_time.$set_timezone:$set_timezone);
   $start_date='';
   $end_date ='';
   $showicondate ="";
   $showicontime="";
   $showicon="";
   $showlabel="";
   $showlabeldate="";
   $showlabeltime="";
   $disable_event_button_link="";
   $disable_event_image_link="";
   $disable_event_title_link="";
   $disable_event_title_link=$atts['disable_event_title_link']=="true"?" ecs_disable_event_link ":"";
   $disable_event_image_link=$atts['disable_event_image_link']=="true"?" ecs_disable_event_link ":"";
   $disable_event_button_link=$atts['disable_event_button_link']=="true"?" ecs_disable_event_link ":"";
  $start_date = $atts['dateformat']==''? tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' )):tribe_get_start_date( $event_post->ID,null,$atts['dateformat']);
  $end_date = $atts['dateformat']==""? ' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '. tribe_get_end_date($event_post->ID,null, get_option( 'date_format' )):' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$atts['dateformat']);   
  
  $decm_show_callout_day_of_week = $atts['show_callout_day_of_week'] == "true" ? '<div class="callout_weekDay">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format']).'</div>' : "" ;
  $decm_show_callout_year = $atts['show_callout_year'] == "true" ? '<div class="callout_year">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format']).'</div>' : " " ;
  $decm_show_callout_month = $atts['show_callout_month'] == "true" ? '<div class="callout_month">'.tribe_get_start_date( $event_post->ID,null,$atts['callout_month_format']).'</div>' : " " ;
  $decm_show_callout_date = $atts['show_callout_date'] == "true" ? '<div class="callout_date">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']).'</div>' : " " ;

  if($atts['layout'] == 'cover'){
    $decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-cover">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.'</div>' : '';	
  }else if($atts['layout'] == 'list'){
    $decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-list">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.'</div>' : '';		
  }else{
    $decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-grid">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.'</div>' : '';
  }
      

  if($atts['align']=="center"){
    $image_center="decm-show-image-center";
  }
  if($atts['align']=="left"){
    $image_center="decm-show-image-left";
  }
  if($atts['align']=="right"){
    $image_center="decm-show-image-right";
  }


    foreach ( apply_filters( 'ecs_event_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {

      switch ( trim( $contentorder ) ) {
        
        case  'callout':
          $event_output .= '<div class="col-md-2 col-3">'.$decm_show_callout_box.'</div>';
        break;
        case 'title':

          $dec_event_title = "";
							if(event_attr_isValid( $atts['showtitle'] )){
								$dec_event_title =  apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ).apply_filters( 'ecs_event_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
					}


        if((event_attr_isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list') && ($atts['showdetail'] == 'true' || $atts['showdetail'] == 'false' ) ){					
          if($atts['list_layout'] == 'calloutrightimage_leftdetail'){
           $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
         }elseif( event_attr_isValid( $atts['thumb'] ) != " " &&  ($atts['show_callout_box'] == "false" && $atts['showdetail'] == 'false' ) && $atts['list_layout'] == 'leftimage_rightdetail'){
           $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
         }elseif( event_attr_isValid( $atts['thumb'] ) != " "   && ($atts['list_layout'] == 'leftimage_rightdetail' || $atts['list_layout'] == 'rightimage_leftdetail') ){
           $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
         }elseif( event_attr_isValid( $atts['thumb'] ) != " " &&  ($atts['show_callout_box'] == "true" && $atts['showdetail'] == 'true' ) ){
           $event_output .= '<div class="  col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
         }elseif( event_attr_isValid( $atts['thumb'] ) != " "  &&  $atts['show_callout_box'] == "true"  ){
           $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
         }else{
           $event_output .= '<div class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
         }							

       }elseif((event_attr_isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list') && $atts['showdetail'] == 'false' ){

         $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;

       }elseif(event_attr_isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list' ){

            $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;

          }elseif($atts['layout'] == 'list' &&  ($atts['list_layout'] == 'calloutleftimage_rightdetailButton' || $atts['list_layout'] == 'calloutrightimage_leftdetailButton'  )  ){

            $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '4' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').'"><div class="decm-events-details">'.$dec_event_title;

          }elseif( $atts['layout'] == 'list' &&  ($atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail') ){

          $event_output .= '<div  class=" col-'.( $atts['list_columns'] <= 2  && $atts['thumb'] == 'false' ? '10' : '6').'  col-md-'.( $atts['list_columns'] <= 2  && $atts['thumb'] == 'false' ? '10' : '6').'"><div class="decm-events-details">'.$dec_event_title;	

          }elseif ( event_attr_isValid( $atts['showtitle'] ) &&  $atts['layout'] == 'list' ) {

            $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details">'.$dec_event_title;						
          }	
          elseif(  event_attr_isValid( $atts['showtitle'] )  && $atts['layout'] == 'grid'  ){
            
            $event_output .= '<div  class="col-md-'.($atts['columns'] > 2 ? '12' : '12').'"><div class="decm-events-details">'.$dec_event_title;
              
          }elseif(event_attr_isValid( $atts['showtitle'] )  && $atts['layout'] == 'cover'){

            $image = get_the_post_thumbnail_url($event_post->ID,'full');  
            
            $background_image	= $atts['thumb'] == "true" ? "background-image: url($image); background-size: cover;" : "";   
            $event_output .= '<div  class="col-md-'.($atts['columns'] > 2 ? '12' : '12').' "  ><div class="decm-cover-image-overlay"   style = "'.$background_image.'" ><div class="decm-cover-overlay-details"><div  class="decm-events-details-cover">'.$decm_show_callout_box .''.apply_filters( 'ecs_event_title_tag_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'ecs_event_list_title_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'ecs_event_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'ecs_event_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
          }elseif(!event_attr_isValid( $atts['showtitle'] ) &&  $atts['layout'] == 'list'){
								
            $event_output .= '<div check class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details">';	
          }else{
            
            $event_output .= '<div  class="col-md-'.(($atts['columns'] > 2 ? '12' : $atts['image_align'] == 'topimage_bottomdetail' || $atts['image_align'] == 'centerimage_bottomdetail' || $atts['thumb'] == 'false') ? '12' : '8').'"><div   class="decm-events-details">';
          }
        break;
        case 'title2':
          $event_output .= '<h4 class="entry-title title2 summary">
                  <a href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark">'.get_the_title($event_post->ID).'</a>
                     </h4>';
          break;
        /**
         * Show Author Name of every events
         *
         * @author bojana
         */
        
        case 'organizer':
          if ( event_attr_isValid( $atts['organizer'] ) ) {
            if(tribe_get_organizer($event_post->ID) != null){
              $showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"organizer-ecs-icon":"";
              $showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Organizer','decm-divi-event-calendar-module')." </span>":"";
              $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";

              $organizers = tribe_get_organizer_ids($event_post->ID);
              $orgName = array();
              foreach ($organizers as $key => $organizerId) {
                $orgName[$key] = tribe_get_organizer($organizerId);	
              } 

              $orgNames	= implode(', ', $orgName);
                $event_output .= '<span class="'.$classShowDataOneLine.' ecs-organizer '.$showicon.'">'
                .($atts['show_preposition'] == 'true' ? $showlabel.$stacklabel.'<span class="decm_organizer">'.__(' by ','decm-divi-event-calendar-module') : $showlabel.$stacklabel." ".'<span class="decm_organizer">');      
                  $event_output .=  $orgNames;   
                $event_output .= '</span></span>';           
          }
       
        }
          
          
          break;
          case 'price':
            if ( event_attr_isValid( $atts['price'] ) ) {
              if(tribe_get_cost( $event_post->ID, true )!=null){
                $showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"price-ecs-icon":"";
								$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Price','decm-divi-event-calendar-module')." </span>":"";
                $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                  $event_output .= '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">' .
                      "".$showlabel.$stacklabel." ".'<span class="decm_price">'.tribe_get_cost( $event_post->ID, true ).
                     '</span></span>';
                  
            }
         
          }
            
            break;	
        case 'thumbnail':
          if ( event_attr_isValid( $atts['thumb'] ) ) {

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

                $event_output.='<div class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').' col-'.($atts['list_columns'] <= 2 ? '4' : '12').'">';
                $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
              $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
            
             }elseif( $atts['layout'] == 'list' && ($atts['list_layout'] == 'calloutleftimage_rightdetailButton' || $atts['list_layout'] ==  'calloutrightimage_leftdetailButton') ){

            $event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '3' : '12').' col-'.($atts['list_columns'] <= 2 ? '3' : '12').' ">';
            $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
            $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
          
              }elseif($atts['layout'] == 'cover'){
                $event_output.='<div  style = "display:none;" class="'.$image_center.' col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
                $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
               $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';

              }else{								
               $event_output.='<div  class="'.$image_center.' col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
               $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
              $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
             }

            if( !empty( $thumbWidth ) ) {
              $thumb = get_the_post_thumbnail( $event_post->ID,array( $thumbWidth, $thumbHeight ) );
              if( !empty( $thumb ) &&  $atts['layout'] == 'cover' ){
                $event_output .='<a style="display:none;" href="' . tribe_get_event_link($event_post->ID) . '">';
                $event_output .= $thumb;
                $event_output .= '</a>';
              }
              elseif ( !empty( $thumb ) &&  $atts['layout'] == 'grid' ) {

                $event_output .='<a href="' . tribe_get_event_link($event_post->ID) . '">';
                $event_output .= $thumb;
                $event_output .= ''.$decm_show_callout_box.'</a>';

              }elseif ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'ecs_event_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) ) ) {
                $event_output .='<a href="' . tribe_get_event_link($event_post->ID) . '">';
                $event_output .= $thumb;
                $event_output .= '</a>';
              }
            
            } else {

              if ( $thumb = get_the_post_thumbnail( $event_post->ID ,array( $thumbWidth, $thumbHeight ) ) ) {
                $event_output .= '<a href="' . tribe_get_event_link($event_post->ID) . '">';
                $event_output .= $thumb;
                $event_output .= '</a>';
              }
            }


            $event_output.='</div>';
          }
          break;

          case 'excerpt':
            if ( event_attr_isValid( $atts['excerpt'] ) ) {
              
              $excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 100;
              if(event_attr_get_excerpt($event_post,$excerptLength )!=null && has_excerpt($event_post->ID)){
              $event_output .='<p class="'.$classShowDataOneLine.' ecs-excerpt">'
                         .event_attr_get_excerpt($event_post, $excerptLength ).
                         '</p>';
            }
            //else{}
          }
            
          break;
        
						
          case 'weburl':
            if ( event_attr_isValid( $atts['weburl'] ) ) {
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
          //$event_output.='</div></br>';
          break;
          case 'date':
            $datetime_separator       = tribe_get_option( 'dateTimeSeparator', ' @ ' );
             $time_range_separator     = tribe_get_option( 'timeRangeSeparator', ' - ' );
            $time_range_separator     = $atts['show_end_time']== "true"? $time_range_separator:"";

            $event_output .= '<div class="decm-show-detail-center">';
            if (event_attr_isValid( $atts['eventdetails'] ) ) {
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
              if ( event_attr_isValid( $atts['venue'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
                if(tribe_get_venue($event_post->ID)!=null){
                  $showicon = ($atts['show_icon_label']==="icon" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?"venue-ecs-icon":"";
                  $showlabel = ($atts['show_icon_label'] ==="label" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.__('Venue','decm-divi-event-calendar-module')." </span>":"";
                  $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                      $event_output .= '<span class="'.$classShowDataOneLine.'ecs-venue duration venue '.$showicon.'">'
                      .__($atts['show_preposition'] == 'true' ?$showlabel.$stacklabel. '<span class="decm_venue"><em>'.__( 'at','decm-divi-event-calendar-module').'</em>' : $showlabel.$stacklabel." ".'<span class="decm_venue">', 'decm-divi-event-calendar-module' ).
                      tribe_get_venue($event_post->ID).
                  '</span></span>';
                                   
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
              
              if ( event_attr_isValid( $atts['location'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {

                $dec_location_street = $atts['location_street_address'] == "true" && $atts['location'] == "true" && tribe_get_address($event_post->ID)!=null? tribe_get_address($event_post->ID)." ":"";
                $dec_location_locality = $atts['location_locality'] == "true" && $atts['location'] == "true" && tribe_get_city($event_post->ID)!=null? tribe_get_city($event_post->ID).', ':""; 
                $dec_location_postal = $atts['location_postal_code'] == "true" && $atts['location'] == "true" && tribe_get_zip($event_post->ID)!=null? tribe_get_zip($event_post->ID)." ":""; 
                $dec_location_country = $atts['location_country'] == "true" && $atts['location'] == "true" && tribe_get_country($event_post->ID)!=null? tribe_get_country($event_post->ID)." ":"";   
                if(tribe_get_full_address($event_post->ID) !="<span class=\"tribe-address\">\n\n\n\n\n\n\n</span>\n" ){
                  $showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "event-location-ecs-icon":"";
                  $showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.__('Location','decm-divi-event-calendar-module')." </span>":"";
                  $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                  $event_output .= '<span class="'.$classShowDataOneLine.'ecs-location duration venue '.$showicon.'">'.
                   __( $atts['show_preposition']=='true'?  $showlabel.$stacklabel.'<span class="decm_location"><em>'.__( 'in','decm-divi-event-calendar-module').'</em>': $showlabel.$stacklabel.'<span class="decm_location">').
                   ($atts['show_data_one_line'] =='false'? $dec_location_street.$dec_location_locality.$dec_location_postal.$dec_location_country : str_replace('<br>','',$dec_location_street.$dec_location_locality.$dec_location_postal.$dec_location_country)).	
                  '</span></span>';     
              }
              // else{}
              }
              
              break;
            /**
             * Show categories of every events
             *
             * @author bojana
             */
            case 'categories':
              if ( event_attr_isValid( $atts['categories'] ) ) {

                
                // $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
                $categories = implode(", ", $category_names);
                $categories_separator = $categories ? ' | ' : ' ';
                $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
                if(et_core_esc_wp( $categories )!=null){
                  $showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "categories-ecs-icon":"";
                  $showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.__('Category','decm-divi-event-calendar-module')." </span>":"";
                  $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                    $event_output .= '<span class="'.$classShowDataOneLine.'ecs-categories '.$showicon.'">'
                             . et_core_intentionally_unescaped($showlabel.$stacklabel.$categories_sep, 'fixed_string' ) .
                        et_core_esc_wp( $categories ).
                               '</span>';
                  
                  
                }
                else{}
              }
              
            //  $event_output.='</div>';
              break;
              
            /**
             * Show more in detail of every events
             *
             * @author bojana
             */
           
              break;
            case 'showdetail':
              if ( event_attr_isValid( $atts['showdetail']) ) {
                $button_classes = "act-view-more et_pb_button";
                $button_classes = $atts['button_make_fullwidth'] ==  'on' ? "act-view-more et_pb_button act-view-more-fullwidth" : $button_classes;
                $view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
                $icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";      
                $button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
    
                if($atts['layout'] == 'list' &&  ($atts['list_layout'] == 'rightimage_leftdetail' || $atts['list_layout'] == 'leftimage_rightdetail' || $atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail' ) ){
                  $event_output .= '<p class="ecs-showdetail et_pb_button_wrapper '.(( event_attr_isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >'.
                        '<a class="'.$button_classes.'" href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'] .'</a>
                    </p>';
                }elseif($atts['layout'] == 'grid' || $atts['layout'] == 'cover' ){
                  $event_output .= '<p class="ecs-showdetail et_pb_button_wrapper '.(( event_attr_isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >'.
                        '<a class="'.$button_classes.'" href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'] .'</a>
                    </p>';
                }
    
                // $event_output .= '<p class="ecs-showdetail et_pb_button_wrapper '.(( event_attr_isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >'.
                //         '<a class="'.$button_classes.'" href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'] .'</a>
                //     </p>';
              }
              $event_output.='</div></div>';
              break;
              case 'button':
                if ( event_attr_isValid( $atts['showdetail']) ) {
                  $button_classes ="act-view-more et_pb_button";
                  $button_classes = $atts['button_make_fullwidth'] ==  'on' ? "act-view-more et_pb_button act-view-more-fullwidth" : $button_classes;
                  $view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
                  $icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
                  $button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
    
                  $event_output .= '<div class="col-md-2 col-2 "><p class="ecs-showdetail et_pb_button_wrapper '.(( event_attr_isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >'.
                  '<a class="'.$button_classes.'" href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'] .'</a>
                  </p></div></div></div>';
    
                }
                break;
            case 'date_thumb':
              if ( event_attr_isValid( $atts['eventdetails'] ) ) {
                $event_output .= '<div class="date_thumb"><div class="month">' . tribe_get_start_date( null, false, 'M' ) . '</div><div class="day">' . tribe_get_start_date( null, false, 'j' ) . '</div></div>';
              }
              break;
            default:
              $event_output .= apply_filters( 'ecs_event_list_output_custom_' . strtolower( trim( $contentorder ) ), '', $atts, $event_post );
          }
        
        }
     
        $event_output .= '</div>';
        
    
        $event_output .= '</article></div><input type="hidden" class="max_page" id="page_max" value="'.$max_pages.'">';
 
              // continue;
        // exit; 

        $output .= apply_filters( 'ecs_single_event_output', $event_output, $atts, $event_post, $post_index, $event_post );
      }
    
    }
  }
      }
}

      if( $event_not_found == true){
       // echo 'only if work';
        $output .= sprintf( translate( '<div class="events-results-message">'.$atts['message'].'</div>', 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() );    
      }
     
      
      if( event_attr_isValid( $atts['viewall'] ) ) {
        $output .= '<span class="ecs-all-events">'.
                   '<a href="' .tribe_get_events_link().'" rel="bookmark">' .sprintf( __( 'View All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ). '</a>';
        $output .= '</span>';
      }
   
     

      // $output .= '<div class="append_events_pagenation">
      // <input type="hidden" name="eventfeed_prev_page" id="eventfeed_prev_page" value="12">
      // <input type="hidden" name="eventfeed_current_page" id="eventfeed_current_page" value="12">
      // <input type="hidden" name="eventfeed_page" id="eventfeed_page" value="'.$atts["pagination_type"].'">
      // <input type="hidden" name="eventfeed_current_pagination_page" id="eventfeed_current_pagination_page" value="1">
      // <input type="hidden" name="module_css_feed" id="module_css_feed" value="'.$atts['module_css_class'].'">
      // <input type="hidden" name="module-css-class" id="module-css-class" value="" />
      // <input type="hidden" name="eventfeed_max_page" id="eventfeed_max_page" value=""><input type="hidden" name="eventfeed_load_img" id="eventfeed_load_img" value="'.plugin_dir_url(__FILE__).'ajax-loader.gif">';
      // $output .='</div>';
   
    } else { //No Events were Found
      // echo 'only if work Event Not Found';
      $output .= sprintf( translate( '<div class="events-results-message">'.$atts['message'].'</div>', 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() );

    } // endif


   
    // if($max_pages > 1){
    //   $button_classes = "ecs-ajax_load_more et_pb_button";
		// 	$icon_align =($atts['ajax_load_more_button_icon_placement']=="left")?"et_pb_ajax_align":"";
		// $button_classes = ($atts['custom_ajax_load_more_button'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$icon_align : $button_classes;

		// $output .= apply_filters( 'ecs_event_showdetail_tag_start', '<div class="event_ajax_load et_pb_button_wrapper" >', $atts, $event_post ) .
		// 				apply_filters( 'ecs_event_list_showdetail_link_start', '<a class="'.$button_classes.'" href="' . "#" . '" onClick="return false;" rel="bookmark"  data-icon="'.$atts['ajax_load_more_button_icon'].'" data-icon-tablet="'.$atts['ajax_load_more_button_icon_tablet'].'" data-icon-phone="'.$atts['ajax_load_more_button_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'ecs_event_list_title', $atts['ajax_load_more_text'], $atts, $event_post ) . apply_filters( 'ecs_event_list_showdetail_link_end', '</a>', $atts, $event_post ) .
		// 		     apply_filters( 'ecs_event_showdetail_tag_end', '</div>', $atts, $event_post );
    // }

    return $output;
    
    wp_reset_postdata();
    
    }
    