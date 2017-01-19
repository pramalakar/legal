<?php
/**
* Plugin Name: Directory
* Description:
* Version: 1.0
* Author: Prakash Malakar
* Author URL: www.malakars.com
*/

if( !function_exists( 'add_action' )){
	echo 'Not allowed!';
	exit();
}
// Setup
define( 'DIRECTORY_PLUGIN_URL', __FILE__ );




// Includes
include( 'include/activate.php' );
include( 'include/init.php' );
include( 'include/admin/init.php' );
include( 'process/save-post.php' );
include( 'process/filter-content.php' );

// Hooks
register_activation_hook( __FILE__, 'd_activate_plugin' );
add_action( 'init', 'directory_init' );
add_action( 'admin_init', 'directory_admin_init' );
add_action( 'save_post_directory', 'd_save_post_admin', 10, 3 );
add_filter( 'the_content', 'd_filter_directory_content' );

// Shortchodes