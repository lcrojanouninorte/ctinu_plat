( function($) {

	"use strict";

	/* Media Uploader */
	$( document ).on( 'click', '.pciwgas-image-upload', function() {
		
		var imgfield, showfield, file_frame;

		var ele_obj	= jQuery(this);
		imgfield	= ele_obj.parent().find('.pciwgas-img-upload-input');
		showfield	= ele_obj.parent().find('.pciwgas-img-preview');

		/* new media uploader */
		var button = jQuery(this);

		/* If the media frame already exists, reopen it. */
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		/* Create the media frame. */
		file_frame = wp.media.frames.file_frame = wp.media({
			frame		: 'post',
			state		: 'insert',
			title		: button.data( 'uploader-title' ),
			button		: {
								text : button.data( 'uploader-button-text' ),
							},
			multiple	: false  /* Set to true to allow multiple files to be selected */
		});

		file_frame.on( 'menu:render:default', function(view) {
			/* Store our views in an object. */
			var views = {};

			/* Unset default menu items */
			view.unset('library-separator');
			view.unset('gallery');
			view.unset('featured-image');
			view.unset('embed');
			view.unset('playlist');
			view.unset('video-playlist');

			/* Initialize the views in our view object. */
			view.set(views);
		});

		/* When an image is selected, run a callback. */
		file_frame.on( 'insert', function() {

			/* Get selected size from media uploader */
			var selected_size	= $('.attachment-display-settings .size').val();
			var selection		= file_frame.state().get('selection');

			selection.each( function( attachment, index ) {
				attachment = attachment.toJSON();

				/* Selected attachment url from media uploader */
				var attachment_url = attachment.sizes[selected_size].url;

				imgfield.val(attachment_url);
				ele_obj.parent().find('.pciwgas-thumb-id').val( attachment.id );
				showfield.html('<img src="'+attachment_url+'" alt="" />');
			});
		});

		/* Finally, open the modal */
		file_frame.open();

	});

	/* Clear Media */
	$( document ).on( 'click', '.pciwgas-image-clear', function() {
		$(this).parent().find('.pciwgas-thumb-id').val('');
		$(this).parent().find('.pciwgas-img-upload-input').val('');
		$(this).parent().find('.pciwgas-img-preview').html('');
	});

	/* Click to Copy the Text */
	$(document).on('click', '.wpos-copy-clipboard', function() {
		var copyText = $(this);
		copyText.select();
		document.execCommand("copy");
	});

	/* Widget Accordian */
	$(document).on('click', '.pciwgaspro-wdgt-accordion-header', function() {
		var target		= $(this).attr('data-target');
		var cls_ele		= $(this).closest('.pciwgaspro-wdgt-accordion-wrap');
		var target_open	= cls_ele.find('.pciwgaspro-wdgt-accordion-cnt-'+target).is(":visible");

		cls_ele.find('.pciwgaspro-wdgt-accordion-cnt').slideUp();
		cls_ele.find('.pciwgaspro-wdgt-sel-tab').val('');

		if( ! target_open ) {
			cls_ele.find('.pciwgaspro-wdgt-accordion-cnt-'+target).slideDown();
			cls_ele.find('.pciwgaspro-wdgt-sel-tab').val( target );
		}
	});

	/* WP Code Editor */
	if( PciwgasAdmin.code_editor == 1 && PciwgasAdmin.syntax_highlighting == 1 ) {
		jQuery('.pciwgas-code-editor').each( function() {

			var cur_ele		= jQuery(this);
			var data_mode	= cur_ele.attr('data-mode');
			data_mode		= data_mode ? data_mode : 'css';

			if( cur_ele.hasClass('pciwgas-code-editor-initialized') ) {
				return;
			}

			var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
			editorSettings.codemirror = _.extend(
				{},
				editorSettings.codemirror,
				{
					indentUnit: 2,
					tabSize: 2,
					mode: data_mode,
				}
			);
			var editor = wp.codeEditor.initialize( cur_ele, editorSettings );
			cur_ele.addClass('pciwgas-code-editor-initialized');

			editor.codemirror.on( 'change', function( codemirror ) {
				cur_ele.val( codemirror.getValue() ).trigger( 'change' );
			});

			/* When post metabox is toggle */
			$(document).on('postbox-toggled', function( event, ele ) {
				if( $(ele).hasClass('closed') ) {
					return;
				}

				if( $(ele).find('.pciwgas-code-editor').length > 0 ) {
					editor.codemirror.refresh();
				}
			});
		});
	}

	/* Clear media fields on submit */
	if( (typeof(adminpage) !== 'undefined') && ( adminpage == 'edit-tags-php' ) ) {
		jQuery( document ).ajaxComplete( function( event, request, options ) {

			if ( request && 4 === request.readyState && 200 === request.status
				&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

				var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
				if ( ! res || res.errors ) {
					return;
				}

				$('.pciwgas-thumb-id').val('');
				$('.pciwgas-img-preview').html('');
				return;
			}
		});
	}

	/* Confirmation Message */
	$( document ).on( 'click', '.pciwgas-confirm', function() {

		var msg	= $(this).attr('data-msg');
			msg = msg ? msg : PciwgasAdmin.confirm_msg;
		var ans = confirm( msg );

		if( ans ) {
			return true;
		} else {
			return false;
		}
	});

	/* Drag widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.preview-rendered', pciwgas_pro_fl_render_preview );

	/* Save widget event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.layout-rendered', pciwgas_pro_fl_render_preview );

	/* Publish button event to render layout for Beaver Builder */
	$('.fl-builder-content').on( 'fl-builder.didSaveNodeSettings', pciwgas_pro_fl_render_preview );

})(jQuery);

/* Function to render shortcode preview for Beaver Builder */
function pciwgas_pro_fl_render_preview() {
	pciwgas_cat_slider_init();
}