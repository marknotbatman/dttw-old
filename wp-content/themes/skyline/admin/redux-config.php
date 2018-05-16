<?php
/**
 * For full documentation, please visit: http://docs.reduxframework.com/
 * For a more extensive sample-config file, you may look at:
 * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
 */
if (!class_exists('Redux')) {
    return;
}
// This is your option name where all the Redux data is stored.
$opt_name = "skyline_data";
/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */
$theme    = wp_get_theme(); // For use with some settings. Not necessary.
$args     = array(
    'opt_name' => 'skyline_data',
    'dev_mode' => FALSE,
    'use_cdn' => FALSE,
    'display_name' => 'Skyline Options',
    'display_version' => '',
    'page_title' => 'Skyline Options',
    'update_notice' => TRUE,
    'admin_bar' => TRUE,
	'admin_bar_icon' => 'dashicons-admin-generic',
    'menu_type' => 'menu',
    'menu_title' => 'Skyline Options',
    'allow_sub_menu' => TRUE,
    'page_parent_post_type' => 'your_post_type',
    'customizer' => TRUE,
    'default_show' => TRUE,
    'default_mark' => '*',
    'hints' => array(
        'icon_position' => 'right',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'light'
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right'
        ),
        'tip_effect' => array(
            'show' => array(
                'duration' => '500',
                'event' => 'mouseover'
            ),
            'hide' => array(
                'duration' => '500',
                'event' => 'mouseleave unfocus'
            )
        )
    ),
    'output' => TRUE,
    'output_tag' => TRUE,
    'settings_api' => TRUE,
    'cdn_check_time' => '1440',
    'compiler' => TRUE,
    'page_permissions' => 'manage_options',
    'save_defaults' => TRUE,
    'show_import_export' => FALSE,
    'database' => 'options',
    'transient_time' => '3600',
    'network_sites' => TRUE,
    'system_info' => TRUE
);
Redux::setArgs($opt_name, $args);
/*
 * ---> END ARGUMENTS
 */
/*
 *
 * ---> START SECTIONS
 *
 */
