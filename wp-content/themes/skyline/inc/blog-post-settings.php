<?php 
// Determine which post type page should be shown
function skyline_set_post_page(){
$skyline_data = skyline_redux_data();
$post_type = get_post_type();
$post_page = $skyline_data['post-layout'];
if ($post_type ==  'team_members') {
  get_template_part( 'templates/team-member' );
} elseif
 ($post_type ==  'post' && $post_page == "1") {
get_template_part( 'templates/post-traditional' ); 
}  elseif
 ($post_type ==  'post' && $post_page == "2") {
get_template_part( 'templates/post-fullwidth' ); 
} elseif
($post_type ==  'portfolio') {
  get_template_part( 'page' );
}  else {
get_template_part( 'templates/post-traditional' ); 
}
}

// Set the blogroll page
function skyline_set_blogroll(){
$skyline_data = skyline_redux_data();
$blogroll = $skyline_data['blog-layout'];

if ($blogroll ==  "1") {
  get_template_part( 'templates/blog-traditional' );
} 
elseif ($blogroll ==  "2") {
  get_template_part( 'templates/blog-masonry-2column' );
} 
elseif ($blogroll ==  "3") {
  get_template_part( 'templates/blog-masonry-3column' );
}
elseif ($blogroll ==  "4") {
  get_template_part( 'templates/blog-masonry-4column' );
} 
elseif ($blogroll ==  "5") {
  get_template_part( 'templates/blog-grid-2column' );
} 
elseif ($blogroll ==  "6") {
  get_template_part( 'templates/blog-grid-3column' );
} 
elseif ($blogroll ==  "7") {
  get_template_part( 'templates/blog-grid-4column' );
} 
elseif ($blogroll ==  "8") {
  get_template_part( 'templates/blog-horizontal' );
} 
else {
  get_template_part( 'templates/blog-traditional' );
} 
}
?>