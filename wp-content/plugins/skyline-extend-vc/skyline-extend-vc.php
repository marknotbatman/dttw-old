<?php
    /**
     * Skyline Extend Visual Composer Plugin
     * This plugin adds exclusive Skyline elements for Visual Composer.
     * Plugin Name:     Skyline Extend Visual Composer
     * Plugin URI:      http://www.creativelycoded.com
     * Description:     This plugin adds exclusive Skyline elements for Visual Composer.
     * Author:          CreativelyCoded
     * Author URI:      http://www.creativelycoded.com
     * Version:         1.0.0
     * License:         GPL3+
     * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
     *
     */
// don't load directly
if (!defined('ABSPATH')) die('-1');
class VCExtendAddonClass {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
 
        // Use this when creating a shortcode addon
        add_shortcode( 'skyline_separator', array( $this, 'skyline_separator' ) );
		add_shortcode( 'skyline_blog', array( $this, 'skyline_blog' ) );
		add_shortcode( 'skyline_blog_slider', array( $this, 'skyline_blog_slider' ) );
		add_shortcode( 'skyline_blog_carousel', array( $this, 'skyline_blog_carousel' ) );
		add_shortcode( 'skyline_single_image', array( $this, 'skyline_single_image' ) );
		add_shortcode( 'skyline_image_gallery', array( $this, 'skyline_image_gallery' ) );
		add_shortcode( 'skyline_image_carousel', array( $this, 'skyline_image_carousel' ) );
		add_shortcode( 'skyline_lightbox_video', array( $this, 'skyline_lightbox_video' ) );
		add_shortcode( 'skyline_portfolio_grid', array( $this, 'skyline_portfolio_grid' ) );
        add_shortcode( 'skyline_team', array( $this, 'skyline_team' ) );
		add_shortcode( 'skyline_team2', array( $this, 'skyline_team2' ) );
		add_shortcode( 'skyline_list', array( $this, 'skyline_list' ) );
		add_shortcode( 'skyline_headings', array( $this, 'skyline_headings' ) );
		add_shortcode( 'skyline_contact_form', array( $this, 'skyline_contact_form' ) );
		add_shortcode( 'skyline_map', array( $this, 'skyline_map' ) );
		add_shortcode( 'skyline_pricing', array( $this, 'skyline_pricing' ) );
		add_shortcode( 'skyline_pricing2', array( $this, 'skyline_pricing2' ) );
		add_shortcode( 'skyline_counter', array( $this, 'skyline_counter' ) );
		add_shortcode( 'skyline_counter2', array( $this, 'skyline_counter2' ) );
		add_shortcode( 'skyline_counter3', array( $this, 'skyline_counter3' ) );
		add_shortcode( 'skyline_single_icon', array( $this, 'skyline_single_icon' ) );
		add_shortcode( 'skyline_icons1', array( $this, 'skyline_icons1' ) );
		add_shortcode( 'skyline_icons2', array( $this, 'skyline_icons2' ) );
		add_shortcode( 'skyline_icons3', array( $this, 'skyline_icons3' ) );
		add_shortcode( 'skyline_icons4', array( $this, 'skyline_icons4' ) );
		add_shortcode( 'skyline_icons5', array( $this, 'skyline_icons5' ) );
		add_shortcode( 'skyline_testimonial', array( $this, 'skyline_testimonial' ) );
		add_shortcode( 'skyline_testimonial2', array( $this, 'skyline_testimonial2' ) );
		add_shortcode( 'skyline_shop', array( $this, 'skyline_shop' ) );
		add_shortcode( 'skyline_shop_single', array( $this, 'skyline_shop_single' ) );
		add_shortcode( 'skyline_shop_carousel', array( $this, 'skyline_shop_carousel' ) );
		add_shortcode( 'skyline_button', array( $this, 'skyline_button' ) );
		add_shortcode( 'skyline_cta', array( $this, 'skyline_cta' ) );
		add_shortcode( 'skyline_timeline', array( $this, 'skyline_timeline' ) );
        // Register CSS and JS
        add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
		
/*		// VC Features Defaults On/Off
		global $skyline_data;
		if (isset($skyline_data['vc_features']) && ($skyline_data['vc_features']) == 0) {
		if (function_exists( 'vc_remove_element' ) ) {
	
		// Remove Default Elements
		vc_remove_element( "vc_posts_grid" );
		vc_remove_element( "vc_separator" );
		vc_remove_element( "vc_text_separator" );
		vc_remove_element( "vc_custom_heading" );
		vc_remove_element( "vc_empty_space" );
		vc_remove_element( "vc_button" );
		vc_remove_element( "vc_button2" );
		vc_remove_element( "vc_cta_button" );
		vc_remove_element( "vc_cta_button2" );
		vc_remove_element( "vc_gmaps" );
		vc_remove_element( "vc_single_image" );
		vc_remove_element( "vc_gallery" );
		vc_remove_element( "vc_images_carousel" );
		vc_remove_element( "vc_posts_slider" );
		vc_remove_element( "vc_carousel" );
		vc_remove_element( "vc_basic_grid" );
		vc_remove_element( "vc_media_grid" );
		vc_remove_element( "vc_masonry_grid" );
		vc_remove_element( "vc_masonry_media_grid" );
} 
 function remove_menus(){
  remove_menu_page( 'edit.php?post_type=vc_grid_item' );    //Pages  
}
add_action( 'admin_menu', 'remove_menus' );
} // End VC Features On/Off
*/
}
 // ================================ INTEGRATE WITH VC FUNCTION  ================================
    public function integrateWithVC() {
        // Check if Visual Composer is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }
 
        /*
        Add your Visual Composer logic here.
        Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.
        More info: http://kb.wpbakery.com/index.php?title=Vc_map
        */
       
        // ================================ START EXAMPLE  ================================
        vc_map( 
            array(
            "name" => esc_html__("Separator", 'skyline'),
            "description" => esc_html__("Create a horizontal separator", 'skyline'),
            "base" => "skyline_separator",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_separator", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            "params" => array(
			 array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Style', 'skyline'),
                    "param_name" => "separator_style",
					"edit_field_class"	=> "vc_col-md-12",
                    "value" => array(
                        esc_html__("Blank", 'skyline') => '',
                        esc_html__("Solid", 'skyline') => 'solid',
                        esc_html__("Dots", 'skyline') => 'dotted',
                        esc_html__("Dashes", 'skyline') => 'dashed',
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Width', 'skyline'),
                    "param_name" => "separator_width",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("100%", 'skyline') => '100%',
                        esc_html__("90%", 'skyline') => '90%',
                        esc_html__("80%", 'skyline') => '80%',
                        esc_html__("70%", 'skyline') => '70%',
						esc_html__("60%", 'skyline') => '60%',
						esc_html__("50%", 'skyline') => '50%',
						esc_html__("40%", 'skyline') => '40%',
						esc_html__("30%", 'skyline') => '30%',
						esc_html__("20%", 'skyline') => '20%',
						esc_html__("10%", 'skyline') => '10%',
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Height', 'skyline'),
                    "param_name" => "separator_height",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("1px", 'skyline') => '1px',
                        esc_html__("2px", 'skyline') => '2px',
                        esc_html__("3px", 'skyline') => '3px',
                        esc_html__("3px", 'skyline') => '3px',
						esc_html__("5px", 'skyline') => '5px',
                    ),
                ),
				 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Margin Top", 'skyline'),
                  "param_name" => "separator_margin_top",
                  "value" => '', 
				  "description" => esc_html__("Margin in pixels. Only enter the number, no ''px''.", 'skyline')
              ),
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Margin Bottom", 'skyline'),
                  "param_name" => "separator_margin_bottom",
                  "value" => '', 
				  "description" => esc_html__("Margin in pixels. Only enter the number, no ''px''.", 'skyline')
              ),
			  array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'js_composer' ),
				'param_name' => 'separator_align',
				'edit_field_class'	=> 'vc_col-md-6',
				'value' => array(
					esc_html__( 'Center', 'skyline' ) => 'text-center',
					esc_html__( 'Left', 'skyline' ) => 'text-left',
					esc_html__( 'Right', 'skyline' ) => 'text-right'
				),
				'description' => esc_html__( 'Select separator alignment.', 'skyline' )
				),
              array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Separator Color", 'skyline'),
                  "param_name" => "separator_color",
                  "value" => '#EEEEEE', //Default Red color
              ),
			  
              
            )
        ) 
        );
        
        // ================================ END EXAMPLE  ================================
          // ================================ START POSTS GRID  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Blog Posts Grid", 'skyline'),
            "description" => esc_html__("Add blog posts", 'skyline'),
            "base" => "skyline_blog",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_posts_grid", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
			'admin_enqueue_css' => array(plugins_url('vc_style_for_admin.css',__FILE__)), // This will load css file in the VC backend editor
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Blog Layout', 'skyline'),
                    "param_name" => "blog_style",
                    "value" => array(
						esc_html__("Traditional Layout", 'skyline') => 'traditional',
						esc_html__("Horizontal Layout", 'skyline') => 'horizontal',
                        esc_html__("Grid - 2 Column", 'skyline') => 'grid2',
                        esc_html__("Grid - 3 Column", 'skyline') => 'grid3',
                        esc_html__("Grid - 4 Column", 'skyline') => 'grid4',
						esc_html__("Masonry - 2 Column", 'skyline') => 'masonry2',
						esc_html__("Masonry - 3 Column", 'skyline') => 'masonry3',
						esc_html__("Masonry - 4 Column", 'skyline') => 'masonry4'
                    )
                ),
				
				array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Choose the post formats to exclude:', 'skyline'),
                    'param_name' => 'post_formats',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-4',
					'value' => array( 
					esc_html__( 'Standard', 'skyline' ) => 'post-format-standard',
					esc_html__( 'Gallery', 'skyline' ) => 'post-format-gallery',
					esc_html__( 'Audio', 'skyline' ) => 'post-format-audio',
					esc_html__( 'Video', 'skyline' ) => 'post-format-video',
					esc_html__( 'Quote', 'skyline' ) => 'post-format-quote',
					esc_html__( 'Link', 'skyline' ) => 'post-format-link',
					)
                ),
				array(
                    "type" => "textfield",
                    "heading" => esc_html__('Number of Posts to Show', 'skyline'),
                    "param_name" => "blog_number",
                    "value" => esc_html__( "", "skyline" ),
                    ),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order By', 'skyline'),
                    "param_name" => "blog_order",
                    "value" => array(
                        esc_html__("Random", 'skyline') => 'rand',
                        esc_html__("Title", 'skyline') => 'title',
                        esc_html__("Date", 'skyline') => 'date',
						esc_html__("Popularity", 'skyline') => 'popular'
                    )
					),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order', 'skyline'),
                    "param_name" => "blog_orderby",
                    "value" => array(
                        esc_html__("Ascending (oldest first)", 'skyline') => 'asc',
                        esc_html__("Descending (newest first)", 'skyline') => 'desc',
                    )
                ),
            )
        ) 
        );
        
        // ================================ END POSTS GRID  ================================
		// ================================ START BLOG POST SLIDER  ================================
        vc_map( 
            array(
            "name" => esc_html__("Blog Post Slider", 'skyline'),
            "description" => esc_html__("Create a blog posts slider", 'skyline'),
            "base" => "skyline_blog_slider",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_posts_slider", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
            	array(
			'type' => 'loop',
			'heading' => esc_html__( 'Choose Posts for the Slider', 'skyline' ),
			'param_name' => 'loop',
			'settings' => array(
				'order_by' => array( 'hidden' => true ),
				'order' => array( 'hidden' => true ),
				'authors' => array( 'hidden' => true ),
				'categories' => array( 'hidden' => true ),
				'tags' => array( 'hidden' => true ),
				'tax_query' => array( 'hidden' => true ),
				'size' => array( 'hidden' => true ),
				'post_type' => array( 'hidden' => true,  'value' => 'posts',),
			),
			'description' => esc_html__( 'Search for the posts you wish to include in the slider.', 'skyline' )
		),
array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Slider Height', 'skyline'),
                    "param_name" => "slider_height",
					'description' => esc_html__( 'The slider height will dynamically change based on the users screensize.', 'skyline' ),
                    "value" => array(
                        esc_html__("50% of Screen Height", 'skyline') => 'height-50',
						esc_html__("66% of Screen Height", 'skyline') => 'height-66',
                        esc_html__("75% of Screen Height", 'skyline') => 'height-75',
                        esc_html__("100% of Screen Height", 'skyline') => 'height-100',
                    )
                ),
            )
        ) 
        );
		// ================================ START BLOG CAROUSEL  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Blog Post Carousel", 'skyline'),
            "description" => esc_html__("Create a blog post carousel", 'skyline'),
            "base" => "skyline_blog_carousel",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_carousel", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order By', 'skyline'),
                    "param_name" => "carousel_blog_order",
                    "value" => array(
                        esc_html__("Random", 'skyline') => 'rand',
                        esc_html__("Title", 'skyline') => 'title',
                        esc_html__("Date", 'skyline') => 'date',
						esc_html__("Popularity", 'skyline') => 'popular'
                    )
					),
					array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order', 'skyline'),
                    "param_name" => "carousel_blog_orderby",
                    "value" => array(
                        esc_html__("Ascending", 'skyline') => 'asc',
                        esc_html__("Descending", 'skyline') => 'desc',
                    )
                ),
				array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Choose the post formats to <u>exclude</u>:', 'skyline'),
                    'param_name' => 'carousel_post_formats',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-4',
					'value' => array( 
					esc_html__( 'Standard', 'skyline' ) => 'post-format-standard',
					esc_html__( 'Gallery', 'skyline' ) => 'post-format-gallery',
					esc_html__( 'Audio', 'skyline' ) => 'post-format-audio',
					esc_html__( 'Video', 'skyline' ) => 'post-format-video',
					esc_html__( 'Quote', 'skyline' ) => 'post-format-quote',
					esc_html__( 'Link', 'skyline' ) => 'post-format-link',
					)
                ),
					array(
                    "type" => "textfield",
                    "heading" => esc_html__('Number of Posts to Show', 'skyline'),
                    "param_name" => "carousel_posts_toshow",
					'description' => esc_html__('The number of posts to be included in the slider.', 'skyline'),
            ),
			array(
                    "type" => "textfield",
                    "heading" => esc_html__('Number of Posts Onscreen at One Time', 'skyline'),
                    "param_name" => "carousel_blog_number",
					'description' => esc_html__('Enter the number of posts that will be visible onscreen at one time.', 'skyline'),
            ),
			array(
                    "type" => "textfield",
                    "heading" => esc_html__('Slide Timer', 'skyline'),
                    "param_name" => "carousel_blog_timer",
					'description' => esc_html__('The time in milliseconds for the slide to forward.', 'skyline'),
            ),
				  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Controls Color', 'skyline' ),
			'param_name' => 'carousel_blog_controls',
			"edit_field_class"	=> "vc_col-md-12",
			'description' => esc_html__( 'Select bullet controls color.', 'skyline' ),
		),
	),
) );
        // ================================ START SINGLE IMAGE  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Single Image", 'skyline'),
            "description" => esc_html__("Display a single image", 'skyline'),
            "base" => "skyline_single_image",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_image", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				 array(
            'type' => 'attach_image',
            'heading' => esc_html__('Choose an Image', 'skyline'),
            'param_name' => 'single_image',
			'value' => '',
			"edit_field_class"	=> "vc_col-md-12",
            'description' => esc_html__('Choose the image you wish to display.', 'skyline'),
						),
					array(
                    "type" => "textfield",
                    "heading" => esc_html__('Image Caption (optional)', 'skyline'),
                    "param_name" => "single_image_caption",
                    "value" => esc_html__( "", "skyline" ),
					"edit_field_class"	=> "vc_col-md-12",
					'description' => esc_html__( 'The image caption is optional. This will be displayed when the Lightbox is open.', 'skyline' ),
                    ),
					   array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Picture Style', 'skyline'),
                    "param_name" => "single_image_style",
					"edit_field_class"	=> "vc_col-md-12",
                    "value" => array(
                        esc_html__("Original", 'skyline') => '1',
                        esc_html__("Rectangle Image", 'skyline') => '2',
                        esc_html__("Circle Image", 'skyline') => '3',
						esc_html__("Square Image", 'skyline') => '4',
                    )
                ),
				array(
                    "type" => "textfield",
                    "heading" => esc_html__('Image Corner Radius (optional)', 'skyline'),
                    "param_name" => "image_border_radius",
                    "value" => esc_html__( "", "skyline" ),
					'description' => esc_html__( "Corner radius in pixels. Only enter the number, no ''px''.", 'skyline' ),
					'dependency' => array('element' => 'single_image_style', 'value' => array('1','2','4')),
                    ),
					array(
                    "type" => "dropdown",
                    "heading" => esc_html__('On Click Action', 'skyline'),
                    "param_name" => "lightbox",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
						esc_html__("Do Nothing", 'skyline') => '',
                        esc_html__("Open Image Larger in Lightbox", 'skyline') => 'lightbox',
                        esc_html__("Create a Link", 'skyline') => 'link'
                    )
                ),
				array(
                    "type" => "textfield",
                    "heading" => esc_html__('URL Where Image Will Point', 'skyline'),
                    "param_name" => "single_img_link",
                    "value" => esc_html__( "", "skyline" ),
					'description' => esc_html__('Enter the URL where you would like the user to go when the image is clicked.', 'skyline'),
					'dependency' => array('element' => 'lightbox', 'value' => array('link')),
            ),
					
					array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Image Alignment', 'skyline'),
                    "param_name" => "image_align",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("Left", 'skyline') => 'text-left',
                        esc_html__("Center", 'skyline') => 'text-center',
                        esc_html__("Right", 'skyline') => 'text-right'
                    )
                ),
       array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Image Width', 'skyline'),
                    "param_name" => "image_width",
					"edit_field_class"	=> "vc_col-md-6",
					'description' => esc_html__( 'Image width as a percentage of its container. Height is set to "auto"', 'skyline' ),
                    "value" => array(
                        esc_html__("100%", 'skyline') => '100%',
                        esc_html__("90%", 'skyline') => '90%',
                        esc_html__("80%", 'skyline') => '80%',
						esc_html__("70%", 'skyline') => '70%',
						esc_html__("60%", 'skyline') => '60%',
						esc_html__("50%", 'skyline') => '50%',
                    )
                ),
				 array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Border Color(optional)', 'skyline' ),
			'param_name' => 'image_border',
			"edit_field_class"	=> "vc_col-md-12",
			'description' => esc_html__( 'Choose the color of the border.', 'skyline' ),
		),
		  array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Border Thickness', 'skyline'),
                    "param_name" => "image_border_width",
					"edit_field_class"	=> "vc_col-md-6",
					'description' => esc_html__( 'The width of the border.', 'skyline' ),
                    "value" => array(
						esc_html__("0", 'skyline') => 'No Border',
                        esc_html__("1px", 'skyline') => '1px',
                        esc_html__("2px", 'skyline') => '2px',
                        esc_html__("3px", 'skyline') => '3px',
						esc_html__("4px", 'skyline') => '4px',
						esc_html__("5px", 'skyline') => '5px',
						esc_html__("6px", 'skyline') => '6px',
						esc_html__("7px", 'skyline') => '7px',
						esc_html__("8px", 'skyline') => '8px',
						esc_html__("9px", 'skyline') => '9px',
						esc_html__("10px", 'skyline') => '10px',
                    )
                ),
	),
) );
 // ================================ START IMAGE GALLERY  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Image Gallery", 'skyline'),
            "description" => esc_html__("Create an image gallery", 'skyline'),
            "base" => "skyline_image_gallery",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_gallery", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				 array(
            'type' => 'attach_images',
            'heading' => esc_html__('Choose Images', 'skyline'),
            'param_name' => 'gallery_images',
			"edit_field_class"	=> "vc_col-md-12",
            'description' => esc_html__('Choose the images you wish to display.', 'skyline'),
						),
												   array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Gallery Style', 'skyline'),
                    "param_name" => "gallery_layout_style",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("2 Column", 'skyline') => '1',
                        esc_html__("3 Column", 'skyline') => '2',
                        esc_html__("4 Column", 'skyline') => '3',
						esc_html__("6 Column", 'skyline') => '4',
                    )
                ),
						   array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Picture Style', 'skyline'),
                    "param_name" => "gallery_style",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("Square Images", 'skyline') => '1',
                        esc_html__("Rectangle Images", 'skyline') => '2',
                        esc_html__("Circle Images", 'skyline') => '3',
                    )
                ),
	),
) );
 // ================================ START IMAGE CAROUSEL  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Image Carousel", 'skyline'),
            "description" => esc_html__("Create an image carousel", 'skyline'),
            "base" => "skyline_image_carousel",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon  skyline_icon_carousel", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				 array(
            'type' => 'attach_images',
            'heading' => esc_html__('Choose Images', 'skyline'),
            'param_name' => 'carousel_images',
			"edit_field_class"	=> "vc_col-md-12",
            'description' => esc_html__('Choose the images you wish to display.', 'skyline'),
						),
			array(
                    "type" => "textfield",
                    "heading" => esc_html__('Number of Images Onscreen at One Time', 'skyline'),
                    "param_name" => "carousel_image_number",
                    "value" => esc_html__( "4", "skyline" ),
					'description' => esc_html__('Enter the number of images that will be visible onscreen at one time.', 'skyline'),
            ),
			array(
                    "type" => "textfield",
                    "heading" => esc_html__('Slide Timer', 'skyline'),
                    "param_name" => "carousel_timer",
                    "value" => esc_html__( "3000", "skyline" ),
					'description' => esc_html__('The time in milliseconds for the slide to forward.', 'skyline'),
            ),
			array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Carousel Style', 'skyline'),
                    "param_name" => "carousel_style",
					"edit_field_class"	=> "vc_col-md-6",
					'description' => esc_html__('The style of the images in the slider.', 'skyline'),
                    "value" => array(
                        esc_html__("Square Images", 'skyline') => '1',
                        esc_html__("Rectangle Images", 'skyline') => '2',
                        esc_html__("Circle Images", 'skyline') => '3',
                    )
                ),
				 /* array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Controls Color', 'skyline' ),
			'param_name' => 'carousel_controls',
			"edit_field_class"	=> "vc_col-md-12",
			'description' => esc_html__( 'Select bullet controls color.', 'skyline' ),
		), */
	),
) );
// ================================ START LIGHTBOX VIDEO  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Video Lightbox", 'skyline'),
            "description" => esc_html__("Display a Video as a Lightbox Popup", 'skyline'),
            "base" => "skyline_lightbox_video",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon  skyline_icon_carousel", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				 array(
            'type' => 'attach_images',
            'heading' => esc_html__('Placeholder Image', 'skyline'),
            'param_name' => 'vid_lightbox_placeholder',
			"edit_field_class"	=> "vc_col-md-12",
            'description' => esc_html__('This is the image that is displayed as a placeholder before the video plays.', 'skyline'),
						),
			array(
                    "type" => "textfield",
                    "heading" => esc_html__('YouTube Video ID', 'skyline'),
                    "param_name" => "vid_lightbox_youtube",
                    "value" => esc_html__( "", "skyline" ),
					'description' => esc_html__('Enter the YouTube Video ID. Example: oPa-48tkJ68', 'skyline'),
            ),
			
	),
) );
    // ================================ START PORTFOLIO GRID  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Portfolio Grid", 'skyline'),
            "description" => esc_html__("Add a portfolio grid", 'skyline'),
            "base" => "skyline_portfolio_grid",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_portfolio", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Portfolio Style', 'skyline'),
                    "param_name" => "portfolio_style",
                    "value" => array(
                        esc_html__("Grid - 2 Column", 'skyline') => 'grid2',
                        esc_html__("Grid - 3 Column", 'skyline') => 'grid3',
                        esc_html__("Grid - 4 Column", 'skyline') => 'grid4',
						esc_html__("Grid - 6 Column", 'skyline') => 'grid6',
                    )
                ),
				array(
                    "type" => "textfield",
                    "heading" => esc_html__('Number of Portfolio Items Show', 'skyline'),
                    "param_name" => "portfolio_number",
                    "value" => esc_html__( "", "skyline" ),
                    ),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order By', 'skyline'),
                    "param_name" => "portfolio_order",
                    "value" => array(
                        esc_html__("Random", 'skyline') => 'rand',
                        esc_html__("Title", 'skyline') => 'title',
                        esc_html__("Date", 'skyline') => 'date',
						esc_html__("Popularity", 'skyline') => 'popular'
                    )
					),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order', 'skyline'),
                    "param_name" => "portfolio_orderby",
                    "value" => array(
                        esc_html__("Ascending", 'skyline') => 'asc',
                        esc_html__("Descending", 'skyline') => 'desc',
                    )
                ),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Display Style', 'skyline'),
                    "param_name" => "portfolio_img_style",
                    "value" => array(
                        esc_html__("Squares", 'skyline') => 'square',
                        esc_html__("Rectangles", 'skyline') => 'rectangle',
                        esc_html__("Circles", 'skyline') => 'circle'
                    )
					),
					array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Portfolio Filter', 'skyline'),
                    "param_name" => "portfolio_filter",
                    "value" => array(
                        esc_html__("No Filter", 'skyline') => 'no_filter',
                        esc_html__("Fixed Filter", 'skyline') => 'fixed_filter',
                        esc_html__("Normal Filter", 'skyline') => 'normal_filter'
                    )
					),
            )
        ) 
        );
        
        // ================================ END PORTFOLIO GRID  ================================
        // ================================ START TEAM MEMBERS  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Team Style 1", 'skyline'),
            "description" => esc_html__("Add your team members", 'skyline'),
            "base" => "skyline_team",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_team", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				array(
			'type' => 'loop',
			'heading' => esc_html__( 'Choose A Team Member', 'skyline' ),
			'param_name' => 'loop',
			'settings' => array(
				'order_by' => array( 'hidden' => true ),
				'order' => array( 'hidden' => true ),
				'authors' => array( 'hidden' => true ),
				'categories' => array( 'hidden' => true ),
				'tags' => array( 'hidden' => true ),
				'tax_query' => array( 'hidden' => true ),
				'size' => array( 'hidden' => true ),
				'post_type' => array( 'hidden' => true,  'value' => 'team_members',),
			),
			'description' => esc_html__( 'Search for the team member you wish to add.', 'skyline' )
		),
		 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Image Border Style', 'js_composer' ),
			'value' => array(
				esc_html__( 'Square', 'js_composer' ) => '0px',
				esc_html__( 'Rounded', 'js_composer' ) => '3px',
				esc_html__( 'Circle', 'js_composer' ) => '500px',
			),
			'param_name' => 'team1_border_radius',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		 array(
                  "type" => "textarea_html",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Team Member Excerpt", 'skyline'),
                  "param_name" => "content",
                    "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "skyline" ),
                  "description" => esc_html__("Optional text to be displayed below the team member picture.", 'skyline')
              ),
			      array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Show Social Icons?', 'skyline'),
                    'param_name' => 'team1_social_icons',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-4',
					'value' => array( esc_html__( 'Check if you want to show social icons below the picture', 'skyline' ) => 'yes' ),
                    ),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Header Color', 'skyline' ),
			'param_name' => 'header_color',
			"edit_field_class"	=> "vc_col-md-12",
			'description' => esc_html__( 'This the header color for the name and job title.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Border Color', 'skyline' ),
			'param_name' => 'border_color',
			"edit_field_class"	=> "vc_col-md-12",
			"value" => '#EEEEEE',
			'description' => esc_html__( 'The border color around the team member image.', 'skyline' ),
		),
            )
        ) 
        );
        
  // ================================ START TEAM MEMBERS - STYLE 2  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Team Style 2", 'skyline'),
            "description" => esc_html__("Add your team members", 'skyline'),
            "base" => "skyline_team2",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_team2", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
			"admin_enqueue_css" => array(get_template_directory_uri() . ('/css/simple-line-icons.css')), // This will load css file in the VC backend editor
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				array(
			'type' => 'loop',
			'heading' => esc_html__( 'Choose A Team Member', 'skyline' ),
			'param_name' => 'loop',
			'settings' => array(
				'order_by' => array( 'hidden' => true ),
				'order' => array( 'hidden' => true ),
				'authors' => array( 'hidden' => true ),
				'categories' => array( 'hidden' => true ),
				'tags' => array( 'hidden' => true ),
				'tax_query' => array( 'hidden' => true ),
				'size' => array( 'hidden' => true ),
				'post_type' => array( 'hidden' => true,  'value' => 'team_members',),
			),
			'description' => esc_html__( 'Search for the team member you wish to add.', 'skyline' )
		),
			 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Image Border Style', 'js_composer' ),
			'value' => array(
				esc_html__( 'Square', 'js_composer' ) => '0px',
				esc_html__( 'Rounded', 'js_composer' ) => '3px',
				esc_html__( 'Circle', 'js_composer' ) => '500px',
			),
			'param_name' => 'team2_border_radius',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		 array(
                  "type" => "textarea_html",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Team Member Excerpt", 'skyline'),
                  "param_name" => "content",
                    "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "skyline" ),
                  "description" => esc_html__("Optional text to be displayed below the team member picture.", 'skyline')
              ),
			   array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Show Social Icons?', 'skyline'),
                    'param_name' => 'team2_social_icons',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-4',
					'value' => array( esc_html__( 'Check if you want to show social icons below the picture', 'skyline' ) => 'yes' ),
                    ),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Header Color', 'skyline' ),
			'param_name' => 'team2_header_color',
			"edit_field_class"	=> "vc_col-md-12",
			"value" => '#50525f', //Default Red color
			'description' => esc_html__( 'The header color for the name and job title.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Border Color', 'skyline' ),
			'param_name' => 'team2_border_color',
			"edit_field_class"	=> "vc_col-md-12",
			"value" => '#EEEEEE',
			'description' => esc_html__( 'The border color for the container.', 'skyline' ),
		),
            )
        ) 
        );
        // ================================ START LIST  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Lists", 'skyline'),
            "description" => esc_html__("Create a list", 'skyline'),
            "base" => "skyline_list",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_list", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
			"admin_enqueue_css" => array(get_template_directory_uri() . ('/css/simple-line-icons.css')), // This will load css file in the VC backend editor
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
				array(
                  "type" => "exploded_textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Create A List", 'skyline'),
                  "param_name" => "list",
                  "value" => esc_html__("Item 1&#10;Item 2&#10;Item 3&#10;Item 4", 'skyline'),
				  "description" => esc_html__("Enter 1 list item per line.", 'skyline')
              ),
              array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
    			  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("List Icon Font Color", 'skyline'),
                  "param_name" => "list_icon_color",
                  "value" => '', //Default Red color
				  "description" => esc_html__("Leave blank for Theme Default", 'skyline')
              ),
              
			 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'List Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'list_icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'list_icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'list_icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'list_icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'list_icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'list_icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
            )
        ) 
        );
		
		    // ================================ START PRICING TABLE  ================================
        
       vc_map( 
            array(
            "name" => esc_html__("Pricing Table Style 1", 'skyline'),
            "description" => esc_html__("Create a pricing table item", 'skyline'),
            "base" => "skyline_pricing",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_pricing1", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Item Heading", 'skyline'),
                  "param_name" => "pricing_item_heading",
                  "value" => esc_html__("Item Heading", 'skyline'),
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Item Pricing", 'skyline'),
                  "param_name" => "pricing_item_price",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter the price.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-8",
                  "heading" => esc_html__("Pricing Frequency", 'skyline'),
                  "param_name" => "pricing_item_frequency",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Example: month, year. This field is optional.", 'skyline')
              ),
			   array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Headings Font Color", 'skyline'),
                  "param_name" => "pricing_item_headings_color",
                  "value" => '', //Default Red color
				  "description" => esc_html__("Leave blank for Theme Default", 'skyline')
              ),
			  array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Item Description", 'skyline'),
                  "param_name" => "pricing_item_description",
                  "value" => esc_html__("", 'skyline'),
				  "description" => esc_html__("Enter a description for this item. (optional)", 'skyline')
              ),
			  array(
                  "type" => "exploded_textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Item Features", 'skyline'),
                  "param_name" => "pricing_item_features",
                  "value" => esc_html__("Feature 1&#10;Feature 2&#10;Feature 3&#10;Feature 4", 'skyline'),
				  "description" => esc_html__("Enter 1 feature per line.", 'skyline')
              ),
			    array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Text Font Color", 'skyline'),
                  "param_name" => "pricing_item_font_color",
                  "value" => '', //Default Red color
				  "description" => esc_html__("Leave blank for Theme Default", 'skyline')
              ),
               
			   array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Star Rating', 'skyline'),
                    "param_name" => "pricing_item_rating",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("1 Star", 'skyline') => '1',
                        esc_html__("2 Stars", 'skyline') => '2',
                        esc_html__("3 Stars", 'skyline') => '3',
                        esc_html__("4 Stars", 'skyline') => '4',
                        esc_html__("5 Stars", 'skyline') => '5',
						esc_html__("Hide Star Rating", 'skyline') => '6',
                    )
                ),
				 array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Star Color", 'skyline'),
                  "param_name" => "pricing_item_star_color",
                  "value" => '#FFD100', //Default Red color
				  "description" => esc_html__("Default: #FFD100", 'skyline')
              ),
				 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Button Text", 'skyline'),
                  "param_name" => "pricing_item_button",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Button text for the item.", 'skyline')
              ),
				array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-8",
                  "heading" => esc_html__("Button Link", 'skyline'),
                  "param_name" => "pricing_item_button_link",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Paste the URL for where you want the button to go.", 'skyline')
              ),
			    array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Button Color", 'skyline'),
                  "param_name" => "pricing_item_btn_color",
                  "value" => '', //Default Red color
				  "description" => esc_html__("Leave blank for Theme Default", 'skyline')
              ),
				 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Border Width", 'skyline'),
                  "param_name" => "pricing_item_border",
                  "value" => '2', 
				  "description" => esc_html__("Border width in pixels. Only enter the number, no ''px''.", 'skyline')
              ),
				  array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Border Color", 'skyline'),
                  "param_name" => "pricing_item_border_color",
                  "value" => '#EEEEEE', //Default Red color
              ),
			
            )
        ) 
        );
		// ================================ START PRICING TABLE STYLE 2  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Pricing Table Style 2", 'skyline'),
            "description" => esc_html__("Create a pricing table item", 'skyline'),
            "base" => "skyline_pricing2",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_pricing2", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Item Heading", 'skyline'),
                  "param_name" => "pricing_item_heading2",
                  "value" => esc_html__("Item Heading", 'skyline'),
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Item Pricing", 'skyline'),
                  "param_name" => "pricing_item_price2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter the price.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-8",
                  "heading" => esc_html__("Pricing Frequency", 'skyline'),
                  "param_name" => "pricing_item_frequency2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Example: month, year. This field is optional.", 'skyline')
              ),
			   array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Headings Font Color", 'skyline'),
                  "param_name" => "pricing_item_headings_color2",
                  "value" => '', //Default Red color
				  "description" => esc_html__("Leave blank for Theme Default", 'skyline')
              ),
			  array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Item Description", 'skyline'),
                  "param_name" => "pricing_item_description2",
                  "value" => esc_html__("", 'skyline'),
				  "description" => esc_html__("Enter a description for this item. (optional)", 'skyline')
              ),
			  array(
                  "type" => "exploded_textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Item Features", 'skyline'),
                  "param_name" => "pricing_item_features2",
                  "value" => esc_html__("Feature 1&#10;Feature 2&#10;Feature 3&#10;Feature 4", 'skyline'),
				  "description" => esc_html__("Enter 1 feature per line.", 'skyline')
              ),
			    array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Text Font Color", 'skyline'),
                  "param_name" => "pricing_item_font_color2",
                  "value" => '', //Default Red color
				  "description" => esc_html__("Leave blank for Theme Default", 'skyline')
              ),
               
			   array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Star Rating', 'skyline'),
                    "param_name" => "pricing_item_rating2",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("1 Star", 'skyline') => '1',
                        esc_html__("2 Stars", 'skyline') => '2',
                        esc_html__("3 Stars", 'skyline') => '3',
                        esc_html__("4 Stars", 'skyline') => '4',
                        esc_html__("5 Stars", 'skyline') => '5',
						esc_html__("Hide Star Rating", 'skyline') => '6',
                    )
                ),
				 array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Star Color", 'skyline'),
                  "param_name" => "pricing_item_star_color2",
                  "value" => '#FFD100', //Default Red color
				  "description" => esc_html__("Default: #FFD100", 'skyline')
              ),
				 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Button Text", 'skyline'),
                  "param_name" => "pricing_item_button2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Button text for the item.", 'skyline')
              ),
				array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-8",
                  "heading" => esc_html__("Button Link", 'skyline'),
                  "param_name" => "pricing_item_button_link2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Paste the URL for where you want the button to go.", 'skyline')
              ),
			    array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Button Color", 'skyline'),
                  "param_name" => "pricing_item_btn_color2",
                  "value" => '', //Default Red color
				  "description" => esc_html__("Leave blank for Theme Default", 'skyline')
              ),
				 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Border Width", 'skyline'),
                  "param_name" => "pricing_item_border2",
                  "value" => '2', 
				  "description" => esc_html__("Border width in pixels. Only enter the number, no ''px''.", 'skyline')
              ),
				  array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Border Color", 'skyline'),
                  "param_name" => "pricing_item_border_color2",
                  "value" => '#EEEEEE', //Default Red color
              ),
			
            )
        ) 
        );
		   // ================================ START HEADER TEXT  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Heading Text", 'skyline'),
            "description" => esc_html__("Create heading text with various styles", 'skyline'),
            "base" => "skyline_headings",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_heading", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Heading Text", 'skyline'),
                  "param_name" => "header_text",
                  "value" => esc_html__("Header Text", 'skyline'),
                  "description" => esc_html__("Enter your content.", 'skyline')
              ),
              array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Heading Style', 'skyline'),
                    "param_name" => "header_style",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("Default/Standard", 'skyline') => '',
                        esc_html__("Special", 'skyline') => 'special'
                    )
                ),
			    array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Heading Tag', 'skyline'),
                    "param_name" => "header_tag",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("H1 - 36px", 'skyline') => 'H1',
                        esc_html__("H2 - 30px", 'skyline') => 'H2',
                        esc_html__("H3 - 24px", 'skyline') => 'H3',
                        esc_html__("H4 - 18px", 'skyline') => 'H4',
                        esc_html__("H5 - 13px", 'skyline') => 'H5',
                        esc_html__("H6 - 12px", 'skyline') => 'H6',
						esc_html__("Custom Size", 'skyline') => 'h1'
                    )
                ),
				  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Heading Font Size", 'skyline'),
                  "param_name" => "header_font_size",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter your font size in pixels. (number only, do not include ''px'')", 'skyline'),
				   'dependency' => array('element' => 'header_tag', 'value' => array('h1'))
              ),
				array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Mobile Font Size", 'skyline'),
                  "param_name" => "header_mobile_font_size",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Custom font size for small screens. (number only, do not include ''px'')", 'skyline'),
				   'dependency' => array('element' => 'header_tag', 'value' => array('h1'))
              ),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Heading Alignment', 'skyline'),
                    "param_name" => "header_align",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
                        esc_html__("Left", 'skyline') => 'left',
                        esc_html__("Center", 'skyline') => 'center',
                        esc_html__("Right", 'skyline') => 'right'
                    )
                ),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Heading Weight', 'skyline'),
                    "param_name" => "header_weight",
					"edit_field_class"	=> "vc_col-md-6",
                    "value" => array(
						esc_html__("Theme Default", 'skyline') => '',
						esc_html__("100", 'skyline') => '100',
                        esc_html__("200", 'skyline') => '200',
                        esc_html__("300", 'skyline') => '300',
                        esc_html__("400", 'skyline') => '400',
						esc_html__("500", 'skyline') => '500',
						esc_html__("600", 'skyline') => '600',
						esc_html__("700", 'skyline') => '700',
						esc_html__("800", 'skyline') => '800',
						esc_html__("900", 'skyline') => '900'
                    )
                ),
			  
			    array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Top Margin", 'skyline'),
                  "param_name" => "header_top_margin",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter the top margin in px. (number only, do not include \"px\") Leave blank for default margins", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Bottom Margin", 'skyline'),
                  "param_name" => "header_bottom_margin",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter the bottom margin in px. (number only, do not include \"px\") Leave blank for default margins", 'skyline')
              ),
			   array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Text Color", 'skyline'),
                  "param_name" => "header_color",
                  "value" => '', //Default Red color
				   "description" => esc_html__("Leave blank for Theme Default", 'skyline')
              ),
            )
        ) 
        );
		// ================================ START GOOGLE MAPS  ================================
        vc_map( 
            array(
            "name" => esc_html__("Google Maps", 'skyline'),
            "description" => esc_html__("Create a custom map", 'skyline'),
            "base" => "skyline_map",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_google_map", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Google API Code", 'skyline'),
                  "param_name" => "google_api",
                  "value" => esc_html__("", 'skyline'),
                  "description" => __("Google now requires an API key. You can get one here <a href='https://console.developers.google.com/apis/credentials' target='_blank'>Google API</a>", 'skyline'),
				  
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Map Zoom Level", 'skyline'),
                  "param_name" => "map_zoom",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("0-19, 19 = max zoom. If you can't see all of your locations, then zoom out the map.", 'skyline'),
				  
              ),
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6 row",
                  "heading" => esc_html__("Map Height", 'skyline'),
                  "param_name" => "map_height",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Height in pixels. Do not include ''px'', just the number.", 'skyline')
              ),
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 1 Description", 'skyline'),
                  "param_name" => "loc_1_desc",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Description of location 1", 'skyline')
              ),
			array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 1 Latitude", 'skyline'),
                  "param_name" => "loc_1_lat",
                  "value" => esc_html__("", 'skyline'),
                  "description" => wp_kses( __( "Latitude of location 1. Find Longitude here <a href='http://www.latlong.net/' target='_blank'>LatLong</a>", "skyline" ), array( 'a' => 'href' ) ),
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 1 Longitude", 'skyline'),
                  "param_name" => "loc_1_long",
                  "value" => esc_html__("", 'skyline'),
                  "description" => wp_kses( __( "Longitude of location 1. Find Longitude here <a href='http://www.latlong.net/' target='_blank'>LatLong</a>", "skyline" ), array( 'a' => 'href' ) ),
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 2 Description", 'skyline'),
                  "param_name" => "loc_2_desc",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Description of location 2", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 2 Latitude", 'skyline'),
                  "param_name" => "loc_2_lat",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Latitude of location 2", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 2 Longitude", 'skyline'),
                  "param_name" => "loc_2_long",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Longitude of location 2", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 3 Description", 'skyline'),
                  "param_name" => "loc_3_desc",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Description of location 3", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 3 Latitude", 'skyline'),
                  "param_name" => "loc_3_lat",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Latitude of location 3", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 3 Longitude", 'skyline'),
                  "param_name" => "loc_3_long",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Longitude of location 3", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 4 Description", 'skyline'),
                  "param_name" => "loc_4_desc",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Description of location 4", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 4 Latitude", 'skyline'),
                  "param_name" => "loc_4_lat",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Latitude of location 4", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 4 Longitude", 'skyline'),
                  "param_name" => "loc_4_long",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Longitude of location 4", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 5 Description", 'skyline'),
                  "param_name" => "loc_5_desc",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Description of location 5", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 5 Latitude", 'skyline'),
                  "param_name" => "loc_5_lat",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Latitude of location 5", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-4",
                  "heading" => esc_html__("Location 5 Longitude", 'skyline'),
                  "param_name" => "loc_5_long",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Longitude of location 5", 'skyline')
              ),
            )
        ) 
        );
		// ================================ START CONTACT FORM  ================================
        vc_map( 
            array(
            "name" => esc_html__("Basic Contact Form", 'skyline'),
            "description" => esc_html__("Create a basic contact form", 'skyline'),
            "base" => "skyline_contact_form",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_contact_form", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Recipient Email Address", 'skyline'),
                  "param_name" => "recipient",
                  "description" => esc_html__("Enter the email address where the mail will be sent.", 'skyline')
              ),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Text Label for Name Field", 'skyline'),
                  "param_name" => "name_label",
                  "description" => esc_html__("Enter the text for the ''name'' label.", 'skyline')
              ),
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Text Label for Email Field", 'skyline'),
                  "param_name" => "email_label",
                  "description" => esc_html__("Enter the text for the ''from email'' label.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Text Label for Message Field", 'skyline'),
                  "param_name" => "message_label",
                  "description" => esc_html__("Enter the text for the ''message'' label.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Text for Send Button", 'skyline'),
                  "param_name" => "send_button",
                  "description" => esc_html__("Enter the text for the ''send'' button.", 'skyline')
              ),
            )
        ) 
        );
		
