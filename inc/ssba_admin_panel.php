﻿<?php

function ssba_admin_panel($arrSettings, $htmlSettingsSaved) {

	// variables
	$htmlShareButtonsForm = '';
	$strWordPressVersion = get_bloginfo('version');
	
	// header
	$htmlShareButtonsForm .= '<div id="ssba-header">';
	
		//logo
		$htmlShareButtonsForm .= '<div id="ssba-logo">';
			$htmlShareButtonsForm .= '<a href="http://www.simplesharebuttons.com" target="_blank"><img src="' . plugins_url() . '/simple-share-buttons-adder/images/simplesharebuttons.png' . '" /></a>';
		$htmlShareButtonsForm .= '</div>';
		
		// top nav
		$htmlShareButtonsForm .= '<div id="ssba-top-nav">';
			$htmlShareButtonsForm .= '<a href="http://www.simplesharebuttons.com/forums/forum/wordpress-forum/" target="_blank">Support</a>';
			$htmlShareButtonsForm .= '<a href="http://www.simplesharebuttons.com/showcase/" target="_blank">Showcase</a>';
			$htmlShareButtonsForm .= '<a href="http://www.simplesharebuttons.com/donate/" target="_blank">Donate</a>';
		$htmlShareButtonsForm .= '</div>';
		
	// close header
	$htmlShareButtonsForm .= '</div>';
	
	// tabs
	$htmlShareButtonsForm .= '<div id="ssba-tabs">';
	$htmlShareButtonsForm .= '<a id="ssba_tab_basic" class="ssba-selected-tab" href="javascript:;">Basic</a>';
	$htmlShareButtonsForm .= '<a id="ssba_tab_styling" href="javascript:;">Styling</a>';
	$htmlShareButtonsForm .= '<a id="ssba_tab_advanced" href="javascript:;">Advanced</a>';
	$htmlShareButtonsForm .= '</div>';
	
	// html form
	$htmlShareButtonsForm .= '<div class="wrap">';
	
		// show settings saved message if set
		(isset($htmlSettingsSaved) ? $htmlShareButtonsForm .= $htmlSettingsSaved : NULL);
		
		// start form
		$htmlShareButtonsForm .= '<form method="post">';
		
		// hidden field to check for post IMPORTANT
		$htmlShareButtonsForm .= '<input type="hidden" name="ssba_options" id="ssba_options" value="save" />';
		
			//------ BASIC TAB -------//
			
			$htmlShareButtonsForm .= '<div id="ssba_settings_basic">';
				$htmlShareButtonsForm .= '<h2>Basic Settings</h2>';
				$htmlShareButtonsForm .= '<table class="form-table">';
					$htmlShareButtonsForm .= '<tr><td><h3>Where</h3></td></tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Location:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= 'Homepage&nbsp;<input type="checkbox" name="ssba_homepage" id="ssba_homepage" ' 	 	. ($arrSettings['ssba_homepage'] 	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						$htmlShareButtonsForm .= 'Pages&nbsp;<input type="checkbox" name="ssba_pages" id="ssba_pages" ' 		 		. ($arrSettings['ssba_pages'] 		== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						$htmlShareButtonsForm .= 'Posts&nbsp;<input type="checkbox" name="ssba_posts" id="ssba_posts" ' 		 		. ($arrSettings['ssba_posts'] 		== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						$htmlShareButtonsForm .= 'Categories&#47;Archives&nbsp;<input type="checkbox" name="ssba_cats_archs" id="ssba_cats_archs" '	. ($arrSettings['ssba_cats_archs']	== 'Y'   ? 'checked' : NULL) . ' value="Y" style="margin-right: 10px;" />';
						$htmlShareButtonsForm .= '<p class="description">Check all those that you wish to show your share buttons</br>Note you can also show&#47;hide your buttons using &#91;ssba&#93; and &#91;ssba&#95;hide&#93;</p></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_before_or_after">Placement:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><select name="ssba_before_or_after" id="ssba_before_or_after">';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_before_or_after'] == 'after' 	? 'selected="selected"' : NULL) . ' value="after">After</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_before_or_after'] == 'before' ? 'selected="selected"' : NULL) . ' value="before">Before</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_before_or_after'] == 'both' 	? 'selected="selected"' : NULL) . ' value="both">Both</option>';
						$htmlShareButtonsForm .= '</select>';
						$htmlShareButtonsForm .= '<p class="description">Place share buttons before or after your content</p></td>';
					$htmlShareButtonsForm .= '</tr>';
						$htmlShareButtonsForm .= '<tr><td><h3>What</h3></td></tr>';
						$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_share_text">Share Text:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><input type="text" name="ssba_share_text" id="ssba_share_text" value="' . $arrSettings['ssba_share_text'] . '" />';
						$htmlShareButtonsForm .= '<p class="description">Add some custom text by your share buttons</p></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_image_set">Image Set:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><select name="ssba_image_set" id="ssba_image_set">';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'arbenta' 		? 'selected="selected"' : NULL) . ' value="arbenta">Arbenta</option>';
						
						//only display custom option if user has version 3.5+
						if ($strWordPressVersion >= 3.5) {
						
							// show custom option
							$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'custom' 		? 'selected="selected"' : NULL) . ' value="custom">Custom</option>';
						}
						
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'default' 		? 'selected="selected"' : NULL) . ' value="default">Default</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'metal' 		? 'selected="selected"' : NULL) . ' value="metal">Metal</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'pagepeel' 	? 'selected="selected"' : NULL) . ' value="pagepeel">Page Peel</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'plain' 		? 'selected="selected"' : NULL) . ' value="plain">Plain</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'retro' 		? 'selected="selected"' : NULL) . ' value="retro">Retro</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'ribbons' 		? 'selected="selected"' : NULL) . ' value="ribbons">Ribbons</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'simple' 		? 'selected="selected"' : NULL) . ' value="simple">Simple</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_image_set'] == 'somacro' 		? 'selected="selected"' : NULL) . ' value="somacro">Somacro</option>';
						$htmlShareButtonsForm .= '</select>';
						$htmlShareButtonsForm .= '<p class="description"><a href="http://www.simplesharebuttons.com/button-sets/" target="_blank">Click here</a> to preview the button sets</br>';
						
						// message for those not using 3.5+
						if ($strWordPressVersion >= 3.5) {
							
							// custom descr
							$htmlShareButtonsForm .= "Choose your favourite set of buttons, or set to 'Custom' to choose your own.</p></td>";
						}
						
						// message for those using <3.5
						else {
						
							// update message
							$htmlShareButtonsForm .= "You must update WordPress to v3.5&#43; to use custom images.</p></td>";
						}
						
					$htmlShareButtonsForm .= '</tr>';
				$htmlShareButtonsForm .= '</table>';
				
				// --------- CUSTOM IMAGES ------------ //
				$htmlShareButtonsForm .= '<div id="ssba-custom-images"' . ($arrSettings['ssba_image_set'] != 'custom' ? 'style="display: none;"' : NULL) . '>';
				$htmlShareButtonsForm .= '<h4>Custom Images</h4>';
				$htmlShareButtonsForm .= '<table class="form-table">';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Diggit:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_diggit" type="text" size="50" name="ssba_custom_diggit" value="' . (isset($arrSettings['ssba_custom_diggit']) ? $arrSettings['ssba_custom_diggit'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_diggit_button" data-ssba-input="ssba_custom_diggit" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Email:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_email" type="text" size="50" name="ssba_custom_email" value="' . (isset($arrSettings['ssba_custom_email']) ? $arrSettings['ssba_custom_email'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_email_button" data-ssba-input="ssba_custom_email" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Facebook:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_facebook" type="text" size="50" name="ssba_custom_facebook" value="' . (isset($arrSettings['ssba_custom_facebook']) ? $arrSettings['ssba_custom_facebook'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_facebook_button" data-ssba-input="ssba_custom_facebook" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Google:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_google" type="text" size="50" name="ssba_custom_google" value="' . (isset($arrSettings['ssba_custom_google']) ? $arrSettings['ssba_custom_google'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_google_button" data-ssba-input="ssba_custom_google" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>LinkedIn:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_linkedin" type="text" size="50" name="ssba_custom_linkedin" value="' . (isset($arrSettings['ssba_custom_linkedin']) ? $arrSettings['ssba_custom_linkedin'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_linkedin_button" data-ssba-input="ssba_custom_linkedin" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Pinterest:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_pinterest" type="text" size="50" name="ssba_custom_pinterest" value="' . (isset($arrSettings['ssba_custom_pinterest']) ? $arrSettings['ssba_custom_pinterest'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_pinterest_button" data-ssba-input="ssba_custom_pinterest" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Reddit:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_reddit" type="text" size="50" name="ssba_custom_reddit" value="' . (isset($arrSettings['ssba_custom_reddit']) ? $arrSettings['ssba_custom_reddit'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_reddit_button" data-ssba-input="ssba_custom_reddit" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>StumbleUpon:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_stumbleupon" type="text" size="50" name="ssba_custom_stumbleupon" value="' . (isset($arrSettings['ssba_custom_stumbleupon']) ? $arrSettings['ssba_custom_stumbleupon'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_stumbleupon_button" data-ssba-input="ssba_custom_stumbleupon" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Twitter:</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<input id="ssba_custom_twitter" type="text" size="50" name="ssba_custom_twitter" value="' . (isset($arrSettings['ssba_custom_twitter']) ? $arrSettings['ssba_custom_twitter'] : NULL)  . '" />';
						$htmlShareButtonsForm .= '<input id="upload_twitter_button" data-ssba-input="ssba_custom_twitter" class="button customUpload" type="button" value="Upload Image" />';
						$htmlShareButtonsForm .= '<p class="description">Enter the URLs of your images or upload from here.<br/>Simply leave any blank you do not wish to include.</p></td>';
					$htmlShareButtonsForm .= '</tr>';
				$htmlShareButtonsForm .= '</table>';
				$htmlShareButtonsForm .= '</div>';
				
				// --------- NON-CUSTOM IMAGE SETTINGS ------------ //
				
				// if using 3.5+
				if ($strWordPressVersion >= 3.5) {
					
					// show drag and drop options
					$htmlShareButtonsForm .= '<div id="ssba-image-settings">';
					$htmlShareButtonsForm .= '<table class="form-table">';
						$htmlShareButtonsForm .= '<tr valign="top">';
							$htmlShareButtonsForm .= '<th scope="row" style="width: 120px !important;"><label for="ssba_choices">Include:</label></th>';
							$htmlShareButtonsForm .= '<td class="ssba-include-list available">';
								$htmlShareButtonsForm .= '<span class="include-heading">Available</span>';
								$htmlShareButtonsForm .= '<center><ul id="ssbasort1" class="connectedSortable">';
								 $htmlShareButtonsForm .= getAvailableSSBA($arrSettings['ssba_selected_buttons']);
								$htmlShareButtonsForm .= '</ul></center>';
							$htmlShareButtonsForm .= '</td>';
							$htmlShareButtonsForm .= '<td class="ssba-include-list chosen">';
								$htmlShareButtonsForm .= '<span class="include-heading">Selected</span>';
								$htmlShareButtonsForm .= '<center><ul id="ssbasort2" class="connectedSortable">';
								$htmlShareButtonsForm .= getSelectedSSBA($arrSettings['ssba_selected_buttons']);
								$htmlShareButtonsForm .= '</ul></center>';
							$htmlShareButtonsForm .= '</td>';
						$htmlShareButtonsForm .= '</tr>';
						$htmlShareButtonsForm .= '<tr valign="top">';
							$htmlShareButtonsForm .= '<th scope="row" style="width: 120px !important;"></th>';
							$htmlShareButtonsForm .= '<td colspan=2>';
								$htmlShareButtonsForm .= '<p class="description">Drag, drop and reorder those buttons that you wish to include.</p>';
							$htmlShareButtonsForm .= '</td>';
						$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '</table>';
					$htmlShareButtonsForm .= '<input type="hidden" name="ssba_selected_buttons" id="ssba_selected_buttons" />';
					$htmlShareButtonsForm .= '</div>';
				}
				
				// if using < 3.5
				else {
				
					// show simple text entry field for order/include option
					$htmlShareButtonsForm .= '<table class="form-table">';
						$htmlShareButtonsForm .= '<tr valign="top">';
							$htmlShareButtonsForm .= '<th scope="row" style="width: 120px !important;"><label for="ssba_selected_buttons">Include:</label></th>';
							$htmlShareButtonsForm .= '<td>';
								$htmlShareButtonsForm .= '<textarea rows="1" cols="90" name="ssba_selected_buttons">' . $arrSettings['ssba_selected_buttons'] . '</textarea>';
							$htmlShareButtonsForm .= '</td>';
						$htmlShareButtonsForm .= '</tr>';
						$htmlShareButtonsForm .= '<tr valign="top">';
							$htmlShareButtonsForm .= '<th scope="row" style="width: 120px !important;"></th>';
							$htmlShareButtonsForm .= '<td>';
								$htmlShareButtonsForm .= '<p class="description">Copy and paste the list of social sites below separated by commas, then edit to your liking</br><strong>facebook,pinterest,twitter,google,linkedin,reddit,diggit,stumbleupon,email</strong><br/>Update your WordPress version to 3.5&#43; to use the drag and drop facility.</p>';
								$htmlShareButtonsForm .= '<p class="description"><strong>Entering anything incorrectly in this input will cause temporary problems with your website, if you are unsure, please visit the <a href="http://www.simplesharebuttons.com/forums/forum/wordpress-forum/" target="blank">support forums</a>.</strong></p>';
							$htmlShareButtonsForm .= '</td>';
						$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '</table>';
				}
				
				
			// close basic tab div
			$htmlShareButtonsForm .= '</div>';
			
			
		//------ STYLING TAB ------//
		
		//----- STYLING SETTINGS DIV ------//
		$htmlShareButtonsForm .= '<div id="ssba_settings_styling" style="display: none;">';
			$htmlShareButtonsForm .= '<h2>Style Settings</h2>';
			$htmlShareButtonsForm .= '<div id="ssba_toggle_styling" style="margin: 10px 0 20px;">';
			
			// if using 3.5+
			if ($strWordPressVersion >= 3.5) {
			
				// toggle setting options
				$htmlShareButtonsForm .= 'Toggle between <a href="javascript:;" id="ssba_button_normal_settings">assisted styling</a> and <a href="javascript:;" id="ssba_button_custom_styles">custom CSS</a>.';
			}
			
			// using 3.5+
			else {
			
				// upgrade notice
				$htmlShareButtonsForm .= 'Custom CSS is only available for WordPress versions 3.5&#43;';
			}
			
			// close toggle styling div
			$htmlShareButtonsForm .= '</div>';
		
			// normal settings options
			$htmlShareButtonsForm .= '<div id="ssba_normal_settings" ' . ($arrSettings['ssba_custom_styles'] != '' ? 'style="display: none;"' : NULL) . '>';
				$htmlShareButtonsForm .= '<table class="form-table">';
					$htmlShareButtonsForm .= '<tr><td><h3>Buttons</h3></td></tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_size">Button Size:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><input type="number" name="ssba_size" id="ssba_size" step="1" min="10" max="50" value="' . $arrSettings['ssba_size'] . '"><span class="description">px</span>';
						$htmlShareButtonsForm .= '<p class="description">Set the width of your buttons in pixels</p></td>';
						$htmlShareButtonsForm .= '</input></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_align">Alignment:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><select name="ssba_align" id="ssba_align">';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_align'] == 'left'   ? 'selected="selected"' : NULL) . ' value="left">Left</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_align'] == 'center' ? 'selected="selected"' : NULL) . ' value="center">Center</option>';
						$htmlShareButtonsForm .= '</select>';
						$htmlShareButtonsForm .= '<p class="description">Center your buttons if desired</p></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_padding">Padding:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><input type="number" name="ssba_padding" id="ssba_padding" step="1" min="0" value="' . $arrSettings['ssba_padding'] . '" /><span class="description">px</span>';
						$htmlShareButtonsForm .= '<p class="description">Apply some space around your images</p></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr><td><h3>Share Text</h3></td></tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_font_color">Font Colour:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><input type="text" name="ssba_font_color" id="ssba_font_color" value="' . $arrSettings['ssba_font_color'] . '">';
						$htmlShareButtonsForm .= '</input>';
						$htmlShareButtonsForm .= '<p class="description">Choose the colour of your share text</p></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_font_family">Font Family:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><select name="ssba_font_family" id="ssba_font_family">';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_font_family'] == 'Reenie Beanie' ? 'selected="selected"' : NULL) . ' value="Reenie Beanie">Reenie Beanie</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_font_family'] == 'Indie Flower'  ? 'selected="selected"' : NULL) . ' value="Indie Flower">Indie Flower</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_font_family'] == '' 			   ? 'selected="selected"' : NULL) . ' value="">Inherit from my website</option>';
						$htmlShareButtonsForm .= '</select>';
						$htmlShareButtonsForm .= '<p class="description">Choose a font available or inherit the font from your website</p></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_font_size">Font Size:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><input type="number" name="ssba_font_size" id="ssba_font_size" value="' . $arrSettings['ssba_font_size'] . '"><span class="description">px</span>';
						$htmlShareButtonsForm .= '</input>';
						$htmlShareButtonsForm .= '<p class="description">Set the size of the share text in pixels</p></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_font_weight">Font Weight:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><select name="ssba_font_weight" id="ssba_font_weight">';
						$htmlShareButtonsForm .= '<option value="">Please select...</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_font_weight'] == 'bold'   ? 'selected="selected"' : NULL) . ' value="bold">Bold</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_font_weight'] == 'normal' ? 'selected="selected"' : NULL) . ' value="normal">Normal</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_font_weight'] == 'light' ? 'selected="selected"' : NULL) . ' value="light">Light</option>';
						$htmlShareButtonsForm .= '</select>';
						$htmlShareButtonsForm .= '<p class="description">Set the weight of the share text</p></td>';
					$htmlShareButtonsForm .= '</tr>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_text_placement">Text placement:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td><select name="ssba_text_placement" id="ssba_text_placement">';
						$htmlShareButtonsForm .= '<option value="">Please select...</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_text_placement'] == 'above'   ? 'selected="selected"' : NULL) . ' value="above">Above</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_text_placement'] == 'left' 	? 'selected="selected"' : NULL) . ' value="left">Left</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_text_placement'] == 'right' 	? 'selected="selected"' : NULL) . ' value="right">Right</option>';
						$htmlShareButtonsForm .= '<option ' . ($arrSettings['ssba_text_placement'] == 'below' 	? 'selected="selected"' : NULL) . ' value="below">Below</option>';
						$htmlShareButtonsForm .= '</select>';
						$htmlShareButtonsForm .= '<p class="description">Choose where you want your text to be displayed, in relation to the buttons</p></td>';
					$htmlShareButtonsForm .= '</tr>';
				$htmlShareButtonsForm .= '</table>';
			$htmlShareButtonsForm .= '</div>';
				
			// custom style field
			$htmlShareButtonsForm .= '<div id="ssba_option_custom_css" ' . ($arrSettings['ssba_custom_styles'] == '' ? 'style="display: none;"' : NULL) . '>';
				$htmlShareButtonsForm .= '<table>';
					$htmlShareButtonsForm .= '<tr valign="top">';
						$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_custom_styles">Custom CSS:&nbsp;</label></th>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '<textarea name="ssba_custom_styles" id="ssba_custom_styles" rows="20" cols="50">' . $arrSettings['ssba_custom_styles'] . '</textarea>';
						$htmlShareButtonsForm .= '<td>';
							$htmlShareButtonsForm .= <<<CODE
													<h3>Default CSS</h3>
													#ssba img</br>	
													{ 	</br>
														width: 35px;</br>
														padding: 6px;</br>
														border:  0;</br>
														box-shadow: none !important;</br>
														display: inline;</br>
														vertical-align: middle;</br>
													}</br></br>
													#ssba, #ssba a		</br>
													{</br>
														font-family: Indie Flower;</br>
														font-size: 	20px;</br>
													}
