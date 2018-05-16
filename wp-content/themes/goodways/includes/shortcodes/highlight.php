<?php
	/* Highlight Shortcode */
	add_shortcode( 'highlight', 'ts_highlight' );
	
	/* -----------------------------------------------------------------
		Highlight
	----------------------------------------------------------------- */
	function ts_highlight($atts, $content = null) {
		extract(shortcode_atts(array(
					"type" => ''
		), $atts));

		if($type=="" || $type=="1"){
			$output = '<span class="highlight1">'.$content.'</span>';
		}
		if($type=="2"){
			$output = '<span class="highlight2">'.$content.'</span>';
		}	
		if($type=="3"){
			$output = '<span class="highlight3">'.$content.'</span>';
		}	
		return do_shortcode($output);
	}
?>