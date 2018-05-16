<?php
	add_action('init', 'prk_tinymce_button');	

	function prk_tinymce_button() 
	{
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) 
	   {
		 return;
	   }
	   if ( get_user_option('rich_editing') == 'true' ) 
	   {
		 add_filter( 'mce_external_plugins', 'add_plugin' );
		 add_filter( 'mce_buttons', 'prk_register_button' );
	   }
	}
	function prk_register_button( $buttons ) 
	{
		array_push( $buttons, "|", "prk_tinymce_btn" );
		return $buttons;
	}
	 
	function add_plugin( $plugin_array ) 
	{
	   $plugin_array['prk_tinymce'] = get_template_directory_uri() . '/inc/pirenko_scodes/prk_tinymce.js';
	   return $plugin_array;
	}
	function pirenko_scodes_init()
	{
		if (is_admin())
		{
			wp_enqueue_script( 'jq_dynotbl', get_template_directory_uri() . '/inc/pirenko_scodes/dynotable.js', false, null );
		}
	}
	add_action('admin_init','pirenko_scodes_init');
	//SHORTCODES MANAGMENT
	//SLIDERS
	function pixia_slider( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'category'    	 => '',//SHOW ALL SLIDES BY DEFAULT
			'id'		 => 'sample_slider'
		), $atts));
					$args=array(	'post_type' => 'pirenko_slides',
								  	'showposts' => 99,
								  	'pirenko_slide_set' => $category
								);
					$loop = new WP_Query( $args );
		$out = '';
		$slide_number=0;
		$out.='	<div class="flexslider shortcode_slider">
                        <ul id="'. $id .'" class="slides">';
                        		while ( $loop->have_posts() ) : $loop->the_post();
								$use_txt = get_post_meta(get_the_ID(), "pixia_slide_txt", true);
								 $h_align = get_post_meta(get_the_ID(), "pixia_slide_txt_horz", true);
								 $v_align = get_post_meta(get_the_ID(), "pixia_slide_txt_vert", true);
								 $pos_class="sld_".$h_align." "."sld_".$v_align;				
									if (has_post_thumbnail( get_the_ID() ) ):
										//GET THE FEATURED IMAGE
											$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );	
											else :
												//THERE'S NO FEATURED IMAGE SO LET'S LOAD A DEFAULT IMAGE
												$container="".get_bloginfo('template_directory')."/images/sample_home.jpg";
												$image[0]=get_image_path($container);
											endif; 
											
											$out.='<li>';
													if (get_post_meta(get_the_ID(), "pixia_slide_url", true)!="")
													{
                                            			$out.='<a href="'.get_post_meta(get_the_ID(), "pixia_slide_url", true) .'">';
                                           
													}
													if (!isset($use_txt))
													$use_txt=1;
													if (get_the_title()=="" || $use_txt==0)
													{
														$sl_title="&nbsp;";
														$title_class="inv_el";
													}
													else
													{
														$sl_title=get_the_title();
														$title_class="";
													}
													if (get_the_content()=="" || $use_txt==0)
													{
														$sl_body="&nbsp;";
														$body_class="inv_el";
													}
													else
													{
														$sl_body=get_the_content();
														$body_class="";
													}
													
													if (get_post_meta(get_the_ID(), "pixia_slide_video", true)=="")
													{
														if ($use_txt==1)
														{
															$out.=' <div class="slider_text_holder '. $pos_class .'">';
															$out.='  <div id="'.$id.'top_'. $slide_number .'" class="headings_top '.$title_class.'">';
															$out.=' <h3 style="color:'.get_post_meta(get_the_ID(), "pixia_slide_header_color", true).'">'. $sl_title .'</h3>';
															$out.=' </div>';
															$out.=' <div id="'.$id.'body_'. $slide_number .'" class="headings_body '.$body_class.'">';
															$out.=' <h4 style="color:'.get_post_meta(get_the_ID(), "pixia_slide_body_color", true).'">'. $sl_body .'</h4>';
															$out.='</div>';
															$out.='</div>';
														}
														$out.='<img src='. $image[0] .' alt="">';
													}
													else
													{
														if ($use_txt==1)
														{
															//IT's A VIDEO SLIDE
															$out.=' <div class="slider_text_holder">';
															$out.='  <div id="'.$id.'top_'. $slide_number .'" class="headings_top slide_video '.$title_class.'">';
															$out.=' <h3 style="color:'.get_post_meta(get_the_ID(), "pixia_slide_header_color", true).'">'. $sl_title .'</h3>';
															$out.=' </div>';
															$out.=' <div id="'.$id.'body_'. $slide_number .'" class="headings_body '.$body_class.'">';
															$out.=' <h4 style="color:'.get_post_meta(get_the_ID(), "pixia_slide_body_color", true).'">'. $sl_body .'</h4>';
															$out.='</div>';
															$out.='</div>';	
														}
														$out.=get_post_meta(get_the_ID(), "pixia_slide_video", true);
													}
												if (get_post_meta(get_the_ID(), "pixia_slide_url", true)!="")
												{
													
                                                   $out.=' </a>';
                                                    
												}
												
											$out.='</li>';
											$slide_number++;
								endwhile;
                           
                 $out.='       </ul><!-- slides -->
                  	</div><!-- flexslider home_slider -->';
					wp_reset_query();
                  return $out;
	}
	add_shortcode('slider', 'pixia_slider');
	
	//BLOCKQUOTES
	function blockquotes_shortcode( $atts, $content = null ) 
	{
	   return '<blockquote>' . $content . '<div class="pirenko_author">' . $atts['bf_author'] . $atts['author'] . '</div>' . '</blockquote>';
	}
	add_shortcode('pirenko_blockquote', 'blockquotes_shortcode');
	
	//INFO BOX
	function info_box_shortcode( $atts, $content = null ) 
	{
	   return '<div class="ui-widget">
              <div class="ui-state-default ui-corner-all" style="margin-bottom:18px">
                <p><span class="ui-icon ui-icon-comment" style="float: left; margin-right: .3em;"></span>' . $content . '</p>
              </div>
            </div>';
	}
	add_shortcode('info_box', 'info_box_shortcode');
	//WARNING BOX
	function warning_box_shortcode( $atts, $content = null ) 
	{
	   return '<div class="ui-widget">
              <div class="ui-state-highlight ui-corner-all">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;margin-top:1px;"></span>' . $content . '</p>
              </div>
            </div>';
	}
	add_shortcode('warning_box', 'warning_box_shortcode');
	//ERROR BOX
	function error_box_shortcode( $atts, $content = null ) 
	{
	   
	   return '<div class="ui-widget">
              <div class="ui-state-error ui-corner-all">
                <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;margin-top:1px;"></span>' . $content . '</p>
              </div>
            </div>';
	}
	add_shortcode('error_box', 'error_box_shortcode');
	
	//LISTS
	function list_with_icons_shortcode( $atts, $content = null ) 
	{
		$custom_icons="";
		if (isset($atts['icon']))
			$custom_icons=$atts['icon'];
	return '<div class="list_with_icons '. $custom_icons .'">' . $content . '</div>';
	}
	add_shortcode('list_with_icons', 'list_with_icons_shortcode');

	//TABS
	//CHILD TABS RETRIEVAL
	function prk_tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		//MAKE TAB ID MATCH THE CONTENT TAB ID
		return '<div id="prk_tab_'. sanitize_title( $title ) .'" class="prk_tab">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'prk_tab', 'prk_tab' );
	//MAIN TABS RETRIEVAL
	function prk_tabs( $atts, $content = null ) 
	{
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		//EXTRACT TAB TITLES
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) )
		{ 
			$tab_titles = $matches[1]; 
		}
		
		$output = '';
		
		if( count($tab_titles) )
		{
		    $output .= '<div id="tabs_'. rand(1, 1000) .'" class="prk_tabs">';
			$output .= '<ul>';
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#prk_tab_'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div>';
		} 
		else 
		{
			$output .= "SHORTCODE ERROR! No Tab Titles were found.";
		}
		
		return $output;
	}
	add_shortcode( 'prk_tabs', 'prk_tabs' );
	//ACCORDION
	//CHILDNODES RETRIEVAL
	function prk_ac_single( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		//MAKE TAB ID MATCH THE CONTENT TAB ID
		return '<div class="prk_ac_single">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'prk_ac_single', 'prk_ac_single' );
	//MAIN ACCORDION RETRIEVAL
	function prk_accordion( $atts, $content = null ) 
	{
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		//EXTRACT ACCORDION TITLES
		preg_match_all( '/prk_ac_single title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		//print_r ($matches);
		$tab_titles = array();
		if( isset($matches[1]) )
		{ 
			$tab_titles = $matches[1]; 
		}
		preg_match_all( '/prk_ac_single title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$output = '';
		//LETS CONVERT THE STRING FOR THE ACCORDION USAGE
		$finale=$content;
		$finale=str_replace('[prk_ac_single title="', '<h3><a href="#">', $finale);
		$finale=str_replace("[/prk_ac_single]", '</div>', $finale);
		$finale=str_replace('"]', '</h3></a><div>', $finale);
		if( count($tab_titles) )
		{
			$helper=1;
		    $output .= '<div id="accordion_'. rand(1, 1000) .'" class="prk_accordion">';
			$output .= $finale;
		    $output .= '</div>';
		} 
		else 
		{
			$output .= "SHORTCODE ERROR! No Accordion Title were found.";
		}
		
		return $output;
	}
	add_shortcode( 'prk_accordion', 'prk_accordion' );
	
	//ICONS
	function icons_shortcode( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'icon_set'    	 => '',//Black icons by default
			'icon'		 => 'heart'
		), $atts));
		$out = '';
	
	$out .=  '<div class="icon-'. $icon.' '. $icon_set .'">' . $content . '</div>';
	return $out;
	}
	add_shortcode('theme_icon', 'icons_shortcode'); 
	
	//THEME BUTTONS
	function button_shortcode( $atts, $content = null ) 
	{
		extract(shortcode_atts(array(
			'caption'    	 => 'This is my text',
			'icon'		 => 'heart'
		), $atts));
		$link="";
		if (isset($atts['link']))
			$link=$atts['link'];
		$out = '';
	   	$out.= '<div class="theme_button"><a href="'.$link.'">' . $content . '</a></div>';
	   	return $out;
	}
	add_shortcode('theme_button', 'button_shortcode');
	
	//LAYOUTS
	function pixia_one_full( $atts, $content = null ) {
   	return '<div class="twelve columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_full', 'pixia_one_full');
	
	
	function pixia_one_half( $atts, $content = null ) {
	   return '<div class="six columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_half', 'pixia_one_half');
	
	
	function pixia_one_half_last( $atts, $content = null ) {
	   return '<div class="six columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_half_last', 'pixia_one_half_last');
	
	
	function pixia_one_third( $atts, $content = null ) {
	   return '<div class="four columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_third', 'pixia_one_third');
	
	
	function pixia_one_third_last( $atts, $content = null ) {
	   return '<div class="four columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_third_last', 'pixia_one_third_last');
	
	
	function pixia_two_third( $atts, $content = null ) {
	   return '<div class="eight columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('two_third', 'pixia_two_third');
	
	
	function pixia_two_third_last( $atts, $content = null ) {
	   return '<div class="eight columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('two_third_last', 'pixia_two_third_last');
	
	
	function pixia_one_fourth( $atts, $content = null ) {
	   return '<div class="three columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_fourth', 'pixia_one_fourth');
	
	
	function pixia_one_fourth_last( $atts, $content = null ) {
	   return '<div class="three columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_fourth_last', 'pixia_one_fourth_last');
	
	
	function pixia_three_fourth( $atts, $content = null ) {
	   return '<div class="nine columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('three_fourth', 'pixia_three_fourth');
	
	
	function pixia_three_fourth_last( $atts, $content = null ) {
	   return '<div class="nine columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('three_fourth_last', 'pixia_three_fourth_last');
	
	
	function pixia_one_sixth( $atts, $content = null ) {
	   return '<div class="two columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('one_sixth', 'pixia_one_sixth');
	
	
	function pixia_one_sixth_last( $atts, $content = null ) {
	   return '<div class="two columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('one_sixth_last', 'pixia_one_sixth_last');
	
	
	function pixia_five_sixth( $atts, $content = null ) {
	   return '<div class="ten columns">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('five_sixth', 'pixia_five_sixth');
	
	
	function pixia_five_sixth_last( $atts, $content = null ) {
	   return '<div class="ten columns">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
	}
	add_shortcode('five_sixth_last', 'pixia_five_sixth_last');

	//RETURNS SOCIAL NETWORK ICON
	function prk_social_icon($network_label) {
	    switch ($network_label) {
	        case 'behance':
	            return "pixia_fa-behance";
	        break;
	        case 'delicious':
	            return "pixia_fa-delicious";
	        break;
	        case 'deviantart':
	            return "pixia_fa-deviantart";
	        break;
	        case 'dribbble':
	            return "pixia_fa-dribbble";
	        break;
	        case 'facebook':
	            return "pixia_fa-facebook";
	        break;
	        case 'facebook-official':
	            return "pixia_fa-facebook-official";
	        break;
	        case 'flickr':
	            return "pixia_fa-flickr";
	        break;
	        case 'gplus':
	            return "pixia_fa-google-plus";
	        break;
	        case 'instagram':
	            return "pixia_fa-instagram";
	        break;
	        case 'linkedin':
	            return "pixia_fa-linkedin";
	        break;
	        case 'linkedin-square':
	            return "pixia_fa-linkedin-square";
	        break;
	        case 'medium':
	            return "pixia_fa-medium";
	        break;
	        case 'pinterest':
	            return "pixia_fa-pinterest";
	        break;
	        case 'skype':
	            return "pixia_fa-skype";
	        break;
	        case 'soundcloud':
	            return "pixia_fa-soundcloud";
	            break;
	        case 'twitter':
	            return "pixia_fa-twitter";
	        break;
	        case 'vimeo':
	            return "pixia_fa-vimeo-square";
	        break;
	        case 'yahoo':
	            return "pixia_fa-yahoo";
	        break;
	        case 'youtube':
	            return "pixia_fa-youtube";
	        break;
	        case 'rss':
	            return "pixia_fa-rss";
	        break;
	        case 'book':
	            return "pixia_fa-file";
	        break;
	        default:
	            return "";
	    }
	}

	//TEAM MEMBER
	function prk_member_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'category'    	=> '',
			'columns'		=>'columns',
		), $atts));
		if ($category=="show_all")
			$category="";
		if (isset($atts['items_number']) && $atts['items_number']!="")
			$items_number=$atts['items_number'];
		else
			$items_number=999;
		//DEFAULT VALUES
		$columns=3;
		$fluid="small-4 columns";
		if (!isset($atts['columns'])) {
			$atts['columns']=3;
		}
	    if ($atts['columns']==2) {
	      $fluid="six columns";
	      $columns=$atts['columns'];
	  	}
	    if ($atts['columns']==3){
	      $fluid="four columns";
	      $columns=$atts['columns'];
	  	}
	    if ($atts['columns']==4){
	      $fluid="three columns";
	      $columns=$atts['columns'];
	  	}
	    if ($atts['columns']==6){
	      $fluid="two columns";
	      $columns=$atts['columns'];
	  	}

		$args=array('post_type' => 'pirenko_team_member',
			'showposts' => $items_number,
			'order_by' => 'menu_order',
			'pirenko_member_group' => $category
		);
		$loop = new WP_Query( $args );
		$out = '';
		$i=0;
		$out.='<div class="row">';
		$out.='<ul class="prk_member_ul unstyled">';
		while ( $loop->have_posts() ) : $loop->the_post();
		$out.='<li class="'.$fluid.'">';
		if (has_post_thumbnail( $loop->post->ID ) ) {
			$out.='<div class="member_colored_block" data-link="'.get_permalink($loop->post->ID).'">';
				//GET THE FEATURED IMAGE
				//$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
				$vt_image = vt_resize( get_post_thumbnail_id($loop->post->ID), '' ,0,0 , false );
				$out.='<div class="member_colored_block_in"></div>';
				$out.='<a href="'.get_permalink($loop->post->ID).'">';
				$out.='<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" alt="" class="mb_in_img" />';
				$out.='</a>';
				$meta = get_post_meta( $loop->post->ID, 'key', true );
				global $simple_mb;
				$meta=$simple_mb->the_meta();
				//print_r($meta);
				$out.='<div class="pixia_member_links">';
					$out.='<div class="pixia_member_links_inner">';
					if (isset($meta['member_social_1']) && $meta['member_social_1']!="none") {           
		                $out.='<div class="member_lnk">';
			                if (isset($meta['member_social_1_link']) && $meta['member_social_1_link']!="")
			                    $in_link=$meta['member_social_1_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($meta['member_social_1']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($meta['member_social_2']) && $meta['member_social_2']!="none") {           
		                $out.='<div class="member_lnk">';
			                if (isset($meta['member_social_2_link']) && $meta['member_social_2_link']!="")
			                    $in_link=$meta['member_social_2_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($meta['member_social_2']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($meta['member_social_3']) && $meta['member_social_3']!="none") {           
		                $out.='<div class="member_lnk">';
			                if (isset($meta['member_social_3_link']) && $meta['member_social_3_link']!="")
			                    $in_link=$meta['member_social_3_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($meta['member_social_3']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($meta['member_social_4']) && $meta['member_social_4']!="none") {           
		                $out.='<div class="member_lnk">';
			                if (isset($meta['member_social_4_link']) && $meta['member_social_4_link']!="")
			                    $in_link=$meta['member_social_4_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($meta['member_social_4']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($meta['member_social_5']) && $meta['member_social_5']!="none") {           
		                $out.='<div class="member_lnk">';
			                if (isset($meta['member_social_5_link']) && $meta['member_social_5_link']!="")
			                    $in_link=$meta['member_social_5_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($meta['member_social_5']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($meta['member_social_6']) && $meta['member_social_6']!="none") {           
		                $out.='<div class="member_lnk">';
			                if (isset($meta['member_social_6_link']) && $meta['member_social_6_link']!="")
			                    $in_link=$meta['member_social_6_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($meta['member_social_6']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            $out.='</div>';
	            $out.='</div>';
            $out.='</div>';
		}
		$out.='<a href="'.get_permalink($loop->post->ID).'"><h3>';
			$out.=get_the_title();
		$out.='</h3></a>';
		$out.='<div class="sh_member_trg ten columns centered">';
		if (isset($meta['member_job']) && $meta['member_job']!="") {   
			$out.=$meta['member_job'];
		}
		//$out.=the_excerpt_dynamic(62,$loop->post->ID);
		$out.='</div>';
		$out.='</li>';
		$i++;
		if ($i%$columns==0) {
			$out.='<li class="clearfix"></li>';
		}
		endwhile;
		$out.='</ul></div>';
		wp_reset_query();
	  	return $out;
	}
	add_shortcode('prk_members', 'prk_member_shortcode');
?>