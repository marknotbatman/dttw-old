<?php $post_formats2 = explode(',', $post_formats);// WP_Query argumentsif ($blog_order == "popular") {$args = array(		 'post_type' => 'post',		 'ignore_sticky_posts'    => true,		 'meta_query' => array(			  array(				  'key' => '_post_like_count',				  'value' => '0',				  'compare' => '>'			  )		  ),		 'meta_key' => '_post_like_count',		 'orderby' => 'meta_value_num',		 'order' => $blog_orderby,		 'posts_per_page' => $blog_number, 		 'tax_query' => array( array(            'taxonomy' => 'post_format',            'field' => 'slug',            'terms' => $post_formats2,            'operator' => 'NOT IN'           ) ),		 );} else {$args = array (	'post_type'              => 'post',	'post_status'            => 'publish',	'posts_per_page'         => $blog_number,	'tax_query' => array( array(            'taxonomy' => 'post_format',            'field' => 'slug',            'terms' => $post_formats2,            'operator' => 'NOT IN'           ) ),	'orderby'                => $blog_order,	'ignore_sticky_posts'    => true,	'order'                  => $blog_orderby,);}// The Query$query = new WP_Query( $args );$i = 0; ?><div class="row grid-2column blog" id="grid-2column"><?php// The Loopif ( $query->have_posts() ) {	while ( $query->have_posts() ) {$query->the_post();global $post;global $posts;// Getting image urls$img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'skyline_img-1920' );$gallery = get_post_gallery_images( $post->ID );// Get Images from page if not a gallery  $gallery_img1 = '';  $gallery_img2 = '';  ob_start();  ob_end_clean();  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);  if (!empty($matches [1] [0])) { $gallery_img1 = $matches [1] [0];}  if (!empty($matches [1] [1])) { $gallery_img2 = $matches [1] [1];}  if ($gallery_img1 == "") {	if (!empty($gallery[1])) { $gallery_img1 = $gallery[1];}}  if ($gallery_img2 == "") {	if (!empty($gallery[2])) { $gallery_img2 = $gallery[2];}}    // Get Video Link  $embed_url = '';  ob_start();  ob_end_clean();  $output = preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $post->post_content, $vid_matches );  if (!empty($vid_matches [1])) {  $embed = $vid_matches[1];  $embed_url = wp_oembed_get( $embed );  }   ?>			<?php $permalink =  esc_url( get_permalink() );?><?php  $i++;								if ($i == '2' OR $i == '4' OR $i == '6' OR $i == '8' OR $i == '10') { $newrow = '</div><div class="row grid-2column blog">';							} else {							$newrow = '';							}// Post Format Icons$post_format_string = ( get_post_format() ? get_post_format_string( get_post_format() ) : 'Standard' );// DETERMINE POST TYPE$standard_post = esc_html__('Standard Post','skyline');$image_post = esc_html__('Image Post','skyline');$gallery_post = esc_html__('Gallery Post','skyline');$video_post = esc_html__('Video Post','skyline');$audio_post = esc_html__('Audio Post','skyline');$quote_post = esc_html__('Quote Post','skyline');$link_post = esc_html__('Link Post','skyline');if ($post_format_string == "Standard") {$post_format_icon = "<div class='post-format-icon'><i class='feather-paper'></i></div><div class='post-format-text'>".$standard_post."</div>";} elseif ($post_format_string == "Image") {$post_format_icon = "<div class='post-format-icon'><i class='feather-image'></i></div><div class='post-format-text'>".$image_post."</div>";} elseif ($post_format_string == "Gallery") {$post_format_icon = "<div class='post-format-icon'><i class='feather-image'></i></div><div class='post-format-text'>".$gallery_post."</div>";} elseif ($post_format_string == "Video") {$post_format_icon = "<div class='post-format-icon'><i class='feather-video'></i></div><div class='post-format-text'>".$video_post."</div>";} elseif ($post_format_string == "Audio") {$post_format_icon = "<div class='post-format-icon'><i class='feather-volume'></i></div><div class='post-format-text'>".$audio_post."</div>";} elseif ($post_format_string == "Quote") {$post_format_icon = "<div class='post-format-icon'><i class='feather-head'></i></div><div class='post-format-text'>".$quote_post."</div>";} elseif ($post_format_string == "Link") {$post_format_icon = "<div class='post-format-icon'><i class='feather-link'></i></div><div class='post-format-text'>".$link_post."</div>";} else { $post_format_icon = "";}?>			<div class="col-md-6">          <?php// Determine Post Format$post_format_string = ( get_post_format() ? get_post_format_string( get_post_format() ) : 'Standard' );$skyline_post_format_option = get_post_meta( get_the_ID(), 'skyline_post_format_option', true );// Echo the Post Format Outputif ($post_format_string == "Standard") {	// if has featured imageif(isset($img_url[0])){	echo "<a href='".esc_url( get_permalink() )."'><div class='img-wrapper height-50'><div class='blog-img' style='background-image: url(". esc_url($img_url[0]) .");'></div></div></a>";}// end if has featured image} elseif ($post_format_string == "Image") {	// if has featured imageif(isset($img_url[0])){	echo "<a href='".esc_url( get_permalink() )."'><div class='img-wrapper height-50'><div class='blog-img' style='background-image: url(". esc_url($img_url[0]) .");'></div></div></a>";	// else use first image from the page} elseif ($img_url[0] == ""){	$img_url[0] =  $gallery_img1;	echo "<a href='".esc_url( get_permalink() )."'><div class='img-wrapper height-50'><div class='blog-img' style='background-image: url(". esc_url($img_url[0]) .");'></div></div></a>";}// end if has image} elseif ($post_format_string == "Gallery") { $car_id = rand(); if ($img_url[0] == "") {	$img_url[0] =  $gallery[0];  }?><div id="carousel-<?php echo $car_id; ?>" class="carousel slide blog-slider-carousel" data-ride="carousel">  <!-- Indicators -->  <ol class="carousel-indicators">    <li data-target="#carousel-<?php echo $car_id; ?>" data-slide-to="0" class="active"></li>    <li data-target="#carousel-<?php echo $car_id; ?>" data-slide-to="1"></li>    <li data-target="#carousel-<?php echo $car_id; ?>" data-slide-to="2"></li>  </ol>  <!-- Wrapper for slides -->  <div class="carousel-inner" role="listbox">    <div class="item active">      <a href='<?php echo esc_url($permalink); ?>'><div class='img-wrapper height-50'><div class='blog-img' style='background-image: url(<?php echo esc_url($img_url[0]);?>)'></div></div></a>    </div>    <div class="item">	<a href='<?php echo esc_url($permalink); ?>'><div class='img-wrapper height-50'><div class='blog-img' style='background-image: url(<?php echo esc_url($gallery_img1);?>)'></div></div></a>    </div> <div class="item">   <a href='<?php echo esc_url($permalink); ?>'><div class='img-wrapper height-50'><div class='blog-img' style='background-image: url(<?php echo esc_url($gallery_img2);?>)'></div></div></a>    </div>  </div></div><?php} elseif ($post_format_string == "Video") {// Check if Video Link Exists and Embed Correct Formatif (!empty($skyline_post_format_option['post_format_video_youtube'])) {$video_id_youtube = $skyline_post_format_option['post_format_video_youtube'];echo "<div class='post-video'><iframe src='".esc_url('https://www.youtube.com/embed/')."".esc_attr($video_id_youtube)."' width='1170' height='658' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";} elseif (!empty($skyline_post_format_option['post_format_video_vimeo'])) {$video_id_vimeo = $skyline_post_format_option['post_format_video_vimeo'];echo "<div class='post-video'><iframe src='".esc_url('https://player.vimeo.com/video/')."".esc_attr($video_id_vimeo)."' width='1170' height='658' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";} else {echo esc_url($embed_url);}// If Post is Audio Post} elseif ($post_format_string == "Audio") {// Check if SoundClound Link Existsif (!empty($skyline_post_format_option['post_format_audio_soundcloud'])) {$audio_id_soundcloud = $skyline_post_format_option['post_format_audio_soundcloud'];echo "<div class='post-audio-wrapper'>".wp_kses( $audio_id_soundcloud, array(    'iframe' => array(        'height' => array(),        'width' => array(),		'scrolling' => array(),		'frameborder' => array(),		'src' => array()    ),) )."</div>";}// If Post is Quote Post} elseif ($post_format_string == "Quote") {if (!empty($skyline_post_format_option['post_format_quote'])) {$quote = esc_html($skyline_post_format_option['post_format_quote']);} else {$quote = "";}if (!empty($skyline_post_format_option['post_format_quote_source'])) {$quote_source = esc_html($skyline_post_format_option['post_format_quote_source']);}if ($quote == "") {	echo "<a href='".esc_url( get_permalink() )."'><div class='blog-text-wrapper quote_post'><div class='post-quote'>".substr(get_the_excerpt(), 0,150)."</div><div class='post-quote-img' style='background-image: url(". esc_url($img_url[0]) .");'></div></div></a>";} else {echo "<a href='".esc_url( get_permalink() )."'><div class='blog-text-wrapper quote_post'><div class='post-quote'>\"$quote\"<br/><div class='post-quote-source'>- $quote_source</div></div><div class='post-quote-img' style='background-image: url(". esc_url($img_url[0]) .");'></div></div></a>";}}?><?php if ($post_format_string == "Quote") {// Blog Text Wrapper Removal for Quote} elseif ($post_format_string == "Link") {if (!empty($skyline_post_format_option['post_format_link'])) {$link = $skyline_post_format_option['post_format_link'];?><div class="blog-text-wrapper link_post"><div class="post-link"><a href="<?php echo esc_url($link); ?>" target="_blank"><?php echo esc_url($link); ?></a></div><p><?php echo substr(get_the_excerpt(), 0,150); ?>...</p><div class="row blog-info-bottom"><div class="col-xs-8"><?php echo $post_format_icon; ?></div><div class="col-xs-4 text-right"><a class="read-more-link" href="<?php echo esc_url($link); ?>" target="_blank"><?php echo esc_html__( 'Visit', 'skyline') ?> <i class='feather-arrow-right'></i></a></div></div></div><?php} else {?><div class="blog-text-wrapper"><?php if ( is_sticky() ){echo "<div class='sticky_post'>".esc_html__( 'Featured Post', 'skyline')."</div>";} ?><h1><a href="<?php esc_url( the_permalink() ) ?>"><?php the_title(); ?></a></h1><div class="blog-info"><?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?> <?php echo esc_html__( 'Posted by', 'skyline') ?> <?php the_author_posts_link(); ?> on <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></div><p><?php echo substr(get_the_excerpt(), 0,250); ?>...</p><div class="row blog-info-bottom"><div class="col-xs-8"><?php echo $post_format_icon; ?></div><div class="col-xs-4 text-right"><a class="read-more-link" href="<?php esc_url( the_permalink() ) ?>"><?php echo esc_html__( 'Read', 'skyline') ?> <i class='feather-arrow-right'></i></a></div></div></div><?php}// End Link Post} else { ?><div class="blog-text-wrapper"><?php if ( is_sticky() ){echo "<div class='sticky_post'>".esc_html__( 'Featured Post', 'skyline')."</div>";} ?><h1><a href="<?php esc_url( the_permalink() ) ?>"><?php the_title(); ?></a></h1><div class="blog-info"><?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?> <?php echo esc_html__( 'Posted by', 'skyline') ?> <?php the_author_posts_link(); ?> on <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'))); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></div><p><?php echo substr(get_the_excerpt(), 0,250); ?>...</p><div class="row blog-info-bottom"><div class="col-xs-8"><?php echo $post_format_icon; ?></div><div class="col-xs-4 text-right"><a class="read-more-link" href="<?php esc_url( the_permalink() ) ?>"><?php echo esc_html__( 'Read', 'skyline') ?> <i class='feather-arrow-right'></i></a></div></div></div><?php } ?></div><!-- End Column --><?php echo $newrow; ?><!-- End Column --><?php}?></div></div><?php} else {	// no posts found}// Restore original Post Datawp_reset_postdata();