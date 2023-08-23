<?php
/**
 * Plugin Name: Post Category Image Grid and Slider Pro
 * Plugin URI: https://www.essentialplugin.com/wordpress-plugin/post-category-image-grid-slider/
 * Description: Post Category Image Grid and Slider allows you to upload category (taxonomy) image and display them in Grid OR Slider view.
 * Author: Essential Plugin
 * Author URI: https://www.essentialplugin.com
 * Text Domain: post-category-image-with-grid-and-slider
 * Domain Path: languages
 * Version: 1.6
 * 
 * @package Post Category Image With Grid and Slider Pro
 * @author Essential Plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Basic plugin definations
 * 
 * @since 1.0.0
 */
if( ! defined( 'PCIWGASPRO_VERSION' ) ) {
	define( 'PCIWGASPRO_VERSION', '1.6' ); // Version of plugin
}
if( ! defined( 'PCIWGASPRO_URL' ) ) {
	define( 'PCIWGASPRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( ! defined( 'PCIWGASPRO_DIR' ) ) {
	define( 'PCIWGASPRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( ! defined( 'PCIWGASPRO_PLUGIN_BASE' ) ) {
	define( 'PCIWGASPRO_PLUGIN_BASE',  plugin_dir_path(__FILE__)); // plugin base
}
if( ! defined( 'PCIWGASPRO_META_PREFIX' ) ) {
	define( 'PCIWGASPRO_META_PREFIX',  '_pciwgas_'); // plugin base
}
if( ! defined( 'PCIWGASPRO_PLUGIN_BASENAME' ) ) {
	define( 'PCIWGASPRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( ! defined( 'WPOS_TEMPLATE_DEBUG_MODE' ) ) {
	define( 'WPOS_TEMPLATE_DEBUG_MODE', false ); // DEBUG MODE
}
if( ! defined( 'WPOS_HIDE_LICENSE' ) ) {
	define( 'WPOS_HIDE_LICENSE', 'info' ); // Template Debug Mode
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @since 1.0.0
 */
function pciwgas_pro_load_textdomain() {

	global $wp_version;

	// Set filter for plugin's languages directory
	$pciwgaspro_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$pciwgaspro_lang_dir = apply_filters( 'pciwgaspro_languages_directory', $pciwgaspro_lang_dir );

	// Traditional WordPress plugin locale filter.
	$get_locale = get_locale();

	if ( $wp_version >= 4.7 ) {
		$get_locale = get_user_locale();
	}

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale',  $get_locale, 'post-category-image-with-grid-and-slider' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'post-category-image-with-grid-and-slider', $locale );

	// Setup paths to current locale file
	$mofile_global  = WP_LANG_DIR . '/plugins/' . basename( PCIWGASPRO_DIR ) . '/' . $mofile;

	if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
		load_textdomain( 'post-category-image-with-grid-and-slider', $mofile_global );
	} else { // Load the default language files
		load_plugin_textdomain( 'post-category-image-with-grid-and-slider', false, $pciwgaspro_lang_dir );
	}
}

/**
 * Plugins Load
 * Plugin load functionality and function call
 * 
 * @since 1.0.0
 */
function pciwgas_pro_plugin_loaded() {

	global $pagenow;

	// Translation Textdomain
	pciwgas_pro_load_textdomain();

	// Defining page slug after localization
	if( ! defined( 'PCIWGASPRO_SCREEN_ID' ) ) {
		define( 'PCIWGASPRO_SCREEN_ID', sanitize_title( __('Post Category Designs - Pro', 'post-category-image-with-grid-and-slider')) );
	}

	// VC Shortcode File
	if( class_exists('Vc_Manager') ) {
		require_once( PCIWGASPRO_DIR . '/includes/admin/supports/class-pciwgaspro-vc.php' );
	}

	/**
	 * Shortcode Widgets
	 * If check widgets screen is not there
	 * If Elementor Page Builder is Installed
	 * If SiteOrigin Page Builder is Installed
	 * If Beaver Page Builder is Installed
	 */
	if( $pagenow != 'widgets.php' && ( defined('ELEMENTOR_PLUGIN_BASE') || class_exists('SiteOrigin_Panels') || class_exists( 'FLBuilderModel' ) ) ) {
		require_once( PCIWGASPRO_DIR . '/includes/widgets/shortcode/pciwgas-shortcode-widgets.php' );
	}
}

// Plugins Load Actions
add_action('plugins_loaded', 'pciwgas_pro_plugin_loaded');

/**
 * Activation Hook
 * Register plugin activation hook.
 * 
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'pciwgas_pro_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @since 1.0.0
 */
function pciwgas_pro_install() {

	// Get settings for the plugin
	$pciwgas_pro_opts = get_option( 'pciwgaspro_options' );

	if( empty( $pciwgas_pro_opts ) ) { // Check plugin version option

		// Set default settings
		pciwgas_pro_set_default_sett();

		// Update plugin version to option
		update_option( 'pciwgaspro_plugin_version', '1.0' );
	}

	// Deactivate free version
	if( is_plugin_active('post-category-image-with-grid-and-slider/post-category-image-with-grid-and-slider.php') ) {
		add_action('update_option_active_plugins', 'pciwgas_pro_deactivate_free_version');
	}
}

/**
 * Deactivation Hook
 * Register plugin deactivation hook.
 * 
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'pciwgas_pro_uninstall' );

/**
 * Plugin Deactivation
 * Delete plugin options.
 * 
 * @since 1.0.0
 */
function pciwgas_pro_uninstall() {
	// Uninstall functionality
}

/**
 * Deactivate free plugin
 * 
 * @since 1.0.0
 */
function pciwgas_pro_deactivate_free_version() {
	deactivate_plugins('post-category-image-with-grid-and-slider/post-category-image-with-grid-and-slider.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @since 1.0.0
 */
function pciwgas_pro_admin_notice() {

	global $pagenow;

	// If not plugin screen
	if( 'plugins.php' != $pagenow ) {
		return;
	}

	// Check Lite Version
	$dir = WP_PLUGIN_DIR . '/post-category-image-with-grid-and-slider/post-category-image-with-grid-and-slider.php';

	if( ! file_exists( $dir ) ) {
		return;
	}

	$notice_link		= add_query_arg( array('message' => 'pciwgaspro-plugin-notice'), admin_url('plugins.php') );
	$notice_transient	= get_transient( 'pciwgas_pro_install_notice' );

	// If PRO plugin is active and free plugin exist
	if( $notice_transient == false && current_user_can( 'install_plugins' ) ) {
		echo '<div class="updated notice" style="position:relative;">
					<p>
						<strong>'.sprintf( __('Thank you for activating %s', 'post-category-image-with-grid-and-slider'), 'Post Category Image With Grid and Slider Pro').'</strong>.<br/>
						'.sprintf( __('It looks like you had FREE version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'post-category-image-with-grid-and-slider'), '<strong>(<em>Post Category Image With Grid and Slider</em>)</strong>' ).'
					</p>
					<a href="'.esc_url( $notice_link ).'" class="notice-dismiss" style="text-decoration:none;"></a>
				</div>';
	}
}

// Action to display notice
add_action( 'admin_notices', 'pciwgas_pro_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_PCIWGASPRO_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_PCIWGASPRO_ITEM_NAME', 'Post Category Image With Grid and Slider Pro' );

// Plugin Updator Class 
if( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include( PCIWGASPRO_DIR . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @since 1.0.0
 */
function pciwgas_pro_plugin_updater() {

	$license_key = trim( get_option( 'edd_pciwgaspro_license_key' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_PCIWGASPRO_STORE_URL, __FILE__, array(
				'version'	=> PCIWGASPRO_VERSION,			// current version number
				'item_name'	=> EDD_PCIWGASPRO_ITEM_NAME,	// name of this plugin
				'license'	=> $license_key,				// license key (used get_option above to retrieve from DB)
				'author'	=> 'WP Online Support'			// author of this plugin
			)
	);
}
add_action( 'admin_init', 'pciwgas_pro_plugin_updater', 0 );
/***** Updater Code Ends *****/

global $pciwgas_pro_opts;

// Function file
require_once( PCIWGASPRO_DIR . '/includes/pciwgas-function.php' );
$pciwgas_pro_opts = pciwgas_pro_get_settings();

// Template Function
require_once( PCIWGASPRO_DIR . '/includes/pciwgas-template-functions.php' );

// Script Class
require_once( PCIWGASPRO_DIR . '/includes/class-pciwgas-script.php' );

// Shortcode Files
require_once( PCIWGASPRO_DIR . '/includes/shortcode/pciwgas-grid.php' );
require_once( PCIWGASPRO_DIR . '/includes/shortcode/pciwgas-slider.php' );

// Shortcode Builder
require_once( PCIWGASPRO_DIR . '/includes/admin/supports/pciwgaspro-shortcode-fields.php' );

// Gutenberg Block Initializer
if ( function_exists( 'register_block_type' ) ) {
	require_once( PCIWGASPRO_DIR . '/includes/admin/supports/gutenberg-block.php' );
}

// Load how it work files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {

	// Admin Class
	require_once( PCIWGASPRO_DIR . '/includes/admin/class-pciwgas-admin.php' );

	// How It Works File
	include_once( PCIWGASPRO_DIR . '/includes/admin/pciwgas-how-it-work.php' );

	if( ! defined( 'WPOS_HIDE_LICENSE' ) || ( defined( 'WPOS_HIDE_LICENSE' ) && WPOS_HIDE_LICENSE != 'page' ) ) {
		require_once( PCIWGASPRO_DIR . '/pciwgas-plugin-updater.php' );
	}
}