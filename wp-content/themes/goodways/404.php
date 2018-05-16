<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Goodways
 * @since Goodways 1.0
 */

get_header(); ?>

        <!-- MAIN CONTENT -->
        <div id="outermain">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                    <div class="main">
                    <p>
                    <?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'templatesquare' ); ?>
                    </p>
                    <?php get_template_part('searchform'); ?>
                    </div>
                    
                    <div class="clear"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->
    
<?php get_footer(); ?>