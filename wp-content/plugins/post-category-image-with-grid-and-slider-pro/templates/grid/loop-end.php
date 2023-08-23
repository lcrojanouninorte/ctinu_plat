<?php
/**
 * Template for Grid Loop - End
 *
 * This template can be overridden by copying it to yourtheme/post-category-image-with-grid-and-slider-pro/grid/loop-end.php
 *
 * @package Post Category Image With Grid and Slider Pro
 * @version 1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} ?>

	</div>
	<?php if( $pagination && $term_total > 1 && $term_total > $limit ) { ?>
	<div class="pciwgas-paging pciwgas-clearfix">
		<?php echo pciwgas_pro_pagination( array('paged' => $paged, 'unique' => $unique, 'total' => ceil( $term_total / $limit )) ); ?>
	</div>
	<?php } ?>
</div>