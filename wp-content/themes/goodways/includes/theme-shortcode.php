<?php
/**
 * Theme Short-code Functions
 */
 $shortcode_path = get_template_directory() . '/includes/shortcodes/';
 
/****************Standards Shortcodes***********************/ 
require_once($shortcode_path. "columns.php" );
require_once($shortcode_path. "dropcap.php" );
require_once($shortcode_path. "tabs.php" );
require_once($shortcode_path. "toggles.php" );
require_once($shortcode_path. "quote.php" );
require_once($shortcode_path. "separator.php" );
require_once($shortcode_path. "pre.php" );
require_once($shortcode_path. "social.php" );
require_once($shortcode_path. "accordions.php" );
require_once($shortcode_path. "highlight.php" );
require_once($shortcode_path. "content-highlight.php" );
require_once($shortcode_path. "content-box.php" );
require_once($shortcode_path. "recent-posts.php" );

// Actual processing of the shortcode happens here
function ts_run_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
 
    add_shortcode('accordions', 'ts_accordions');
	add_shortcode('accordion', 'ts_accordion');
	
	add_shortcode('one_half', 'ts_one_half');
	add_shortcode('one_third', 'ts_one_third');
	add_shortcode('one_fourth', 'ts_one_fourth');
	add_shortcode('one_fifth', 'ts_one_fifth');
	add_shortcode('one_sixth', 'ts_one_sixth');
	
	add_shortcode('two_third', 'ts_two_third');
	add_shortcode('two_fourth', 'ts_two_fourth');
	add_shortcode('two_fifth', 'ts_two_fifth');
	add_shortcode('two_sixth', 'ts_two_sixth');
	
	
	add_shortcode('three_fourth', 'ts_three_fourth');
	add_shortcode('three_fifth', 'ts_three_fifth');
	add_shortcode('three_sixth', 'ts_three_sixth');
	
	add_shortcode('four_fifth', 'ts_four_fifth');
	add_shortcode('four_sixth', 'ts_four_sixth');
	
	add_shortcode('five_sixth', 'ts_five_sixth');
	
	add_shortcode('content_box', 'ts_content_box');
	
	add_shortcode('content_highlight', 'ts_content_highlight');
	
	add_shortcode( 'dropcap', 'ts_dropcap' );
	
	add_shortcode( 'highlight', 'ts_highlight' );
	
	add_shortcode('pre', 'ts_pre');
	
	add_shortcode( 'pullquote', 'ts_pullquote' );
	add_shortcode( 'blockquote', 'ts_blockquote' );
	
	add_shortcode( 'recent_posts', 'ts_recentposts' );
	
	add_shortcode('separator', 'ts_separator');
	add_shortcode('clear', 'ts_clearfloat');
	add_shortcode('clearfix', 'ts_clearfixfloat');
	
	add_shortcode('social', 'ts_socialshortcode');
	
	add_shortcode('tabs', 'ts_tab');
	
	add_shortcode('toggles', 'ts_toggles');
	add_shortcode('toggle', 'ts_toggle');
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'ts_run_shortcode', 7 );
?>