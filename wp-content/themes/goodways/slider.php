<?php
$sliderarrange = of_get_option('templatesquare_slider_arrange');
$sliderDisableText = of_get_option('templatesquare_slider_disable_text');
?>


<!-- SLIDER -->
        <div id="outerslider">
        	<div id="slidercontainer">
            
            	<section id="slider">
                	
                    <div id="slideritems" class="flexslider">
                    <ul class="slides">
                    
						<?php
                        query_posts('post_type=slider-view&post_status=publish&showposts=-1&order=' . $sliderarrange);
                        while ( have_posts() ) : the_post();
                        
                        $custom = get_post_custom($post->ID);
                        $cf_slideurl = (isset($custom["slider-url"][0]))?$custom["slider-url"][0] : "";
                        $cf_thumb = (isset($custom["slider-image"][0]))? $custom["slider-image"][0] : "";
                        
                        $output="";
                        $output .='<li>';
                        
                            if($cf_slideurl!="" && $sliderDisableButton==true){
                                $output .= '<a href="'.$cf_slideurl.'">';
                            }
                           
                            //slider images
                            if(has_post_thumbnail( get_the_ID()) || $cf_thumb!=""){
                                if($cf_thumb!=""){
                                    $output .= '<img src="'.$cf_thumb.'" alt="" />';
                                }else{
                                    $output .= get_the_post_thumbnail($post->ID,'post-slider', array("alt" =>"", "title" =>""));
                                }
                            }
                                
                            if($cf_slideurl!="" && $sliderDisableButton==true){
                                $output .= '</a>';
                            }
                            
                           //slider text
                           if($sliderDisableText!=true){
                               $output .='<div class="flex-caption">';
							   $output .='<div class="slidertext">';
                               if($cf_slideurl!=""){
                                   $output .='<h1><a href="'.$cf_slideurl.'">'.get_the_title().'</a></h1>';
                               }else{
                                   $output .='<h1>'.get_the_title().'</h1>';
                               }
                           }
                            
                        $output .='</div></div></li>';
                        
                        echo $output;
                        
                        endwhile;
                        wp_reset_query();
                        ?>
                        
                    </ul>
                    </div>
                    <div id="slidershadow"></div>
                </section>
                
            </div>
        </div>
<!-- END SLIDER -->

