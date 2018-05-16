<?php
// NEXT AND PREVIOUS BLOG POST LINKS
function skyline_next_previous_links() {
echo "<div class=\"post_nav\"><div class=\"col-md-5 clear-small-screens\">";?>
<?php if( get_adjacent_post(false, '', true) ) : 
$previous_post = get_previous_post();
$prev_url = get_permalink(get_previous_post());
?>
    <div class="previous-img"><?php echo get_the_post_thumbnail( $previous_post->ID, 'thumb' );?></div>
	<p><a href="<?php echo esc_url($prev_url); ?>"><i class="feather-rewind"></i>&nbsp;&nbsp;&nbsp;<?php printf(esc_html__('Previous Post','skyline'));?></a></p>
	<hr/>
  <h4><?php previous_post_link('%link','%title');?></h4>
<?php else: 
    $first = new WP_Query('posts_per_page=1&order=DESC'); $first->the_post(); 
        $first_id = $first->posts[0]->ID;?>
        <div class="previous-img"><?php echo get_the_post_thumbnail( $first_id, 'thumb' );?></div>
		<p><?php echo '<a href="' . esc_url( get_permalink() ) . '">';?><i class="feather-rewind"></i>&nbsp;&nbsp;&nbsp;<?php printf(esc_html__('Previous Post','skyline'));?></a></p>
	<hr/>
        <h4><?php echo '<a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a>'; ?></h4>

<?php endif; ?>
</div><!-- End Previous Link -->
<!-- Start Next Link -->
<div class="col-md-5 col-md-offset-2 text-right clear-small-screens">
<?php if( get_adjacent_post(false, '', false) ) : 
    $next_post = get_next_post(); 
	$next_url = get_permalink(get_next_post());
		?>
	
    <div class="next-img"><?php echo get_the_post_thumbnail( $next_post->ID, 'thumb' ); ?></div>
	<p><a href="<?php echo esc_url($next_url); ?>"><?php printf(esc_html__('Next Post','skyline'));?>&nbsp;&nbsp;&nbsp;<i class="feather-fast-forward"></i></a></p>
	<hr/>
    <h4><?php next_post_link('%link','%title');?></h4>
	
<?php else: 
    $last = new WP_Query('posts_per_page=1&order=ASC'); $last->the_post();
        $last_id = $last->posts[0]->ID;?>
        <div class="next-img"><?php echo get_the_post_thumbnail( $last_id, 'thumb' );?></div>
		<p><?php echo '<a href="' . esc_url( get_permalink() ) . '">';?><?php printf(esc_html__('Next Post','skyline'));?>&nbsp;&nbsp;&nbsp;<i class="feather-fast-forward"></i></a></p>
		<hr/>
        <h4><?php echo '<a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a>'; ?></h4>
	

<?php endif; ?></div></div>
<?php wp_reset_postdata();
}
?>