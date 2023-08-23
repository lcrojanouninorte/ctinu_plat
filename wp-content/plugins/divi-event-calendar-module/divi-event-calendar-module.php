<?php
/*
Plugin Name: Divi Events Calendar
Description: Easily display and style The Events Calendar with custom Divi modules!
Version:     2.2.6
Author:      Pee-Aye Creative
Author URI:  https://peeayecreative.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: decm-divi-event-calendar-module
Domain Path: /languages

Divi Event Calendar Module is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Divi Event Calendar Module is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Divi Event Calendar Module. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

add_action("init", "divicalendarmodule_init");

function divicalendarmodule_init() {
   load_plugin_textdomain("decm-divi-event-calendar-module", false, "divi-event-calendar-module/languages/");
}

function div_event_calendar_activate() {

	if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
	  include_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	}
  
	if ( current_user_can( 'activate_plugins' ) && ! is_plugin_active( 'the-events-calendar/the-events-calendar.php' )  ) {
	  // Deactivate the plugin.
	  deactivate_plugins( plugin_basename( __FILE__ ) );
	  // Throw an error in the WordPress admin console.
	  $error_message = '<p style="font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Oxygen-Sans,Ubuntu,Cantarell,\'Helvetica Neue\',sans-serif;font-size: 13px;line-height: 1.5;color:#444;font-weight: 700;">' . esc_html__( 'Divi Events Calendar requires The Events Calendar to be installed and active. You can download ', 'decm-divi-event-calendar-module' ) . '<a target="_blank" href="' . esc_url( 'https://wordpress.org/plugins/the-events-calendar/' ) . '">The Events Calendar</a>' . esc_html__( ' here.', 'the-events-calendar' ) . '</p><script>parent.document.getElementById("message").style.borderLeftColor="blue";parent.document.getElementById("message").getElementsByTagName("p")[0].style.display="none";</script>';
	  die( $error_message ); // WPCS: XSS ok.
	}
  }
  
  register_activation_hook( __FILE__, 'div_event_calendar_activate' );
  function divi_event_calendar_view_documentation_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
    if ( strpos( $plugin_file_name, basename(__FILE__) ) ) {
 
        // You can still use `array_unshift()` to add links at the beginning.
        $links_array[] = '<a href="https://www.peeayecreative.com/docs/divi-events-calendar/" target="_blank">View Documentation</a>';
      
    }
  
    return $links_array;
}
 
add_filter( 'plugin_row_meta', 'divi_event_calendar_view_documentation_links', 10, 4 );


  add_action( 'update_option_active_sitewide_plugins', 'pluginprefix_deactivate_self', 10, 2 );
  add_action( 'update_option_active_plugins', 'pluginprefix_deactivate_self', 10, 2 );
  /**
   *  Deactivate ourself if Addthis is deactivated.
   * 
   *  @param mixed $old_value The old option value.
   *  @param mixed $value     The new option value.
   */
  function pluginprefix_deactivate_self( $plugin, $network_deactivating ) {
	  // The parameter/argument is the plugin basename for the parent plugin
	  // In this case, we are watching the AddThis plugin
	  // Note, this code will not work if the folder uploaded is a different slug (e.g., uploaded manually with custom folder name)
	  _wps_deactivate_self( 'the-events-calendar/the-events-calendar.php');
	
  }
  
  if ( !function_exists( '_wps_deactivate_self' ) ) {
	  /**
	   *  Deactivate ourself if parent plugin is deactivated.
	   * 
	   *  @param string $plugin_basename Plugin basename of the parent plugin.
	   */
	  function _wps_deactivate_self( $plugin_basename ) {
		  // Check if parent plugin is active
		  if ( !is_plugin_active( $plugin_basename ) ) {
			  // Parent is not active, so let's deactivate
			// WPCS: XSS ok.
			  deactivate_plugins( plugin_basename( __FILE__ ) );
			 
		  }
	  }
  }


  define( 'EVENT_FILE', __FILE__ );
  define( 'EVENT_DIR', 	plugin_dir_url(EVENT_FILE) );

