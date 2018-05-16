<?php
	/* Shortcode */
	add_shortcode('content_box', 'ts_content_box');
	
	/* -----------------------------------------------------------------
		Content Box
	----------------------------------------------------------------- */
	function ts_content_box($atts, $content = null) {
		extract(shortcode_atts(array(
					"icon" => '',
					"title" => '',
					"buttontext" => 'Start Now',
					"url" => '#',
					"separator" => 'yes',
					"firstcol" => '',
					"lastcol" => ''
		), $atts));
		
		if($firstcol=="yes"):
			$addclass="alpha";
		elseif($lastcol=="yes"):
		 	$addclass="omega";
		else:
			$addclass="";
		endif;

		
		$output  = '<div class="boxed-container">';
		$output  .= '<div class="boxed three columns '.$addclass.'">';
		$output  .= '<div class="boxed-content">';
		if($icon!=""):
			$output .= '<img src="'.$icon.'" alt="" class="imgopacity" />';
		endif;
			$output .= '<h3 class="titleUppercase">'.$title.'</h3>';
		if($separator=="yes"):
			$output .= '<div class="sep"><span class="sep2"></span></div>';
		endif;
		$output .= '<p>'.$content.'</p>';
		if($url!=""):
			$output .= '<a href="'.$url.'" class="button">'.$buttontext.'</a>';
		endif;
		$output .= '</div>';
		$output .= '<div class="shadow-220"></div>';
		$output .= '</div>';
		$output .= '</div>';
		
		return do_shortcode($output);
	}
?>