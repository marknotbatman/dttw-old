<?php
/*
Plugin Name: TentBlogger Vimeo, YouTube, RSS Embed
Plugin URI: http://tentblogger.com/rss-video-embed/
Description: Adds a video embed shortcode that can be intelligently interpreted by your community's RSS Feed Readers with graceful fall-back link to post.
Version: 2.5
Author: TentBlogger
Author URI: http://tentblogger.com
Author Email: info@tentblogger.com
*/

/*------------------------------------------------*
 * Core Functions
 *------------------------------------------------*/ 

/**
 * Initializes the plugin's icon in TinyMCE and loads the associated
 * JavaScript.
 */ 
function tentblogger_vimeo_youtube_init() {

	if(is_admin()) {
		wp_register_script('tentblogger-vimeo-youtube-admin', WP_PLUGIN_URL . '/tentbloggers-vimeo-youtube-rss-embed/javascript/admin.js');
		wp_enqueue_script('tentblogger-vimeo-youtube-admin');
	} // end if
	
} // end tentblogger_vimeo_youtube_init
 
/**
 * Creates the actual anchor and image used to trigger the plugin's
 * functionality.
 * 
 */
function add_vimeo_youtube_icon($init_context) {

	$icon_src = WP_PLUGIN_URL . '/tentbloggers-vimeo-youtube-rss-embed/images/camera.jpg';
	
	$camera_image = '<a href="javascript:;" id="tentblogger-vimeo-youtube-button" title="' . __('Add Video', 'tentblogger-video') . '">';
		$camera_image .= '<img src="' . $icon_src . '" alt="' . __('Add Video!', 'tentblogger-video') . '" />';
	$camera_image .= '</a>';

	return $init_context . $camera_image;

} // end add_vimeo_youtube_icon
 
/**
 * Returns the formatted content after replacing the shortcodes
 * with the proper markup.
 */
function display_rss_feed_message($content) {

	if(youtube_contained_in($content)) {
		$content = embed_youtube_in($content);
	}
		
	if(vimeo_contained_in($content)) {
		$content = embed_vimeo_in($content);
	}
	
	return $content;
	
} // end display_rss_feed_message

/*------------------------------------------------*
 * Helper Functions
 *------------------------------------------------*/ 

/**
 * Returns whether or not the user has specified the YouTube shortcode.
 */
function youtube_contained_in($content) {
	return strpos($content, 'youtube') > 0 || strpos($content, 'youtu') > 0;	
} // end youtube_contained_in

/**
 * Returns whether or not the user has specified the Vimeo shortcode.
 */
function vimeo_contained_in($content) {
	return strpos($content, 'vimeo') > 0;	
} // end vimeo_contained_in

/**
 * Returns the width of the media embed width specified in the WordPress settings panel.
 */
function get_embed_width() {
	global $wpdb;
	return $wpdb->get_var($wpdb->prepare("SELECT option_value FROM $wpdb->options WHERE option_name = %s", 'embed_size_w'));
} // end get_embed_width

/**
 * Returns the width of the media embed height specified in the WordPress settings panel.
 */
function get_embed_height() {
	global $wpdb;
	return $wpdb->get_var($wpdb->prepare("SELECT option_value FROM $wpdb->options WHERE option_name = %s", 'embed_size_h'));
} // end get_embed_height

/**
 * Returns the message displayed in RSS readers and email clients.
 */
function get_custom_rss_message() {
	
	global $post;
	$message = '<div id="tentblogger-vimeo-youtube-message" style="width: 100%; border: 1px solid #e6e6e6; background: #f8f8f4; text-align:center; padding: 0.25em; ">';
		$message .= __('Can\'t see the video in your RSS reader or email? ', 'tentblogger-vimeo');
		$message .= '<a target="_blank" href="' . get_permalink($post->ID) . '">' . __('Click Here', 'tentblogger-vimeo') . '!</a>';
	$message .= '</div>';
	
	return $message;
	
} // end get_custom_rss_message

/**
 * Replaces the YouTube shortcode with the proper messaging, width, height, and embed code.
 */
function embed_youtube_in($content) {

	$youtube_src = '<iframe title="YouTube video player" width="' . get_embed_width() . '" height="' . get_embed_height() . '" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>';
	
	$youtube_content = preg_replace("~\[tentblogger-youtube (.*?)\]~i", $youtube_src, $content);
	if(is_feed()) {
		$youtube_content = preg_replace("~\[tentblogger-youtube (.*?)\]~i", $youtube_src . get_custom_rss_message(), $content);	
	}
	
	return $youtube_content;
	
} // end embed_youtube_in

/**
 * Replaces the Vimeo shortcode with the proper messaging, width, height, and embed code.
 */
function embed_vimeo_in($content) {

	$vimeo_src = '<iframe src="http://player.vimeo.com/video/$1?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="' . get_embed_width() . '" height="' . get_embed_height() . '" frameborder="0"></iframe>';

	$vimeo_content = preg_replace("~\[tentblogger-vimeo (.*?)\]~i", $vimeo_src, $content);
	if(is_feed()) {
		$vimeo_content = preg_replace("~\[tentblogger-vimeo (.*?)\]~i", $vimeo_src . get_custom_rss_message(), $content);	
	}
	
	return $vimeo_content;
	
} // end embed_vimeo_in

/*------------------------------------------------*
 * WordPress Hooks
 *------------------------------------------------*/ 
add_filter('the_excerpt_rss', 'display_rss_feed_message');
add_filter('the_content', 'display_rss_feed_message');
add_filter('media_buttons_context', 'add_vimeo_youtube_icon');
add_action('init', 'tentblogger_vimeo_youtube_init');
?>