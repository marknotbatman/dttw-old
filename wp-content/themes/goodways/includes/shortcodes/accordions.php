<?php
	/* Accordions Shortcode */
	add_shortcode('accordions', 'ts_accordions');
	add_shortcode('accordion', 'ts_accordion');
	
	/* -----------------------------------------------------------------
		Accordion
	----------------------------------------------------------------- */
	function ts_accordion($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'title' => ''
		), $atts));
		
		$output = '
				<li>
					<h2 class="accordion-title"><span class="accordion-icon"></span>'.$title.'</h2>
					<div class="accordion-content">'.$content.'</div>
				</li>';
			
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
		Accordion Container
	----------------------------------------------------------------- */
	function ts_accordions($atts, $content = null) {
		$output = '<ul class="ts-accordion">'.$content.'</ul>';
		return do_shortcode($output);
		
	}
?>