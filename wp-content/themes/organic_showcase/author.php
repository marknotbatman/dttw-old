<?php
/*
 * This template is used to display author information, when clicking on an authors name.
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
	
		<!-- BEGIN .six columns -->
		<div class="six columns">
        
			<?php if(isset($_GET['author_name'])) : $curauth = get_userdatabylogin($author_name); else : $curauth = get_userdata(intval($author)); endif; ?>
			
			<h1 class="headline"><?php echo $curauth->display_name; ?></h1>
	        
	        <div class="author-avatar">
	       		<?php if(function_exists('get_avatar')) { echo get_avatar($author, '120'); } ?>
	       	</div>
	       	
	    <!-- END .six columns -->
	    </div>
        
        <!-- BEGIN .twelve columns -->
        <div class="twelve columns">
        	
            <h6><?php _e("Website:", 'organicthemes'); ?></h6>
            <p><a href="<?php echo $curauth->user_url; ?>" rel="bookmark" target="_blank"><?php echo $curauth->user_url; ?></a></p>
            
            <h6><?php _e("Email:", 'organicthemes'); ?></h6>
            <p><a href="mailto:<?php echo $curauth->user_email; ?>" rel="bookmark" target="_blank"><?php echo $curauth->user_email; ?></a></p>
            
            <h6><?php _e("Profile:", 'organicthemes'); ?></h6>
            <p><?php echo $curauth->user_description; ?></p>
            
            <h6><?php _e("Posts by", 'organicthemes'); ?> <?php echo $curauth->display_name; ?>:</h6>
            
            <ul>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; else: ?>
                <p><?php _e("No posts by this author.", 'organicthemes'); ?></p>
                <?php endif; ?>
            </ul>
        
        <!-- END .twelve columns -->
        </div>
     
    <!-- END .postarea -->
	</div>

<!-- END .twelve columns -->
</div>

<?php get_footer(); ?>