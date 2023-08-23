<?php
/**
 * Script Class
 * Handles the script and style functionality of plugin
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pciwgas_Pro_Script {

	function __construct() {

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array( $this, 'pciwgas_pro_admin_style_script' ) );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'pciwgas_pro_front_style_script' ) );

		// Action to add admin script and style when edit with elementor at admin side
		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'pciwgas_pro_admin_builder_script_style' ) );

		// Action to add admin script and style when edit with SiteOrigin at admin side
		add_action('siteorigin_panel_enqueue_admin_scripts', array( $this, 'pciwgas_pro_admin_builder_script_style' ), 10, 2);

		// Action to add custom css in head
		add_action( 'wp_head', array( $this, 'pciwgas_pro_custom_css' ), 20 );
	}

	/**
	 * Function to register admin scripts and styles
	 * 
	 * @since 1.5
	 */
	function pciwgas_pro_register_admin_assets() {

		global $wp_version;

		/* Styles */
		// Registring admin css
		wp_register_style( 'pciwgas-admin-style', PCIWGASPRO_URL.'assets/css/pciwgas-admin.css', array(), PCIWGASPRO_VERSION );

		/* Scripts */
		// Registring admin script
		wp_register_script( 'pciwgas-admin-js', PCIWGASPRO_URL.'assets/js/pciwgas-admin.js', array('jquery'), PCIWGASPRO_VERSION, true );
		wp_localize_script('pciwgas-admin-js', 'PciwgasAdmin', array(
															'code_editor'			=> ( version_compare( $wp_version, '4.9' ) >= 0 ) ? 1 : 0,
															'syntax_highlighting'	=> ( 'false' === wp_get_current_user()->syntax_highlighting ) ? 0 : 1,
															'confirm_msg'			=> esc_js( __('Are you sure you want to do this?', 'post-category-image-with-grid-and-slider') ),
														));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @since 1.0
	 */
	function pciwgas_pro_admin_style_script( $hook ) {

		global $wp_version, $pagenow, $taxonomy;

		$this->pciwgas_pro_register_admin_assets();

		// Use minified libraries if SCRIPT_DEBUG is turned off
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '_' : '.min';

		// Taking some variables
		$pages_array = array( 'toplevel_page_pciwgas-pro-settings', 'edit-tags.php', 'term.php', PCIWGASPRO_SCREEN_ID.'_page_pciwgas-pro-shrt-mapper' );

		// If page is plugin setting page then enqueue script
		if( in_array( $hook, $pages_array ) ) {

			// Enquque admin script
			wp_enqueue_style( 'pciwgas-admin-style' );
			wp_enqueue_media();
		}

		// Shortcode Builder
		if( $hook == PCIWGASPRO_SCREEN_ID.'_page_pciwgas-pro-shrt-mapper' ) {

			// Registring admin script
			wp_register_script( 'pciwgaspro-shortcode-mapper', PCIWGASPRO_URL."assets/js/pciwgas-shrt-mapper{$suffix}.js", array('jquery'), PCIWGASPRO_VERSION, true );
			wp_localize_script( 'pciwgaspro-shortcode-mapper', 'Pciwgaspro_Shrt_Mapper', array(
																	'shortocde_err' => esc_js( __("Sorry, Something happened wrong. Kindly please be sure that you have choosen relevant shortocde from the dropdown.", 'post-category-image-with-grid-and-slider') ),
																));

			wp_enqueue_script('shortcode');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('pciwgaspro-shortcode-mapper');
		}

		if( ( version_compare( $wp_version, '4.9' ) >= 0 ) && $hook == 'toplevel_page_pciwgas-pro-settings' ) {

			// WP CSS Code Editor
			wp_enqueue_code_editor( array(
				'type' 			=> 'text/css',
				'codemirror' 	=> array(
					'indentUnit' 	=> 2,
					'tabSize'		=> 2,
					'lint'			=> false,
				),
			) );

			wp_enqueue_script( 'pciwgas-admin-js' );
		}

		// Enqueue Admin Script
		$selected_cat = pciwgas_pro_get_opt( 'pciwgas_category', array() );

		if( $hook == PCIWGASPRO_SCREEN_ID.'_page_pciwgas-pro-designs' || ( in_array( $hook, $pages_array, true ) && in_array( $taxonomy, $selected_cat, true ) ) ) {
			wp_enqueue_script('pciwgas-admin-js');
		}

		// VC Page Builder Frontend
		if( function_exists('vc_is_inline') && vc_is_inline() ) {
			wp_register_script( 'pciwgas-vc', PCIWGASPRO_URL . 'assets/js/vc/pciwgas-vc.js', array(), PCIWGASPRO_VERSION, true );
			wp_enqueue_script( 'pciwgas-vc' );
		}
	}

	/**
	 * Function to add script at front side
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_front_style_script() {
			
		global $post;

		// Use minified libraries if SCRIPT_DEBUG is turned off
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '_' : '.min';

		/***** Styles *****/
		// Registring slick style
		if( ! wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', PCIWGASPRO_URL.'assets/css/slick.css', array(), PCIWGASPRO_VERSION );
		}

		// Registring public style
		wp_register_style( 'pciwgas-publlic-style', PCIWGASPRO_URL."assets/css/pciwgas-public{$suffix}.css", array(), PCIWGASPRO_VERSION );

		wp_enqueue_style( 'wpos-slick-style' );
		wp_enqueue_style( 'pciwgas-publlic-style' );


		/***** Scripts *****/
		// Registring slick slider script
		if( ! wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', PCIWGASPRO_URL.'assets/js/slick.min.js', array('jquery'), PCIWGASPRO_VERSION, true );
		}

		// Register Elementor script
		wp_register_script( 'pciwgas-elementor-script', PCIWGASPRO_URL.'assets/js/elementor/pciwgas-elementor.js', array('jquery'), PCIWGASPRO_VERSION, true );

		// Registring public script
		wp_register_script( 'pciwgas-public-script', PCIWGASPRO_URL."assets/js/pciwgas-public{$suffix}.js", array('jquery'), PCIWGASPRO_VERSION, true );
		wp_localize_script( 'pciwgas-public-script', 'Pciwgas', pciwgas_pro_public_script_vars() );

		// VC Page Builder Frontend
		if( function_exists('vc_is_inline') && vc_is_inline() ) {
			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'pciwgas-public-script' );
		}

		// Enqueue Script for Elementor Preview
		if ( defined('ELEMENTOR_PLUGIN_BASE') && isset( $_GET['elementor-preview'] ) && $post->ID == (int) $_GET['elementor-preview'] ) {

			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'pciwgas-public-script' );
			wp_enqueue_script( 'pciwgas-elementor-script' );
		}

		// Enqueue Style & Script for Beaver Builder
		if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {

			$this->pciwgas_pro_register_admin_assets();

			wp_enqueue_style( 'pciwgas-admin-style');
			wp_enqueue_script( 'pciwgas-admin-js' );
			wp_enqueue_script( 'wpos-slick-jquery' );
			wp_enqueue_script( 'pciwgas-public-script' );
		}

		// Enqueue Admin Style & Script for Divi Page Builder
		if( function_exists( 'et_core_is_fb_enabled' ) && isset( $_GET['et_fb'] ) && $_GET['et_fb'] == 1 ) {
			$this->pciwgas_pro_register_admin_assets();

			wp_enqueue_style( 'pciwgas-admin-style');
		}

		// Enqueue Admin Style for Fusion Page Builder
		if( class_exists( 'FusionBuilder' ) && (( isset( $_GET['builder'] ) && $_GET['builder'] == 'true' ) ) ) {
			$this->pciwgas_pro_register_admin_assets();

			wp_enqueue_style( 'pciwgas-admin-style');
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @since 1.5
	 */
	function pciwgas_pro_admin_builder_script_style() {
		$this->pciwgas_pro_register_admin_assets();

		wp_enqueue_style( 'pciwgas-admin-style');
		wp_enqueue_script( 'pciwgas-admin-js' );
	}

	/**
	 * Add custom css to head
	 * 
	 * @since 1.1
	 */
	function pciwgas_pro_custom_css() {

		// Custom CSS
		$custom_css = pciwgas_pro_get_opt( 'custom_css' );

		if( ! empty( $custom_css ) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= wp_strip_all_tags( $custom_css );
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$pciwgas_pro_script = new Pciwgas_Pro_Script();