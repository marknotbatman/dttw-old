<?php

add_action( 'after_setup_theme', 'ts_setup' );

if ( ! function_exists( 'ts_setup' ) ):

function ts_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'post-slider', 940, 383, true ); // Slider
		add_image_size( 'post-blog', 680, 328, true ); // Blog Image
		add_image_size( 'post-thumb-small', 71, 71, true ); // Recent Post Widget Image
		add_image_size( 'post-testimonial', 104, 104, true ); // Testimonial Image
		add_image_size( 'post-col3', 300, 204, true );
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'mainmenu' => __( 'Main Menu', 'templatesquare' )

	) );
}
endif;

/* Slider */
function ts_post_type_slider() {
	register_post_type( 'slider-view',
                array( 
				'label' => __('Slider', 'templatesquare'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'rewrite' => true,
				'hierarchical' => true,
				'menu_position' => 5,
				'exclude_from_search' =>true,
				'supports' => array(
				                     'title',
									 'custom-fields',
                                     'thumbnail')
					) 
				);
}

add_action('init', 'ts_post_type_slider');
?>
