<?php
// ---- Hook Into Comments ---- //
function skyline_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
extract($args, EXTR_SKIP);
if ( 'div' == $args['style'] ) {
	$tag = 'div';
	$add_below = 'comment';
} else {
	$tag = 'li';
	$add_below = 'div-comment';
}
?>
<<?php echo esc_attr($tag); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
<?php if ( 'div' != $args['style'] ) : ?>
<div class="comment-wrapper">
<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
<?php endif; ?>
<div class="comment-author vcard">
<?php
echo get_avatar($comment); ?>
</div>
<?php if ( $comment->comment_approved == '0' ) : ?>
	<em class="comment-awaiting-moderation"><?php  esc_html__( 'Your comment is awaiting moderation.', 'skyline' ); ?></em>
	<br />
<?php endif; ?>
<div class="comment-meta commentmetadata">
<cite class="fn"><h5 style="margin-top: 0"><?php echo comment_author_link(); ?></h5></cite>
	</div>
	
<?php comment_text(); ?>
<div class="comment-meta commentmetadata text-right" style="font-weight: 500">
<?php
		/* translators: 1: date, 2: time */
		printf( esc_html__('%1$s at %2$s', 'skyline'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( esc_html__( '(Edit)', 'skyline' ), '  ', '' );
	?>
<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">&nbsp; | &nbsp;<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div>
<?php if ( 'div' != $args['style'] ) : ?>
</div></div>
<?php endif; ?>
<?php
}
// End Hook for Comments
?>