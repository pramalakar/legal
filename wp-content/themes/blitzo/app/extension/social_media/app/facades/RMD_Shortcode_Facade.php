<?php
namespace theme\rmd\extension\social_media\app\facades;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 

	public function create_social_media_shortcode($shortcode_social_media)
    {  
    	add_shortcode($shortcode_social_media, array($this, '_create_social_media_shortcode'));
    } 


    public function _create_social_media_shortcode($atts = array(), $content = null)
    {   
        $attr = shortcode_atts( array(), $atts ); 
        
        ob_start(); 
        include(dirname(__FILE__).'/templates/template.php'); 
        return ob_get_clean(); 
    } 

	
}
	
 