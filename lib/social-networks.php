<?php
	global $smwi_social_accounts;
	$smwi_social_accounts = array(
		'500px' => 'fivehundredpx',
		'About.me' => 'aboutme',
		'Behance' => 'behance',
		'Codepen' => 'codepen',
		'Dribbble' => 'dribbble',
		'Email' => 'email',
		'Envato' => 'envato',
		'Facebook' => 'facebook',
		'Flickr' => 'flickr',
		'Foursquare' => 'foursquare',
		'GitHub' => 'github',
		'Google+' => 'googleplus',
		'Instagram' => 'instagram',
		'Kickstarter' => 'kickstarter',
		'Klout' => 'klout',
		'LinkedIn' => 'linkedin',
		'Medium' => 'medium',
		'Path' => 'path',
		'Pinterest' => 'pinterest',
		'RSS Feed' => 'rss',
		'SoundCloud' => 'soundcloud',
		'Speaker Deck' => 'speakerdeck',
		'StumbleUpon' => 'stumbleupon',
		'Technorati' => 'technorati',
		'Tumblr' => 'tumblr',
		'Twitter' => 'twitter',
		'Vimeo' => 'vimeo',
		'Vine' => 'vine',
		'WordPress' => 'wordpress',
		'Yelp' => 'yelp',
		'YouTube' => 'youtube',
		'Zerply' => 'zerply'
	);

	if( has_filter('social_icon_accounts') ) {
		$smwi_social_accounts = apply_filters('social_icon_accounts', $smwi_social_accounts);
	}
?>