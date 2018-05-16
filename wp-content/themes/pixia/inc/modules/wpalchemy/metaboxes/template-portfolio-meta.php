<div class="my_meta_control">
	<p>
    	<strong>Thumbnails open lightbox?</strong>
		<?php 
			/*
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
			$metabox->the_field('pixia_lbox');*/
			$mb->the_field('pixia_lbox');
			$selected = ' selected="selected"';
		?>
			<select name="<?php $metabox->the_name(); ?>">
			<option value=""<?php if ($metabox->get_the_value() == '') echo $selected; ?>>No</option>
			<option value="yes"<?php if ($metabox->get_the_value() == 'yes') echo $selected; ?>>Yes, open all projects on the same lightbox</option>
			<option value="multiple"<?php if ($metabox->get_the_value() == 'multiple') echo $selected; ?>>Yes, open single project per lightbox</option>
			</select>
		<br /><br />
		
        <strong>Number of posts to load on each event:</strong>
        <?php $mb->the_field('alchemy_posts_nr'); ?>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="2" style="width:40px"/>
        <br /><br />
        <strong>Thumbnails margin (in pixels):</strong>
        <?php $mb->the_field('pixia_th_margin'); ?>
        <input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" size="2" style="width:40px"/>
        <br /><br />
        <strong>Make thumbnails black and white (requires Timthumb script)?</strong>
		<?php 
			$mb->the_field('pixia_bw');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br/>
    	<br /><br />
    	<strong>Associate only some categories to this page?</strong>
		<?php 
			$mb->the_field('pixia_filter');
			if(!($mb->get_the_value()))
			{
				$mb->the_checkbox_state = 'checked';
			}
			//print_r ($mb);
		?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="yes"<?php $mb->the_checkbox_state('yes'); ?>/><br />
        <em>The eventually selected categories below will only apply if the 'Associate only some categories to this page' option is selected.</em>
        <?php
        	$terms=get_terms('pirenko_skills');
			$count = count($terms);
			if ($count>0)
			{   
				echo "<br /><br /><strong>Categories to be displayed on this page:</strong><br /><table style='margin-left:-4px;'>";
            	foreach ( $terms as $term ) { 
					$mb->the_field($term->slug);
					echo "<tr><td>";
					echo $term->name;
					echo "</td>";echo "<td>";
					?>
                    <input type="checkbox" name="<?php $mb->the_name(); ?>" value="<?php echo $term->slug; ?>"<?php echo $mb->is_value($term->slug)?' checked="checked"':''; ?>/>
                    </td></tr>
                    <?php
              	}
				echo "</table>";
			}
		?>
	</p>
</div>

