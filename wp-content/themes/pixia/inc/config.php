<?php
// returns WordPress subdirectory if applicable
	function wp_base_dir() {
	  preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
	  if (count($matches) === 3) {
		return end($matches);
	  } else {
		return '';
	  }
	}
	
	// opposite of built in WP functions for trailing slashes
	function leadingslashit($string) {
	  return '/' . unleadingslashit($string);
	}
	
	function unleadingslashit($string) {
	  return ltrim($string, '/');
	}
	
	function add_filters($tags, $function) {
	  foreach($tags as $tag) {
		add_filter($tag, $function);
	  }
	}
add_theme_support('bootstrap-responsive');
add_theme_support('bootstrap-top-navbar');

// Set the content width based on the theme's design and stylesheet
if (!isset($content_width)) { $content_width = 940; }

define('POST_EXCERPT_LENGTH',       40);
define('WRAP_CLASSES',              'container');
define('CONTAINER_CLASSES',         'row');
define('MAIN_CLASSES',              'eight columns');
define('SIDEBAR_CLASSES',           'four columns');
define('FULLWIDTH_CLASSES',         'twelve columns');
define('PIXIA_THEME_ID','3176317');

$remote_version_url=ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php';
define('INJECT_STYLE',				@fopen($remote_version_url, "r"));

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('woocommerce/woocommerce.php') || is_plugin_active('woocommerce-beta/woocommerce.php')) {
	define('PRK_WOO',"true");
}
else
{
	define('PRK_WOO',"false");
}