if ( ! function_exists( 'decm_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 2.0.0
 */


function decm_initialize_extension() {	 
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/DiviEventCalendarModule.php';

	//  if(!isset($_GET['et_fb']) || ! wp_verify_nonce( sanitize_key(wp_unslash( $_GET['et_fb']))))
	//  {

	// //	wp_enqueue_script('jquery_enquec', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, false); 	 
	// 	wp_enqueue_script('main_1', 'https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.3.1/main.min.js', array(), null, false);
	// 	wp_enqueue_script('main_3', 'https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.js', array(), null, false);
	// 	wp_enqueue_script('main_6', plugin_dir_url(__dir__).'divi-event-calendar-module/includes/packages/main_6.js', array(), null, false);
	// 	wp_enqueue_script('main_7', plugin_dir_url(__dir__).'divi-event-calendar-module/includes/packages/main_7.js', array(), null, false);
	// 	//wp_enqueue_script( 'filter-multiple', plugin_dir_url(__dir__).'divi-event-calendar-module/includes/modules/EventDisplay/filter-multi-select-bundle.min.js', array(), null, false);
	// 	wp_enqueue_script( 'Jquery-slim', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', array(), null, false);	
	// 	if(get_locale()!="en_US"){
	// 		wp_enqueue_script('main_8', plugins_url().'/divi-event-calendar-module/includes/packages/core/locales-all.js', array(), null, false);
	// 	}

	// }

//	wp_register_script( 'loadmore', plugins_url().'/divi-event-calendar-module/includes/modules/EventDisplay/loadmore.js');
   
}


add_action( 'divi_extensions_init', 'decm_initialize_extension' );

  
 
add_action("wp_ajax_fetch_Events", "fetchEvents");
add_action("wp_ajax_nopriv_fetch_Events", "fetchEvents");


function fetchEvents( $atts, $conditional_tags = array(), $current_page = array() ){
	// global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
	// 		$post_type = get_post_type();
	// 		print_r($wp_query);
	$_GET['event_tax']="";
$categories = isset($_GET['categories']) ? sanitize_text_field( wp_unslash( $_GET['categories'] ) ) : sanitize_text_field( wp_unslash( $_GET['categories'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_tax = isset($_GET['event_tax']) ? sanitize_text_field( wp_unslash( $_GET['event_tax']) ) : sanitize_text_field( wp_unslash( $_GET['event_tax'] ) );         //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$dateformat = isset($_GET['dateformat']) ? sanitize_text_field( wp_unslash( $_GET['dateformat']) ) : sanitize_text_field( wp_unslash( $_GET['dateformat'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$timeformat = isset($_GET['timeformat']) ? sanitize_text_field( wp_unslash( $_GET['timeformat']) ) : sanitize_text_field( wp_unslash( $_GET['timeformat'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_title=isset($_GET['show_title']) ? sanitize_text_field( wp_unslash( $_GET['show_title']) ) : sanitize_text_field( wp_unslash( $_GET['show_title'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_excerpt=isset($_GET['show_excerpt']) ? sanitize_text_field( wp_unslash( $_GET['show_excerpt']) ) : sanitize_text_field( wp_unslash( $_GET['show_excerpt'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_date=isset($_GET['show_date']) ? sanitize_text_field( wp_unslash( $_GET['show_date']) ) : sanitize_text_field( wp_unslash( $_GET['show_date'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$timezone=isset($_GET['timezone']) ? sanitize_text_field( wp_unslash( $_GET['timezone']) ) : sanitize_text_field( wp_unslash( $_GET['timezone'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$venue=isset($_GET['venue']) ? sanitize_text_field( wp_unslash( $_GET['venue']) ) : sanitize_text_field( wp_unslash( $_GET['venue'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$location=isset($_GET['location']) ? sanitize_text_field( wp_unslash( $_GET['location']) ) : sanitize_text_field( wp_unslash( $_GET['location'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$street=isset($_GET['street']) ? sanitize_text_field( wp_unslash( $_GET['street']) ) : sanitize_text_field( wp_unslash( $_GET['street'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$locality=isset($_GET['locality']) ? sanitize_text_field( wp_unslash( $_GET['locality']) ) : sanitize_text_field( wp_unslash( $_GET['locality'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$postal=isset($_GET['postal']) ? sanitize_text_field( wp_unslash( $_GET['postal']) ) : sanitize_text_field( wp_unslash( $_GET['postal'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$country=isset($_GET['country']) ? sanitize_text_field( wp_unslash( $_GET['country']) ) : sanitize_text_field( wp_unslash( $_GET['country'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$organizer=isset($_GET['organizer']) ? sanitize_text_field( wp_unslash( $_GET['organizer']) ) : sanitize_text_field( wp_unslash( $_GET['organizer'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_time=isset($_GET['show_time']) ? sanitize_text_field( wp_unslash( $_GET['show_time']) ) : sanitize_text_field( wp_unslash($_GET['show_time'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_end_time=isset($_GET['show_end_time']) ? sanitize_text_field( wp_unslash( $_GET['show_end_time']) ) : sanitize_text_field( wp_unslash($_GET['show_end_time'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_price=isset($_GET['show_price']) ? sanitize_text_field( wp_unslash( $_GET['show_price']) ) : sanitize_text_field( wp_unslash($_GET['show_price']) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_image=isset($_GET['show_image']) ? sanitize_text_field( wp_unslash( $_GET['show_image']) ) : sanitize_text_field( wp_unslash( $_GET['show_image'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$categslug=isset($_GET['categslug']) ? sanitize_text_field( wp_unslash( $_GET['categslug']) ) : sanitize_text_field( wp_unslash( $_GET['categslug'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$categId=isset($_GET['categId']) ? sanitize_text_field( wp_unslash( $_GET['categId']) ) : sanitize_text_field( wp_unslash( $_GET['categId'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_dynamic_content=isset($_GET['show_dynamic_content']) ? sanitize_text_field( wp_unslash( $_GET['show_dynamic_content']) ) : sanitize_text_field( wp_unslash( $_GET['show_dynamic_content'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_tooltip_category=isset($_GET['show_tooltip_category']) ? sanitize_text_field( wp_unslash( $_GET['show_tooltip_category']) ) : sanitize_text_field( wp_unslash( $_GET['show_tooltip_category'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_feature_event=isset($_GET['show_feature_event']) ? sanitize_text_field( wp_unslash( $_GET['show_feature_event']) ) : sanitize_text_field( wp_unslash( $_GET['show_feature_event'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_recurring_event=isset($_GET['show_recurring_event']) ? sanitize_text_field( wp_unslash( $_GET['show_recurring_event']) ) : sanitize_text_field( wp_unslash( $_GET['show_recurring_event'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_tooltip_weburl=isset($_GET['show_tooltip_weburl']) ? sanitize_text_field( wp_unslash( $_GET['show_tooltip_weburl']) ) : sanitize_text_field( wp_unslash( $_GET['show_tooltip_weburl'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$calendar_start=isset($_GET['start']) ? sanitize_text_field( wp_unslash( $_GET['start']) ) : sanitize_text_field( wp_unslash( $_GET['start'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$calendar_end=isset($_GET['end']) ? sanitize_text_field( wp_unslash( $_GET['end']) ) : sanitize_text_field( wp_unslash( $_GET['end'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_start_date=isset($_GET['event_start_date']) ? sanitize_text_field( wp_unslash( $_GET['event_start_date']) ) : sanitize_text_field( wp_unslash( $_GET['event_start_date'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_end_date=isset($_GET['event_end_date']) ? sanitize_text_field( wp_unslash( $_GET['event_end_date']) ) : sanitize_text_field( wp_unslash( $_GET['event_end_date'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$single_event_page_link=isset($_GET['single_event_page_link']) ? sanitize_text_field( wp_unslash( $_GET['single_event_page_link']) ) : sanitize_text_field( wp_unslash( $_GET['single_event_page_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$disable_event_title_link=isset($_GET['disable_event_title_link']) ? sanitize_text_field( wp_unslash( $_GET['disable_event_title_link']) ) : sanitize_text_field( wp_unslash( $_GET['disable_event_title_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$disable_event_image_link=isset($_GET['disable_event_image_link']) ? sanitize_text_field( wp_unslash( $_GET['disable_event_image_link']) ) : sanitize_text_field( wp_unslash( $_GET['disable_event_image_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$disable_event_calendar_title_link=isset($_GET['disable_event_calendar_title_link']) ? sanitize_text_field( wp_unslash( $_GET['disable_event_calendar_title_link']) ) : sanitize_text_field( wp_unslash( $_GET['disable_event_calendar_title_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$custom_event_link_url=isset($_GET['custom_event_link_url']) ? sanitize_text_field( wp_unslash( $_GET['custom_event_link_url']) ) : sanitize_text_field( wp_unslash( $_GET['custom_event_link_url'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$custom_event_link_target=isset($_GET['custom_event_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_event_link_target']) ) : sanitize_text_field( wp_unslash( $_GET['custom_event_link_target'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$website_link=isset($_GET['website_link']) ? sanitize_text_field( wp_unslash( $_GET['website_link']) ) : sanitize_text_field( wp_unslash( $_GET['website_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$custom_website_link_text=isset($_GET['custom_website_link_text']) ? sanitize_text_field( wp_unslash( $_GET['custom_website_link_text']) ) : sanitize_text_field( wp_unslash( $_GET['custom_website_link_text'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$custom_website_link_target=isset($_GET['custom_website_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_website_link_target']) ) : sanitize_text_field( wp_unslash( $_GET['custom_website_link_target'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$enable_category_link=isset($_GET['enable_category_link']) ? sanitize_text_field( wp_unslash( $_GET['enable_category_link']) ) : sanitize_text_field( wp_unslash( $_GET['enable_category_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$thumbnail_width=isset($_GET['thumbnail_width']) ? sanitize_text_field( wp_unslash( $_GET['thumbnail_width']) ) : sanitize_text_field( wp_unslash( $_GET['thumbnail_width'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$thumbnail_height=isset($_GET['thumbnail_height']) ? sanitize_text_field( wp_unslash( $_GET['thumbnail_height']) ) : sanitize_text_field( wp_unslash( $_GET['thumbnail_height'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$custom_category_link_target=isset($_GET['custom_category_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_category_link_target']) ) : sanitize_text_field( wp_unslash( $_GET['custom_category_link_target'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_one_month_ahead = 1;
$event_end_date -=$show_one_month_ahead;
//$_GET['show_title']	
if ( $categories ) {
	if ( strpos( $categories, "," ) !== false ) {
		$categories = explode( ",", $categories );
		$categories  = array_map( 'trim',$categories );
	} else {
		$categories = array( trim( $categories ) );
	}

	$event_tax = array(
		'relation' => 'OR',
	);

	foreach ( $categories  as $cat ) {
		$event_tax[] = array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $cat,
			);
			
	}
}
//print_r($cat);
if($show_dynamic_content=="on"){
if($categslug){
	unset($event_tax);
	$event_tax[] = array(
		'taxonomy' => 'tribe_events_cat',
		'field' => 'term_id',
		'terms' => $categId,
	);
}
}


	$event_data = array();
$args = array(  
	'posts_per_page' => -1,
	'tax_query'=> $event_tax,
	'included_categories' =>$categslug=="" && $show_dynamic_content=="on"?$categories:$categslug,
	'hide_subsequent_recurrences'=>$show_recurring_event=="on"?false:true,
	//'featured'=>"false",
	 'start_date'   =>gmdate("Y-m-d H:i:s",strtotime("first day of this month-".$event_start_date." month")),
	 'end_date'   => gmdate("y-m-d H:i:s",strtotime("last day of this month"."+".$event_end_date." month")),
	// 'eventDisplay' => 'list',
	// 'ends_after' => 'now',
	//  'end_date'  =>  strstr($calendar_end, 'T', true),
	// 'lazyFatcheing'=>true,
);
if($show_feature_event=="on"){
	$args['featured']="true";

}
else{}
$events=tribe_get_events($args);
//calendar start=30-7-2021 and event start date 10-8-2021
// calendar end 4-7-2021 and event end date 6-8-2021
// Loop through the events, displaying the title and content for each

foreach ( $events as $event ) {
	$e = array();
	$category_names = array();
	$category_list = get_the_terms( $event->ID, 'tribe_events_cat' );
	if ( is_array( $category_list ) ) {
		foreach ( (array) $category_list as $category ) {
			/**
			 * Show Categories of every events
			 *
			 * @author bojana
			 */
			$categories_link =$show_tooltip_category=="on"? $enable_category_link=="on" ?'<a href="'.get_category_link( $category->term_id ).'" target="'.$custom_category_link_target.'" >'.$category->name.'</a>' : $category->name:"";
			$category_names[] = $categories_link;
		}
	}
  $link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_event_website_link($event->ID), $result);
  $result=tribe_get_event_website_link($event->ID)!=null?$result['href'][0]:tribe_get_event_link($event->ID);
 // print_r(($single_event_page_link=="default"?tribe_get_event_link($event->ID):$custom_event_link_url=="")?tribe_get_event_link($event->ID):$single_event_page_link=="redirect_link"?$result: $custom_event_link_url);
//print_r(tribe_get_event_categories( $event->ID, array('echo' => '','before' => '','sep'=> ', ','after'=> '','label'=> '','label_before' => '','label_after' => '','wrap_before' => '<div class ="event_category_style">','wrap_after' => '</div>',) ));
 $e['custom_event_link_url']=$single_event_page_link=="default" || ($single_event_page_link=="replace_link" &&$custom_event_link_url=="")?tribe_get_event_link($event->ID):(($single_event_page_link=="redirect_link")?$result: $custom_event_link_url);
$e["category_data"] =get_the_terms($event->ID,'tribe_events_cat');

 // $e["tooltip_category"]=$show_tooltip_category=="on"?$enable_category_link=="on"?tribe_get_event_categories( $event->ID, array('echo' => '','before' => '','sep'=> ', ','after'=> '','label'=> '','label_before' => '','label_after' => '','wrap_before' => '<div class ="event_category_style">','wrap_after' => '</div>',) ):'<div class ="event_category_style">'.$category->name.' </div>':"";
  $e["tooltip_category"]=$show_tooltip_category=="on"?'<div class ="event_category_style">'.implode(", ", $category_names).'</div>':"";
//   $e['joshi']= implode(", ", $category_names);

  $e['custom_website_link_text']=$custom_website_link_text==""?__("View Events Website",'decm-divi-event-calendar-module'):$custom_website_link_text;
  $e["title"]='<a class="'.$disable_event_calendar_title_link.'" href="'.$e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.$event->post_title .'</a>';
  $e["tooltip_title"]=$show_title=="on"?'<div class="event_title_style '.$disable_event_title_link.'"><h3 class="title_text"> <a calss="'.$disable_event_title_link.'" href="' . $e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.$event->post_title.'</a></h3></div>':"";
  $e["start"] =tribe_get_start_time( $event->ID,"H:i")!=""? tribe_get_start_date($event->ID,false,'Y-m-d')."T".tribe_get_start_time( $event->ID,"H:i"):tribe_get_start_date($event->ID,false,'Y-m-d');
  $e["end"] = tribe_get_end_time( $event->ID,"H:i")!=""?tribe_get_end_date( $event->ID,false,'Y-m-d')."T".tribe_get_end_time( $event->ID,"H:i"): gmdate('Y-m-d', strtotime( tribe_get_end_date($event->ID,false,'Y-m-d') . " +1 days"));
  $e['dateTimeSeparator']=tribe_get_option( 'dateTimeSeparator', ' @ ' );
  $e['timeRangeSeparator']=(tribe_get_start_date($event->ID,null,get_option( 'date_format' ))!= tribe_get_end_date($event->ID,null,get_option( 'date_format' )))&&$show_end_time==="off"?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";
  $e['timeRangeSeparatorEnd']=$show_end_time==="on"?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";
  $e['allDayEvent']=__('All Day Event','decm-divi-event-calendar-module');
  $e['calallday']=__('all-day','decm-divi-event-calendar-module');
  
  $e["venue"]=$venue=="on" && tribe_get_venue($event->ID)!=null ?'<div class="event_venue_style"><span> '.tribe_get_venue($event->ID).' </span></div>':"";
  $e["street"]=$street=="on"&& $location=="on" && tribe_get_address($event->ID)!=null?tribe_get_address($event->ID):"";
  $e["locality"]=$locality=="on"&& $location=="on" && tribe_get_city($event->ID)!=null?" ".tribe_get_city($event->ID):""; 
  $e["postal"]=$postal=="on"&& $location=="on" && tribe_get_zip($event->ID)!=null?" ".tribe_get_zip($event->ID):""; 
  $e["country"]=$country=="on" && $location=="on" && tribe_get_country($event->ID)!=null?" ".tribe_get_country($event->ID):""; 
  $e["organizer"]=$organizer=="on" && $location=="on" && tribe_get_organizer_link($event->ID)!=null?'<div class="event_organizer_style"><span> '.tribe_get_organizer($event->ID).' </span></div>':""; 
  //$e['gg'] = $_GET['show_tooltip_category'];
  $e["event_start_date"]= tribe_get_start_date( $event->ID,null,get_option('date_format'));
  $e["event_end_date"]=tribe_get_start_date($event->ID,null,get_option( 'date_format' ))!= tribe_get_end_date($event->ID,null,get_option( 'date_format' ))?"-".tribe_get_end_date( $event->ID,null,get_option('date_format')):"" ;
  $e["post_event_excerpt"] =$show_excerpt=="on"?'<div class="event_excerpt_style"><span>'.$event->post_excerpt.'</span></div>':"";
  $e["event_start_time"]=tribe_get_start_time( $event->ID,get_option('time_format'));
  $e["event_end_time"]=tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' ))?"-".tribe_get_end_time( $event->ID,get_option('time_format')):"" ;
  $e['featured_class'] = ( get_post_meta( $event->ID , '_tribe_featured', true ) ? ' decm-featured-event ' : '' );
  $e['tooltip_website_url']=$show_tooltip_weburl=="on" && tribe_get_event_website_link($event->ID)!=null?($website_link=='custom_text' || $website_link=='default_text') ?'<a href="'.$result.'" target="'.$custom_website_link_target.'">'.$e['custom_website_link_text'].'</a>':'<a href="'.$result.'" target="'.$custom_website_link_target.'">'.tribe_get_event_website_url($event->ID).'</a>':"";
  //$atts['website_link']=='custom_text'?'<a href="'.tribe_get_event_meta($event->ID, '_EventURL', true ).'" target="'.$custom_website_link_target.'">'.$custom_website_link_text.'</a>':tribe_get_event_website_link($event_post); 
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' )))
  { 
  $e["start_date"]=$show_date=="on"?$dateformat == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$dateformat):"";
  $e["end_date"]= $show_date=="on"?$dateformat == ""? tribe_get_end_date( $event->ID,null,get_option('date_format')):tribe_get_end_date( $event->ID,null,$dateformat):"";
  $e["start_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on"?$timeformat == ""?$e['dateTimeSeparator']." ".tribe_get_start_time( $event->ID,get_option('time_format')) :$e['dateTimeSeparator']." ".tribe_get_start_time($event->ID,$timeformat):""):"";
  $e["end_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on"&& $show_end_time=="on"?$timeformat == ""?$e['dateTimeSeparator']." ".tribe_get_end_time( $event->ID,get_option('time_format')):$e['dateTimeSeparator']." ".tribe_get_end_time($event->ID,$timeformat):""):__('All Day Event','decm-divi-event-calendar-module') ;
  $e["time_zone"]=!empty($timezone == 'off')?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
  }
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))== tribe_get_end_time($event->ID,get_option( 'time_format' )))
  {
	$e["start_date"]=$show_date=="on"?$dateformat == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$dateformat):"";
	$e["end_date"]= "";
	$e["start_time"]= "";
	$e["end_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on" && $show_end_time=="on"?$timeformat == ""?$e['dateTimeSeparator']." ". tribe_get_end_time( $event->ID,get_option('time_format')):$e['dateTimeSeparator']." ".tribe_get_end_time($event->ID,$timeformat):""):__('All Day Event','decm-divi-event-calendar-module');
	$e["time_zone"]=!empty($timezone == 'off')?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
  }
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' )))
{
	$e["start_date"]=$show_date=="on"?$dateformat == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$dateformat):"";
	$e["end_date"]= "";
	$e["start_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on"? $timeformat == ""?$e['dateTimeSeparator']." ".tribe_get_start_time( $event->ID,get_option('time_format')) :$e['dateTimeSeparator']." ".tribe_get_start_time($event->ID,$timeformat):""):"";
	$e["end_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on" && $show_end_time=="on"?$timeformat == ""?tribe_get_end_time( $event->ID,get_option('time_format')):tribe_get_end_time($event->ID,$timeformat):""):__('All Day Event','decm-divi-event-calendar-module') ;
	$e["time_zone"]=!empty($timezone == 'off')?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
	}
	if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))== tribe_get_end_time($event->ID,get_option( 'time_format' )))
	{
		$e["start_date"]=$show_date=="on"?$dateformat == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$dateformat):"";
		$e["end_date"]= $show_date=="on"?$dateformat == ""? tribe_get_end_date( $event->ID,null,get_option('date_format')):tribe_get_end_date( $event->ID,null,$dateformat):"";
		$e["start_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on"? $timeformat == ""?$e['dateTimeSeparator']." ".tribe_get_start_time( $event->ID,get_option('time_format')) :$e['dateTimeSeparator']." ".tribe_get_start_time($event->ID,$timeformat):""):"";
		$e["end_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on" && $show_end_time=="on"?$timeformat == ""?$e['dateTimeSeparator']." ".tribe_get_end_time( $event->ID,get_option('time_format')):$e['dateTimeSeparator']." ".tribe_get_end_time($event->ID,$timeformat):""):__('All Day Event','decm-divi-event-calendar-module') ;
		$e["time_zone"]=!empty($timezone == 'off')?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
		}

  $e["currency"]=$show_price=="on"?tribe_get_cost($event->ID,null,false)=="Free"?'<div class="event_price_style"><span>'.tribe_get_cost($event->ID,null,false).'</span></div>':'<div class="event_price_style"><span>'.tribe_get_event_meta( $event->ID, '_EventCurrencySymbol', true ).tribe_get_cost($event->ID,null,false).'</span></div>':"";
  $e['feature_image']=$show_image=="on"?'<div class="feature_img"><a class="'.$disable_event_image_link.'"  href="' . $e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.get_the_post_thumbnail( $event->ID,array($thumbnail_height,$thumbnail_width)).'</a><div>':"";
  $e["html"] = '<div class="tooltip_main">'.$e['feature_image'].'<div class="event_detail_style">'.$e['tooltip_title'].'<div class="tooltip_event_time"><div class="start_time"><span>'.$e["start_date"].' '.$e["start_time"].' </span></div><div class="end_time"><span>'.$e['timeRangeSeparator'].$e['timeRangeSeparatorEnd']." ".$e["end_date"].' '.$e["end_time"].' '.$e['time_zone'].'</span></div></div>'.$e["venue"].'<div class="event_address_style"><span>'.$e["street"].$e["locality"].$e["postal"].$e["country"].'</span></div>'.$e["organizer"].$e['currency'].trim($e["tooltip_category"],":").'<div class="event_website_url_style">'.$e['tooltip_website_url'].'</div>'.$e["post_event_excerpt"].'</div>'; 
  
  array_push($event_data, $e);
	// }
	// else{}
}

