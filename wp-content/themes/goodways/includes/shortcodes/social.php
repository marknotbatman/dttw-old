<?php

	/* Social */
	add_shortcode('social', 'ts_socialshortcode');
	
	/* -----------------------------------------------------------------
		Social
	----------------------------------------------------------------- */
	function ts_socialshortcode() {
			
		return ts_socialicon();
		
	}

?>