// ================================ START COUNTERS  ================================
        vc_map( 
            array(
            "name" => esc_html__("Counter Style 1", 'skyline'),
            "description" => esc_html__("Milestones and achivements counter", 'skyline'),
            "base" => "skyline_counter",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_counter", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Counter Value", 'skyline'),
                  "param_name" => "counter_value",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter a value that your counter will increment to.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Counter Description", 'skyline'),
                  "param_name" => "counter_text",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter the text to show below the counter.", 'skyline')
              ),
				    array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
			  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Text Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-12",
			'param_name' => 'counter_text_color',
			'description' => esc_html__( 'The color of the icon, value and text.', 'skyline' ),
		),
            )
        ) 
        );
 // ================================ START COUNTERS STYLE 2 ================================
        vc_map( 
            array(
            "name" => esc_html__("Counter Style 2", 'skyline'),
            "description" => esc_html__("Milestones and achivements counter", 'skyline'),
            "base" => "skyline_counter2",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_counter", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Counter Value", 'skyline'),
                  "param_name" => "counter_value2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter a value that your counter will increment to.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Counter Description", 'skyline'),
                  "param_name" => "counter_text2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter the text to show below the counter.", 'skyline')
              ),
			    array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
			  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Text Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-4",
			'param_name' => 'counter_text_color2',
			'description' => esc_html__( 'Icon, value and text color.', 'skyline' ),
		),
		 array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-4",
			'param_name' => 'counter_bg_color2',
			'description' => esc_html__( 'Container background color.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Border Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-4",
			'param_name' => 'counter_border_color2',
			 "value" => esc_html__("#EEEEEE", 'skyline'),
			'description' => esc_html__( 'The color of the border.', 'skyline' ),
		),
            )
        ) 
        );
		// ================================ START COUNTERS STYLE 2 ================================
        vc_map( 
            array(
            "name" => esc_html__("Counter - Build Your Own", 'skyline'),
            "description" => esc_html__("Basic counter - just the number", 'skyline'),
            "base" => "skyline_counter3",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_counter", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Counter Value", 'skyline'),
                  "param_name" => "counter3_value",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Enter a value that your counter will increment to.", 'skyline')
              ),
			 
			  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Text Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-4",
			'param_name' => 'counter3_text_color',
			'description' => esc_html__( 'Counter number color.', 'skyline' ),
		),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Font Size", 'skyline'),
                  "param_name" => "counter3_font_size",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Icon Font Size in pixels. Do not include the ''px'' just the number.", 'skyline')
              ),
            )
        ) 
        );
		// ================================ START SINGLE ICON  ================================
		  vc_map( 
            array(
            "name" => esc_html__("Single Icon", 'skyline'),
            "description" => esc_html__("Place a single icon anywhere on your page.", 'skyline'),
            "base" => "skyline_single_icon",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_icons", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
			
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
			array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Or Choose a Themify Icon", 'skyline'),
                  "param_name" => "icon_single_themify",
                  "value" => esc_html__("", 'skyline'),
                  "description" => wp_kses( __( "Visit <a href='" . get_template_directory_uri() . '/css/themify.html'."' target='_blank'>Themify Icon Codes</a> and Paste Themify Icon Code. Example: ti-home", "skyline" ), array( 'a' => 'href' ) ),
              ),
		  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-12",
			'param_name' => 'icon_single_color',
			'description' => esc_html__( 'The color of the icon, heading and text.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_single_bg',
			'description' => esc_html__( 'The background color of the icon.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Border Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_single_border',
			'description' => esc_html__( 'The border color of the icon.', 'skyline' ),
		),
		 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border Style', 'js_composer' ),
			'value' => array(
				esc_html__( 'Solid Circle', 'js_composer' ) => '1',
				esc_html__( 'Solid Square', 'js_composer' ) => '2',
				esc_html__( 'Solid Rounded', 'js_composer' ) => '3',
				esc_html__( 'Dotted Circle', 'js_composer' ) => '4',
				esc_html__( 'Dotted Square', 'js_composer' ) => '5',
				esc_html__( 'Dotted Rounded', 'js_composer' ) => '6',
				esc_html__( 'Dashed Circle', 'js_composer' ) => '7',
				esc_html__( 'Dashed Square', 'js_composer' ) => '8',
				esc_html__( 'Dashed Rounded', 'js_composer' ) => '9',
				esc_html__( 'No Border', 'js_composer' ) => '10'
			),
			'param_name' => 'icon_single_style',
			'description' => esc_html__( 'Select the icon border style.', 'skyline' ),
		),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Font Size", 'skyline'),
                  "param_name" => "icon_single_font_size",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Icon Font Size in pixels. Do not include the ''px'' just the number.", 'skyline')
              ),
			  	 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Single Link", 'skyline'),
                  "param_name" => "icon_single_link",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("You can add a URL and the icon will link to it.", 'skyline')
              ),
            )
        ) 
        );
 // ================================ START ICON FEATURE BOX STYLE 1  ================================
		  vc_map( 
            array(
            "name" => esc_html__("Icon Box Style 1", 'skyline'),
            "description" => esc_html__("Icon at top with header and text below. Border options for icon.", 'skyline'),
            "base" => "skyline_icons1",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_icons", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
			
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
			array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Or Choose a Themify Icon", 'skyline'),
                  "param_name" => "icon1_themify",
                  "value" => esc_html__("", 'skyline'),
                  "description" => wp_kses( __( "Visit <a href='" . get_template_directory_uri() . '/css/themify.html'."' target='_blank'>Themify Icon Codes</a> and Paste Themify Icon Code. Example: ti-home", "skyline" ), array( 'a' => 'href' ) ),
              ),
		  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-12",
			'param_name' => 'icon_color1',
			'description' => esc_html__( 'The color of the icon, heading and text.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_bg1',
			'description' => esc_html__( 'The background color of the icon.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Border Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_border1',
			'description' => esc_html__( 'The border color of the icon.', 'skyline' ),
		),
		 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border Style', 'js_composer' ),
			'value' => array(
				esc_html__( 'Solid Circle', 'js_composer' ) => '1',
				esc_html__( 'Solid Square', 'js_composer' ) => '2',
				esc_html__( 'Solid Rounded', 'js_composer' ) => '3',
				esc_html__( 'Dotted Circle', 'js_composer' ) => '4',
				esc_html__( 'Dotted Square', 'js_composer' ) => '5',
				esc_html__( 'Dotted Rounded', 'js_composer' ) => '6',
				esc_html__( 'Dashed Circle', 'js_composer' ) => '7',
				esc_html__( 'Dashed Square', 'js_composer' ) => '8',
				esc_html__( 'Dashed Rounded', 'js_composer' ) => '9',
				esc_html__( 'No Border', 'js_composer' ) => '10'
			),
			'param_name' => 'icon_border_style1',
			'description' => esc_html__( 'Select the icon border style.', 'skyline' ),
		),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-7",
                  "heading" => esc_html__("Heading", 'skyline'),
                  "param_name" => "icon_heading1",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Heading for the icon feature box.", 'skyline')
              ),
			    array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Heading Text Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-5",
			'param_name' => 'icon_heading_color1',
			'description' => esc_html__( 'The color of the icon, heading and text.', 'skyline' ),
		),
			   array(
                  "type" => "textarea_html",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Text", 'skyline'),
                  "param_name" => "content",
                    "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "skyline" ),
                  "description" => esc_html__("Text description to be displayed under the heading.", 'skyline')
              ),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Box Button URL (optional)", 'skyline'),
                  "param_name" => "icon_link1",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("If you add a URL a button link will be added to the bottom of the icon box.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Box Button Text (optional)", 'skyline'),
                  "param_name" => "icon_link1_text",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Specify the text to be displayed on the button.", 'skyline')
              ),
            )
        ) 
        );
		// ================================ START ICON FEATURE BOX STYLE 2  ================================
		  vc_map( 
            array(
            "name" => esc_html__("Icon Box Style 2", 'skyline'),
            "description" => esc_html__("Icon at top with header and text below. Border around entire box.", 'skyline'),
            "base" => "skyline_icons2",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_icons", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
		
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
			   array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Box Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_boxbg_color2',
			'description' => esc_html__( 'The background color of the container', 'skyline' ),
		),
             array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Or Choose a Themify Icon", 'skyline'),
                  "param_name" => "icon2_themify",
                  "value" => esc_html__("", 'skyline'),
                  "description" => wp_kses( __( "Visit <a href='" . get_template_directory_uri() . '/css/themify.html'."' target='_blank'>Themify Icon Codes</a> and Paste Themify Icon Code. Example: ti-home", "skyline" ), array( 'a' => 'href' ) ),
              ),
		  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_color2',
			'description' => esc_html__( 'The color of the icon.', 'skyline' ),
		),
		  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_bg_color2',
			'description' => esc_html__( 'The color of the icon background.', 'skyline' ),
		),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Heading", 'skyline'),
                  "param_name" => "icon_heading2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Heading for the icon feature box.", 'skyline')
              ),
			    array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Heading Text Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_heading_color2',
			'description' => esc_html__( 'The color of the heading.', 'skyline' ),
		),
			   array(
                  "type" => "textarea_html",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Text", 'skyline'),
                  "param_name" => "content",
                    "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "skyline" ),
                  "description" => esc_html__("Text description to be displayed under the heading.", 'skyline')
              ),
	
		 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border Style', 'js_composer' ),
			'value' => array(
				esc_html__( 'Solid Circle', 'js_composer' ) => '1',
				esc_html__( 'Solid Square', 'js_composer' ) => '2',
				esc_html__( 'Solid Rounded', 'js_composer' ) => '3',
				esc_html__( 'Dotted Circle', 'js_composer' ) => '4',
				esc_html__( 'Dotted Square', 'js_composer' ) => '5',
				esc_html__( 'Dotted Rounded', 'js_composer' ) => '6',
				esc_html__( 'Dashed Circle', 'js_composer' ) => '7',
				esc_html__( 'Dashed Square', 'js_composer' ) => '8',
				esc_html__( 'Dashed Rounded', 'js_composer' ) => '9',
				esc_html__( 'No Border', 'js_composer' ) => '10'
			),
			'param_name' => 'icon_border_style2',
			'description' => esc_html__( 'Select the box border style.', 'skyline' ),
		),
		
			    array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Border Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_border_color2',
			'description' => esc_html__( 'The border color of the container', 'skyline' ),
			"value" => esc_html__("#EEEEEE", 'skyline'),
		),
		
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Box Button URL (optional)", 'skyline'),
                  "param_name" => "icon_link2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("If you add a URL a button link will be added to the bottom of the icon box.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Box Button Text (optional)", 'skyline'),
                  "param_name" => "icon_link2_text",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Specify the text to be displayed on the button.", 'skyline')
              ),
            )
        ) 
        );
		
		// ================================ START ICON FEATURE BOX STYLE 3  ================================
		  vc_map( 
            array(
            "name" => esc_html__("Icon Box Style 3", 'skyline'),
            "description" => esc_html__("Icon at top with header and text below. Background options for icon.", 'skyline'),
            "base" => "skyline_icons3",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_icons", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
			
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Or Choose a Themify Icon", 'skyline'),
                  "param_name" => "icon3_themify",
                  "value" => esc_html__("", 'skyline'),
                  "description" => wp_kses( __( "Visit <a href='" . get_template_directory_uri() . '/css/themify.html'."' target='_blank'>Themify Icon Codes</a> and Paste Themify Icon Code. Example: ti-home", "skyline" ), array( 'a' => 'href' ) ),
              ),
			  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-4",
			'param_name' => 'icon_color3',
			'description' => esc_html__( 'The color of the icon.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-4",
			'param_name' => 'icon_bg_color3',
			'description' => esc_html__( 'The background color of the icon', 'skyline' ),
		),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Heading", 'skyline'),
                  "param_name" => "icon_heading3",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Heading for the icon feature box.", 'skyline')
              ),
			   array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Heading Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_heading_color3',
			'description' => esc_html__( 'The color of the heading and text.', 'skyline' ),
		),
			   array(
                  "type" => "textarea_html",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Text", 'skyline'),
                  "param_name" => "content",
                  "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "skyline" ),
                  "description" => esc_html__("Text description to be displayed under the heading.", 'skyline')
              ),
		 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border Style', 'js_composer' ),
			'value' => array(
				esc_html__( 'Solid Circle', 'js_composer' ) => '1',
				esc_html__( 'Solid Square', 'js_composer' ) => '2',
				esc_html__( 'Solid Rounded', 'js_composer' ) => '3',
			),
			'param_name' => 'icon_border_style3',
			'description' => esc_html__( 'Select the box border style.', 'skyline' ),
		),
		  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Box Border Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_border_color3',
			'description' => esc_html__( 'The color of the icon box border', 'skyline' ),
		),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Box Button URL (optional)", 'skyline'),
                  "param_name" => "icon_link3",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("If you add a URL a button link will be added to the bottom of the icon box.", 'skyline')
              ),
			   array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Box Button Text (optional)", 'skyline'),
                  "param_name" => "icon_link3_text",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Specify the text to be displayed on the button.", 'skyline')
              ),
            )
        ) 
        );
		
		// ================================ START ICON FEATURE BOX STYLE 4  ================================
		  vc_map( 
            array(
            "name" => esc_html__("Icon Box Style 4", 'skyline'),
            "description" => esc_html__("Icon on right with header and text on left.", 'skyline'),
            "base" => "skyline_icons4",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_icons", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
			
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
               array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Or Choose a Themify Icon", 'skyline'),
                  "param_name" => "icon4_themify",
                  "value" => esc_html__("", 'skyline'),
                  "description" => wp_kses( __( "Visit <a href='" . get_template_directory_uri() . '/css/themify.html'."' target='_blank'>Themify Icon Codes</a> and Paste Themify Icon Code. Example: ti-home", "skyline" ), array( 'a' => 'href' ) ),
              ),
			  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_color4',
			'description' => esc_html__( 'The color of the icon.', 'skyline' ),
		),
	array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_bg4',
			'description' => esc_html__( 'The background color of the icon.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Border Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_border4',
			'description' => esc_html__( 'The border color of the icon.', 'skyline' ),
		),
		 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border Style', 'js_composer' ),
			'value' => array(
				esc_html__( 'Solid Circle', 'js_composer' ) => '1',
				esc_html__( 'Solid Square', 'js_composer' ) => '2',
				esc_html__( 'Solid Rounded', 'js_composer' ) => '3',
				esc_html__( 'Dotted Circle', 'js_composer' ) => '4',
				esc_html__( 'Dotted Square', 'js_composer' ) => '5',
				esc_html__( 'Dotted Rounded', 'js_composer' ) => '6',
				esc_html__( 'Dashed Circle', 'js_composer' ) => '7',
				esc_html__( 'Dashed Square', 'js_composer' ) => '8',
				esc_html__( 'Dashed Rounded', 'js_composer' ) => '9',
				esc_html__( 'No Border', 'js_composer' ) => '10'
			),
			'param_name' => 'icon_border_style4',
			'description' => esc_html__( 'Select the icon border style.', 'skyline' ),
		),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Heading", 'skyline'),
                  "param_name" => "icon_heading4",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Heading for the icon feature box.", 'skyline')
              ),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Heading Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_heading_color4',
			'description' => esc_html__( 'The color of the heading.', 'skyline' ),
		),
		array(
                  "type" => "textarea_html",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Text", 'skyline'),
                  "param_name" => "content",
                   "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "skyline" ),
                  "description" => esc_html__("Text description to be displayed under the heading.", 'skyline')
          ),
		
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Box Link (optional)", 'skyline'),
                  "param_name" => "icon_link4",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("You can add a URL and the icon box will link to it.", 'skyline')
              ),
            )
        ) 
        );
		// ================================ START ICON FEATURE BOX STYLE 5  ================================
		  vc_map( 
            array(
            "name" => esc_html__("Icon Box Style 5", 'skyline'),
            "description" => esc_html__("Icon on left with header and text on right.", 'skyline'),
            "base" => "skyline_icons5",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_icons", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
			
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
               array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Or Choose a Themify Icon", 'skyline'),
                  "param_name" => "icon5_themify",
                  "value" => esc_html__("", 'skyline'),
                  'description' => __('Visit <a href="' . get_template_directory_uri() . "/css/themify.html".'" target="_blank">Themify Icon Codes</a> and Paste Themify Icon Code. Example: ti-home', 'skyline')
              ),
			  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_color5',
			'description' => esc_html__( 'The color of the icon.', 'skyline' ),
		),
	array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_bg5',
			'description' => esc_html__( 'The background color of the icon.', 'skyline' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Icon Border Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_border5',
			'description' => esc_html__( 'The border color of the icon.', 'skyline' ),
		),
		 array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Border Style', 'js_composer' ),
			'value' => array(
				esc_html__( 'Solid Circle', 'js_composer' ) => '1',
				esc_html__( 'Solid Square', 'js_composer' ) => '2',
				esc_html__( 'Solid Rounded', 'js_composer' ) => '3',
				esc_html__( 'Dotted Circle', 'js_composer' ) => '4',
				esc_html__( 'Dotted Square', 'js_composer' ) => '5',
				esc_html__( 'Dotted Rounded', 'js_composer' ) => '6',
				esc_html__( 'Dashed Circle', 'js_composer' ) => '7',
				esc_html__( 'Dashed Square', 'js_composer' ) => '8',
				esc_html__( 'Dashed Rounded', 'js_composer' ) => '9',
				esc_html__( 'No Border', 'js_composer' ) => '10'
			),
			'param_name' => 'icon_border_style5',
			'description' => esc_html__( 'Select the icon border style.', 'skyline' ),
		),
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Heading", 'skyline'),
                  "param_name" => "icon_heading5",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Heading for the icon feature box.", 'skyline')
              ),
			  	array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Heading Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-6",
			'param_name' => 'icon_heading_color5',
			'description' => esc_html__( 'The color of the heading.', 'skyline' ),
		),
			   array(
                  "type" => "textarea_html",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Text", 'skyline'),
                  "param_name" => "content",
                   "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "skyline" ),
                  "description" => esc_html__("Text description to be displayed under the heading.", 'skyline')
              ),
			 
		
		 array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Icon Box Link (optional)", 'skyline'),
                  "param_name" => "icon_link5",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("You can add a URL and the icon box will link to it.", 'skyline')
              ),
            )
        ) 
        );
		// ================================ START TESTMONIALS SLIDER  ================================
        vc_map( 
            array(
            "name" => esc_html__("Testimonials Slider", 'skyline'),
            "description" => esc_html__("Create a testimonials slider", 'skyline'),
            "base" => "skyline_testimonial",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_testimonials", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Testimonial 1", 'skyline'),
                  "param_name" => "testimonial_text",
                  "value" => esc_html__("", 'skyline'),
              ),
				array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Testimonial Author", 'skyline'),
                  "param_name" => "testimonial_author",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The name of the person giving the testimonial.", 'skyline')
              ),
			   array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Testimonial 2", 'skyline'),
                  "param_name" => "testimonial_text2",
                  "value" => esc_html__("", 'skyline'),
              ),
				array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Testimonial Author", 'skyline'),
                  "param_name" => "testimonial_author2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The name of the person giving the testimonial.", 'skyline')
              ),
			   array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Testimonial 3", 'skyline'),
                  "param_name" => "testimonial_text3",
                  "value" => esc_html__("", 'skyline'),
              ),
				array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Testimonial Author", 'skyline'),
                  "param_name" => "testimonial_author3",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The name of the person giving the testimonial.", 'skyline')
              ),
				 array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Text Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-12",
			'param_name' => 'testimonial_text_color',
			'description' => esc_html__( 'The color of testimonials text.', 'skyline' ),
		),
            )
        ) 
        );
		// ================================ START TESTIMONIALS BOX  ================================
        vc_map( 
            array(
            "name" => esc_html__("Testimonials Block", 'skyline'),
            "description" => esc_html__("Create a testimonials block", 'skyline'),
            "base" => "skyline_testimonial2",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_testimonials", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Testimonial", 'skyline'),
                  "param_name" => "testimonial_text",
                  "value" => esc_html__("", 'skyline'),
              ),
				array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Testimonial Author", 'skyline'),
                  "param_name" => "testimonial_author",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The name of the person giving the testimonial.", 'skyline')
              ),
			    array(
            'type' => 'attach_image',
            'heading' => esc_html__('Author Image (optional)', 'skyline'),
            'param_name' => 'testimonial_author_pic',
			"edit_field_class"	=> "vc_col-md-6",
            'description' => esc_html__('Include a picture of the author.', 'skyline'),
        ),
				 array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Text Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-12",
			'param_name' => 'testimonial_text_color',
			'description' => esc_html__( 'The color of testimonials text.', 'skyline' ),
		),
 array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Border Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-12",
			'param_name' => 'testimonial_border_color',
			"value" => esc_html__("#EEEEEE", 'skyline'),
			'description' => esc_html__( 'The border color of testimonial box.', 'skyline' ),
		),
         array(
    		'type' => 'colorpicker',
			'heading' => esc_html__( 'Background Color', 'skyline' ),
			"edit_field_class"	=> "vc_col-md-12",
			'param_name' => 'testimonial_bg_color',
			"value" => esc_html__("#FFFFFF", 'skyline'),
			'description' => esc_html__( 'The background color of testimonial box.', 'skyline' ),
		),
            )
        ) 
        );
	
		 // ================================ START SHOP ITEM GRID  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Shop Items Grid", 'skyline'),
            "description" => esc_html__("Create a shop items grid", 'skyline'),
            "base" => "skyline_shop",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_shop", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Shop Grid Style', 'skyline'),
                    "param_name" => "shop_grid_style",
                    "value" => array(
                        esc_html__("Grid - 2 Column", 'skyline') => 'grid2',
                        esc_html__("Grid - 3 Column", 'skyline') => 'grid3',
                        esc_html__("Grid - 4 Column", 'skyline') => 'grid4',
                    )
                ),
				array(
                    "type" => "textfield",
                    "heading" => esc_html__('Number of Items to Show', 'skyline'),
                    "param_name" => "shop_number",
                    "value" => esc_html__( "", "skyline" ),
                    ),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order By', 'skyline'),
                    "param_name" => "shop_order",
                    "value" => array(
                        esc_html__("Random", 'skyline') => 'rand',
                        esc_html__("Title", 'skyline') => 'title',
                        esc_html__("Date", 'skyline') => 'date',
                    )
					),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order', 'skyline'),
                    "param_name" => "shop_orderby",
                    "value" => array(
                        esc_html__("Ascending", 'skyline') => 'asc',
                        esc_html__("Descending", 'skyline') => 'desc',
                    )
                ),
            )
        ) 
        );
        
        // ================================ END SHOP ITEM GRID  ================================
		 // ================================ START SHOP SINGLE  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Shop Single Item", 'skyline'),
            "description" => esc_html__("Add a single shop item", 'skyline'),
            "base" => "skyline_shop_single",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_shop", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				array(
			'type' => 'loop',
			'heading' => esc_html__( 'Choose A Shop Item', 'skyline' ),
			'param_name' => 'loop',
			'settings' => array(
				'order_by' => array( 'hidden' => true ),
				'order' => array( 'hidden' => true ),
				'authors' => array( 'hidden' => true ),
				'categories' => array( 'hidden' => true ),
				'tags' => array( 'hidden' => true ),
				'tax_query' => array( 'hidden' => true ),
				'size' => array( 'hidden' => true ),
				'post_type' => array( 'hidden' => true,  'value' => 'product',),
			),
			'description' => esc_html__( 'Search for the product you wish to add.', 'skyline' )
		),
            
            )
        ) 
        );
		// ================================ START SHOP CAROUSEL  ================================
        
        vc_map( 
            array(
            "name" => esc_html__("Shop Item Carousel", 'skyline'),
            "description" => esc_html__("Create a shop item carousel", 'skyline'),
            "base" => "skyline_shop_carousel",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_carousel", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order By', 'skyline'),
                    "param_name" => "carousel_shop_order",
                    "value" => array(
                        esc_html__("Random", 'skyline') => 'rand',
                        esc_html__("Title", 'skyline') => 'title',
                        esc_html__("Date", 'skyline') => 'date',
                    )
					),
					array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Order', 'skyline'),
                    "param_name" => "carousel_shop_orderby",
                    "value" => array(
                        esc_html__("Ascending", 'skyline') => 'asc',
                        esc_html__("Descending", 'skyline') => 'desc',
                    )
                ),
					array(
                    "type" => "textfield",
                    "heading" => esc_html__('Number of Items to Show', 'skyline'),
                    "param_name" => "carousel_shop_toshow",
                    "value" => esc_html__( "", "skyline" ),
					'description' => esc_html__('The total number of shop items to be included in the slider.', 'skyline'),
            ),
			array(
                    "type" => "textfield",
                    "heading" => esc_html__('Number of Shop Items Onscreen at One Time', 'skyline'),
                    "param_name" => "carousel_shop_number",
                    "value" => esc_html__( "", "skyline" ),
					'description' => esc_html__('Enter the number of items that will be visible onscreen at one time.', 'skyline'),
            ),
			array(
                    "type" => "textfield",
                    "heading" => esc_html__('Slide Timer', 'skyline'),
                    "param_name" => "carousel_shop_timer",
                    "value" => esc_html__( "", "skyline" ),
					'description' => esc_html__('The time in milliseconds for the slide to forward. 3000 = 3 secs', 'skyline'),
            ),
				  array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Controls Color', 'skyline' ),
			'param_name' => 'carousel_shop_controls',
			"edit_field_class"	=> "vc_col-md-12",
			'description' => esc_html__( 'Select bullet controls color.', 'skyline' ),
		),
	),
) );
			// ================================ START ADD BUTTON  ================================
        vc_map( 
            array(
            'name' => esc_html__('Create a Button', 'skyline'),
            'description' => esc_html__('Create a button link', 'skyline'),
            'base' => 'skyline_button',
            'class' => '',
            'controls' => 'full',
            'icon' => 'skyline_icon skyline_icon_button', // or css class name which you can reffer in your css file later. Example: 'skyline_my_class'
            'category' => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            'params' => array(
				array(
                  'type' => 'textfield',
                  'holder' => 'div',
                  'class' => '',
				  'edit_field_class'	=> 'vc_col-md-12',
                  'heading' => esc_html__('Button Text', 'skyline'),
                  'param_name' => 'button_text',
                  'value' => esc_html__('', 'skyline'),
              ),
			    array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Add an Icon?', 'skyline'),
                    'param_name' => 'button_icon',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-4',
					'value' => array( esc_html__( 'Check if you want to add an icon to the button.', 'skyline' ) => 'yes' ),
                    ),
			    array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'js_composer' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'js_composer' ) => 'openiconic',
				esc_html__( 'Typicons', 'js_composer' ) => 'typicons',
				esc_html__( 'Entypo', 'js_composer' ) => 'entypo',
				esc_html__( 'Linecons', 'js_composer' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'js_composer' ),
			'dependency' => array('element' => 'button_icon', 'value' => array('yes')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('fontawesome')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_openiconic',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('openiconic')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_typicons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('typicons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_entypo',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 300, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('entypo')),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'js_composer' ),
			'param_name' => 'icon_linecons',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array('element' => 'icon_type', 'value' => array('linecons')),
			'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
		), 
				array(
                  'type' => 'textfield',
                  'holder' => 'div',
                  'class' => '',
				  'edit_field_class'	=> 'vc_col-md-8',
                  'heading' => esc_html__('Button Link', 'skyline'),
                  'param_name' => 'button_link',
                  'value' => esc_html__('', 'skyline'),
                  'description' => esc_html__('Paste the URL for where you want the button to go.', 'skyline')
              ),
			  array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Open in New Window?', 'skyline'),
                    'param_name' => 'button_new_window',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-4',
					'value' => array( esc_html__( 'Open link in a new window?', 'skyline' ) => 'yes' ),
                    ),
			  array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Button Size', 'skyline'),
                    'param_name' => 'button_size',
					'edit_field_class'	=> 'vc_col-md-6',
                    'value' => array(
                        esc_html__('Small', 'skyline') => 'btn-sm',
                        esc_html__('Medium', 'skyline') => 'btn-md',
						esc_html__('Large', 'skyline') => 'btn-lg',
						esc_html__('Custom Size', 'skyline') => 'custom_button',
                    )
                ),
				array(
                  'type' => 'textfield',
                  'heading' => esc_html__('Button Top/Bottom Padding', 'skyline'),
                  'desc' => esc_html__('Just type the number. Do not include the "px"', 'skyline'),
                  'param_name' => 'button_custom_topbottom',
				  'dependency' => array('element' => 'button_size', 'value' => array('custom_button')),
              ),
			  	array(
                  'type' => 'textfield',
                  'heading' => esc_html__('Side Padding', 'skyline'),
                  'desc' => esc_html__('Just type the number. Do not include the "px"', 'skyline'),
                  'param_name' => 'button_custom_sides',
				  'dependency' => array('element' => 'button_size', 'value' => array('custom_button')),
              ),
			  array(
                  'type' => 'textfield',
                  'heading' => esc_html__('Font Size in Pixels', 'skyline'),
				  'desc' => esc_html__('Just type the number. Do not include the "px"', 'skyline'),
                  'param_name' => 'button_custom_fontsize',
				  'dependency' => array('element' => 'button_size', 'value' => array('custom_button')),
              ),
				 array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Button Style', 'skyline'),
                    'param_name' => 'button_style',
					'edit_field_class'	=> 'vc_col-md-6',
                    'value' => array(
						esc_html__('Solid Square', 'skyline') => '',
						esc_html__('Solid Rounded', 'skyline') => 'btn-rounded',
						esc_html__('Solid Round', 'skyline') => 'btn-round',
                        esc_html__('Outlined Square', 'skyline') => 'btn-outline',
						esc_html__('Outlined Rounded', 'skyline') => 'btn-outline btn-rounded',
						esc_html__('Outlined Round', 'skyline') => 'btn-outline btn-round',
                        esc_html__('3D Square', 'skyline') => 'btn-3d',
						esc_html__('3D Rounded', 'skyline') => 'btn-3d btn-rounded',
						esc_html__('3D Round', 'skyline') => 'btn-3d btn-round',
                    )
                ),
				array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Make Button Block?', 'skyline'),
                    'param_name' => 'button_block',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-6',
					'value' => array( esc_html__( 'Yes, make block button?', 'skyline' ) => 'yes' ),
					'description' => esc_html__( 'The button will be the full width of its container.', 'skyline' ),
                    ),
					
				 array(
                  'type' => 'colorpicker',
                  'holder' => 'div',
                  'class' => '',
                  'heading' => esc_html__('Button Color', 'skyline'),
                  'param_name' => 'button_color',
				  'edit_field_class'	=> 'vc_col-md-6',
                  'value' => '', //Default Red color
				  'description' => esc_html__( 'Leave blank for Theme Default', 'skyline' ),
              ),
			  array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'Css', 'skyline' ),
			'param_name' => 'css',
			// 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'skyline' ),
			'group' => esc_html__( 'Design options', 'skyline' )
		),	
            )
        ) 
        );
		
		 // ================================ START CALL TO ACTION  ================================
        vc_map( 
            array(
            "name" => esc_html__("Call to Action", 'skyline'),
            "description" => esc_html__("Call to Action", 'skyline'),
            "base" => "skyline_cta",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_cta", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Heading Text", 'skyline'),
                  "param_name" => "cta_heading",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The heading text for the Call to Action", 'skyline')
              ),
			  array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Heading Font Color", 'skyline'),
                  "param_name" => "cta_heading_color",
				  "edit_field_class"	=> "vc_col-md-6",
                  "value" => '', //Default Red color
              ),
				 array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Text Content", 'skyline'),
                  "param_name" => "cta_content",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The text content for the Call to Action", 'skyline')
              ),
			  array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Content Font Color", 'skyline'),
                  "param_name" => "cta_content_color",
				  "edit_field_class"	=> "vc_col-md-12",
                  "value" => '', //Default Red color
              ),
			   array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Background Color", 'skyline'),
                  "param_name" => "cta_bg_color",
				  "edit_field_class"	=> "vc_col-md-12",
                  "value" => '', //Default Red color
				  'description' => esc_html__('Choose a background color or an image below.', 'skyline'),
              ),
			  array(
            'type' => 'attach_image',
            'heading' => esc_html__('Background Image', 'skyline'),
            'param_name' => 'cta_bg_img',
			"edit_field_class"	=> "vc_col-md-12",
            'description' => esc_html__('Select background image for the container.', 'skyline'),
        ),
		array(
                    "type" => "dropdown",
                    "heading" => esc_html__('Button Style', 'skyline'),
                    "param_name" => "cta_button_style",
					"edit_field_class"	=> "vc_col-md-4",
                    "value" => array(
						esc_html__("Basic", 'skyline') => '',
                        esc_html__("Outlined", 'skyline') => 'btn-outline',
                        esc_html__("3D", 'skyline') => 'btn-3d',
                    )
                ),
				array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-8",
                  "heading" => esc_html__("Button URL", 'skyline'),
                  "param_name" => "cta_button_url",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("Paste the URL for where you want the button to go.", 'skyline'),
              ),
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Button Text", 'skyline'),
                  "param_name" => "cta_button_text",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The text for the button.", 'skyline'),
              ),
		array(
                  "type" => "dropdown",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Border", 'skyline'),
                  "param_name" => "cta_border",
				  "edit_field_class"	=> "vc_col-md-6",
				  "description" => esc_html__("Add a border.", 'skyline'),
                   "value" => array(
						esc_html__("Off", 'skyline') => '0',
                        esc_html__("On", 'skyline') => '1'
                    )
              ),
			 array(
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_html__("Border Color", 'skyline'),
                  "param_name" => "cta_border_color",
				  "edit_field_class"	=> "vc_col-md-6",
                  "value" => '', //Default Red color
              ),
			   
            )
        ) 
        );
		 
		// ================================ START TIMELINE  ================================
        vc_map( 
            array(
            "name" => esc_html__("Timeline", 'skyline'),
            "description" => esc_html__("Create a timeline of events", 'skyline'),
            "base" => "skyline_timeline",
            "class" => "",
            "controls" => "full",
            "icon" => "skyline_icon skyline_icon_timeline", // or css class name which you can reffer in your css file later. Example: "skyline_my_class"
            "category" => esc_html__('SKYLINE Elements', 'skyline'),
            //'admin_enqueue_js' => array(plugins_url('assets/skyline.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/skyline_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
			  
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Timeline Item 1 Heading", 'skyline'),
                  "param_name" => "timeline_heading",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The heading text for the Timeline item.", 'skyline')
              ),
				 array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Timeline Item 1 Content", 'skyline'),
                  "param_name" => "timeline_content",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The text content for the Timeline item", 'skyline')
              ),
            
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Timeline Item 2 Heading", 'skyline'),
                  "param_name" => "timeline_heading2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The heading text for the Timeline item.", 'skyline')
              ),
				 array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Timeline Item 2 Content", 'skyline'),
                  "param_name" => "timeline_content2",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The text content for the Timeline item", 'skyline')
              ),
			
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Timeline Item 3 Heading", 'skyline'),
                  "param_name" => "timeline_heading3",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The heading text for the Timeline item.", 'skyline')
              ),
				 array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Timeline Item 3 Content", 'skyline'),
                  "param_name" => "timeline_content3",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The text content for the Timeline item", 'skyline')
              ),
			
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Timeline Item 4 Heading", 'skyline'),
                  "param_name" => "timeline_heading4",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The heading text for the Timeline item.", 'skyline')
              ),
				 array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Timeline Item 4 Content", 'skyline'),
                  "param_name" => "timeline_content4",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The text content for the Timeline item", 'skyline')
              ),
		
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Timeline Item 5 Heading", 'skyline'),
                  "param_name" => "timeline_heading5",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The heading text for the Timeline item.", 'skyline')
              ),
				 array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Timeline Item 5 Content", 'skyline'),
                  "param_name" => "timeline_content5",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The text content for the Timeline item", 'skyline')
              ),
			
			  array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-6",
                  "heading" => esc_html__("Timeline Item 6 Heading", 'skyline'),
                  "param_name" => "timeline_heading6",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The heading text for the Timeline item.", 'skyline')
              ),
				 array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
				  "edit_field_class"	=> "vc_col-md-12",
                  "heading" => esc_html__("Timeline Item 6 Content", 'skyline'),
                  "param_name" => "timeline_content6",
                  "value" => esc_html__("", 'skyline'),
                  "description" => esc_html__("The text content for the Timeline item", 'skyline')
              ),
            )
        ) 
        );
