<?php
/*
 * This page template is used to display category post indexes.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */
 get_header(); ?>

<!-- BEGIN .twelve columns -->
<div class="twelve columns">

	<!-- BEGIN .portfolio -->
	<div class="portfolio <?php if (of_get_option('category_columns') == 'one') { ?>portfolio-single<?php } if (of_get_option('category_columns') == 'two') { ?>portfolio-half<?php } if (of_get_option('category_columns') == 'three') { ?>portfolio-third<?php } ?>">
									
		<!-- BEGIN .row -->
		<div class="row <?php if (of_get_option('category_columns') == 'two') { ?>holder-half<?php } if (of_get_option('category_columns') == 'three') { ?>holder-third<?php } ?>">
					
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		    <?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
		    
			<!-- BEGIN .single | .half | .third -->
		    <div class="<?php if (of_get_option('category_columns') == 'one') { ?>single<?php } if (of_get_option('category_columns') == 'two') { ?>half<?php } if (of_get_option('category_columns') == 'three') { ?>third<?php } ?>">
		            
				<!-- BEGIN .portfolio-item -->
		        <div class="portfolio-item">
		        
		        	<!-- BEGIN .post class -->
		        	<div <?php post_class('post-holder'); ?> id="post-<?php the_ID(); ?>">
		            
			            <?php if ( $video ) : ?>
			            		<div class="feature-vid"><?php echo $video; ?></div>
			            <?php else: ?>
				            <?php if ( has_post_thumbnail()) { ?>
				            	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'portfolio' ); ?></a>
				            <?php } else { ?>
				            	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/default-image.png" alt="<?php the_title(); ?>" /></a>
				            <?php } ?>
				        <?php endif; ?>
			            
			            <?php if(of_get_option('display_portfolio_info_cat') == '1') { ?>
			            <div class="excerpt">              
			                <h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
			                <?php the_excerpt(); ?>
			               
			            </div><!-- END .excerpt -->
			            <?php } ?>
		            
		            <!-- END .post class -->
		            </div>
			     
			     <!-- END .portfolio-item -->
			     </div>
			     
			<!-- END .single | .half | .third -->     
			</div>
										
			<?php endwhile;  ?>
			
		</div><!-- END .row -->

		<div class="row"><!-- BEGIN .row -->
				
			<?php if($wp_query->max_num_pages > 1) { ?>
				<div class="pagination">
					<?php echo get_pagination_links(); ?>
				</div><!-- END .pagination -->
			<?php } ?>
				
			<?php else: ?>
		
		</div><!-- END .row -->
	
	</div><!-- END .portfolio -->
	
	<!-- BEGIN .portfolio -->
	<div class="portfolio">
		
		<!-- BEGIN .row -->
		<div class="row">
		
			<!-- BEGIN .postarea -->
	        <div class="postarea">
	
	        	<h1 class="headline"><?php _e("No Posts Found", 'organicthemes'); ?></h1>
	        	<p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
	        
	        <!-- END .postarea -->
	        </div>
		        
			<?php endif; ?>
			
		</div><!-- END .row -->
	
	<!-- END .portfolio -->
	</div>

<!-- END .twelve columns -->
</div>

<?php get_footer(); ?>