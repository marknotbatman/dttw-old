<?php
/**
 * Template part for displaying single posts.
 *
 * @package skyline
 
 Template Name: Post - Traditional
 
 */

get_header();
$skyline_data = skyline_redux_data();

if  ($skyline_data['blog_breadcrumb'] == "1") {
skyline_breadcrumb(); 
} else {
// No Breadcrumb
}
?>
	<div id="primary" class="content-area blog">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
<?php
$img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'skyline_img-1920' );
 // Get Video Link
  $embed_url = '';
  ob_start();
  ob_end_clean();
   $output = preg_match( '|^\s*(https?://[^\s"]+)\s*$|im', $post->post_content, $vid_matches );
   if (!empty($vid_matches [1])) { $embed_url = wp_oembed_get( $vid_matches[1] );}
   
   
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>   
	<div class="fullwidth-section" id="post-traditional">
	<div class="container-fluid">

<div class="row">
<div class="col-lg-12">
<?php
// Determine Post Format
$post_format_string = ( get_post_format() ? get_post_format_string( get_post_format() ) : 'Standard' );
$skyline_post_format_option = get_post_meta( get_the_ID(), 'skyline_post_format_option', true );
// echo the result
if ($post_format_string == "Standard") {
// if has image
if(isset($img_url[0])){
	echo "<div class='height-75 traditional-blog-img' style='background-image:url(". esc_url($img_url[0]).");'></div>";
}
// end if has image
} elseif ($post_format_string == "Gallery") {
// if has image
if(isset($img_url[0])){
	echo "<div class='height-75 traditional-blog-img' style='background-image:url(". esc_url($img_url[0]).");'></div>";
}
// end if has image
} elseif ($post_format_string == "Video") {
// Check if Video Link Exists and Embed Correct Format
if (!empty($skyline_post_format_option['post_format_video_youtube'])) {
$video_id_youtube = $skyline_post_format_option['post_format_video_youtube'];
echo "<div class='post-video'><iframe src='".esc_url('https://www.youtube.com/embed/')."".esc_attr($video_id_youtube)."' width='1170' height='658' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
} elseif (!empty($skyline_post_format_option['post_format_video_vimeo'])) {
$video_id_vimeo = $skyline_post_format_option['post_format_video_vimeo'];
echo "<div class='post-video'><iframe src='".esc_url('https://player.vimeo.com/video/')."".esc_attr($video_id_vimeo)."' width='1170' height='658' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>";
} else {
/*echo esc_url($embed_url);*/
}
// If Post is Audio Post
} elseif ($post_format_string == "Audio") {
// Check if SoundClound Link Exists
if (!empty($skyline_post_format_option['post_format_audio_soundcloud'])) {
$audio_id_soundcloud = $skyline_post_format_option['post_format_audio_soundcloud'];
echo "<div class='post-audio-wrapper'>".wp_kses( $audio_id_soundcloud, array(
    'iframe' => array(
        'height' => array(),
        'width' => array(),
		'scrolling' => array(),
		'frameborder' => array(),
		'src' => array()
    ),
) )."</div>";
}
// If Post is Quote Post
} elseif ($post_format_string == "Audio") {
// Check if SoundClound Link Exists
if (!empty($skyline_post_format_option['post_format_audio_soundcloud'])) {
$audio_id_soundcloud = $skyline_post_format_option['post_format_audio_soundcloud'];
echo "<div class='post-audio-wrapper'>".wp_kses( $audio_id_soundcloud, array(
    'iframe' => array(
        'height' => array(),
        'width' => array(),
		'scrolling' => array(),
		'frameborder' => array(),
		'src' => array()
    ),
) )."</div>";
}
// If Post is Quote Post
} elseif ($post_format_string == "Quote") {
if (!empty($skyline_post_format_option['post_format_quote'])) {
$quote = esc_html($skyline_post_format_option['post_format_quote']);
} else {
$quote = "";
}
if (!empty($skyline_post_format_option['post_format_quote_source'])) {
$quote_source = esc_html($skyline_post_format_option['post_format_quote_source']);
}
if ($quote == "") {
	echo "
<a href='".esc_url( get_permalink() )."'>
<div class='blog-text-wrapper quote_post'>
<div class='post-quote'>".substr(get_the_excerpt(), 0,150)."
</div>
<div class='post-quote-img' style='background-image: url(". esc_url($img_url[0]) .");'>
</div>
</div>
</a>";

} else {
echo "
<a href='".esc_url( get_permalink() )."'>
<div class='blog-text-wrapper quote_post'>
<div class='post-quote'>\"$quote\"<br/>
<div class='post-quote-source'>- $quote_source</div>
</div>
<div class='post-quote-img' style='background-image: url(". esc_url($img_url[0]) .");'>
</div>
</div>
</a>";
}
}
?>
</div>
</div>


