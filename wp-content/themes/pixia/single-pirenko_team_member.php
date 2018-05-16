<?php 
	get_header();
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
	//GET THEME CUSTOM FIELDS INFO
    global $simple_mb;
	$data=$simple_mb->the_meta();
    //print_r($data);
	$sl_id="single_slider";
	$sl_class="flexslider";
	if (isset($data['no_slider']) && $data['no_slider']=="1")
	{
		$sl_id="not_slider";
		$sl_class="";
	}
?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_40">
    	<?php pirenko_main_before(); ?>
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_40" role="main" style="max-width:<?php echo $pixia_frontend_options['custom_width'] ?>px;">
			<?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('lpad'); ?> id="post-<?php the_ID(); ?>">
                	<div class="boxed_shadow colored_bg blog_single">
                	<div id="<?php echo $sl_id; ?>" class="<?php echo $sl_class; ?>">
                        <ul class="slides">
							<?php
                                $ext_count=0;
                                if (!isset($data['skip_featured']))
                               		$data['skip_featured']=0;
                             	if ($data['skip_featured']!=0 || $data['skip_featured']=="")
                              	{
									if (has_post_thumbnail( $post->ID ) )
									{
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
										//$image[0] = get_image_path($image[0]);
										$ext_count=1;
										?>
										<li>
											<img src="<?php echo $image[0]; ?>" />
										</li>
                                      	<?php
									}
                             	}
                                $flagger=true;//VARIABLE TO CHECK IF THERE'S ONLY ONE IMAGE
                                //PLACE THE OTHER NINE IMAGES
                                for ($count=2;$count<11;$count++)
                                {
                                 	if (isset($data['image-'.$count]))
                                    {
                                    	if ($data['image-'.$count]!="")
                                        {
                                        	$ext_count++;
                                            if ($ext_count>1):
                                            	$flagger=false;
                                            endif;
                                            ?>
                                           	<li>
                                            	<?php 
                                                	if (substr($data['image-'.$count],0,6)=="http:/" || substr($data['image-'.$count],0,7)=="https:/")
                                                    {
                                                    	//$data['image-'.$count] = get_image_path($data['image-'.$count]);
														?>
                                                        <img src="<?php echo $data['image-'.$count]; ?>" />
                                                    	<?php
                                                    }
                                                    else
                                                    {
														$el_class='video-container';
														if (strpos($data['image-'.$count],'soundcloud.com') !== false) {
															$el_class= 'soundcloud-container';
														}
														echo "<div class='".$el_class."'>";
                                                    	echo $data['image-'.$count];
														echo "</div>";
                                                    }
                                             	?>
                                         	</li>
                                        	<?php 
                                      	}
                               		}
                            	}
							?>
                    	</ul><!-- slides -->
                  	</div><!-- flexslider -->
                    <div class="clearfix"></div>
                    <header>
                    <div class="blog_meta blog_meta_single padded_text">
                    	<div class="show_much_later left_floated">&nbsp;</div>
                            <div class="tr_wrapper" style="z-index:0;width:25px;height:22px;">
                                <div class="submenu_catgr pirenko_tinted">
                                   <i class="clearer_inactive_color pixia_fa-clock-o"></i>
                                </div>
                            </div>
                            <span class="left_floated adj_ss" style="margin-left:18px;"><?php echo the_time(get_option('date_format')); ?></span>
                            <div class="clearfix show_much_later"></div>
							<?php 
                                if ($pixia_frontend_options['postedby_news']=="yes")
                                {
                                    ?>
                                    
                                        <span class="left_floated">&nbsp;<?php _e($pixia_frontend_options['posted_by_text'], 'pixia'); echo " ".get_the_author();?></span>
                                    <?php
                                }
                            ?>
                            <span class="pir_divider left_floated hide_much_later"></span>
                            <div class="clearfix show_much_later" style="margin-bottom:10px;"></div>
                            <?php 
								if ($pixia_frontend_options['categoriesby_news']=="yes")
								{
									?>
                                    	<span class="left_floated">
                                        	<div class="tr_wrapper" style="z-index:0;">
                                                    <div class="submenu_catgr pirenko_tinted">
                                                       <i class="clearer_inactive_color pixia_fa-briefcase"></i>
                                                    </div>
                                                </div>
                                                <div style="margin-left:20px">
										<?php the_category(', '); //CATS WITH LINKS ?>
                                        </div>
                                        </span>
                                        <span class="pir_divider left_floated hide_much_later"></span>
                                        <div class="clearfix show_much_later"></div>
									<?php
								}
							?>
                            <?php
								  if ( comments_open() ) :
								  ?>
								  <a href="<?php comments_link(); ?>">
									  <div class="left_floated">
										  <div class="tr_wrapper" style="z-index:0;">
											  <div class="submenu_speech pirenko_tinted">
												  <i class="clearer_inactive_color pixia_fa-comments"></i>
											  </div>
										  </div>
										  <div class="" style="margin-left:21px;margin-top:1px;">
											  <div class="">
											  <?php 
												  comments_number( '0', '1 ', '%');
												?> 
											   </div>
											</div>
										</div>
									</a>
								 <span class="pir_divider left_floated hide_much_later"></span>
								  <div class="clearfix show_much_later"></div>
								  <?php
							  endif;
                            ?>
                            <div class="left_floated">
                            <?php echo getblogLikeLink(get_the_ID());?>
                            	</div>
                        </div>
                    	<div class="simple_line hide_now"></div>
                       	<div class="padded_text sgl_ttl">
                        	<h2>
								<header_font><?php the_title(); ?></header_font>
                        	</h2>
                        	<?php
                        		//print_r($data);
                        		if (isset($data['member_job']) && $data['member_job']!="") {   
									echo '<div class="member_job special_italic on_colored">'.$data['member_job'].'</div>';
								}
							?>
                        
                   <?php
                   	$out='<div class="single_member_links">';
					$out.='<div class="single_member_links_inner">';
					if (isset($data['member_social_1']) && $data['member_social_1']!="") {           
		                $out.='<div class="member_lnk">';
			                if (isset($data['member_social_1_link']) && $data['member_social_1_link']!="")
			                    $in_link=$data['member_social_1_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($data['member_social_1']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($data['member_social_2']) && $data['member_social_2']!="") {           
		                $out.='<div class="member_lnk">';
			                if (isset($data['member_social_2_link']) && $data['member_social_2_link']!="")
			                    $in_link=$data['member_social_2_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($data['member_social_2']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($data['member_social_3']) && $data['member_social_3']!="") {           
		                $out.='<div class="member_lnk">';
			                if (isset($data['member_social_3_link']) && $data['member_social_3_link']!="")
			                    $in_link=$data['member_social_3_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($data['member_social_3']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($data['member_social_4']) && $data['member_social_4']!="") {           
		                $out.='<div class="member_lnk">';
			                if (isset($data['member_social_4_link']) && $data['member_social_4_link']!="")
			                    $in_link=$data['member_social_4_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($data['member_social_4']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($data['member_social_5']) && $data['member_social_5']!="") {           
		                $out.='<div class="member_lnk">';
			                if (isset($data['member_social_5_link']) && $data['member_social_5_link']!="")
			                    $in_link=$data['member_social_5_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($data['member_social_5']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            if (isset($data['member_social_6']) && $data['member_social_6']!="") {           
		                $out.='<div class="member_lnk">';
			                if (isset($data['member_social_6_link']) && $data['member_social_6_link']!="")
			                    $in_link=$data['member_social_6_link'];
			                else
			                    $in_link="";
		                    $out.='<a href="'.$in_link.'" target="_blank">';
		                        $out.='<div class="pixia_socialink '.prk_social_icon($data['member_social_6']).'">';//prk_social_icon
		                        $out.='</div>';
		                    $out.='</a>';
		                $out.='</div>';
		            }
		            $out.='<div class="clearfix"></div>';
		            $out.='</div>';
	            $out.='</div>';
	            echo $out;
	            ?>
                  </div>
                  	</header>	
                    <div class="padded_text">
                        <div class="on_colored">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php 
						if (isset($pixia_frontend_options['related_blog']) && $pixia_frontend_options['related_blog']=="yes")
						{
							?>
							<div class="clearfix"></div>
							<div class="simple_line"></div>
							<div class="padded_text post_meta_single twelve columns">
								<div class="navigation-previous">
									<div id="previous_button">
										<?php 
										previous_post_link_plus( array(
											'in_same_cat' => true,
											'format' => '%link',
											'link' => '<div class="prev_link_portfolio">
												<div class="tr_wrapper zero_index" style="height:20px;">
													<div class="submenu_arrow_lport pirenko_tinted">
														<i class="clearer_inactive_color pixia_fa-chevron-left"></i>
													</div>
												</div>
											</div>
											<div class="after_icon">%title</div>'
											) );
										?>
									</div>
								</div><!-- navigation_previous -->
								<div class="navigation-next right_floated">
									<div id="next_button">
										<?php next_post_link_plus( array(
											'in_same_cat' => true,
											'format' => '%link',
											'link' => '<div class="next_link_portfolio">
											  <div class="left_floated" style="padding-right:13px;">
											  %title
											  </div>
										  </div>
										  <div class="left_floated">
				  <div class="tr_wrapper zero_index" style="height:20px;margin-left:-8px;">
												  <div class="submenu_arrow_rport pirenko_tinted">
													  <i class="clearer_inactive_color pixia_fa-chevron-right"></i>
												  </div>  
												  </div>
												  </div> '
											) );
										?>
									</div>
								</div><!-- navigation_next -->
							</div>
							<div class="clearfix"></div>
							<?php
                    	}
					?>
                    </div>
                    <div class="clearfix"></div>
                    <div id="c_wrap_single">
                    <?php 
				if (isset($pixia_frontend_options['related_blog_elast']) && $pixia_frontend_options['related_blog_elast']=="yes")
				{
					$args=array(
					  'orderby' => 'name',
					  'order' => 'ASC'
					  );
					  global $category_ids;
					$category_ids="";
					foreach((get_the_category()) as $category) 
					{
						$category_ids.= $category->slug . ', ';
					} 
					if ($category_ids!="") 
					{
						$args=array(
							'category_name'=>$category_ids,
							'post__not_in' => array($post->ID),
							'posts_per_page'=> 3,
							'orderby' => 'rand'
						);
					}
                    $loop = new WP_Query( $args );
					if ($loop->post_count>0)
					{
						?>
						<div id="related_projects">
							<h3><header_font>
								<?php _e($pixia_frontend_options['related_text_blog'], 'pixia'); ?>
                          	</header_font></h3>
						</div>
                        <div class="simple_line_onbg"></div>
						<div id="carousel_single" class="es-carousel-wrapper">
							<div class="es-carousel">
								<ul class="">	
									<?php 
										
									$l_count=1;
									while ( $loop->have_posts() ) : $loop->the_post();
										if($l_count % 3 == 0)
											$p_class="third_related";
										else
											$p_class="";
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
										$image[0] = get_image_path($image[0]);
										if ($image[0]!="")
										{
											?>
											<li class="related_post <?php echo $p_class; ?>">
												<a href="<?php the_permalink(); ?>">
													<div class="related_fader_grid">
													</div>
													<div class="related_single_title">
														<?php the_title(); ?>
														<div class="inner_skills special_italic_medium">
															<?php 
																$virgul=0;
																foreach((get_the_category()) as $category) 
																{
																	if ($virgul==0)
																		echo $category->cat_name;
																	else
																		echo ', '.$category->cat_name;
																	$virgul++;
																} 
															?>
														</div>
													</div>
													<?php
														$pixia_frontend_options['portfolio_bw']="no";
														if ($pixia_frontend_options['portfolio_bw']=="no")
														{
															$vt_image = vt_resize( '', $image[0] , 700, 463, true );
															?>
															<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img" />
															<?php
														}
														else
														{
															?>
															<img src="<?php echo get_template_directory_uri(); ?>/inc/modules/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=700&h=463&f=2" class="custom-img<?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" />
															<?php
														}
														?>
												</a>
											</li>
										<?php
										$l_count++;
										}
										
									endwhile;
									//RESET MAIN LOOP
									wp_reset_postdata();
									?>
								</ul>
							</div>
						</div>
                    	<?php
					}
				}
			?>  
                  		<?php comments_template(); ?>
                  	</div>
           		</article>
        	<?php endwhile; /* End loop */ ?>
      	</div><!-- /#main -->
    	<?php pirenko_main_after(); ?>
    </div><!-- /#content -->
<?php get_footer(); ?>