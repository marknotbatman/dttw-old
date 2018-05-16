<?php

/********** TEMPLATESQUARE DEFINITION *************/
global $themeoptionsvalue, $themedata, $themename ; 
$themedata			=  'Goodways';
$themename 			=  'Goodways';
$admin_path 		= get_template_directory() . '/admin/';
$includes_path 		= get_template_directory() . '/includes/';
define('TS_THEMENAME', 'Goodways');
define('TS_SHORTNAME', "templatesquare");
define('TS_PARENTMENU_SLUG', 'tstheme-settings');
define('TS_FRAMEWORKPATH', get_template_directory() . '/framework/');

/********** END TEMPLATESQUARE DEFINITION *************/

//Theme Options
require_once get_template_directory() . '/options.php';

// Sidebar Generator
require_once $includes_path . 'sidebargenerator/ts-form.php';
require_once $includes_path . 'sidebargenerator/ts-sidebar.php';

//Theme init
require_once $includes_path . 'theme-init.php';

//Portfolio init
require_once $includes_path . 'portfolio-init.php';

//Testimonial init
require_once $includes_path . 'testimonial-init.php';

//Metaboxes
require_once $includes_path . 'metaboxes.php';

//Widget and Sidebar
require_once $includes_path . 'sidebar-init.php';

require_once $includes_path . 'register-widgets.php';

//Additional function
require_once $includes_path . 'theme-function.php';

//Header function
require_once $includes_path . 'header-function.php';

//Footer function
require_once $includes_path . 'footer-function.php';

//Additional function
require_once $includes_path . 'theme-shortcode.php';

//Loading jQuery
require_once $includes_path . 'theme-scripts.php';

//Loading Style Css
require_once $includes_path . 'theme-styles.php';

?>