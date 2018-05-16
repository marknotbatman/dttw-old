<?php

/*-----------------------------------------------------------------------------------*/
/*	Theme Setup
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'organic_setup' ) ) :

function organic_setup() {

	require( get_template_directory() . '/includes/typefaces.php' );
	require( get_template_directory() . '/shortcodes/shortcodes.php' );
	require_once( get_template_directory() . '/includes/post-type-portfolio.php'); 	// Get Custom Post Type : Portfolio
	
	// Make theme available for translation
	load_theme_textdomain( 'organicthemes', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', 'organicthemes' ),
	) );
}
endif; // organic_setup
add_action( 'after_setup_theme', 'organic_setup' );

/*-----------------------------------------------------------------------------------*/
/*	Activate SlideDeck2 Lite
/*-----------------------------------------------------------------------------------*/

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

$theme_url = get_bloginfo('template_url');
$theme_url_split = explode("/", $theme_url);
$theme_url_split_length = count($theme_url_split);
$theme_name = $theme_url_split[$theme_url_split_length-1];

$plugin_source = "../wp-content/themes/".$theme_name."/includes/slidedeck2";
$plugin_target = "../wp-content/plugins/slidedeck2";

function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }

        $d->close();
        $plugin_path = 'slidedeck2/slidedeck2-lite.php';
        $active_plugins = get_option('active_plugins');
        if (!isset($active_plugins[$plugin_path])) run_activate_plugin( 'slidedeck2/slidedeck2-lite.php' );

    }
}

function run_activate_plugin( $plugin ) {
    $current = get_option( 'active_plugins' );
    $plugin = plugin_basename( trim( $plugin ) );

    if ( !in_array( $plugin, $current ) ) {
        $current[] = $plugin;
        sort( $current );
        do_action( 'activate_plugin', trim( $plugin ) );
        update_option( 'active_plugins', $current );
        do_action( 'activate_' . trim( $plugin ) );
        do_action( 'activated_plugin', trim( $plugin) );
    }

    return null;
}

full_copy($plugin_source, $plugin_target);

}

/*-----------------------------------------------------------------------------------------------------//	
	Category ID to Name		       	     	 
-------------------------------------------------------------------------------------------------------*/

