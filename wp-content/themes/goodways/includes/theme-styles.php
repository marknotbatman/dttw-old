<?php
function ts_styles() {
	if (!is_admin()) {
		
		wp_register_style('googleFonts', 'http://fonts.googleapis.com/css?family=Oswald:400, 300, 700');
		wp_enqueue_style( 'googleFonts');
		
		wp_register_style('skeleton-css', get_template_directory_uri().'/skeleton.css', '', '', 'screen, all');
		wp_enqueue_style('skeleton-css');
		
		wp_register_style('general-css', get_bloginfo( 'stylesheet_url' ), '', '', 'all');
		wp_enqueue_style('general-css');
		
		wp_register_style('prettyPhoto-css', get_template_directory_uri().'/prettyPhoto.css', '', '', 'screen, all');
		wp_enqueue_style('prettyPhoto-css');
		
		wp_register_style('flexslider-css', get_template_directory_uri().'/flexslider.css', '', '', 'screen, all');
		wp_enqueue_style('flexslider-css');
		
		wp_register_style('color-css', get_template_directory_uri().'/color.css', '', '', 'screen, all');
		wp_enqueue_style('color-css');
		
		wp_register_style('noscript-css', get_template_directory_uri().'/noscript.css', '', '', 'screen, all');
		wp_enqueue_style('noscript-css');
		
		
	}
}
add_action('init', 'ts_styles');
?>