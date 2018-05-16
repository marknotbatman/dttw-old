<?php
function ts_script() {
	if (!is_admin()) {
		
		wp_enqueue_script('jquery');
		
		wp_register_script('jprettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array('jquery'), '3.0', true);
		wp_enqueue_script('jprettyPhoto');
		
		wp_register_script('jhoverIntent', get_template_directory_uri().'/js/hoverIntent.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jhoverIntent');
		
		wp_register_script('jsuperfish', get_template_directory_uri().'/js/superfish.js', array('jquery'), '1.4.8', true);
		wp_enqueue_script('jsuperfish');
		
		wp_register_script('jsupersubs', get_template_directory_uri().'/js/supersubs.js', array('jquery'), '0.2', true);
		wp_enqueue_script('jsupersubs');
		
		wp_register_script('jflexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), '1.8', true);
		wp_enqueue_script('jflexslider');
		
		wp_register_script('jeasing', get_template_directory_uri().'/js/jquery.easing.1.3.js', array('jquery'), '1.3', true);
		wp_enqueue_script('jeasing');
	
		wp_register_script('jquicksand', get_template_directory_uri().'/js/quicksand.js', array('jquery'), '1.2.2', true);
		wp_enqueue_script('jquicksand');
		
		wp_register_script('jquicksandconfig', get_template_directory_uri().'/js/quicksand_config.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jquicksandconfig');
		
		wp_register_script('jcustom', get_template_directory_uri().'/js/custom.js', array('jquery'), '1.0', true);
		wp_enqueue_script('jcustom');
		
	}
}
add_action('init', 'ts_script');
?>