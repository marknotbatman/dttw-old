<?php if ( has_post_thumbnail()) { ?>
	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'portfolio' ); ?></a>
<?php } else { ?>
	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/default-image.png" alt="<?php the_title(); ?>" /></a>
<?php } ?>

<!-- BEGIN .post class -->
<div <?php post_class('postarea'); ?> id="post-<?php the_ID(); ?>">

    <div class="postdate">
        <div class="month"><?php the_time(__("M", 'organicthemes')) ?></div>
        <div class="day"><?php the_time(__("j", 'organicthemes')) ?></div>
        <div class="type"><span aria-hidden="true" class="organicon-camera"></span></div>
        <span class="corner"></span>
    </div>
    
    <h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'organicthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
    
    <div class="article">
    	<?php the_content(__("Read More", 'organicthemes')); ?>
    </div>

<!-- END .post class -->
</div>