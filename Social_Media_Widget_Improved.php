<?php
/*
Plugin Name: Social Media Widget Improved
Plugin URI: https://github.com/cumanzorx07/Social-Media-Widget-Improved
Version: 1.0
Description: This plugins provides a list of social media icon to link your provide with your site.
Author: Carlos Umanzor
Author URI: http://carlosumanzor.com/
Original Idea: Dan Nisbet (https://nisbetcreative.com/)
*/

class Social_Media_Widget_Improved extends WP_Widget {

	function __construct() {
		parent::__construct(
			'social_media_widget_improved', // Base ID
			'Social Icons Optimized', // Widget Name
			array(
				'classname' => 'Social_Media_Widget_Improved',
				'description' => 'Displays a list of social media website icons and a link to your profile.',
			),
			array(
				'width' => 600,
			)
		);

		// Register Stylesheets
		add_action('admin_print_styles', array($this, 'register_admin_styles'));
		add_action('wp_enqueue_scripts', array($this, 'register_widget_styles'));

		include('lib/social-networks.php');
	}

	function form($instance) {
		include('lib/form.php');
	}

	function update($new_instance, $old_instance) {
		global $smi_social_accounts;
		$instance = array();

		foreach ($smi_social_accounts as $site => $id) {
			$instance[$id] = $new_instance[$id];
		}

		$instance['title'] = $new_instance['title'];
		$instance['icons'] = $new_instance['icons'];
		$instance['labels'] = $new_instance['labels'];
		$instance['show_title'] = $new_instance['show_title'];

		return $instance;
	}

	function widget($args, $instance) {
		include('lib/widget.php');
	}

	function register_admin_styles() {
		wp_enqueue_style('social_media_widget_improved-admin', plugins_url('smi-optimized/css/social_media_admin.css'));
	}

	function register_widget_styles() {
		wp_enqueue_style('social_media_widget_improved-widget', plugins_url('smi-optimized/css/social_media_widget.css'));
	}

}

add_action('widgets_init', create_function('', 'register_widget("Social_Media_Widget_Improved");') );

?>