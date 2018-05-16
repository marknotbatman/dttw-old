<?php
	/* Shortcode */
	add_shortcode('separator', 'ts_separator');
	add_shortcode('clear', 'ts_clearfloat');
	add_shortcode('clearfix', 'ts_clearfixfloat');
	
	/* -----------------------------------------------------------------
		Separator
	----------------------------------------------------------------- */
	function ts_separator($atts, $content = null) {
		extract(shortcode_atts(array(
					"line" => ''
		), $atts));

		if($line==""){
		$output = '<div class="separator"><div></div></div>';
		}else{
		$output = '<div class="clear"></div><div class="separator line"><div></div></div>';
		}
		
		return do_shortcode($output);
		
	}
	
	/* -----------------------------------------------------------------
		Clear
	----------------------------------------------------------------- */
	function ts_clearfloat($atts, $content = null) {

		$output = '<div class="clear">&nbsp;</div>';
		return do_shortcode($output);
		
	}
	
	/* -----------------------------------------------------------------
		Clearfix
	----------------------------------------------------------------- */
	function ts_clearfixfloat($atts, $content = null) {

		$output = '<div class="clearfix">&nbsp;</div><br/>';
		return do_shortcode($output);
		
	}
?>