<?php 
/** Plugin Name: Directory

**/

function directory_init( ){
	$labels = array(
		'name'               => __( 'Directories', 'directory' ),
		'singular_name'      => __( 'Directory', 'directory' ),
		'menu_name'          => __( 'Directories', 'directory' ),
		'name_admin_bar'     => __( 'Directory', 'directory' ),
		'add_new'            => __( 'Add New', 'directory' ),
		'add_new_item'       => __( 'Add New Directory', 'directory' ),
		'new_item'           => __( 'New Directory', 'directory' ),
		'edit_item'          => __( 'Edit Directory', 'directory' ),
		'view_item'          => __( 'View Directory', 'directory' ),
		'all_items'          => __( 'All Directories', 'directory' ),
		'search_items'       => __( 'Search Directories', 'directory' ),
		'parent_item_colon'  => __( 'Parent Directories:', 'directory' ),
		'not_found'          => __( 'No Directories found.', 'directory' ),
		'not_found_in_trash' => __( 'No Directories found in Trash.', 'directory' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'A custom post type for directory.', 'directory' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'directory' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail'),
		'taxonomies'		 => array( 'category', 'post_tag' )
	);

	register_post_type( 'directory', $args);
}
