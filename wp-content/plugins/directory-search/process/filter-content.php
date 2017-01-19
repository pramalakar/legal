<?php 
/**
* Created By: Prakash Malakar
* Date: 03/01/2017
* Time: 2:10 PM
*/

function d_filter_directory_content( $content ){
	if(!is_singular( 'directory' ) ){
		return $content;
	}

	global $post;
	$directory_data			=	get_post_meta( $post->ID, 'directory_data', true );
	$directory_html			=	file_get_contents( 'directory-template.php', true );
	$directory_html			=	str_replace( 'BUSINESSNAME_PH', $directory_data['businessname'], $directory_html );
	$directory_html			=	str_replace( 'STATE_PH', $directory_data['state'], $directory_html );
	$directory_html			=	str_replace( 'CATEGORY_PH', $directory_data['category'], $directory_html );
	$directory_html			=	str_replace( 'PHONE_PH', $directory_data['phone'], $directory_html );
	$directory_html			=	str_replace( 'EMAIL_PH', $directory_data['email'], $directory_html );
	$directory_html			=	str_replace( 'WEBSITE_PH', $directory_data['website'], $directory_html );

	return $directory_html . $content;

}