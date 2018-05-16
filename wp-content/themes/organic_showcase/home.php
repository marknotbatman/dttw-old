<?php
/*
 * This template displays the homepage content, and can be configured in the theme options.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */
 get_header(); ?>

<!-- BEGIN .twelve columns -->
<div class="twelve columns">
	
	<!-- BEGIN .slideshow -->
	<div class="slideshow">
	        	
	    <!-- BEGIN .flexslider -->
	    <div class="flexslider loading" data-speed="<?php echo of_get_option('transition_interval'); ?>">
	    
	    	<!-- BEGIN .slides -->
	    	<ul class="slides">
	    		<?php $slider = new WP_Query(array('cat'=>of_get_option('category_slideshow_home'),'posts_per_page'=>of_get_option('postnumber_slideshow_home'))); ?>
	    		<?php if($slider->have_posts()) : while($slider->have_posts()) : $slider->the_post(); ?>
	    		<?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
	    		<?php global $more; $more = 0; ?>
	    		
	    		<li>

        			<?php if ( $video ) : ?>
        			    <div class="feature-vid"><?php echo $video; ?></div>
        			<?php else: ?>
        			    <?php if ( has_post_thumbnail()) { ?>
        				    <a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'slide' ); ?></a>
        			    <?php } else { ?>
        			    	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark"><img src="<?php bloginfo('template_directory'); ?>/images/default-image.png" alt="<?php the_title(); ?>" /></a>
        			    <?php } ?>
        			<?php endif; ?>

    				<div class="slide-info">
	    				<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_title(); ?></a></h2>
	    				<?php the_excerpt(); ?>
	    		
    				</div>

	    		</li>
	    		
	    		<?php endwhile; ?>
	    		<?php endif; ?>
	    		<?php wp_reset_postdata(); ?>
	    	<!-- END .slides -->
	    	</ul>
	    	
	    <!-- END .flexslider -->
	    </div>
	
	<!-- END #slideshow -->
	</div>
	
	<?php if(of_get_option('display_portfolio_home') == '1') { ?>
	
		<?php get_template_part( 'loop', 'portfolio' ); ?>
		
	<?php } ?>

<!-- END .twelve columns -->
</div>

<?php get_footer(); ?>