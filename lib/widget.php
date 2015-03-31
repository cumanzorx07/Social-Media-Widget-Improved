<?php
global $smwi_social_accounts;
extract($args);

$smwi_title = empty($instance['title']) ? 'Follow Us' : apply_filters('widget_title', $instance['title']);
$smwi_icons = empty($instance['icons']) ? '' : $instance['icons'];
$smwi_labels = empty($instance['labels']) ? '' : $instance['labels'];
$smwi_show_title = empty($instance['show_title']) ? '' : $instance['show_title'];
$smwi_add_rel_publisher = empty($instance['add_rel_publisher_to_google_plus']) ? '' : $instance['add_rel_publisher_to_google_plus'];

echo $before_widget;

if($smwi_show_title == '') {
	echo $before_title;
	echo $smwi_title;
	echo $after_title;
}

$ul_class = ($smwi_labels == 'show') ? 'show-labels ' : '' ;
$ul_class .= 'icons-'.$smwi_icons;
echo apply_filters('social_icon_opening_tag', '<div class="social-icons-widget"><ul class="'.$ul_class.'">');
 
foreach($smwi_social_accounts as $smwi_title => $id) :
	if(!empty($instance[$id]) != '' && $instance[$id] != 'http://') :	
		global $smwi_icon_output;
		
		//in case of using NONE as the icon set, we will force labels
		$format = "";
		$dataToFormat = array();
		if($smwi_icons != "none")
		{			
			$dataToFormat['classCSS'] = $smwi_icons."_".$id;
			$dataToFormat['url'] = $instance[$id];	
			$dataToFormat['internal'] = ($smwi_labels == 'show') ? '<span class="site-icon"></span><span class="site-label">'.$smwi_title.'</span>' : '<span class="site-icon"></span>';				
		}
		else
		{
			$dataToFormat['classCSS'] = "labelonly";
			$dataToFormat['url'] = $instance[$id];	
			$dataToFormat['internal'] = '<span class="site-label">'.$smwi_title.'</span>';
		}
		if($smwi_add_rel_publisher == "add" && $id == "googleplus")
		{
			$format = '<li class="%1$s"><a href="%2$s" target="_blank" rel="publisher">%3$s</a></li>';
		}
		else
		{
			$format = '<li class="%1$s"><a href="%2$s" target="_blank">%3$s</a></li>';
		}
		$smwi_icon_output = apply_filters('social_icon_output', $format);
		echo vsprintf($smwi_icon_output, $dataToFormat);

	endif; 
endforeach; 

echo apply_filters('social_icon_closing_tag', '</ul></div>'); 
echo $after_widget;
?>