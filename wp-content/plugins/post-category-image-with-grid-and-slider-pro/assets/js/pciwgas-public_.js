/* Define global Variable */
var pciwgas_next_arrow = '<span class="slick-next slick-arrow" data-role="none" tabindex="0" role="button"><svg fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M69.8437,43.3876,33.8422,13.3863a6.0035,6.0035,0,0,0-7.6878,9.223l30.47,25.39-30.47,25.39a6.0035,6.0035,0,0,0,7.6878,9.2231L69.8437,52.6106a6.0091,6.0091,0,0,0,0-9.223Z"/></svg></span>';
var pciwgas_prev_arrow = '<span class="slick-prev slick-arrow" data-role="none" tabindex="0" role="button"><svg fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M39.3756,48.0022l30.47-25.39a6.0035,6.0035,0,0,0-7.6878-9.223L26.1563,43.3906a6.0092,6.0092,0,0,0,0,9.2231L62.1578,82.615a6.0035,6.0035,0,0,0,7.6878-9.2231Z"/></svg></span>';

( function($) {

	"use strict";

	/* Post Category Slider Initialize */
	pciwgas_cat_slider_init();

	/***** Visual Composer Compatibility Start *****/
	/* Toggle */
	$(document).on('click', '.vc_toggle', function() {

		var slider_wrap	= $(this).find('.vc_toggle_content .pciwgas-cat-slider-main');

		$( slider_wrap ).each(function( index ) {

			var slider_id = $(this).attr('id');

			if( typeof(slider_id) !== 'undefined' && slider_id != '' && $(this).hasClass('slick-initialized') ) {
				$('#'+slider_id).slick( 'setPosition' );
			}
		});
	});

	/* Accordion - Tab */
	$(document).on('click', '.vc_tta-panel-title', function() {

		var cls_ele		= $(this).closest('.vc_tta-panel');
		var slider_wrap	= cls_ele.find('.pciwgas-cat-slider-main');

		$( slider_wrap ).each(function( index ) {

			var slider_id = $(this).attr('id');

			if( typeof(slider_id) !== 'undefined' && slider_id != '' && $(this).hasClass('slick-initialized') ) {
				$('#'+slider_id).slick( 'setPosition' );
			}
		});
	});
	/***** Visual Composer Compatibility End *****/

	/***** Elementor Compatibility Start *****/
	if( Pciwgas.elementor_preview == 0 ) {

		$(window).on('elementor/frontend/init', function() {

			/* Tweak for Slick Slider */
			$('.pciwgas-cat-slider-main').each(function( index ) {

				/* Tweak for Vertical Tab */
				$(this).closest('.elementor-tabs-content-wrapper').addClass('pciwgas-elementor-tab-wrap');

				var slider_id = $(this).attr('id');
				$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

				setTimeout(function() {
					if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
						$('#'+slider_id).slick( 'setPosition' );
						$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					}
				}, 350);
			});
		});
	}

	/* Elementor Compatibility */
	$(document).on('click', '.elementor-tab-title', function() {

		var ele_control		= $(this).attr('aria-controls');
		var slider_wrap		= $('#'+ele_control).find('.pciwgas-cat-slider-main');

		/* Tweak for slick slider */
		$( slider_wrap ).each(function( index ) {

			var slider_id = $(this).attr('id');
			$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

			setTimeout(function() {
				if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
					$('#'+slider_id).slick( 'setPosition' );
					$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
				}
			}, 350);
		});
	});
	/***** Elementor Compatibility End *****/

	/***** SiteOrigin Compatibility Start *****/
	/* Accordion Panel */
	$(document).on('click', '.sow-accordion-panel', function() {

		var ele_control	= $(this).attr('data-anchor');
		var slider_wrap	= $('#accordion-content-'+ele_control).find('.pciwgas-cat-slider-main');

		/* Tweak for slick slider */
		$( slider_wrap ).each(function( index ) {

			var slider_id = $(this).attr('id');

			/* Tweak for slick slider */
			if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
				$('#'+slider_id).slick( 'setPosition' );
			}
		});
	});

	/* Tab Panel */
	$(document).on('click focus', '.sow-tabs-tab', function() {
		var sel_index	= $(this).index();
		var cls_ele		= $(this).closest('.sow-tabs');
		var tab_cnt		= cls_ele.find('.sow-tabs-panel').eq( sel_index );
		var slider_wrap	= tab_cnt.find('.pciwgas-cat-slider-main');

		/* Tweak for slick slider */
		$( slider_wrap ).each(function( index ) {

			var slider_id = $(this).attr('id');
			$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

			setTimeout(function() {
				if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
					$('#'+slider_id).slick( 'setPosition' );
					$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
				}
			}, 300);
		});
	});
	/***** SiteOrigin Compatibility End *****/

	/* Beaver Builder Compatibility for Accordion */
	$(document).on('click', '.fl-accordion-button, .fl-tabs-label', function() {

		var ele_control	= $(this).attr('aria-controls');
		var slider_wrap	= $('#'+ele_control).find('.pciwgas-cat-slider-main');

		/* Tweak for filter */
		$( slider_wrap ).each(function( index ) {

			var slider_id = $(this).attr('id');
			$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

			setTimeout(function() {
				if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
					$('#'+slider_id).slick( 'setPosition' );
					$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
				}
			}, 300);
		});
	});

	/***** Divi Builder Compatibility Start *****/
	/* Accordion & Toggle */
	$(document).on('click', '.et_pb_toggle', function() {

		var acc_cont	= $(this).find('.et_pb_toggle_content');
		var slider_wrap	= acc_cont.find('.pciwgas-cat-slider-main');

		/* Tweak for slick slider */
		$( slider_wrap ).each(function( index ) {

			var slider_id = $(this).attr('id');

			if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
				$('#'+slider_id).slick( 'setPosition' );
			}
		});
	});

	/* Tabs */
	$('.et_pb_tabs_controls li a').on( 'click', function() {
		var cls_ele		= $(this).closest('.et_pb_tabs');
		var tab_cls		= $(this).closest('li').attr('class');
		var tab_cont	= cls_ele.find('.et_pb_all_tabs .'+tab_cls);
		var slider_wrap	= tab_cont.find('.pciwgas-cat-slider-main');

		setTimeout(function() {

			/* Tweak for slick slider */
			$( slider_wrap ).each(function( index ) {

				var slider_id = $(this).attr('id');

				if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
					$('#'+slider_id).slick( 'setPosition' );
				}
			});
		}, 550);
	});
	/***** Divi Builder Compatibility Ends *****/

	/***** Fusion Builder Compatibility Starts *****/	
	/* Tabs */
	$(document).on('click', '.fusion-tabs li .tab-link', function() {
		var cls_ele		= $(this).closest('.fusion-tabs');
		var tab_id		= $(this).attr('href');
		var tab_cont	= cls_ele.find(tab_id);
		var slider_wrap	= tab_cont.find('.pciwgas-cat-slider-main');

		/* Tweak for slick slider */
		$( slider_wrap ).each(function( index ) {
			var slider_id = $(this).attr('id');
			$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

			setTimeout(function() {
				if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
					$('#'+slider_id).slick( 'setPosition' );
					$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					$('#'+slider_id).slick( 'setPosition' );
				}
			}, 200);
		});
	});

	/* Toggles */
	$(document).on('click', '.fusion-accordian .panel-heading a', function() {
		var cls_ele		= $(this).closest('.fusion-accordian');
		var tab_id		= $(this).attr('href');
		var tab_cont	= cls_ele.find(tab_id);
		var slider_wrap	= tab_cont.find('.pciwgas-cat-slider-main');

		/* Tweak for slick slider */
		$( slider_wrap ).each(function( index ) {
			var slider_id = $(this).attr('id');
			$('#'+slider_id).css({'visibility': 'hidden', 'opacity': 0});

			setTimeout(function() {
				if( typeof(slider_id) !== 'undefined' && slider_id != '' ) {
					$('#'+slider_id).slick( 'setPosition' );
					$('#'+slider_id).css({'visibility': 'visible', 'opacity': 1});
					$('#'+slider_id).slick( 'setPosition' );
				}
			}, 200);
		});
	});
	/***** Fusion Builder Compatibility Ends *****/

})(jQuery);

