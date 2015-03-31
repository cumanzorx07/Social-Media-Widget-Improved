<?php
global $smi_social_accounts;
extract($args);

$smi_title = empty($instance['title']) ? 'Follow Us' : apply_filters('widget_title', $instance['title']);
$smi_icons = $instance['icons'];
$smi_labels = $instance['labels'];
$smi_show_title = $instance['show_title'];

echo $before_widget;

if($smi_show_title == '') {
	echo $before_title;
	echo $smi_title;
	echo $after_title;
}

$ul_class = ($smi_labels == 'show') ? 'show-labels ' : '' ;
$ul_class .= 'icons-'.$smi_icons;
echo apply_filters('social_icon_opening_tag', '<ul class="'.$ul_class.'">');
 
foreach($smi_social_accounts as $smi_title => $id) :
	if($instance[$id] != '' && $instance[$id] != 'http://') :		
		global $smi_data;
		global $smi_icon_output;
		$smi_data['id'] = $id;
		$smi_data['url'] = $instance[$id];
		
		//in case of using NONE as the icon set, we will force labels
		if($smi_icons != "none")
		{
			$smi_custom_sizes = array('custom_small','custom_medium','custom_large');
		
			if (in_array($smi_icons, $smi_custom_sizes)) {
				$size = str_replace("custom_","",$smi_icons);
				$smi_icon_path = STYLESHEETPATH .'/social_icons/'.$size.'/'.$id.'.{gif,jpg,jpeg,png}';
			}
			else {
				$smi_abs_path = str_replace('lib/', '', plugin_dir_path( __FILE__ ));
	
				/*	Fix for Windows/XAMPP where the slash goes the wrong way.
					Thanks to VictoriousK */
				$smi_abs_path = str_replace('\\', '/', $smi_abs_path);
				
				$smi_icon_path =  $smi_abs_path . 'icons/'.$smi_icons.'/'.$id.'.{gif,jpg,jpeg,png}';
				
				switch($smi_icons)
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
			
			$result = glob( $smi_icon_path, GLOB_BRACE );
	
			if($result) {
				if (in_array($smi_icons, $smi_custom_sizes)) {
					$smi_path = explode('themes', $result[0]);
					$smi_icon = get_bloginfo('url').'/wp-content/themes'.$smi_path[1];
				}
				else {
					$smi_path = explode('plugins', $result[0]);
					$smi_icon = plugins_url().''.$smi_path[1];
				}
			}
			elseif( $smi_labels != 'show' && $smi_icons != 'small' ) {
				$smi_icon = plugins_url().'/social-media-icons-widget/icons/'.$smi_icons.'/_unknown.jpg';
			}
			else {
				$smi_icon = '';
			}
			if ( $smi_icon ) { $smi_data['image'] = '<img class="site-icon" src="'.$smi_icon.'" alt="'.$smi_title.'" title="'.$smi_title.'" '.$imgsize.' />'; }
			else { $smi_data['image'] = ''; }
		}
		else
		{
				$smi_data['image'] = $smi_title;				
		}		
		
		if($smi_labels != 'show') { $smi_data['title'] = ''; }
		else { $smi_data['title'] = '<span class="site-label">'.$smi_title.'</span>'; }
	
		$format = '<li class="%1$s"><a href="%2$s" target="_blank">%3$s%4$s</a></li>';
		$smi_icon_output = apply_filters('social_icon_output', $format);
		echo vsprintf($smi_icon_output, $smi_data);

	endif; 
endforeach; 

echo apply_filters('social_icon_closing_tag', '</ul>'); 
echo $after_widget;
?>