function cat_id_to_name($id) {
	foreach((array)(get_categories()) as $category) {
    	if ($id == $category->cat_ID) { return $category->cat_name; break; }
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	404 Pagination Fix		       	     	 
-------------------------------------------------------------------------------------------------------*/

function my_post_queries( $query ) {
  // not an admin page and it is the main query
  if (!is_admin() && $query->is_main_query()){
    if(is_home() ){
      $query->set('posts_per_page', 1);
    }
  }
}
add_action( 'pre_get_posts', 'my_post_queries' );

/*-----------------------------------------------------------------------------------------------------//	
	Register Scripts		       	     	 
-------------------------------------------------------------------------------------------------------*/

if( !function_exists('ot_enqueue_scripts') ) {
function ot_enqueue_scripts() {

	// Enqueue Styles
	wp_enqueue_style( 'organic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'organic-style-mobile', get_template_directory_uri() . '/style-mobile.css', array( 'organic-style' ), '1.0' );
	wp_enqueue_style( 'organic-shortcodes', get_template_directory_uri() . '/shortcodes/organic-shortcodes.css', array( 'organic-style' ), '1.0' );
	wp_enqueue_style( 'organic-shortcodes-ie8', get_template_directory_uri() . '/shortcodes/organic-shortcodes-ie8.css', array( 'organic-shortcodes' ), '1.0' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array( 'organic-shortcodes' ), '1.0' );
	wp_enqueue_style( 'font-awesome-ie7', get_template_directory_uri() . '/css/font-awesome-ie7.css', array( 'font-awesome' ), '1.0' );
	wp_enqueue_style( 'organicons', get_template_directory_uri() . '/css/organicons.css', '1.0' );
	
	// IE Conditional Styles
	global $wp_styles;
	$wp_styles->add_data('organic-shortcodes-ie8', 'conditional', 'lt IE 9');
	$wp_styles->add_data('font-awesome-ie7', 'conditional', 'lt IE 8');
	
	// Enqueue jQuery First
	wp_enqueue_script('jquery');

	wp_register_script('custom', get_template_directory_uri() . '/js/jquery.custom.js');
	wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', true);
	wp_register_script('hover', get_template_directory_uri() . '/js/hoverIntent.js', 'jquery', '1.0', true);
	wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', 'jquery', '1.6.2', true);
	wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitVids.js', 'jquery', '', true);
	wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.js', 'jquery', '', true);
	wp_register_script('retina', get_template_directory_uri() . '/js/retina.js');
	wp_register_script('modal', get_template_directory_uri() . '/js/jquery.modal.min.js', 'jquery', '', true);

	//Enqueue Scripts
	wp_enqueue_script('custom');
	wp_enqueue_script('superfish');
	wp_enqueue_script('hover');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('isotope');
	wp_enqueue_script('retina');
	wp_enqueue_script('modal');
	wp_enqueue_script('lightbox');
	wp_enqueue_script('jquery-masonry');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-dialog');

	// Load Flexslider on front page and slideshow page template
	if( is_home() || is_front_page() || is_page_template('template-slideshow.php') || is_page_template('template-blog.php') || is_single() ) {
		wp_enqueue_script('flexslider');
	}

	// load single scripts only on single pages
    	if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 

	}
	add_action('wp_enqueue_scripts', 'ot_enqueue_scripts');
}

/*-----------------------------------------------------------------------------------------------------//	
	Options Framework		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = 'false') {
		
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		$option_name = $option_name = $optionsframework_settings['id'];
		
		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}
			
		if ( !empty($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}	
}

if ( !function_exists( 'optionsframework_add_page' ) && current_user_can('edit_theme_options') ) {
	function options_default() {
		add_theme_page(__("Theme Options", 'organicthemes'), __("Theme Options", 'organicthemes'), 'edit_theme_options', 'options-framework','optionsframework_page_notice');
	}
	add_action('admin_menu', 'options_default');
}

/**
 * Displays a notice on the theme options page if the Options Framework plugin is not installed
 */

if ( !function_exists( 'optionsframework_page_notice' ) ) {
	add_thickbox(); // Required for the plugin install dialog.

	function optionsframework_page_notice() { ?>
	
		<div class="wrap">
		<?php screen_icon( 'themes' ); ?>
		<h2><?php _e("Theme Options", 'organicthemes'); ?></h2>
        <p><b><?php _e("This theme requires the Options Framework plugin installed and activated to manage your theme options.", 'organicthemes'); ?> <a href="<?php echo admin_url('plugin-install.php?tab=plugin-information&plugin=options-framework&TB_iframe=true&width=640&height=517'); ?>" class="thickbox onclick"><?php _e("Install Now", 'organicthemes'); ?></a></b></p>
		</div>
		<?php
	}
}

/*-----------------------------------------------------------------------------------------------------//	
	WooCommerce Integration		       	     	 
-------------------------------------------------------------------------------------------------------*/

// Declare WooCommerce support
add_theme_support( 'woocommerce' );

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// WooCommerce content wrappers
function mytheme_prepare_woocommerce_wrappers(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    add_action( 'woocommerce_before_main_content', 'mytheme_open_woocommerce_content_wrappers', 10 );
    add_action( 'woocommerce_after_main_content', 'mytheme_close_woocommerce_content_wrappers', 10 );
}
add_action( 'wp_head', 'mytheme_prepare_woocommerce_wrappers' );

function mytheme_open_woocommerce_content_wrappers() {
	?>  
	<div class="row">
		<div class="twelve columns">
			<div class="postarea">
				<div class="article">
    <?php
}

function mytheme_close_woocommerce_content_wrappers() {
	?>
    			</div> <!-- /article -->
    		</div> <!-- /postarea -->
    	</div> <!-- /columns -->
        
 	</div> <!-- /row -->
    <?php
}

// WooCommerce default product columns
function loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'loop_columns');

// WooCommerce remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

/*-----------------------------------------------------------------------------------------------------//	
	Mobile Dropdown Menu		       	     	 
-------------------------------------------------------------------------------------------------------*/

class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu {
 
	 function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}
 
 
	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}
 
	 function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
 
		//check if current page is selected page and add selected value to select element  
		  $selc = '';
		  $curr_class = 'current-menu-item';
		  $is_current = strpos($class_names, $curr_class);
		  if($is_current === false){
	 		  $selc = "";
		  }else{
	 		  $selc = "selected ";
		  }
 
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		$sel_val =  ' value="'   . esc_attr( $item->url        ) .'"';
 
		//check if the menu is a submenu
		switch ($depth){
		  case 0:
			   $dp = "";
			   break;
		  case 1:
			   $dp = "-";
			   break;
		  case 2:
			   $dp = "--";
			   break;
		  case 3:
			   $dp = "---";
			   break;
		  case 4:
			   $dp = "----";
			   break;
		  default:
			   $dp = "";
		}
 
 
		$output .= $indent . '<option'. $sel_val . $id . $value . $class_names . $selc . '>'.$dp;
 
		$item_output = $args->before;
		//$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		//$item_output .= '</a>';
		$item_output .= $args->after;
 
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
 
	function end_el(&$output, $item, $depth) {
		$output .= "</option>\n";
	}
 
}

