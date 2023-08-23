<?php
/**
 * Shortcode Preview
 *
 * @package Post Category Image With Grid and Slider Pro
 * @since 1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$authenticated 			= false;
$registered_shortcodes  = pciwgas_pro_registered_shortcodes(); 

// Use minified libraries if SCRIPT_DEBUG is turned off
$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '_' : '.min';

// Getting shortcode value
if( ! empty( $_POST['pciwgaspro_customizer_shrt'] ) ) {
	$shortcode_val = wp_unslash( $_POST['pciwgaspro_customizer_shrt'] );
} elseif ( ! empty( $_GET['shortcode'] ) && isset( $registered_shortcodes[ $_GET['shortcode'] ] ) ) {
	$shortcode_val = '['.$_GET['shortcode'].']';
} else {
	$shortcode_val = '';
}

// For authentication so no one can use page via URL
if( isset($_SERVER['HTTP_REFERER']) ) {
	$url_query  = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
	parse_str( $url_query, $referer );

	if( ! empty( $referer['page'] ) && $referer['page'] == 'pciwgas-pro-shrt-mapper' ) {
		$authenticated = true; 
	}
}

// Check Authentication else exit
if( ! $authenticated ) {
	wp_die( esc_html__('Sorry, you are not allowed to access this page.', 'post-category-image-with-grid-and-slider') );
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="Imagetoolbar" content="No" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php esc_html_e("Shortcode Preview", "post-category-image-with-grid-and-slider"); ?></title> 

		<?php wp_print_styles('common'); ?>

		<link rel="stylesheet" href="<?php echo PCIWGASPRO_URL; ?>assets/css/slick.css?ver=<?php echo PCIWGASPRO_VERSION; ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo PCIWGASPRO_URL; ?>assets/css/pciwgas-public<?php echo $suffix; ?>.css?ver=<?php echo PCIWGASPRO_VERSION; ?>" type="text/css" />

		<?php do_action( 'pciwgaspro_shortcode_preview_head', $shortcode_val ); ?>

		<style type="text/css">
			body{background: #fff; overflow-x: hidden;}
			.pciwgaspro-customizer-container{padding:0 16px;}
			.pciwgaspro-customizer-container a[href^="http"]{cursor:not-allowed !important;}
			a:focus, a:active{box-shadow: none; outline: none;}
			.pciwgaspro-link-notice{display: none; position: fixed; color: #a94442; background-color: #f2dede; border:1px solid #ebccd1; max-width:300px; width: 100%; left:0; right:0; bottom:30%; margin:auto; padding:10px; text-align: center; z-index: 1050;}
		</style>
		<?php wp_print_scripts( array('jquery') ); ?>
	</head>
	<body>
		<div id="pciwgaspro-customizer-container" class="pciwgaspro-customizer-container">
			<?php if( $shortcode_val ) {
				echo do_shortcode( $shortcode_val );
			} ?>
		</div>
		<div class="pciwgaspro-link-notice"><?php esc_html_e('Sorry, You can not visit the link in preview', 'post-category-image-with-grid-and-slider'); ?></div>

		<script type='text/javascript'>
		//<![CDATA[
		var Pciwgas = <?php echo wp_json_encode( pciwgas_pro_public_script_vars() ); ?>;
		//]]>
		</script>

		<script type="text/javascript" src="<?php echo PCIWGASPRO_URL; ?>assets/js/slick.min.js?ver=<?php echo PCIWGASPRO_VERSION; ?>"></script>
		<script type="text/javascript" src="<?php echo PCIWGASPRO_URL; ?>assets/js/pciwgas-public<?php echo $suffix; ?>.js?ver=<?php echo PCIWGASPRO_VERSION; ?>"></script>
		<?php do_action( 'pciwgaspro_shortcode_preview_footer', $shortcode_val ); ?>
		<script type="text/javascript">
		( function($) {

			"use strict";
			$(document).on('click', 'a', function(event) {

				var href_val = $(this).attr('href');

				if(typeof(href_val) != 'undefined' && href_val != '' && href_val.indexOf('javascript:') < 0 ) {
					$('.pciwgaspro-link-notice').fadeIn();
				}
				event.preventDefault();

				setTimeout(function() {
					$(".pciwgaspro-link-notice").fadeOut('normal');
				}, 4000 );
			});

		})(jQuery);
		</script>
	</body>
</html>