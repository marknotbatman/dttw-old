<?php

	if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }
	
	include_once locate_template('/inc/config.php');          // Configuration and constants
	include_once locate_template('/inc/cleanup.php');         // Cleanup
	include_once locate_template('/inc/scripts.php');         // Scripts and stylesheets
	include_once locate_template('/inc/hooks.php');           // Hooks
	include_once locate_template('/inc/actions.php');         // Actions
	include_once locate_template('/inc/widgets.php');         // Sidebars and widgets
	include_once locate_template('/inc/custom.php');          // Custom functions
	include_once locate_template('/inc/theme_options.php');  	// Admin functions
	include_once locate_template('/inc/pirenko_scodes/shortcodes.php');  	// Shortcodes

	//FONTS
	$select_font_options = array(
		'9' => array(
			'value' =>	'Acme',
			'hosted'=> 'google',
			'css' => 'Acme',
			'label' => __( 'Acme', 'pixiatheme' )
		),
		'4' => array(
			'value' =>	'Alegreya:400italic,700italic,400,700',
			'hosted'=> 'google',
			'css' => 'Alegreya',
			'label' => __( 'Alegreya', 'pixiatheme' )
		),
		'16' => array(
			'value' =>	'Anton',
			'hosted'=> 'google',
			'css' => "'Anton', sans-serif",
			'label' => __( 'Anton', 'pixiatheme' )
		),
		'14' => array(
			'value' =>	'Arial',
			'hosted'=> 'self',
			'css' => 'Arial',
			'label' => __( 'Arial', 'pixiatheme' )
		),
		'5' => array(
			'value' =>	'Arvo',
			'hosted'=> 'google',
			'css' => 'Arvo',
			'label' => __( 'Arvo', 'pixiatheme' )
		),
		'10' => array(
			'value' =>	'Asap',
			'hosted'=> 'google',
			'css' => 'Asap',
			'label' => __( 'Asap', 'pixiatheme' )
		),
		'7' => array(
			'value' =>	'Asul:400,700',
			'hosted'=> 'google',
			'css' => 'Asul',
			'label' => __( 'Asul', 'pixiatheme' )
		),
		'43' => array(
			'value' =>	'Average+Sans',
			'hosted'=> 'google',
			'css' => "'Average Sans', sans-serif;",
			'label' => __( 'Average Sans', 'pixiatheme' )
		),
		'42' => array(
			'value' =>	'Bitter:400,700,400italic',
			'hosted'=> 'google',
			'css' => "'Bitter', serif;",
			'label' => __( 'Bitter', 'pixiatheme' )
		),
		'25' => array(
			'value' =>	'Bree+Serif',
			'hosted'=> 'google',
			'css' => "'Bree Serif', serif",
			'label' => __( 'Bree Serif', 'pixiatheme' )
		),
		'11' => array(
			'value' =>	'Cabin:500,500italic',
			'hosted'=> 'google',
			'css' => "'Cabin', sans-serif",
			'label' => __( 'Cabin', 'pixiatheme' )
		),
		'48' => array(
			'value' =>	'Changa+One:400,400italic',
			'hosted'=> 'google',
			'css' => "'Changa One', cursive;",
			'label' => __( 'Changa One', 'pixiatheme' )
		),
		'61' => array(
			'value' =>	'Cinzel:400,700,900',
			'hosted'=> 'google',
			'css' => "'Cinzel', serif;",
			'label' => __( 'Cinzel', 'pixiatheme' )
		),
		'29' => array(
			'value' =>	'courier_new',
			'hosted'=> 'self',
			'css' => "'Courier New', Courier, monospace",
			'label' => __( 'Courier New', 'pixiatheme' )
		),
		'24' => array(
			'value' =>	'Cousine:400,700',
			'hosted'=> 'google',
			'css' => "'Cousine', sans-serif",
			'label' => __( 'Cousine', 'pixiatheme' )
		),
		'51' => array(
			'value' =>	'Coustard',
			'hosted'=> 'google',
			'css' => "'Coustard', serif;",
			'label' => __( 'Coustard', 'pixiatheme' )
		),
		'56' => array(
			'value' =>	'Crimson+Text:400,400italic,600,600italic',
			'hosted'=> 'google',
			'css' => "'Crimson Text', serif;",
			'label' => __( 'Crimson Text', 'pixiatheme' )
		),
		'22' => array(
			'value' =>	'Dosis:500,600,700',
			'hosted'=> 'google',
			'css' => "'Dosis', sans-serif",
			'label' => __( 'Dosis', 'pixiatheme' )
		),
		'1' => array(
			'value' =>	'Droid+Sans:400,700',
			'css' => 'Droid Sans',
			'hosted'=> 'google',
			'label' => __( 'Droid Sans', 'pixiatheme' )
		),
		'8' => array(
			'value' =>	'Droid+Serif:400,700,400italic,700italic',
			'css' => 'Droid Serif',
			'hosted'=> 'google',
			'label' => __( 'Droid Serif', 'pixiatheme' )
		),
		'18' => array(
			'value' =>	'Economica:700',
			'hosted'=> 'google',
			'css' => "'Economica', sans-serif",
			'label' => __( 'Economica', 'pixiatheme' )
		),
		'17' => array(
			'value' =>	'Exo:700,800',
			'hosted'=> 'google',
			'css' => "'Exo', sans-serif",
			'label' => __( 'Exo Sans', 'pixiatheme' )
		),
		'15' => array(
			'value' =>	'Francois+One',
			'hosted'=> 'google',
			'css' => "'Francois One', sans-serif",
			'label' => __( 'Francois One', 'pixiatheme' )
		),
		'30' => array(
			'value' =>	'helvetica',
			'hosted'=> 'self',
			'css' => "Helvetica, pixial, sans-serif",
			'label' => __( 'Helvetica', 'pixiatheme' )
		),
		'52' => array(
			'value' =>	'Josefin+Sans:400,600,700',
			'hosted'=> 'google',
			'css' => "'Josefin Sans', sans-serif",
			'label' => __( 'Josefin Sans', 'pixiatheme' )
		),
		'26' => array(
			'value' =>	'Lato:300,400,700',
			'hosted'=> 'google',
			'css' => "'Lato', sans-serif",
			'label' => __( 'Lato', 'pixiatheme' )
		),
		'59' => array(
			'value' =>	'Lekton:400,700,400italic&subset=latin,latin-ext',
			'hosted'=> 'google',
			'css' => "'Lekton', sans-serif",
			'label' => __( 'Lekton', 'pixiatheme' )
		),
		'32' => array(
			'value' =>	'Lora',
			'hosted'=> 'google',
			'css' => "'Lora', serif",
			'label' => __( 'Lora', 'pixiatheme' )
		),
		'46' => array(
			'value' =>	'Maven+Pro:400,700',
			'hosted'=> 'google',
			'css' => "'Maven Pro', sans-serif",
			'label' => __( 'Maven Pro', 'pixiatheme' )
		),
		'54' => array(
			'value' =>	'Merriweather:400,300,700',
			'hosted'=> 'google',
			'css' => "'Merriweather', serif",
			'label' => __( 'Merriweather', 'pixiatheme' )
		),
		'31' => array(
			'value' =>	'Montserrat',
			'hosted'=> 'google',
			'css' => "'Montserrat', sans-serif",
			'label' => __( 'Montserrat', 'pixiatheme' )
		),
		'37' => array(
			'value' =>	'Muli:400,400italic',
			'hosted'=> 'google',
			'css' => "'Muli', sans-serif",
			'label' => __( 'Muli', 'pixiatheme' )
		),
		'50' => array(
			'value' =>	'News+Cycle:400,700',
			'hosted'=> 'google',
			'css' => "'News Cycle', sans-serif",
			'label' => __( 'News Cycle', 'pixiatheme' )
		),
		'60' => array(
			'value' =>	'Nobile:400,400italic,700,700italic',
			'hosted'=> 'google',
			'css' => "'Nobile', sans-serif",
			'label' => __( 'Nobile', 'pixiatheme' )
		),
		'0' => array(
			'value' =>	'Open+Sans:400italic,600italic,700italic,400,600,700',
			'css' => 'Open Sans',
			'hosted'=> 'google',
			'label' => __( 'Open Sans', 'pixiatheme' )
		),
		'47' => array(
			'value' =>	'Open+Sans+Condensed:300,700,300italic',
			'hosted'=> 'google',
			'css' => "'Open Sans Condensed', sans-serif",
			'label' => __( 'Open Sans Condensed', 'pixiatheme' )
		),
		'45' => array(
			'value' =>	'Orienta',
			'hosted'=> 'google',
			'css' => "'Orienta', sans-serif",
			'label' => __( 'Orienta', 'pixiatheme' )
		),
		'13' => array(
			'value' =>	'Oswald:700,400,300',
			'hosted'=> 'google',
			'css' => "'Oswald', sans-serif",
			'label' => __( 'Oswald', 'pixiatheme' )
		),
		'36' => array(
			'value' =>	'Overlock+SC',
			'hosted'=> 'google',
			'css' => "'Overlock SC', cursive",
			'label' => __( 'Overlock SC', 'pixiatheme' )
		),
		'33' => array(
			'value' =>	'Oxygen+Mono',
			'hosted'=> 'google',
			'css' => "'Oxygen Mono', sans-serif",
			'label' => __( 'Oxygen Mono', 'pixiatheme' )
		),
		'41' => array(
			'value' =>	'Patua+One',
			'hosted'=> 'google',
			'css' => "'Patua One', cursive",
			'label' => __( 'Patua One', 'pixiatheme' )
		),
		'39' => array(
			'value' =>	'Pompiere',
			'hosted'=> 'google',
			'css' => "'Pompiere', cursive",
			'label' => __( 'Pompiere', 'pixiatheme' )
		),
		'2' => array(
			'value' =>	'PT+Sans:400,700,400italic',
			'hosted'=> 'google',
			'css' => "'PT Sans', sans-serif",
			'label' => __( 'PT Sans', 'pixiatheme' )
		),
		'28' => array(
			'value' =>	'PT+Sans+Narrow',
			'hosted'=> 'google',
			'css' => "'PT Sans Narrow', sans-serif",
			'label' => __( 'PT Sans Narrow', 'pixiatheme' )
		),
		'23' => array(
			'value' =>	'Questrial',
			'hosted'=> 'google',
			'css' => "'Questrial', sans-serif",
			'label' => __( 'Questrial', 'pixiatheme' )
		),
		'35' => array(
			'value' =>	'Quicksand:400,700',
			'hosted'=> 'google',
			'css' => "'Quicksand', sans-serif",
			'label' => __( 'Quicksand', 'pixiatheme' )
		),
		'34' => array(
			'value' =>	'Raleway:400,700',
			'hosted'=> 'google',
			'css' => "'Raleway', sans-serif",
			'label' => __( 'Raleway', 'pixiatheme' )
		),
		'57' => array(
			'value' =>	'Rambla:400,700,400italic,700italic&subset=latin,latin-ext',
			'hosted'=> 'google',
			'css' => "'Rambla', sans-serif",
			'label' => __( 'Rambla', 'pixiatheme' )
		),
		'55' => array(
			'value' =>	'Roboto+Condensed:400italic,700italic,400,700&subset=latin,latin-ext',
			'hosted'=> 'google',
			'css' => "'Roboto Condensed', sans-serif",
			'label' => __( 'Roboto Condensed', 'pixiatheme' )
		),
		'53' => array(
			'value' =>	'Rokkitt:400,700',
			'hosted'=> 'google',
			'css' => "'Rokkitt', serif",
			'label' => __( 'Rokkit', 'pixiatheme' )
		),
		'12' => array(
			'value' =>	'Ruda:400,700,900',
			'hosted'=> 'google',
			'css' => "'Ruda', sans-serif",
			'label' => __( 'Ruda', 'pixiatheme' )
		),
		'38' => array(
			'value' =>	'Rye',
			'hosted'=> 'google',
			'css' => "'Rye', cursive",
			'label' => __( 'Rye', 'pixiatheme' )
		),
		'58' => array(
			'value' =>	'Sanchez:400italic,400&subset=latin,latin-ext',
			'hosted'=> 'google',
			'css' => "'Sanchez', serif",
			'label' => __( 'Sanchez', 'pixiatheme' )
		),
		'44' => array(
			'value' =>	'Share+Tech',
			'hosted'=> 'google',
			'css' => "'Share Tech', sans-serif",
			'label' => __( 'Share Tech', 'pixiatheme' )
		),
		'49' => array(
			'value' =>	'Source+Sans+Pro:400,700,400italic,700italic',
			'hosted'=> 'google',
			'css' => "'Source Sans Pro', sans-serif",
			'label' => __( 'Source Sans Pro', 'pixiatheme' )
		),
		'40' => array(
			'value' =>	'Titillium+Web:400,600,400italic',
			'hosted'=> 'google',
			'css' => "'Titillium Web', sans-serif",
			'label' => __( 'Titillium Web', 'pixiatheme' )
		),
		'6' => array(
			'value' =>	'Ubuntu:400,400italic',
			'hosted'=> 'google',
			'css' => "'Ubuntu', sans-serif",
			'label' => __( 'Ubuntu', 'pixiatheme' )
		),
		'27' => array(
			'value' =>	'Vollkorn:400italic,400',
			'hosted'=> 'google',
			'css' => "'Vollkorn', serif",
			'label' => __( 'Vollkorn', 'pixiatheme' )
		),
		'3' => array(
			'value' =>	'Yanone+Kaffeesatz',
			'hosted'=> 'google',
			'css' => 'Yanone Kaffeesatz',
			'label' => __( 'Yanone Kaffeesatz', 'pixiatheme' )
		),
		'190' => array(
			'value' =>	'bebas_neue',
			'hosted'=> 'theme',
			'css' => "BebasNeueRegular",
			'label' => __( 'Bebas Neue', 'pixiatheme' )
		),
		'191' => array(
			'value' =>	'league_gothic',
			'hosted'=> 'theme',
			'css' => "LeagueGothicRegular",
			'label' => __( 'League Gothic', 'pixiatheme' )
		),
		'194' => array(
			'value' =>	'novecento',
			'hosted'=> 'theme',
			'css' => "NovecentowideBookBold",
			'label' => __( 'Novecento', 'pixiatheme' )
		),
		'192' => array(
			'value' =>	'osp_din',
			'hosted'=> 'theme',
			'css' => "OSPDIN",
			'label' => __( 'OSP Din', 'pixiatheme' )
		),
		'193' => array(
			'value' =>	'tex_gyre',
			'hosted'=> 'theme',
			'css' => "TeXGyreHerosBold",
			'label' => __( 'TeX Gyre Heros', 'pixiatheme' )
		)
	);
	$prk_pixia_frontend_options=get_option('pixia_theme_options');
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	//MAKE THE THEME READY FOR EXTRA FONTS PLUGIN
	if (!is_array($prk_pixia_frontend_options['header_font']))
	{
		foreach ( $select_font_options as $option_header ) 
        {
            $label_header = $option_header['label'];
            if ($prk_pixia_frontend_options['header_font'] == $option_header['value'])
            {
            	$prk_pixia_frontend_options['header_font']=$option_header;
            }  
        }
        if (is_plugin_active('prk_fonts/prk_fonts.php'))
        {
	        $prk_font_options = get_option('prk_font_plugin_option');
			foreach ($prk_font_options as $font) {
				if ($font['erased']=="false") {
					if ($prk_pixia_frontend_options['header_font'] == $font['value'])
		            {
		            	$prk_pixia_frontend_options['header_font']=$font;
		            } 
	            }
			}
		}
        update_option('pixia_theme_options', $prk_pixia_frontend_options);
	}
	if (!is_array($prk_pixia_frontend_options['body_font']))
	{
		foreach ( $select_font_options as $option_header ) 
        {
            $label_header = $option_header['label'];
            if ($prk_pixia_frontend_options['body_font'] == $option_header['value'])
            {
            	$prk_pixia_frontend_options['body_font']=$option_header;
            }  
        }
        if (is_plugin_active('prk_fonts/prk_fonts.php'))
        {
	        $prk_font_options = get_option('prk_font_plugin_option');
			foreach ($prk_font_options as $font) {
				if ($font['erased']=="false") {
					if ($prk_pixia_frontend_options['body_font'] == $font['value'])
		            {
		            	$prk_pixia_frontend_options['body_font']=$font;
		            } 
	            }
			}
		}
        update_option('pixia_theme_options', $prk_pixia_frontend_options);
	}
	
	function pixia_setup() {
	
		// Make theme available for translation
		load_theme_textdomain('pixia', get_template_directory() . '/lang');
		
		//ADD THE DEFAULT LOCATIONS IF NECESSARY
		if ( is_nav_menu( 'Top Left Navigation'  ) )
		{
			//DO NOTHING. THE MENU ALREADY EXISTS	
		}
		else
		{
			register_nav_menus(array(
			'top_left_navigation' => __('Top Left Navigation', 'pixia')));
		}
		//THIS MENU IS MANDATORY!
		if ( is_nav_menu( 'Pixia Main Menu'  ) )
		{
			//DO NOTHING. THE MENU ALREADY EXISTS	
		}
		else
		{
			//ADD THE DEFAULT FOOTER MENU
			$name = 'Pixia Main Menu';
			$menu_id = wp_create_nav_menu($name);
			$menu = get_term_by( 'name', $name, 'nav_menu' );
			//ASSIGN THE MENU TO THE DEFAULT LOCATION
			$locations = get_theme_mod('nav_menu_locations');
			$locations['top_left_navigation'] = $menu->term_id;
			set_theme_mod( 'nav_menu_locations', $locations );
			//ADD THE HOMEPAGE BUTTON
			$menu = 
				array( 
					'menu-item-type' => 'custom', 
					'menu-item-url' => site_url(),
					'menu-item-title' => 'Home',
					'menu-item-status' => 'publish'
				);
			wp_update_nav_menu_item( $menu_id, 0, $menu );
		}
		
	  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	  add_theme_support('post-thumbnails');
	
	}
	
	add_action('after_setup_theme', 'pixia_setup');
	  
	//ADD METABOXES SUPPORT
	include_once locate_template('inc/modules/wpalchemy/metaboxes/setup.php');
	//ADD METABOXES FOR CPT'S
	include_once locate_template('inc/modules/wpalchemy/metaboxes/portfolio-spec.php');
	include_once locate_template('inc/modules/wpalchemy/metaboxes/member-spec.php');
	//ADD METABOXES FOR SPECIAL PAGES
	include_once locate_template('inc/modules/wpalchemy/metaboxes/template-portfolio-spec.php');
	include_once locate_template('inc/modules/wpalchemy/metaboxes/template-blog-spec.php');
	include_once locate_template('inc/modules/wpalchemy/metaboxes/template-homepage-spec.php');
	include_once locate_template('inc/modules/wpalchemy/metaboxes/reg-page-spec.php');
	
	//Redirect to Theme Options Page on Activation
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow =="themes.php" )
		wp_redirect( 'themes.php?page=theme_options' );
		
	//THEME CHECK WARNINGS REMOVAL
	add_theme_support( 'automatic-feed-links' );
	//FONT MANIPULATION
	function is_google_font($variable_val)
	{
		if ($variable_val!="courier_new" && $variable_val!="helvetica" && $variable_val!="Arial" && $variable_val!="bebas_neue") {
			return true;
		}
		else {
			return false;	
		}
	}
	//FIX FOR COMPATIBILITY MODE ON IE
	/*
	Plugin Name: Force IE Edge
	Description: Add an X-UA-Compatible header to WordPress
	Author: Christopher Davis
	Author URI: http://christopherdavis.me
	License: GPL2
		
		Copyright 2012 Christopher Davis
	
		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as 
		published by the Free Software Foundation.
	
		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.
	
		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/
	
	
	add_filter('wp_headers', 'cdfie_add_header');
	/*
	 * Adds a header to WordPress
	 *
	 * @return array Where header => header value
	 */
	function cdfie_add_header($headers)
	{
		$headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
		return $headers;
	}
	
	//POST LIKE FEATURE
	
	$timebeforerevote = 60;

	add_action('wp_ajax_nopriv_post-like', 'post_like');
	add_action('wp_ajax_post-like', 'post_like');
	
	
	
	function post_like()
	{
		$nonce = $_POST['nonce'];
	 
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
			die ( 'Busted!');
			
		if(isset($_POST['post_like']))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];
			
			$meta_IP = get_post_meta($post_id, "voted_IP");
			if (empty($meta_IP))
					$meta_IP[0]="";
			$voted_IP = $meta_IP[0];
			if(!is_array($voted_IP))
				$voted_IP = array();
			
			$meta_count = get_post_meta($post_id, "votes_count", true);
	
			if(!hasAlreadyVoted($post_id))
			{
				$voted_IP[$ip] = time();
	
				update_post_meta($post_id, "voted_IP", $voted_IP);
				update_post_meta($post_id, "votes_count", ++$meta_count);
				
				echo $meta_count;
			}
			else
				echo "already";
		}
		exit;
	}
	
	function hasAlreadyVoted($post_id)
	{
		global $timebeforerevote;
	
		$meta_IP = get_post_meta($post_id, "voted_IP");
		if (empty($meta_IP))
			$meta_IP[0]="";
		$voted_IP = $meta_IP[0];
		if(!is_array($voted_IP))
			$voted_IP = array();
		$ip = $_SERVER['REMOTE_ADDR'];
		
		if(in_array($ip, array_keys($voted_IP)))
		{
			$time = $voted_IP[$ip];
			$now = time();
			
			if(round(($now - $time) / 60) > $timebeforerevote)
				return false;
				
			return true;
		}
		
		return false;
	}
	
	function getPostLikeLink($post_id)
	{
		global $pixia_frontend_options; 
		$pixia_frontend_options=get_option('pixia_theme_options');
		$themename = "pixia";
		$heart_color=alter_brightness("#".$pixia_frontend_options['inactive_color'],40);
		$vote_count = get_post_meta($post_id, "votes_count", true);
		if ($vote_count=="")
			$vote_count=0;
		$output = '<div class="post-like">';
		if(hasAlreadyVoted($post_id))
		{
			$heart_color="#ff3030";
		}
		if(hasAlreadyVoted($post_id))
			$output .= ' 	<a href="#" pir_title="'.__('You already liked this', $themename).'" class="pir_like alreadyvoted">
								<div class="tr_wrapper" style="z-index:0;">
									<div class="submenu_heart pirenko_tinted">
										<i class="clearer_inactive_color pixia_fa-heart"></i>
									</div>
								</div>
								<span class="count masonr_inactive" style="margin-left:23px;top:1px;position:relative;">'.$vote_count.'</span>
						</a>';
		else
			$output .= '<a href="#" data-post_id="'.$post_id.'" pir_title="'.__('I like this!', $themename).'">
							<div class="tr_wrapper" style="z-index:0;">
                            	<div class="submenu_heart pirenko_tinted">
                                	<i class="clearer_inactive_color pixia_fa-heart"></i>
                               	</div>
                        	</div>
							<span class="count masonr_inactive" style="margin-left:23px;top:1px;position:relative;">'.$vote_count.'</span>
					</a>';
		
		$output .= '</div>';
		return $output;
	}
	function getblogLikeLink($post_id)
	{
		global $pixia_frontend_options; 
		$pixia_frontend_options=get_option('pixia_theme_options');
		$heart_color=alter_brightness("#".$pixia_frontend_options['inactive_color'],40);
		$themename = "pixia";
	
		$vote_count = get_post_meta($post_id, "votes_count", true);
		if ($vote_count=="")
			$vote_count=0;
		$output = '<div class="post-like">';
		$add_this_class="";
		$tip_txt="I like this!";
		if(hasAlreadyVoted($post_id))
		{
			$add_this_class="pir_like alreadyvoted";
			$tip_txt="You already liked this";
			$heart_color="#ff3030";
		}
			$output .= ' 	<a href="#" data-post_id="'.$post_id.'" class="like-link" pir_title="'.__($tip_txt, $themename).'" class="'.$add_this_class.'">
								<div class="tr_wrapper" style="z-index:0;">
									<div class="submenu_heart pirenko_tinted">
										<i class="clearer_inactive_color pixia_fa-heart"></i>
									</div>
								</div>
								<span class="count masonr_inactive">'.$vote_count.'</span>
						</a>';
		$output .= '</div>';
		return $output;
	}
	//ADD PAGE SLUGS ON NAV ID'S - USEFULL FOR PORTFOLIO FILTERS
	function nav_id_filter( $id, $item ) {
	if (strpos($item->url,'/?') == true) 
	{
		//WE ARE USING THE DEFAULT PERMALINK SYSTEM
		//GRAB WHAT'S AFTER THE = SIGN
		$parts = substr(strrchr($item->url, "="), 1);
		return 'nav-'.$parts;
	}
	else
		return 'nav-'.basename($item->url);
	}
	add_filter( 'nav_menu_item_id', 'nav_id_filter', 10, 2 );
	
	function get_attachment_id_from_src ($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;
	}
	//FUNCTION TO CHECK IF PATH CONTAINS YOUTUBE, VIMEO...
    function prk_external_content($stringa) {
        // check if string ends with image extension
        if (preg_match('/(\.jpg|\.png|\.bmp)$/', $stringa)) {
            return "other";
        // check if there is youtube.com in string
        } elseif (strpos($stringa, "youtube.com") !== false) {
            return "youtube";
        } elseif (strpos($stringa, "youtu.be") !== false) {
            return "youtube";
        // check if there is vimeo.com in string
        } elseif (strpos($stringa, "vimeo.com") !== false) {
            return "vimeo";
        } elseif (strpos($stringa, "soundcloud.com") !== false) {
            return "soundcloud";
        } else {
            return "other";
        }
    }
	function get_youtube_url($text) {
        $text = preg_replace('~
            # Match non-linked youtube URL in the wild. (Rev:20130823)
            https?://         # Required scheme. Either http or https.
            (?:[0-9A-Z-]+\.)? # Optional subdomain.
            (?:               # Group host alternatives.
              youtu\.be/      # Either youtu.be,
            | youtube\.com    # or youtube.com followed by
              \S*             # Allow anything up to VIDEO_ID,
              [^\w\-\s]       # but char before ID is non-ID char.
            )                 # End host alternatives.
            ([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
            (?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
            (?!               # Assert URL is not pre-linked.
              [?=&+%\w.-]*    # Allow URL (query) remainder.
              (?:             # Group pre-linked alternatives.
                [\'"][^<>]*>  # Either inside a start tag,
              | </a>          # or inside <a> element text contents.
              )               # End recognized pre-linked alts.
            )                 # End negative lookahead assertion.
            [?=&+%\w.-]*        # Consume any URL (query) remainder.
            ~ix', 
            '$1',
            $text);
        return $text;
    }
    function get_iframe_src($raw_content) {
        if ($raw_content!="") {
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->loadHTML($raw_content);
            libxml_use_internal_errors(false);
            if (is_object($doc->getElementsByTagName('iframe')->item(0))){
                $src = $doc->getElementsByTagName('iframe')->item(0)->getAttribute('src');
            }
            else {
                return "Wrong Video Code.";
            }
            if (prk_external_content($raw_content)=="youtube")
            {
            	//ADD HTTP IF NEEDED
            	if (substr($src,0,2)=="//")
            	    $src="http:".$src;
                return "http://www.youtube.com/watch?v=".get_youtube_url($src);
            }
            if (prk_external_content($raw_content)=="vimeo")
            {
                return $src;
            }
            if (prk_external_content($raw_content)=="soundcloud")
            {
                return $src;
            }
        }
        else
        {
            return "No Content Is Set";
        }
    }

    //BETTER QTRANSLATE SUPPORT
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('qtranslate/qtranslate.php')) {
        function qtranslate_edit_taxonomies(){
           $args=array(
              'public' => true ,
              '_builtin' => false
           );
           $output = 'object'; // or objects
           $operator = 'and'; // 'and' or 'or'

           $taxonomies = get_taxonomies($args,$output,$operator); 

           if  ($taxonomies) {
             foreach ($taxonomies  as $taxonomy ) {
                 add_action( $taxonomy->name.'_add_form', 'qtrans_modifyTermFormFor');
                 add_action( $taxonomy->name.'_edit_form', 'qtrans_modifyTermFormFor');        

             }
           }
        }
        add_action('admin_init', 'qtranslate_edit_taxonomies');
    }
	
	//FUNCTION TO GET SLUG PASSING AN ID
	function the_slug( $id ) {
		$post_data = get_post($id, ARRAY_A);
		$slug = $post_data['post_name'];
		return $slug; 
	}

	//JETPACK RETINA SCRIPT REMOVE
	function dequeue_devicepx() {
	    wp_dequeue_script( 'devicepx' );
	}
	add_action('wp_enqueue_scripts', 'dequeue_devicepx', 20);
	
	//WOOCOMMERCE STUFF
	if (PRK_WOO=="true") {
	    add_theme_support('woocommerce');
	    add_theme_support( 'wc-product-gallery-zoom' );
	    add_theme_support( 'wc-product-gallery-lightbox' );
	    add_theme_support( 'wc-product-gallery-slider' );

	    add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
	    function jk_dequeue_styles( $enqueue_styles ) {
	        unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
	        return $enqueue_styles;
	    }

	    /**
	     * WooCommerce Extra Feature
	     * --------------------------
	     *
	     * Change number of related products on product page
	     * Set your own value for 'posts_per_page'
	     *
	     */ 
	    function woo_related_products_limit() {
	      global $product;
	    	
	    	$args['posts_per_page'] = 3;
	    	return $args;
	    }
	    add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
	      function jk_related_products_args( $args ) {
	    	$args['posts_per_page'] = 3; // 4 related products
	    	$args['columns'] = 3; // arranged in 2 columns
	    	return $args;
	    }

	    //INVERT SALE BUTTON POSITION
	    add_filter('woocommerce_sale_price_html', 'wdm_change_price_text', 10, 2);
	    function wdm_change_price_text( $price, $this_object ) {
	        $display_price       = $this_object->get_display_price();
	        $display_regular_price   = $this_object->get_display_price($this_object->get_regular_price());
	        $price='<ins>' . wc_price($display_price) . '</ins>' . $this_object->get_price_suffix() . '<del>' . wc_price($display_regular_price) . '</del> ';
	        return $price;
	    }
	}

	if (!function_exists('pixia_validate_key')) {
	    function pixia_validate_key() {
	        if (get_option('pixia_prk_one')=="") {
	          add_option( 'pixia_prk_one', 'off', '', 'yes' );
	        }
	        if (get_option('pixia_prk_one')=='off') {
	            return false;
	        }
	        else {
	            return true;
	        }
	    }
	}
	if (!function_exists('pixia_output_keyform')) {
	    function pixia_output_keyform() {
	        $pixia_theme=wp_get_theme();
	        ?>
	            <form id="pirenko_verify_form" class="themed" method="post" data-path="<?php echo $_SERVER['HTTP_HOST']; ?>" data-admin="<?php echo admin_url('themes.php?page=pixia-install-required-plugins&act='); ?>" data-theme="<?php echo PIXIA_THEME_ID; ?>">
	            <div class="pirenko_verify_purchase">
	            <div class="spinner"></div>
	            <input id="pirenko_purchase_key" type="text" name="pirenko_purchase_key" value="" /><br />
	            <input type="submit" value="<?php echo esc_attr__( 'Validate License Key', 'pixia'); ?>" class="button button-primary button-large" /> 
	            </div>
	            <div id="pirenko_verify_form-output">
	            <p>You can purchase a <?php echo esc_attr($pixia_theme->get('Name').' - '.$pixia_theme->get('Description')); ?> license <a href="https://themeforest.net/cart/configure_before_adding/<?php echo PIXIA_THEME_ID; ?>?license=regular&ref=Pirenko&size=source&support=bundle_6month" target="_blank">here</a>.</p>
	            </div>
	            </form>
	        <?php
	    }
	}

	add_action ('wp_loaded', 'pixia_custom_redirect');
	function pixia_custom_redirect() {
	  if (isset($_GET["act"])) {
	    update_option('pixia_prk_one', $_GET["act"]);
	    if ($_GET["page"]=='pixia-install-required-plugins') {
	        wp_redirect(admin_url('themes.php?page=install-required-plugins'));
	    }
	    else {
	        wp_redirect(admin_url('themes.php?page=theme_activation_options'));
	    }
	    exit;
	  }
	}

	if (!pixia_validate_key()) {
	    add_action('admin_menu', 'pixia_temp_menu');
	    function pixia_temp_menu() {
	        add_theme_page('Install Plugins Page', 'Install Plugins', 'edit_theme_options', 'pixia-install-required-plugins', 'pixia_license_function');
	    }
	    function pixia_license_function() {
	        $pixia_theme=wp_get_theme();
	        ?>
	        <div class="wrap"></div>
	        <div class="prk_wrap">
	            <div id="lic_wrapper" class="left_floated">
	                <div id="lic_left_column" class="left_floated"></div>
	                <div id="lic_right_column" class="left_floated">
	                    <h2 class="pirenko_import_title"><?php echo esc_attr($pixia_theme->get('Name').' '.__('Theme - Install Bundled Plugins', 'pixia')); ?></h2>
	                    <em>To acess this feature you need to enter the theme license key.</em>
	                    <?php
	                        $output_footer=false;
	                        if (isset($_GET["act"])) {
	                         	echo '<div id="prk_activate_message">';
	                        	echo '</div>';
	                        }
	                        else {
	                            pixia_output_keyform();
	                            $output_footer=true;
	                        }
	                    ?>
	                </div>
	            </div>
	            <div class="clear"></div>
	            <?php
	                if ($output_footer==true) {
	                    ?>
	                    <div class="clear bt_48"></div>
	                    <em>If you already have a license, here's how to get it in 3 easy steps:</em>
	                    <div class="clear bt_6"></div>
	                    <img id="prk_license_img" src="<?php echo get_template_directory_uri(); ?>/images/license.jpg" />
	                    <?php
	                }
	            ?>
	        </div>
	        <?php
	    }
	}
	else {

		/**
		 * Include the TGM_Plugin_Activation class.
		 */
		require_once dirname( __FILE__ ) . '/inc/modules/tgm-plugin-activation/class-tgm-plugin-activation.php';

		add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
		/* Register the required plugins for this theme. */
		function my_theme_register_required_plugins() {

			$plugins = array(
				array(
					'name'     				=> 'Pixia Framework',
					'slug'     				=> 'pixia_framework',
					'source'                => 'http://www.pirenko.com/theme_plugins/pixia/pixia_framework.php?prk_version=59&prk_key='.get_option('pixia_prk_one').'&prk_domain='.$_SERVER['HTTP_HOST'].'&prk_theme_id='.PIXIA_THEME_ID,
					'required' 				=> true,
					'version' 				=> '5.9',
					'force_activation' 		=> false,
					'force_deactivation' 	=> false,
					'external_url' 			=> '',
				),
				array(
					'name'     				=> 'Envato toolkit - Useful to keep the theme updated',
					'slug'     				=> 'envato-wordpress-toolkit',
					'source'   				=> get_template_directory() . '/external_plugins/envato-wordpress-toolkit.zip', 
					'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
					'version' 				=> '1.7.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
					'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
					'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
					'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				),
			);
			$config = array(
				'domain'       		=> 'pixia',         	// Text domain - likely want to be the same as your theme.
				'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
				'menu'         		=> 'install-required-plugins', 	// Menu slug
				'has_notices'      	=> true,                       	// Show admin notices or not
				'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
				'message' 			=> 'Hello',							// Message to output right before the plugins table
				'strings'      		=> array(
					'page_title'                       			=> __( 'Install Required Plugins', 'pixia' ),
					'menu_title'                       			=> __( 'Install Plugins', 'pixia' ),
					'installing'                       			=> __( 'Installing Plugin: %s', 'pixia' ), // %1$s = plugin name
					'oops'                             			=> __( 'Something went wrong with the plugin API.', 'pixia' ),
					'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
					'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
					'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
					'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
					'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
					'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.<br>The update is located on the theme root folder inside the external_plugins folder.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.<br>The updates are located on the theme root folder inside the external_plugins folder.' ), // %1$s = plugin name(s)
					'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
					'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
					'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
					'return'                           			=> __( 'Return to Required Plugins Installer', 'pixia' ),
					'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'pixia' ),
					'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'pixia' ), // %1$s = dashboard link
					'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
				)
			);
			tgmpa( $plugins, $config );
		}
	}
?>