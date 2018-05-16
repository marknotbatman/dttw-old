<?php
// Social Icons Setup
function skyline_social_icons( $array = '' ){
if ( empty($array) ) {
	$skyline_data = skyline_redux_data();
	$array['social_email'] = esc_html($skyline_data['email-id']);
	$array['social_facebook'] = esc_html($skyline_data['facebook-id']);
	$array['social_twitter'] = esc_html($skyline_data['twitter-id']);
	$array['social_pinterest'] = esc_html($skyline_data['pinterest-id']);
	$array['social_linkedin'] = esc_html($skyline_data['linkedin-id']);
	$array['social_googleplus'] = esc_html($skyline_data['googleplus-id']);
	$array['social_instagram'] = esc_html($skyline_data['instagram-id']);
	$array['social_dribbble'] = esc_html($skyline_data['dribbble-id']);
	$array['social_vimeo'] = esc_html($skyline_data['vimeo-id']);
	$array['social_skype'] = esc_html($skyline_data['skype-id']);
	$array['social_flickr'] = esc_html($skyline_data['flickr-id']);
	$array['social_youtube'] = esc_html($skyline_data['youtube-id']);
	$array['social_github'] = esc_html($skyline_data['github-id']);
}
if ( $array['social_email'] ) { echo '<a href="mailto:'.esc_html($array['social_email']).'"><i class="fa-envelope-o"></i></a>'; }
if ( $array['social_facebook'] ) { echo '<a href="'.esc_url($array['social_facebook']).'"><i class="fa-facebook"></i></a>'; }
if ( $array['social_twitter'] ) { echo '<a href="'.esc_url($array['social_twitter']).'"><i class="fa-twitter"></i></a>'; }
if ( $array['social_pinterest'] ) { echo '<a href="'.esc_url($array['social_pinterest']).'"><i class="fa-pinterest"></i></a>'; }
if ( $array['social_linkedin'] ) { echo '<a href="'.esc_url($array['social_linkedin']).'"><i class="fa-linkedin"></i></a>'; }
if ( $array['social_googleplus'] ) { echo '<a href="'.esc_url($array['social_googleplus']).'"><i class="fa-google-plus"></i></a>'; }
if ( $array['social_instagram'] ) { echo '<a href="'.esc_url($array['social_instagram']).'"><i class="fa-instagram"></i></a>'; }
if ( $array['social_dribbble'] ) { echo '<a href="'.esc_url($array['social_dribbble']).'"><i class="fa-dribbble"></i></a>'; }
if ( $array['social_vimeo'] ) { echo '<a href="'.esc_url($array['social_vimeo']).'"><i class="fa-vimeo-square"></i></a>'; }
if ( $array['social_skype'] ) { echo '<a href="'.esc_url($array['social_skype']).'"><i class="fa-skype"></i></a>'; }
if ( $array['social_flickr'] ) { echo '<a href="'.esc_url($array['social_flickr']).'"><i class="fa-flickr"></i></a>'; }
if ( $array['social_youtube'] ) { echo '<a href="'.esc_url($array['social_youtube']).'"><i class="fa-youtube"></i></a>'; }
if ( $array['social_github'] ) { echo '<a href="'.esc_url($array['social_github']).'"><i class="fa-github"></i></a>'; }
}
// Team Member Social Icons Setup
function skyline_team_social_icons(){
$skyline_team = get_post_meta( get_the_ID(), 'skyline_team', true ); 
if ( $skyline_team['facebook'] ) { echo '<a href="'.esc_url($skyline_team['facebook']).'" target="_blank"><i class="fa-facebook"></i></a>'; }
if ( $skyline_team['twitter'] ) { echo '<a href="'.esc_url($skyline_team['twitter']).'" target="_blank"><i class="fa-twitter"></i></a>'; }
if ( $skyline_team['pinterest'] ) { echo '<a href="'.esc_url($skyline_team['pinterest']).'" target="_blank"><i class="fa-pinterest"></i></a>'; }
if ( $skyline_team['linkedin'] ) { echo '<a href="'.esc_url($skyline_team['linkedin']).'" target="_blank"><i class="fa-linkedin"></i></a>'; }
if ( $skyline_team['googleplus'] ) { echo '<a href="'.esc_url($skyline_team['googleplus']).'" target="_blank"><i class="fa-google-plus"></i></a>'; }
if ( $skyline_team['instagram'] ) { echo '<a href="'.esc_url($skyline_team['instagram']).'" target="_blank"><i class="fa-instagram"></i></a>'; }
if ( $skyline_team['dribbble'] ) { echo '<a href="'.esc_url($skyline_team['dribbble']).'" target="_blank"><i class="fa-dribbble"></i></a>'; }
if ( $skyline_team['vimeo'] ) { echo '<a href="'.esc_url($skyline_team['vimeo']).'" target="_blank"><i class="fa-vimeo-square"></i></a>'; }
if ( $skyline_team['skype'] ) { echo '<a href="'.esc_url($skyline_team['skype']).'" target="_blank"><i class="fa-skype"></i></a>'; }
if ( $skyline_team['flickr'] ) { echo '<a href="'.esc_url($skyline_team['flickr']).'" target="_blank"><i class="fa-flickr"></i></a>'; }
if ( $skyline_team['youtube'] ) { echo '<a href="'.esc_url($skyline_team['youtube']).'" target="_blank"><i class="fa-youtube"></i></a>'; }
if ( $skyline_team['github'] ) { echo '<a href="'.esc_url($skyline_team['github']).'" target="_blank"><i class="fa-github"></i></a>'; }
}
// Social Share Icons Setup
function skyline_share_icons(){
$permalink = esc_url( get_permalink() );
$title = get_the_title();
$title = urlencode($title);
$id = get_the_ID();
$url = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'blog-posts' );
 echo "<div class=\"row\"><div class=\"col-md-12\"><div class=\"share-post social-icons text-center\"><h5>";
 printf(esc_html__('Share the Post','skyline'));
 $facebook_share = esc_url('https://www.facebook.com/sharer/sharer.php?u=');
 $twitter_share = esc_url('https://twitter.com/share?text=');
 $google_share = esc_url('https://plus.google.com/share?url=');
 $pinterest_share = esc_url('https://pinterest.com/pin/create/button/?url=');
 $linkedin_share = esc_url('http://www.linkedin.com/shareArticle?mini=true&amp;url=');
 echo "</h5>
 <a href=\"mailto:?subject=".$permalink."\"><i class=\"fa-envelope-o\"></i></a><a href=\"".$facebook_share."".$permalink."\" onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;\"><i class=\"fa-facebook\"></i></a><a href=\"".$twitter_share."".$title."&amp;url=".$permalink."\" onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;\"><i class=\"fa-twitter\"></i></a><a href=\"".$google_share."".$permalink."\" onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\"><i class=\"fa-google-plus\"></i></a><a href=\"".$pinterest_share."".$permalink."&amp;media=".$url[0]."&amp;description=".$title."\" onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;\"><i class=\"fa-pinterest\"></i></a><a href=\"".$linkedin_share."".$permalink."&amp;title=".$title."\" onclick=\"javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\"><i class=\"fa-linkedin\"></i></a>
 </div></div></div>";
		
}
?>