<?php 
/*
Template Name: Portfolio Page - Masonry
*/
?>
<?php 
	get_header(); 
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include(ABSPATH . 'wp-content/plugins/color-manager-pixia/style_header.php');	
	}
	$clearer_inactive_color=alter_brightness($pixia_frontend_options['inactive_color'],40);
	$data = get_post_meta( $post->ID, '_custom_meta_portfolio_template', true );
	$default_margin=0;
	if (isset($data['pixia_th_margin']) && $data['pixia_th_margin']!="")
		$default_margin=$data['pixia_th_margin'];
	$posts_nr=999;
	if (isset($data['alchemy_posts_nr']) && $data['alchemy_posts_nr']!="")
		$posts_nr=$data['alchemy_posts_nr'];
?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?> top_0">
      	<div id="main" class="<?php echo FULLWIDTH_CLASSES; ?> right_0 foliopage_sl" role="main">
            <ul id="extra_filter">
            	<div class="divider_tp"></div>
            </ul>
            <?php
				$inside_filter="";
				$make_bw="no";
				$make_lbox="no";
				if (!empty($data)) {
					if (isset($data['pixia_filter']) && $data['pixia_filter']=="yes")
					{
						$cats_counter=0;
						foreach ($data as $childs)
						{
							//ADD THE CATEGORIES TO THE FILTER
							if ($childs!='yes')
							{
								$inside_filter.=$childs.", ";
								$cats_counter++;
							}
						}
					}
					if (isset($data['pixia_bw']) && $data['pixia_bw']=="yes")
					{
						$make_bw="yes";
					}
					if (isset($data['pixia_lbox'])) {
						if ($data['pixia_lbox']=="yes") {
							$make_lbox="yes";
							$magnifier_class="magnifique";
							$parent_class=" big_magni";
						}
						if ($data['pixia_lbox']=="multiple") {
							$make_lbox="yes";
							$magnifier_class="magnifique_single";
							$parent_class=" single_magnis";
						}
					}
				}
			?>
            
		<?php
		$my_query = new WP_Query();
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array( 
			'post_type' => 'pirenko_portfolios', 
			'paged' => $paged,
			'posts_per_page' => $posts_nr,
			'pirenko_skills'=>$inside_filter,
			//'orderby' => 'rand'
			);
			//'category_name'=>$cat_selector,
		$my_query->query($args);
        if ($my_query->have_posts()) : 
						$ins=0;
						echo '<div id="folio_masonry" style="margin-top:'.$default_margin.'px;margin-right:-'.$default_margin.'px;" class="'.$parent_class.'">';
							while ($my_query->have_posts()) : $my_query->the_post(); 
								$skills_links=array();
								$skills_names=array();
								$skills_yo="";
								$skills_output="";
								$terms = get_the_terms ($post->ID, 'pirenko_skills');
								if (!empty($terms))
								{
									foreach ($terms as $term) {
										$skills_links[] = $term->slug;
										$skills_names[] = $term->name;
									}
								
									$skills_yo = join(" ", $skills_links);
									$skills_output = join(", ", $skills_names);
								}
							?>
						<div id="post-<?php the_ID(); ?>" class="portfolio_entry_li <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>" style="margin-bottom:<?php echo $default_margin; ?>px;">
							<?php 
							if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$image[0] = get_image_path($image[0]);
								$p_photo_image=wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								
							else :
								//THERE'S NO FEATURED IMAGE
							endif; 
							$meta = get_post_meta( $post->ID, 'key', true );
							global $simple_mb;
							$data=$simple_mb->the_meta();
							if(empty($data)) {
								$data=array();
							}
							if (!isset($data['skip_featured']))
								$data['skip_featured']=0;
							$vid_cl="";
							if ($data['skip_featured']==1) {
								//CHECK IF THERE'S A SECOND IMAGE
								if ($data['image_2']!="")
								{
									//CHECK IF IT'S AN IMAGE OR A VIDEO
									if (substr($data['image_2'],0,6)=="http:/" || substr($data['image_2'],0,7)=="https:/")
									{
										$p_photo_image[0]=$data['image_2'];
									}
									else
									{
										$p_photo_image[0]=get_iframe_src($data['image_2']);
										$vid_cl=" mfp-iframe";
									}
								}
							}
							if (!isset($data['skip_to_external']))
								$data['skip_to_external']=0;
							if ($data['skip_to_external']==1) {
								//CHECK IF PROJECT URL IS SET
								if (!isset($data['ext_url']))
									$data['ext_url']=get_permalink();
								//ADD HTTP PREFIX IF NEEDED
								if (substr($data['ext_url'],0,7)!="http://")
									$data['ext_url']="http://".$data['ext_url'];
								$href_val=$data['ext_url'];
							}
							else {
								if ($make_lbox=="no") {
									$href_val=get_permalink();
								}
								else {
									$href_val=$p_photo_image[0];
								}
							}
							?>
							<a href="<?php echo $href_val; ?>"<?php if (($make_lbox=="yes") && $data['skip_to_external']==0) {echo ' class="'.$magnifier_class.$vid_cl.'"';} if ($data['skip_to_external']==1){echo ' target="_blank"';}; ?> data-title="<?php echo get_the_title(); ?>">
								<div class="grid_image_wrapper">
                                	<div class="grid_single_title" id="grid_title-<?php the_ID(); ?>">
                             			<span><?php the_title(); ?></span>
                                        <?php if ($skills_output!="")
										{
											?>
                                            <div class="inner_skills special_italic_medium">
                                                <?php echo $skills_output; ?>
                                            </div>
                                            <?php
										}
										?>
                          			</div><!-- grid_single_title -->
                                	<div class="grid_colored_block">
									</div>
									<?php 
                                    if (has_post_thumbnail( $post->ID ) ){
										if ($make_bw=="no") {
											$vt_image = vt_resize( '', $image[0] , 400, 0, false );
											?>
											<img src="<?php echo $vt_image['url']; ?>" id="home_fader-<?php the_ID(); ?>" int_id="<?php the_ID(); ?>" class="custom-img grid_image" alt="" />
											<?php
										}
										else {
											?>
											<img src="<?php echo get_template_directory_uri(); ?>/inc/modules/timthumb/timthumb.php?src=<?php echo $image[0]; ?>&w=400&f=2" class="custom-img grid_image<?php if ($pixia_frontend_options['blog_bw']=="yes") echo " desaturated_image"; ?>" alt="" />
											<?php
										}
                                    }
                                    ?>
                                </div>
                                </a>
                                <?php
									if ($magnifier_class=="magnifique_single") {
										//PLACE THE OTHER NINETEEN IMAGES
                                        for ($count=2;$count<21;$count++) {
                                            if (isset($data['image_'.$count])) {
                                                if ($data['image_'.$count]!="" && $data['image_'.$count]!="A") {
                                                  	if (substr($data['image_'.$count],0,6)=="http:/" || substr($data['image_'.$count],0,7)=="https:/")
                                                    {
		                                           		echo '<a href="'.$data['image_'.$count].'" class="hide_now magnifique_single">';
		                                            	echo '<img src="'.$data['image_'.$count].'" class="grid_image" alt="" />';
		                                            	echo '</a>';
		                                            }
		                                            else {
	                                                	echo '<a href="'.get_iframe_src($data['image_2']).'" class="magnifique_single hide_now mfp-iframe">';
                                                        echo '</a>';
	                                                } 
                                            	}
                                            }
                                        }
                                    }
								?>
                                <img src="<?php echo $vt_image['url']; ?>" style="display:none;" />
							</div>
						<?php $ins++; ?>
					<?php 
						endwhile; 
						echo "</div>";
						//SHOW BUTTON TO SHOW MORE POSTS ONLY IF NEEDED
						if ($paged!=$my_query->max_num_pages)
						{
							?>
						  
							<div id="next_portfolio_masonry" class="prk_next_wrapper">
									<div class="navigation twelve">	
										<div class="next-posts">
										<div id="nbr_helper" pir_curr="<?php echo $paged; ?>" pir_max="<?php echo $my_query->max_num_pages; ?>">
											<h4><div id="pir_loader_wrapper" class="cf">
									<img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="pir_loader">
									</div>
												<?php next_posts_link('',$my_query->max_num_pages); ?>
												
											</h4>
										</div>
									</div>	
								</div><!-- navigation -->
							</div><!-- entries_navigation --> 
							<div id="no_more" class="row four columns centered special_italic less_margin">
                                <div class="prk_titlify_father" data-offset="12">
                                    <div class="widget-title prk_titlify">
                                        <?php 
                                        	if (!isset($pixia_frontend_options['no_more_text']))
                                        		$pixia_frontend_options['no_more_text']="No more posts to show";
                                        	echo($pixia_frontend_options['no_more_text']); 
                                        ?>
                                    </div>
                                </div>
                            </div>
							<div class="clearfix show_much_later"></div>
							<?php
						} 
					?>
				<?php else : 
					echo '<style type="text/css">
					body
					{
						overflow:hidden !important;
					}
					</style>';
					?>
					<span class="colored_bg" style="padding-top:40%;height:1500px;text-align:center;display: block;"><h2>Ooops!</h2><br /><h4>This is a portfolio page, but there are still no items to display.</h4><br />Add some Portfolio Items from the Wordpress Dashboard by clicking the respective button on the left menu.<br /></span>
				<?php endif; 
        ?>
      	</div><!-- /#main -->
	</div><!-- /#content -->
<?php get_footer(); ?>