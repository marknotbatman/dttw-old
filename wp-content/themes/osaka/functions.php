<?php 

// options panel

get_template_part('nhp', 'options');
get_template_part('jw',  'custom_post');
get_template_part('tf',  'shortcodes');

// include vendors

include('vendors/json-api/json-api.php');
include('vendors/meta-box/meta-box.php');

// global vars

if ( ! isset( $content_width ) ) $content_width = 900;

// theme supprt

add_theme_support('automatic-feed-links');
register_nav_menu('top', __('Top Menu', 'osaka'));

// custom post type

add_action('init', 'mt_create_post_type' );

function mt_create_post_type()
{
    global $wp_taxonomies;
    
    register_taxonomy( 'collections', 'collections_items', 
        array(
            'hierarchical'  => true, 
            'label'         => __('Collections', 'osaka'), 
            'query_var'     => true, 
            'rewrite'       => false
        )
    );
    
    register_taxonomy( 'post', array() );
    
    register_post_type('collections_items',
        array(
            'labels' => array(
                'view_item'     => null,
                'name'          => __('Collections Items', 'osaka'),
                'singular_name' => __('Collection Item',  'osaka')
            ),
        'supports'      => array('title'),
        'public'        => true,
        'has_archive'   => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_position' => 30,
        'taxonomies'    => array('collections')
        )
    );
    
    register_post_type('galleries',
        array(
            'labels' => array(
                'view_item'     => null,
                'name'          => __('Galleries', 'osaka'),
                'singular_name' => __('Gallery',  'osaka')
            ),
        'supports'      => array('title'),
        'public'        => true,
        'has_archive'   => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_position' => 31
        )
    );
    
    register_post_type('musictracks',
        array(
            'labels' => array(
                'view_item'     => null,
                'name'          => __('Music Tracks', 'osaka'),
                'singular_name' => __('Music Track',  'osaka')
            ),
        'supports'      => array('title'),
        'public'        => true,
        'has_archive'   => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_position' => 32
        )
    );
}

// meta box

add_action('admin_init', 'mt_create_meta_boxes');

