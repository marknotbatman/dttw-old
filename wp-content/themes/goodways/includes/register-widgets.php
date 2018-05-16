<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */


include_once (get_template_directory() . '/includes/widgets/ts-recent-comment.php');
include_once (get_template_directory() . '/includes/widgets/ts-recent-posts.php');

add_action("widgets_init", "load_ts_widgets");

function load_ts_widgets() {
	register_widget("TS_RecentCommentWidget");
	register_widget("TS_RecentPostWidget");
}
?>