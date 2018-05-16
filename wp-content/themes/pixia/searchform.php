<?php
	global $pixia_frontend_options; 
	$pixia_frontend_options=get_option('pixia_theme_options');
?>
<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
	<div class="sform_wrapper">
	  	<input type="text" value="" name="s" id="pixia_search" class="search-query pirenko_highlighted boxed_shadow" placeholder="<?php _e($pixia_frontend_options['search_tip_text'], 'pixia'); ?>" />
	  	<input type="submit" class="search_icon" id="" value="" />
	    <div class="small_icon_wrapper">
	    	<i class="clearer_inactive_color pixia_fa-search"></i>
	 	</div>
    </div>
</form>