<?php
/*
Plugin Name: Simple Share Buttons Adder
Plugin URI: http://www.simplesharebuttons.com
Description: A simple plugin that enables you to add share buttons to all of your posts and/or pages.
Version: 2.0
Author: David S. Neal
Author URI: http://www.davidsneal.co.uk/
License: GPLv2

Copyright 2013 Simple Share Buttons admin@simplesharebuttons.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/
	// turn error reporting off
	//error_reporting(0);

	// --------- INSTALLATION ------------ //

	// run the activation function upon acitvation of the plugin
	register_activation_hook( __FILE__,'ssba_activate');
	
	// register deactivation hook
	register_uninstall_hook(__FILE__,'ssba_uninstall');
	
	// activate ssba function
	function ssba_activate() {
	
		// insert default options for ssba
		add_option('ssba_version', 				'2.0');
		add_option('ssba_image_set', 			'somacro');
		add_option('ssba_size', 				'35');
		add_option('ssba_pages',				'');
		add_option('ssba_posts',				'');
		add_option('ssba_cats_archs',			'');
		add_option('ssba_homepage',				'');
		add_option('ssba_align', 				'left');
		add_option('ssba_padding', 				'6');
		add_option('ssba_before_or_after', 		'after');
		add_option('ssba_custom_styles', 		'');
		add_option('ssba_email_message', 		'');
		add_option('ssba_share_new_window', 	'Y');
		add_option('ssba_link_to_ssb', 			'Y');
		
		// share text
		add_option('ssba_share_text', 			"Don't be shellfish...");
		add_option('ssba_text_placement', 		'left');
		add_option('ssba_font_family', 			'Indie Flower');
		add_option('ssba_font_color',			'');	
		add_option('ssba_font_size',			'20');
		add_option('ssba_font_weight',			'');
		
		// include
		add_option('ssba_selected_buttons', 	'');
		
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
	
	// uninstall ssba
	function ssba_uninstall() {

		//if uninstall not called from WordPress exit
		if (defined('WP_UNINSTALL_PLUGIN')) {
			exit();
		}

		// delete all options
		delete_option('ssba_version');
		delete_option('ssba_image_set');
		delete_option('ssba_size');
		delete_option('ssba_pages');
		delete_option('ssba_posts');
		delete_option('ssba_cats_archs');
		delete_option('ssba_homepage');
		delete_option('ssba_align');
		delete_option('ssba_padding');
		delete_option('ssba_before_or_after');
		delete_option('ssba_custom_styles');
		delete_option('ssba_email_message');
		delete_option('ssba_share_new_window');
		delete_option('ssba_link_to_ssb');

		// share text
		delete_option('ssba_share_text');
		delete_option('ssba_text_placement');
		delete_option('ssba_font_family');
		delete_option('ssba_font_color');	
		delete_option('ssba_font_size');
		delete_option('ssba_font_weight');

		// include
		delete_option('ssba_selected_buttons');

		// custom images
		delete_option('ssba_custom_email');
		delete_option('ssba_custom_google');
		delete_option('ssba_custom_facebook');
		delete_option('ssba_custom_twitter');
		delete_option('ssba_custom_diggit');
		delete_option('ssba_custom_linkedin');
		delete_option('ssba_custom_reddit');
		delete_option('ssba_custom_stumbleupon');
		delete_option('ssba_custom_pinterest');
	}

	// --------- ADMIN BITS ------------ //
	
	// add settings link on plugin page
	function ssba_settings_link($links) { 
	
		// add to plugins links
		array_unshift($links, '<a href="options-general.php?page=simple-share-buttons-adder">Settings</a>'); 
		
		// return all links
		return $links; 
	}

	// add filter hook for plugin action links
	add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'ssba_settings_link' );
	
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
		wp_enqueue_script('jquery-ui-sortable');
	}
	
	// include styles for the ssba admin panel
	function ssba_admin_styles() {
	
		// admin styles
		wp_enqueue_style('thickbox');
		wp_enqueue_style('wp-color-picker');
		wp_register_style('ssba-styles', WP_PLUGIN_URL . '/simple-share-buttons-adder/css/style.css');
		wp_enqueue_style('ssba-styles');
	}
	
	// check if viewing the admin page
	if (isset($_GET['page']) && $_GET['page'] == 'simple-share-buttons-adder') {
	
		// add the registered scripts
		add_action('admin_print_styles', 'ssba_admin_styles');
		add_action('admin_print_scripts', 'ssba_admin_scripts');
	}
	
	// add css scripts for page/post use
	function ssba_page_scripts() {
	
		// js scripts 
		wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Reenie+Beanie|Indie+Flower');
        wp_enqueue_style( 'googleFonts');
	
		// register and enqueue css styles
		wp_register_style('ssba-page-styles', WP_PLUGIN_URL . '/simple-share-buttons-adder/css/page-style.css');
		wp_enqueue_style('ssba-page-styles');
	}
	
	// call scripts add function
	add_action( 'wp_enqueue_scripts', 'ssba_page_scripts' );
	
	// menu settings
	function ssba_menu() {
	
		// add menu page
		add_options_page( 'Simple Share Buttons Adder', 'Share Buttons', 'manage_options', 'simple-share-buttons-adder', 'ssba_settings');
		
		// query the db for current ssba settings
		$arrSettings = get_ssba_settings();
		
		// check if not yet updated to 2.0
		if ($arrSettings['ssba_version'] != '2.0') {
		
			// include then run the upgrade script
			include_once (plugin_dir_path(__FILE__) . '/inc/ssba_upgrade.php');
			upgrade_ssba($arrSettings);		
		}
		
		// check if any buttons have been selected
		if ($arrSettings['ssba_selected_buttons'] == '' && $_GET['page'] != 'simple-share-buttons-adder') {
		
			// output a warning that buttons need configuring and provide a link to settings
			echo '<div id="ssba-warning" class="updated fade"><p>Your <strong>Simple Share Buttons</strong> need <a href="admin.php?page=simple-share-buttons-adder"><strong>configuration</strong></a> before they will appear. <strong>View the tutorial video <a href="http://www.youtube.com/watch?v=p03B4C3QMzs" target="_blank">here</a></strong></p></div>';
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
		
		// variables
		$htmlSettingsSaved = '';
		
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
			update_option('ssba_email_message', 		stripslashes_deep($_POST['ssba_email_message']));
			update_option('ssba_share_new_window', 		$_POST['ssba_share_new_window']);
			update_option('ssba_link_to_ssb', 			$_POST['ssba_link_to_ssb']);

			// text
			update_option('ssba_share_text', 			stripslashes_deep($_POST['ssba_share_text']));	
			update_option('ssba_text_placement', 		$_POST['ssba_text_placement']);	
			update_option('ssba_font_family', 			$_POST['ssba_font_family']);	
			update_option('ssba_font_color', 			$_POST['ssba_font_color']);	
			update_option('ssba_font_size', 			$_POST['ssba_font_size']);	
			update_option('ssba_font_weight', 			$_POST['ssba_font_weight']);	

			// include
			update_option('ssba_selected_buttons', 		$_POST['ssba_selected_buttons']);
			
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
			$htmlSettingsSaved = '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>Your settings have been saved. <a href="' . site_url() . '">Visit your site</a> to see how your buttons look!</strong></p></div>';
		}
		
		// include then run the upgrade script
		include_once (plugin_dir_path(__FILE__) . '/inc/ssba_admin_panel.php');

		// query the db for current ssba settings
		$arrSettings = get_ssba_settings();

		// --------- ADMIN PANEL ------------ //
		ssba_admin_panel($arrSettings, $htmlSettingsSaved);
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
	
	// get and show share buttons
	function show_share_buttons($content, $booShortCode = FALSE) {
	
		// globals
		global $post;
		
		// includes
		include_once (plugin_dir_path(__FILE__) . '/inc/get_share_buttons.php');
		
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
											width: ' . $arrSettings['ssba_size'] . 'px;
											padding: ' . $arrSettings['ssba_padding'] . 'px;
											border:  0;
											box-shadow: 0;
											display: inline;
											vertical-align: middle;
										}
										#ssba, #ssba a		
										{
											' . ($arrSettings['ssba_font_family'] 	!= ''	? 'font-family: ' . $arrSettings['ssba_font_family'] . ';' : NULL) . '
											' . ($arrSettings['ssba_font_size']		!= ''	? 'font-size: 	' . $arrSettings['ssba_font_size'] . 'px;' : NULL) . '
											' . ($arrSettings['ssba_font_color'] 	!= ''	? 'color: 		' . $arrSettings['ssba_font_color'] . '!important;' : NULL) . '
											' . ($arrSettings['ssba_font_weight'] 	!= ''	? 'font-weight: ' . $arrSettings['ssba_font_weight'] . ';' : NULL) . '
										}';
			}
			
			$htmlShareButtons .= '</style>';
			
			// ssba div
			$htmlShareButtons.= '<div id="ssba">';
			
			// center if set so
			$htmlShareButtons.= ($arrSettings['ssba_align'] == 'center' ? '<center>' : NULL);
			
			// add custom text if set and set to placement above or left
			if (($arrSettings['ssba_share_text'] != '') && ($arrSettings['ssba_text_placement'] == 'above' || $arrSettings['ssba_text_placement'] == 'left')) {
			
				// check if user has left share link box checked
				if ($arrSettings['ssba_link_to_ssb'] == 'Y') {
				
					// share text with link
					$htmlShareButtons .= '<a href="http://www.simplesharebuttons.com" target="_blank" class="ssba_tooptip" id="ssba_tooptip""><span>www.simplesharebuttons.com</span>' . $arrSettings['ssba_share_text'];
				}
				
				// just display the share text
				else { 
					
					// share text
					$htmlShareButtons .= $arrSettings['ssba_share_text'];
				}
				// add a line break if set to above
				($arrSettings['ssba_text_placement'] == 'above' ? $htmlShareButtons .= '<br/>' : NULL);
			}
			
			// if running standard
			if ($booShortCode == FALSE) {
			
				// use wordpress functions for page/post details
				$urlCurrentPage = get_permalink($post->ID);	
				$strPageTitle = get_the_title($post->ID);
			}
			
			// if using shortcode
			else if ($booShortCode == TRUE) {
			
				// get page name and url from functions
				$urlCurrentPage = get_current_url();
				$strPageTitle = $_SERVER["SERVER_NAME"];
			}		
			
			// the buttons!
			$htmlShareButtons.= get_share_buttons($arrSettings, $urlCurrentPage, $strPageTitle);
			
			// add custom text if set and set to placement right or below
			if (($arrSettings['ssba_share_text'] != '') && ($arrSettings['ssba_text_placement'] == 'right' || $arrSettings['ssba_text_placement'] =='below')) {
			
				// add a line break if set to above
				($arrSettings['ssba_text_placement'] == 'below' ? $htmlShareButtons .= '<br/>' : NULL);
				
				// check if user has left share link box checked
				if ($arrSettings['ssba_link_to_ssb'] == 'Y') {
				
					// share text with link
					$htmlShareButtons .= '<a href="http://www.simplesharebuttons.com" target="_blank" class="ssba_tooptip" id="ssba_tooptip""><span>www.simplesharebuttons.com</span>' . $arrSettings['ssba_share_text'];
				}
				
				// just display the share text
				else { 
					
					// share text
					$htmlShareButtons .= $arrSettings['ssba_share_text'];
				}
			}
			
			// close center if set
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
	
	// shortcode for hiding buttons
	function ssba_hide($content){
	
		// add display none to the ssba div
		$htmlShareButtons .= 	'<style type="text/css">
									#ssba		
										{ 	
											display: none !important;
										}
								</style>' . $content;
	
		//return buttons
		return $htmlShareButtons;
	}
	
	// get URL function
	function get_current_url() {
	
		// add http
		$urlCurrentPage = 'http';
		
		// add s to http if required
		if ($_SERVER["HTTPS"] == "on") {$urlCurrentPage .= "s";}
		
		// add colon and forward slashes
		$urlCurrentPage .= "://";
		
		// check if port is not 80
		if ($_SERVER["SERVER_PORT"] != "80") {
		
			// include port if needed
			$urlCurrentPage .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			
		} 
		
		// else if on port 80
		else {
		
			// don't include port in url
			$urlCurrentPage .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		
		return $urlCurrentPage;
	}
	
	// register shortcode [ssba] to show [ssba_hide]
	add_shortcode( 'ssba', 		'ssba_buttons' );	
	add_shortcode( 'ssba_hide', 'ssba_hide' );	
	
?>