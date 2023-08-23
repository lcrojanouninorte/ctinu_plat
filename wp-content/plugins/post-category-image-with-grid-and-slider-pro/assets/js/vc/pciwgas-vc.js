(function ( $ ) {

	window['InlineShortcodeView_pci-cat-slider'] = window.InlineShortcodeView.extend({
		render: function () {
			var model_id = this.model.get( 'id' );
			window['InlineShortcodeView_pci-cat-slider'].__super__.render.call( this );
			vc.frame_window.vc_iframe.addActivity( function () {
				this.pciwgas_cat_slider_init();
			});
			return this;
		}
	});

	/**
	 * WP Bakery Shortcode Methods
	 * shortcodes:add, shortcodeView:updated and shortcodeView:ready
	 */
	window.vc.events.on( 'shortcodeView:ready', function ( model ) {
		pciwgas_vc_init_shortcodes( model );
	});

	/* Initialize Plugin Shortcode */
	function pciwgas_vc_init_shortcodes( model ) {

		var modelId, settings;
		modelId		= model.get( 'id' );
		settings	= vc.map[ model.get( 'shortcode' ) ] || false;

		if( settings.base == 'vc_raw_html'
			|| settings.base == 'vc_column_text'
			|| settings.base == 'vc_wp_text'
			|| settings.base == 'vc_message'
			|| settings.base == 'vc_toggle'
			|| settings.base == 'vc_cta'
			|| settings.base == 'vc_widget_sidebar'
		) {
			window.vc.frame_window.pciwgas_cat_slider_init();
		}
	}

})( window.jQuery );