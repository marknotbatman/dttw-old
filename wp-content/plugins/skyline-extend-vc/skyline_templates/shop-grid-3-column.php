<?php // WP_Query arguments$args = array (	'post_type'              => 'product',	'post_status'            => 'publish',	'posts_per_page'         => esc_attr($shop_number),	'orderby'                => esc_attr($shop_order),	'ignore_sticky_posts'    => true,	'order'                  => esc_attr($shop_orderby),);// The Query$query = new WP_Query( $args );$i = 0; ?><div class="row blog grid-3column shop"><?php// The Loopif ( $query->have_posts() ) {	while ( $query->have_posts() ) {		$query->the_post(); ?>	<?php 	$postid = get_the_ID();	$url = wp_get_attachment_image_src( get_post_thumbnail_id($postid), 'blog-posts-small' );?><?php $permalink =  esc_url( get_permalink() );?><?php  $i++;								if ($i == '3' OR $i == '6' OR $i == '9' OR $i == '12' OR $i == '15') { $newrow = '</div><div class="row grid-3column shop blog">';							} else {							$newrow = '';							} ?><?php  if ($url == "") { ?><div class="col-sm-4"><a href="<?php echo esc_url($permalink);?>"><div class="img-wrapper"><div class="square shop-img" style="background-color: rgba(0,0,0,0.5);"><div class="hover-effect"></div>					  </div></div></a><?php } else { ?><div class="col-sm-4"><a href="$permalink"><div class="img-wrapper"><div class="square shop-img" style="background-image: url('<?php echo esc_url($url[0]);?>');"><div class="hover-effect"></div>					  </div></div></a><?php } ?><div class="blog-text-wrapper woocommerce"><h3 style="margin-bottom: 10px"><a href="<?php echo esc_url($permalink);?>"><?php the_title(); ?></a></h3>	<?php			/**			 * woocommerce_after_shop_loop_item_title hook			 *			 * @hooked woocommerce_template_loop_rating - 5			 * @hooked woocommerce_template_loop_price - 10			 */			do_action( 'woocommerce_after_shop_loop_item_title' );		?><p><?php echo substr(get_the_excerpt(), 0,80); ?>...</p>	<div class="add-to-cart-button" style="margin-bottom: 20px"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div></div></div><?php echo $newrow; ?><!-- End Column --><?php}?></div><?php} else {	// no posts found}// Restore original Post Datawp_reset_postdata();