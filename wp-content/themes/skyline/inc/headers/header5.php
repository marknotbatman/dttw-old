<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package skyline
 */
$skyline_data = skyline_redux_data(); 
$skyline_navfade = get_post_meta( get_the_ID(), 'skyline_navfade', true );
$post_type = get_post_type();
$post_format_string = ( get_post_format() ? get_post_format_string( get_post_format() ) : 'Standard' );
if (isset($skyline_navfade['navfade']) && ($skyline_navfade['navfade'] == "1")) {
 $nav_transparent = "nav-transparent";
} elseif (is_single() && isset($skyline_data['post-layout']) && ($skyline_data['post-layout'] == "2") && ($post_type ==  'post') && (($post_format_string ==  'Standard') || ($post_format_string ==  'Gallery') || ($post_format_string ==  'Video'))) {
 $nav_transparent = "nav-transparent";
} else  {
$nav_transparent = "nav-default";
}

// For Mobile View Icons
if (esc_html($skyline_data['mobile_phone']) != "" ) {
$mobile_phone = "<a href='tel:+".esc_html($skyline_data['mobile_phone'])."'><i class='ti-mobile'></i></a>";
} else {
$mobile_phone = "";
}
if (esc_html($skyline_data['mobile_email']) != "" ) {
$mobile_email = "<a href='mailto:".esc_html($skyline_data['mobile_email'])."'><i class='ti-email'></i></a>";
} else {
$mobile_email = "";
}
if (esc_html($skyline_data['search_icon_mobile']) == 1 ) {
$search_location = "<a id='main-search-mobile' href='#'><i class='ti-search'></i></a>";
} else {
$search_location = "";
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="nav-top <?php echo $nav_transparent; ?> header5">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
$fav_icon = $skyline_data['favicon']['url']; ?>
<link rel="icon" href="<?php echo esc_url($fav_icon); ?>" type="image/png">
<?php
}
?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- ===== START PAGE LOADER GRAPHIC ===== -->
<div id="pageloader">
<div class="loading-logo">
<?php if(!empty($skyline_data['logo_img']['url'])) : ?>
<img src='<?php echo esc_url($skyline_data['logo_img']['url']); ?>' alt='logo image' />
            <?php else : ?><h1 class="site-title">
                <?php if ($skyline_data['logo_text'] == "") { echo get_bloginfo('name');}
				else { echo esc_html($skyline_data['logo_text']); }?></h1>
            <?php endif; ?>
</div>
<div class="spinner">
  <div class="bounce1"></div>
  <div class="bounce2"></div>
  <div class="bounce3"></div>
</div>
</div>
<div class="mobile-menu-bg"></div>
<div id="page" class="hfeed site">
<div class="mobile-menu-bar"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src='<?php echo esc_url($skyline_data['logo_img']['url']); ?>' alt='logo image' /></a><?php echo $mobile_phone; ?><?php echo $mobile_email; ?><?php echo $search_location; ?><i class="ti-menu menu-bars-icon"></i></div>
<div class="header-holder"></div>
	<header id="masthead" class="site-header" role="banner">
	  <a class="close-icon"><i class="ti-menu"></i></a>
	<div class="fullwidth-section-nav">
<div class="row">
<div class="container-fluid">
<div class="col-md-12">
		<div class="nav-content-wrapper">
		<div class="site-branding">
			<div class="logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php if(!empty($skyline_data['logo_img']['url'])) : ?>
              <img src='<?php echo esc_url($skyline_data['logo_img']['url']); ?>' alt='logo image' />
            <?php else : ?><h1 class="site-title">
                <?php if ($skyline_data['logo_text'] == "") { echo get_bloginfo('name');}
				else { echo esc_html($skyline_data['logo_text']); }?></h1>
            <?php endif; ?></a>
			</div>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
		<?php	$defaults = array(
		 'theme_location' => 'primary',
		 'walker'          => new Walker_Mega_Menu()
);

wp_nav_menu( $defaults ); ?>
		</nav><!-- #site-navigation -->
		
		</div><!-- .nav-content-wrapper -->
			</div></div></div></div>
	</header><!-- #masthead -->
	<!-- ===== START MAIN SEARCH BOX ===== -->
	<?php
	if ($skyline_data['search_location'] == "2") {
	?>
	<div id="main-search"><i class="fa-search"></i></div>
	<?php } else { 
	// Do Not Show 
	} ?>
	<div id="main-search-box">
	<div class="container">
	<div class="row">
	<div class="col-md-12">
							<div class="form-group">
							<?php get_search_form(); ?>
							</div>
							<div id="close-search"><i class="feather-circle-cross"></i></div>
                             <div class="search-text"><h3><?php echo esc_html__('Search the Site','skyline'); ?></h3></div>
							</div>
							</div>
							</div>
							</div>
	<!-- ===== END MAIN SEARCH BOX ===== -->
	<div id="content" class="site-content">