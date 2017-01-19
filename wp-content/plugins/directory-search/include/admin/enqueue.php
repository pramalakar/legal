<?php 
/**
* Created By: Prakash Malakar
* Date: 03/01/2017
* Time: 2:10 PM
*/


function d_admin_enqueue(){
	global $typenow;

	if( $typenow !== "directory"){
		return;
	}

	wp_register_style( 'd_bootstrap', plugins_url( '/assets/styles/bootstrap.css', DIRECTORY_PLUGIN_URL ) );
	wp_enqueue_style( 'd_bootstrap' );
}