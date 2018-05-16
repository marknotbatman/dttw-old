<?php
/*
 * The footer for our theme.
 *
 * This template is used to generate the footer for the theme.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */
 ?>

<!-- END .row (header.php) -->
</div>

<div class="clear"></div>

<!-- BEGIN .row -->
<div class="row">
	
	<!-- BEGIN #footer -->
	<div id="footer">
	
	    <div class="footer left">
	        <p><?php _e("Copyright", 'organicthemes'); ?> &copy; <?php echo date(__("Y", 'organicthemes')); ?> &middot; <?php _e("All Rights Reserved", 'organicthemes'); ?> &middot; <?php bloginfo('name'); ?> <br />
	        <a href="http://www.organicthemes.com/themes/showcase-theme/" target="_blank"><?php _e("Showcase Theme v3", 'organicthemes'); ?></a> <?php _e("by", 'organicthemes'); ?> <a href="http://www.organicthemes.com" target="_blank"><?php _e("Organic Themes", 'organicthemes'); ?></a> &middot; <a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><?php _e("RSS Feed", 'organicthemes'); ?></a> &middot; <?php wp_loginout(); ?></p>
	    </div>
	    
	    <div class="footer right">
	    	<ul class="social-icons">
	    		<?php if (of_get_option('facebook_link') && of_get_option('facebook_link') != '') { ?>
	    			<li><a class="link-facebook" href="<?php echo of_get_option('facebook_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-facebook"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('twitter_link') && of_get_option('twitter_link') != '') { ?>
	    			<li><a class="link-twitter" href="<?php echo of_get_option('twitter_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-twitter"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('linkedin_link') && of_get_option('linkedin_link') != '') { ?>
	    			<li><a class="link-linkedin" href="<?php echo of_get_option('linkedin_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-linkedin"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('dribbble_link') && of_get_option('dribbble_link') != '') { ?>
	    			<li><a class="link-dribbble" href="<?php echo of_get_option('dribbble_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-dribbble"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('skype_link') && of_get_option('skype_link') != '') { ?>
	    			<li><a class="link-skype" href="<?php echo of_get_option('skype_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-skype"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('plus_link') && of_get_option('plus_link') != '') { ?>
	    			<li><a class="link-google" href="<?php echo of_get_option('plus_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-googleplus"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('pinterest_link') && of_get_option('pinterest_link') != '') { ?>
	    			<li><a class="link-pinterest" href="<?php echo of_get_option('pinterest_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-pinterest"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('github_link') && of_get_option('github_link') != '') { ?>
	    			<li><a class="link-github" href="<?php echo of_get_option('github_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-github"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('instagram_link') && of_get_option('instagram_link') != '') { ?>
	    			<li><a class="link-instagram" href="<?php echo of_get_option('instagram_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-instagram-2"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('youtube_link') && of_get_option('youtube_link') != '') { ?>
	    			<li><a class="link-youtube" href="<?php echo of_get_option('youtube_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-youtube"></span></a></li>
	    		<?php } ?>
	    		<?php if (of_get_option('email_link') && of_get_option('email_link') != '') { ?>
	    			<li><a class="link-email" href="mailto:<?php echo of_get_option('email_link'); ?>" target="_blank"><span aria-hidden="true" class="organicon-envelop"></span></a></li>
	    		<?php } ?>
	    	</ul>
	    </div>
	
	<!-- END #footer -->
	</div>

<!-- END .row -->
</div>

<!-- END .container -->
</div>

<!-- END #wrap -->
</div>

<?php do_action('wp_footer'); ?>

</body>

</html>