function mt_create_meta_boxes()
{
    
    global $meta_boxes;

    $meta_boxes = array();
    
    // posts meta box
    
    $meta_boxes[] = array(
        'id'            => 'post_setup',
        'title'         => __('Post Setup', 'osaka'),
        'pages'         => array('post'),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'              => __('Subtitle', 'osaka'),
                'id'                => 'tf_post_subtitle',
                'type'              => 'text'
            ),
            array(
                'name'              => __('Image', 'osaka'),
                'id'                => 'tf_post_image',
                'type'              => 'plupload_image',
                'max_file_uploads'  => 1
            ),
        )
    );
    
    // music meta box
    
    $meta_boxes[] = array(
        'id'            => 'muscitrack_box',
        'title'         => __('Music Tracks', 'osaka'),
        'pages'         => array('musictracks'),
        'context'       => 'normal',
        'priority'      => 'high',
        'fields'        => array(
            array(
                'name'              => __('Mp3 file path', 'osaka'),
                'id'                => 'tf_mp3_file_path',
                'type'              => 'text'
            ),
            array(
                'name'              => __('Ogg file path', 'osaka'),
                'id'                => 'tf_ogg_file_path',
                'type'              => 'text'
            )
        )
    );
    
    // pages meta boxes
    
    $collections            = get_terms('collections', array('hide_empty' => 0));
    $collections_options    = array('' => __('Select', 'osaka'));
    
    foreach($collections as $_collection)
    {
        $collections_options[$_collection->term_id] = $_collection->name;
    }
    
    $galleries              = new WP_Query(array('post_type' => 'galleries', 'nopaging' => true ));
    $galleries              = $galleries->get_posts();
    $galleries_options      = array('' => __('Select', 'osaka'));
    
    foreach($galleries as $_gallery)
    {
        $galleries_options[ $_gallery->ID ] = $_gallery->post_title;
    }
    
    $meta_boxes[] = array(
        'id'       => 'page_setup',
        'title'    => __('Page Setup', 'osaka'),
        'pages'    => array('page'),
        'context'  => 'normal',
        'priority' => 'high',
    
        'fields' => array(
            array(
                'name'      => __('page type', 'osaka'),
                'id'        => 'tf_type',
                'type'      => 'select',
                'options'   => array(
                    'page'          => 'page',
                    'collection'    => 'collection',
                    'blog'          => 'blog',
                    'video'         => 'video',
                    'gallery'       => 'gallery',
                    'contact'       => 'contact'
                ),
                'std'       => 'page'
            ),
            array(
                'name'      => __('subtitle', 'osaka'),
                'id'        => 'tf_subtitle',
                'type'      => 'text'
            ),
            array(
                'name'      => __('position', 'osaka'),
                'id'        => 'tf_page_position',
                'type'      => 'select',
                'options'   => array(
                    'left'      => 'left',
                    'center'    => 'center',
                    'right'     => 'right'
                ),
                'std'       => 'left'
            ),
            array(
                'name'      => __('width', 'osaka'),
                'id'        => 'tf_page_width',
                'type'      => 'select',
                'options'   => array(
                    '40'        => '40%',
                    '50'        => '50%',
                    '60'        => '60%',
                    '70'        => '70%',
                    '80'        => '80%',
                    '90'        => '90%',
                    '100'       => 'full'
                ),
                'std'       => '40'
            ),
            array(
                'name'              => __('page image', 'osaka'),
                'id'                => 'tf_page_image',
                'type'              => 'plupload_image',
                'max_file_uploads'  => 1
            ),
            array(
                'name'              => __('background image', 'osaka'),
                'id'                => 'tf_background_image',
                'type'              => 'plupload_image',
                'max_file_uploads'  => 1
            ),
            array(
                'name'              => __('collection category', 'osaka'),
                'id'                => 'tf_page_collection',
                'type'              => 'select',
                'options'           => $collections_options,
            ),
            array(
                'name'              => __('gallery', 'osaka'),
                'id'                => 'tf_page_gallery',
                'type'              => 'select',
                'options'           => $galleries_options
            ),
            array(
                'name'              => __('video type', 'osaka'),
                'id'                => 'tf_page_video_type',
                'type'              => 'select',
                'options'           => array('' => __('Select', 'osaka'), 'youtube' => 'Youtube', 'vimeo' => 'Vimeo' )
            ),
            array(
                'name'              => __('video id', 'osaka'),
                'id'                => 'tf_page_video_id',
                'type'              => 'text'
            )
        )
    );
    
    // collections items meta boxes
    
    $pages          = get_pages();
    $pages_options  = array( '' => __('Select', 'osaka') );
    
    foreach($pages as $_page)
    {
        $_key = '#/' . $_page->ID . '/' . $_page->post_name;
        $pages_options[$_key] = $_page->post_title;
    }
    
    $meta_boxes[] = array(
        'id'        => 'collection_item_setup',
        'title'     => __('Collection Item Setup', 'osaka'),
        'pages'     => array('collections_items'),
        'context'   => 'normal',
        'priority'  => 'high',
    
        'fields'    => array(
            array(
                'name'      => __('Type', 'osaka'),
                'id'        => 'tf_collection_item_type',
                'type'      => 'select',
                'options'   => array(
                    ''              => __('Select', 'osaka'),
                    'pageLink'      => __('Page link', 'osaka'),
                    'imagePageLink' => __('Image page link', 'osaka'),
                    'quote'         => __('Quote', 'osaka'),
                    'link'          => __('Link', 'osaka')
                )
            ),
            array(
                'name'      => __('Destination page', 'osaka'),
                'id'        => 'tf_collection_item_page',
                'type'      => 'select',
                'options'   => $pages_options
            ),
            /*
            array(
                'name'      => __('Title', 'osaka'),
                'id'        => 'tf_collection_item_title',
                'type'      => 'text'
            ),
            */
            array(
                'name'      => __('Link url', 'osaka'),
                'id'        => 'tf_collection_item_url',
                'type'      => 'text'
            ),
            array(
                'name'      => __('Quote', 'osaka'),
                'id'        => 'tf_collection_item_quote',
                'type'      => 'text'
            ),
            array(
                'name'      => __('Quote author', 'osaka'),
                'id'        => 'tf_collection_item_author',
                'type'      => 'text'
            ),
            array(
                'name'              => __('Image', 'osaka'),
                'id'                => 'tf_collection_item_image',
                'type'              => 'plupload_image',
                'max_file_uploads'  => 1
            ),
            array(
                'name'              => __('Collection', 'osaka'),
                'id'                => 'tf_collection_item_collection',
                'type'              => 'select',
                'options'           => $collections_options
            ),
        )
    );
    
    // galleries meta boxes
    
    $meta_boxes[] = array(
        'id'        => 'gallery_setup',
        'title'     => __('Gallery Setup', 'osaka'),
        'pages'     => array('galleries'),
        'context'   => 'normal',
        'priority'  => 'high',
        'fields'    => array(
            array(
                'name'              => __('Images', 'osaka'),
                'id'                => 'tf_gallery_images',
                'type'              => 'plupload_image'
            )
        )
    );
}

