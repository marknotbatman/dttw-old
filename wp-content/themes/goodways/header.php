<?php
/**
 * The Header for our theme.
 *
 *
 * @package WordPress
 * @subpackage Goodways
 * @since Goodways 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php ts_document_title(); ?></title>
<?php $bodyclass = ""; ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" id="templateurl" href="<?php echo get_template_directory_uri(); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php 
$favicon = of_get_option('templatesquare_favicon');
if($favicon =="" ){
?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
<?php }else{?>
<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php }?>

<?php

/* We add some JavaScript to pages with the comment form
 * to support sites with threaded comments (when in use).
 */
if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */
wp_head();
?>
</head>

<body <?php body_class($bodyclass); ?>>

<?php $disableSlider = of_get_option('templatesquare_disable_slider' ,'');?>
<div id="bodychild" <?php if($disableSlider==true){echo'class="noslider"';} ?>>
	<div id="outercontainer">
    
        <!-- HEADER -->
        
        <div id="outerheader">
        
        	<div class="header-bglight">
            
                <header id="top">
                    <div class="container">
                        
                        <div id="container-logomenu" class="twelve columns">
                            <span class="logo-light"></span>
                            <div id="logo" class="three columns alpha"><?php ts_logo();?></div>
                            <section id="navigation" class="nine columns omega">
                                <nav id="nav-wrap">
                                    <?php wp_nav_menu( array(
                                      'container'       => 'ul', 
                                      'menu_class'      => 'sf-menu',
                                      'menu_id'         => 'topnav', 
                                      'depth'           => 0,
                                      'sort_column'    => 'menu_order',
                                      'fallback_cb'     => 'nav_page_fallback',
                                      'theme_location' => 'mainmenu' 
                                      )); 
                                    ?>
                                </nav><!-- nav -->	
                                <div class="clear"></div>
                            </section>
                            <div class="clear"></div>
                        </div>
                    </div>
                </header>
            	
            	<div id="headertext">
                	<div class="container">
                    	<div class="headertitle">
                        
                        	<?php
							$slogantitle = of_get_option('templatesquare_slogan_title' ,'');
							$slogantext = of_get_option('templatesquare_slogan_text' ,'');
							?>
                        	
                             <?php if(is_front_page()){ ?>
                             
                             	<?php if($slogantitle!=""){ ?>
                                    <h1 class="pagetitle"><?php echo $slogantitle; ?></h1>
                                <?php } ?>
                                
                                <?php if($slogantext!=""){ ?>
                                    <span class="pagedesc"><?php echo $slogantext; ?></span>
                                <?php } ?>
                                
                            <?php }else{ ?>
                            
								<?php  get_template_part( 'title');  ?>
                                
                            <?php } ?>
                            
                            
                        </div>
                    </div>
                </div>
            
            </div>
            
            
			<?php
            $disableSlider = of_get_option('templatesquare_disable_slider' ,'false');
            if(is_front_page() && $disableSlider!=true){
                
                if($disableSlider!==true){
                    get_template_part( 'slider');
                }
            
            }
            
            ?>
            
        </div>
        <!-- END HEADER -->
        
