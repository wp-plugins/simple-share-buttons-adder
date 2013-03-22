<?php

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
?>