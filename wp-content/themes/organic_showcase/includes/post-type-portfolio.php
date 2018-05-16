<?php
// Adding Custom Post Type : Portfolio
add_action('init', 'portfolio_register');
function portfolio_register() {
	$labels = array(
		'name'				=> _x('Portfolio','Portfolio','Portfolio'),
		'singular_name'		=> _x('Portfolio','Portfolio','Portfolio'),
		'add_new'			=> _x('Add New Project','Portfolio Listing','Portfolio'),
		'add_new_item'		=> __('Add New Project','Portfolio'),
		'edit_item'			=> __('Edit Portfolio','Portfolio'),
		'new_item'			=> __('New Portfolio Post Item','Portfolio'),
		'view_item'			=> __('View Portfolio Item','Portfolio'),
		'search_items'		=> __('Search Portfolio','Portfolio'),
		'not_found'			=> __('Nothing found','Portfolio'),
		'not_found_in_trash'=> __('Nothing found in Trash','Portfolio'),
		'parent_item_colon'	=> ''
	);
 
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'menu_position' 	=> 5,
		'exclude_from_search'=> true,
		'show_ui'			=> true,
		'capability_type'	=> 'post',
		'show_in_nav_menus' => false,
		'hierarchical'		=> false,
		'rewrite'			=> array( 'with_front' => false ),
		'query_var'			=> true,	  		
		'supports'			=> array('title', 'editor', 'author', 'excerpt', 'thumbnail', 'comments'),
		'has_archive' 		=> true,
	); 
	register_post_type( 'portfolio-item' , $args );
	
	// Initialize New Taxonomy Labels  
	  $labels = array(  
	    'name' 				=> _x( 'Filters', 'taxonomy general name' ),  
	    'singular_name' 	=> _x( 'Filter', 'taxonomy singular name' ),  
	    'search_items' 		=> __( 'Search Types' ),  
	    'all_items' 		=> __( 'All Filters' ),  
	    'parent_item' 		=> __( 'Parent Filter' ),  
	    'parent_item_colon' => __( 'Parent Filter:' ),  
	    'edit_item' 		=> __( 'Edit Filters' ),  
	    'update_item' 		=> __( 'Update Filter' ),  
	    'add_new_item' 		=> __( 'Add New Filter' ),  
	    'new_item_name' 	=> __( 'New Filter Name' ),  
	  );  
	    // Custom taxonomy for Project Tags  
	    register_taxonomy('tag-portfolio',array('portfolio-item'), array(  
	    'hierarchical' 		=> true,  
	    'labels' 			=> $labels,  
	    'show_ui' 			=> true,  
	    'query_var' 		=> true,  
	    'rewrite' 			=> array( 'slug' => 'tag-portfolio' ),  
	  ));  
}

// Default title text
function portfolio_title( $title ){
    $screen = get_current_screen();
    if ( 'portfolio' == $screen->post_type ) {
        $title = 'Portfolio Project Title';
    }
    return $title;
}
add_filter( 'enter_title_here', 'portfolio_title' );

// Adding Custom Meta Information
add_action('add_meta_boxes', 'portfolio_add_custom_box');
function portfolio_add_custom_box() {
    add_meta_box('portfolio_info', 'Portfolio Information', 'portfolio_box', 'portfolio-item', 'normal', 'high');
}

function portfolio_box() {
	$portfolio_link = '';
    if ( isset($_REQUEST['post']) ) {
        $portfolio_link = get_post_meta((int)$_REQUEST['post'],'portfolio_link',true); 
    }
    $portfolio_video = '';
    if ( isset($_REQUEST['post']) ) {
        $portfolio_video = get_post_meta((int)$_REQUEST['post'],'portfolio_video',true); 
    }
?>

<style>
	#portfolio_info div {
		margin-bottom: 10px;
		}
	#portfolio_info label {
		padding-bottom: 4px;
		}
</style>

<div id="portfolio_info">

<div>
<label for="portfolio_link"><?php _e("External Project URL", 'organicthemes'); ?></label>
<input id="portfolio_link" class="widefat" name="portfolio_link" value="<?php echo $portfolio_link; ?>" type="text">
</div>

<div>
<label for="portfolio_video"><?php _e("Featured Video (Enter Embed Code)", 'organicthemes'); ?></label>
<textarea id="portfolio_video" class="widefat" name="portfolio_video" rows="4" cols="1"><?php echo $portfolio_video; ?></textarea>
</div>

</div>

<?php
}
add_action('save_post','portfolio_save_meta');
function portfolio_save_meta($postID) {
    if ( is_admin() ) {
        if ( isset($_POST['portfolio_link']) ) {
            update_post_meta($postID,'portfolio_link',
                                $_POST['portfolio_link']);
        }
        if ( isset($_POST['portfolio_video']) ) {
            update_post_meta($postID,'portfolio_video',
                                $_POST['portfolio_video']);
        }

    }
}
?>