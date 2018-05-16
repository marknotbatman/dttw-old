<?php
/**
 * Template Name: Portfolio
 *
 * A custom page template for portfolio page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Goodways
 * @since Goodways 1.0
 */

get_header(); ?>
       
        <!-- MAIN CONTENT -->
        <div id="outermain" class="inner">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                				
                			
                            <div class="ts-display-portfolio">
							<?php
								$cats = of_get_option('templatesquare_pf_category' ,'');
								$disabletitle = of_get_option('templatesquare_pf_disable_title' ,'false');
								$enabledesc = of_get_option('templatesquare_pf_enable_desc' ,'false');
								$longdesc = of_get_option('templatesquare_pf_lengthchar' ,'');
								$categories = $cats;
							
								$sideoutput = "";
								if($categories){
									foreach ($categories as $key => $value) {
										if($value==1){
											$catflag = 1; break;
										}
									}
								}
								
								if(isset($catflag)){
									$sideoutput .= '<ul id="filter" class="controlnav">';
										$sideoutput .= '<li class="segment-1 selected-1"><a href="#" data-value="all">'.__('All Categories','templatesquare').'</a></li>';
										foreach ($categories as $key => $value) {
											if(!$value) continue;
											$catname = get_term($key,"pcategory");
											$sideoutput .= '<li class="segment-1"><a href="#" data-value="'.$key.'">'.$catname->name.'</a></li>';
										}
									$sideoutput .= '</ul>';
								
								}else{
									$sideoutput .='<span style="color:red">Please Setting Portfolio in Appearance->Theme Options->Portfolio.</span>';
								}
								
								echo $sideoutput;
                            
                            ?>
                            
                                
                              <ul id="ts-display-pf-filterable" class="ts-display-pf-col-3 image-grid">
                                    <?php
                                    $idnum = 1;
                                    $arrID = array();
									
									if($categories){
                                    foreach ($categories as $key => $value) {	
										if(!$value) continue; 
                                        $catname = get_term($key,"pcategory");
                                        $catinclude = 'pcategory='. $catname->slug ;
                                        query_posts($catinclude .' &post_type=pdetail&showposts=-1&orderby=date&paged='.$paged); 
                                        
                                        
                                        while ( have_posts() ) : the_post(); 
                                            
                                        $custom = get_post_custom($post->ID);
                                        $cf_thumb = (isset($custom["thumb"][0]))? $custom["thumb"][0] : "";
                                        $cf_lightbox = (isset($custom["lightbox"][0]))? $custom["lightbox"][0] : "";
                                        $cf_externallink = (isset($custom["external-link"][0]))? $custom["external-link"][0] : "";
                                        
                                        
                                        //get post-thumbnail attachment
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
                                         
                                        
                                        //thumb image
										if($cf_thumb!=""){
                                            $cf_thumb = "<img src='" . $cf_thumb . "' alt=''  />";
                                        }elseif(has_post_thumbnail($post->ID)){
                                            $cf_thumb = get_the_post_thumbnail($post->ID, 'post-col3', array('alt' =>'', 'title' =>''));
                                        }else{
                                            $cf_thumb = $cf_thumb2;
                                        }
                                        
                                        $ids = get_the_ID();
                                        $cats = ts_portfolio_getcategoryids($ids);
									
                                        $classpf = "";
                                        foreach($cats as $cat){
                                            $classpf .= $cat["term_id"]." ";
                                        }
                                        if(($idnum%3) == 0){$classpf .= "nomargin ";}
										
										if($disabletitle==true){$addclass= "no-pftitle";}else{$addclass="";}
                                        
                                            if(!in_array($ids,$arrID)){							
                                            ?>
                                                <li data-id="id-<?php echo $idnum; ?>" class="<?php echo $key.' '.$classpf;?>">
                                                        <?php 
                                                        $output="";
														if($cf_thumb!=""){
                                                        $output.='<div class="ts-display-pf-img">';
                                                            
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
                                                           
                                                        $output.='</div>';
														$output.='<span class="shadowpfimg"></span>';
														}
														if($enabledesc==true){
                                                        $output.='<div class="ts-display-pf-text">';
                                                            $excerpt = get_the_excerpt();
                                                            $output .='<span>'.ts_string_limit_char($excerpt,$longdesc).'</span>';
                                                            
                                                        $output.='</div>';
														$output .='<div class="ts-display-clear"></div>';
														}
                                                        echo $output;
                                                         ?>
                                                </li>
                                                <?php 
                                                $idnum++; $classpf=""; 
                                                $arrID[] = $ids;
                                            }
											
                                        endwhile; // End the loop. Whew.
                                        wp_reset_query();
                                        
                                    }
								}
                                 ?>
                              </ul>
                              
                           </div>
                            
                      <div class="clear"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->

<?php get_footer(); ?>