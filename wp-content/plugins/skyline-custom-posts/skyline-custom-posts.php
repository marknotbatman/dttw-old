<?php
    /**
     * Skyline Custom Posts Plugin
     * A simple plugin which creates custom post types for the Skyline Theme.
	 * Post Types: Portfolio and Team Members
     * Plugin Name:     Skyline Custom Posts
     * Plugin URI:      http://www.creativelycoded.com
     * Description:     A simple plugin which creates custom post types for the Skyline Theme.
     * Author:          CreativelyCoded
     * Author URI:      http://www.creativelycoded.com
     * Version:         1.0.0
     * License:         GPL3+
     * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
     *
     */

  function create_post_type() {
  register_post_type( 'team_members',
    array(
      'labels' => array(
        'name' => 'Team Members',
        'singular_name' => 'Team Member',
		'edit_item' => 'Edit Team Member',
		'new_item' => 'Add New Team Member',
		'view_item' => 'View Team Member',
		'all_items' => 'Team Members',
		'search_items' => 'Search Team Members',
		'not_found' => 'No Team Member Found'
      ),
			'menu_icon' 		 => 'dashicons-businessman',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'rewrite' => array( 'slug' => 'team', 'with_front' => false ),
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'category'),
			'taxonomies' => array('post_tag','category'),
    )
  );
   register_post_type( 'portfolio',
    array(
      'labels' => array(
        'name' => 'Portfolio',
        'singular_name' => 'Portfolio',
		'edit_item' => 'Edit Portfolio Item',
		'new_item' => 'Add New Portfolio Item',
		'view_item' => 'View Portfolio Item',
		'all_items' => 'Portfolio Items',
		'search_items' => 'Search Portfolio Items',
		'not_found' => 'No Portfolio Item Found'
      ),
			'menu_icon' 		 => 'dashicons-format-gallery',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'rewrite' => array( 'slug' => 'portfolio', 'with_front' => false ),
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'category'),
			'taxonomies' => array('post_tag','category'),
    )
  );
}
add_action( 'init', 'create_post_type' );

function wpa_cpt_tags( $query ) {
    if ( $query->is_tag() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'portfolio' ) );
    }
}
add_action( 'pre_get_posts', 'wpa_cpt_tags' );