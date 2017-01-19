<?php    
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_String_Helper {

	public static function minify_string( $string ) 
	{ 
		return trim(preg_replace('/\s+/', ' ', $string));
	}

	public static function generate_random_hash()
	{
		// https://codex.wordpress.org/Function_Reference/wp_generate_password
		return wp_generate_password(32, false);
	}

}