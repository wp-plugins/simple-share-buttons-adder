<?php

// get set share buttons
function get_share_buttons($arrSettings, $urlCurrentPage, $strPageTitle) {

	// variables
	$htmlShareButtons = '';
	
	// explode saved include list and add to a new array
	$arrSelectedSSBA = explode(',', $arrSettings['ssba_selected_buttons']);
	
	// check if array is not empty
	if ($arrSettings['ssba_selected_buttons'] != '') {
	
		// for each included button
		foreach ($arrSelectedSSBA as $strSelected) {
		
			 $strGetButton = 'ssba_' . $strSelected;
		
			// add a list item for each selected option
			$htmlShareButtons .= $strGetButton($arrSettings, $urlCurrentPage, $strPageTitle);
		}
	}
	
	// return share buttons
	return $htmlShareButtons;
}

// get facebook button
function ssba_facebook($arrSettings, $urlCurrentPage, $strPageTitle) {

	// facebook share link
	$htmlShareButtons .= '<a id="ssba_facebook_share" href="http://www.facebook.com/sharer.php?u=' . $urlCurrentPage  . '" ' . ($arrSettings['ssba_share_new_window'] == 'Y' ? 'target="_blank"' : NULL) . '>';
	
	// if not using custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show selected ssba image
		$htmlShareButtons .= '<img title="Facebook" alt="Facebook" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/facebook.png" />';
	}
	
	// if using custom images
	else {
	
		// show custom image
		$htmlShareButtons .= '<img title="Facebook" src="' . $arrSettings['ssba_custom_facebook'] . '" alt="Facebook" />';
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get twitter button
function ssba_twitter($arrSettings, $urlCurrentPage, $strPageTitle) {

	// remove any | symbols from the page title to allow page to be shared successfully
	$strPageTitle = str_replace('|', '', $strPageTitle);

	// twitter share link
	$htmlShareButtons .= '<a id="ssba_twitter_share" href="http://twitter.com/share?url=' . $urlCurrentPage  . '&text=' . $strPageTitle . '" ' . ($arrSettings['ssba_share_new_window'] == 'Y' ? 'target="_blank"' : NULL) . '>';
	
	// if image set is not custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show ssba image
		$htmlShareButtons .= '<img title="Twitter" alt="Twitter" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/twitter.png" />';
	}
	
	// if using custom images
	else {
	
		// show custom image
		$htmlShareButtons .= '<img title="Twitter" src="' . $arrSettings['ssba_custom_twitter'] . '" alt="Twitter" />';
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get google+ button
function ssba_google($arrSettings, $urlCurrentPage, $strPageTitle) {

	// google share link
	$htmlShareButtons .= '<a id="ssba_google_share" href="https://plus.google.com/share?url=' . $urlCurrentPage  . '" ' . ($arrSettings['ssba_share_new_window'] == 'Y' ? 'target="_blank"' : NULL) . '>';
	
	// if image set is not custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show ssba image
		$htmlShareButtons .= '<img title="Google+" alt="Google+" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/google.png" />';
	}
	
	// if using custom images
	else {
	
		// show custom image
		$htmlShareButtons .= '<img title="Google+" src="' . $arrSettings['ssba_custom_google'] . '" alt="Google+" />';
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get diggit button
function ssba_diggit($arrSettings, $urlCurrentPage, $strPageTitle) {

	// diggit share link
	$htmlShareButtons .= '<a id="ssba_diggit_share" class="ssba_share_link" href="http://www.digg.com/submit?url=' . $urlCurrentPage  . '" ' . ($arrSettings['ssba_share_new_window'] == 'Y' ? 'target="_blank"' : NULL) . '>';
	
	// if image set is not custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show ssba image
		$htmlShareButtons .= '<img title="Digg" alt="Digg" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/diggit.png" />';
	}
	
	// if using custom images
	else {
		
		// show custom image
		$htmlShareButtons .= '<img title="Digg" src="' . $arrSettings['ssba_custom_diggit'] . '" alt="Digg" />';			
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get reddit button
function ssba_reddit($arrSettings, $urlCurrentPage, $strPageTitle) {

	// reddit share link
	$htmlShareButtons .= '<a id="ssba_reddit_share" class="ssba_share_link" href="http://reddit.com/submit?url=' . $urlCurrentPage  . '&title=' . $strPageTitle . '" ' . ($arrSettings['ssba_share_new_window'] == 'Y' ? 'target="_blank"' : NULL) . '>';
	
	// if image set is not custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show ssba image
		$htmlShareButtons .= '<img title="Reddit" alt="Reddit" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/reddit.png" />';
	}
	
	// if using custom images
	else {
		
		// show custom image
		$htmlShareButtons .= '<img title="Reddit" src="' . $arrSettings['ssba_custom_reddit'] . '" alt="Reddit" />';
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get linkedin button
function ssba_linkedin($arrSettings, $urlCurrentPage, $strPageTitle) {

	// linkedin share link
	$htmlShareButtons .= '<a id="ssba_linkedin_share" class="ssba_share_link" href="http://www.linkedin.com/shareArticle?mini=true&url=' . $urlCurrentPage  . '" ' . ($arrSettings['ssba_share_new_window'] == 'Y' ? 'target="_blank"' : NULL) . '>';
	
	// if image set is not custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show ssba image
		$htmlShareButtons .= '<img title="Linkedin" alt="LinkedIn" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/linkedin.png" />';
	}
	
	// if using custom images
	else {
	
		// show custom image
		$htmlShareButtons .= '<img title="LinkedIn" src="' . $arrSettings['ssba_custom_linkedin'] . '" alt="LinkedIn" />';
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get pinterest button
function ssba_pinterest($arrSettings, $urlCurrentPage, $strPageTitle) {

	// pinterest share link
	$htmlShareButtons .= "<a id='ssba_pinterest_share' href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());'>";
	
	// if image set is not custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show ssba image
		$htmlShareButtons .= '<img title="Pinterest" alt="Pinterest" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/pinterest.png" />';
	}
	
	// if using custom images
	else {
	
		// show custom image
		$htmlShareButtons .= '<img title="Pinterest" src="' . $arrSettings['ssba_custom_pinterest'] . '" alt="Pinterest" />';
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get stumbleupon button
function ssba_stumbleupon($arrSettings, $urlCurrentPage, $strPageTitle) {

	// stumbleupon share link
	$htmlShareButtons .= '<a id="ssba_stumbleupon_share" class="ssba_share_link" href="http://www.stumbleupon.com/submit?url=' . $urlCurrentPage  . '&title=' . $strPageTitle . '" ' . ($arrSettings['ssba_share_new_window'] == 'Y' ? 'target="_blank"' : NULL) . '>';
	
	// if image set is not custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show ssba image
		$htmlShareButtons .= '<img title="StumbleUpon" alt="StumbleUpon" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/stumbleupon.png" />';
	}
	
	// if using custom images
	else {
	
		// show custom image
		$htmlShareButtons .= '<img title="StumbleUpon" src="' . $arrSettings['ssba_custom_stumbleupon'] . '" alt="StumbleUpon" />';
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

// get email button
function ssba_email($arrSettings, $urlCurrentPage, $strPageTitle) {

	// email share link
	$htmlShareButtons .= '<a id="ssba_email_share" href="mailto:?Subject=' . $strPageTitle . '&Body=' . $arrSettings['ssba_email_message'] . ' ' . $urlCurrentPage  . '">';
	
	// if image set is not custom
	if ($arrSettings['ssba_image_set'] != 'custom') {
	
		// show ssba image
		$htmlShareButtons .= '<img title="Email" alt="Email" src="' . WP_PLUGIN_URL . '/simple-share-buttons-adder/buttons/' . $arrSettings['ssba_image_set'] . '/email.png" />';
	}
	
	// if using custom images
	else {
	
		// show custom image
		$htmlShareButtons .= '<img title="Email" src="' . $arrSettings['ssba_custom_email'] . '" alt="Email" />';
	}
	
	// close href
	$htmlShareButtons .= '</a>';
	
	// return share buttons
	return $htmlShareButtons;
}

?>