/* Function to Initialize Post Category Slider */
function pciwgas_cat_slider_init() {
	jQuery( '.pciwgas-cat-slider-main' ).each(function( index ) {

		if( jQuery(this).hasClass('slick-initialized') ) {
			return;
		}

		var slider_id	= jQuery(this).attr('id');
		var slider_conf	= JSON.parse( jQuery(this).attr('data-conf') );

		/* Flex Condition */
		if( Pciwgas.is_avada == 1 ) {
			jQuery(this).closest('.fusion-flex-container').addClass('pciwgas-fusion-flex');
		}

		/* Check Grid Container */
		pciwgas_check_grid_container( slider_id );

		jQuery('#'+slider_id).slick({
			centerPadding	: 0,
			lazyLoad		: slider_conf.lazyload,
			autoplaySpeed	: parseInt( slider_conf.autoplay_interval ),
			speed			: parseInt( slider_conf.speed ),
			slidesToShow	: parseInt( slider_conf.slidestoshow ),
			slidesToScroll	: parseInt( slider_conf.slidestoscroll ),
			rows			: parseInt( slider_conf.rows ),
			dots			: ( slider_conf.dots == "true" )			? true	: false,
			infinite		: ( slider_conf.loop == "true")				? true	: false,
			arrows			: ( slider_conf.arrows == "true" )			? true	: false,
			autoplay		: ( slider_conf.autoplay == "true" )		? true	: false,
			pauseOnHover	: ( slider_conf.hover_pause == "false" )	? false	: true,
			pauseOnFocus	: ( slider_conf.focus_pause == "true" )		? true	: false,
			centerMode		: ( slider_conf.centermode == "true" )		? true	: false,
			mobileFirst		: ( Pciwgas.is_mobile == 1 ) 				? true	: false,
			rtl				: ( slider_conf.rtl == "true" ) 			? true	: false,
			nextArrow 		: pciwgas_next_arrow,
			prevArrow 		: pciwgas_prev_arrow,
			responsive		: [{
								breakpoint	: 1023,
								settings	: {
												slidesToShow	: ( parseInt( slider_conf.slidestoshow ) > 3 ) ? 3 : parseInt( slider_conf.slidestoshow ),
												slidesToScroll	: ( parseInt( slider_conf.slidestoscroll ) > 3 ) ? 3 : parseInt( slider_conf.slidestoscroll ),
											}
							},{
								breakpoint	: 639,
								settings	: {
												slidesToShow	: ( parseInt( slider_conf.slidestoshow ) > 2 ) ? 2 : parseInt( slider_conf.slidestoshow ),
												slidesToScroll	: ( parseInt( slider_conf.slidestoscroll ) > 2 ) ? 2 : parseInt( slider_conf.slidestoscroll ),
												centerMode		: false,
											}
							},{
								breakpoint	: 220,
								settings	: {
												slidesToShow	: 1,
												slidesToScroll	: 1,
												centerMode		: false,
												dots			: false,
											}
							}]
		});
	});
}

/**
 * Function to check CSS grid container up to two parent levels
 * Note : Slick Slider is not taking proper width in CSS grid container so we have applied an extra class to solve the issue.
 */
function pciwgas_check_grid_container( slider_id ) {

	var slider_ele = jQuery( '#'+slider_id );

	if( slider_ele.closest('.pciwgas-slick-wrap').hasClass('pciwgas-no-grid-wrap') ) {
		return;
	}

	var grid_ele = slider_ele.closest('.pciwgas-slick-wrap').parent();

	if( ( grid_ele.css('display').toLowerCase() == 'grid' ) == false ) {
		grid_ele = grid_ele.parent();
	}

	if( ( grid_ele.css('display').toLowerCase() == 'grid' ) == true ) {
		slider_ele.addClass('pciwgas-grid-wrap');
	}
}