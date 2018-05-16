<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function skyline_widgets_init() {
register_sidebar( array(
	'name'          => esc_html__( 'Sidebar', 'skyline' ),
	'id'            => 'sidebar-1',
	'description'   => esc_html__('Regular Sidebar','skyline'),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h4 class="widget-title">',
	'after_title'   => '</h4>',
) );
// Footer Widgets
register_sidebar( array(
'name'          => esc_html__( 'Footer Column 1', 'skyline' ),
'id' => 'footer-column-1',
'description' => esc_html__('Appears in the footer area','skyline'),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h4 class="widget-title">',
'after_title' => '</h4>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Footer Column 2', 'skyline' ),
'id' => 'footer-column-2',
'description' => esc_html__('Appears in the footer area','skyline'),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h4 class="widget-title">',
'after_title' => '</h4>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Footer Column 3', 'skyline' ),
'id' => 'footer-column-3',
'description' => esc_html__('Appears in the footer area','skyline'),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h4 class="widget-title">',
'after_title' => '</h4>',
) );
register_sidebar( array(
'name'          => esc_html__( 'Footer Column 4', 'skyline' ),
'id' => 'footer-column-4',
'description' => esc_html__('Appears in the footer area','skyline'),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h4 class="widget-title">',
'after_title' => '</h4>',
) );
}
add_action( 'widgets_init', 'skyline_widgets_init' );
//Filter for archive limit - sidebar
function skyline_limit_archives( $args ) {
    $args['limit'] = 10;
    return $args;
}
add_filter( 'widget_archives_args', 'skyline_limit_archives' );
add_filter( 'widget_archives_dropdown_args', 'skyline_limit_archives' );
//Filter for category limit - sidebar
function skyline_limit_categories( $args ) {
    $args['limit'] = 10;
    return $args;
}
add_filter( 'widget_category_args', 'skyline_limit_categories' );
add_filter( 'widget_category_dropdown_args', 'skyline_limit_categories' );
?>