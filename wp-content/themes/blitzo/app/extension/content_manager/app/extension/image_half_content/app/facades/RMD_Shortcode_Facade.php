<?php
namespace theme\rmd\extension\content_manager\app\extension\image_half_content\app\facades;

use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 
	protected $post_type = ''; 


	public function create_shortcode($post_type)
    {  
    	$this->post_type = $post_type; 
    	add_shortcode($this->post_type, array($this, '_create_shortcode'));
    } 


    public function _create_shortcode($atts = array(), $content = null)
    { 
        $attr = shortcode_atts( 
            array( 
                'title' => '', 
                'post_id' => '' 
            ), $atts ); 

        extract($attr);

        if(empty($post_id)) return '';

        $post_type = $this->post_type;   
        
        ob_start(); 
        include(dirname(__FILE__).'/templates/template.php'); 
        return ob_get_clean(); 
    } 

	
}
	
 