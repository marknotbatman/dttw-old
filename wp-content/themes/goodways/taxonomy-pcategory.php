<?php
/**
 * The template for displaying portfolio archive.
 *
 * @package WordPress
 * @subpackage Goodways
 * @since Goodways 1.0
 */

get_header(); ?>

        <!-- MAIN CONTENT -->
        <div id="outermain" class="inner">
        	<div class="container">
                <section id="maincontent" class="twelve columns">
                
                    <?php 
                    rewind_posts();
                    get_template_part( 'loop', 'portfolio' );
                    ?>
                 
                  <div class="clear"></div><!-- clear float --> 
                </section><!-- maincontent -->
            </div>
        </div>
        <!-- END MAIN CONTENT -->


<?php get_footer(); ?>
