<?php
/*
Plugin Name: SMI Optimized
Plugin URI: https://github.com/cumanzorx07/smi-optimized
Version: 1.0
Description: This plugins provides a list of social media icon to link your provide with your site.
Author: Carlos Umanzor
Author URI: http://carlosumanzor.com/
Original Idea: Dan Nisbet (https://nisbetcreative.com/)
*/

class SMI_Optimized extends WP_Widget {

	function __construct() {
		parent::__construct(
			'smi_optimized-widget', // Base ID
			'Social Icons Optimized', // Widget Name
			array(
				'classname' => 'SMI_Optimized',
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
		wp_enqueue_style('smi_optimized-widget-admin', plugins_url('smi-optimized/css/social_icons_admin.css'));
	}

	function register_widget_styles() {
		wp_enqueue_style('smi_optimized-widget-widget', plugins_url('smi-optimized/css/SMI_Optimized.css'));
	}

}

add_action('widgets_init', create_function('', 'register_widget("SMI_Optimized");') );

?>