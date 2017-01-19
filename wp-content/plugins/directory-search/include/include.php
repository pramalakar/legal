<?php 
/**
* Created By: Prakash Malakar
* Date: 03/01/2017
* Time: 2:10 PM
*/

function d_activate_plugin(){
	if( version_compare(get_bloginfo('version'), '4.2', '<'))
		wp_die( __('You must update WordPress to use this plugin.', 'Directory'))
}