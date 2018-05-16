<?php if ( ! have_posts() ) : ?>
<article id="post-0" class="post error404 not-found">
    <h1 class="posttitle"><?php _e( 'Not Found', 'templatesquare' ); ?></h1>
    <div class="entry">
        <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'templatesquare' ); ?></p>
        <?php get_search_form(); ?>
    </div>
</article>
<?php endif; ?>


<?php 
	$disabletitle = of_get_option('templatesquare_pf_disable_title' ,'false');
	$enabledesc = of_get_option('templatesquare_pf_enable_desc' ,'false');
	$longdesc = of_get_option('templatesquare_pf_lengthchar' ,'');
							
	
	$idnum = 1;
	
	$output ='';
	$output .='<div class="ts-display-portfolio">';
	$output .='<ul class="ts-display-pf-col-3">';
	
	global $query_string;
	$posts = query_posts($query_string.'&showposts=6');
	
	while ( have_posts() ) : the_post(); 
			$custom = get_post_custom($post->ID);
			$cf_thumb = (isset($custom["thumb"][0]))? $custom["thumb"][0] : "";
			$cf_lightbox = (isset($custom["lightbox"][0]))? $custom["lightbox"][0] : "";
			$cf_externallink = (isset($custom["external-link"][0]))? $custom["external-link"][0] : "";
			
			
			//get portfolio
			$attachments = get_children( array(
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'order' => '',
			'post_mime_type' => 'image')
			);
			
			
			foreach ( $attachments as $att_id => $attachment ) {
			 
			$getimage = wp_get_attachment_image_src($att_id, 'post-col3', true);
			$portfolioimage = $getimage[0];
			$cf_thumb2 ='<img src="'.$portfolioimage.'" alt="" />';
			}
			 //
			
			if($cf_thumb!=""){
				$cf_thumb = "<img src='" . $cf_thumb . "' alt=''  />";
			}elseif(has_post_thumbnail($post->ID)){
				$cf_thumb = get_the_post_thumbnail($post->ID, 'post-col3', array('alt' =>''));
			}else{
				$cf_thumb = $cf_thumb2;
			}
			
			
			
			
			if(($idnum%3) == 0){$classpf = "nomargin";}else{$classpf = "";}
			if($disabletitle==true){$addclass= "no-pftitle";}else{$addclass="";}
			
			$output .='<li class="'.$classpf.'">';
			if($cf_thumb!=""){
				$output .='<div class="ts-display-pf-img">';
				$output .='<span class="rollover">';
				
					if($disabletitle!=true){
					$output .='<a class="pftitle" href="'.get_permalink().'" title="'.get_the_title().'">';
						$output .='<span>'.get_the_title().'</span>';
					$output .='</a>';
					}
					
					$output .='<span class="pf-utility '.$addclass.'">';
						if($cf_lightbox!=""){
							$output .='<a class="pfzoom" href="'.$cf_lightbox.'" data-rel=prettyPhoto['.$catname->slug.']>';
								$output .='<span></span>';
							$output .='</a>';
						}
						
						if($cf_externallink!=""){
							$output .='<a class="pflink" href="'.$cf_externallink.'">';
								$output .='<span></span>';
							$output .='</a>';
							
						}else{
							$output .='<a class="pflink" href="'.get_permalink().'">';
								$output .='<span></span>';
							$output .='</a>';
						}
						
				   $output .='</span>';
				   
				$output .='</span>';
				$output .=$cf_thumb;
				$output .='</div>';
				
				$output.='<span class="shadowpfimg"></span>';
				
				if($enabledesc==true){
				$output.='<div class="ts-display-pf-text">';
					$excerpt = get_the_excerpt();
					$output .='<span>'.ts_string_limit_char($excerpt,$longdesc).'</span>';
					
				$output.='</div>';
				
				}
				
				$output .='<div class="ts-display-clear"></div>';
			
			}
			
			$output .='</li>';
				
			$idnum++; $classpf="";
				
	endwhile; // End the loop. Whew.
	
		
	$output .='</ul>';
	$output .='<div class="clearfix"></div>';
	$output .='</div><!-- end #ts-display-portfolio -->';
	
	echo $output;
	
	
	
?>
    

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
 <?php if(function_exists('wp_pagenavi')) { ?>
	 <?php wp_pagenavi(); ?>
 <?php }else{ ?>
	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'templatesquare' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'templatesquare' ) ); ?></div>
	</div><!-- #nav-below -->
<?php }?>
<?php endif;?>

<?php wp_reset_query();?>
