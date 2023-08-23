<?php
/**
 * Settings Page
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$default_img = pciwgas_pro_get_opt('default_img');

// Taking some variables
$cat_args = array(
			'public' 	=> true,
			'show_ui'	=> true,
		);
$taxonomies		= get_taxonomies( $cat_args, 'objects' );
$selected_cat	= pciwgas_pro_get_opt( 'pciwgas_category', array() );
$custom_css		= pciwgas_pro_get_opt( 'custom_css' );
?>

<div class="wrap pciwgas-settings">

	<h2><?php esc_html_e( 'Post Category Image Grid and Slider Pro - Settings', 'post-category-image-with-grid-and-slider' ); ?></h2>

	<?php
	// Messages
	if( ! empty( $_POST['pciwgas_reset_settings'] ) ) {

		// Reset message
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>' . esc_html__( 'All settings reset successfully.', 'post-category-image-with-grid-and-slider') . '</strong></p>
			</div>';

	} elseif( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
		
		// Setting Update Message
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.esc_html__("Your changes saved successfully.", "post-category-image-with-grid-and-slider").'</strong></p>
			</div>';
	} ?>

	<!-- Plugin reset settings form -->
	<form action="" method="post" id="pciwgas-reset-sett-form" class="pciwgas-right pciwgas-reset-sett-form">
		<input type="submit" class="button button-primary pciwgas-confirm pciwgas-btn pciwgas-reset-sett pciwgas-resett-sett-btn pciwgas-reset-sett" name="pciwgas_reset_settings" id="pciwgas-reset-sett" value="<?php esc_html_e( 'Reset All Settings', 'post-category-image-with-grid-and-slider' ); ?>" />
	</form>

	<form action="options.php" method="POST" id="pciwgas-settings-form" class="pciwgas-settings-form">

		<?php settings_fields( 'pciwgaspro_plugin_options' ); ?>

		<div class="textright pciwgas-clearfix">
			<input type="submit" name="pciwgas_settings_submit" class="button button-primary right pciwgas-btn pciwgas-sett-submit pciwgas-sett-submit" value="<?php esc_html_e('Save Changes', 'post-category-image-with-grid-and-slider'); ?>" />
		</div>

		<div class="metabox-holder">
			<div class="meta-box-sortables">

				<div id="pciwgas-general-sett" class="postbox pciwgas-general-sett">
					<div class="postbox-header">
						<h3 class="hndle">
							<span><?php esc_html_e( 'General Settings', 'post-category-image-with-grid-and-slider' ); ?></span>
						</h3>
					</div>

					<div class="inside">
						<table class="form-table pciwgas-general-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="pciwgas-default-img"><?php esc_html_e('Default Category Image', 'post-category-image-with-grid-and-slider'); ?></label>
									</th>
									<td>
										<input type="text" name="pciwgaspro_options[default_img]" value="<?php echo esc_url( $default_img ); ?>" id="pciwgas-default-img" class="regular-text pciwgas-default-img pciwgas-img-upload-input" />
										<input type="button" name="pciwgas_default_img" class="button-secondary pciwgas-image-upload" value="<?php esc_html_e( 'Upload Image', 'post-category-image-with-grid-and-slider'); ?>" />
										<input type="button" name="pciwgas_default_img_clear" id="pciwgas-default-img-clear" class="button button-secondary pciwgas-image-clear" value="<?php esc_html_e( 'Clear', 'post-category-image-with-grid-and-slider'); ?>" /> <br/>
										<span class="description"><?php esc_html_e( 'Upload default category image or provide an external URL of image. If category does not have featured image then this will be displayed instead of blank grey box.', 'post-category-image-with-grid-and-slider' ); ?></span>
										<div class="pciwgas-img-view pciwgas-img-preview">
											<?php if( $default_img ) {
												echo '<img src="'.esc_url( $default_img ).'" alt="" />';
											} ?>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="submit" name="pciwgas_pro_sett_submit" class="button button-primary right pciwgas-sett-submit" value="<?php esc_html_e('Save Changes', 'post-category-image-with-grid-and-slider'); ?>" />
									</td>
								</tr>
							</tbody>
						</table>
					</div><!-- .inside -->
				</div><!-- .postbox -->

				<div id="pciwgas-taxonomy-sett" class="postbox pciwgas-taxonomy-sett">
					<div class="postbox-header">
						<h3 class="hndle">
							<span><?php esc_html_e( 'Taxonomy Settings', 'post-category-image-with-grid-and-slider' ); ?></span>
						</h3>
					</div>

					<div class="inside">
						<table class="form-table">
							<tbody>
								<tr>
									<th>
										<label><?php esc_html_e('Taxonomy', 'post-category-image-with-grid-and-slider'); ?></label>
									</th>
									<td>
										<?php
										if( ! empty( $taxonomies ) ) {
											foreach ( $taxonomies as $taxonomy ) {
										?>
												<label>
													<input type="checkbox" class="pciwgas-cat-<?php echo esc_attr( $taxonomy->name ); ?>" id="pciwgas-cat-<?php echo esc_attr( $taxonomy->name ); ?>" name="pciwgaspro_options[pciwgas_category][]" value="<?php echo esc_attr( $taxonomy->name ); ?>" <?php checked( in_array( $taxonomy->name, $selected_cat ), true ); ?>> <?php echo esc_html( $taxonomy->label.' ('.$taxonomy->name.')' ); ?>
												</label>
												<br />
										<?php }
										}
										?>
										<br/>
										<span class="description"><?php esc_html_e('Select taxonomy box to enable support. Settings will be enabled for selected taxonomy on taxonomy listing page.', 'post-category-image-with-grid-and-slider'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="submit" name="pciwgas_pro_sett_submit" class="button button-primary right pciwgas-sett-submit" value="<?php esc_html_e('Save Changes', 'post-category-image-with-grid-and-slider'); ?>" />
									</td>
								</tr>
							</tbody>
						</table>
					</div><!-- .inside -->
				</div><!-- .postbox -->


				<!-- Custom CSS Settings -->
				<div id="pciwgas-css-sett" class="postbox pciwgas-css-sett">
					<div class="postbox-header">
						<h3 class="hndle">
							<span><?php esc_html_e( 'Custom CSS Settings', 'post-category-image-with-grid-and-slider' ); ?></span>
						</h3>
					</div>

					<div class="inside">
						<table class="form-table">
							<tbody>
								<tr>
									<th scope="row">
										<label for="pciwgas-custom-css"><?php esc_html_e('Custom CSS', 'post-category-image-with-grid-and-slider'); ?></label>
									</th>
									<td>
										<textarea name="pciwgaspro_options[custom_css]" class="large-text pciwgas-custom-css pciwgas-code-editor" id="pciwgas-custom-css" rows="15"><?php echo esc_textarea( $custom_css ); ?></textarea>
										<span class="description"><?php esc_html_e('Enter custom CSS. Note: Do not include `style` tag.', 'post-category-image-with-grid-and-slider'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" scope="row">
										<input type="submit" name="pciwgas_pro_sett_submit" class="button button-primary right pciwgas-sett-submit" value="<?php esc_html_e('Save Changes', 'post-category-image-with-grid-and-slider'); ?>" />
									</td>
								</tr>
							</tbody>
						</table>
					</div><!-- .inside -->
				</div><!-- .postbox -->

			</div><!-- .meta-box-sortables -->
		</div><!-- .metabox-holder -->
	</form><!-- end .pciwgas-settings-form -->

</div><!-- end .pciwgas-settings -->