CODE;
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '<tr>';
						$htmlShareButtonsForm .= '<td>';
						$htmlShareButtonsForm .= '</td>';
						$htmlShareButtonsForm .= '<td colspan=2>';
							$htmlShareButtonsForm .= '<p class="description">Note that entering any text into the &#39;Custom styles&#39; box will automatically override any other style settings on this page.<br/>The div id is ssba.</p>';
						$htmlShareButtonsForm .= '</td>';
					$htmlShareButtonsForm .= '</tr>';
				$htmlShareButtonsForm .= '</table>';
			$htmlShareButtonsForm .= '</div>';
			
		// close styling tab
		$htmlShareButtonsForm .= '</div>';
		
		//------ ADVANCED TAB ------//
		
		$htmlShareButtonsForm .= '<div id="ssba_settings_advanced" style="display: none;">';
			$htmlShareButtonsForm .= '<h2>Advanced Settings</h2>';
			$htmlShareButtonsForm .= '<table class="form-table">';
				$htmlShareButtonsForm .= '<tr valign="top">';
					$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Links:</label></th>';
					$htmlShareButtonsForm .= '<td>';
					$htmlShareButtonsForm .= 'Open links in a new window&nbsp;<input type="checkbox" name="ssba_share_new_window" id="ssba_share_new_window" ' . ($arrSettings['ssba_share_new_window'] == 'Y'   ? 'checked' : NULL) . ' value="Y" />';
					$htmlShareButtonsForm .= '<p class="description">Unchecking this box will make links open in the same window</p></td>';
				$htmlShareButtonsForm .= '</tr>';
				$htmlShareButtonsForm .= '<tr valign="top">';
					$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label for="ssba_email_message">Email Text:&nbsp;</label></th>';
					$htmlShareButtonsForm .= '<td><input type="text" name="ssba_email_message" id="ssba_email_message" value="' . $arrSettings['ssba_email_message'] . '" />';
					$htmlShareButtonsForm .= '<p class="description">Add some text included in the email when people share that way</p></td>';
				$htmlShareButtonsForm .= '</tr>';
				$htmlShareButtonsForm .= '<tr valign="top">';
					$htmlShareButtonsForm .= '<th scope="row" style="width: 120px;"><label>Share Text Link:</label></th>';
					$htmlShareButtonsForm .= '<td>';
					$htmlShareButtonsForm .= 'Share text links to simplesharebuttons.com&nbsp;<input type="checkbox" name="ssba_link_to_ssb" id="ssba_link_to_ssb" ' . ($arrSettings['ssba_link_to_ssb'] == 'Y'   ? 'checked' : NULL) . ' value="Y" />';
					$htmlShareButtonsForm .= '<p class="description">Leave this checked if you are feeling kind &#58;&#41;</p></td>';
				$htmlShareButtonsForm .= '</tr>';
			$htmlShareButtonsForm .= '</table>';
		$htmlShareButtonsForm .= '</div>';
		
		// save button
		$htmlShareButtonsForm .= '<table class="form-table">';
				$htmlShareButtonsForm .= '<tr valign="top">';
					$htmlShareButtonsForm .= '<td><input type="submit" value="Save changes" id="submit" class="button button-primary"/></td>';
				$htmlShareButtonsForm .= '</tr>';
			$htmlShareButtonsForm .= '</table>';
		$htmlShareButtonsForm .= '</form>';
		
	//
	$htmlShareButtonsForm .= '<div class="ssba-box ssba-shadow">
								<div class="ssba-box-content">Quite a fair amount of time and effort has gone into Simple Share Buttons, any donations would be greatly appreciated, it will help me continue to be able to offer this for free!<p></p>
			<p>
					</p><div class="author-shortcodes">
						<div class="author-inner">
							<div class="author-image">
						<img src="http://www.simplesharebuttons.com/wp-content/uploads/et_temp/david-44682_60x60.jpg" alt="">
						<div class="author-overlay"></div>
					</div> <!-- .author-image --> 
					<div class="author-info">
						<a href="http://www.davidsneal.co.uk" target="_blank">David Neal</a> – Married, father of one, with an (sometimes unhealthy) obsession with websites, coding and gaming. This plugin and its website has been funded by myself.
					</div> <!-- .author-info -->
						</div> <!-- .author-inner -->
					</div> <!-- .author-shortcodes -->
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="image" alt="PayPal – The safer, easier way to pay online." name="submit" src="https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif"> <img alt="" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1" border="0"> </form></div></div>';

	// close #wrap	
	$htmlShareButtonsForm .= '</div>';
	
	echo $htmlShareButtonsForm;
}

