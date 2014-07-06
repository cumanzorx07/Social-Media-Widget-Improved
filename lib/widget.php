<?php
global $social_accounts;
extract($args);

$title = empty($instance['title']) ? 'Follow Us' : apply_filters('widget_title', $instance['title']);
$icons = $instance['icons'];
$labels = $instance['labels'];
$show_title = $instance['show_title'];

echo $before_widget;

if($show_title == '') {
	echo $before_title;
	echo $title;
	echo $after_title;
}

if($labels == 'show') { $ul_class = 'show-labels '; }
else { $ul_class = ''; }
$ul_class .= 'icons-'.$icons;
?>

<?php echo apply_filters('social_icon_opening_tag', '<ul class="'.$ul_class.'">'); ?>

<?php foreach($social_accounts as $title => $id) : ?>
	<?php if($instance[$id] != '' && $instance[$id] != 'http://') :
		
		global $data;
		global $icon_output;

		$data['id'] = $id;
		$data['url'] = $instance[$id];
		$custom_sizes = array('custom_small','custom_medium','custom_large');
		
		if (in_array($icons, $custom_sizes)) {
			$size = str_replace("custom_","",$icons);
			$icon_path = STYLESHEETPATH .'/social_icons/'.$size.'/'.$id.'.{gif,jpg,jpeg,png}';
		}
		else {
			$siw_abs_path = str_replace('lib/', '', plugin_dir_path( __FILE__ ));
			$icon_path =  $siw_abs_path . 'icons/'.$icons.'/'.$id.'.{gif,jpg,jpeg,png}';

			if($icons == 'large') { $imgsize = 'height="64" width="64"'; }
			elseif($icons == 'medium') { $imgsize = 'height="32" width="32"'; }
			elseif($icons == 'small') { $imgsize = 'height="16" width="16"'; }
		}
		
		$result = glob( $icon_path, GLOB_BRACE );

		if($result) {
			if (in_array($icons, $custom_sizes)) {
				$path = explode('themes', $result[0]);
				$icon = get_bloginfo('url').'/wp-content/themes'.$path[1];
			}
			else {
				$path = explode('plugins', $result[0]);
				$icon = plugins_url().''.$path[1];
			}
		}
		elseif( $labels != 'show' && $icons != 'small' ) {
			$icon = plugins_url().'/social-media-icons-widget/icons/'.$icons.'/_unknown.jpg';
		}
		else {
			$icon = '';
		}

		if ( $icon ) { $data['image'] = '<img class="site-icon" src="'.$icon.'" alt="'.$title.'" title="'.$title.'" '.$imgsize.' />'; }
		else { $data['image'] = ''; }
		
		if($labels != 'show') { $data['title'] = ''; }
		else { $data['title'] = '<span class="site-label">'.$title.'</span>'; }
	
		$format = '<li class="%1$s"><a href="%2$s" target="_blank">%3$s%4$s</a></li>';
		$icon_output = apply_filters('social_icon_output', $format);
		echo vsprintf($icon_output, $data);

	?>
		
	<?php endif; ?>
<?php endforeach; ?>

<?php echo apply_filters('social_icon_closing_tag', '</ul>'); ?>

<?php 
echo $after_widget;
?>