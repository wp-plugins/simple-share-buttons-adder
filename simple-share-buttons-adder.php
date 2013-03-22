<?php
/*
Plugin Name: Simple Share Buttons Adder
Plugin URI: http://www.davidsneal.co.uk/wordpress/simple-share-buttons-adder
Description: A simple plugin that enables you to add share buttons to all of your posts and/or pages.
Version: 1.7
Author: David S. Neal
Author URI: http://www.davidsneal.co.uk/
License: GPLv2

Copyright 2013 David S Neal me@davidsneal.co.uk

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/
	// turn error reporting off
	error_reporting(0);

	// --------- INSTALLATION ------------ //

	// run the activation function upon acitvation of the plugin
	register_activation_hook( __FILE__, 'ssba_activate' );
	
	// activate ssba function
	function ssba_activate() {
		
		// insert default options for ssba
		add_option('ssba_version', 				'1.7');
		add_option('ssba_image_set', 			'somacro');
		add_option('ssba_size', 				'small');
		add_option('ssba_pages',				'');
		add_option('ssba_posts',				'');
		add_option('ssba_cats_archs',			'');
		add_option('ssba_homepage',				'');
		add_option('ssba_align', 				'left');
		add_option('ssba_padding', 				'10');
		add_option('ssba_before_or_after', 		'after');
		add_option('ssba_custom_styles', 		'');
		add_option('ssba_email_message', 		'');
		
		// share text
		add_option('ssba_share_text', 			'');
		add_option('ssba_font_color',			'');	
		add_option('ssba_font_size',			'');
		add_option('ssba_font_weight',			'');
		
		// include
		add_option('ssba_email', 				'');
		add_option('ssba_google', 				'');
		add_option('ssba_facebook', 			'');
		add_option('ssba_twitter', 				'');
		add_option('ssba_diggit', 				'');
		add_option('ssba_linkedin', 			'');
		add_option('ssba_reddit', 				'');
		add_option('ssba_stumbleupon', 			'');
		add_option('ssba_pinterest', 			'');
		
		// custom images
		add_option('ssba_custom_email', 		'');
		add_option('ssba_custom_google', 		'');
		add_option('ssba_custom_facebook', 		'');
		add_option('ssba_custom_twitter', 		'');
		add_option('ssba_custom_diggit', 		'');
		add_option('ssba_custom_linkedin', 	  	'');
		add_option('ssba_custom_reddit', 	  	'');
		add_option('ssba_custom_stumbleupon', 	'');
		add_option('ssba_custom_pinterest', 	'');
	}

	// --------- ADMIN BITS ------------ //
	
	// add menu to dashboard
	add_action( 'admin_menu', 'ssba_menu' );
	
	// include js files and upload script
	function ssba_admin_scripts() {
	
		// all extra scripts needed
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('wp-color-picker');
		wp_register_script('my-upload', WP_PLUGIN_URL . '/simple-share-buttons-adder/js/ssba_admin.js', array('jquery', 'media-upload', 'thickbox', 'wp-color-picker'));
		wp_enqueue_script('my-upload');
	}
	
	function ssba_admin_styles() {
		wp_enqueue_style('thickbox');
		wp_enqueue_style('wp-color-picker');
	}
	
	// check if viewing the admin page
	if (isset($_GET['page']) && $_GET['page'] == 'simple-share-buttons-adder') {
	
		// add the registered scripts
		add_action('admin_print_styles', 'ssba_admin_styles');
		add_action('admin_print_scripts', 'ssba_admin_scripts');
	}
	
	// add js scripts for page/post use
	function ssba_page_scripts() {
	
		// load js scripts
		wp_enqueue_script('ssba-script', WP_PLUGIN_URL . '/simple-share-buttons-adder/js/ssba_pages.js', array( 'jquery' ));
	}
	
	// call scripts add function
	add_action( 'wp_enqueue_scripts', 'ssba_page_scripts' );
	
	// menu settings
	function ssba_menu() {
	
		// add menu page
		add_plugins_page( 'Simple Share Buttons Adder', 'Share Buttons', 'manage_options', 'simple-share-buttons-adder', 'ssba_settings');
		
		// query the db for current ssba settings
		$arrSettings = get_ssba_settings();
		
		// check if not yet updated to 1.7
		if ($arrSettings['ssba_version'] != '1.7') {
		
			// see if posts and pages were selected in previous version
	if (isset($arrSettings['ssba_posts_or_pages']) && $arrSettings['ssba_posts_or_pages'] == 'both') {
	
		// set posts and pages to Y
		add_option('ssba_pages', 'Y');
		add_option('ssba_posts', 'Y');
	}
	
	// see if posts only was selected in previous version
	else if (isset($arrSettings['ssba_posts_or_pages']) && $arrSettings['ssba_posts_or_pages'] == 'posts') {
	
		// set posts to Y pages to N
		add_option('ssba_pages', '');
		add_option('ssba_posts', 'Y');
	}
	
	// see if pages only was selected in previous version
	else if (isset($arrSettings['ssba_posts_or_pages']) && $arrSettings['ssba_posts_or_pages'] == 'pages') {
	
		// set pages to Y pages to N
		add_option('ssba_pages', 'Y');
		add_option('ssba_posts', '');
	}
	
	// new custom styles option
	add_option('ssba_custom_styles', 		'');
	add_option('ssba_email_message', 		'');
	
	// new share text option
	add_option('ssba_share_text', 			'');
	add_option('ssba_font_color',			'');	
	add_option('ssba_font_size',			'');
	add_option('ssba_font_weight',			'');
	
	// add new placement options
	add_option('ssba_cats_archs',			'');
	add_option('ssba_homepage',				'');
	
	// add new buttons
	add_option('ssba_email', 				'');
	add_option('ssba_reddit', 				'');

	// add custom image options
	add_option('ssba_custom_email', 		'');
	add_option('ssba_custom_google', 		'');
	add_option('ssba_custom_facebook', 		'');
	add_option('ssba_custom_twitter', 		'');
	add_option('ssba_custom_diggit', 		'');
	add_option('ssba_custom_linkedin', 	  	'');
	add_option('ssba_custom_reddit', 		'');
	add_option('ssba_custom_stumbleupon', 	'');
	add_option('ssba_custom_pinterest', 	'');

	// check if using 1.0
	if ($arrSettings['ssba_version'] == '1.0') {
	
		// add options that were new for 1.1
		// NOTE: 1.1 and above will have these already
		add_option('ssba_size', 		'small');
		add_option('ssba_linkedin', 	'');
		add_option('ssba_stumbleupon', 	'');
		add_option('ssba_pinterest', 	'');
	}
	
	// update version number
	update_option('ssba_version', '1.7');		
		}
	}

	// --------- SETTINGS PAGE ------------ //

	// answer form
	function ssba_settings() {
	
		//' check if user has the rights to manage options
		if ( !current_user_can( 'manage_options' ) )  {
		
			// permissions message
			wp_die( __('You do not have sufficient permissions to access this page.'));
		}
	
		// check for submitted form
		if (isset($_POST['ssba_options'])) {

			// update existing ssba settings		
			update_option('ssba_image_set', 			$_POST['ssba_image_set']);
			update_option('ssba_size', 					$_POST['ssba_size']);
			update_option('ssba_pages', 				$_POST['ssba_pages']);
			update_option('ssba_posts', 				$_POST['ssba_posts']);
			update_option('ssba_cats_archs', 			$_POST['ssba_cats_archs']);
			update_option('ssba_homepage', 				$_POST['ssba_homepage']);
			update_option('ssba_align', 				$_POST['ssba_align']);
			update_option('ssba_padding', 				$_POST['ssba_padding']);								
			update_option('ssba_before_or_after', 		$_POST['ssba_before_or_after']);
			update_option('ssba_custom_styles', 		$_POST['ssba_custom_styles']);
			update_option('ssba_email_message', 		$_POST['ssba_email_message']);

			// text
			update_option('ssba_share_text', 			$_POST['ssba_share_text']);	
			update_option('ssba_font_color', 			$_POST['ssba_font_color']);	
			update_option('ssba_font_size', 			$_POST['ssba_font_size']);	
			update_option('ssba_font_weight', 			$_POST['ssba_font_weight']);	

			// include
			update_option('ssba_email', 				$_POST['ssba_email']);
			update_option('ssba_google', 				$_POST['ssba_google']);
			update_option('ssba_facebook', 				$_POST['ssba_facebook']);
			update_option('ssba_twitter', 				$_POST['ssba_twitter']);
			update_option('ssba_diggit', 				$_POST['ssba_diggit']);
			update_option('ssba_linkedin', 				$_POST['ssba_linkedin']);
			update_option('ssba_reddit', 				$_POST['ssba_reddit']);
			update_option('ssba_stumbleupon', 			$_POST['ssba_stumbleupon']);
			update_option('ssba_pinterest', 			$_POST['ssba_pinterest']);
			
			// custom images
			update_option('ssba_custom_email', 			$_POST['ssba_custom_email']);
			update_option('ssba_custom_google', 		$_POST['ssba_custom_google']);
			update_option('ssba_custom_facebook', 		$_POST['ssba_custom_facebook']);
			update_option('ssba_custom_twitter', 		$_POST['ssba_custom_twitter']);
			update_option('ssba_custom_diggit', 		$_POST['ssba_custom_diggit']);
			update_option('ssba_custom_linkedin', 		$_POST['ssba_custom_linkedin']);
			update_option('ssba_custom_reddit', 		$_POST['ssba_custom_reddit']);
			update_option('ssba_custom_stumbleupon', 	$_POST['ssba_custom_stumbleupon']);
			update_option('ssba_custom_pinterest', 		$_POST['ssba_custom_pinterest']);

			// show settings saved message
			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
		}

		// query the db for current ssba settings
		$arrSettings = get_ssba_settings();

		// --------- HTML FORM ------------ //
		
		// html form
		echo '<div class="wrap">';
			echo '<img src="' . plugins_url( 'images/ssba.png' , __FILE__ ) . '" /> ';
			echo '<br />';
			echo '<p class="description">I hope you find this plugin useful. Should you come across any problems or have any suggestions, please <a href="http://www.davidsneal.co.uk/wordpress/simple-share-buttons-adder" target="_blank">leave a comment on this page</a>.</p>';
			echo '<p>&nbsp;</p>';
			echo '<form method="post">';
			
			// hidden field to check for post
			echo '<input type="hidden" name="ssba_options" id="ssba_options" value="save" />';
			
				// continue outputting the form
				echo '<table class="form-table">';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>Location:</label></th>';
						echo '<td>';
						echo 'Homepage&nbsp;<input type="checkbox" name="ssba_homepage" id="ssba_homepage" ' 	 	. ($arrSettings['ssba_homepage'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Pages&nbsp;<input type="checkbox" name="ssba_pages" id="ssba_pages" ' 		 		. ($arrSettings['ssba_pages'] 		== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Posts&nbsp;<input type="checkbox" name="ssba_posts" id="ssba_posts" ' 		 		. ($arrSettings['ssba_posts'] 		== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Categories&#47;Archives&nbsp;<input type="checkbox" name="ssba_cats_archs" id="ssba_cats_archs" '	. ($arrSettings['ssba_cats_archs']	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo '<p class="description">Check all those that you wish to show your share buttons</p></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_before_or_after">Placement:&nbsp;</label></th>';
						echo '<td><select name="ssba_before_or_after" id="ssba_before_or_after">';
						echo '<option ' . ($arrSettings['ssba_before_or_after'] == 'after' 	? 'selected="selected"' : NULL) . ' value="after">After</option>';
						echo '<option ' . ($arrSettings['ssba_before_or_after'] == 'before' ? 'selected="selected"' : NULL) . ' value="before">Before</option>';
						echo '<option ' . ($arrSettings['ssba_before_or_after'] == 'both' 	? 'selected="selected"' : NULL) . ' value="both">Both</option>';
						echo '</select>';
						echo '<p class="description">Place share buttons before or after your content</p></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_align">Alignment:&nbsp;</label></th>';
						echo '<td><select name="ssba_align" id="ssba_align">';
						echo '<option ' . ($arrSettings['ssba_align'] == 'left'   ? 'selected="selected"' : NULL) . ' value="left">Left</option>';
						echo '<option ' . ($arrSettings['ssba_align'] == 'center' ? 'selected="selected"' : NULL) . ' value="center">Center</option>';
						echo '</select>';
						echo '<p class="description">Center your buttons if desired</p></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_padding">Padding:&nbsp;</label></th>';
						echo '<td><input type="number" name="ssba_padding" id="ssba_padding" step="1" min="0" value="' . $arrSettings['ssba_padding'] . '" /><span class="description">px</span>';
						echo '<p class="description">Apply some space around your images</p></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_image_set">Image Set:&nbsp;</label></th>';
						echo '<td><select name="ssba_image_set" id="ssba_image_set">';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'arbenta' 		? 'selected="selected"' : NULL) . ' value="arbenta">Arbenta</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'custom' 		? 'selected="selected"' : NULL) . ' value="custom">Custom</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'default' 		? 'selected="selected"' : NULL) . ' value="default">Default</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'metal' 		? 'selected="selected"' : NULL) . ' value="metal">Metal</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'pagepeel' 	? 'selected="selected"' : NULL) . ' value="pagepeel">Page Peel</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'plain' 		? 'selected="selected"' : NULL) . ' value="plain">Plain</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'retro' 		? 'selected="selected"' : NULL) . ' value="retro">Retro</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'ribbons' 		? 'selected="selected"' : NULL) . ' value="ribbons">Ribbons</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'simple' 		? 'selected="selected"' : NULL) . ' value="simple">Simple</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'somacro' 		? 'selected="selected"' : NULL) . ' value="somacro">Somacro</option>';
						echo '</select>';
						echo "<p class='description'>Choose your favourite set of buttons, or set to 'Custom' to choose your own</p></td>";
					echo '</tr>';
				echo '</table>';
				
				// --------- CUSTOM IMAGES ------------ //
				echo '<div id="ssba-custom-images"' . ($arrSettings['ssba_image_set'] != 'custom' ? 'style="display: none;"' : NULL) . '>';
				echo '<h4>Custom Images</h4>';
				echo '<table class="form-table">';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>Diggit:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_diggit" type="text" size="50" name="ssba_custom_diggit" value="' . (isset($arrSettings['ssba_custom_diggit']) ? $arrSettings['ssba_custom_diggit'] : NULL)  . '" />';
						echo '<input id="upload_diggit_button" class="button" type="button" value="Upload Image" />';
						echo '</td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>Email:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_email" type="text" size="50" name="ssba_custom_email" value="' . (isset($arrSettings['ssba_custom_email']) ? $arrSettings['ssba_custom_email'] : NULL)  . '" />';
						echo '<input id="upload_email_button" class="button" type="button" value="Upload Image" />';
						echo '</td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>Facebook:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_facebook" type="text" size="50" name="ssba_custom_facebook" value="' . (isset($arrSettings['ssba_custom_facebook']) ? $arrSettings['ssba_custom_facebook'] : NULL)  . '" />';
						echo '<input id="upload_facebook_button" class="button" type="button" value="Upload Image" />';
						echo '</td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>Google:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_google" type="text" size="50" name="ssba_custom_google" value="' . (isset($arrSettings['ssba_custom_google']) ? $arrSettings['ssba_custom_google'] : NULL)  . '" />';
						echo '<input id="upload_google_button" class="button" type="button" value="Upload Image" />';
						echo '</td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>LinkedIn:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_linkedin" type="text" size="50" name="ssba_custom_linkedin" value="' . (isset($arrSettings['ssba_custom_linkedin']) ? $arrSettings['ssba_custom_linkedin'] : NULL)  . '" />';
						echo '<input id="upload_linkedin_button" class="button" type="button" value="Upload Image" />';
						echo '</td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>Pinterest:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_pinterest" type="text" size="50" name="ssba_custom_pinterest" value="' . (isset($arrSettings['ssba_custom_pinterest']) ? $arrSettings['ssba_custom_pinterest'] : NULL)  . '" />';
						echo '<input id="upload_pinterest_button" class="button" type="button" value="Upload Image" />';
						echo '</td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>Reddit:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_reddit" type="text" size="50" name="ssba_custom_reddit" value="' . (isset($arrSettings['ssba_custom_reddit']) ? $arrSettings['ssba_custom_reddit'] : NULL)  . '" />';
						echo '<input id="upload_reddit_button" class="button" type="button" value="Upload Image" />';
						echo '</td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>StumbleUpon:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_stumbleupon" type="text" size="50" name="ssba_custom_stumbleupon" value="' . (isset($arrSettings['ssba_custom_stumbleupon']) ? $arrSettings['ssba_custom_stumbleupon'] : NULL)  . '" />';
						echo '<input id="upload_stumbleupon_button" class="button" type="button" value="Upload Image" />';
						echo '</td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label>Twitter:</label></th>';
						echo '<td>';
						echo '<input id="ssba_custom_twitter" type="text" size="50" name="ssba_custom_twitter" value="' . (isset($arrSettings['ssba_custom_twitter']) ? $arrSettings['ssba_custom_twitter'] : NULL)  . '" />';
						echo '<input id="upload_twitter_button" class="button" type="button" value="Upload Image" />';
						echo '<p class="description">Enter the URLs of your images or upload from here</p></td>';
					echo '</tr>';
				echo '</table>';
				echo '</div>';
				
				// --------- NON-CUSTOM IMAGE SETTINGS ------------ //
				echo '<div id="ssba-image-settings"' . ($arrSettings['ssba_image_set'] == 'custom' ? 'style="display: none;"' : NULL) . '>';
				echo '<table class="form-table">';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_size">Image Size:&nbsp;</label></th>';
						echo '<td><select name="ssba_size" id="ssba_size">';
						echo '<option ' . ($arrSettings['ssba_size'] == 'small'  ? 'selected="selected"' : NULL) . ' value="small">Small</option>';
						echo '<option ' . ($arrSettings['ssba_size'] == 'medium' ? 'selected="selected"' : NULL) . ' value="medium">Medium</option>';
						echo '</select>';
						echo '<p class="description">Pick a size of images, default is small</p></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_choices">Include:</label></th>';
						echo '<td>';
						echo 'Digg&nbsp;<input type="checkbox" name="ssba_diggit" id="ssba_diggit" ' 			 		. ($arrSettings['ssba_diggit'] 		== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Email&nbsp;<input type="checkbox" name="ssba_email" id="ssba_email" ' 					. ($arrSettings['ssba_email'] 		== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Facebook&nbsp;<input type="checkbox" name="ssba_facebook" id="ssba_facebook" ' 	 		. ($arrSettings['ssba_facebook'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Google&nbsp;<input type="checkbox" name="ssba_google" id="ssba_google" ' 			 		. ($arrSettings['ssba_google'] 	 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'LinkedIn&nbsp;<input type="checkbox" name="ssba_linkedin" id="ssba_linkedin" ' 		 	. ($arrSettings['ssba_linkedin'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Pinterest&nbsp;<input type="checkbox" name="ssba_pinterest" id="ssba_pinterest" '	 		. ($arrSettings['ssba_pinterest'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Reddit&nbsp;<input type="checkbox" name="ssba_reddit" id="ssba_reddit" ' 			 		. ($arrSettings['ssba_reddit'] 	 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'StumbleUpon&nbsp;<input type="checkbox" name="ssba_stumbleupon" id="ssba_stumbleupon" ' 	. ($arrSettings['ssba_stumbleupon'] == 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Twitter&nbsp;<input type="checkbox" name="ssba_twitter" id="ssba_twitter" ' 		 		. ($arrSettings['ssba_twitter'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo '<p class="description">Check all those that you wish to include</p></td>';
					echo '</tr>';
				echo '</table>';
				echo '</div>';
				echo '<table class="form-table">';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_email_message">Email Text:&nbsp;</label></th>';
						echo '<td><input type="text" name="ssba_email_message" id="ssba_email_message" value="' . $arrSettings['ssba_email_message'] . '" />';
						echo '<p class="description">Customise the text included in the email when people share that way</p></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_share_text">Share Text:&nbsp;</label></th>';
						echo '<td><input type="text" name="ssba_share_text" id="ssba_share_text" value="' . $arrSettings['ssba_share_text'] . '" />';
						echo '<p class="description">Add some custom text by your share buttons</p></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"></th>';
						echo '<td>';
						echo '<input id="custom_share_text" class="button" type="button" value="Styles" /></td>';
					echo '</tr>';
				echo '</table>';
				
				// --------- CUSTOM SHARE TEXT ------------ //
				echo '<div id="ssba-custom-text"' . ($arrSettings['ssba_font_color']  == '' && $arrSettings['ssba_font_size']  == '' && $arrSettings['ssba_font_weight']  == '' && $arrSettings['ssba_custom_styles'] == '' ? 'style="display: none;"' : NULL) . '>';
				echo '<table class="form-table">';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_font_color">Font Colour:&nbsp;</label></th>';
						echo '<td><input type="text" name="ssba_font_color" id="ssba_font_color" value="' . $arrSettings['ssba_font_color'] . '">';
						echo '</input></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_font_size">Font Size:&nbsp;</label></th>';
						echo '<td><input type="number" name="ssba_font_size" id="ssba_font_size" value="' . $arrSettings['ssba_font_size'] . '"><span class="description">px</span>';
						echo '</input></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_font_weight">Font Weight:&nbsp;</label></th>';
						echo '<td><select name="ssba_font_weight" id="ssba_font_weight">';
						echo '<option value="">Please select...</option>';
						echo '<option ' . ($arrSettings['ssba_font_weight'] == 'bold'   ? 'selected="selected"' : NULL) . ' value="bold">Bold</option>';
						echo '<option ' . ($arrSettings['ssba_font_weight'] == 'normal' ? 'selected="selected"' : NULL) . ' value="normal">Normal</option>';
						echo '<option ' . ($arrSettings['ssba_font_weight'] == 'light' ? 'selected="selected"' : NULL) . ' value="light">Light</option>';
						echo '</select>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_custom_styles">Custom styles:&nbsp;</label></th>';
						echo '<td>';
						echo '<textarea name="ssba_custom_styles" id="ssba_custom_styles" rows="10" cols="50">' . $arrSettings['ssba_custom_styles'] . '</textarea>';
						echo '<p class="description">Note that entering any text into the &#39;Custom styles&#39; box will automatically override any other style settings on this page.<br/>The div id is ssba. If you are unsure please leave this blank or visit <a href="http://www.davidsneal.co.uk/wordpress/simple-share-buttons-adder" target="_blank">this page</a> for assistance.</p>';
					echo '</tr>';
				echo '</table>';
				echo '</div>';
			
			// save button
			echo '<table class="form-table">';
					echo '<tr valign="top">';
						echo '<td><input type="submit" value="Save changes" id="submit" class="button button-primary"/></td>';
					echo '</tr>';
				echo '</table>';
			echo '</form>';
			
			// image set previews and showcase link below
			echo '<br />';
			echo '<h2>Showcase</h2>';
			echo '<p>Enjoying the Simple Share Buttons Adder? Would you like to showcase your website? <a href="http://www.davidsneal.co.uk/wordpress/share-buttons-showcase" target="_blank">Leave a comment on this page</a>.</p>';
			echo '<h2>Image Sets</h2>';
			echo '<p><a href="http://www.davidsneal.co.uk/wordpress/share-buttons-image-sets/" target="_blank">Click here</a> to preview all of the image sets.</p>';
			echo '<p class="description">I hope you find this plugin useful. Should you come across any problems or have any suggestions, please <a href="http://www.davidsneal.co.uk/wordpress/simple-share-buttons-adder" target="_blank">leave a comment on this page</a>.</p>';
			
		// close #wrap	
		echo '</div>';
	}
	
	// --------- SHARE BUTTONS ------------ //
	
	// return ssba settings
	function get_ssba_settings() {
	
		// globals
		global $wpdb;
		
		// query the db for current ssba settings
		$arrSettings = $wpdb->get_results("SELECT option_name, option_value
											 FROM $wpdb->options 
											WHERE option_name LIKE 'ssba_%'");
											
		// loop through each setting in the array
		foreach ($arrSettings as $setting) {
		
			// add each setting to the array by name
			$arrSettings[$setting->option_name] =  $setting->option_value;
		}
	
		// return
		return $arrSettings;	
	}
	
	// get set share buttons
	function get_share_buttons($arrSettings, $urlCurrentPage, $strPageTitle) {
	
		// variables
		$htmlShareButtons = '';
		
		// add custom text if set
		if (isset($arrSettings['ssba_share_text'])) {
		
			// share text
			$htmlShareButtons .= $arrSettings['ssba_share_text'];
		}
		
		// check if facebook is set to Y or (image set is custom and a facebook image has been uploaded)
		if (($arrSettings['ssba_facebook'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_facebook'] != '')) {
		
			// facebook share link
			$htmlShareButtons .= '<a id="ssba_facebook_share" href="http://www.facebook.com/sharer.php?u=' . $urlCurrentPage  . '" target="_blank">';
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_facebook'] . '" alt="facebook" />';
			}
			
			// if not using custom images
			else {
			
				// show selected ssba image
				$htmlShareButtons .= '<img alt="facebook" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/facebook' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// check for twitter
		if (($arrSettings['ssba_twitter'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_twitter'] != '')) {
		
			// twitter share link
			$htmlShareButtons .= '<a id="ssba_twitter_share" href="http://twitter.com/share?url=' . $urlCurrentPage  . '&text=' . $strPageTitle . '" target="_blank">';
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_twitter'] . '" alt="twitter" />';
			}
			
			// if not using custom images
			else {
			
				// show ssba image
				$htmlShareButtons .= '<img alt="twitter" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/twitter' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// check for google
		if (($arrSettings['ssba_google'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_google'] != '')) {
		
			// google share link
			$htmlShareButtons .= '<a id="ssba_google_share" href="https://plus.google.com/share?url=' . $urlCurrentPage  . '" target="_blank">';
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_google'] . '" alt="google" />';
			}
			
			// if not using custom images
			else {
			
				// show ssba image
				$htmlShareButtons .= '<img alt="google" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/google' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// check for diggit
		if (($arrSettings['ssba_diggit'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_diggit'] != '')) {
		
			// diggit share link
			$htmlShareButtons .= '<a id="ssba_diggit_share" href="http://www.digg.com/submit?url=' . $urlCurrentPage  . '" target="_blank">';
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_diggit'] . '" alt="diggit" />';
			}
			
			// if not using custom images
			else {
				
				// show ssba image
				$htmlShareButtons .= '<img alt="digg" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/diggit' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// check for reddit
		if (($arrSettings['ssba_reddit'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_reddit'] != '')) {
		
			// reddit share link
			$htmlShareButtons .= '<a id="ssba_reddit_share" href="http://reddit.com/submit?url=' . $urlCurrentPage  . '&title=' . $strPageTitle . '" target="_blank">';
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_reddit'] . '" alt="reddit" />';
			}
			
			// if not using custom images
			else {
				
				// show ssba image
				$htmlShareButtons .= '<img alt="reddit" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/reddit' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// check for linkedin
		if (($arrSettings['ssba_linkedin'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_linkedin'] != '')) {
		
			// linkedin share link
			$htmlShareButtons .= '<a id="ssba_linkedin_share" href="http://www.linkedin.com/shareArticle?mini=true&url=' . $urlCurrentPage  . '" target="_blank">';
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_linkedin'] . '" alt="linkedin" />';
			}
			
			// if not using custom images
			else {
			
				// show ssba image
				$htmlShareButtons .= '<img alt="linkedin" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/linkedin' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// check for pinterest
		if (($arrSettings['ssba_pinterest'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_pinterest'] != '')) {
		
			// pinterest share link
			$htmlShareButtons .= "<a id='ssba_pinterest_share' href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'>";
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_pinterest'] . '" alt="pinterest" />';
			}
			
			// if not using custom images
			else {
			
				// show ssba image
				$htmlShareButtons .= '<img alt="pinterest" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/pinterest' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// check for stumbleupon
		if (($arrSettings['ssba_stumbleupon'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_stumbleupon'] != '')) {
		
			// stumbleupon share link
			$htmlShareButtons .= '<a id="ssba_stumbleupon_share" href="http://www.stumbleupon.com/submit?url=' . $urlCurrentPage  . '&title=' . $strPageTitle . '" target="_blank">';
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_stumbleupon'] . '" alt="stumbleupon" />';
			}
			
			// if not using custom images
			else {
			
				// show ssba image
				$htmlShareButtons .= '<img alt="stumbleupon" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/stumbleupon' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// check for email
		if (($arrSettings['ssba_email'] == 'Y' && $arrSettings['ssba_image_set'] != 'custom') || ($arrSettings['ssba_image_set'] == 'custom' && $arrSettings['ssba_custom_email'] != '')) {
		
			// email share link
			$htmlShareButtons .= '<a id="ssba_email_share" href="mailto:?Subject=' . $strPageTitle . '&Body=' . $arrSettings['ssba_email_message'] . ' ' . $urlCurrentPage  . '">';
			
			// if image set is custom
			if ($arrSettings['ssba_image_set'] == 'custom') {
			
				// show custom image
				$htmlShareButtons .= '<img src="' . $arrSettings['ssba_custom_email'] . '" alt="email" />';
			}
			
			// if not using custom images
			else {
			
				// show ssba image
				$htmlShareButtons .= '<img alt="email" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/email' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" />';
			}
			
			// close href
			$htmlShareButtons .= '</a>';
		}
		
		// return share buttons
		return $htmlShareButtons;
	}
	
	// get and show share buttons
	function show_share_buttons($content, $booShortCode = FALSE) {
	
		// globals
		global $post;
		
		// variables
		$htmlContent = $content;
		$htmlShareButtons = '';
		$strIsWhatFunction = '';
	
		// get sbba settings
		$arrSettings = get_ssba_settings();

		// placement on pages/posts/categories/archives/homepage
		if (is_page() && $arrSettings['ssba_pages'] == 'Y' || is_single() && $arrSettings['ssba_posts'] == 'Y' || is_category() && $arrSettings['ssba_cats_archs'] == 'Y' || is_archive() && $arrSettings['ssba_cats_archs'] == 'Y' || is_home() && $arrSettings['ssba_homepage'] == 'Y' || $booShortCode == TRUE) {
		
			// css style
			$htmlShareButtons .= '<style type="text/css">';
			
			// check if custom style has been set
			if ($arrSettings['ssba_custom_styles'] != '') {
			
				// use custom styles
				$htmlShareButtons .= $arrSettings['ssba_custom_styles'];
			}
			
			// else use set options
			else {

				$htmlShareButtons .= '	#ssba img		
										{ 	
											padding: ' . $arrSettings['ssba_padding'] . 'px;
											border:  0;
											box-shadow: 0;
											display: inline;
										}
										#ssba		
										{
											' . (isset($arrSettings['ssba_font_size']) ? 'font-size: ' . $arrSettings['ssba_font_size'] . 'px;' : NULL) . '
											' . (isset($arrSettings['ssba_font_color']) ? 'color: ' . $arrSettings['ssba_font_color'] . ';' : NULL) . '
											' . (isset($arrSettings['ssba_font_weight']) ? 'font-weight: ' . $arrSettings['ssba_font_weight'] . ';' : NULL) . '
										}';
			}
			
			$htmlShareButtons .= '</style>';
			
			// ssba buttons!!
			$htmlShareButtons.= '<div id="ssba">';
			$htmlShareButtons.= ($arrSettings['ssba_align'] == 'center' ? '<center>' : NULL);
			$htmlShareButtons.= get_share_buttons($arrSettings, get_permalink($post->ID), get_the_title($post->ID));
			$htmlShareButtons.= ($arrSettings['ssba_align'] == 'center' ? '</center>' : NULL);
			$htmlShareButtons.= '</div>';
			
			// if not using shortcode
			if ($booShortCode == FALSE) {
			
				// switch for placement of ssba
				switch ($arrSettings['ssba_before_or_after']) {
				
					case 'before': // before the content
					$htmlContent = $htmlShareButtons . $content;
					break;
					
					case 'after': // after the content
					$htmlContent = $content . $htmlShareButtons;
					break;
					
					case 'both': // before and after the content
					$htmlContent = $htmlShareButtons . $content . $htmlShareButtons;
					break;
				}
			}
			
			// if using shortcode
			else {
			
				// just return buttons
				$htmlContent = $htmlShareButtons;
			}
		}
		
		// return content and share buttons
		return $htmlContent;
	}

	// add share buttons to content and/or excerpts
	add_filter( 'the_content', 'show_share_buttons');	
	add_filter( 'the_excerpt', 'show_share_buttons');

	// shortcode for adding buttons
	function ssba_buttons(){
	
		// get buttons - NULL for $content, TRUE for shortcode flag
		$htmlShareButtons = show_share_buttons(NULL, TRUE);
		
		//return buttons
		return $htmlShareButtons;
	}
	
	// register shortcode [ssba]
	add_shortcode( 'ssba', 'ssba_buttons' );	
	
?>