echo json_encode($event_data);
     exit;
}


endif;

add_action('wp_ajax_load_event_posts', 'load_event_posts');
add_action('wp_ajax_nopriv_load_event_posts', 'load_event_posts');
function load_event_posts() {	
require_once 'includes/modules/EventDisplay/EventAjax.php';
$show_atts=isset($_REQUEST['atts']) ? sanitize_text_field( wp_unslash( $_REQUEST['atts']) ) : sanitize_text_field( wp_unslash( $_REQUEST['atts'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$show_categId=isset($_REQUEST['categId']) ? sanitize_text_field( wp_unslash( $_REQUEST['categId']) ) : sanitize_text_field( wp_unslash( $_REQUEST['categId'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$att= stripslashes($show_atts);
$atts=json_decode($att);
$show_atts=isset($_REQUEST['atts']) ? sanitize_text_field( wp_unslash( $_REQUEST['atts']) ) : sanitize_text_field( wp_unslash( $_REQUEST['atts'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$categId=$show_categId;
$show_categslug=isset($_REQUEST['categslug']) ? sanitize_text_field( wp_unslash( $_REQUEST['categslug']) ) : sanitize_text_field( wp_unslash( $_REQUEST['categslug'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$categslug=$show_categslug;
$term_id = isset($_REQUEST['term_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['term_id']) ) : sanitize_text_field( wp_unslash( $_REQUEST['term_id'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$eventfeed_current_page=isset($_REQUEST['eventfeed_current_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_page']) ) : sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_page'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$current_page= !isset($eventfeed_current_page) ? 1 : $eventfeed_current_page;

$eventfeed_current_pagination_page=isset($_REQUEST['eventfeed_current_pagination_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page']) ) : sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$eventfeed_current_pagination_page=!isset($eventfeed_current_pagination_page) ? 1 : $eventfeed_current_pagination_page;

$filter_category = isset($_REQUEST['filter_event_category']) ? sanitize_text_field( wp_unslash( $_REQUEST['filter_event_category']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification 
$filter_organizer = isset($_REQUEST['event_filter_organizer']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_organizer']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_tag=isset($_REQUEST['event_filter_tag']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_tag']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_venue=isset($_REQUEST['event_filter_venue']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_venue']) ) : "";   //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_search = isset($_REQUEST['event_filter_search']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_search']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_time = isset($_REQUEST['event_filter_time']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_time']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_day = isset($_REQUEST['event_filter_day']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_day']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_month = isset($_REQUEST['event_filter_month']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_month']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_year = isset($_REQUEST['event_filter_year']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_year']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$maxCost = isset($_REQUEST['event_maxCost']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_maxCost']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$minCost = isset($_REQUEST['event_minCost']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_minCost']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_startDate = isset($_REQUEST['event_startDate']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_startDate']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_endDate = isset($_REQUEST['event_endDate']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_endDate']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_city = isset($_REQUEST['event_filter_city']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_city']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_country = isset($_REQUEST['event_filter_country']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_country']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_state = isset($_REQUEST['event_filter_state']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_state']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_address = isset($_REQUEST['event_filter_address']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_address']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_order = isset($_REQUEST['event_filter_order']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_order']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$module_class_check = "events-display-module"; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification

echo et_core_esc_previously(eventfeed_ajax_fetch_events($atts, 
$eventfeed_current_pagination_page, 
$current_page,
$categId,
$categslug,
$term_id,
$filter_category, 
$filter_organizer, 
$filter_tag,
$filter_venue,
$filter_search,
$filter_time,
$filter_day,
$filter_month,
$filter_year,
$maxCost,
$minCost,
$event_startDate,
$event_endDate,
$event_filter_country, 
$event_filter_city,
$event_filter_state,
$event_filter_address,
$event_filter_order,
$module_class_check
));
//echo et_core_esc_previously(ecs_fetch_events( $atts,$event_filter, $render_slug, $conditional_tags = array(), $current_page = array() ));

die();
  }

add_action('wp_ajax_filters_event_posts', 'filters_event_posts');
add_action('wp_ajax_nopriv_filters_event_posts', 'filters_event_posts');
function filters_event_posts() {	
require_once 'includes/modules/EventDisplay/EventAjax.php';
$show_atts=isset($_REQUEST['atts']) ? sanitize_text_field( wp_unslash( $_REQUEST['atts']) ) : sanitize_text_field( wp_unslash( $_REQUEST['atts'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
//$show_categId=isset($_REQUEST['categId']) ? sanitize_text_field( wp_unslash( $_REQUEST['categId']) ) : sanitize_text_field( wp_unslash( $_REQUEST['categId'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$att= stripslashes($show_atts);
$atts=json_decode($att);
$show_atts=isset($_REQUEST['atts']) ? sanitize_text_field( wp_unslash( $_REQUEST['atts']) ) : sanitize_text_field( wp_unslash( $_REQUEST['atts'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification

//$categId=$show_categId;

// $show_categslug=isset($_REQUEST['categslug']) ? sanitize_text_field( wp_unslash( $_REQUEST['categslug']) ) : sanitize_text_field( wp_unslash( $_REQUEST['categslug'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
// $categslug=$show_categslug;

$categId = isset($_REQUEST['categId']) ? sanitize_text_field( wp_unslash( $_REQUEST['categId']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification

$categslug = isset($_REQUEST['categslug']) ? sanitize_text_field( wp_unslash( $_REQUEST['categslug']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification


//$term_id = isset($_REQUEST['term_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['term_id']) ) : sanitize_text_field( wp_unslash( $_REQUEST['term_id'] ) );

$term_id = isset($_REQUEST['term_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['term_id']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
// $eventfeed_current_page=isset($_REQUEST['eventfeed_current_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_page']) ) : sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_page'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
// $current_page= !isset($eventfeed_current_page) ? 1 : $eventfeed_current_page;

$current_page = isset($_REQUEST['eventfeed_current_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_page']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification

// $eventfeed_current_pagination_page = isset($_REQUEST['eventfeed_current_pagination_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page']) ) : sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
// $eventfeed_current_pagination_page = !isset($eventfeed_current_pagination_page) ? 1 : $eventfeed_current_pagination_page;

$eventfeed_current_pagination_page = isset($_REQUEST['eventfeed_current_pagination_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification

$eventfeed_current_pagination_page = isset($_REQUEST['eventfeed_current_pagination_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_category = isset($_REQUEST['filter_event_category']) ? sanitize_text_field( wp_unslash( $_REQUEST['filter_event_category']) ) : "";     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_organizer = isset($_REQUEST['event_filter_organizer']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_organizer']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_tag=isset($_REQUEST['event_filter_tag']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_tag']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_venue=isset($_REQUEST['event_filter_venue']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_venue']) ) : "";   //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_search = isset($_REQUEST['event_filter_search']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_search']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_time = isset($_REQUEST['event_filter_time']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_time']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_day = isset($_REQUEST['event_filter_day']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_day']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_month = isset($_REQUEST['event_filter_month']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_month']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$filter_year = isset($_REQUEST['event_filter_year']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_year']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$maxCost = isset($_REQUEST['event_maxCost']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_maxCost']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$minCost = isset($_REQUEST['event_minCost']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_minCost']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_startDate = isset($_REQUEST['event_startDate']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_startDate']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_endDate = isset($_REQUEST['event_endDate']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_endDate']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_city = isset($_REQUEST['event_filter_city']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_city']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_country = isset($_REQUEST['event_filter_country']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_country']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_state = isset($_REQUEST['event_filter_state']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_state']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_address = isset($_REQUEST['event_filter_address']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_address']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_order = isset($_REQUEST['event_filter_order']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_order']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$module_class_check = "filters-event-module";

echo et_core_esc_previously(eventfeed_ajax_fetch_events($atts, 
$eventfeed_current_pagination_page, 
$current_page,
$categId,
$categslug,
$term_id,
$filter_category, 
$filter_organizer, 
$filter_tag,
$filter_venue,
$filter_search, 
$filter_time,
$filter_day,
$filter_month,
$filter_year,
$maxCost,
$minCost,
$event_startDate,
$event_endDate,
$event_filter_country, 
$event_filter_city,
$event_filter_state,
$event_filter_address,
$event_filter_order, 
$module_class_check
));
//echo et_core_esc_previously(ecs_fetch_events( $atts,$event_filter, $render_slug, $conditional_tags = array(), $current_page = array() ));

die();
  }


