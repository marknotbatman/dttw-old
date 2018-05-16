<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package skyline
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<div class="fullwidth-section">

<div class="container-fluid">

<div class="row">
<div class="col-lg-12">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php echo esc_html__( 'Oops! That page can&rsquo;t be found.', 'skyline' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php echo esc_html__( 'It looks like nothing was found at this location. Try searching for what you are looking for?', 'skyline' ); ?></p><br/>

					<?php get_search_form(); ?>
<br/>


			</section><!-- .error-404 -->

</div>	
</div>	
</div>		
</div>	
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
