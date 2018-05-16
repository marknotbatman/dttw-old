<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<meta charset="<?php bloginfo('charset'); ?>">

<?php if(of_get_option('enable_responsive') == '1') { ?>
<!-- Mobile View -->
<meta name="viewport" content="width=device-width">
<?php } else { ?>
<?php } ?>

<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo('name'); ?></title>
<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>http://dttwfilmrace.com/wp-content/uploads/2013/04/dttw-favicon.png" type="image/x-icon">

<?php get_template_part( 'style', 'options' ); ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php wp_head(); ?>

<!-- Social -->
<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=246727095428680";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<!-- BEGIN #wrap -->
<div id="wrap">
	
	<!-- BEGIN .container -->
	<div class="container">
    	
    	<!-- BEGIN .row -->
	    <div class="row">
	    	
	    	<!-- BEGIN .three columns -->
	    	<div class="four columns">
	    		
	    		<!-- BEGIN .side-content -->
	    		<div class="side-content">
	    		
			    	<?php if (is_home() || is_front_page() ) { ?>
			    		<?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) { ?>
			    			<h1 id="custom-header"><a href="<?php echo get_option('home'); ?>/" title="Home"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" /><?php bloginfo( 'name' ); ?></a></h1>
			    		<?php } else { ?>
			    			<div id="masthead">
			    				<h1 class="site-title"><span><a class="color-white" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
			    				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			    			</div>
			    		<?php } ?>
			    	<?php } else { ?>
			    		<?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) { ?>
			    			<p id="custom-header"><a href="<?php echo get_option('home'); ?>/" title="Home"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" /><?php bloginfo( 'name' ); ?></a></p>
			    		<?php } else { ?>
			    			<div id="masthead">
			    				<h4 class="site-title"><span><a class="color-white" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h4>
			    				<h5 class="site-description"><?php bloginfo( 'description' ); ?></h5>
			    			</div>
			    		<?php } ?>
			    	<?php } ?>
			        
			        <nav id="navigation">
			        	<?php wp_nav_menu( array( 
			        		'theme_location' => 'header-menu', 
			        		'title_li' => '', 
			        		'depth' => 4, 
			        		'container_class' => 'menu sf-vertical' 
			        		)
			        	); ?>
			        </nav>
			        
			        <nav id="navigation-mobile">
			        	<?php wp_nav_menu( array(
		        			'theme_location' => 'header-menu',
		        			'walker'         => new Walker_Nav_Menu_Dropdown(),
		        			'items_wrap'     => '<select id="sec-selector" name="sec-selector">%3$s</select>'
			        		)
			        	); ?>
			        </nav>
		
		        	<?php if (is_home() || is_front_page() ) { ?>
			            <?php get_sidebar('home'); ?>
		            <?php } else { ?>
		            	<?php get_sidebar('left'); ?>
		            <?php } ?>
	            
	            <!-- END .side-content -->
	            </div>
	            
		    <!-- END .three columns -->
		    </div>