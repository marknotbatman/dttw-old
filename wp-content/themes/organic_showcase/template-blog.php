<?php
/*
 *
 Template Name: Blog
 *
 * This template is used to display a blog layout from a category specified in the theme options.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */ 
 get_header(); ?>

<!-- BEGIN .twelve columns -->
<div class="twelve columns">
        
    <?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_blog'),'posts_per_page'=>of_get_option('postnumber_blog'),'paged'=>$paged)); ?>
    <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
    <?php global $more; $more = 0; ?>
    
    <div class="blog-posts">
    	<?php if(!get_post_format()) { get_template_part('format', 'standard'); } else { get_template_part('format', get_post_format()); } ?>  
    </div>  

    <?php endwhile; ?>
    
    <?php if($wp_query->max_num_pages > 1) { ?>
    	<div class="pagination">
    		<?php echo get_pagination_links(); ?>
    	</div><!-- END .pagination -->
    <?php } ?>
    
    <?php else : // do not delete ?>
    
    <div class="postarea">
        <h1 class="headline"><?php _e("Page Not Found", 'organicthemes'); ?></h1>
        <div class="article">
	        <p><?php _e("We're sorry, but the page you're looking for isn't here.", 'organicthemes'); ?></p>
	        <p><?php _e("Try searching for the page you are looking for or using the navigation in the header or sidebar", 'organicthemes'); ?></p>
        </div>
   </div>

    <?php endif; // do not delete ?>

		
<!-- END .twelve columns -->
</div>

<?php get_footer(); ?>