/*-----------------------------------------------------------------------------------------------------//	
	Register Sidebars		       	     	 
-------------------------------------------------------------------------------------------------------*/
	
if ( function_exists('register_sidebars') )
	register_sidebar(array(
		'name'=> __( "Home Sidebar", 'organicthemes' ),
		'id' => 'home-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h4 class="title">',
		'after_title'=>'</h4>'
	));
	register_sidebar(array(
		'name'=> __( "Left Sidebar", 'organicthemes' ),
		'id' => 'left-sidebar',
		'before_widget'=>'<div id="%1$s" class="widget %2$s">',
		'after_widget'=>'</div>',
		'before_title'=>'<h4 class="title">',
		'after_title'=>'</h4>'
	));


/*-----------------------------------------------------------------------------------------------------//	
	Comments Function		       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'organicthemes_comment' ) ) :
function organicthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'organicthemes' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 72;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 48;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <br/> %2$s <br/>', 'organicthemes' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s', 'organicthemes' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
				</div><!-- .comment-author .vcard -->
			</footer>

			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'organicthemes' ); ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text(); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'organicthemes' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( __( 'Edit', 'organicthemes' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}
endif; // ends check for organicthemes_comment()

/*-----------------------------------------------------------------------------------------------------//	
	Custom Search Widget		       	     	 
-------------------------------------------------------------------------------------------------------*/

function style_search_form($form) {
    $form = '<form method="get" id="searchform" action="' . get_option('home') . '/" >
            <label for="s">' . '' . '</label>
            <div>';
    if (is_search()) {
        $form .='<input type="text" value="' . attribute_escape(apply_filters('the_search_query', get_search_query())) . '" name="s" id="s" />';
    } else {
        $form .='<input type="text" value="Search Site" name="s" id="s"  onfocus="if(this.value==this.defaultValue)this.value=\'\';" onblur="if(this.value==\'\')this.value=this.defaultValue;"/>';
    }
    $form .= '<input type="submit" id="searchsubmit" value="'.attribute_escape(__('Go')).'" />
            </div>
            </form>';
    return $form;
}
add_filter('get_search_form', 'style_search_form');

/*----------------------------------------------------------------------------------------------------//
	Pagination Function
/*----------------------------------------------------------------------------------------------------*/

function get_pagination_links() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'prev_text' => _x( '«', 'Previous post link', 'photographer' ),
		'next_text' => _x( '»', 'Next post link', 'photographer' ),
		'total' => $wp_query->max_num_pages
	) );
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Page Links
/*-----------------------------------------------------------------------------------*/

function wp_link_pages_args_prevnext_add($args) {
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number') 
        return $args; 

    $args['next_or_number'] = 'number'; // Keep numbering for the main part
    if (!$more)
        return $args;

    if($page-1) // There is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>';

    if ($page<$numpages) // There is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after'];

    return $args;
}

add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');

/*-----------------------------------------------------------------------------------------------------//	
	Add post link meta box       	     	 
-------------------------------------------------------------------------------------------------------*/

