<?php
/*
 *
 Template Name: Archive
 *
 * This template is used to display a site archive page of all pages, posts and categories.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */ 
 get_header(); ?>

<!-- BEGIN .twelve columns -->
<div class="twelve columns">

    <!-- BEGIN .post class -->
    <div <?php post_class('postarea'); ?> id="post-<?php the_ID(); ?>">

        <h1 class="headline"><?php the_title(); ?></h1>		
		
		<!-- BEGIN .article -->
		<div class="article">
		
	        <div class="archive-column">
	            <h4><?php _e("By Page:", 'organicthemes'); ?></h4>
	            <ul><?php wp_list_pages('title_li='); ?></ul>
	
	            <h4><?php _e("By Month:", 'organicthemes'); ?></h4>
	            <ul><?php wp_get_archives('type=monthly'); ?></ul>	
	
	            <h4><?php _e("By Category:", 'organicthemes'); ?></h4>
	            <ul><?php wp_list_categories('sort_column=name&title_li='); ?></ul>	
	        </div>		
	
	        <div class="archive-column last">
	            <h4><?php _e("By Post:", 'organicthemes'); ?></h4>
	            <ul><?php wp_get_archives('type=postbypost&limit=100'); ?></ul>
	        </div>
	    
	    <!-- END .article -->
        </div>	            
	
	<!-- END .post class -->
    </div>

<!-- END .twelve columns -->
</div>

<?php get_footer(); ?>