<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package skyline
 */

get_header();
$skyline_data = skyline_redux_data();

if  ($skyline_data['breadcrumb-page'] == "1") {
skyline_breadcrumb(); 
} else {
// No Breadcrumb
}
 ?>
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">
<div class="fullwidth-section">
<div class="container-fluid">

<div class="row">
<?php $skyline_sidebar_option = get_post_meta( get_the_ID(), 'skyline_sidebar_option', true ); ?>
<div class="<?php  if (isset($skyline_data['page-sidebar']) && ($skyline_data['page-sidebar'] == "1")) {echo "col-md-9";} 
elseif (isset($skyline_data['page-sidebar']) && ($skyline_data['page-sidebar'] == "0")) {echo "col-md-9";} else {echo "col-md-12";}; ?>">
		<?php if ( have_posts() ) : ?>

			<header class="page-header" style="margin-top: 0; margin-bottom:50px">
				<?php
					the_archive_title( '<h1 class="page-title" style="margin-top: 0">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

			

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
 <?php echo esc_html__('Posted by', 'skyline') ?> <?php the_author_posts_link(); ?> <?php echo esc_html__('on', 'skyline') ?> <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	<p><?php echo substr(get_the_excerpt(), 0,250); ?>...</p><br/>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->

			<?php endwhile; ?>
<hr/>
			<?php skyline_pagination(); ?>

	

		<?php endif; ?>

		</div>
<?php
if (isset($skyline_data['page-sidebar']) && ($skyline_data['page-sidebar'] == "1")) { echo "<div class=\"col-md-3\"  id=\"sidebar\">"; get_sidebar(); echo"</div>";} 
elseif (isset($skyline_data['page-sidebar']) && ($skyline_data['page-sidebar'] == "0")) { echo "<div class=\"col-md-3\"  id=\"sidebar\">"; get_sidebar(); echo"</div>"; }else { } ?>		
</div>	
</div>		
</div>	
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
