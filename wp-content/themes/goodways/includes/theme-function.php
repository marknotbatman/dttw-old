<?php

/*********For Localization**************/
load_theme_textdomain( 'templatesquare', get_template_directory().'/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
    require_once($locale_file);
/*********End For Localization**************/


// The excerpt based on character
if(!function_exists("ts_string_limit_char")){
	function ts_string_limit_char($excerpt, $substr=0, $strmore = "..."){
		$string = strip_tags(str_replace('...', '...', $excerpt));
		if ($substr>0) {
			$string = substr($string, 0, $substr);
		}
		if(strlen($excerpt)>=$substr){
			$string .= $strmore;
		}
		return $string;
	}
}
// The excerpt based on words
if(!function_exists("ts_string_limit_words")){
	function ts_string_limit_words($string, $word_limit){
	  $words = explode(' ', $string, ($word_limit + 1));
	  if(count($words) > $word_limit)
	  array_pop($words);
	  
	  return implode(' ', $words);
	}
}

if ( ! isset( $content_width ) )
	$content_width = 610;

add_action( 'after_setup_theme', 'ts_setup' );


/* Remove inline styles printed when the gallery shortcode is used.*/
function ts_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'ts_remove_gallery_css' );

/*Template for comments and pingbacks. */
if ( ! function_exists( 'ts_comment' ) ) :
function ts_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="con-comment">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 60, 60 ); ?>
		</div><!-- .comment-author .vcard -->


		<div class="comment-body">
			<?php  printf( __( '%s ', 'templatesquare' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            <span class="time">
               <?php
                /* translators: 1: date, 2: time */
                printf( __( '%1$s %2$s', 'templatesquare' ), get_comment_date(),  get_comment_time() ); ?>
                <?php edit_comment_link( __( '/&nbsp;Edit', 'templatesquare' ), ' ' );?> <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ,'reply_text' => '/&nbsp;Reply') ) ); ?>
            </span>
			<div class="commenttext">
			<?php comment_text(); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'templatesquare' ); ?></em>
			<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'templatesquare' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'templatesquare'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/* social icon */
if (!function_exists('ts_socialicon')){
	function ts_socialicon(){
		
		$socialfolder = get_template_directory_uri() . '/images/social/';

		$outputli = "";
		$twitterlink = of_get_option( TS_SHORTNAME . '_twitter_link', "" );
		if($twitterlink!=""){
			$twittericon = $socialfolder . "twitter.png" ;
			$outputli .= '<li><a href="'.$twitterlink.'"><span class="icon-img" style="background-image:url('.$twittericon.')"></span></a></li>'."\n";
		}
		
		$facebooklink = of_get_option( TS_SHORTNAME . '_facebook_link', "" );
		if($facebooklink!=""){
			$facebookicon = $socialfolder . "fb.png" ;
			$outputli .= '<li><a href="'.$facebooklink.'"><span class="icon-img" style="background-image:url('.$facebookicon.')"></span></a></li>'."\n";
		}
		
		$gpluslink = of_get_option( TS_SHORTNAME . '_googleplus_link', "" );
		if($gpluslink!=""){
			$gplusicon = $socialfolder . "googleplus.png" ;
			$outputli .= '<li><a href="'.$gpluslink.'"><span class="icon-img" style="background-image:url('.$gplusicon.')"></span></a></li>'."\n";
		}
		
		$pinterestlink = of_get_option( TS_SHORTNAME . '_pinterest_link', "" );
		if($pinterestlink!=""){
			$pinteresticon = $socialfolder . "pinterest.png" ;
			$outputli .= '<li><a href="'.$pinterestlink.'"><span class="icon-img" style="background-image:url('.$pinteresticon.')"></span></a></li>'."\n";
		}
		
		$socialcustom = of_get_option( TS_SHORTNAME . '_socialicon_custom', "" );
		if($socialcustom!=""){
			$outputli .= $socialcustom."\n";
		}
		
		$output = "";
		if($outputli!=""){
			$output .= '<ul class="sn">';
			$output .= $outputli;
			$output .= '</ul>';
		}
		return $output;
	}
}//end if(!function_exists('ts_get_socialicon'))

/*Prints HTML with meta information for the current post (category, tags and permalink).*/
if ( ! function_exists( 'ts_posted_in' ) ) :
function ts_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'Categories: %1$s <br/> Tags: %2$s', 'templatesquare' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'Categories: %1$s', 'templatesquare' );
	} else {
		$posted_in = __( '', 'templatesquare' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/* for top menu */
function nav_page_fallback() {
if(is_front_page()){$class="current_page_item";}else{$class="";}
print '<ul id="topnav" class="sf-menu"><li class="'.$class.'"><a href=" '.home_url( '/') .' " title=" '.__('Click for Home','templatesquare').' ">'.__('Home','templatesquare').'</a></li>';
    wp_list_pages( 'title_li=&sort_column=menu_order' );
print '</ul>';
}



/* Filter Custom Post Type Categories */
add_action( 'restrict_manage_posts', 'ts_add_taxonomy_filters' );
function ts_add_taxonomy_filters() {
	global $typenow;
	
	$taxonomy = 'pcategory';
	if( $typenow=='pdetail'){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>".__('View All','templatesquare')." "."$tax_name</option>";
			foreach ($terms as $term) { 
				$selectedstr = '';
				if(isset($_GET[$tax_slug]) && $_GET[$tax_slug] == $term->slug){
					$selectedstr = ' selected="selected"';
				}
				echo '<option value='. $term->slug. $selectedstr . '>' . $term->name .' (' . $term->count .')</option>'; 
			}
			echo "</select>";
		}
	}
}

//get id portfolio filterable
function ts_portfolio_getcategoryids($id){
	global $wpdb;
	$qryString = "
		SELECT	d.term_id FROM ".$wpdb->posts." a 
		INNER 	JOIN ".$wpdb->term_relationships." b ON a.ID = b.object_id 
		INNER 	JOIN ".$wpdb->term_taxonomy." c ON b.term_taxonomy_id = c.term_taxonomy_id
		INNER	JOIN ".$wpdb->terms."  d ON c.term_id = d.term_id
		WHERE 	a.post_type = 'pdetail'
	";
	if(strlen($id)>0){
		$qryString .= " AND	a.ID = '".$id."'";
	}
	$numposts = $wpdb->get_results($qryString, ARRAY_A);
	return $numposts;
}



/* for shortcode widget  */
add_filter('widget_text', 'do_shortcode');
?>