<div class="row">
<div class="col-lg-12 white-bg-drop-padding">
<div class="post-content-wrapper clearfix">
<div class="<?php if ($skyline_data['post-sidebar'] == "1") { echo "col-lg-9";} 
elseif ($skyline_data['post-sidebar'] == "0") {echo "col-lg-12";} else { echo "col-lg-12";}; ?>">
<!-- Header -->
<div class="header-meta-position">
<?php if ($post_format_string == "Quote") {
// Title Removal for Quote
} else { ?>

	<header class="entry-header">
<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
</header><!-- .entry-header -->
<?php
}
?>
 <div class="entry-meta">
<?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?> by <?php the_author_posts_link(); ?> on <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
&nbsp;&nbsp;&nbsp;<span class="blog-icons"><a href="javascript:window.print()"><i class="feather-printer"></i></a><a href="#comments"><i class="feather-speech-bubble"></i><?php comments_number( '0', '1', '%' ); ?></a><?php echo getPostLikeLink( $post->ID ); ?><?php if ( is_sticky() ){
echo "<span class='sticky_post_page'><i class='feather-circle-check'></i> ".esc_html__( 'Featured Post', 'skyline')."</span>";
}
 ?></span>
</div><!-- .entry-meta -->
</div><!-- .header-meta-position -->
<div class="entry-content">
		<?php the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'skyline' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) ); 
			
			wp_link_pages( array(
				'before' => '<br/>' .esc_html__( 'Continue Reading: ', 'skyline' ) . '<div class="page-links">',
				'after'  => '</div><hr/>',
			) );
			?>
		<br/>
        <div class="row" style="clear: both;">
        <div class="col-md-6"><?php echo esc_html__('Posted in', 'skyline' ); ?> <?php the_category(', '); ?></div>
        <div class="col-md-6 tagged text-right"><?php the_tags( '<i class="feather-tag"></i> ',', ' ); ?></div>
        </div>
		<hr/>
		</div><!-- .entry-content -->
		 <footer class="entry-footer">
		 
     <div class="row">
        <?php skyline_next_previous_links();?>
	</div>
    <hr/>
      <!-- Share Post Links -->
       <?php skyline_share_icons(); ?>
 <!-- About Author -->
 <?php
 $authordesc = get_the_author_meta( 'description' );

if ( ! empty ( $authordesc ) )
{
?>
        <div class="row">
        <div class="col-md-12">
        <div class="about-author">
        <?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?>
        <h4>About <?php the_author_posts_link(); ?></h4>
        <p><?php  echo wpautop( $authordesc ); ?></p>
        </div>
        </div>
        </div>
		<?php
  
} ?>
		<hr/>
        <!-- End About Author -->
	
	</footer><!-- .entry-footer -->
	
<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
				
			?>
</div>
<!-- Determine if sidebar should be shown -->
<?php if ($skyline_data['post-sidebar'] == "1") {
 echo "<div class='col-lg-3' id='sidebar'>
<div class='sidebar-wrapper'>";
 get_sidebar();
echo "</div>
</div>";
} 
elseif ($skyline_data['post-sidebar'] == "0") {} 
else {}; ?>

	
</div><!-- Wrapper End -->
</div>
</div>
</div>
	</div>



</article><!-- #post-## -->
	<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>