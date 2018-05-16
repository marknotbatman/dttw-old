<?php  
    $terms = get_terms("tag-portfolio");  
    $count = count($terms);  
    echo '<ul id="portfolio-filter">';  
    echo '<li><a href="javascript:void(0)" data-filter="*" title="">All</a></li>';  
        if ( $count > 0 )  
        {     
            foreach ( $terms as $term ) {  
                $termname = strtolower($term->name);  
                $termname = str_replace(' ', '-', $termname);  
                echo '<li><a href="javascript:void(0)" data-filter=".'.$termname.'" title="" rel="'.$termname.'">'.$term->name.'</a></li>';  
            }  
        }  
    echo "</ul>";  
?> 

<?php $wp_query = new WP_Query(array('post_type' => 'portfolio-item', 'posts_per_page'=>of_get_option('postnumber_portfolio'), 'paged'=>$paged)); $count =0; ?>  

<!-- BEGIN .portfolio -->
<div class="portfolio <?php if (of_get_option('portfolio_columns') == 'two') { ?>portfolio-half<?php } if (of_get_option('portfolio_columns') == 'three') { ?>portfolio-third<?php } ?>">
	
	<!-- BEGIN .row -->
	<ul id="portfolio-list" class="row">
	      
		<?php if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		<?php $terms = get_the_terms( $post->ID, 'tag-portfolio' );                              
			if ( $terms && ! is_wp_error( $terms ) ) : $links = array();  
				foreach ( $terms as $term ) {  
					$links[] = $term->name;  
				}  
				$links = str_replace(' ', '-', $links);   
				$tax = join( " ", $links );       
			else : $tax = ''; endif; 
		?>
        
        <!-- BEGIN .portfolio-item -->
        <li class="portfolio-item <?php if (of_get_option('portfolio_columns') == 'one') { ?>single<?php } if (of_get_option('portfolio_columns') == 'two') { ?>half<?php } if (of_get_option('portfolio_columns') == 'three') { ?>third<?php } ?> <?php echo strtolower($tax); ?>" data-filter="<?php echo strtolower($tax); ?>">
        
        	<!-- BEGIN .post-holder -->
	        <div class="post-holder">
	        
				<?php if ( get_post_meta($post->ID, 'portfolio_video', true) ) : ?>
					<div class="feature-vid"><?php echo get_post_meta(get_the_ID(), 'portfolio_video', true); ?></div>
				<?php else: ?>
					<?php if ( has_post_thumbnail()) { ?>
						<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'portfolio' ); ?></a>
					<?php } ?>
				<?php endif; ?>
	            
	            <?php if(of_get_option('display_portfolio_info_page') == '1') { ?>
	            <div class="excerpt">              
	                <h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h2>
	                <?php the_excerpt(); ?>
	                <a class="more-link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php _e("Continue Reading", 'organicthemes'); ?></a>
	                <?php if ( get_post_meta($post->ID, 'portfolio_link', true) ) : ?>
	                	<a class="more-link" href="<?php echo get_post_meta(get_the_ID(), 'portfolio_link', true); ?>" target="_blank"><?php _e("Project Link", 'organicthemes'); ?></a>
	                <?php endif; ?>
	            </div><!-- END .information -->
	            <?php } ?>
	        
	        <!-- END .post-holder -->
	        </div>
        
        <!-- END .portfolio-item -->
        </li>
						
		<?php endwhile; ?>
        
    </ul><!-- END #portfolio-list .row -->
    
    <div class="row"><!-- BEGIN .row -->
     			
 		<?php if($wp_query->max_num_pages > 1) { ?>
 			<div class="pagination">
 				<?php echo get_pagination_links(); ?>
 			</div><!-- END .pagination -->
 		<?php } ?>
 			
 		<?php else: ?>
     		
 	</div><!-- END .row -->
 	
 	<div class="row"><!-- BEGIN .row -->
 	
		<!-- BEGIN .postarea -->
        <div class="postarea">

        	<h1 class="headline"><?php _e("No Posts Found", 'organicthemes'); ?></h1>
        	<p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
        
        <!-- END .postarea -->
        </div>
     	        
     	<?php endif; ?>
     	<?php wp_reset_postdata(); ?>
     		
	</div><!-- END .row -->

<!-- END .portfolio -->		
</div>