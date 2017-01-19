<?php 
/**
* Created By: Prakash Malakar
* Date: 03/01/2017
* Time: 2:10 PM
*/


function directory_admin_init(){
	include( 'create-metaboxes.php' );
	include( 'directory-options.php' );
	include( 'enqueue.php');

	add_action( 'add_meta_boxes_directory', 'd_create_metaboxes' );
	add_action( 'admin_enqueue_scripts', 'd_admin_enqueue');
}


