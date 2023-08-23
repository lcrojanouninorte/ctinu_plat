<?php
/**
 * Edit Taxonomy Form Field
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$prefix		= PCIWGASPRO_META_PREFIX; // Taking metabox prefix
$term_id	= $term->term_id;

// Getting stored values
$pciwgas_custom_link	= get_term_meta( $term_id, $prefix.'custom_link', true );
$cat_thumb_id			= get_term_meta( $term_id, $prefix.'cat_thumb_id', true );
$cat_thum_image			= pciwgas_pro_term_image( $term_id, 'thumbnail' );
?>

<tr class="form-field pciwgas-cat-link-row">
	<th scope="row">
		<label for="pciwgas-custom-link"><?php esc_html_e('Category Custom Link', 'post-category-image-with-grid-and-slider'); ?></label>
	</th>
	<td>
		<input type="text" name="<?php echo esc_attr( $prefix ); ?>custom_link" id="pciwgas-custom-link" value="<?php echo esc_url( $pciwgas_custom_link ); ?>" />
		<p class="description"><?php esc_html_e('Enter category custom link. Leave empty for default category link.', 'post-category-image-with-grid-and-slider'); ?></p>
	</td>
</tr>

<tr class="form-field pciwgas-cat-thumb-row">
	<th scope="row">
		<label for="pciwgas-cat-image"><?php esc_html_e('Choose Category Image', 'post-category-image-with-grid-and-slider'); ?></label>
	</th>
	<td>
		<button type="button" id="pciwgas-cat-image" class="button button-secondary pciwgas-cat-image pciwgas-image-upload"><?php esc_html_e( 'Upload Image', 'post-category-image-with-grid-and-slider'); ?></button>
		<button type="button" class="button button-secondary pciwgas-cat-thumb-clear pciwgas-image-clear"><?php esc_html_e( 'Clear', 'post-category-image-with-grid-and-slider'); ?></button> <br/>
		<input type="hidden" name="<?php echo esc_attr( $prefix ); ?>cat_thumb_id" value="<?php echo esc_attr( $cat_thumb_id ); ?>" class="pciwgas-cat-thumb-id pciwgas-thumb-id" />
		<p class="description"><?php esc_html_e( 'Upload / Choose category image.', 'post-category-image-with-grid-and-slider' ); ?></p>

		<div class="pciwgas-img-preview pciwgas-img-view">
			<?php if( ! empty( $cat_thum_image ) ) { ?>
				<img src="<?php echo esc_url( $cat_thum_image ); ?>" alt="" />
			<?php } ?>
		</div>
	</td>
</tr>