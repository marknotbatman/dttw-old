<?php
/**
 * The Sidebar containing the post widget areas.
 *
 * @package WordPress
 * @subpackage Goodways
 * @since Goodways 1.0
 */

global $post;
$custom = get_post_custom($post->ID);
$prefix = "ts_";
$defaultsidebar = "post-sidebar";
$postsidebar = (isset($custom[$prefix."sidebar"][0]) && !is_search())? $custom[$prefix."sidebar"][0] : $defaultsidebar;
?>
<div class="widget-area">
	<?php if ( ! dynamic_sidebar( $postsidebar ) ) : ?><?php endif; // end general widget area ?>
</div>