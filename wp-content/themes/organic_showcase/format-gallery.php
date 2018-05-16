<!-- BEGIN .slideshow slideshow-page -->
<div class="slideshow slideshow-page"> 
    
	<div class="flexslider loading" data-speed="<?php echo of_get_option('transition_interval'); ?>">
		<ul class="slides">
		
			<?php $data = array(
		    	'post_parent'		=> $id,
		    	'post_type' 		=> 'attachment',
		    	'post_mime_type' 	=> 'image',
		    	'order'         	=> 'ASC',
		    	'orderby'	 		=> 'menu_order',
		        'numberposts' 		=> -1
			); ?>
			
			<?php 
			$images = get_posts($data); foreach( $images as $image ) { 
				$imageurl = wp_get_attachment_url($image->ID);
				echo '<li><img src="'.$imageurl.'" /></li>' . "\n";
			} ?>

		</ul>
	</div>
	
<!-- END .slideshow slideshow-page -->
</div>

<!-- BEGIN .post class -->
<div <?php post_class('postarea'); ?> id="post-<?php the_ID(); ?>">

    <div class="postdate">
        <div class="month"><?php the_time(__("M", 'organicthemes')) ?></div>
        <div class="day"><?php the_time(__("j", 'organicthemes')) ?></div>
        <div class="type"><span aria-hidden="true" class="organicon-pictures"></span></div>
        <span class="corner"></span>
    </div>
    
    <h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
    
    <div class="article">
    	<?php the_content(__("Read More", 'organicthemes')); ?>
    </div>

<!-- END .post class -->
</div>