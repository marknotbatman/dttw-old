<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	require_once get_template_directory() . '/admin/options-framework.php';
}

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	$shortname = TS_SHORTNAME;
	
	$optLogotype 	= array(
		'imagelogo' 	=> __('Image logo','templatesquare'),
		'textlogo' 		=> __('Text-based logo','templatesquare')
		 );
	
	$optArrSlider 	= array(
		'ASC' => 'Ascending',
		'DESC' => 'Descending'
		 );
	
	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll'
	);
	             
	$optBackgroundStyle = array(
		'repeat' => "Repeat",
		'repeat-x' => "Repeat Horizontal",
		'repeat-y' => "Repeat Vertical",
		'no-repeat' => "No Repeat",
		'fixed' => "Fixed"
		);
		
	$optBackgroundPosition = array(
		'left' => "Left",
		'center' => "Center",
		'right' => "Right",
		'top left' => "Top",
		'top center' => "Top Center",
		'top right' => "Top Right",
		'bottom left' => "Bottom",
		'bottom center' => "Bottom Center",
		'bottom right' => "Bottom Right"
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	$options_categories["allcategories"] =__('All Categories','templatesquare');
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the categories portfolio into an array
	$options_pfcategories = array();
	$options_pfcategories_obj = get_categories(array('taxonomy'=> 'pcategory'));
	foreach ($options_pfcategories_obj as $category) {
		$options_pfcategories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array( 'name' => __('General', 'templatesquare'),
		'type' => 'heading');
	
	$options[] = array( 'name' => __('Layout Settings', 'templatesquare'),
		'type' => 'headingchild');
	
	$options[] = array( 'name' => __('Sidebar Position', 'templatesquare'),
		'desc' => __('Select sidebar position. Default sidebar is right.', 'templatesquare'),
		'id' => $shortname."_sidebar_position",
		'std' => 'right',
		'type' => 'images',
		'options' => array(
			'left' => $imagepath . '2cl.png',
			'right' => $imagepath . '2cr.png')
	);
	
	$options[] = array( 'name' => __(' ', 'templatesquare'),
		'type' => 'separator');
	
	$options[] = array( 'name' => __('Header Settings', 'templatesquare'),
		'type' => 'headingchild');
	
	$options[] = array( 'name' => __('Logo Type', 'templatesquare'),
		'desc' => __('If text-based logo is activated, enter the sitename and tagline in the fields below.', 'templatesquare'),
		'id' => $shortname."_logo_type",
		'std' => 'imagelogo',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $optLogotype);
	
	$options[] = array( 'name' => __('Site name', 'templatesquare'),
		'desc' => __('Put your sitename in here.', 'templatesquare'),
		'id' => $shortname."_site_name",
		'std' => '',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Tagline', 'templatesquare'),
		'desc' => __('Put your tagline in here.', 'templatesquare'),
		'id' => $shortname."_tagline",
		'std' => '',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Logo Image', 'templatesquare'),
		'desc' => __('If image logo is activated, upload the logo image.', 'templatesquare'),
		'id' => $shortname."_logo_image",
		'type' => 'upload');
	
	$options[] = array( 'name' => __('Favicon', 'templatesquare'),
		'desc' => __('Upload the favicon image.', 'templatesquare'),
		'id' => $shortname."_favicon",
		'type' => 'upload');
	
	$options[] = array( 'name' => __('Footer Settings', 'templatesquare'),
		'type' => 'headingchild');
	
	$options[] = array( 'name' => __('Footer Text', 'templatesquare'),
		'desc' => __('You can use html tag in here.', 'templatesquare'),
		'id' => $shortname."_footer",
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array( 'name' => __('Tracking Code', 'templatesquare'),
		'desc' => __('Enter your tracking code here.', 'templatesquare'),
		'id' => $shortname."_google",
		'std' => '',
		'type' => 'textarea');
		
		
	$options[] = array( 'name' => __('Style', 'templatesquare'),
		'type' => 'heading');
		
		
	$options[] = array( 'name' => __('Link', 'templatesquare'),
		'desc' => __('Change the link color.', 'templatesquare'),
		'id' => $shortname."_linkcolor",
		'std' => '',
		'type' => 'color');
		
	$options[] = array( 'name' => __('Link Hover', 'templatesquare'),
		'desc' => __('Change the link hover color.', 'templatesquare'),
		'id' => $shortname."_linkhovercolor",
		'std' => '',
		'type' => 'color');
		
		
	$options[] = array( 'name' => __('Page Title', 'templatesquare'),
		'desc' => __('Change the page title color.', 'templatesquare'),
		'id' => $shortname."_pagetitlecolor",
		'std' => '',
		'type' => 'color');
		
	$options[] = array( 'name' => __('Page Description', 'templatesquare'),
		'desc' => __('Change the page description color.', 'templatesquare'),
		'id' => $shortname."_pagedesccolor",
		'std' => '',
		'type' => 'color');
		
		
		
	$options[] = array( 'name' => __('Footer Heading', 'templatesquare'),
		'desc' => __('Change the footer widget title color.', 'templatesquare'),
		'id' => $shortname."_footerheadingcolor",
		'std' => '',
		'type' => 'color');
		
		
	$options[] = array( 'name' => __('Footer Heading Border', 'templatesquare'),
		'desc' => __('Change the footer widget title border color.', 'templatesquare'),
		'id' => $shortname."_footerheadingbordercolor",
		'std' => '',
		'type' => 'color');
		
		
	$options[] = array( 'name' => __('Footer Text', 'templatesquare'),
		'desc' => __('Change the footer link and text color.', 'templatesquare'),
		'id' => $shortname."_footertextcolor",
		'std' => '',
		'type' => 'color');
		
	$options[] = array( 'name' => __('Footer Link', 'templatesquare'),
		'desc' => __('Change the footer link color.', 'templatesquare'),
		'id' => $shortname."_footerlinkcolor",
		'std' => '',
		'type' => 'color');
		
	$options[] = array( 'name' => __('Footer Link Hover', 'templatesquare'),
		'desc' => __('Change the footer link hover color.', 'templatesquare'),
		'id' => $shortname."_footerlinkhovercolor",
		'std' => '',
		'type' => 'color');
		
		
		
	$options[] = array( 'name' => __('Background', 'templatesquare'),
		'type' => 'headingchild');
		
	$options[] = array( 'name' =>  __('Header Background', 'templatesquare'),
		'desc' => __('Change the background CSS.', 'templatesquare'),
		'id' => $shortname."_header_background",
		'std' => $background_defaults,
		'type' => 'background');
		
	$options[] = array( 'name' =>  __('Footer Background', 'templatesquare'),
		'desc' => __('Change the background CSS.', 'templatesquare'),
		'id' => $shortname."_footer_background",
		'std' => $background_defaults,
		'type' => 'background');

	
	$options[] = array( 'name' => __('Social', 'templatesquare'),
		'type' => 'heading');
		
	
	$options[] = array( 'name' => __('Social Icon', 'templatesquare'),
		'type' => 'headingchild');
	
	$options[] = array( 'name' => __('Twitter URL', 'templatesquare'),
		'desc' => __('Please input your twitter URL. Example : http://www.twitter.com/your-username', 'templatesquare'),
		'id' => $shortname."_twitter_link",
		'std' => 'http://www.twitter.com/your-username',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Facebook URL', 'templatesquare'),
		'desc' => __('Please input your facebook URL. Example : http://www.facebook.com/your-username', 'templatesquare'),
		'id' => $shortname."_facebook_link",
		'std' => 'http://www.facebook.com/your-username',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Google+ URL', 'templatesquare'),
		'desc' => __('Please input your google+ URL. Example : https://plus.google.com/u/0/110149804655622272330/posts', 'templatesquare'),
		'id' => $shortname."_googleplus_link",
		'std' => 'https://plus.google.com/u/0/110149804655622272330/posts',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Pinterest URL', 'templatesquare'),
		'desc' => __('Please input your pinterest URL. Example : http://pinterest.com/your-username', 'templatesquare'),
		'id' => $shortname."_pinterest_link",
		'std' => 'http://pinterest.com/your-username',
		'type' => 'text');
	
	$options[] = array( 'name' => __('Social Icon Custom HTML', 'templatesquare'),
		'desc' => __('If you want to put another Social Network URL, please input the HTML code in here. <br />For Example : &lt;li&gt;&lt;a href=&quot;http://yoururl.com/&quot;&gt;&lt;span class=&quot;icon-img&quot; style=&quot;background-image:url(http://your-icon-url.com/img.gif)&quot;&gt;&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;', 'templatesquare'),
		'id' => $shortname."_socialicon_custom",
		'std' => '',
		'type' => 'textarea');
		
	$options[] = array( 'name' => __('Slider', 'templatesquare'),
		'type' => 'heading');
		
		
	$options[] = array( 'name' => __('Disable Slider', 'templatesquare'),
		'desc' => __('Select this checkbox to disable slider.', 'templatesquare'),
		'id' => $shortname."_disable_slider",
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array( 'name' => __('Arrange Slider Post', 'templatesquare'),
		'desc' => __('Select the order for your slider. the default is Ascending', 'templatesquare'),
		'id' => $shortname."_slider_arrange",
		'std' => 'ASC',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $optArrSlider);
	
	
	$options[] = array( 'name' => __('Slider Interval', 'templatesquare'),
		'desc' => __('Please enter number for slider interval. Default is 600', 'templatesquare'),
		'id' => $shortname."_slider_interval",
		'std' => '600',
		'class' => 'mini',
		'type' => 'text');
		
	
	$options[] = array( 'name' => __('Disable Slider Text', 'templatesquare'),
		'desc' => __('Select this checkbox to disable the slider text.', 'templatesquare'),
		'id' => $shortname."_slider_disable_text",
		'std' => '0',
		'type' => 'checkbox');
		
	
	$options[] = array( 'name' => __('Disable Slider Navigation', 'templatesquare'),
		'desc' => __('Select this checkbox to disable navigation.', 'templatesquare'),
		'id' => $shortname."_slider_disable_nav",
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array( 'name' => __('Enable Slider Previous/Next Navigation', 'templatesquare'),
		'desc' => __('Select this checkbox to enable previous/next navigation.', 'templatesquare'),
		'id' => $shortname."_slider_enable_prevnext",
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array( 'name' => __('Blog', 'templatesquare'),
		'type' => 'heading');
		
	$options[] = array( 'name' => __('Blog Category', 'templatesquare'),
		'desc' => __('The value is category for display in blog page.', 'templatesquare'),
		'id' => $shortname."_blog_category",
		'std' => 'blog',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $options_categories);
		
	$options[] = array( 'name' => __('Single Blog Title', 'templatesquare'),
		'desc' => __('Put your title for single blog page.', 'templatesquare'),
		'id' => $shortname."_single_title",
		'std' => 'Blog',
		'type' => 'text');
		
		
	$options[] = array( 'name' => __('Portfolio', 'templatesquare'),
		'type' => 'heading');
		
	$options[] = array( 'name' => __('Portfolio Category', 'templatesquare'),
		'desc' => __('The value is category for display in portfolio page.', 'templatesquare'),
		'id' => $shortname."_pf_category",
		'std' => '0',
		'type' => 'multicheck',
		'options' => $options_pfcategories);
		
		
	$options[] = array( 'name' => __('Disable Title', 'templatesquare'),
		'desc' => __('Select this checkbox to disable title.', 'templatesquare'),
		'id' => $shortname."_pf_disable_title",
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array( 'name' => __('Enable Short Description', 'templatesquare'),
		'desc' => __('Select this checkbox to enable short description.', 'templatesquare'),
		'id' => $shortname."_pf_enable_desc",
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array( 'name' => __('Length Character', 'templatesquare'),
		'desc' => __('Length description character', 'templatesquare'),
		'id' => $shortname."_pf_lengthchar",
		'std' => '120',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array( 'name' => __('Misc', 'templatesquare'),
		'type' => 'heading');
		
	$options[] = array( 'name' => __('Slogan Title', 'templatesquare'),
		'desc' => __('Enter your slogan title to show in homepage.', 'templatesquare'),
		'id' => $shortname."_slogan_title",
		'std' => 'Build Your Own',
		'type' => 'textarea');
		
	$options[] = array( 'name' => __('Slogan Text', 'templatesquare'),
		'desc' => __('Enter your slogan text to show in homepage.', 'templatesquare'),
		'id' => $shortname."_slogan_text",
		'std' => 'Proin rutrum nisi eu ante mattis sit amet luctus nisl tempus. Aenean eget lacinia nisl.',
		'type' => 'textarea');

	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}