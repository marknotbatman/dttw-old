<?php remove_filter('the_excerpt', 'wpautop'); ?>

<!-- BEGIN .post class -->
<div <?php post_class('postarea'); ?> id="post-<?php the_ID(); ?>">

    <div class="postdate">
        <div class="month"><?php the_time(__("M", 'organicthemes')) ?></div>
        <div class="day"><?php the_time(__("j", 'organicthemes')) ?></div>
        <div class="type"><span aria-hidden="true" class="organicon-quotes-right"></span></div>
        <span class="corner"></span>
    </div>
    
	<blockquote>
		<span aria-hidden="true" class="organicon-quotes-left"></span>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_excerpt(); ?></a>
		<span aria-hidden="true" class="organicon-quotes-right"></span>
	</blockquote>
	
<!-- END .post class -->
</div>