// ================================ START ROW OPTIONS ================================
$admin_url = admin_url();
vc_remove_param("vc_row", "font_color");
vc_remove_param("vc_row", "el_class");
vc_remove_param("vc_row", "css");
vc_remove_param("vc_row_inner", "font_color");
vc_remove_param("vc_row_inner", "el_class");
vc_remove_param("vc_row_inner", "css");
    vc_map( array(
    'name' => esc_html__( 'Row', 'skyline' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => true,
	'category' => esc_html__( 'Content', 'skyline' ),
	'description' => esc_html__( 'Place content elements inside the row', 'skyline' ),
	'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Container Style', 'skyline'),
            'param_name' => 'container_style',
            'value' => array(
                esc_html__('Default Container', 'skyline') => 'default',
                esc_html__('Parallax Background Image Container', 'skyline') => 'parallax',
                esc_html__('Static Background Image Container', 'skyline') => 'fixed-image',
				esc_html__('Ken Burns Background Image Container', 'skyline') => 'ken-burns',
                esc_html__('Fullwidth Container', 'skyline') => 'fullwidth',
                esc_html__('Slider Display', 'skyline') => 'slider',
				esc_html__('Video Background', 'skyline') => 'video-bg'
            ),
            'description' => esc_html__('Select the container style.', 'skyline'),
        ),
		 array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Background Color', 'skyline' ),
			'param_name' => 'bg_color',
			'description' => esc_html__( 'Select Background Color', 'skyline' ),
            'dependency' => array('element' => 'container_style', 'value' => array('fullwidth','default')),
		),
		 array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Gradient Background Color(optional)', 'skyline' ),
			'param_name' => 'bg_color2',
			'description' => esc_html__( 'Select a second Background Color to create a gradient.', 'skyline' ),
            'dependency' => array('element' => 'container_style', 'value' => array('fullwidth','default')),
		),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Background Image', 'skyline'),
            'param_name' => 'bg_image',
            'description' => esc_html__('Select a background image for this section. (jpg, png, gif supported)', 'skyline'),
            'dependency' => array('element' => 'container_style', 'value' => array('parallax','fixed-image','ken-burns')),
        ),
			array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Tile the background image?', 'skyline'),
                    'param_name' => 'tile_bg',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-4',
					 'dependency' => array('element' => 'container_style', 'value' => array('parallax','fixed-image','ken-burns')),
					'value' => array( 
					esc_html__( 'Yes Tile the Image', 'skyline' ) => 'auto',
					)
                ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__('Background Video', 'skyline'),
            'param_name' => 'bg_video',
            'description' => esc_html__('Paste your YouTube video id here. Example: oPa-48tkJ68', 'skyline'),
            'dependency' => array('element' => 'container_style', 'value' => array('video-bg')),
        ),
		  array(
            'type' => 'attach_image',
            'heading' => esc_html__('Background Image for Mobile', 'skyline'),
            'param_name' => 'bg_image_backup',
            'description' => esc_html__('Choose a background image to use as a backup. Some mobile devices will not support video backgrounds.', 'skyline'),
            'dependency' => array('element' => 'container_style', 'value' => array('video-bg')),
        ),
		 array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Background Overlay Color', 'skyline' ),
			'param_name' => 'bg_overlay_color',
			'description' => esc_html__( 'Select Background Overlay Color. Default #000000, Alpha: 40%', 'skyline' ),
			'dependency' => array('element' => 'container_style', 'value' => array('parallax','fixed-image','ken-burns')),
		), 
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Gradient Background Color(optional)', 'skyline' ),
			'param_name' => 'bg_overlay_color2',
			'description' => esc_html__( 'Select a second Background Color to create a gradient.', 'skyline' ),
            'dependency' => array('element' => 'container_style', 'value' => array('parallax','fixed-image','ken-burns')),
		),
		
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Top Padding', 'skyline' ),
			'param_name' => 'padding_top',
			"edit_field_class"	=> "vc_col-md-6",
			'description' => esc_html__( 'Enter your top padding. Leave blank for default. Just enter number, no "px". Default: 100px', 'skyline' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Bottom Padding', 'skyline' ),
			'param_name' => 'padding_bottom',
			"edit_field_class"	=> "vc_col-md-6",
			'description' => esc_html__( 'Enter your bottom padding. Leave blank for default. Just enter number, no "px". Default: 100px', 'skyline' ),
		),
			array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Left Padding', 'skyline' ),
			'param_name' => 'padding_left',
			'description' => esc_html__( 'Enter your right padding. Leave blank for default. Just enter number, no "px". Default: 0px', 'skyline' ),
			 'dependency' => array('element' => 'container_style', 'value' => array('fullwidth')),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Right Padding', 'skyline' ),
			'param_name' => 'padding_right',
			'description' => esc_html__( 'Enter your left padding. Leave blank for default. Just enter number, no "px". Default: 0px', 'skyline' ),
			 'dependency' => array('element' => 'container_style', 'value' => array('fullwidth')),
		),
			 array(
            'type' => 'dropdown',
            'heading' => esc_html__('Container Height (optional)', 'skyline'),
            'param_name' => 'container_height',
            'value' => array(
				esc_html__('Not Set', 'skyline') => 'auto',
                esc_html__('25%', 'skyline') => 'height-25',
				esc_html__('33%', 'skyline') => 'height-33',
				esc_html__('50%', 'skyline') => 'height-50',
				esc_html__('75%', 'skyline') => 'height-75',
				esc_html__('85%', 'skyline') => 'height-85',
                esc_html__('100%', 'skyline') => 'height-100',
            ),
            'description' => esc_html__('The container will dynamically change to be the percentage of height of the users screen. Example: 50% Height will make the container exactly 50% of the users screen.', 'skyline'),
        ), 
		array(
            'type' => 'textfield',
            'heading' => esc_html__('One Page Identifier', 'skyline'),
            'param_name' => 'onepage',
            'description' => esc_html__('If you are creating a One Page layout, you need to give each section a unique identifying name.', 'skyline'),
        ),
		 array(
            'type' => 'dropdown',
            'heading' => esc_html__('Row Separator', 'skyline'),
            'param_name' => 'row_separator',
            'value' => array(
                esc_html__('Standard Straight', 'skyline') => '',
                esc_html__('Arrow Center', 'skyline') => 'ss-style-triangles',
                esc_html__('Angle Left', 'skyline') => 'ss-style-diagonal',
                esc_html__('Angle Right', 'skyline') => 'ss-style-diagonal-right',
				esc_html__('Puzzle Piece', 'skyline') => 'ss-style-puzzle',
            ),
            'description' => esc_html__('A special separator can be applied to the bottom of the current row.', 'skyline'),
			 'dependency' => array('element' => 'container_style', 'value' => array('default','fullwidth')),
        ),
	
		array(
            'type' => 'textfield',
            'heading' => esc_html__('Custom Class Name', 'skyline'),
            'param_name' => 'custom_class',
            'description' => esc_html__('Add a class name to the container which can be used to style any elements within in it from your CSS file.', 'skyline'),
        ),
	
	),
	'js_view' => 'VcRowView'
) );
 // END ROW OPTIONS
 // VC ROW OPTIONS OUTPUT VC_TEMPLATES > VC_ROW
 
 
 // ================================ START COLUMN OPTIONS ================================
