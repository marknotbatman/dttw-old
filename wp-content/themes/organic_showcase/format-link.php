<!-- BEGIN .post class -->
<div <?php post_class('postarea'); ?> id="post-<?php the_ID(); ?>">

	<div class="postdate">
	    <div class="month"><?php the_time(__("M", 'organicthemes')) ?></div>
	    <div class="day"><?php the_time(__("j", 'organicthemes')) ?></div>
	    <div class="type"><span aria-hidden="true" class="organicon-link "></span></div>
	    <span class="corner"></span>
	</div>
	
	<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" target="_blank"><?php the_title(); ?> &rarr; </a></h2>
    
    <?php if ( !empty( $post->post_excerpt ) ) { ?>
    	<div class="article">
        	<?php the_excerpt(); ?>	
        </div>
    <?php } ?>

<!-- END .post class -->
</div>

