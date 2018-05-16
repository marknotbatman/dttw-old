<?php
/*
 * The search template for our theme.
 *
 * Displays posts as the result of a search.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */
 get_header(); ?>

<!-- BEGIN .twelve columns -->
<div class="twelve columns">
        
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <!-- BEGIN .blog-posts -->
    <div class="blog-posts">
    
    	<?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>
    	
    	<?php if ( $video ) : ?>
    			<div class="feature-vid"><?php echo $video; ?></div>
    	<?php else: ?>
    	    <?php if ( has_post_thumbnail()) { ?>
    	    	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'portfolio' ); ?></a>
    	    <?php } ?>
    	<?php endif; ?>
    	
    	<!-- BEGIN .post class -->
    	<div <?php post_class('postarea'); ?> id="post-<?php the_ID(); ?>">
    	
    	    <div class="postdate">
    	        <div class="month"><?php the_time(__("M", 'organicthemes')) ?></div>
    	        <div class="day"><?php the_time(__("j", 'organicthemes')) ?></div>
    	        <div class="type"><span aria-hidden="true" class="organicon-search"></span></div>
    	        <span class="corner"></span>
    	    </div>
    	    
    	    <h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
    	    
    	    <div class="article">
    	    	<?php the_excerpt(); ?>
    	    </div>
    	
    	<!-- END .post class -->
    	</div>
    
    <!-- END .blog-posts -->
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