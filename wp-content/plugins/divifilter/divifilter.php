<?php
/*
  Plugin Name:        Divi Filter Premium
  Plugin URI:         https://shop.danielvoelk.de/#divi-filter
  Description:        A plugin to filter every module in the Divi theme.
  Version:            3.8.4
  Requires at least:  4.9
  Requires PHP:       7.2
  Author:             Daniel Voelk
  Author URI:         https://shop.danielvoelk.de/
  License:            GPL2
  License URI:        https://www.gnu.org/licenses/gpl-2.0.html
  Update URI:         https://danielvoelk.de/df-files/version.json
  
  Divi Filter is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 2 of the License, or
  any later version.
  
  Divi Filter is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.
  
  You should have received a copy of the GNU General Public License
  along with Divi Filter. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
  */

  /** Our plugin class */
  class DiviFilterPremium {
    public function __construct() {
      /** Step 1 (hook). */
      add_action( 'admin_menu', [ $this, 'my_plugin_menu' ] );
  
      /** Setup fields. */
      add_action( 'admin_init', [ $this, 'my_plugin_fields' ] );

      /** add filter files */
      add_action( 'wp_enqueue_scripts', [ $this, 'divifilter_add_files' ] );  

      /** add Upgrade link */
      add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), [ $this, 'filter_action_links' ] );

      /** add Documentation link */
      add_filter( 'plugin_row_meta', [ $this, 'add_documentation_link' ], 10, 2 );

      if (!wp_next_scheduled('df_check')) {
        $error = wp_schedule_event( time(), 'daily', 'df_check' );
      }
      
      add_action( 'df_check', [ $this, 'dv_check' ] );

      $this->dv_check();

      add_option('kV', false);

      add_option('dvServerResponse', "FREE");
 
    }
  
    public function my_plugin_fields() {
      /** Check permissions. */
      if ( ! current_user_can( 'manage_options' ) )  {
        return;
      }
    
      add_settings_section( 'divi_field_section', 'Divi Filter', false, 'divi-filter-menu' );
    
      add_settings_field( 'key_input', 'Key', [ $this, 'df_callback' ], 'divi-filter-menu', 'divi_field_section' );
    
      register_setting( 'divi-filter-menu', 'key_input' );
    }

    public function dv_check() {

      if((get_option('key_input') !== null) || (get_option('key_input') !== "")){ 
  
        $key_input = get_option('key_input');
  
        $current_domain = $_SERVER['SERVER_NAME'];
  
        // update domain and get feedback
        $server_output = wp_remote_get("https://danielvoelk.de/df-files/license/license-get-status.php?key=$key_input");

        if ( is_array( $server_output ) && ! is_wp_error( $server_output ) ) {
          $server_output = $server_output['body'];
        }

        if( !$server_output || !is_string($server_output) ) {
          update_option('kV', false);
        } else {

          if ( strpos($server_output, '200') !== false ) {
      
            if (strpos($server_output, 'PREMIUM') !== false) {
              update_option('kV', true);
            }
            else {
              update_option('kV', false);
            }
  
            update_option('dvServerResponse', $server_output);
  
          }

        }
  
  
      }
      else {
        update_option('kV', false);
      }
  
    }
    
    public function df_callback() {
      echo '<input type="password" name="key_input" value="' . esc_attr( get_option( 'key_input' ) ) . '" /><br>';

      if((get_option('key_input') !== null) || (get_option('key_input') !== "")){ 
  
        $key_input = get_option('key_input');
  
        $current_domain = $_SERVER['SERVER_NAME'];
  
        // update domain and get feedback
        $server_output = wp_remote_get("https://danielvoelk.de/df-files/license/license-update-domain.php?key=$key_input&domain=$current_domain");

        if ( is_array( $server_output ) && ! is_wp_error( $server_output ) ) {
          $server_output = $server_output['body']; // use the content
          
          if ( strpos($server_output, '200') !== false ) {
  
            // show status
            echo "<script>setTimeout(function(){ jQuery('#serverOutput').html(" . json_encode($server_output) . "); }, 300);</script>";
      
            if (strpos($server_output, 'PREMIUM') !== false) {
              update_option('kV', true);
            }
            else {
              update_option('kV', false);
            }
  
            update_option('dvServerResponse', $server_output);
  
          }
          else {
            // show status
            echo "<script>setTimeout(function(){ jQuery('#serverOutput').html(" . json_encode(get_option('dvServerResponse')) . "); }, 300);</script>";
          }
        }

  
      }
      else {
        update_option('kV', false);
      }

    }

    /** Step 2 (add item). */
    public function my_plugin_menu() {
      $page_title = 'Divi Filter Options';
      $menu_title = 'Divi Filter';
      $capability = 'manage_options'; // Only users that can manage options can access this menu item.
      $menu_slug  = 'divi-filter'; // unique identifier.
      $callback   = [ $this, 'my_plugin_options' ];
      add_options_page( $page_title, $menu_title, $capability, $menu_slug, $callback );
    }

    /** Step 3 (page html). */
    public function my_plugin_options() { ?>
      <div class="wrap">
        <form method="post" action="options.php">
          <?php settings_fields( 'divi-filter-menu' ); ?>
          <?php do_settings_sections( 'divi-filter-menu' ); ?>
          <?php submit_button(); ?>
        </form>
        <p>Status: <span id="serverOutput"></span></p>
      </div>
      <?php
    }

    public function filter_action_links( $links ) {

      if( ! get_option('kV') ) {       // Check to see if premium version already installed
        $links['upgrade'] = '<a style="font-weight: bold;" href="https://shop.danielvoelk.de/#divi-filter" target="_blank">Go Premium</a>';
      }

      return $links;
    }
    
    public function divifilter_add_files() {

      wp_register_script('df-script', plugins_url('df-script.js', __FILE__), array('jquery'),'3.8.4', true);
      wp_enqueue_script('df-script');

      $script_params = get_option('dvServerResponse');
      wp_localize_script( 'df-script', 'dvServerResponse', [ $script_params ] );

      wp_register_style('df-style', plugins_url('df-style.css', __FILE__), array(), '3.8.4');
      wp_enqueue_style('df-style');
    
    }

    public function add_documentation_link( $links, $file ) {    
      if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'docs'    => '<a href="https://docs.danielvoelk.de/" target="_blank">Documentation</a>'
        );

        return array_merge( $links, $row_meta );
      }
      return (array) $links;
    }

  }

new DiviFilterPremium();

// auto update
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://danielvoelk.de/df-files/version.json',
	__FILE__ //Full path to the main plugin file or functions.php.
	// 'unique-plugin-or-theme-slug'
);