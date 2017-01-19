<?php
namespace theme\rmd\extension\slider\app\facades;

use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 
	protected $post_type = '';
	protected $taxonomy = '';


	public function create_slider_shortcode($post_type, $taxonomy)
    {  
    	$this->post_type = $post_type;
    	$this->taxonomy = $taxonomy;

    	add_shortcode($this->post_type, array($this, '_create_slider_shortcode'));
    } 


    public function _create_slider_shortcode($atts = array(), $content = null)
    { 
        $attr = shortcode_atts( array(
            'transition_type' => 'carousel-slide',  
			'slider_category' => '',
	        'slider_type' => 'fixed',
	        'slider_bgcolor' => '#131313',
	        'slider_overlay_bgcolor' => '#000',
	        'slider_overlay_opacity' => '0',
	        'slider_navigation_status' => 'yes',
	        'slider_indicator_status' => 'yes', 
            ), $atts ); 

        extract($attr);

        if(empty($slider_category)) return; 

        $post_type = $this->post_type;
        $mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($post_type); 
        if($slider_category != 'all') {
            $mypost->where_tax_query($this->taxonomy, $slider_category);
        } 
        $results = $mypost->get(); 
        
        ob_start(); 
        include(dirname(__FILE__).'/templates/template.php'); 
        return ob_get_clean(); 
    } 

	
}
	
 