add_action("admin_init", "admin_init");
add_action('save_post', 'save_titlelink');

function admin_init(){
	add_meta_box("prodInfo-meta", __("Post Title Link (For Link Format)", 'organicthemes'), "meta_options", "post", "side", "low");
}

function meta_options(){
	global $post;
	$custom = get_post_custom($post->ID);
	$titlelink = $custom["titlelink"][0];

	echo '<label>URL: </label><input type="text" style="width: 220px;" name="titlelink" value="'.$titlelink.'" />';
}

function save_titlelink($post_id){
	global $post;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	        return $post_id;
	    }
	update_post_meta($post->ID, "titlelink", $_POST["titlelink"]);
}

/*-----------------------------------------------------------------------------------------------------//	
	Filter post title for post format links	       	     	 
-------------------------------------------------------------------------------------------------------*/

function sd_link_filter($link, $post) {
     if (has_post_format('link', $post) && get_post_meta($post->ID, 'titlelink', true)) {
          $link = get_post_meta($post->ID, 'titlelink', true);
     }
     return $link;
}
add_filter('post_link', 'sd_link_filter', 10, 2);

/*-----------------------------------------------------------------------------------------------------//	
	Add post formats	       	     	 
-------------------------------------------------------------------------------------------------------*/

add_theme_support( 'post-formats', array( 
	'gallery',
	'link',
	'image',
	'quote',
	'video'	
	) 
);

/*-----------------------------------------------------------------------------------------------------//	
	Featured Video Meta Box		       	     	 
-------------------------------------------------------------------------------------------------------*/

$prefix = 'custom_meta_';

$meta_box = array(
    'id' => 'featured-video-meta',
    'title' => 'Featured Video',
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => __('Paste Video Embed Code', 'organicthemes'),
            'desc' => __('Enter Vimeo, YouTube or other embed code to display a featured video.', 'organicthemes'),
            'id' => $prefix . 'video',
            'type' => 'textarea',
            'std' => ''
        ),
    )
);

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
    global $meta_box;
    
    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />', $field['desc'];
                break;
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;
    
    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

/*-----------------------------------------------------------------------------------------------------//	
	Custom Excerpt Length		       	     	 
-------------------------------------------------------------------------------------------------------*/

function custom_excerpt_length( $length ) {
	return 28;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*-----------------------------------------------------------------------------------------------------//	
	WP 3.4+ Custom Header Support	       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('add_theme_support') )
$defaults = array(
	'default-image'          => get_template_directory_uri() . '/images/logo.png',
	'random-default'         => false,
	'width'                  => 520,
	'height'                 => 360,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '333333',
	'header-text'            => true,
	'uploads'                => true,
);
add_theme_support( 'custom-header', $defaults );

/*-----------------------------------------------------------------------------------------------------//	
	WP 3.4+ Custom Background Support	       	     	 
-------------------------------------------------------------------------------------------------------*/

if ( function_exists('add_theme_support') )
$defaults = array(
	'default-color'          => 'F9F9F9',
	'default-image'          => get_template_directory_uri() . '/images/background.png',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

/*-----------------------------------------------------------------------------------------------------//	
	Add Home Link To Custom Menu	       	     	 
-------------------------------------------------------------------------------------------------------*/

// Display home page link in custom menu
function home_page_menu_args( $args ) {
$args['show_home'] = true;
return $args;
}
add_filter('wp_page_menu_args', 'home_page_menu_args');

/*-----------------------------------------------------------------------------------------------------//	
	Featured Image (Post Thumbnail) Sizes		       	     	 
-------------------------------------------------------------------------------------------------------*/

add_image_size( 'slide', 1200, 800, true ); // Slideshow Featured Image
add_image_size( 'page-img', 840, 600, true ); // Post Featured Image
add_image_size( 'portfolio', 840, 840, true ); // Portfolio Featured Image

/*-----------------------------------------------------------------------------------------------------//
	Filters wp_title to print a neat <title> tag based on what is being viewed.
/*-----------------------------------------------------------------------------------------------------*/

function organic_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' ) ;

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'organicthemes' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'organic_wp_title', 10, 2 );