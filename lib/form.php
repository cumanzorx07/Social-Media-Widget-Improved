<?php 
global $smwi_social_accounts;

$smwi_data = array();

foreach ($smwi_social_accounts as $site => $id) {
	$smwi_data[$id] = (empty($instance[$id])) ? $smwi_data[$id] = 'http://' : $smwi_data[$id] = $instance[$id]; 
}

$smwi_data['title'] = (empty($instance['title'])) ? "" : $instance['title'];
$smwi_data['icons'] = (empty($instance['icons'])) ? "" : $instance['icons'];
$smwi_data['labels'] = (empty($instance['labels'])) ? "" : $instance['labels'];
$smwi_data['show_title'] = (empty($instance['show_title'])) ? "" : $instance['show_title'];
$smwi_data['add_rel_publisher_to_google_plus'] = (empty($instance['add_rel_publisher_to_google_plus'])) ? "" : $instance['add_rel_publisher_to_google_plus'];

?>

<div class="social_media_widget_improved">

<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($smwi_data['title']); ?>" /></p>

<?php
$smwi_sizes = array(
	'None' => 'none',
	'Small (16px)' => 'small',
	'Medium (32px)' => 'medium',
	'Large (64px)' => 'large'
);
?>

<p class="icon_options"><label for="<?php echo $this->get_field_id('icons'); ?>">Icon Type:</label>
	<select id="<?php echo $this->get_field_id('icons'); ?>" name="<?php echo $this->get_field_name('icons'); ?>">
	<?php
	foreach($smwi_sizes as $option => $value) :

		if(esc_attr($smwi_data['icons'] == $value)) { $selected = ' selected="selected"'; }
		else { $selected = ''; }
	?>
	
		<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $option; ?></option>
	
	<?php endforeach; ?>
	</select>
</p>

<?php if(esc_attr($smwi_data['labels'] == 'show')) { $checked = ' checked="checked"'; } else { $checked = ''; } ?>
<p class="label_options"><input type="checkbox" id="<?php echo $this->get_field_id('labels'); ?>" name="<?php echo $this->get_field_name('labels'); ?>" value="show"<?php echo $checked; ?> /> <label for="<?php echo $this->get_field_id('labels'); ?>">Show Labels</label></p>

<?php if(esc_attr($smwi_data['show_title'] == 'show')) { $checked = ' checked="checked"'; } else { $checked = ''; } ?>
<p class="label_options"><input type="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="show"<?php echo $checked; ?> /> <label for="<?php echo $this->get_field_id('show_title'); ?>">Hide Title</label></p>

<?php if(esc_attr($smwi_data['add_rel_publisher_to_google_plus'] == 'add')) { $checked = ' checked="checked"'; } else { $checked = ''; } ?>

<p class="label_options"><input type="checkbox" id="<?php echo $this->get_field_id('add_rel_publisher_to_google_plus'); ?>" name="<?php echo $this->get_field_name('add_rel_publisher_to_google_plus'); ?>" value="add"<?php echo $checked; ?> /> <label for="<?php echo $this->get_field_id('add_rel_publisher_to_google_plus'); ?>">Add rel=publisher to Google Plus</label></p>



<ul class="social_accounts">
	<?php foreach ($smwi_social_accounts as $site => $id) : ?>
		<li><span class="<?php echo $id; ?>"></span><label for="<?php echo $this->get_field_id($id); ?>"><?php echo $site; ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id($id); ?>" name="<?php echo $this->get_field_name($id); ?>" value="<?php echo esc_attr($smwi_data[$id]); ?>" /></li>
	<?php endforeach; ?>
</ul>

</div>