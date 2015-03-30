<?php 
global $smi_social_accounts;

$smi_data = array();

foreach ($smi_social_accounts as $site => $id) {
	$smi_data[$id] = (empty($instance[$id])) ? $smi_data[$id] = 'http://' : $smi_data[$id] = $instance[$id]; 
}

$smi_data['title'] = $instance['title'];
$smi_data['icons'] = $instance['icons'];
$smi_data['labels'] = $instance['labels'];
$smi_data['show_title'] = $instance['show_title'];

?>

<div class="SMI_Optimized">

<p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($smi_data['title']); ?>" /></p>

<?php
$smi_sizes = array(
	'None' => 'none',
	'Small (16px)' => 'small',
	'Medium (32px)' => 'medium',
	'Large (64px)' => 'large'
);
?>

<p class="icon_options"><label for="<?php echo $this->get_field_id('icons'); ?>">Icon Type:</label>
	<select id="<?php echo $this->get_field_id('icons'); ?>" name="<?php echo $this->get_field_name('icons'); ?>">
	<?php
	foreach($smi_sizes as $option => $value) :

		if(esc_attr($smi_data['icons'] == $value)) { $selected = ' selected="selected"'; }
		else { $selected = ''; }
	?>
	
		<option value="<?php echo $value; ?>"<?php echo $selected; ?>><?php echo $option; ?></option>
	
	<?php endforeach; ?>
	</select>
</p>

<?php if(esc_attr($smi_data['labels'] == 'show')) { $checked = ' checked="checked"'; } else { $checked = ''; } ?>
<p class="label_options"><input type="checkbox" id="<?php echo $this->get_field_id('labels'); ?>" name="<?php echo $this->get_field_name('labels'); ?>" value="show"<?php echo $checked; ?> /> <label for="<?php echo $this->get_field_id('labels'); ?>">Show Labels</label></p>

<?php if(esc_attr($smi_data['show_title'] == 'show')) { $checked = ' checked="checked"'; } else { $checked = ''; } ?>
<p class="label_options"><input type="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="show"<?php echo $checked; ?> /> <label for="<?php echo $this->get_field_id('show_title'); ?>">Hide Title</label></p>

<ul class="social_accounts">
	<?php foreach ($smi_social_accounts as $site => $id) : ?>
		<li><span class="<?php echo $id; ?>"></span><label for="<?php echo $this->get_field_id($id); ?>"><?php echo $site; ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id($id); ?>" name="<?php echo $this->get_field_name($id); ?>" value="<?php echo esc_attr($smi_data[$id]); ?>" /></li>
	<?php endforeach; ?>
</ul>

</div>