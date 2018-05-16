<?php
	/* Recent Posts */
	add_shortcode( 'recent_posts', 'ts_recentposts' );
	
	function ts_recentposts($atts, $content = null) {
		extract(shortcode_atts(array(
					"title" => '',
					"showposts" => '3',
					"cat" => ''
		), $atts));
		
			$output  ='';
			if($title!=""){
			$output  .='<h2 class="rp-shortcode-title">'.$title.'</h2>';
			}

			$i=1;
			query_posts("showposts=".$showposts."&category_name=" . $cat);
			global $post;
			
			$output  .='<ul class="rp-shortcode">';
			
			while (have_posts()) : the_post();
			if(($i%3)==0){
			$addclass ="omega";
			}elseif(($i%3)==1){
			$addclass ="alpha";
			}
			
			//Get excerpt
			$excerpt = get_the_excerpt(); 
			
			//get_comment
			$num_comments = get_comments_number(); // for some reason get_comments_number only returns a numeric value displaying the number of comments
			 if ( comments_open() ){
				  if($num_comments == 0){
					  $comments = __('No Comments','templatesquare');
				  }
				  elseif($num_comments > 1){
					  $comments = $num_comments. __('Comments','templatesquare');
				  }
				  else{
					   $comments ="1 Comment";
				  }
			 $write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
			 }
			else{$write_comments =  __('Comments off','templatesquare');}
			
			//get blog post thumb
			$custom = get_post_custom($post->ID);
			$cf_thumb = (isset($custom["thumb-small"][0]))? $custom["thumb-small"][0] : "";
			
			if($cf_thumb!=""){
				$thumb = '<img src='. $cf_thumb .' alt="" />';
			}elseif(has_post_thumbnail($post->ID) ){
				$thumb = get_the_post_thumbnail($post->ID, 'post-blog', array('alt' => '', 'class' => ''));
			}else{
				$thumb ="";
			}
			


			$output  .='<li class="'.$addclass.'">';
			$output  .='<div class="postthumb">'.$thumb.'</div>';
			$output  .='<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
			$output  .='<span class="smalldate">'.get_the_time('F d, Y').'</span>';

			$output  .='<div class="clear"></div></li>';
			
			 $i++; $addclass=""; endwhile; wp_reset_query();
			 
			 $output  .='</ul>';
			 return do_shortcode($output);
} 
?>