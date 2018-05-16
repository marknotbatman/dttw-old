<div class="my_meta_control prk_member">
	<p>
    	<strong>&nbsp;Job:</strong> (Optional)
		<?php $mb->the_field('member_job'); ?><br />
		<input type="text" id="pixia_member_job" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="5"/>
	</p>
    <?php
		$social_options=array(
		'0' => array(
			'value' =>	'none',
			'label' => 'None'
		),
		'1' => array(
			'value' =>	'delicious',
			'label' => 'Delicious'
		),
		'2' => array(
			'value' =>	'dribbble',
			'label' => 	'Dribbble'
		),
		'3' => array(
			'value' =>	'deviantart',
			'label' => 	'Deviantart'
		),
		'4' => array(
			'value' =>	'facebook',
			'label' => 	'Facebook'
		),
		'5' => array(
			'value' =>	'flickr',
			'label' => 	'Flickr'
		),
		'6' => array(
			'value' =>	'gplus',
			'label' => 	'Google Plus'
		),
		'7' => array(
			'value' =>	'instagram',
			'label' => 	'Instagram'
		),
		'8' => array(
			'value' =>	'linkedin',
			'label' => 	'Linkedin'
		),
		'9' => array(
			'value' =>	'pinterest',
			'label' => 	'Pinterest'
		),
		'10' => array(
			'value' =>	'skype',
			'label' => 	'Skype'
		),
		'11' => array(
			'value' =>	'twitter',
			'label' => 	'Twitter'
		),
		'12' => array(
			'value' =>	'vimeo',
			'label' => 	'Vimeo'
		),
		'13' => array(
			'value' =>	'yahoo',
			'label' => 	'Yahoo'
		),
		'14' => array(
			'value' =>	'youtube',
			'label' => 	'Youtube'
		),
		'15' => array(
			'value' =>	'rss',
			'label' => 	'RSS'
		),
		'16' => array(
			'value' =>	'book',
			'label' => 	'vCard'
		)
	);
	?>
	<p>
	<span class="prk_alt_opt">Social networks 1</span>
	<?php 
		$mb->the_field('member_social_1'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span>
	<?php 
		$mb->the_field('member_social_1_link'); 
	?>
    <input type="text" id="member_social_1_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
    <p>
    <span class="prk_alt_opt">Social networks 2</span>
	<?php 
		$mb->the_field('member_social_2'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span>
	<?php 
		$mb->the_field('member_social_2_link'); 
	?>
    <input type="text" id="member_social_2_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
   </p>
   <p>
    <span class="prk_alt_opt">Social networks 3</span>
	<?php 
		$mb->the_field('member_social_3'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span>
	<?php 
		$mb->the_field('member_social_3_link'); 
	?>
    <input type="text" id="member_social_3_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
    <p>
    <span class="prk_alt_opt">Social networks 4</span>
	<?php 
		$mb->the_field('member_social_4'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span>
	<?php 
		$mb->the_field('member_social_4_link'); 
	?>
    <input type="text" id="member_social_4_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
    <p>
    <span class="prk_alt_opt">Social networks 5</span>
	<?php 
		$mb->the_field('member_social_5'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span>
	<?php 
		$mb->the_field('member_social_5_link'); 
	?>
    <input type="text" id="member_social_5_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
    <p>
    <span class="prk_alt_opt">Social networks 6</span>
	<?php 
		$mb->the_field('member_social_6'); 
	?>
	<select name="<?php $metabox->the_name(); ?>">
    	<?php
			foreach ( $social_options as $option )
			{
			  if ($metabox->get_the_value()==$option['value'])
			      echo "\n\t<option selected='selected' value='" . $option['value']  . "'>" . $option['label'] ."</option>";
			  else
			      echo "\n\t<option value='" . $option['value'] . "'>" . $option['label'] ."</option>";
			}
		?>
	</select>
	<br /><span class="prk_alt_opt">Link</span>
	<?php 
		$mb->the_field('member_social_6_link'); 
	?>
    <input type="text" id="member_social_6_link" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
    </p>
</div>