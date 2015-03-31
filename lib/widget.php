<?php
global $smwi_social_accounts;
extract($args);

$smwi_title = empty($instance['title']) ? 'Follow Us' : apply_filters('widget_title', $instance['title']);
$smwi_icons = $instance['icons'];
$smwi_labels = $instance['labels'];
$smwi_show_title = $instance['show_title'];

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
		global $smwi_data;
		global $smwi_icon_output;
		$smwi_data['id'] = $id;
		$smwi_data['url'] = $instance[$id];
		
		//in case of using NONE as the icon set, we will force labels
		$format = "";
		$dataToFormat = array();
		if($smwi_icons != "none")
		{			
			$dataToFormat['classCSS'] = $smwi_icons."_".$id;
			$dataToFormat['url'] = $instance[$id];	
			$dataToFormat['label'] = ($smwi_labels == 'show') ? '<span class="site-label">'.$smwi_title.'</span>' : '';			
			$format = '<li class="%1$s"><a href="%2$s" target="_blank"><span class="site-icon"></span>%3$s</a></li>';			
		}
		else
		{
			$dataToFormat['classCSS'] = "labelonly";
			$dataToFormat['url'] = $instance[$id];	
			$dataToFormat['label'] = '<span class="site-label">'.$smwi_title.'</span>';
			$format = '<li class="%1$s"><a href="%2$s" target="_blank">%3$s</a></li>';
		}		
		$smwi_icon_output = apply_filters('social_icon_output', $format);
		echo vsprintf($smwi_icon_output, $dataToFormat);

	endif; 
endforeach; 

echo apply_filters('social_icon_closing_tag', '</ul></div>'); 
echo $after_widget;
?>