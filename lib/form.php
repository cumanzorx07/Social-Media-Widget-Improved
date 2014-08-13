<?php 
global $siw_social_accounts;

$siw_data = array();

foreach ($siw_social_accounts as $site => $id) {
	if($instance[$id] == '') { $siw_data[$id] = 'http://'; }
	else { $siw_data[$id] = $instance[$id]; }
}

$siw_data['title'] = $instance['title'];
$siw_data['icons'] = $instance['icons'];
$siw_data['labels'] = $instance['labels'];
$siw_data['show_title'] = $instance['show_title'];

?>

<div class="social_icons_widget">

<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($siw_data['title']); ?>" /></p>

<?php
$siw_sizes = array(
	'None' => 'none',
	'Small (16px)' => 'small',
	'Medium (32px)' => 'medium',
	'Large (64px)' => 'large',
	'Custom (Small)' => 'custom_small',
	'Custom (Medium)' => 'custom_medium',
	'Custom (Large)' => 'custom_large'
);
?>

<p class="icon_options"><label for="<?php echo $this->get_field_id('icons'); ?>">Icon Type:</label>
	<select id="<?php echo $this->get_field_id('icons'); ?>" name="<?php echo $this->get_field_name('icons'); ?>">
	<?php
	foreach($siw_sizes as $option => $value) :

		if(esc_attr($siw_data['icons'] == $value)) { $selected = ' selected="selected"'; }
		else { $selected = ''; }
	?>
	
		<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $option; ?></option>
	
	<?php endforeach; ?>
	</select>
</p>

<?php if(esc_attr($siw_data['labels'] == 'show')) { $checked = ' checked="checked"'; } else { $checked = ''; } ?>
<p class="label_options"><input type="checkbox" id="<?php echo $this->get_field_id('labels'); ?>" name="<?php echo $this->get_field_name('labels'); ?>" value="show"<?php echo $checked; ?> /> <label for="<?php echo $this->get_field_id('labels'); ?>">Show Labels</label></p>

<?php if(esc_attr($siw_data['show_title'] == 'show')) { $checked = ' checked="checked"'; } else { $checked = ''; } ?>
<p class="label_options"><input type="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="show"<?php echo $checked; ?> /> <label for="<?php echo $this->get_field_id('show_title'); ?>">Hide Title</label></p>

<ul class="social_accounts">
	<?php foreach ($siw_social_accounts as $site => $id) : ?>
		<li><label for="<?php echo $this->get_field_id($id); ?>" class="<?php echo $id; ?>"><?php echo $site; ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id($id); ?>" name="<?php echo $this->get_field_name($id); ?>" value="<?php echo esc_attr($siw_data[$id]); ?>" /></li>
	<?php endforeach; ?>
</ul>

</div>