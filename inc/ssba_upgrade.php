<?php

function ssba_upgrade($arrSettings) {

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

?>