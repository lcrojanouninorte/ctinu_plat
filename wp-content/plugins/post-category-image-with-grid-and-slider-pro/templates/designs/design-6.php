<?php
/**
 * Template for - Design-6
 *
 * This template can be overridden by copying it to yourtheme/post-category-image-with-grid-and-slider-pro/designs/design-6.php
 *
 * If you want to override for grid only then put it into 'grid' and folder and same for respective.
 *
 * @package Post Category Image With Grid and Slider Pro
 * @version 1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

<div class="<?php echo esc_attr( $wrapper_cls ); ?>">
	<div class="pciwgas-post-cat-inner pciwgas-clearfix">
		<div class="pciwgas-img-wrapper" style="<?php echo esc_attr( $height_css ); ?>">
			<a class="pciwgas-hover" href="<?php echo esc_url( $term_link ); ?>" aria-category-name="<?php echo esc_attr( $category_name ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
				<?php if( ! empty( $category_image ) ) { ?>
					<img class="pciwgas-img" src="<?php echo esc_url( $category_image ); ?>" class="pciwgas-cat-img" alt="<?php echo esc_attr( $category_name ); ?>" />
				<?php } ?>
			</a>

			<?php if( $show_count && $category_count ) { ?>
				<span class="pciwgas-cat-count"><?php echo wp_kses_post( $category_count ); ?></span>
			<?php } ?>
		</div>
		<?php if ( ( $show_title && $category_name ) || ( $show_desc && $category_desc ) ) { ?>
			<div class="pciwgas-bottom-wrapper">
				<?php if( $show_title && $category_name ) { ?>
					<div class="pciwgas-title">
						<a href="<?php echo esc_url( $term_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo wp_kses_post( $category_name ); ?></a>
					</div>
				<?php }

				if( $show_desc && $category_desc ) { ?>
					<div class="pciwgas-description"><?php echo wp_kses_post( wpautop( wptexturize( $category_desc ) ) ); ?></div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>