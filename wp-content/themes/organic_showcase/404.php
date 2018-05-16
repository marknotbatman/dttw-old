<?php
/*
 * The 404 error template for our theme.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */
 get_header(); ?>

<!-- BEGIN .twelve columns -->
<div class="twelve columns">
    
    <!-- BEGIN .postarea -->
    <div class="postarea">
            
        <h1 class="headline"><?php _e("Not Found, Error 404", 'organicthemes'); ?></h1>
        
        <div class="article">
        	<p><?php _e("The page you are looking for no longer exists.", 'organicthemes'); ?></p>
        </div>
    
    <!-- END .postarea -->
    </div>

<!-- END .twelve columns -->
</div>

<?php get_footer(); ?>