<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pciwgas_Pro_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array( $this, 'pciwgas_pro_register_menu' ) );

		// Action to register plugin settings
		add_action( 'admin_init', array( $this, 'pciwgas_pro_admin_init_process' ) );
		
		// Shortocde Preview
		add_action( 'current_screen', array( $this, 'pciwgas_pro_generate_preview_screen' ) );

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'pciwgas_pro_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_register_menu() {

		//Settings Page
		add_menu_page ( __('Post Category Image Grid and Slider Pro', 'post-category-image-with-grid-and-slider'), __('Post Category Designs - Pro', 'post-category-image-with-grid-and-slider'), 'manage_options', 'pciwgas-pro-settings', array($this, 'pciwgas_pro_settings_page'), 'dashicons-screenoptions' );

		// Shortocde Mapper
		add_submenu_page( 'pciwgas-pro-settings', __('Post Category Image Grid and Slider Pro - Shortcode Builder', 'post-category-image-with-grid-and-slider'), __('Shortcode Builder', 'post-category-image-with-grid-and-slider'), 'edit_posts', 'pciwgas-pro-shrt-mapper', array($this, 'pciwgas_pro_shortcode_mapper_page') );

		// Shortocde Preview
		add_submenu_page( null, __('Shortcode Preview', 'post-category-image-with-grid-and-slider'), __('Shortcode Preview', 'post-category-image-with-grid-and-slider'), 'edit_posts', 'pciwgas-pro-preview', array($this, 'pciwgas_pro_shortcode_preview_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_settings_page() {
		include_once( PCIWGASPRO_DIR . '/includes/admin/settings/settings.php' );
	}

	/**
	 * Function to handle plugin shoercode preview
	 * 
	 * @since 1.3
	 */
	function pciwgas_pro_shortcode_mapper_page() {
		include_once( PCIWGASPRO_DIR . '/includes/admin/shortcode-mapper/pciwgaspro-shortcode-mapper.php' );
	}

	/**
	 * Function to handle plugin shoercode preview
	 * 
	 * @since 1.3
	 */
	function pciwgas_pro_generate_preview_screen( $screen ) {
		if( $screen->id == 'admin_page_pciwgas-pro-preview' ) {
			include_once( PCIWGASPRO_DIR . '/includes/admin/shortcode-mapper/shortcode-preview.php' );
			exit;
		}
	}

	/**
	 * Function to handle plugin shoercode preview
	 * 
	 * @since 1.3
	 */
	function pciwgas_pro_shortcode_preview_page() {
	}

	/**
	 * Function register setings
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_admin_init_process() {
		
		// If plugin notice is dismissed
		if( isset( $_GET['message'] ) && 'pciwgaspro-plugin-notice' == $_GET['message'] ) {
			set_transient( 'pciwgas_pro_install_notice', true, 604800 );
		}

		// If plugin notice is dismissed
		if( isset($_GET['message']) && 'pciwgaspro-plugin-license-exp-notice' == $_GET['message'] ) {
			set_transient( 'pciwgas_pro_license_exp_notice', true, 864000 );
		}

		// Reset default settings
		if( ! empty( $_POST['pciwgas_reset_settings'] ) ) {

			// Default Settings
			pciwgas_pro_set_default_sett();
		}

		// Register Plugin Settings
		register_setting( 'pciwgaspro_plugin_options', 'pciwgaspro_options', array($this, 'pciwgas_pro_validate_opts') );

		// Taxonomy Actions
		$taxonomies = pciwgas_pro_get_opt( 'pciwgas_category' );

		if( ! empty( $taxonomies ) ) {
			foreach ((array) $taxonomies as $taxonomy) {
				$this->pciwgas_pro_taxonomy_hooks( $taxonomy );
			}
		}
	}

	/**
	 * Validate Settings Options
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_validate_opts( $input ) {
	
		$input['default_img'] 		= isset( $input['default_img'] )		? pciwgas_pro_clean_url( $input['default_img'] )	: '';
		$input['pciwgas_category']	= isset( $input['pciwgas_category'] ) 	? pciwgas_pro_clean( $input['pciwgas_category'] )	: '';
		$input['custom_css']		= isset( $input['custom_css'] ) 		? sanitize_textarea_field( $input['custom_css'] )	: '';

		return $input;
	}

	/**
	 * Add custom column field
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_taxonomy_hooks( $taxonomy ) {

		add_action( "{$taxonomy}_add_form_fields", array($this, 'pciwgas_pro_add_taxonomy_field') );
		add_action( "{$taxonomy}_edit_form_fields", array($this, 'pciwgas_pro_edit_taxonomy_field'), 10, 2 );

		// Save taxonomy fields
		add_action( 'edited_'.$taxonomy, array($this, 'pciwgas_pro_save_taxonomy_meta') );
		add_action( 'create_'.$taxonomy, array($this, 'pciwgas_pro_save_taxonomy_meta') );

		// Add custom columns to custom taxonomies
		add_filter( "manage_edit-{$taxonomy}_columns", array($this, 'pciwgas_pro_manage_cat_clmn') );
		add_filter( "manage_{$taxonomy}_custom_column", array($this, 'pciwgas_pro_manage_cat_clmn_fields'), 10, 3);
	}

	/**
	 * Add form field on taxonomy page
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_add_taxonomy_field( $taxonomy ) {
		include_once( PCIWGASPRO_DIR . '/includes/admin/form-field/add-form.php' );
	}

	/**
	 * Add form field on edit-taxonomy page
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_edit_taxonomy_field( $term, $taxonomy ) {
		include_once( PCIWGASPRO_DIR . '/includes/admin/form-field/edit-form.php' );
	}

	/**
	 * Function to add term field on edit screen
	 * 
	 * @since 1.0.0
	 */
	function pciwgas_pro_save_taxonomy_meta( $term_id ) {

		$prefix			= PCIWGASPRO_META_PREFIX; // Taking metabox prefix
		$cat_thumb_id	= ! empty( $_POST[$prefix.'cat_thumb_id'] )	? pciwgas_pro_clean( $_POST[$prefix.'cat_thumb_id'] )		: '';
		$custom_link	= ! empty( $_POST[$prefix.'custom_link'] )	? pciwgas_pro_clean_url( $_POST[$prefix.'custom_link'] ) 	: '';

		update_term_meta( $term_id, $prefix.'cat_thumb_id', $cat_thumb_id );
		update_term_meta( $term_id, $prefix.'custom_link', $custom_link );
	}

	/**
	 * Add image column
	 * 
	 * @since 1.0.0
	 */
	public function pciwgas_pro_manage_cat_clmn( $columns ) {

		$new_columns['pciwgas_image'] = esc_html__( 'Image', 'post-category-image-with-grid-and-slider' );

		$columns = pciwgas_pro_add_array( $columns, $new_columns, 1, true );

		return $columns;
	}

	/**
	 * Add column data
	 * 
	 * @since 1.0.0
	 */
	public function pciwgas_pro_manage_cat_clmn_fields( $output, $column_name, $term_id ) {

		if( $column_name == 'pciwgas_image' ) {

			$prefix			= PCIWGASPRO_META_PREFIX; // Taking metabox prefix
			$cat_thum_image	= pciwgas_pro_term_image( $term_id, 'thumbnail' );

			if( ! empty( $cat_thum_image ) ) {
				$output .= '<img class="pciwgas-cat-img" src="'.esc_url( $cat_thum_image ).'" height="70" width="70" alt="" />';
			}
		}

		return $output;
	}

	/**
	 * Function to unique number value
	 * 
	 * @since 1.3
	 */
	function pciwgas_pro_plugin_row_meta( $links, $file ) {

		if ( $file == PCIWGASPRO_PLUGIN_BASENAME ) {

			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://docs.essentialplugin.com/post-category-image-with-grid-and-slider-pro/?utm_source=post_category_pro&utm_medium=plugin_list&utm_campaign=plugin_quick_link') . '" title="' . esc_html__( 'View Documentation', 'post-category-image-with-grid-and-slider' ) . '" target="_blank">' . esc_html__( 'Docs', 'post-category-image-with-grid-and-slider' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/wordpress-services/?utm_source=post_category_pro&utm_medium=plugin_list&utm_campaign=plugin_quick_link') . '" title="' . esc_html__( 'Premium Support - For any Customization', 'post-category-image-with-grid-and-slider' ) . '" target="_blank">' . esc_html__( 'Premium Support', 'post-category-image-with-grid-and-slider' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$pciwgas_pro_admin = new Pciwgas_Pro_Admin();