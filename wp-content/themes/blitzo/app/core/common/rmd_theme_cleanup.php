<?php    
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	This provide a minor security for those anonymous users.
 */

/**
 *	This will remove the version of wp from css and js links.
 */
function rmd_remove_wp_version_strings( $src ) {

	global $wp_version;
	parse_str( parse_url($src, PHP_URL_QUERY), $query );

	if( !empty($query['ver']) && $query['ver'] === $wp_version ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}

add_filter('script_loader_src', 'rmd_remove_wp_version_strings');
add_filter('style_loader_src', 'rmd_remove_wp_version_strings');


/**
 *	This will remove the meta tag generator of wp.
 */
function rmd_remove_meta_verion() {
	return '';
}
add_filter('the_generator', 'rmd_remove_meta_verion');