vc_map( array(
	'name' => esc_html__( 'Column', 'skyline' ),
	'base' => 'vc_column',
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Font Color', 'skyline' ),
			'param_name' => 'font_color',
			'description' => esc_html__( 'Select font color', 'skyline' ),
			'edit_field_class' => 'vc_col-md-6 vc_column'
		),
		array(
            'type' => 'dropdown',
            'heading' => esc_html__('Horizontal Content Alignment', 'skyline'),
            'param_name' => 'col_align',
            'value' => array(
                esc_html__('Left', 'skyline') => 'text-left',
				esc_html__('Center', 'skyline') => 'text-center',
				esc_html__('Right', 'skyline') => 'text-right',
            ),
            'description' => esc_html__('How do you want the content of this container aligned?', 'skyline'),
        ),
		 array(
                    'type' => 'checkbox',
                    'heading' => esc_html__('Vertical Center Content?', 'skyline'),
                    'param_name' => 'col_vert_align',
                    'value' => esc_html__( '', 'skyline' ),
					'edit_field_class'	=> 'vc_col-md-4',
					'value' => array( esc_html__( 'Check if you want to have the columns content vertically centered', 'skyline' ) => 'vertical_center' ),
                    ),
		array(
            'type' => 'dropdown',
            'heading' => esc_html__('Animation On/Off', 'skyline'),
            'param_name' => 'animate',
            'value' => array(
                esc_html__('Off', 'skyline') => '0',
				esc_html__('On', 'skyline') => '1',
            ),
            'description' => esc_html__('Choose whether the column should animate on scroll', 'skyline'),
        ),
		 array(
            'type' => 'dropdown',
			"edit_field_class"	=> "vc_col-md-6",
            'heading' => esc_html__('Animation', 'skyline'),
            'param_name' => 'animation',
            'value' => array(
                esc_html__('Bounce', 'skyline') => 'bounce',
				esc_html__('Flash', 'skyline') => 'flash',
				esc_html__('Pulse', 'skyline') => 'pulse',
				esc_html__('Rubber Band', 'skyline') => 'rubberBand',
				esc_html__('Shake', 'skyline') => 'shake',
				esc_html__('Swing', 'skyline') => 'swing',
				esc_html__('Tada', 'skyline') => 'tada',
				esc_html__('Bounce In', 'skyline') => 'bounceIn',
				esc_html__('Bounce In Down', 'skyline') => 'bounceInDown',
				esc_html__('Bounce In Left', 'skyline') => 'bounceInLeft',
				esc_html__('Bounce In Right', 'skyline') => 'bounceInRight',
				esc_html__('Bounce In Up', 'skyline') => 'bounceInUp',
				esc_html__('Fade In', 'skyline') => 'fadeIn',
				esc_html__('Fade In Down', 'skyline') => 'fadeInDown',
				esc_html__('Fade In Left', 'skyline') => 'fadeInLeft',
				esc_html__('Fade In Right', 'skyline') => 'fadeInRight',
				esc_html__('Fade In Up', 'skyline') => 'fadeInUp',
				esc_html__('Slide In Down', 'skyline') => 'slideInDown',
				esc_html__('Slide In Left', 'skyline') => 'slideInLeft',
				esc_html__('Slide In Right', 'skyline') => 'slideInRight',
				esc_html__('Slide In Up', 'skyline') => 'slideInUp',
				esc_html__('Flip', 'skyline') => 'flip',
				esc_html__('Flip In X Axis', 'skyline') => 'flipInX',
				esc_html__('Flip In Y Axis', 'skyline') => 'flipInY',
				esc_html__('Rotate In', 'skyline') => 'rotateIn',
				esc_html__('Rotate In Down Left', 'skyline') => 'rotateInDownLeft',
				esc_html__('Rotate In Down Right', 'skyline') => 'rotateInDownRight',
				esc_html__('Roll In Left', 'skyline') => 'rollInLeft',
				esc_html__('Roll In Right', 'skyline') => 'rollInRight',
            ),
            'description' => esc_html__('Choose your animation', 'skyline'),
        ),
		array(
			'type' => 'textfield',
			"edit_field_class"	=> "vc_col-md-6",
			'heading' => esc_html__( 'Animation Delay', 'skyline' ),
			'param_name' => 'delay',
			'description' => esc_html__( 'Add a delay in milliseconds. Example: 1000 = 1 second, 500 = 0.5 seconds', 'skyline' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'skyline' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'skyline' )
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'Css', 'skyline' ),
			'param_name' => 'css',
			// 'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'skyline' ),
			'group' => esc_html__( 'Design options', 'skyline' )
		),	
		array(
			'type' => 'column_offset',
			'heading' => esc_html__('Responsiveness', 'skyline'),
			'param_name' => 'offset',
			'group' => esc_html__( 'Width & Responsiveness', 'skyline' ),
			'description' => esc_html__('Adjust column for different screen sizes. Control width, offset and visibility settings.', 'skyline')
		)
	),
	'js_view' => 'VcColumnView'
) );
 // END COLUMN OPTIONS
 // VC COLUMN OPTIONS OUTPUT VC_TEMPLATES > VC_COLUMN
 
    }
 // END INTEGRATE WITH VC FUNCTION
