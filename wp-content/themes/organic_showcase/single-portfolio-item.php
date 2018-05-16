<?php
/*
 * The post template for our theme.
 *
 * Displays content when viewing a single post.
 *
 * @package Showcase
 * @since Showcase 3.0
 *
 */
 get_header(); ?>

<?php $meta_box = get_post_custom($post->ID); $video = $meta_box['custom_meta_video'][0]; ?>

<!-- BEGIN .twelve columns -->
<div class="twelve columns">

	<?php if(of_get_option('display_feature_post') == '1') { ?>
		<?php if ( get_post_meta($post->ID, 'portfolio_video', true) ) : ?>
			<div class="feature-vid"><?php echo get_post_meta(get_the_ID(), 'portfolio_video', true); ?></div>
		<?php else: ?>
			<?php if ( has_post_thumbnail()) { ?>
				<div class="feature-img"><?php the_post_thumbnail( 'page-img' ); ?></div>
			<?php } ?>
		<?php endif; ?>
	<?php } ?>
  	
  	<!-- BEGIN .post class -->
  	<div <?php post_class('postarea'); ?> id="post-<?php the_ID(); ?>">
    
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<h1 class="headline"><?php the_title(); ?></h1>
		
		<div class="article">
			<?php the_content(); ?>
		</div>
		
		<?php wp_link_pages(array(
			'before' => '<p class="page-links"><span class="link-label">' . __('Pages:') . '</span>',
			'after' => '</p>',
			'link_before' => '<span>',
			'link_after' => '</span>',
			'next_or_number' => 'next_and_number',
			'nextpagelink' => __('Next'),
			'previouspagelink' => __('Previous'),
			'pagelink' => '%',
			'echo' => 1 )
		); ?>
		
		<div class="post-navigation">
			<div class="previous-post"><?php previous_post_link('&larr; %link'); ?></div>
			<div class="next-post"><?php next_post_link('%link &rarr;'); ?></div>
		</div><!-- .post-navigation -->
      
	    <!-- BEGIN .postmeta -->
		<div class="postmeta">
		
			<p class="meta-text align-left"><i class="icon-reorder"></i> <?php _e("Category:", 'organicthemes'); ?> <?php the_category(', '); ?></p> 
			<p class="meta-text align-right text-right"><i class="icon-tags"></i> <?php _e("Tagged:", 'organicthemes'); ?> <?php the_tags(''); ?></p>
		
		    <?php if(of_get_option('display_social_post') == '1') { ?>
			<div class="social">
				<div class="pin-btn">
					<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $feat_image; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
				</div>
				<div class="like-btn">
				  	<div class="fb-like" href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
				</div>
				<div class="tweet-btn">
					<a href="http://twitter.com/share" class="twitter-share-button"
					data-url="<?php the_permalink(); ?>"
					data-via="<?php echo of_get_option('twitter_user'); ?>"
					data-text="<?php the_title(); ?>"
					data-related=""
					data-count="horizontal"><?php _e("Tweet", 'organicthemes'); ?></a>
				</div>
				<div class="plus-btn">
					<g:plusone size="medium" annotation="bubble" href="<?php the_permalink(); ?>"></g:plusone>
				</div>
			</div>
			<?php } ?>
		
		<!-- END .postmeta -->
		</div>

		<?php comments_template('',true); ?>
	      
		<div class="clear"></div>       
    
    <!-- END .post class -->
    </div>
    
    <?php endwhile; else: ?>
    <p><?php _e("Sorry, no posts matched your criteria.", 'organicthemes'); ?></p>
    <?php endif; ?>
 
<!-- END .twelve columns -->
</div>

<?php get_footer(); ?>