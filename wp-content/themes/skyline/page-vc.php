<?php/** * The template for displaying all pages. * * This is the template that displays all pages by default. * Please note that this is the WordPress construct of pages * and that other 'pages' on your WordPress site will use a * different template. * * @package skyline   Template Name: Visual Composer - Page */get_header(); $skyline_data = skyline_redux_data();// BREADCRUB SETTINGS //$skyline_breadcrumb_override = get_post_meta( get_the_ID(), 'skyline_breadcrumb_override', true );if (isset($skyline_breadcrumb_override['breadcrumb']) && ($skyline_breadcrumb_override['breadcrumb']) == "1") {skyline_breadcrumb();} elseif (isset($skyline_breadcrumb_override['breadcrumb']) && ($skyline_breadcrumb_override['breadcrumb']) == "0") {// Do Nothing} elseif (isset($skyline_breadcrumb_override['breadcrumb']) && ($skyline_breadcrumb_override['breadcrumb']) == "" && isset($skyline_data['breadcrumb-page']) && $skyline_data['breadcrumb-page'] == "1") {skyline_breadcrumb();} elseif (!isset($skyline_breadcrumb_override['breadcrumb']) && (isset($skyline_data['breadcrumb-page']) && $skyline_data['breadcrumb-page'] == "1")) {skyline_breadcrumb();}?>	<div id="primary" class="content-area">		<main id="main" class="site-main" role="main">			<?php while ( have_posts() ) : the_post(); ?>				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	<div class="entry-content">		<?php the_content(); ?>		<?php			wp_link_pages( array(				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skyline' ),				'after'  => '</div>',			) );		?>        	</div><!-- .entry-content -->	</article><!-- #post-## -->				<?php				/**	// If comments are open or we have at least one comment, load up the comment template					if ( comments_open() || '0' != get_comments_number() ) :						comments_template();					endif; 				*/				?>			<?php endwhile; // end of the loop. ?>		</main><!-- #main -->	</div><!-- #primary --><?php get_footer(); ?>