/* ================================ SHORTCODE RENDERING OUTPUT ================================ */
  //  ================================ START SEPARATOR  ================================
 public function skyline_separator( $atts ) {
      extract( shortcode_atts( array(
        'separator_style' => 'blank',
		'separator_width' => '100%',
		'separator_height' => '1px',
		'separator_margin_top' => '',
		'separator_margin_bottom' => '',
		'separator_align' => 'text-center',
		'separator_color' => '',
      ), $atts ) );
      $output = "<div class='skyline-separator-wrapper {$separator_align}'><div class='skyline-separator' style='border: none; border-bottom:{$separator_height} {$separator_style} {$separator_color}; width:{$separator_width}; margin-top:{$separator_margin_top}px; margin-bottom:{$separator_margin_bottom}px;'></div></div>";
	  return $output;
    }
    //  ================================ END SEPARATOR  ================================
  
//  ================================ START BLOG POSTS OUTPUT  ================================
public function skyline_blog( $atts ) {
$output = $blog_number = $blog_style = $blog_order = $blog_orderby = '';
      extract( shortcode_atts( array(
	'blog_style' => 'traditional',
	'post_formats' => 'standard',
	'blog_number' => '',
	'blog_order' => 'rand',
	'blog_orderby' => 'asc',
      ), $atts ) );
$blog_number = "{$blog_number}";
$blog_style = "{$blog_style}";
$post_formats = "{$post_formats}";
$blog_order = "{$blog_order}";
$blog_orderby = "{$blog_orderby}";
// ===== Setting Blog Style =====
// Blog Traditional
if ($blog_style == "traditional") {
ob_start();
include "skyline_templates/blog-traditional.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
}
// Blog Horizontal
else if ($blog_style == "horizontal") {
ob_start();
include "skyline_templates/blog-horizontal.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
}
// Blog Grid 2 Column
else if ($blog_style == "grid2") {
ob_start();
include "skyline_templates/blog-grid-2-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
}
// Blog Grid 3 Column
else if ($blog_style == "grid3") {
ob_start();
include "skyline_templates/blog-grid-3-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
// Blog Grid 4 Column
else if ($blog_style == "grid4") {
ob_start();
include "skyline_templates/blog-grid-4-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
// Blog Masonry 2 Column
else if ($blog_style == "masonry2") {
ob_start();
include "skyline_templates/blog-masonry-2-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
// Blog Masonry 3 Column
else if ($blog_style == "masonry3") {
ob_start();
include "skyline_templates/blog-masonry-3-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
// Blog Masonry 4 Column
else if ($blog_style == "masonry4") {
ob_start();
include "skyline_templates/blog-masonry-4-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
}
   
    // ================================ END BLOG POSTS OUTPUT ================================
	
		//  ================================ START BLOG POST SLIDER OUTPUT  ================================
 public function skyline_blog_slider( $atts ) {
      extract( shortcode_atts( array(
        'loop' => '',
		'slider_height' => 'height-50',
      ), $atts ) );
$slider_height = "{$slider_height}";
ob_start();
include "skyline_templates/blog-post-slider.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END BLOG POST SLIDER OUTPUT ================================
	//  ================================ START BLOG CAROUSEL OUTPUT  ================================
 public function skyline_blog_carousel( $atts ) {
      extract( shortcode_atts( array(
        'carousel_blog_order' => 'rand',
		'carousel_blog_orderby' => 'asc',
		'carousel_posts_toshow' => '',
		'carousel_post_formats' => '',
		'carousel_blog_number' => '',
		'carousel_blog_timer' => '',
		'carousel_blog_controls' => '',
      ), $atts ) );
$carousel_blog_order = "{$carousel_blog_order}";
$carousel_blog_orderby = "{$carousel_blog_orderby}";
$carousel_posts_toshow = "{$carousel_posts_toshow}";
$carousel_post_formats = "{$carousel_post_formats}";
$carousel_blog_number = "{$carousel_blog_number}";
$carousel_blog_timer = "{$carousel_blog_timer}";
$carousel_blog_controls = "{$carousel_blog_controls}";
ob_start();
include "skyline_templates/blog-carousel.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END BLOG CAROUSEL OUTPUT ================================
  //  ================================ START SINGLE IMAGE DISPLAY OUTPUT  ================================
 public function skyline_single_image( $atts ) {
      extract( shortcode_atts( array(
        'single_image' => '',
		'single_image_caption' => '',
		'single_image_style' => '1',
		'lightbox' => '1',
		'single_img_link' => '',
		'image_align' => 'text-left',
		'image_width' => '100%',
		'image_border' => '',
		'image_border_radius' => '',
		'image_border_width' => '',
      ), $atts ) );
$single_image = "{$single_image}";
$single_image_url = wp_get_attachment_image_src( $single_image, 'blog-posts' );
$single_image_caption = "{$single_image_caption}";
$single_image_style = "{$single_image_style}";
$lightbox = "{$lightbox}";
$single_img_link = "{$single_img_link}";
$image_align = "{$image_align}";
$image_width = "{$image_width}";
$image_border = "{$image_border}";
$image_border_radius = "{$image_border_radius}";
$image_border_width = "{$image_border_width}";
ob_start();
include "skyline_templates/single-image.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END SINGLE IMAGE DISPLAY OUTPUT ================================
//  ================================ START IMAGE GALLERY DISPLAY OUTPUT  ================================
 public function skyline_image_gallery( $atts ) {
      extract( shortcode_atts( array(
        'gallery_images' => '',
		'gallery_style' => '1',
		'gallery_layout_style'	=> '1',
      ), $atts ) );
$gallery_images = "{$gallery_images}";
$gallery_style = "{$gallery_style}";
$gallery_layout_style = "{$gallery_layout_style}";
// Array of Features
$gallery_items = explode(',',$gallery_images);
$arrlength_gallery = count($gallery_items);
ob_start();
include "skyline_templates/image-gallery.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END IMAGE GALLERY DISPLAY OUTPUT ================================
//  ================================ START IMAGE CAROUSEL OUTPUT  ================================
 public function skyline_image_carousel( $atts ) {
      extract( shortcode_atts( array(
        'carousel_images' => '',
		'carousel_style' => '1',
		'carousel_image_number' => '4',
		'carousel_timer' => '3000',
		'carousel_controls' => '',
      ), $atts ) );
$carousel_images = "{$carousel_images}";
$carousel_style = "{$carousel_style}";
$carousel_image_number = "{$carousel_image_number}";
$carousel_timer = "{$carousel_timer}";
$carousel_controls = "{$carousel_controls}";
// Array of Features
$carousel_items = explode(',',$carousel_images);
$arrlength_carousel = count($carousel_items);
ob_start();
include "skyline_templates/image-carousel.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END IMAGE CAROUSEL OUTPUT ================================
//  ================================ START LIGHTBOX VIDEO OUTPUT  ================================
 public function skyline_lightbox_video( $atts ) {
      extract( shortcode_atts( array(
        'vid_lightbox_placeholder' => '',
		'vid_lightbox_youtube' => '',
      ), $atts ) );
$vid_lightbox_placeholder = "{$vid_lightbox_placeholder}";
$vid_lightbox_placeholder_url = wp_get_attachment_image_src( $vid_lightbox_placeholder, 'blog-posts' );
$vid_lightbox_youtube = "{$vid_lightbox_youtube}";
ob_start();
include "skyline_templates/video-lightbox.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END LIGHTBOX VIDEO OUTPUT ================================
//  ================================ START PORTFOLIO GRID OUTPUT  ================================
public function skyline_portfolio_grid( $atts ) {
$output = $portfolio_number = $portfolio_style = $portfolio_order = $portfolio_orderby = $portfolio_img_style = $portfolio_filter = '';
      extract( shortcode_atts( array(
	'portfolio_style' => 'grid2',
	'portfolio_number' => '',
	'portfolio_order' => 'rand',
	'portfolio_orderby' => 'asc',
	'portfolio_img_style' => 'square',
	'portfolio_filter' => 'no_filter',
      ), $atts ) );
$portfolio_number = "{$portfolio_number}";
$portfolio_style = "{$portfolio_style}";
$portfolio_order = "{$portfolio_order}";
$portfolio_orderby = "{$portfolio_orderby}";
$portfolio_img_style = "{$portfolio_img_style}";
$portfolio_filter = "{$portfolio_filter}";
// ===== Setting portfolio Style =====
// portfolio Grid 2 Column
if ($portfolio_style == "grid2") {
ob_start();
include "skyline_templates/portfolio-grid-2-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
}
// portfolio Grid 3 Column
else if ($portfolio_style == "grid3") {
ob_start();
include "skyline_templates/portfolio-grid-3-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
// portfolio Grid 4 Column
else if ($portfolio_style == "grid4") {
ob_start();
include "skyline_templates/portfolio-grid-4-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
// portfolio Grid 6 Column
else if ($portfolio_style == "grid6") {
ob_start();
include "skyline_templates/portfolio-grid-6-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
}
   
    // ================================ END PORTFOLIO GRID OUTPUT ================================	
//  ================================ START TEAM DISPLAY OUTPUT  ================================
 public function skyline_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'loop' => '',
		'header_color' => '',
		'border_color' => '',
		'team1_border_radius' => '',
		'team1_social_icons' => '',
      ), $atts ) );
	  $content = wpb_js_remove_wpautop($content, true);
$header_color = "{$header_color}";
$border_color = "{$border_color}";
$team1_border_radius = "{$team1_border_radius}";
$team1_social_icons = "{$team1_social_icons}";
ob_start();
include "skyline_templates/team-members.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END TEAM DISPLAY OUTPUT ================================
//  ================================ START TEAM 2 DISPLAY OUTPUT  ================================
 public function skyline_team2( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'loop' => '',
		'team2_header_color' => '',
		'team2_border_color' => '',
		'team2_border_radius' => '',
		'team2_social_icons' => '',
      ), $atts ) );
	  $content = wpb_js_remove_wpautop($content, true);
$team2_header_color = "{$team2_header_color}";
$team2_border_color = "{$team2_border_color}";
$team2_border_radius = "{$team2_border_radius}";
$team2_social_icons = "{$team2_social_icons}";
ob_start();
include "skyline_templates/team-members2.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END TEAM DISPLAY OUTPUT ================================
//  ================================ START LIST OUTPUT  ================================
 public function skyline_list( $atts ) {
      extract( shortcode_atts( array(
        'list' => '',
        'list_icon_color' => '',
		'list_icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
      ), $atts ) );
	  $content = wpb_js_remove_wpautop($content, true);
$list = "{$list}";
$list_icon_color = "{$list_icon_color}";
$list_icon = "{$list_icon_type}";
// Array of Features
$list_items = explode(',',$list);
$arrlength_list = count($list_items);
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $list_icon );
$list_icon_code = isset( ${"icon_" . $list_icon} ) ? esc_attr( ${"icon_" . $list_icon} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/list.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
//  ================================ START PRICING DISPLAY OUTPUT  ================================
 public function skyline_pricing( $atts ) {
      extract( shortcode_atts( array(
        'pricing_item_heading' => '',
		'pricing_item_price' => '',
		'pricing_item_frequency' => '',
		'pricing_item_description' => '',
		'pricing_item_features' => '',
		'pricing_item_button' => '',
		'pricing_item_button_link' => '',
		'pricing_item_rating' => '1',
		'pricing_item_star_color' => '',
		'pricing_item_border' => '2',
		'pricing_item_border_color' => '',
		'pricing_item_btn_color' => '',
		'pricing_item_font_color' => '',
		'pricing_item_headings_color' => '',
      ), $atts ) );
	  
$pricing_item_heading = "{$pricing_item_heading}";
$pricing_item_price = "{$pricing_item_price}";
$pricing_item_frequency = "{$pricing_item_frequency}";
$pricing_item_description = "{$pricing_item_description}";
$pricing_item_features = "{$pricing_item_features}";
$pricing_item_button = "{$pricing_item_button}";
$pricing_item_button_link = "{$pricing_item_button_link}";
$pricing_item_rating = "{$pricing_item_rating}";
$pricing_item_star_color = "{$pricing_item_star_color}";
$pricing_item_border = "{$pricing_item_border}";
$pricing_item_border_color = "{$pricing_item_border_color}";
$pricing_item_btn_color = "{$pricing_item_btn_color}";
$pricing_item_font_color = "{$pricing_item_font_color}";
$pricing_item_headings_color = "{$pricing_item_headings_color}";
// Array of Features
$pricing_features = explode(',',$pricing_item_features);
$pricing_arrlength = count($pricing_features);
ob_start();
include "skyline_templates/pricing-tables.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
//  ================================ START PRICING DISPLAY OUTPUT STYLE 2  ================================
 public function skyline_pricing2( $atts ) {
      extract( shortcode_atts( array(
        'pricing_item_heading2' => '',
		'pricing_item_price2' => '',
		'pricing_item_frequency2' => '',
		'pricing_item_description2' => '',
		'pricing_item_features2' => '',
		'pricing_item_button2' => '',
		'pricing_item_button_link2' => '',
		'pricing_item_rating2' => '1',
		'pricing_item_star_color2' => '',
		'pricing_item_border2' => '2',
		'pricing_item_border_color2' => '',
		'pricing_item_btn_color2' => '',
		'pricing_item_font_color2' => '',
		'pricing_item_headings_color2' => '',
      ), $atts ) );
	  
$pricing_item_heading2 = "{$pricing_item_heading2}";
$pricing_item_price2 = "{$pricing_item_price2}";
$pricing_item_frequency2 = "{$pricing_item_frequency2}";
$pricing_item_description2 = "{$pricing_item_description2}";
$pricing_item_features2 = "{$pricing_item_features2}";
$pricing_item_button2 = "{$pricing_item_button2}";
$pricing_item_button_link2 = "{$pricing_item_button_link2}";
$pricing_item_rating2 = "{$pricing_item_rating2}";
$pricing_item_star_color2 = "{$pricing_item_star_color2}";
$pricing_item_border2 = "{$pricing_item_border2}";
$pricing_item_border_color2 = "{$pricing_item_border_color2}";
$pricing_item_btn_color2 = "{$pricing_item_btn_color2}";
$pricing_item_font_color2 = "{$pricing_item_font_color2}";
$pricing_item_headings_color2 = "{$pricing_item_headings_color2}";
// Array of Features
$pricing_features2 = explode(',',$pricing_item_features2);
$pricing_arrlength2 = count($pricing_features2);
ob_start();
include "skyline_templates/pricing-tables2.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
//  ================================ START CUSTOM HEADER OUTPUT  ================================	 
 public function skyline_headings( $atts ) {
      extract( shortcode_atts( array(
        'header_text' => '',
        'header_style' => '',
		'header_color' => '',
		'header_tag' => 'H1',
		'header_align' => 'text-left',
		'header_weight'	=> '',
		'header_font_size'	=> '',
		'header_mobile_font_size'	=> '',
		'header_top_margin' => '',
		'header_bottom_margin' => '',
      ), $atts ) );
    ob_start();
include "skyline_templates/headings.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
    }
//  ================================ END CUSTOM HEADER OUTPUT  ================================	
//  ================================ START GOOGLE MAP  ================================
 public function skyline_map( $atts ) {
      extract( shortcode_atts( array(
        'loc_1_lat' => '',
		'loc_1_long' => '',
		'loc_1_desc' => '',
		'loc_2_lat' => '',
		'loc_2_long' => '',
		'loc_2_desc' => '',
		'loc_3_lat' => '',
		'loc_3_long' => '',
		'loc_3_desc' => '',
		'loc_4_lat' => '',
		'loc_4_long' => '',
		'loc_4_desc' => '',
		'loc_5_lat' => '',
		'loc_5_long' => '',
		'loc_5_desc' => '',
		'map_zoom' => '',
		'google_api' => '',
		'map_height' => '',
      ), $atts ) );
	  
$loc_1_lat = "{$loc_1_lat}";
$loc_1_long = "{$loc_1_long}";
$loc_1_desc = "{$loc_1_desc}";
$loc_2_lat = "{$loc_2_lat}";
$loc_2_long = "{$loc_2_long}";
$loc_2_desc = "{$loc_2_desc}";
$loc_3_lat = "{$loc_3_lat}";
$loc_3_long = "{$loc_3_long}";
$loc_3_desc = "{$loc_3_desc}";
$loc_4_lat = "{$loc_4_lat}";
$loc_4_long = "{$loc_4_long}";
$loc_4_desc = "{$loc_4_desc}";
$loc_5_lat = "{$loc_5_lat}";
$loc_5_long = "{$loc_5_long}";
$loc_5_desc = "{$loc_5_desc}";
$google_api = "{$google_api}";
$map_zoom = "{$map_zoom}";
$map_height = "{$map_height}";
ob_start();
include "skyline_templates/google-map.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END GOOGLE MAP ================================
	
	//  ================================ START CONTACT FORM  ================================
 public function skyline_contact_form( $atts ) {
      extract( shortcode_atts( array(
        'recipient' => '',
		'name_label' => '',
		'email_label' => '',
		'message_label' => '',
		'send_button' => '',
		'template_url' => '',
      ), $atts ) );
	  
$recipient = "{$recipient}";
$name_label = "{$name_label}";
$email_label = "{$email_label}";
$message_label = "{$message_label}";
$send_button = "{$send_button}";
$template_url = get_template_directory_uri();
ob_start();
include "skyline_templates/contact-form.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END CONTACT FORM ================================
	
//  ================================ START COUNTER  ================================
 public function skyline_counter( $atts ) {
      extract( shortcode_atts( array(
        'counter_value' => '',
		'counter_icon' => '',
		'counter_text' => '',
		'counter_text_color' => '',
		'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
      ), $atts ) );
$icon_type = "{$icon_type}";	 
$counter_value = "{$counter_value}";
$counter_icon = "{$counter_icon}";
$counter_text = "{$counter_text}";
$counter_text_color = "{$counter_text_color}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$icon_code_counter = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/counter.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END COUNTER ================================
	
	//  ================================ START COUNTER 2  ================================
 public function skyline_counter2( $atts ) {
      extract( shortcode_atts( array(
        'counter_value2' => '',
		'counter_icon2' => '',
		'counter_text2' => '',
		'counter_text_color2' => '',
		'counter_bg_color2' => '',
		'counter_border_color2' => '',
	    'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
      ), $atts ) );
	  
$icon_type = "{$icon_type}";	 
$counter_value2 = "{$counter_value2}";
$counter_icon2 = "{$counter_icon2}";
$counter_text2 = "{$counter_text2}";
$counter_text_color2 = "{$counter_text_color2}";
$counter_bg_color2 = "{$counter_bg_color2}";
$counter_border_color2 = "{$counter_border_color2}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$icon_code_counter2 = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/counter2.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END COUNTER 2 ================================
		//  ================================ START COUNTER 3  ================================
 public function skyline_counter3( $atts ) {
      extract( shortcode_atts( array(
        'counter3_value' => '',
		'counter3_text_color' => '',
		'counter3_font_size' => '',
      ), $atts ) );
	   
$counter3_value = "{$counter3_value}";
$counter3_text_color = "{$counter3_text_color}";
$counter3_font_size = "{$counter3_font_size}";

ob_start();
include "skyline_templates/counter3.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
	//  ================================ START ICON SINGLE ================================
 public function skyline_single_icon( $atts ) {
      extract( shortcode_atts( array(
        'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
		'icon_single_themify' => '',
		'icon_single_color' => '',
		'icon_single_bg' => '',
		'icon_single_border' => '',
		'icon_single_style' => '1',
		'icon_single_font_size' => '',
		'icon_single_link' => '',
      ), $atts ) );
$icon_type = "{$icon_type}";	
$icon_single_themify = "{$icon_single_themify}";	  
$icon_single_color = "{$icon_single_color}";	  
$icon_single_bg = "{$icon_single_bg}";
$icon_single_border = "{$icon_single_border}";
$icon_single_style = "{$icon_single_style}";
$icon_single_font_size = "{$icon_single_font_size}";
$icon_single_link = "{$icon_single_link}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$icon_single_code = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/icon-single.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
//  ================================ START ICON STYLE 1  ================================
 public function skyline_icons1( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
		'icon1_themify' => '',
		'icon_color1' => '',
		'icon_heading1' => '',
		'icon_heading_color1' => '',
		'icon_bg1' => '',
		'icon_border1' => '',
		'icon_border_style1' => '1',
		'icon_link1' => '',
		'icon_link1_text' => '',
      ), $atts ) );
	  $content = wpb_js_remove_wpautop($content, true);
$icon_type = "{$icon_type}";	  
$icon1_themify = "{$icon1_themify}";
$icon_color1 = "{$icon_color1}";
$icon_heading1 = "{$icon_heading1}";
$icon_heading_color1 = "{$icon_heading_color1}";
$icon_border1 = "{$icon_border1}";
$icon_bg1 = "{$icon_bg1}";
$icon_border_style1 = "{$icon_border_style1}";
$icon_link1 = "{$icon_link1}";
$icon_link1_text = "{$icon_link1_text}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$icon_code1 = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/icon-style1.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
//  ================================ START ICON STYLE 2  ================================
 public function skyline_icons2( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
		'icon2_themify' => '',
		'icon_heading2' => '',
		'icon_heading_color2' => '',
		'icon_boxbg_color2' => '',
		'icon_border_color2' => '',
		'icon_border_style2' => '1',
		'icon_color2' => '',
		'icon_bg_color2' => '',
		'icon_link2' => '',
		'icon_link2_text' => '',
      ), $atts ) );
	  $content = wpb_js_remove_wpautop($content, true);
$icon_type = "{$icon_type}";	  
$icon2_themify = "{$icon2_themify}";
$icon_heading2 = "{$icon_heading2}";
$icon_heading_color2 = "{$icon_heading_color2}";
$icon_boxbg_color2 = "{$icon_boxbg_color2}";
$icon_border_color2 = "{$icon_border_color2}";
$icon_border_style2 = "{$icon_border_style2}";
$icon_color2 = "{$icon_color2}";
$icon_bg_color2 = "{$icon_bg_color2}";
$icon_link2 = "{$icon_link2}";
$icon_link2_text = "{$icon_link2_text}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$icon_code2 = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/icon-style2.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
  
//  ================================ START ICON STYLE 3  ================================
 public function skyline_icons3( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
		'icon3_themify' => '',
		'icon_color3' => '',
		'icon_bg_color3' => '',
		'icon_heading3' => '',
		'icon_heading_color3' => '',
		'icon_border_color3' => '',
		'icon_border_style3' => '1',
		'icon_link3' => '',
		'icon_link3_text' => '',
      ), $atts ) );
$content = wpb_js_remove_wpautop($content, true);
$icon_type = "{$icon_type}";	 
$icon3_themify = "{$icon3_themify}";
$icon_color3 = "{$icon_color3}";
$icon_heading3 = "{$icon_heading3}";
$icon_heading_color3 = "{$icon_heading_color3}";
$icon_bg_color3 = "{$icon_bg_color3}";
$icon_border_color3 = "{$icon_border_color3}";
$icon_border_style3 = "{$icon_border_style3}";
$icon_link3 = "{$icon_link3}";
$icon_link3_text = "{$icon_link3_text}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$icon_code3 = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/icon-style3.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
  
  //  ================================ START ICON STYLE 4  ================================
 public function skyline_icons4( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
		'icon4_themify' => '',
		'icon_color4' => '',
		'icon_heading4' => '',
		'icon_heading_color4' => '',
		'icon_bg4' => '',
		'icon_border4' => '',
		'icon_border_style4' => '1',
		'icon_link4' => '',
      ), $atts ) );
	  $content = wpb_js_remove_wpautop($content, true);
$icon_type = "{$icon_type}";	 
$icon4_themify = "{$icon4_themify}";
$icon_color4 = "{$icon_color4}";
$icon_heading4 = "{$icon_heading4}";
$icon_heading_color4 = "{$icon_heading_color4}";
$icon_bg4 = "{$icon_bg4}";
$icon_border4 = "{$icon_border4}";
$icon_border_style4 = "{$icon_border_style4}";
$icon_link4 = "{$icon_link4}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$icon_code4 = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/icon-style4.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
  
   //  ================================ START ICON STYLE 5  ================================
 public function skyline_icons5( $atts, $content = null ) {
      extract( shortcode_atts( array(
         'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
		'icon5_themify' => '',
		'icon_color5' => '',
		'icon_heading5' => '',
		'icon_heading_color5' => '',
		'icon_bg5' => '',
		'icon_border5' => '',
		'icon_border_style5' => '1',
		'icon_link5' => '',
      ), $atts ) );
	  $content = wpb_js_remove_wpautop($content, true);
$icon_type = "{$icon_type}";	 
$icon_color5 = "{$icon_color5}";
$icon5_themify = "{$icon5_themify}";
$icon_heading5 = "{$icon_heading5}";
$icon_heading_color5 = "{$icon_heading_color5}";
$icon_bg5 = "{$icon_bg5}";
$icon_border5 = "{$icon_border5}";
$icon_border_style5 = "{$icon_border_style5}";
$icon_link5 = "{$icon_link5}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$icon_code5 = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/icon-style5.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
	//  ================================ START TESTIMONIAL  ================================
 public function skyline_testimonial( $atts ) {
      extract( shortcode_atts( array(
        'testimonial_text' => '',
		'testimonial_author' => '',
		'testimonial_text2' => '',
		'testimonial_author2' => '',
		'testimonial_text3' => '',
		'testimonial_author3' => '',
		'testimonial_text_color' => '',
      ), $atts ) );
	  
$testimonial_text = "{$testimonial_text}";
$testimonial_author = "{$testimonial_author}";
$testimonial_text2= "{$testimonial_text2}";
$testimonial_author2 = "{$testimonial_author2}";
$testimonial_text3= "{$testimonial_text3}";
$testimonial_author3 = "{$testimonial_author3}";
$testimonial_text_color = "{$testimonial_text_color}";
ob_start();
include "skyline_templates/testimonials.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END TESTIMONIAL ================================
	
	//  ================================ START TESTIMONIAL STYLE 2  ================================
 public function skyline_testimonial2( $atts ) {
      extract( shortcode_atts( array(
        'testimonial_text' => '',
		'testimonial_author' => '',
		'testimonial_text_color' => '',
		'testimonial_border_color' => '',
        'testimonial_bg_color' => '',
		'testimonial_author_pic'  => '',
      ), $atts ) );
	  
$testimonial_text = "{$testimonial_text}";
$testimonial_author = "{$testimonial_author}";
$testimonial_text_color = "{$testimonial_text_color}";
$testimonial_border_color = "{$testimonial_border_color}";
$testimonial_bg_color = "{$testimonial_bg_color}";
$testimonial_author_pic = "{$testimonial_author_pic}";
$testimonial_author_url = wp_get_attachment_image_src( $testimonial_author_pic, 'thumb' );
ob_start();
include "skyline_templates/testimonials2.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END TESTIMONIAL ================================
//  ================================ START SHOP GRID OUTPUT  ================================
public function skyline_shop( $atts ) {
$output = $shop_number = $shop_grid_style = $shop_order = $shop_orderby = '';
      extract( shortcode_atts( array(
	'shop_grid_style' => 'grid2',
	'shop_number' => '',
	'shop_order' => 'rand',
	'shop_orderby' => 'asc',
      ), $atts ) );
$shop_number = "{$shop_number}";
$shop_grid_style = "{$shop_grid_style}";
$shop_order = "{$shop_order}";
$shop_orderby = "{$shop_orderby}";
// ===== Setting Shop Style =====
// Shop Grid 2 Column
if ($shop_grid_style == "grid2") {
ob_start();
include "skyline_templates/shop-grid-2-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
}
// Shop Grid 3 Column
else if ($shop_grid_style == "grid3") {
ob_start();
include "skyline_templates/shop-grid-3-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
// Shop Grid 4 Column
else if ($shop_grid_style == "grid4") {
ob_start();
include "skyline_templates/shop-grid-4-column.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
} 
}
   
    // ================================ END SHOP GRID OUTPUT ================================	
	//  ================================ START SHOP SINGLE ITEM OUTPUT  ================================
 public function skyline_shop_single( $atts ) {
      extract( shortcode_atts( array(
        'loop' => '',
      ), $atts ) );
ob_start();
include "skyline_templates/shop-single.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END SHOP SINGLE ITEM OUTPUT ================================
	//  ================================ START SHOP CAROUSEL OUTPUT  ================================
 public function skyline_shop_carousel( $atts ) {
      extract( shortcode_atts( array(
        'carousel_shop_order' => 'rand',
		'carousel_shop_orderby' => 'asc',
		'carousel_shop_toshow' => '',
		'carousel_shop_number' => '',
		'carousel_shop_timer' => '',
		'carousel_shop_controls' => '',
      ), $atts ) );
$carousel_shop_order = "{$carousel_shop_order}";
$carousel_shop_orderby = "{$carousel_shop_orderby}";
$carousel_shop_toshow = "{$carousel_shop_toshow}";
$carousel_shop_number = "{$carousel_shop_number}";
$carousel_shop_timer = "{$carousel_shop_timer}";
$carousel_shop_controls = "{$carousel_shop_controls}";
ob_start();
include "skyline_templates/shop-carousel.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
// ================================ END SHOP CAROUSEL OUTPUT ================================
 //  ================================ START ADD A BUTTON  ================================
 public function skyline_button( $atts ) {
      extract( shortcode_atts( array(
        'button_text' => '',
		'icon_type' => 'fontawesome',
		'icon_fontawesome' => '',
		'icon_openiconic' => '',
		'icon_typicons' => '',
		'icon_linecons' => '',
		'icon_entypo' => '',
		'button_link' => '',
		'button_new_window' => '',
		'button_size' => 'btn-sm',
		'button_custom_topbottom' => '',
		'button_custom_sides' => '',
		'button_custom_fontsize' => '',
		'button_color' => '',
		'button_style' => '',
		'button_block' => '',
		'css' => '',
		
      ), $atts ) );
$icon_type = "{$icon_type}";	  
$button_text = "{$button_text}";
$button_link = "{$button_link}";
$button_new_window = "{$button_new_window}";
$button_size = "{$button_size}";
$button_custom_topbottom = "{$button_custom_topbottom}";
$button_custom_sides = "{$button_custom_sides}";
$button_custom_fontsize = "{$button_custom_fontsize}";
$button_color = "{$button_color}";
$button_style = "{$button_style}";
$button_block = "{$button_block}";
$css = "{$css}";
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $icon_type );
$button_icon_code = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'fa fa-adjust';
ob_start();
include "skyline_templates/buttons.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END ADD A BUTTON ================================
	 //  ================================ START CALL TO ACTION  ================================
 public function skyline_cta( $atts ) {
      extract( shortcode_atts( array(
        'cta_heading' => '',
		'cta_heading_color' => '',
		'cta_content' => '',
		'cta_content_color' => '',
		'cta_bg_color' => '',
		'cta_bg_img' => '',
		'cta_border' => '0',
		'cta_border_color' => '',
		'cta_button_style' => '',
		'cta_button_url' => '',
		'cta_button_text' => '',
      ), $atts ) );
	  
$cta_heading = "{$cta_heading}";
$cta_heading_color = "{$cta_heading_color}";
$cta_content = "{$cta_content}";
$cta_content_color = "{$cta_content_color}";
$cta_bg_color = "{$cta_bg_color}";
$cta_border = "{$cta_border}";
$cta_border_color = "{$cta_border_color}";
$cta_button_style = "{$cta_button_style}";
$cta_button_url = "{$cta_button_url}";
$cta_button_text = "{$cta_button_text}";
$cta_bg_img = "{$cta_bg_img}";
$cta_bg_image_url = wp_get_attachment_image_src( $cta_bg_img, 'blog-posts' );
ob_start();
include "skyline_templates/cta.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END CALL TO ACTION ================================
	
	
		 //  ================================ START TIMELINE  ================================
 public function skyline_timeline( $atts ) {
      extract( shortcode_atts( array(
		'timeline_heading' => '',
		'timeline_content' => '',
		'timeline_heading2' => '',
		'timeline_content2' => '',
	
		'timeline_heading3' => '',
		'timeline_content3' => '',
	
		'timeline_heading4' => '',
		'timeline_content4' => '',
		'timeline_heading5' => '',
		'timeline_content5' => '',
		
		'timeline_heading6' => '',
		'timeline_content6' => '',
		
      ), $atts ) );
$timeline_heading = "{$timeline_heading}";
$timeline_content = "{$timeline_content}";
$timeline_heading2 = "{$timeline_heading2}";
$timeline_content2 = "{$timeline_content2}";
$timeline_heading3 = "{$timeline_heading3}";
$timeline_content3 = "{$timeline_content3}";
$timeline_heading4 = "{$timeline_heading4}";
$timeline_content4 = "{$timeline_content4}";
$timeline_heading5 = "{$timeline_heading5}";
$timeline_content5 = "{$timeline_content5}";
$timeline_heading6 = "{$timeline_heading6}";
$timeline_content6 = "{$timeline_content6}";
ob_start();
include "skyline_templates/timeline.php";
$output = ob_get_contents();
ob_end_clean();
return $output;
  } 
   
    // ================================ END TIMELINE ================================
    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    public function loadCssAndJs() {
	// wp_enqueue_style( 'skyline-visual-composer', get_template_directory_uri() . '/vc_setup/vc_style.css' );
      // If you need any javascript files on front end, here is how you can load them.
      //wp_enqueue_script( 'skyline_js', plugins_url('assets/skyline.js', __FILE__), array('jquery') );
    }
    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'skyline'), $plugin_data['Name']).'</p>
        </div>';
    }
}
/*
function vc_remove_frontend_links() {
    vc_disable_frontend(); // this will disable frontend editor
}
add_action( 'vc_after_init', 'vc_remove_frontend_links' ); */
// ================================ Finally initialize code ================================
new VCExtendAddonClass();
