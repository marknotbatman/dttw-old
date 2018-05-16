<?php
/*
 *
 *	Skyline Functions and DEFINITIONS
 *	------------------------------------------------
 *	CreativelyCoded
 * 	Copyright 2016 - http://www.creativelycoded.com
 *
 *	VARIABLE DEFINITIONS
 *	TGM PLUGIN INSTALLER
 *	THEME OPTIONS - REDUX FRAMEWORK
 *	THEME SETUP
 *	TEXT DOMAIN - LANGUAGE SUPPORT
 *	THEME SUPPORT
 *	IMAGE SIZES
 *	CONTENT WIDTH
 *	NAVIGATION MENUS
 * VISUAL COMPOSER
 *	CONTENT FUNCTIONS INCLUDE
 *	BACKEND SCRIPTS AND STYLES
 *	FRONTEND STYLES
 *	FRONTEND SCRIPTS
 *
 * @package skyline
 */

/* ==================================================
VARIABLE DEFINITIONS
================================================== */
define('SKYLINE_THEME_PATH', get_template_directory());
define('SKYLINE_INCLUDES_PATH', SKYLINE_THEME_PATH . '/inc');
define('SKYLINE_THEME_URI', get_template_directory_uri());

/* ==================================================
LOAD TGM PLUGIN INSTALLER
================================================== */
if (file_exists(SKYLINE_THEME_PATH . '/admin/tgm/tgm-init.php')) {
    require_once(SKYLINE_THEME_PATH . '/admin/tgm/tgm-init.php');
}


/* ==================================================
LOAD THEME OPTIONS -  REDUX FRAMEWORK
================================================== */
// Redux Framework Setup
if (class_exists('ReduxFrameworkPlugin')) {
    require_once(SKYLINE_THEME_PATH . '/admin/redux-config.php');
    require_once(SKYLINE_THEME_PATH . '/admin/redux-extensions.php');
    
    // Set the Redux Global Variable
    function skyline_redux_data() {
        global $skyline_data;
        return $skyline_data;
    }
    
    // Remove the redux demo link
    function skyline_remove_redux_demo_link() {
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_filter('plugin_row_meta', array(
                ReduxFrameworkPlugin::get_instance(),
                'plugin_metalinks'
            ), null, 2);
        }
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_action('admin_notices', array(
                ReduxFrameworkPlugin::get_instance(),
                'admin_notices'
            ));
        }
    }
    add_action('init', 'skyline_remove_redux_demo_link');
} else {
	 function skyline_redux_data() {
        // Return Nothing
    }
}


/* ==================================================
THEME SETUP
================================================== */
if (!function_exists('skyline_setup')):
    function skyline_setup() {
        
        
        /* ==================================================
        LOAD TEXT DOMAIN - LANGUAGE SUPPORT
        ================================================== */
        load_theme_textdomain('skyline', SKYLINE_THEME_PATH . '/languages');
        
        
        /* ==================================================
        THEME SUPPORT
        ================================================== */
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ));
        add_theme_support('post-formats', array(
            'gallery',
            'video',
            'audio',
            'quote',
            'link',
            'image'
        ));
        add_theme_support('woocommerce');
        
        
        /* ==================================================
        IMAGE SIZES
        ================================================== */
        add_image_size('skyline_img-1920', 1920);
        add_image_size('skyline_img-1200', 1200);
        add_image_size('skyline_img-800', 800);
        add_image_size('skyline_img-thumb', 150, 150);
		// Prevent image uploads from timing out
        add_filter( 'wp_image_editors', 'change_graphic_lib' );
		function change_graphic_lib($array) {
		return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
		}
        // Output full size images for blog galleries
        add_filter('shortcode_atts_gallery', 'skyline_force_large_images', 10, 3);
        function skyline_force_large_images($out, $pairs, $atts) {
            $out['size'] = 'full';
            return $out;
        }
        
        
        /* ==================================================
        CONTENT WIDTH
        ================================================== */
        if (!isset($content_width)) {
            $content_width = 1140;
        }
		
        
        /* ==================================================        
        NAVIGATION MENUS
        ================================================== */
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'skyline')
        ));

      
        /* ==================================================
        VISUAL COMPOSER PATH
        ================================================== */
        if (function_exists('vc_set_template_dir')) {
            $dir = SKYLINE_THEME_PATH . '/inc/vc_setup/vc_templates/';
            vc_set_template_dir($dir);
        }
        if (function_exists('vc_set_as_theme')) {
            vc_set_as_theme(true);
        }
	
		
    }
endif; // skyline_setup
add_action('after_setup_theme', 'skyline_setup');


