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
echo apply_filters('social_icon_opening_tag', '<ul class="'.$ul_class.'">');
 
foreach($smwi_social_accounts as $smwi_title => $id) :
	if($instance[$id] != '' && $instance[$id] != 'http://') :		
		global $smwi_data;
		global $smwi_icon_output;
		$smwi_data['id'] = $id;
		$smwi_data['url'] = $instance[$id];
		
		//in case of using NONE as the icon set, we will force labels
		if($smwi_icons != "none")
		{
			$smwi_custom_sizes = array('custom_small','custom_medium','custom_large');
		
			if (in_array($smwi_icons, $smwi_custom_sizes)) {
				$size = str_replace("custom_","",$smwi_icons);
				$smwi_icon_path = STYLESHEETPATH .'/social_icons/'.$size.'/'.$id.'.{gif,jpg,jpeg,png}';
			}
			else {
				$smwi_abs_path = str_replace('lib/', '', plugin_dir_path( __FILE__ ));
	
				/*	Fix for Windows/XAMPP where the slash goes the wrong way.
					Thanks to VictoriousK */
				$smwi_abs_path = str_replace('\\', '/', $smwi_abs_path);
				
				$smwi_icon_path =  $smwi_abs_path . 'icons/'.$smwi_icons.'/'.$id.'.{gif,jpg,jpeg,png}';
				
				switch($smwi_icons)
				{
					case 'large':
						$imgsize = 'height="64" width="64"';
						break;
					case 'medium':
						$imgsize = 'height="32" width="32"';
						break;
					case 'small':
						$imgsize = 'height="16" width="16"';
						break;
				}
			}
			
			$result = glob( $smwi_icon_path, GLOB_BRACE );
	
			if($result) {
				if (in_array($smwi_icons, $smwi_custom_sizes)) {
					$smwi_path = explode('themes', $result[0]);
					$smwi_icon = get_bloginfo('url').'/wp-content/themes'.$smwi_path[1];
				}
				else {
					$smwi_path = explode('plugins', $result[0]);
					$smwi_icon = plugins_url().''.$smwi_path[1];
				}
			}
			elseif( $smwi_labels != 'show' && $smwi_icons != 'small' ) {
				$smwi_icon = plugins_url().'/social-media-icons-widget/icons/'.$smwi_icons.'/_unknown.jpg';
			}
			else {
				$smwi_icon = '';
			}
			if ( $smwi_icon ) { $smwi_data['image'] = '<img class="site-icon" src="'.$smwi_icon.'" alt="'.$smwi_title.'" title="'.$smwi_title.'" '.$imgsize.' />'; }
			else { $smwi_data['image'] = ''; }
		}
		else
		{
				$smwi_data['image'] = $smwi_title;				
		}		
		
		if($smwi_labels != 'show') { $smwi_data['title'] = ''; }
		else { $smwi_data['title'] = '<span class="site-label">'.$smwi_title.'</span>'; }
	
		$format = '<li class="%1$s"><a href="%2$s" target="_blank">%3$s%4$s</a></li>';
		$smwi_icon_output = apply_filters('social_icon_output', $format);
		echo vsprintf($smwi_icon_output, $smwi_data);

	endif; 
endforeach; 

echo apply_filters('social_icon_closing_tag', '</ul>'); 
echo $after_widget;
?>