<?php 
/**
* Created By: Prakash Malakar
* Date: 03/01/2017
* Time: 2:10 PM
*/


function d_create_metaboxes(){
	add_meta_box(
		'd_directory_options_mb',
		__( 'Directory Options', 'directory' ),
		'd_directory_options_mb',
		'directory',
		'normal',
		'high'
	);
}


