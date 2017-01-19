<?php
namespace theme\rmd\extension\banner\app\facades;

use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 
	protected $shortcode = ''; 


	public function create_banner_shortcode($shortcode)
    {  
    	$this->shortcode = $shortcode; 
    	add_shortcode($this->shortcode, array($this, '_create_banner_shortcode'));
    } 


    public function _create_banner_shortcode($atts = array(), $content = null)
    { 
        $attr = shortcode_atts( array(
            'image' => '',  
			'text_content' => '',
            'overlay_color' => '#000',
            'overlay_transparency' => '0'
            ), $atts ); 

        extract($attr);
 
        if(empty($image)) return;  
        
        ob_start(); 
        include(dirname(__FILE__).'/templates/template.php'); 
        return ob_get_clean(); 
    } 

	
}
	
 