<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('NHP_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('NHP_Options')){
    require_once( dirname( __FILE__ ) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
    
    //$args['dev_mode'] = false;
    
    return $args;
    
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');









/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();
$args['share_icons']['twitter'] = array(
    'link' => 'http://twitter.com/mountainthemes',
    'title' => 'Folow Mountain Themes on Twitter', 
    'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_322_twitter.png'
);

$args['dev_mode']       = false;
$args['google_api_key'] = 'AIzaSyDGfPm5ezYvEp1DuIQUmVhmct6ZlTYrtMc';
$args['opt_name']       = 'osaka';
$args['menu_icon']      = '';
$args['menu_title']     = __('Theme Setup', 'nhp-opts');
$args['page_title']     = __('Theme Options', 'nhp-opts');
$args['page_slug']      = 'theme_setup';
$args['support_url']    = 'http://mountainthemes.ticksy.com/';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 50;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

//Want to disable the sections showing as a submenu in the admin? uncomment this line
//$args['allow_sub_menu'] = false;
        
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition     

$sections           = array();

$section_general    = array(
    'title'     => __('General Options', 'nhp-opts'),
    'icon'      => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_023_cogwheels.png',
    'fields'    => array(
        array(
            'id'        => 'general-logo-url',
            'type'      => 'text',
            'validate'  => 'url',
            'title'     => __('logo url', 'nhp-opts'),
            'desc'      => __('Upload the logo in the media section and paste here the image url. Required image size : 175 x 70px', 'nhp-opts')
        ),
        array(
            'id'        => 'general-logo-alt',
            'type'      => 'text',
            'title'     => __('logo alt text', 'nhp-opts'),
            'validate'  => 'str_replace',
            'str'       => array('search' => '"', 'replacement' => '&quot;'),            
        ),
        array(
            'id'        => 'general-footer-text',
            'type'      => 'text',
            'title'     => __('footer text', 'nhp-opts'),
            'desc'      => __('max. 100 charachters', 'nhp-opts')
        ),
        array(
            'id'        => 'general-music-player',
            'type'      => 'checkbox',
            'title'     => __('display music player', 'nhp-opts'),
            'std'       => 1
        ),
        array(
            'id'        => 'general-music-player-autoplay',
            'type'      => 'checkbox',
            'title'     => __('music player autoplay', 'nhp-opts'),
            'std'       => 1
        ),
        array(
            'id'        => 'general-contacts-email',
            'type'      => 'text',
            'title'     => __('contact form email', 'nhp-opts')
        ),
        array(
            'id'        => 'general-socials-feed',
            'type'      => 'text',
            'validate'  => 'url',
            'title'     => __('ico feed url', 'nhp-opts'),
        ),
        array(
            'id'        => 'general-socials-facebook',
            'type'      => 'text',
            'validate'  => 'url',
            'title'     => __('ico facebook url', 'nhp-opts')
        ),
        array(
            'id'        => 'general-socials-twitter',
            'type'      => 'text',
            'validate'  => 'url',
            'title'     => __('ico twitter url', 'nhp-opts')
        ),
        array(
            'id'        => 'general-socials-plus',
            'type'      => 'text',
            'validate'  => 'url',
            'title'     => __('ico google plus url', 'nhp-opts')
        ),
        array(
            'id'        => 'general-socials-dribbble',
            'type'      => 'text',
            'validate'  => 'url',
            'title'     => __('ico dribbble url', 'nhp-opts')
        ),
        array(
            'id'        => 'general-socials-flickr',
            'type'      => 'text',
            'validate'  => 'url',
            'title'     => __('ico flickr url', 'nhp-opts')
        )
    )
);

$section_home       = array(
    'title'     => __('Home Page', 'nhp-opts'),
    'icon'      => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_020_home.png',
    'fields'    => array(
        array(
            'id'        => 'home-claim-line-1',
            'type'      => 'text',
            'title'     => __('claim line 1', 'nhp-opts')
        ),
        array(
            'id'        => 'home-claim-line-2',
            'type'      => 'text',
            'title'     => __('claim line 1', 'nhp-opts')
        ),
        array(
            'id'        => 'home-background',
            'type'      => 'multi_text',
            'title'     => __('background images', 'nhp-opts'),
            'sub_desc'  => __('Upload the images inside the media section then paste here the image urls', 'nhp-opts'),
            'validate'  => 'url'
        )
    )
);

$section_colors    = array(
    'title'     => __('Colors', 'nhp-opts'),
    'icon'      => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_091_adjust.png',
    'desc'      => __('Leave the fields blank for the default color value.', 'nhp-opts'),
    'fields'    => array(
        array(
            'id'        => 'color-base',
            'type'      => 'color',
            'title'     => __('Base color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-anchors',
            'type'      => 'color',
            'title'     => __('Anchors color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-h1',
            'type'      => 'color',
            'title'     => __('H1 color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-h2',
            'type'      => 'color',
            'title'     => __('H2 color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-h3',
            'type'      => 'color',
            'title'     => __('H3 color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-h4',
            'type'      => 'color',
            'title'     => __('H4 color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-h5',
            'type'      => 'color',
            'title'     => __('H5 color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-anchors-menu',
            'type'      => 'color',
            'title'     => __('Menu anchors color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-anchors-menu-hover',
            'type'      => 'color',
            'title'     => __('Menu anchors color (over)', 'nhp-opts')
        ),
        array(
            'id'        => 'color-anchors-menu-selected',
            'type'      => 'color',
            'title'     => __('Menu anchors color (selected)', 'nhp-opts')
        ),
        array(
            'id'        => 'color-player',
            'type'      => 'color',
            'title'     => __('Player color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-footer',
            'type'      => 'color',
            'title'     => __('Footer color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-page',
            'type'      => 'color',
            'title'     => __('Page color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-page-menu',
            'type'      => 'color',
            'title'     => __('Menu page color', 'nhp-opts')
        ),
        array(
            'id'        => 'color-page-menu-hover',
            'type'      => 'color',
            'title'     => __('Menu page color (over)', 'nhp-opts')
        ),
        array(
            'id'        => 'color-comment-meta',
            'type'      => 'color',
            'title'     => __('Comment meta color', 'nhp-opts')
        ),
        array(
            'id'        => 'collections-anchors',
            'type'      => 'color',
            'title'     => __('Collection box anchors color', 'nhp-opts')
        ),
        array(
            'id'        => 'collections-box-border',
            'type'      => 'color',
            'title'     => __('Collection box border color', 'nhp-opts')
        ),
        array(
            'id'        => 'collections-pagelink-over',
            'type'      => 'color',
            'title'     => __('Collection page links color (over)', 'nhp-opts')
        ),
        array(
            'id'        => 'collections-pageimagelink-over',
            'type'      => 'color',
            'title'     => __('Collection page image links color (over)', 'nhp-opts')
        ),
        array(
            'id'        => 'collections-blockquote',
            'type'      => 'color',
            'title'     => __('Collection quote color', 'nhp-opts')
        ),
        array(
            'id'        => 'collections-blockquote-author',
            'type'      => 'color',
            'title'     => __('Collection quote author color', 'nhp-opts')
        ),
        array(
            'id'        => 'collections-boxlink',
            'type'      => 'color',
            'title'     => __('Collection box link color', 'nhp-opts')
        ),
        array(
            'id'        => 'post-list-title',
            'type'      => 'color',
            'title'     => __('Post list title color', 'nhp-opts')
        ),
        array(
            'id'        => 'post-list-date',
            'type'      => 'color',
            'title'     => __('Post list date color', 'nhp-opts')
        ),
        array(
            'id'        => 'post-list-continue',
            'type'      => 'color',
            'title'     => __('Post list continue anchor color', 'nhp-opts')
        ),
        array(
            'id'        => 'post-list-continue-over',
            'type'      => 'color',
            'title'     => __('Post list continue anchor color', 'nhp-opts')
        ),
        array(
            'id'        => 'post-list-pagination',
            'type'      => 'color',
            'title'     => __('Post list pagination color', 'nhp-opts')
        ),
        array(
            'id'        => 'post-list-pagination-sel',
            'type'      => 'color',
            'title'     => __('Post list pagination color (selected)', 'nhp-opts')
        ),
        array(
            'id'        => 'form-label',
            'type'      => 'color',
            'title'     => __('Form label color', 'nhp-opts')
        ),
        array(
            'id'        => 'form-fields',
            'type'      => 'color',
            'title'     => __('Form fields color', 'nhp-opts')
        ),
    )
);

array_push( $sections, $section_general );
array_push( $sections, $section_home    );
array_push( $sections, $section_colors  );            
                
$tabs = array();
            
    $theme_data = wp_get_theme();
    $theme_uri = $theme_data->get('ThemeURI');
    $description = $theme_data->get('Description');
    $author = $theme_data->get('Author');
    $version = $theme_data->get('Version');
    $tags = $theme_data->get('Tags');

    $theme_info = '<div class="nhp-opts-section-desc">';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'nhp-opts').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'nhp-opts').$author.'</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'nhp-opts').$version.'</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-description">'.$description.'</p>';
    $theme_info .= '<p class="nhp-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'nhp-opts').implode(', ', $tags).'</p>';
    $theme_info .= '</div>';

    $tabs['theme_info'] = array(
        'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_195_circle_info.png',
        'title' => __('Theme Information', 'nhp-opts'),
        'content' => $theme_info
    );

    global $NHP_Options;
    $NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
    print_r($field);
    print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
    
    $error = false;
    $value =  'just testing';
    /*
    do your validation
    
    if(something){
        $value = $value;
    }elseif(somthing else){
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */
    
    $return['value'] = $value;
    if($error == true){
        $return['error'] = $field;
    }
    return $return;
    
}//function
?>