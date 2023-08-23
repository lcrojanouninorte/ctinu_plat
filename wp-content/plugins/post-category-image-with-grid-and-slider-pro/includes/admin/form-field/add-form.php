<?php
/**
 * Add Taxonomy Form Field
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$prefix = PCIWGASPRO_META_PREFIX; // Taking metabox prefix
?>

<div class="form-field pciwgas-term-link-wrap">
	<label for="pciwgas-custom-link"><?php esc_html_e('Category Custom Link', 'post-category-image-with-grid-and-slider'); ?></label>
	<input type="text" name="<?php echo esc_attr( $prefix ); ?>custom_link" id="pciwgas-custom-link" class="pciwgas-custom-link" />
	<p class="description"><?php esc_html_e('Enter category custom link. Leave empty for default category link.', 'post-category-image-with-grid-and-slider'); ?></p>
</div>

<div class="form-field pciwgas-term-img-wrap">
	<label for="pciwgas-cat-image"><?php esc_html_e('Choose Category Image', 'post-category-image-with-grid-and-slider'); ?></label>
	<button type="button" id="pciwgas-cat-image" class="button button-secondary pciwgas-cat-image pciwgas-image-upload"><?php esc_html_e( 'Upload Image', 'post-category-image-with-grid-and-slider'); ?></button>
	<button type="button" class="button button-secondary pciwgas-cat-thumb-clear pciwgas-image-clear"><?php esc_html_e( 'Clear', 'post-category-image-with-grid-and-slider'); ?></button> <br/>
	<input type="hidden" name="<?php echo esc_attr( $prefix ); ?>cat_thumb_id" value="" class="pciwgas-cat-thumb-id pciwgas-thumb-id" />
	<p class="description"><?php esc_html_e( 'Upload / Choose category image.', 'post-category-image-with-grid-and-slider' ); ?></p>

	<div class="pciwgas-img-preview pciwgas-img-view"></div>
</div>