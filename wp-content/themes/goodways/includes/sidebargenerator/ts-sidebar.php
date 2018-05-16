<?php
if( ! function_exists("ts_sidebar_admin")){
	function ts_sidebar_admin(){
		$submenu_slug = 'ts-themesidebar';
		$shortname = TS_SHORTNAME;
		
		$optionstheme = array();
		
		$optionstheme['sidebar'] = array (
			
			array ( "name" => __("Sidebar Manager","templatesquare"), 
					"type" => "open"),
			
			array(	"name" => __('Sidebar', 'templatesquare'),
										"type" => "heading",
										"desc" => __('', 'templatesquare')),
			
			array( 	"name" => __('Sidebar Generator', 'templatesquare'),
										"desc" => __('Please enter name of new sidebar', 'templatesquare'),
										"id" => $shortname."_sidebar",
										"std" => "fade",
										"type" => "textarray"),
			
			array(	"type" 	=> "close"),
		);
	
		ts_form_admin($optionstheme['sidebar'], $submenu_slug);
	}
}

if ( ! function_exists( 'ts_sidebargen_menu' ) ) {
	function ts_sidebargen_menu(){
		
		$submenu_slug = "ts-themesidebar";
		$submenu_function = "ts_sidebar_admin";
		add_theme_page( __('Sidebar Manager','templatesquare'), __('Sidebar Manager','templatesquare'), 'edit_themes', $submenu_slug, $submenu_function);
		
	}
	add_action('admin_menu', 'ts_sidebargen_menu');
}