/* ==================================================
LOAD CONTENT FUNCTIONS
================================================== */
if (!function_exists('skyline_content_functions')) {
    function skyline_content_functions() {
        require_once(SKYLINE_INCLUDES_PATH . '/breadcrumbs.php'); // Breadcrumb Setup
        require_once(SKYLINE_INCLUDES_PATH . '/meta-boxes.php'); // Meta Boxes Setup
        require_once(SKYLINE_INCLUDES_PATH . '/vc_setup/shortcodes.php'); // Visual Composer Shortcode Setup
        require_once(SKYLINE_INCLUDES_PATH . '/template-tags.php'); // Custom template tags for this theme.
        require_once(SKYLINE_INCLUDES_PATH . '/customizer.php'); // Customizer additions
        require_once(SKYLINE_INCLUDES_PATH . '/post-like.php'); // Post Like Setup
		require_once(SKYLINE_INCLUDES_PATH . '/menu.php'); // Load Custom Menu
        require_once(SKYLINE_INCLUDES_PATH . '/megamenu.php'); // Megamenu Support
        require_once(SKYLINE_INCLUDES_PATH . '/pagination.php'); // Pagination Functions
        require_once(SKYLINE_INCLUDES_PATH . '/social-icons.php'); // Social Icons Functions
        require_once(SKYLINE_INCLUDES_PATH . '/blog-post-settings.php'); // Blog and Post Settings
        require_once(SKYLINE_INCLUDES_PATH . '/widgets.php'); // Register Widgets Area
        require_once(SKYLINE_INCLUDES_PATH . '/comments.php'); // Comments Hook
        require_once(SKYLINE_INCLUDES_PATH . '/post-navigation.php'); // Post Navigation
        // Load WooCommerce
       if (class_exists('WooCommerce')) {
            require_once(SKYLINE_THEME_PATH . '/woocommerce/functions.php');
        }
    }
    add_action('init', 'skyline_content_functions', 0);
}


/* ==================================================
LOAD BACKEND SCRIPTS AND STYLES
================================================== */
function skyline_load_admin() {
    wp_enqueue_style('skyline-admin-css', get_template_directory_uri() . '/admin/admin.css');
    wp_enqueue_script('skyline-admin-js', get_template_directory_uri() . '/admin/admin.js');
}
add_action('admin_enqueue_scripts', 'skyline_load_admin');


/* ==================================================
LOAD STYLESHEETS
================================================== */
if (!function_exists('skyline_styles')) {
    function skyline_styles() {
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_enqueue_style('feather-icons', get_template_directory_uri() . '/css/feather.css');
        wp_enqueue_style('skyline-font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
        wp_enqueue_style('themify-icons', get_template_directory_uri() . '/css/themify-icons.css');
        wp_enqueue_style('visual-composer', get_template_directory_uri() . '/css/vc_style.css');
        wp_enqueue_style('skyline-animation-engine', get_template_directory_uri() . '/css/animate.css');
        wp_enqueue_style('skyline-lightbox', get_template_directory_uri() . '/css/lightbox.css');
        wp_enqueue_style('skyline-style', get_stylesheet_uri());
    }
    add_action('wp_enqueue_scripts', 'skyline_styles');
}


/* ==================================================
LOAD SCRIPTS
================================================== */
if (!function_exists('skyline_scripts')) {
    function skyline_scripts() {
		wp_enqueue_script('skyline-scroll', get_template_directory_uri() . '/js/smoothscroll.js', 'jquery', null, true);
        wp_enqueue_script('skyline-parallax', get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js', 'jquery', null, true);
        wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', 'jquery', null, true);
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', null, true);
        wp_enqueue_script('masonry', get_template_directory_uri() . '/js/masonry.min.js', 'jquery', null, true);
        wp_enqueue_script('skyline-lightbox-js', get_template_directory_uri() . '/js/lightbox.min.js', 'jquery', null, true);
        wp_enqueue_script('vide', get_template_directory_uri() . '/js/jquery.vide.js', 'jquery', null, true);
        wp_enqueue_script('transit', get_template_directory_uri() . '/js/transit.min.js', 'jquery', null, true);
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', 'jquery', null, true);
        wp_enqueue_script('skyline-animation-engine', get_template_directory_uri() . '/js/animation-engine.js', 'jquery', null, true);
        wp_enqueue_script('skyline-counter', get_template_directory_uri() . '/js/counter.js', 'jquery', null, true);
        wp_enqueue_script('skyline-theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', 'jquery', null, true);
        
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
    add_action('wp_enqueue_scripts', 'skyline_scripts');
}