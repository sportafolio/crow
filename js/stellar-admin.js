jQuery(document).ready(function() {
	jQuery('.ignitiondeck .add_media').click(function(e) {
		var button = jQuery(this);
		var inputID = jQuery(button).data('input');
		console.log('inputID: ', inputID);
		wp.media.editor.send.attachment = function(props, attachment){
			jQuery(document.getElementById(inputID)).val(attachment.id);
			
			// Triggering an event that media is selected, passing attachment id as argument
			jQuery(document).trigger('stellarMediaSelectedAdmin', [attachment]);
		}
		wp.media.editor.open(button);
		return false;
	});
	
	jQuery('#stellar-slider').change(function(e) {
		if (jQuery(this).val() == "static_image") {
			jQuery('.static-image').show();
			jQuery('.slider-static-text').show();
			jQuery('.shortcode-rev-slider').hide();
			jQuery('.hero-widget').hide();
		}
		else if (jQuery(this).val() == "slider") {
			jQuery('.static-image').hide();
			jQuery('.slider-static-text').hide();
			jQuery('.shortcode-rev-slider').show();
			jQuery('.hero-widget').hide();
		}
		else if (jQuery(this).val() == "hero-widget") {
			jQuery('.static-image').hide();
			jQuery('.slider-static-text').hide();
			jQuery('.shortcode-rev-slider').hide();
			jQuery('.hero-widget').show();
		}
	});
	
		if (jQuery('#stellar-slider').val() == "static_image") { 
			jQuery('.slider-static-text').show();
		}
		else {
			jQuery('.slider-static-text').hide();
		}
	
	jQuery(document).on('stellarMediaSelectedAdmin', function (e, attachment) {
		jQuery('#stellar-image-holder').attr('src', attachment.url).show();
	});
	
	
	// This is the script for uploading logos to the settings menu
	var _custom_media = true;
	if (wp.media) {
		_orig_send_attachment = wp.media.editor.send.attachment;
	}
	jQuery('.uploader-header .button').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = jQuery(this);
		var id = button.attr('id').replace('_button', '');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
		  if ( _custom_media ) {
		    jQuery("#stellar_inner_logo").val(attachment.url);
		    jQuery("#header-preview img").replaceWith('<img id="header-image" src="' + attachment.url + '"/>');
		    //console.log(attachment.url);
		  } else {
		    return _orig_send_attachment.apply( this, [props, attachment] );
		  };
		}
	wp.media.editor.open(button);
	return false;
	});
	jQuery('.add_media').click(function() {
		_custom_media = false;
	});
	jQuery("#stellar_inner_logo").change(function() {
		var input = jQuery("#stellar_inner_logo").val();
		console.log(input);
		jQuery("#header-preview").html('<img src="' + input + '"/>');
	});
});