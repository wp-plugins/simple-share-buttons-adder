<?php
/*
Plugin Name: Simple Share Buttons Adder
Plugin URI: http://www.davidsneal.co.uk/wordpress/simple-share-buttons-adder
Description: A simple plugin that enables you to add share buttons to all of your posts and/or pages.
Version: 1.3
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

	// --------- INSTALLATION ------------ //

	// run the activation function upon acitvation of the plugin
	register_activation_hook( __FILE__, 'ssba_activate' );
	
	// activate ssba function
	function ssba_activate() {
		
		// insert default options for ssba
		add_option('ssba_version', 			'1.2');
		add_option('ssba_image_set', 		'somacro');
		add_option('ssba_size', 			'small');
		add_option('ssba_posts_or_pages',	'both');
		add_option('ssba_align', 			'left');
		add_option('ssba_padding', 			'10');
		add_option('ssba_before_or_after', 	'after');
		add_option('ssba_google', 			'Y');
		add_option('ssba_facebook', 		'Y');
		add_option('ssba_twitter', 			'Y');
		add_option('ssba_diggit', 			'Y');
		add_option('ssba_linkedin', 		'Y');
		add_option('ssba_stumbleupon', 		'Y');
		add_option('ssba_pinterest', 		'Y');
	}

	// --------- ADMIN BITS ------------ //
	
	// add menu to dashboard
	add_action( 'admin_menu', 'ssba_menu' );

	// menu settings
	function ssba_menu() {
	
		// add menu page
		add_plugins_page( 'Simple Share Buttons Adder', 'Share Buttons', 'manage_options', 'simple-share-buttons-adder', 'ssba_settings');
		
		// query the db for current ssba settings
		$arrSettings = get_ssba_settings();
		
		// check if not yet updated to 1.3
		if ($arrSettings['ssba_version'] != '1.3') {
		
			// check if using 1.0
			if ($arrSettings['ssba_version'] == '1.0') {
			
				// add options that were new for 1.1
				// NOTE: 1.1 and above will have these already
				add_option('ssba_size', 		'small');
				add_option('ssba_linkedin', 	'N');
				add_option('ssba_stumbleupon', 	'N');
				add_option('ssba_pinterest', 	'N');
			}
			
			// update version number
			update_option('ssba_version', '1.3');
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
			update_option('ssba_image_set', 		($_POST['ssba_image_set']));
			update_option('ssba_size', 				($_POST['ssba_size']));
			update_option('ssba_posts_or_pages', 	($_POST['ssba_posts_or_pages']));
			update_option('ssba_align', 			($_POST['ssba_align']));
			update_option('ssba_padding', 			($_POST['ssba_padding']));								
			update_option('ssba_before_or_after', 	($_POST['ssba_before_or_after']));				
			update_option('ssba_google', 			($_POST['ssba_google']));
			update_option('ssba_facebook', 			($_POST['ssba_facebook']));
			update_option('ssba_twitter', 			($_POST['ssba_twitter']));
			update_option('ssba_diggit', 			($_POST['ssba_diggit']));
			update_option('ssba_linkedin', 			($_POST['ssba_linkedin']));
			update_option('ssba_stumbleupon', 		($_POST['ssba_stumbleupon']));
			update_option('ssba_pinterest', 		($_POST['ssba_pinterest']));

			// show settings saved message
			echo '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Settings saved.</strong></p></div>';
		}

		// query the db for current ssba settings
		$arrSettings = get_ssba_settings();

		// --------- HTML FORM ------------ //
		
		// html form
		echo '<div class="wrap">';
			echo '<img src="' . plugins_url( 'images/ssba.png' , __FILE__ ) . '" align="left" style="margin-right: 10px;" alt="ssba" /> ';
			echo '<h2>Simple Share Buttons Adder</h2>';
			echo '<p class="description">I hope you find this plugin useful. Should you come across any problems or have any suggestions, please <a href="http://www.davidsneal.co.uk/wordpress/simple-share-buttons-adder" target="_blank">leave a comment on this page</a>.</p>';
			echo '<p>&nbsp;</p>';
			echo '<form method="post">';
			
			// hidden field to check for post
			echo '<input type="hidden" name="ssba_options" id="ssba_options" value="save" />';
			
				// continue outputting the form
				echo '<table class="form-table">';
					echo '<tr valign="top">';
						echo '<th scope="row" style="width: 120px;"><label for="ssba_posts_or_pages">Location:&nbsp;</label></th>';
						echo '<td><select name="ssba_posts_or_pages" id="ssba_posts_or_pages">';
						echo '<option ' . ($arrSettings['ssba_posts_or_pages'] == 'both'  ? 'selected="selected"' : NULL) . ' value="both">Both</option>';
						echo '<option ' . ($arrSettings['ssba_posts_or_pages'] == 'posts' ? 'selected="selected"' : NULL) . ' value="posts">Posts</option>';
						echo '<option ' . ($arrSettings['ssba_posts_or_pages'] == 'pages' ? 'selected="selected"' : NULL) . ' value="pages">Pages</option>';
						echo '</select>';
						echo '<p class="description">Select where you would like share buttons to appear</p></td>';
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
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'default' 		? 'selected="selected"' : NULL) . ' value="default">Default</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'metal' 		? 'selected="selected"' : NULL) . ' value="metal">Metal</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'pagepeel' 	? 'selected="selected"' : NULL) . ' value="pagepeel">Page Peel</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'plain' 		? 'selected="selected"' : NULL) . ' value="plain">Plain</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'retro' 		? 'selected="selected"' : NULL) . ' value="retro">Retro</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'ribbons' 		? 'selected="selected"' : NULL) . ' value="ribbons">Ribbons</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'simple' 		? 'selected="selected"' : NULL) . ' value="simple">Simple</option>';
						echo '<option ' . ($arrSettings['ssba_image_set'] == 'somacro' 		? 'selected="selected"' : NULL) . ' value="somacro">Somacro</option>';
						echo '</select>';
						echo '<p class="description">Choose your favourite set of buttons</p></td>';
					echo '</tr>';
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
						echo 'Facebook&nbsp;<input type="checkbox" name="ssba_facebook" id="ssba_facebook" ' 	 		. ($arrSettings['ssba_facebook'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Twitter&nbsp;<input type="checkbox" name="ssba_twitter" id="ssba_twitter" ' 		 		. ($arrSettings['ssba_twitter'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Google&nbsp;<input type="checkbox" name="ssba_google" id="ssba_google" ' 			 		. ($arrSettings['ssba_google'] 	 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Digg&nbsp;<input type="checkbox" name="ssba_diggit" id="ssba_diggit" ' 			 		. ($arrSettings['ssba_diggit'] 		== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'LinkedIn&nbsp;<input type="checkbox" name="ssba_linkedin" id="ssba_linkedin" ' 		 	. ($arrSettings['ssba_linkedin'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'Pinterest&nbsp;<input type="checkbox" name="ssba_pinterest" id="ssba_pinterest" '	 		. ($arrSettings['ssba_pinterest'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo 'StumbleUpon&nbsp;<input type="checkbox" name="ssba_stumbleupon" id="ssba_stumbleupon" ' 	. ($arrSettings['ssba_stumbleupon'] == 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						echo '<p class="description">Check all those that you wish to include</p></td>';
					echo '</tr>';
					echo '<tr valign="top">';
						echo '<td><input type="submit" value="Save changes" id="submit" class="button button-primary"/></td>';
					echo '</tr>';
				echo '</table>';
			echo '</form>';
			
			// image set previews and showcase link below
			echo '<br />';
			echo '<h2>Showcase</h2>';
			echo '<p class="description">Enjoying the Simple Share Buttons Adder? Would you like to showcase your website? <a href="http://www.davidsneal.co.uk/wordpress/share-buttons-showcase" target="_blank">Leave a comment on this page</a>.</p>';
			echo '<h2>Image Sets</h2>';
			echo '<div id="ssba_preview">';
			echo '<h3><a href="http://arbent.net/blog/social-media-circles-icon-set" target="_blank">Arbenta</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/arbenta.png" style="padding: 5px" />';
			
			echo '<h3><a href="http://365psd.com/day/3-52/" target="_blank">Default</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/default.png" style="padding: 5px" />';
			
			echo '<h3><a href="http://creativenerds.co.uk/freebies/metal-social-media-free-icon-set/" target="_blank">Metal</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/metal.png" style="padding: 5px" />';
			
			echo '<h3><a href="http://www.productivedreams.com/page-peel-free-social-iconset/" target="_blank">Page Peel</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/pagepeel.png" style="padding: 5px" />';
			
			echo '<h3><a href="http://www.designbolts.com/2012/12/02/free-fat-social-media-icons-set-2013/" target="_blank">Plain</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/plain.png" style="padding: 5px" />';
			
			echo '<h3><a href="http://www.designbolts.com/2012/09/09/20-free-retro-style-social-media-icons-set-256-x-256-png/" target="_blank">Retro</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/retro.png" style="padding: 5px" />';
			
			echo '<h3><a href="http://www.designbolts.com/2012/09/19/beautiful-ribbon-social-media-icons-pack/" target="_blank">Ribbons</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/ribbons.png" style="padding: 5px" />';
			
			echo '<h3><a href="http://simpleicons.org/" target="_blank">Simple</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/simple.png" style="padding: 5px" />';
			
			echo '<h3><a href="http://vervex.deviantart.com/art/Somacro-32-300DPI-Social-Media-Icons-267955425" target="_blank">Somacro</a></h3>';
			echo '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/images/somacro.png" style="padding: 5px" />';
			echo '</div>';
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
	function get_share_buttons($arrSettings) {
	
		// variables
		$htmlShareButtons = '';
		$urlCurrentPage = get_current_url();
		
		// check for facebook
		if ($arrSettings['ssba_facebook'] == Y) {
		
			// show facebook share button
			$htmlShareButtons .= '<a href="http://www.facebook.com/sharer.php?u=' . $urlCurrentPage  . '" target="_blank">';
			$htmlShareButtons .= '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/facebook' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" /></a>';
		}
		
		// check for twitter
		if ($arrSettings['ssba_twitter'] == Y) {
		
			// show twitter share button
			$htmlShareButtons .= '<a href="http://twitter.com/share?url=' . $urlCurrentPage  . '" target="_blank">';
			$htmlShareButtons .= '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/twitter' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" /></a>';
		}
		
		// check for google
		if ($arrSettings['ssba_google'] == Y) {
		
			// show google share button
			$htmlShareButtons .= '<a href="https://plus.google.com/share?url=' . $urlCurrentPage  . '" target="_blank">';
			$htmlShareButtons .= '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/google' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" /></a>';
		}
		
		// check for diggit
		if ($arrSettings['ssba_diggit'] == Y) {
		
			// show diggit share button
			$htmlShareButtons .= '<a href="http://www.digg.com/submit?url=' . $urlCurrentPage  . '" target="_blank">';
			$htmlShareButtons .= '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/diggit' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" /></a>';
		}
		
		// check for linkedin
		if ($arrSettings['ssba_linkedin'] == Y) {
		
			// show linkedin share button
			$htmlShareButtons .= '<a href="http://www.linkedin.com/shareArticle?mini=true&url=' . $urlCurrentPage  . '" target="_blank">';
			$htmlShareButtons .= '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/linkedin' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" /></a>';
		}
		
		// check for pinterest
		if ($arrSettings['ssba_pinterest'] == Y) {
		
			// show pinterest share button
			$htmlShareButtons .= "<a  target='_blank' href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'>";
			$htmlShareButtons .= '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/pinterest' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" /></a>';
		}
		
		// check for stumbleupon
		if ($arrSettings['ssba_stumbleupon'] == Y) {
		
			// show stumbleupon share button
			$htmlShareButtons .= '<a href="http://www.stumbleupon.com/submit?url=' . $urlCurrentPage  . '" target="_blank">';
			$htmlShareButtons .= '<img src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/stumbleupon' . ($arrSettings['ssba_size'] == 'small' ? '-small' : NULL) . '.png" /></a>';
		}
		
		// return share buttons
		return $htmlShareButtons;
	}
	
	// get the current url
	function get_current_url () {
	
		// variables
		 $pageURL = 'http';
		 
		// add s to the url if required
		($_SERVER['HTTPS'] == 'on' ? $pageURL .= 's' : NULL);
		 
		// add colon and slashes
		$pageURL .= '://';
		 
		// check if server is not equal to 80
		if ($_SERVER['SERVER_PORT'] != '80') {
		
			// add the port if needed
			$pageURL .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
		} else {
		
			// add url details without port
			$pageURL .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		}
		
		// return the url
		return $pageURL;
	}
	
	// get and show share buttons
	function show_share_buttons($content) {
	
		// globals
		global $post;
		
		// variables
		$htmlContent = $content;
		$htmlShareButtons = '';
		$strIsWhatFunction = '';
	
		// get sbba settings
		$arrSettings = get_ssba_settings();
		
		// switch for posts or pages
		switch ($arrSettings['ssba_posts_or_pages']) {
		
			case 'both': // show on posts and pages
			$strIsWhatFunction = is_single() || is_page();
			break;
			
			case 'posts': // posts only
			$strIsWhatFunction = is_single();
			break;
			
			case 'pages': // pages only
			$strIsWhatFunction = is_page();
			break;
		}

		// placement on pages/posts/categories
		if ($strIsWhatFunction) {
		
			// css style
			$htmlShareButtons = '<style type="text/css">
									#ssba img	{ 	
													padding: ' . $arrSettings['ssba_padding'] . 'px;
													border:  0;
												}
								</style>';
			
			// ssba buttons!!
			$htmlShareButtons.= '<div id="ssba">';
			$htmlShareButtons.= ($arrSettings['ssba_align'] == 'center' ? '<center>' : NULL);
			$htmlShareButtons.= get_share_buttons($arrSettings);
			$htmlShareButtons.= ($arrSettings['ssba_align'] == 'center' ? '</center>' : NULL);
			$htmlShareButtons.= '</div>';
			
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
		
		// return content and share buttons
		return $htmlContent;
	}

	// add answer option to the end of the post
	add_filter( 'the_content', 'show_share_buttons');	
	
?>