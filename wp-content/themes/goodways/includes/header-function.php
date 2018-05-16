<?php 
// get website title
if(!function_exists("ts_document_title")){
	function ts_document_title(){
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'templatesquare' ), max( $paged, $page ) );
	}// end ts_get_title()
}

// head action hook
if(!function_exists("ts_head")){
	function ts_head(){
		do_action("ts_head");
	}
	add_action('wp_head', 'ts_head', 20);
}

// get style
if(!function_exists("ts_print_stylesheet")){
	function ts_print_stylesheet(){
		
	//Get Option Background Style
	
	$optHeaderBG = of_get_option('templatesquare_header_background');
	$optHeaderBGColor = $optHeaderBG['color'];
	$optHeaderBGImage = $optHeaderBG['image'];
	$optHeaderBGPosition = $optHeaderBG['position'];
	$optHeaderBGStyle = $optHeaderBG['repeat'];
	$optHeaderBGattachment = $optHeaderBG['attachment'];
	
	
	$optFooterBG = of_get_option('templatesquare_footer_background');
	$optFooterBGColor = $optFooterBG['color'];
	$optFooterBGImage = $optFooterBG['image'];
	$optFooterBGPosition = $optFooterBG['position'];
	$optFooterBGStyle = $optFooterBG['repeat'];
	$optFooterBGattachment = $optFooterBG['attachment'];
	
	
	
	//Get Option Color Style
	$optLinkColor = of_get_option('templatesquare_linkcolor');
	$optLinkHoverColor = of_get_option('templatesquare_linkhovercolor');
	$optPageTitleColor = of_get_option('templatesquare_pagetitlecolor');
	$optPageDescColor = of_get_option('templatesquare_pagedesccolor');
	
	$optFooterHeadingColor = of_get_option('templatesquare_footerheadingcolor');
	$optFooterHeadingBorderColor = of_get_option('templatesquare_footerheadingbordercolor');
	$optFooterTextColor = of_get_option('templatesquare_footertextcolor');
	$optFooterLinkColor = of_get_option('templatesquare_footerlinkcolor');
	$optFooterLinkHoverColor = of_get_option('templatesquare_footerlinkhovercolor');
		
?>

	<style type="text/css" media="screen">
	
	a, a:visited{color:<?php echo $optLinkHoverColor;?>}
	
	/* Header */
	#outerheader{
		<?php if($optHeaderBGImage!="" || $optHeaderBGColor!=""){?>
		background-color:<?php echo $optHeaderBGColor ; ?>;
		background-image:url(<?php echo $optHeaderBGImage ; ?>);
		background-repeat:<?php echo $optHeaderBGStyle ; ?>;
		background-position: <?php echo $optHeaderBGPosition; ?>;
		background-attachment: <?php echo $optHeaderBGattachment ; ?>;
		<?php } ?>
	}
	
	.pagetitle{color:<?php echo $optPageTitleColor; ?>;}
	.pagedesc{color:<?php echo $optPageDescColor; ?>;}
	
	
	/* Footer */
	#footersection{
		<?php if($optFooterBGImage!="" || $optFooterBGColor!=""){?>
		background-color:<?php echo $optFooterBGColor ; ?>;
		background-image:url(<?php echo $optFooterBGImage ; ?>);
		background-repeat:<?php echo $optFooterBGStyle ; ?>;
		background-position: <?php echo $optFooterBGPosition; ?>;
		background-attachment: <?php echo $optFooterBGattachment ; ?>;
		<?php } ?>
		color:<?php echo $optFooterTextColor; ?>;
	}
	
	#footersidebar .widget-title{color:<?php echo $optFooterHeadingColor; ?>; border-color:<?php echo $optFooterHeadingBorderColor; ?>}
	#footersidebar li a, #footersidebar li a:visited{color:<?php echo $optFooterLinkColor; ?>}
	#footersidebar li a:hover, #footersidebar li a.colortext:hover{color:<?php echo $optFooterLinkHoverColor; ?>}
	
	#footersidebar .ts-recent-post-widget li h3 a, #footersidebar .ts-recent-post-widget li h3 a:visited{color:<?php echo $optFooterHeadingColor; ?>}
	#footersidebar .ts-recent-post-widget li h3 a:hover{color:<?php echo $optFooterLinkHoverColor; ?>;}


	
    </style>

        
        
<?php
		
	}// end function ts_print_stylesheet
	add_action("ts_head","ts_print_stylesheet",7);
}


// print the logo html
if(!function_exists("ts_logo")){
	function ts_logo(){ 
	
		$logotype = of_get_option('templatesquare_logo_type');
		$logoimage = of_get_option('templatesquare_logo_image'); 
		$sitename =  of_get_option('templatesquare_site_name');
		$tagline = of_get_option('templatesquare_tagline');
		if($logoimage == ""){ $logoimage = get_stylesheet_directory_uri() . "/images/logo.png"; }
?>
		<?php if($logotype == 'textlogo'){ ?>
			
			<?php if($sitename=="" && $tagline==""){?>
                <h1><a href="<?php echo home_url( '/'); ?>" title="<?php _e('Click for Home','templatesquare'); ?>"><?php bloginfo('name'); ?></a></h1><span class="desc"><?php bloginfo('description'); ?></span>
            <?php }else{ ?>
                <h1><a href="<?php echo home_url( '/'); ?>" title="<?php _e('Click for Home','templatesquare'); ?>"><?php echo $sitename; ?></a></h1><span class="desc"><?php echo $tagline; ?></span>
            <?php }?>
        
        <?php } else { ?>
        	
            <div id="logoimg">
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'templatesquare' ) ); ?>" >
                <img src="<?php echo $logoimage;?>" alt="" />
            </a>
            </div>
            
		<?php } ?>
        
<?php 
	}
}
?>