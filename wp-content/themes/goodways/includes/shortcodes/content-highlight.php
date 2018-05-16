<?php
	/* Shortcode */
	add_shortcode('content_highlight', 'ts_content_highlight');
	
	/* -----------------------------------------------------------------
		Content Highlight
	----------------------------------------------------------------- */
	function ts_content_highlight($atts, $content = null) {
		extract(shortcode_atts(array(
		), $atts));

		$output = '<div class="highlight-content"><div class="highlight-container">'.$content.'</div></div>';
		return do_shortcode($output);
	}
?>