<?php   
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 *	Filter the search results based on a particular post type
 */
function rmd_search_filter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post'));
    }

	return $query;
} 
add_filter('pre_get_posts','rmd_search_filter');

