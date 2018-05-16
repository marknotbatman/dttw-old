<?php
/*
 *
 Template Name: Portfolio
 *
 * This template is used to display filterable portfolio posts.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */ 
 get_header(); ?>

<!-- BEGIN .twelve columns -->
<div class="twelve columns">
    
    <?php get_template_part( 'loop', 'portfolio' ); ?>
		
<!-- END .twelve columns -->
</div>

<?php get_footer(); ?>