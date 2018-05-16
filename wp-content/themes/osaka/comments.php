<div id="comments">
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'osaka' ); ?></p>
</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php // You can start editing here -- including this comment! ?>

<?php if ( have_comments() ) : ?>
	<h3>
	<?php
		printf( _n( 'One comment on &ldquo;%2$s&rdquo;', '%1$s coments on &ldquo;%2$s&rdquo;', get_comments_number(), 'osaka' ),
			number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
	?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-above">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'osaka' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'osaka' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'osaka' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation ?>
	
	<div id="section-page-content-commentslist">
    	<ul>
    		<?php wp_list_comments( array( 'callback' => 'osaka_comment' ) ); ?>
    	</ul>
	</div>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-below">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'osaka' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'osaka' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'osaka' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation ?>

	<?php
	elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'osaka' ); ?></p>
<?php endif; ?>

<?php comment_form(array(
    'comment_notes_after'   => '',
    'logged_in_as'          => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url() ) . '</p>'
)); ?>

</div><!-- #comments -->
