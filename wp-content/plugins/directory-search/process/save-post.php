<?php 
/**
* Created By: Prakash Malakar
* Date: 03/01/2017
* Time: 2:10 PM
*/

function d_save_post_admin( $post_id, $post, $update ){
	if(!$update){
		return;
	}

	$directory_data					=	array();
	$directory_data['businessname']	=	sanitize_text_field( $_POST['d_inputBusinessName'] );
	$directory_data['state']		=	sanitize_text_field( $_POST['d_inputState'] );
	$directory_data['category']		=	sanitize_text_field( $_POST['d_inputCategory'] );
	$directory_data['phone']		=	sanitize_text_field( $_POST['d_inputPhone'] );
	$directory_data['email']		=	sanitize_text_field( $_POST['d_inputEmail'] );
	$directory_data['website']		=	sanitize_text_field( $_POST['d_inputWebsite'] );

	update_post_meta( $post_id, 'directory_data', $directory_data );
}