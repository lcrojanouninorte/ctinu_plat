<?php
/**
 * Post Category Image With Grid and Slider Pro Shortcode Mapper Page
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$registered_shortcodes 	= pciwgas_pro_registered_shortcodes();
$preview_shortcode 		= ! empty( $_GET['shortcode'] ) ? $_GET['shortcode'] : apply_filters('pciwgaspro_default_shortcode_preview', 'pci-cat-grid' );
$preview_url 			= add_query_arg( array( 'page' => 'pciwgas-pro-preview', 'shortcode' => $preview_shortcode), admin_url('admin.php') );
$shrt_generator_url 	= add_query_arg( array( 'page' => 'pciwgas-pro-shrt-mapper'), admin_url('admin.php') );

// Instantiate the shortcode mapper
if( !class_exists( 'pciwgaspro_Pro_Shortcode_Mapper' ) ) {
	include_once( PCIWGASPRO_DIR . '/includes/admin/shortcode-mapper/class-pciwgaspro-shortcode-mapper.php' );
}

$shortcode_fields 	= array();
$shortcode_sanitize = str_replace('-', '_', $preview_shortcode);
?>
<div class="wrap pciwgaspro-customizer-settings">

	<h2><?php esc_html_e( 'Post Category Image with Grid and Slider Pro - Shortcode Builder', 'post-category-image-with-grid-and-slider' ); ?></h2>

	<?php
	// If invalid shortocde is passed then simply return
	if( ! empty( $_GET['shortcode'] ) && ! isset( $registered_shortcodes[ $_GET['shortcode'] ] ) ) {
		echo '<div id="message" class="error notice">
				<p><strong>'.__('Sorry, Something happened wrong.', 'post-category-image-with-grid-and-slider').'</strong></p>
			 </div>';
		return;
	}
	?>

	<div class="pciwgaspro-customizer-toolbar">
		<?php if( ! empty( $registered_shortcodes ) ) { ?>
			<select class="pciwgaspro-cust-shrt-switcher" id="pciwgaspro-cust-shrt-switcher">
				<option value=""><?php esc_html_e('-- Choose Shortcode --', 'post-category-image-with-grid-and-slider'); ?></option>
				<?php foreach ($registered_shortcodes as $shrt_key => $shrt_val) {

					if( empty($shrt_key) ) {
						continue;
					}

					$shrt_val 		= !empty($shrt_val) ? $shrt_val : $shrt_key;
					$shortcode_url 	= add_query_arg( array('shortcode' => $shrt_key), $shrt_generator_url );
				?>
				<option value="<?php echo $shrt_key; ?>" <?php selected( $preview_shortcode, $shrt_key); ?> data-url="<?php echo esc_url( $shortcode_url ); ?>"><?php echo $shrt_val; ?></option>
				<?php } ?>
			</select>
		<?php } ?>

		<span class="pciwgaspro-cust-shrt-generate-help pciwgaspro-tooltip" title="<?php esc_html_e("The Shortcode Mapper allows you to preview plugin shortcode. You can choose your desired shortcode from the dropdown and check various parameters from left panel. \n\nYou can paste shortocde to below and press Refresh button to preview so each and every time you do not have to choose each parameters!!!", 'post-category-image-with-grid-and-slider'); ?>"><i class="dashicons dashicons-editor-help"></i></span>
	</div><!-- end .pciwgaspro-customizer-toolbar -->

	<div class="pciwgaspro-customizer pciwgaspro-clearfix" data-shortcode="<?php echo $preview_shortcode; ?>">
		<div class="pciwgaspro-customizer-control pciwgaspro-clearfix">
			<div class="pciwgaspro-customizer-heading"><?php esc_html_e('Shortcode Parameters', 'post-category-image-with-grid-and-slider'); ?></div>
			<?php
				if ( function_exists( $shortcode_sanitize.'_shortcode_fields' ) ) {
					$shortcode_fields = call_user_func( $shortcode_sanitize.'_shortcode_fields', $preview_shortcode );
				}
				$shortcode_fields = apply_filters('pciwgaspro_shortcode_mapper_fields', $shortcode_fields, $preview_shortcode );

				$shortcode_mapper = new pciwgaspro_Pro_Shortcode_Mapper();
				$shortcode_mapper->render( $shortcode_fields );
			?>
		</div>

		<div class="pciwgaspro-customizer-preview pciwgaspro-clearfix">
			<div class="pciwgaspro-customizer-shrt-wrp">
				<div class="pciwgaspro-customizer-heading"><?php esc_html_e('Shortcode', 'post-category-image-with-grid-and-slider'); ?>
					<span class="pciwgaspro-cust-heading-info pciwgaspro-tooltip" title="<?php esc_html_e('Check shortcode parameters from left hand side or You can paste shortocde to below and press Refresh button to preview so each and every time you do not have to choose each parameters!!!', 'post-category-image-with-grid-and-slider'); ?>">[?]</span>
					<div class="pciwgaspro-customizer-shrt-tool">
						<button type="button" class="button button-small button-primary pciwgaspro-cust-shrt-generate"><?php esc_html_e('Refresh', 'post-category-image-with-grid-and-slider') ?></button>
						<i title="<?php esc_html_e('Full Preview Mode', 'post-category-image-with-grid-and-slider'); ?>" class="pciwgaspro-tooltip pciwgaspro-cust-dwp dashicons dashicons-editor-expand"></i>
					</div>
				</div>
				<form action="<?php echo esc_url($preview_url); ?>" method="post" class="pciwgaspro-customizer-shrt-form" id="pciwgaspro-customizer-shrt-form" target="pciwgaspro_customizer_preview_frame">
					<textarea name="pciwgaspro_customizer_shrt" class="pciwgaspro-customizer-shrt" id="pciwgaspro-customizer-shrt" placeholder="<?php esc_html_e('Copy or Paste Shortcode', 'post-category-image-with-grid-and-slider'); ?>"></textarea>
				</form>
			</div>
			<div class="pciwgaspro-customizer-heading"><?php esc_html_e('Preview Window', 'post-category-image-with-grid-and-slider'); ?> <span class="pciwgaspro-cust-heading-info pciwgaspro-tooltip" title="<?php esc_html_e('Preview will be displayed according to responsive layout mode. You can check with `Full Preview` mode beside `Refresh` button for better visualization.', 'post-category-image-with-grid-and-slider'); ?>">[?]</span></div>
			<div class="pciwgaspro-customizer-window">
				<iframe class="pciwgaspro-customizer-preview-frame" name="pciwgaspro_customizer_preview_frame" src="<?php echo esc_url($preview_url); ?>" scrolling="auto" frameborder="0"></iframe>
				<div class="pciwgaspro-customizer-loader"></div>
				<div class="pciwgaspro-customizer-error"><?php esc_html_e('Sorry, Something happened wrong.', 'post-category-image-with-grid-and-slider'); ?></div>
			</div>
		</div>
	</div><!-- pciwgaspro-customizer -->

	<br/>
	<div class="pciwgaspro-cust-footer-note"><span class="description"><?php esc_html_e('Note: Preview will be displayed according to responsive layout mode. Live preview may display differently when added to your page based on inheritance from some styles.', 'post-category-image-with-grid-and-slider'); ?></span></div>

</div><!-- end .wrap -->