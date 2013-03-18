jQuery(document).ready(function() {

	jQuery('#ssba_font_color').wpColorPicker();

	jQuery('#ssba_image_set').change(function(){
	
		if (jQuery("#ssba_image_set").val() == "custom" ) { 
			jQuery("#ssba-custom-images").delay(800).show(800);
			jQuery("#ssba-image-settings").hide(800);
        }
        if(jQuery("#ssba_image_set").val() != "custom" ) { 
			jQuery("#ssba-custom-images").hide(800);
			jQuery("#ssba-image-settings").delay(800).show(800);
        }
	}); 
	
	jQuery('#custom_share_text').click(function(){

			jQuery("#ssba-custom-text").show(800);


	}); 

	// ----- Image Uploads ------ //
	
	// diggit	
	jQuery('#upload_diggit_button').click(function() {
	 
		formfield = jQuery('#upload_diggit_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	
		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_diggit').val(imgurl);
			tb_remove();
		}
	 return false;
	});
	
	// email	
	jQuery('#upload_email_button').click(function() {
	 
		formfield = jQuery('#upload_email_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	
		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_email').val(imgurl);
			tb_remove();
		}
	 return false;
	});

	// facebook
	jQuery('#upload_facebook_button').click(function() {
	 
		formfield = jQuery('#upload_facebook_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 
		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_facebook').val(imgurl);
			tb_remove();
		}
	 return false;
	});

	// google
	jQuery('#upload_google_button').click(function() {
	
		formfield = jQuery('#upload_google_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	
		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_google').val(imgurl);
			tb_remove();
		}
	 return false;
	});

	// linkedin	
	jQuery('#upload_linkedin_button').click(function() {
	
		formfield = jQuery('#upload_linkedin_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 
		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_linkedin').val(imgurl);
			tb_remove();
		}
	 return false;
	});

	// pinterest
	jQuery('#upload_pinterest_button').click(function() {
	
		formfield = jQuery('#upload_pinterest_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_pinterest').val(imgurl);
			tb_remove();
		}
	 return false;
	});
	
	// reddit
	jQuery('#upload_reddit_button').click(function() {
	
		formfield = jQuery('#upload_reddit_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_reddit').val(imgurl);
			tb_remove();
		}
	 return false;
	});

	// stumbleupon
	jQuery('#upload_stumbleupon_button').click(function() {
	
		formfield = jQuery('#upload_stumbleupon_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 
		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_stumbleupon').val(imgurl);
			tb_remove();
		}
	 return false;
	});

	// twitter
	jQuery('#upload_twitter_button').click(function() {
	
		formfield = jQuery('#upload_twitter_button').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 
		// send image back to the text field
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#ssba_custom_twitter').val(imgurl);
			tb_remove();
		}
	 return false;
	});

});