Redux::setSection($opt_name, array(
    'title' => esc_html__('Header Options', 'skyline'),
    'icon' => 'el el-icon-caret-up',
    'customizer' => true,
    'fields' => array(
        array(
            'id' => 'home_text',
            'type' => 'text',
            'title' => esc_html__('Homepage Name', 'skyline'),
            'subtitle' => esc_html__('The name of your homepage. This will be displayed in the breadcrumbs. Default: "Home"', 'skyline'),
            'default' => 'Home'
        ),
        array(
            'id' => 'logo_img',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Logo Upload', 'skyline'),
            'compiler' => 'true',
            'subtitle' => esc_html__('Set the main logo graphic', 'skyline'),
            'default' => array(
                'url' => ''
            )
        ),
        array(
            'id' => 'logo_text',
            'type' => 'text',
            'title' => esc_html__('Logo Text', 'skyline'),
            'subtitle' => esc_html__('The text logo is only used if there is no graphic one', 'skyline'),
            'default' => 'Skyline'
        ),
        array(
            'id' => 'logo_img_transparent',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Logo Upload for Transparent Navigation', 'skyline'),
            'compiler' => 'true',
            'subtitle' => esc_html__('You can assign a different logo for the transparent navigation option. This is only available for the Top Navigation.', 'skyline'),
            'desc' => esc_html__('A light colored version of your logo will work best, preferably white.', 'skyline'),
            'default' => array(
                'url' => ''
            )
        ),
        array(
            'id' => 'main_nav_transparent_bg',
            'type' => 'select',
            'title' => esc_html__('Select Transparent Navigation Background', 'skyline'),
            'desc' => esc_html__('The background color and transparency when the transparent navigation is selected.', 'skyline'),
            'options' => array(
                '1' => '100% Transparent',
                '2' => 'White Transparency 10%',
                '3' => 'Black Transparency 10%'
            ),
            'default' => '2'
        ),
        array(
            'id' => 'favicon',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Favicon Upload', 'skyline'),
            'compiler' => 'true',
            'subtitle' => esc_html__('Your Favicon should be 16px by 16px', 'skyline'),
            'default' => array(
                'url' => ''
            )
        ),
		   )
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-icon-refresh',
    'title' => esc_html__('Page Loader Options', 'skyline'),
    'customizer' => true,
    'fields' => array(
		 array(
            'id' => 'page_loader',
            'type' => 'switch',
            'title' => esc_html__('Page Loader Animation', 'skyline'),
            'desc' => esc_html__('Turn the page loader graphic on or off.', 'skyline'),
            'default' => false,
        ),
		   array(
            'id' => 'page_loader_bg_color',
            'type' => 'color',
            'title' => esc_html__('Page Loader Background Color', 'skyline'),
            'subtitle' => esc_html__('The background color for the page loader.', 'skyline'),
            'default' => '#FFFFFF',
            'validate' => 'color',
            'required' => array(
                'page_loader',
                '=',
                true
            )
        ),
		array(
            'id' => 'page_loader_color',
            'type' => 'color',
            'title' => esc_html__('Page Loader Color', 'skyline'),
            'subtitle' => esc_html__('The color for the page loader graphic.', 'skyline'),
            'default' => '#888888',
            'validate' => 'color',
            'required' => array(
                'page_loader',
                '=',
                true
            )
        ),
    )
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-lines',
    'title' => esc_html__('Navigation Builder', 'skyline'),
    'customizer' => true,
    'fields' => array(
        array(
            'id' => 'nav_type',
            'type' => 'image_select',
            'title' => esc_html__('Navigation Style', 'skyline'),
            'subtitle' => esc_html__('Select your preferred navigation style:', 'skyline'),
            'options' => array(
                '1' => array(
                    'alt' => 'Minimal Left',
                    'img' => SKYLINE_THEME_URI . '/img/admin/header1.png'
                ),
                '2' => array(
                    'alt' => 'Left',
                    'img' => SKYLINE_THEME_URI . '/img/admin/header2.png'
                ),
                '3' => array(
                    'alt' => 'Minimal Right',
                    'img' => SKYLINE_THEME_URI . '/img/admin/header3.png'
                ),
                '4' => array(
                    'alt' => 'Right',
                    'img' => SKYLINE_THEME_URI . '/img/admin/header4.png'
                ),
                '5' => array(
                    'alt' => 'Top',
                    'img' => SKYLINE_THEME_URI . '/img/admin/header5.png'
                ),
                '6' => array(
                    'alt' => 'Top with Bar',
                    'img' => SKYLINE_THEME_URI . '/img/admin/header6.png'
                )
            ),
            'default' => '5'
        ),
        array(
            'id' => 'nav_link_type',
            'type' => 'image_select',
            'title' => esc_html__('Navigation Active Link Style', 'skyline'),
            'subtitle' => esc_html__('Select your preferred navigation active link style:', 'skyline'),
            'options' => array(
                '1' => array(
                    'alt' => 'Standard',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link1.png'
                ),
                '2' => array(
                    'alt' => 'Underlined',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link2.png'
                ),
                '3' => array(
                    'alt' => 'Border Square',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link3.png'
                ),
                '4' => array(
                    'alt' => 'Border Rounded',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link4.png'
                ),
                '5' => array(
                    'alt' => 'Border Round',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link5.png'
                ),
                '6' => array(
                    'alt' => 'Solid Square',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link6.png'
                ),
                '7' => array(
                    'alt' => 'Solid Rounded',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link7.png'
                ),
                '8' => array(
                    'alt' => 'Solid Round',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link8.png'
                ),
                '9' => array(
                    'alt' => 'Bar Top',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link9.png'
                ),
                '10' => array(
                    'alt' => 'Bar Bottom',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link10.png'
                ),
				 '11' => array(
                    'alt' => 'Arrow Bottom',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link11.png'
                ),
				'12' => array(
                    'alt' => 'Arrow Top',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link12.png'
                ),
				 '13' => array(
                    'alt' => 'Caret Top',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link13.png'
                ),
				 '14' => array(
                    'alt' => 'Caret Bottom',
                    'img' => SKYLINE_THEME_URI . '/img/admin/nav_link14.png'
                )
            ),
            'default' => '1',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '5',
                    '6'
                )
            )
        ),
		 array(
            'id' => 'main_nav_border_width',
            'type' => 'slider',
            'title' => esc_html__('Nav Link Border Width', 'skyline'),
            'subtitle' => esc_html__('Set the border width in pixels for the link style chosen above.', 'skyline'),
            'default' => 2,
            'min' => 1,
            'step' => 1,
            'max' => 4,
            'display_value' => 'label',
            'required' => array(
                'nav_link_type',
                '=',
                array(
                    '2',
                    '3',
					'4',
					'5',
                )
            )
        ),
        array(
            'id' => 'header_text',
            'type' => 'textarea',
            'title' => esc_html__('Navigation Caption', 'skyline'),
            'desc' => esc_html__('This is a great place to include contact information like a phone number and email address. (HTML supported: <a> <i> <br> <strong>)', 'skyline'),
            'subtitle' => esc_html__('The text/information to be display in the bar above the navigation.', 'skyline'),
            'default' => 'Skyline &nbsp; <i class="fa-phone"></i>&nbsp;&nbsp; 555 444 9292',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '1',
                    '2',
                    '3',
                    '4',
                    '6'
                )
            )
        ),
        array(
            'id' => 'main_nav_height',
            'type' => 'slider',
            'title' => esc_html__('Top Navigation Height', 'skyline'),
            'subtitle' => esc_html__('If you choose the Top Navigation Style, you can choose the height in pixels.', 'skyline'),
            'default' => 60,
            'min' => 40,
            'step' => 1,
            'max' => 200,
            'display_value' => 'label',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '5',
                    '6'
                )
            )
        ),
        array(
            'id' => 'main_nav_logo_height',
            'type' => 'slider',
            'title' => esc_html__('Top Navigation Logo Height', 'skyline'),
            'subtitle' => esc_html__('If you choose the Top Navigation Style, you can choose the logo height in pixels.', 'skyline'),
            'default' => 44,
            'min' => 30,
            'step' => 1,
            'max' => 150,
            'display_value' => 'label',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '5',
                    '6'
                )
            )
        ),
        
        array(
            'id' => 'main_nav_topbar_bgcolor',
            'type' => 'color',
            'title' => esc_html__('Top Bar Background Color', 'skyline'),
            'subtitle' => esc_html__('The background color for the top information bar above the main navigation.', 'skyline'),
            'default' => '#FFFFFF',
            'validate' => 'color',
            'required' => array(
                'nav_type',
                '=',
                6
            )
        ),
        array(
            'id' => 'main_nav_topbar_fontcolor',
            'type' => 'color',
            'title' => esc_html__('Top Bar Font Color', 'skyline'),
            'subtitle' => esc_html__('The font color for the top information bar above the main navigation.', 'skyline'),
            'default' => '#414648',
            'validate' => 'color',
            'required' => array(
                'nav_type',
                '=',
                6
            )
        ),
        array(
            'id' => 'navigation_typography',
            'type' => 'typography',
            'title' => esc_html__('Navigation Typography', 'skyline'),
            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true, // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets' => false, // Only appears if google is true and subsets not set to false
            'font-size' => true,
            'line-height' => false,
            'letter-spacing' => true, // Defaults to false
            'text-transform' => true,
            'color' => false,
            'text-align' => false,
            'preview' => true, // Disable the previewer
            'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
            'output' => array(
                'nav.main-navigation',
                '.site-description',
                '.nav-top .site-description'
            ), // An array of CSS selectors to apply this font style to dynamically
            'units' => 'px', // Defaults to px
            'subtitle' => esc_html__('Main navigation typography settings', 'skyline'),
            'default' => array(
                'font-style' => '500',
                'font-family' => 'Raleway',
                'font-size' => '14px',
                'letter-spacing' => '1px',
                'text-transform' => 'None'
            ),
            'preview' => array(
                'text' => 'The quick brown fox jumps over the lazy dog.'
            )
        ),
        
        array(
            'id' => 'main_nav_bgcolor',
            'type' => 'color',
            'title' => esc_html__('Main Navigation Background Color', 'skyline'),
            'subtitle' => esc_html__('The background color for the main navigation.', 'skyline'),
            'default' => '#FFFFFF',
            'validate' => 'color'
        ),
        array(
            'id' => 'main_nav_fontcolor',
            'type' => 'color',
            'title' => esc_html__('Main Navigation Link Color', 'skyline'),
            'subtitle' => esc_html__('The font color for the main navigation.', 'skyline'),
            'default' => '#414648',
            'validate' => 'color'
        ),
        array(
            'id' => 'main_nav_font_hover_color',
            'type' => 'color',
            'title' => esc_html__('Main Navigation Link Hover/Active Color', 'skyline'),
            'subtitle' => esc_html__('The hover/active font color for the main navigation.', 'skyline'),
            'default' => '#999999',
            'validate' => 'color'
        ),
        array(
            'id' => 'main_nav_link_border_color',
            'type' => 'color',
            'title' => esc_html__('Main Navigation Link Border Color', 'skyline'),
            'subtitle' => esc_html__('The bottom border color of the menu links.', 'skyline'),
            'default' => '#EEEEEE',
            'validate' => 'color',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '1',
                    '2',
                    '3',
                    '4'
                )
            )
        ),
        array(
            'id' => 'main_nav_border',
            'type' => 'border',
            'title' => esc_html__('Main Navigation Border', 'skyline'),
            'subtitle' => esc_html__('This is the border of the main navigation.', 'skyline'),
            'all' => false,
            'output' => array(
                '.site-header',
                '.nav-transparent .site-header.show-nav',
				'.nav-left .site-header'
            ), // An array of CSS selectors to apply this font style to
            'default' => array(
                'border-color' => '#EEEEEE',
                'border-style' => 'solid',
                'border-top' => '0px',
                'border-right' => '1px',
                'border-bottom' => '0px',
                'border-left' => '0px'
            )
        ),
        array(
            'id' => 'main_nav_topbar_social_icons_border',
            'type' => 'color',
            'title' => esc_html__('Social Icons Border Color', 'skyline'),
            'subtitle' => esc_html__('The border color for the social icons shown in the navigation.', 'skyline'),
            'default' => '#EEEEEE',
            'validate' => 'color',
            'required' => array(
                'nav_type',
                '=',
                6
            )
        ),
         array(
            'id' => 'main_nav_width',
            'type' => 'button_set',
            'title' => esc_html__('Main Navigation Width', 'skyline'),
            'subtitle' => esc_html__('Default: Container Width', 'skyline'),
            //Must provide key => value pairs for radio options
            'options' => array(
                '1' => 'Container Width',
                '2' => 'Full Width'
            ),
            'default' => 'Container Width',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '5',
                    '6'
                )
            )
        ),
		 array(
                'id'       => 'search_location',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Search Icon Location', 'skyline' ),
                'subtitle'     => esc_html__( 'The location of the search icon.', 'skyline' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Main Navigation',
                    '2' => 'Float at Bottom of Screen',
                    '3' => 'Hide Search Icon'
                ),
                'default'  => '2'
            ),
    )
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-indent-left',
    'title' => esc_html__('Drop Menu Options', 'skyline'),
    'customizer' => true,
    'fields' => array(
           array(
            'id' => 'drop_menu_typography',
            'type' => 'typography',
            'title' => esc_html__('Navigation Typography', 'skyline'),
            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true, // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets' => false, // Only appears if google is true and subsets not set to false
            'font-size' => true,
            'line-height' => false,
            'letter-spacing' => true, // Defaults to false
            'text-transform' => true,
            'color' => false,
            'text-align' => false,
            'preview' => true, // Disable the previewer
            'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
            'output' => array(
                'nav.main-navigation .sub-menu',
            ), // An array of CSS selectors to apply this font style to dynamically
            'units' => 'px', // Defaults to px
            'subtitle' => esc_html__('Main navigation typography settings', 'skyline'),
            'default' => array(
                'font-style' => '500',
                'font-family' => 'Raleway',
                'font-size' => '13px',
                'letter-spacing' => '1px',
                'text-transform' => 'None'
            ),
            'preview' => array(
                'text' => 'The quick brown fox jumps over the lazy dog.'
            )
        ),
   
        array(
            'id' => 'main_nav_drop_menu_bg',
            'type' => 'color',
            'title' => esc_html__('Drop Menu Background Color', 'skyline'),
            'subtitle' => esc_html__('The background color for the drop menu.', 'skyline'),
            'default' => '#50525f',
            'validate' => 'color',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '5',
                    '6'
                )
            )
        ),
        array(
            'id' => 'main_nav_drop_menu_font',
            'type' => 'color',
            'title' => esc_html__('Drop Menu Link Color', 'skyline'),
            'subtitle' => esc_html__('The font color for the drop menu.', 'skyline'),
            'default' => '#FFFFFF',
            'validate' => 'color',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '5',
                    '6'
                )
            )
        ),
        array(
            'id' => 'main_nav_drop_menu_font_hover',
            'type' => 'color',
            'title' => esc_html__('Drop Menu Link Hover/Active Color', 'skyline'),
            'subtitle' => esc_html__('The hover/active font color for the drop menu.', 'skyline'),
            'default' => '#999999',
            'validate' => 'color',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '5',
                    '6'
                )
            )
        ),
        array(
            'id' => 'main_nav_drop_menu_border',
            'type' => 'color',
            'title' => esc_html__('Drop Menu Link Border Color', 'skyline'),
            'subtitle' => esc_html__('The border color for each of the items in the drop menu.', 'skyline'),
            'default' => '#595d6b',
            'validate' => 'color',
            'required' => array(
                'nav_type',
                '=',
                array(
                    '5',
                    '6'
                )
            )
        ),
     
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Mobile Menu Options', 'skyline'),
    'customizer' => true,
    'icon' => 'el el-resize-small',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(
        array(
            'id' => 'mobile_menu',
            'type' => 'slider',
            'title' => esc_html__('Show Mobile Navigation @', 'skyline'),
            'subtitle' => esc_html__('Choose when to show the Responsive Mobile Navigation', 'skyline'),
            'desc' => esc_html__('Default is 992px', 'skyline'),
            'default' => 992,
            'min' => 768,
            'step' => 8,
            'max' => 1920,
            'display_value' => 'label'
        ),
       
		 array(
            'id' => 'mobile_email',
            'type' => 'text',
            'title' => esc_html__('Include an Email Icon in the mobile navigation?', 'skyline'),
            'subtitle' => esc_html__('Enter your email address. Example: support@creativelycoded.com', 'skyline'),
            
            'default' => ''
        ),
		 array(
            'id' => 'mobile_phone',
            'type' => 'text',
            'title' => esc_html__('Include an Phone Icon in the mobile navigation?', 'skyline'),
            'subtitle' => esc_html__('Enter your hone number without spaces. Example: 18883334444', 'skyline'),
            
            'default' => ''
        ),
		 array(
                'id'       => 'search_icon_mobile',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Include a Search Icon in Mobile Menu', 'skyline' ),
                'subtitle'     => esc_html__( 'Show the Search Icon in the mobile navigation?', 'skyline' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Yes',
                    '2' => 'No',
                ),
                'default'  => '1'
            ),
    ),
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Typography Options', 'skyline'),
    'customizer' => true,
    'icon' => 'el el-fontsize',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(
        
        
        array(
            'id' => 'body_typography',
            'type' => 'typography',
            'title' => esc_html__('Body Typography', 'skyline'),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true, // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets' => false, // Only appears if google is true and subsets not set to false
            'font-size' => true,
            'line-height' => false,
            //'word-spacing'  => true,  // Defaults to false
            //'letter-spacing'=> true,  // Defaults to false
            'color' => true,
            'text-align' => false,
            'preview' => true, // Disable the previewer
            'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
            'output' => array(
                'body'
            ), // An array of CSS selectors to apply this font style to dynamically
            //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
            'units' => 'px', // Defaults to px
            'subtitle' => esc_html__('Typography option with each property can be called individually.', 'skyline'),
            'default' => array(
                'color' => '#656565',
                'font-style' => '400',
                'font-family' => 'Lora',
                'font-size' => '15px'
            ),
            'preview' => array(
                'text' => 'The quick brown fox jumps over the lazy dog.'
            )
        ),
        array(
            'id' => 'heading_typography',
            'type' => 'typography',
            'title' => esc_html__('Heading Typography', 'skyline'),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true, // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets' => false, // Only appears if google is true and subsets not set to false
            'font-size' => false,
            'text-transform' => true,
            'line-height' => false,
            //'word-spacing'  => true,  // Defaults to false
            //'letter-spacing'=> true,  // Defaults to false
            'color' => true,
            'text-align' => false,
            'preview' => true, // Disable the previewer
            'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
            'output' => array(
                'h1',
                'h2',
                'h3',
                'h4',
                'h5',
                'h6',
                '.counter',
                '.post-format-icon',
                '.post-format-text',
                '.blog-info-bottom a.read-more-link',
                '.sticky_post',
                '.page-numbers',
				'.post_nav p'
            ), // An array of CSS selectors to apply this font style to dynamically
            //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
            'units' => 'px', // Defaults to px						
            'subtitle' => esc_html__('Settings for Heading Tags, H1, H2, H3, H4, H5, H6', 'skyline'),
            'default' => array(
                'color' => '#404548',
                'font-style' => '700',
                'font-family' => 'Raleway',
                'text-transform' => 'None'
            ),
            'preview' => array(
                'text' => 'The quick brown fox jumps over the lazy dog.'
            )
        ),
        array(
            'id' => 'button_typography',
            'type' => 'typography',
            'title' => esc_html__('Button Typography', 'skyline'),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true, // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets' => false, // Only appears if google is true and subsets not set to false
            'font-size' => false,
            'text-transform' => true,
            'line-height' => false,
            //'word-spacing'  => true,  // Defaults to false
            'letter-spacing' => true, // Defaults to false
            'color' => false,
            'text-align' => false,
            'preview' => true, // Disable the previewer
            'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
            'output' => array(
                '.btn',
                '#comments .comment-meta',
                '.comment-form input[type="submit"]',
                '.wpcf7-submit',
                '.woocommerce .button',
                '.add_to_cart_button',
                '.woocommerce a.button',
                '.woocommerce input.button',
                '.woocommerce-page #content input.button',
                '.woocommerce button.button',
                '.woocommerce-page button.button',
                '.woocommerce #respond input#submit',
                '.woocommerce-page #respond input#submit',
                '.icon-style1 a',
                '.icon-style2 a'
            ), // An array of CSS selectors to apply this font style to dynamically
            //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
            'units' => 'px', // Defaults to px						
            'subtitle' => esc_html__('Global settings for all buttons', 'skyline'),
            'default' => array(
                'font-style' => '700',
                'font-family' => 'Open Sans',
                'text-transform' => 'Uppercase',
                'letter-spacing' => '0'
            ),
            'preview' => array(
                'text' => 'The quick brown fox jumps over the lazy dog.'
            )
        ),
		  array(
            'id' => 'button_border',
            'type' => 'slider',
            'title' => esc_html__('Buttons Border Width', 'skyline'),
            'subtitle' => esc_html__('Choose the border width of the buttons', 'skyline'),
            'desc' => esc_html__('Default is 2px', 'skyline'),
            'default' => 2,
            'min' => 1,
            'step' => 1,
            'max' => 5,
            'display_value' => 'label'
        )
    )
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-brush',
    'title' => esc_html__('Style Options', 'skyline'),
    'customizer' => true,
    'fields' => array(
        array(
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'skyline'),
            'subtitle' => esc_html__('The primary color of the theme. Used for various accent colors throughout the theme.', 'skyline'),
            'default' => '#5493EA',
            'validate' => 'color'
        ),
        array(
            'id' => 'link_color',
            'type' => 'color',
            'title' => esc_html__('Link Color', 'skyline'),
            'subtitle' => esc_html__('The primary color text links.', 'skyline'),
            'default' => '#414648',
            'validate' => 'color'
        ),
        array(
            'id' => 'link_hover_color',
            'type' => 'color',
            'title' => esc_html__('Link Hover Color', 'skyline'),
            'subtitle' => esc_html__('The color of text links when a user hovers over them.', 'skyline'),
            'default' => '#999999',
            'validate' => 'color'
        ),
        array(
            'id' => 'global_radius',
            'type' => 'radio',
            'title' => esc_html__('Global Radius', 'skyline'),
            'subtitle' => esc_html__('Radius of default theme items.', 'skyline'),
            'desc' => esc_html__('This option will affect the radius of all border items within the theme. This includes scroll to top and search icons, default buttons, form elements and a few other items.', 'skyline'),
            //Must provide key => value pairs for radio options
            'options' => array(
                '0' => 'Square Elements',
                '3' => 'Rounded Elements (3px)',
                '500' => 'Circle Elements'
            ),
            'default' => '3'
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Page Options', 'skyline'),
    'customizer' => true,
    'icon' => 'el el-icon-list-alt',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(
        array(
            'id' => 'breadcrumb-page',
            'type' => 'switch',
            'title' => esc_html__('Page Breadcrumbs', 'skyline'),
            'subtitle' => esc_html__('Turn page breadcrumbs on or off', 'skyline'),
            'desc' => esc_html__('You can override this option when creating individual pages', 'skyline'),
            'default' => false,
        ),
        array(
            'id' => 'page-sidebar',
            'type' => 'switch',
            'title' => esc_html__('Page Sidebar', 'skyline'),
            'subtitle' => esc_html__('Archive, Search and Pages', 'skyline'),
            'desc' => esc_html__('Turn the sidebar on or off for Archive, Search and Pages.', 'skyline'),
            'default' => false,
        ),
     
    ),
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-icon-edit',
    'title' => esc_html__('Blog Options', 'skyline'),
    'customizer' => true,
    'heading' => esc_html__('Blog Options', 'skyline'),
    'desc' => esc_html__('Setup the blog options here.', 'skyline'),
    'fields' => array(
        array(
            'id' => 'blog-layout',
            'type' => 'radio',
            'title' => esc_html__('Blog Layout', 'skyline'),
            'subtitle' => esc_html__('Choose the default blog layout for the blogroll', 'skyline'),
            'default' => '1',
            //Must provide key => value pairs for radio options
            'options' => array(
                '1' => 'Traditional Layout',
                '2' => '2 Column Masonry',
                '3' => '3 Column Masonry',
                '4' => '4 Column Masonry',
                '5' => '2 Column Grid',
                '6' => '3 Column Grid',
                '7' => '4 Column Grid'
            )
        ),
        
        array(
            'id' => 'blog_bg_color',
            'type' => 'color',
            'title' => esc_html__('Blog Body Background Color', 'skyline'),
            'subtitle' => esc_html__('Set the background color for the blogroll', 'skyline'),
            'default' => '#F6F6F6',
            'validate' => 'color'
        ),
        
        array(
            'id' => 'blog-text-wrapper-border',
            'type' => 'border',
            'title' => esc_html__('Blog Text Wrapper Border', 'skyline'),
            'subtitle' => esc_html__('This is the border that wraps the text for each blog post', 'skyline'),
            'all' => false,
            'output' => array(
                '.blog .blog-text-wrapper',
                '#blog-traditional #sidebar .sidebar-wrapper',
                '#blog-grid-2column #sidebar .sidebar-wrapper',
                '#blog-grid-3column #sidebar .sidebar-wrapper',
                '#blog-grid-4column #sidebar .sidebar-wrapper',
                '#blog-masonry-2column #sidebar .sidebar-wrapper',
                '#blog-masonry-3column #sidebar .sidebar-wrapper',
                '#blog-masonry-4column #sidebar .sidebar-wrapper',
				'#blog-traditional blog-text-wrapper',
            ), // An array of CSS selectors to apply this font style to
            'default' => array(
                'border-color' => '#EEEEEE',
                'border-style' => 'solid',
                'border-top' => '0px',
                'border-right' => '0px',
                'border-bottom' => '3px',
                'border-left' => '0px'
            )
        ),
        
        
        array(
            'id' => 'blog-sidebar',
            'type' => 'switch',
            'title' => esc_html__('Blogroll Sidebar', 'skyline'),
            'subtitle' => esc_html__('Turn on or off the sidebar for the blogroll', 'skyline'),
            'default' => false
        ),
        
        array(
            'id' => 'post-layout',
            'type' => 'radio',
            'title' => esc_html__('Post Layout', 'skyline'),
            'subtitle' => esc_html__('Choose the post layout style', 'skyline'),
            
            //Must provide key => value pairs for radio options
            'options' => array(
                '1' => 'Traditional Layout',
                '2' => 'Fullwidth Layout'
            ),
            'default' => '1'
        ),
        array(
            'id' => 'post-sidebar',
            'type' => 'switch',
            'title' => esc_html__('Post Sidebar', 'skyline'),
            'subtitle' => esc_html__('Turn on or off the sidebar for the posts page', 'skyline'),
            'default' => false
        ),
        array(
            'id' => 'blog_breadcrumb',
            'type' => 'switch',
            'title' => esc_html__('Post/Blog Breadcrumbs', 'skyline'),
            'subtitle' => esc_html__('Choose to show or hide the breadcrumbs on the blog and post pages.', 'skyline'),
            'default' => true
        ),
        array(
            'id' => 'post-avatar',
            'type' => 'switch',
            'title' => esc_html__('Post Author Avatar', 'skyline'),
            'subtitle' => esc_html__('Turn the post author avatar image on or off', 'skyline'),
            'default' => true
        )
    )
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-icon-paper-clip',
    'customizer' => true,
    'title' => esc_html__('Breadcrumb Options', 'skyline'),
    'fields' => array(
        array(
            'id' => 'breadcrumb_style',
            'type' => 'image_select',
            'title' => esc_html__('Breadcrumb Style', 'skyline'),
            'subtitle' => esc_html__('Select your preferred breadcrumb style:', 'skyline'),
            'desc' => esc_html__('Breadcrumbs can be turned on/off on specific pages and posts.', 'skyline'),
            'options' => array(
                '1' => array(
                    'alt' => 'Breadcrumb 1',
                    'img' => SKYLINE_THEME_URI . '/img/admin/bread1.png'
                ),
                '2' => array(
                    'alt' => 'Breadcrumb 2',
                    'img' => SKYLINE_THEME_URI . '/img/admin/bread2.png'
                ),
                '3' => array(
                    'alt' => 'Breadcrumb 3',
                    'img' => SKYLINE_THEME_URI . '/img/admin/bread3.png'
                ),
                '4' => array(
                    'alt' => 'Breadcrumb 4',
                    'img' => SKYLINE_THEME_URI . '/img/admin/bread4.png'
                ),
                '5' => array(
                    'alt' => 'Breadcrumb 5',
                    'img' => SKYLINE_THEME_URI . '/img/admin/bread5.png'
                ),
                '6' => array(
                    'alt' => 'Breadcrumb 6',
                    'img' => SKYLINE_THEME_URI . '/img/admin/bread6.png'
                ),
                '7' => array(
                    'alt' => 'Breadcrumb 7',
                    'img' => SKYLINE_THEME_URI . '/img/admin/bread7.png'
                ),
				 '8' => array(
                    'alt' => 'Breadcrumb 8',
                    'img' => SKYLINE_THEME_URI . '/img/admin/bread8.png'
                )
            ),
            'default' => '1'
        ),
        array(
            'id' => 'breadcrumb_height',
            'type' => 'slider',
            'title' => esc_html__('Breadcrumb Height', 'skyline'),
            'subtitle' => esc_html__('The top and bottom padding around the breadcrumb. Default: 36px', 'skyline'),
            'default' => 36,
            'min' => 0,
            'step' => 2,
            'max' => 150,
            'display_value' => 'label'
        ),
        
        array(
            'id' => 'breadcrumb_bgcolor',
            'type' => 'color',
            'title' => esc_html__('Breadcrumb Background Color', 'skyline'),
            'subtitle' => esc_html__('The background color for your breadcrumb.', 'skyline'),
            'default' => '#5493EA',
            'validate' => 'color'
        ),
        array(
            'id' => 'breadcrumb_text_color',
            'type' => 'color',
            'title' => esc_html__('Breadcrumb Text Color', 'skyline'),
            'subtitle' => esc_html__('The text and link color for your breadcrumb.', 'skyline'),
            'default' => '#FFFFFF',
            'validate' => 'color'
        ),
        array(
            'id' => 'breadcrumb_border',
            'type' => 'border',
            'title' => esc_html__('Breadcrumb Border Option', 'skyline'),
            'output' => array(
                '#breadcrumb'
            ), // An array of CSS selectors to apply this font style to
            'desc' => esc_html__('Border width in pixels, border style and border color', 'skyline'),
            'default' => array(
                'border-color' => '#EEEEEE',
                'border-style' => 'none',
                'border-top' => '1px',
                'border-right' => '1px',
                'border-bottom' => '1px',
                'border-left' => '1px'
            )
        )
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Sidebar Options', 'skyline'),
    'customizer' => true,
    'icon' => 'el el-icon-chevron-right',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(
        array(
            'id' => 'sidebar_headings_typography',
            'type' => 'typography',
            'title' => esc_html__('Sidebar Headings Typography', 'skyline'),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true, // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets' => false, // Only appears if google is true and subsets not set to false
            'font-size' => true,
            'text-transform' => true,
            'line-height' => false,
            'font-family' => false,
            'desc' => 'The font family will stay the same as the Headings font family chosen in the Typography Section.',
            //'word-spacing'  => true,  // Defaults to false
            //'letter-spacing'=> true,  // Defaults to false
            'color' => true,
            'text-align' => false,
            'preview' => true, // Disable the previewer
            'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
            'output' => array(
                '#sidebar h4',
                '#sidebar h1'
            ), // An array of CSS selectors to apply this font style to dynamically
            //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
            'units' => 'px', // Defaults to px						
            'subtitle' => esc_html__('Font settings for the Headings in the sidebar', 'skyline'),
            'default' => array(
                'color' => '#414648',
                'font-style' => 'Bold',
                'font-size' => '14px',
                'text-transform' => 'Uppercase'
            ),
            'preview' => array(
                'text' => 'The quick brown fox jumps over the lazy dog.'
            )
        ),
        array(
            'id' => 'sidebar_typography',
            'type' => 'typography',
            'title' => esc_html__('Sidebar Body Typography', 'skyline'),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true, // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets' => false, // Only appears if google is true and subsets not set to false
            'font-size' => true,
            'text-transform' => true,
            'line-height' => false,
            'font-family' => false,
            'desc' => 'The font family will stay the same as the body font family chosen in the Typography Section.',
            //'word-spacing'  => true,  // Defaults to false
            //'letter-spacing'=> true,  // Defaults to false
            'color' => true,
            'text-align' => false,
            'preview' => true, // Disable the previewer
            'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
            'output' => array(
                '#sidebar'
            ), // An array of CSS selectors to apply this font style to dynamically
            //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
            'units' => 'px', // Defaults to px						
            'subtitle' => esc_html__('Font settings for the body font of the sidebar', 'skyline'),
            'default' => array(
                'color' => '#888',
                'font-style' => 'Normal',
                'font-size' => '13px'
            ),
            'preview' => array(
                'text' => 'The quick brown fox jumps over the lazy dog.'
            )
        )
        
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Form Options', 'skyline'),
    'customizer' => true,
    'icon' => 'el el-icon-ok-circle',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
    'fields' => array(
        array(
            'id' => 'form_options',
            'type' => 'typography',
            'title' => esc_html__('Form Input Typography', 'skyline'),
            //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
            'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
            'font-backup' => true, // Select a backup non-google font in addition to a google font
            //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
            'subsets' => false, // Only appears if google is true and subsets not set to false
            'font-size' => true,
            'text-transform' => false,
            'line-height' => false,
            'font-family' => false,
            'desc' => 'The font family will stay the same as the body font family chosen in the Typography Section.',
            //'word-spacing'  => true,  // Defaults to false
            //'letter-spacing'=> true,  // Defaults to false
            'color' => true,
            'text-align' => false,
            'preview' => true, // Disable the previewer
            'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
            'output' => array(
                'input',
                'select',
                'textarea',
                '.comment-form input',
                '.comment-form input[type="text"]',
                '.comment-form textarea',
                '#sidebar input[type="text"]',
                '.form-control',
                '.search-icon.fa-search'
            ), // An array of CSS selectors to apply this font style to dynamically
            //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
            'units' => 'px', // Defaults to px						
            'subtitle' => esc_html__('Font settings for all inputs and text areas.', 'skyline'),
            'default' => array(
                'color' => '#888888',
                'font-style' => 'Normal',
                'font-size' => '13px'
            ),
            'preview' => array(
                'text' => 'The quick brown fox jumps over the lazy dog.'
            )
        ),
        array(
            'id' => 'input-border',
            'type' => 'border',
            'title' => esc_html__('Form Input Border', 'skyline'),
            'subtitle' => esc_html__('This is the border for all inputs and text areas.', 'skyline'),
            'output' => array(
                'input',
                'select',
                'textarea',
                '#footer-widgets textarea',
                '.input-text',
                'input[type="tel"]',
                '.select2-choice',
                '.select2-container .select2-choice',
                '.comment-form input',
                '.comment-form input[type="text"]',
                '.comment-form textarea',
                '#sidebar input[type="text"]',
                'input[type="text"]',
                'input[type="email"]',
                'textarea.form-control',
                '#footer-widgets input'
            ), // An array of CSS selectors to apply this font style to dynamically
            'default' => array(
                'border-color' => '#EEEEEE',
                'border-style' => 'solid',
                'border-top' => '1px',
                'border-right' => '1px',
                'border-bottom' => '1px',
                'border-left' => '1px'
            )
        ),
        array(
            'id' => 'input-bg-color',
            'type' => 'color',
            'title' => esc_html__('Form Input Background Color', 'skyline'),
            'subtitle' => esc_html__('The background color for all inputs and text areas.', 'skyline'),
            'default' => '#F7F7F7',
            'validate' => 'color'
        )
    )
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-icon-shopping-cart',
    'title' => esc_html__('Shop Options', 'skyline'),
    'customizer' => true,
    'heading' => esc_html__('Shop Options', 'skyline'),
    'desc' => esc_html__('Setup the shop options here.', 'skyline'),
    'fields' => array(
        array(
            'id' => 'shop_text',
            'type' => 'text',
            'title' => esc_html__('Shop Name', 'skyline'),
            'subtitle' => esc_html__('The name of your shop page. This will be displayed in the breadcrumbs. Default: "Shop"', 'skyline'),
            'default' => 'Shop'
        ),
        array(
            'id' => 'breadcrumb-shop',
            'type' => 'switch',
            'title' => esc_html__('Shop Breadcrumbs', 'skyline'),
            'subtitle' => esc_html__('Turn the shop page breadcrumbs on or off', 'skyline'),
            'default' => false
        ),
        array(
            'id' => 'cart-icon-menu',
            'type' => 'switch',
            'title' => esc_html__('Cart Icon in Navigation', 'skyline'),
            'subtitle' => esc_html__('Turn the shopping cart icon on or off in the main menu', 'skyline'),
            'default' => false
        ),
        array(
            'id' => 'shop-bg-color',
            'type' => 'color',
            'title' => esc_html__('Shop Background Color', 'skyline'),
            'subtitle' => esc_html__('Set the body background color of the shop pages', 'skyline'),
            'default' => '#FFF',
            'validate' => 'color'
        )
    )
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-icon-bullhorn',
    'title' => esc_html__('Social Media', 'skyline'),
    'customizer' => true,
    'heading' => esc_html__('Social Media Settings', 'skyline'),
    'desc' => esc_html__('Simply add your social media profiles below and the icons will be automatically included in the theme.', 'skyline'),
    'fields' => array(
	  array(
            'id' => 'email-id',
            'type' => 'text',
            'title' => esc_html__('Email Address', 'skyline'),
            'default' => ''
        ),
        array(
            'id' => 'facebook-id',
            'type' => 'text',
            'title' => esc_html__('Facebook', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'twitter-id',
            'type' => 'text',
            'title' => esc_html__('Twitter', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'pinterest-id',
            'type' => 'text',
            'title' => esc_html__('Pinterest', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'linkedin-id',
            'type' => 'text',
            'title' => esc_html__('LinkedIn', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'googleplus-id',
            'type' => 'text',
            'title' => esc_html__('Google+', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'instagram-id',
            'type' => 'text',
            'title' => esc_html__('Instagram', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'dribbble-id',
            'type' => 'text',
            'title' => esc_html__('Dribbble', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'vimeo-id',
            'type' => 'text',
            'title' => esc_html__('Vimeo', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'skype-id',
            'type' => 'text',
            'title' => esc_html__('Skype', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'flickr-id',
            'type' => 'text',
            'title' => esc_html__('Flickr', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'youtube-id',
            'type' => 'text',
            'title' => esc_html__('Youtube', 'skyline'),
            
            
            'default' => ''
        ),
        array(
            'id' => 'github-id',
            'type' => 'text',
            'title' => esc_html__('GitHub', 'skyline'),
            
            
            'default' => ''
        )
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Footer Options', 'skyline'),
    'customizer' => true,
    'desc' => esc_html__('Set your websites footer options below', 'skyline'),
    'icon' => 'el el-icon-caret-down',
    'fields' => array(
        array(
            'id' => 'footer_type',
            'type' => 'image_select',
            'title' => esc_html__('Footer Style', 'skyline'),
            'subtitle' => esc_html__('Select your preferred footer style: 4 Column, 3 Column, Minimal with Social Icons. The 4 Column and 3 Column footer styles can be setup with widgets by going to Appearance > Widgets. You also have the option to have No Main Footer.', 'skyline'),
            'options' => array(
                '1' => array(
                    'alt' => 'Footer - 4 Column',
                    'img' => SKYLINE_THEME_URI . '/img/admin/footer1.png'
                ),
                '2' => array(
                    'alt' => 'Footer - 3 Column',
                    'img' => SKYLINE_THEME_URI . '/img/admin/footer2.png'
                ),
                '3' => array(
                    'alt' => 'Footer - Minimal',
                    'img' => SKYLINE_THEME_URI . '/img/admin/footer3.png'
                ),
                '4' => array(
                    'alt' => 'No Main Footer',
                    'img' => SKYLINE_THEME_URI . '/img/admin/footer4.png'
                )
            ),
            'default' => '1'
        ),
        
        array(
            'id' => 'footer_logo_img',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Footer Logo Upload', 'skyline'),
            'compiler' => 'true',
            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'subtitle' => esc_html__('Set the logo for the footer', 'skyline'),
            'default' => array(
                'url' => ''
            )
            //'hint'      => array(
            //    'title'     => 'Hint Title',
            //    'content'   => 'This is a <b>hint</b> for the media field with a Title.',
            //)
        ),
        array(
            'id' => 'footer_logo_text',
            'type' => 'text',
            'title' => esc_html__('Footer Logo Text', 'skyline'),
            'subtitle' => esc_html__('The text for the logo if no image is used', 'skyline'),
            'default' => 'skyline'
        ),
       
        array(
            'id' => 'footer_caption',
            'type' => 'textarea',
            'title' => esc_html__('Text Caption under Logo', 'skyline'),
            'subtitle' => esc_html__('If you wish you can display a text caption under the logo', 'skyline'),
            'default' => ''
        ),
        array(
            'id' => 'footer_bg_img',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Footer Background Image', 'skyline'),
            'compiler' => 'true',
            'subtitle' => esc_html__('You can set a background image for your footer or use a solid color below.', 'skyline'),
            'default' => array(
                'url' => ''
            )
         
        ),
        array(
            'id' => 'footer-bg-color',
            'type' => 'color',
            'title' => esc_html__('Footer Background Color', 'skyline'),
            'subtitle' => esc_html__('Set the background color of your websites footer', 'skyline'),
            'default' => '#3C3E47',
            'validate' => 'color'
        ),
        array(
            'id' => 'footer-text-color',
            'type' => 'color',
            'title' => esc_html__('Footer Text Color', 'skyline'),
            'subtitle' => esc_html__('Primary text color for the footer area', 'skyline'),
            'default' => '#BBBBBB',
            'validate' => 'color'
        ),
        array(
            'id' => 'footer-link-color',
            'type' => 'color',
            'title' => esc_html__('Footer Link Color', 'skyline'),
            'subtitle' => esc_html__('Set the link color for the footer area', 'skyline'),
            'default' => '#BBBBBB',
            'validate' => 'color'
        ),
        array(
            'id' => 'footer-link-hover-color',
            'type' => 'color',
            'title' => esc_html__('Footer Link Hover Color', 'skyline'),
            'subtitle' => esc_html__('Set the link color on hover for the footer area', 'skyline'),
            'default' => '#FFFFFF',
            'validate' => 'color'
        ),
        array(
            'id' => 'footer-header-color',
            'type' => 'color',
            'title' => esc_html__('Footer Headings Color', 'skyline'),
            'subtitle' => esc_html__('Settings for Heading Tags, H1, H2, H3, H4, H5, H6', 'skyline'),
            'default' => '#FFFFFF',
            'validate' => 'color'
        ),
        array(
            'id' => 'footer-secondary',
            'type' => 'switch',
            'title' => esc_html__('Secondary Footer Bar', 'skyline'),
            'subtitle' => esc_html__('The secondary footer bar appears below the main footer and features a text box which is perfect for copyright text.', 'skyline'),
            'default' => false
        ),
        array(
            'id' => 'footer-secondary-bg-color',
            'type' => 'color',
            'title' => esc_html__('Secondary Footer Background Color', 'skyline'),
            'subtitle' => esc_html__('Set the background color of your websites secondary footer', 'skyline'),
            'default' => '#35363e',
            'validate' => 'color'
        ),
        array(
            'id' => 'footer-secondary-text',
            'type' => 'text',
            'title' => esc_html__('Secondary Footer Text', 'skyline'),
            'subtitle' => esc_html__('The text to be display in the bar below the main footer. (HTML Supported)', 'skyline'),
            'default' => '2015 CreativelyCoded.com ALL RIGHTS RESERVED.'
        )
    )
));
Redux::setSection($opt_name, array(
    'type' => 'divide'
));
Redux::setSection($opt_name, array(
    'icon' => 'el el-icon-css',
    'title' => esc_html__('Custom CSS', 'skyline'),
    'customizer' => true,
    'desc' => esc_html__('Add any custom CSS code here', 'skyline'),
    'fields' => array(
        array(
            'id' => 'custom-css',
            'type' => 'ace_editor',
            'title' => esc_html__('CSS Code', 'skyline'),
            'subtitle' => esc_html__('Paste your CSS code here.', 'skyline'),
            'mode' => 'css',
            'theme' => 'chrome',
            'options' => array(
                'minLines' => 40,
                'maxLines' => 40
            )
        )
        
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Import / Export', 'skyline'),
    'desc' => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'skyline'),
    'icon' => 'el el-download-alt',
    'fields' => array(
        array(
            'id' => 'opt-import-export',
            'type' => 'import_export',
            'title' => 'Import Export',
            'subtitle' => 'Save and restore your Redux options',
            'full_width' => false
        )
    )
));
Redux::setSection($opt_name, array(
    'type' => 'divide'
));
/*
 * <--- END SECTIONS
 */