// get an html formatted of currently selected and ordered buttons
function getSelectedSSBA($strSelectedSSBA) {

	// variables
	$htmlSelectedList = '';
	$arrSelectedSSBA = '';

	// if there are some selected buttons
	if ($strSelectedSSBA != '') {
	
		// explode saved include list and add to a new array
		$arrSelectedSSBA = explode(',', $strSelectedSSBA);
		
		// check if array is not empty
		if ($arrSelectedSSBA != '') {
		
			// for each included button
			foreach ($arrSelectedSSBA as $strSelected) {
			
				// add a list item for each selected option
				$htmlSelectedList .= '<li id="' . $strSelected . '">' . $strSelected . '</li>';
			}
		}
	}
	
	// return html list options
	return $htmlSelectedList;
}

// get an html formatted of currently selected and ordered buttons
function getAvailableSSBA($strSelectedSSBA) {

	// variables
	$htmlAvailableList = '';
	$arrSelectedSSBA = '';
	
	// explode saved include list and add to a new array
	$arrSelectedSSBA = explode(',', $strSelectedSSBA);
	
	// create array of all available buttons
	$arrAllAvailableSSBA = array('diggit', 'email', 'facebook', 'google', 'linkedin', 'pinterest', 'reddit', 'stumbleupon', 'twitter');
	
	// explode saved include list and add to a new array
	$arrAvailableSSBA = array_diff($arrAllAvailableSSBA, $arrSelectedSSBA);
	
	// check if array is not empty
	if ($arrSelectedSSBA != '') {
	
		// for each included button
		foreach ($arrAvailableSSBA as $strAvailable) {
		
			// add a list item for each available option
			$htmlAvailableList .= '<li id="' . $strAvailable . '">' . $strAvailable . '</li>';
		}
	}
	
	// return html list options
	return $htmlAvailableList;
}

?>