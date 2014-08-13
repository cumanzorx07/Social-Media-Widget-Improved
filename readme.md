Social Icons Widget for WordPress
=================================

The Social Media Icons widget takes a simple, extendable approach to displaying links to your social media profiles in WordPress. The purpose of this plugin was to strip away the complexities I found most other plugins to have and simply display a set of basic social icons in an unordered list. There's no frills and no fanciness, making it easy to style to your website's look.


Installation
------------

Download the zip file and upload to your WordPress installation. Upon activation, widget is available under Appearance > Widgets. Drag the widget into your sidebar, adjust the settings, and populate the profiles you wish to show on your website.


Custom Icons
------------

Custom icons are easy to add. To enable them, select "Custom" from the Icon Type dropdown in the widget settings. In the directory of your active theme, create a folder titled 'social_icons'. Within that directory, add folders titled 'small', 'medium', and 'large' for each icon size you wish to use. Add your icons in .gif, .jpg, .jpeg, or .png format, following the naming format used for the default set of icons.

Extending
---------

Developers can easily add more social media websites by creating a filter in the active theme's functions.php file like such:

	function add_new_icons($icon_list) {
		$icon_list['Full Website Name'] = 'full-website-id';
 
		return $icon_list;
	}
	add_filter('social_icon_accounts', 'add_new_icons');

The full-website-id should reflect the name of the image you create in each of the icon folder sizes, or in your custom icon directory. It is also used to populate the class field of the icon when the widget displays. The Social Icon Widget looks for .gif, .jpg, .jpeg, and .png in order and returns the first extention it finds.

Altering Widget Output
----------------------

Output of each icon can be adjusted with the social_icon_output filter:

	function social_icons_html_output($format) {
		$format = '<li class="%1$s"><a href="%2$s" target="_blank">%3$s%4$s</a></li>';
		return $format;
	}
	add_filter('social_icon_output', 'social_icons_html_output');

The opening and closing unordered list tags can be edited or changed with the social_icon_opening_tag and social_icon_closing_tag filters:

	function social_icon_opening_tag($opening) {
		$opening = '<ul class="'.$ul_class.'">';
		return $opening;
	}
	add_filter('social_icon_output', 'social_icons_html_output');

	function social_icons_html_output($closing) {
		$closing = '</ul>';
		return $closing;
	}
	add_filter('social_icon_output', 'social_icons_html_output');

About
-----

Default icons are from the [Simple Icons](http://simpleicons.org/) set created by Dan Leech.
Envelope designed by [Cy Me](http://www.thenounproject.com/Litrynn) from the [Noun Project](http://www.thenounproject.com)
	
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html