// remove collections categories from dashboard

add_action( 'admin_menu', 'mt_remove_meta_boxes' );

function mt_remove_meta_boxes()
{
    remove_meta_box( 'collectionsdiv', 'collections_items', 'side' );
}

// page meta box

add_action( 'admin_init', 'tf_register_meta_boxes' );

function tf_register_meta_boxes()
{
    global $meta_boxes;

    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( class_exists( 'RW_Meta_Box' ) )
    {
        foreach ( $meta_boxes as $meta_box )
        {
            new RW_Meta_Box( $meta_box );
        }
    }
}

// comments

function osaka_comment( $comment, $args, $depth ) 
{
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'osaka' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'osaka' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
			break;
		default :
        	?>
        	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        	<div class="comment-meta">
        	<?php
        	$avatar_size = 63;
        	if ( '0' != $comment->comment_parent )
        		$avatar_size = 39;
        
        	echo get_avatar( $comment, $avatar_size );
        
        	/* translators: 1: comment author, 2: date and time */
        	printf( __( '%1$s on %2$s <span class="says">said:</span>', 'osaka' ),
        		sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
        		sprintf( '<time pubdate datetime="%2$s">%3$s</time>',
        			esc_url( get_comment_link( $comment->comment_ID ) ),
        			get_comment_time( 'c' ),
        			/* translators: 1: date, 2: time */
        			sprintf( __( '%1$s at %2$s', 'osaka' ), get_comment_date(), get_comment_time() )
        		)
        	);
        	?>
        
        	<?php edit_comment_link( __( 'Edit', 'osaka' ), '<span class="edit-link">', '</span>' ); ?>
        
        	<?php if ( $comment->comment_approved == '0' ) : ?>
        		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'osaka' ); ?></em>
        		<br />
        	<?php endif; ?>
        	</div>
        	<?php 
        	comment_text(); 
        	break;
	endswitch;
}

// disable menu sections

function tf_remove_menu_items()
{
    global $menu;
    global $submenu;
    
    unset($menu[15]);                   // Removes 'Links'
    unset($submenu['themes.php'][7]);   // Removes 'Widgets'
}

add_action('admin_menu', 'tf_remove_menu_items');

// enqueue scripts

function tf_scripts()
{
    wp_register_script( 'modernizr',            get_template_directory_uri().'/assets/js/modernizr.js' );
    wp_register_script( 'underscore',           get_template_directory_uri().'/assets/js/underscore.min.js' );
    wp_register_script( 'backbone',             get_template_directory_uri().'/assets/js/backbone.min.js' );
    // wp_register_script( 'jquery-custom',        get_template_directory_uri().'/assets/js/jquery.1.7.2.min.js' );
    wp_register_script( 'jquery-transit',       get_template_directory_uri().'/assets/js/jquery.transit.js', array('jquery') );
    wp_register_script( 'jquery-plugins',       get_template_directory_uri().'/assets/js/jquery.plugins.js', array('jquery') );
    wp_register_script( 'jquery-isotope',       get_template_directory_uri().'/assets/js/jquery.isotope.min.js', array('jquery') );
    wp_register_script( 'jquery-mousewheel',    get_template_directory_uri().'/assets/js/jquery.mousewheel.js', array('jquery') );
    wp_register_script( 'jquery-jscrollpane',   get_template_directory_uri().'/assets/js/jquery.jscrollpane.min.js', array('jquery') );
    wp_register_script( 'app',                  get_template_directory_uri().'/assets/js/app.js', array('jquery', 'underscore', 'backbone', 'jquery-plugins', 'jquery-isotope', 'jquery-mousewheel', 'jquery-jscrollpane') );
    
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-transit' );
    wp_enqueue_script( 'underscore' );
    wp_enqueue_script( 'backbone' );
    wp_enqueue_script( 'jquery-plugins' );
    wp_enqueue_script( 'jquery-isotope' );
    wp_enqueue_script( 'jquery-mousewheel' );
    wp_enqueue_script( 'jquery-jscrollpane' );
    wp_enqueue_script( 'app' );
}

add_action( 'wp_enqueue_scripts', 'tf_scripts' );