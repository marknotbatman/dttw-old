<?php

include_once (TEMPLATEPATH . '/inc/modules/wpalchemy/MetaBox.php');

add_action( 'init', 'my_metabox_styles' );

function my_metabox_styles()
{
    if ( is_admin() ) 
    { 
        wp_enqueue_style( 'wpalchemy-metabox', get_template_directory_uri() . '/inc/modules/wpalchemy/metaboxes/meta.css' );
    }
}
/* eof */