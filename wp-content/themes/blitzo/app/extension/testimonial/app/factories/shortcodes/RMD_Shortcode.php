<?php
namespace theme\rmd\extension\testimonial\app\factories\shortcodes;

use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

abstract class RMD_Shortcode
{	 
	protected $config = array();
    protected $template = '';
    protected $shortcode_attr = array();
    protected $shortcode_name = '';
    protected $post_type = ''; 


    public function __construct(array $config = array())
    {
        extract($config); 
        if(isset($post_type)) $this->post_type = $post_type;   
    } 


    protected function set_shortcode_name($shortcode_name)
    {
        $this->shortcode_name = $shortcode_name;
    }


    protected function set_template($template) 
    {
        $this->template = $template;
    }

    protected function set_shortcode_attr(array $shortcode_attr = array()) 
    {
        $this->shortcode_attr = array_merge($this->shortcode_attr, $shortcode_attr);
    }

     
    protected function create_shortcode()
    { 
        if(empty($this->shortcode_name)) return;

        if(empty($this->template)) return;

        if(empty($this->post_type)) return; 

        add_shortcode($this->shortcode_name, array($this, '_create_shortcode')); 
    }
	

	public function _create_shortcode($atts = array(), $content = null)
    { 
    	global $rmd_testimonial_shortcode_id; 
		$rmd_testimonial_shortcode_id = $rmd_testimonial_shortcode_id + 1;

        // $atts = shortcode_atts( array(), $atts);

        if(!is_array($atts)) $atts = array(); 
        $attr = array_merge( array(  'limit' => -1, 'template' => '' ), $this->shortcode_attr, $atts );   
 
        $attr['limit'] = intval($attr['limit']);
        if($attr['limit'] == 0) {
            $attr['limit'] = -1;
        }
     
        if(empty($this->template)) return;

        // The data is intended to be manipulated at the template part.
        $results = $this->get_results($attr);
        $post_type = $this->post_type; 

        // The passed data from the shortcode
        extract($attr);

        ob_start(); 
        include(dirname(__FILE__).'/features/templates/'.$this->template.'.php'); 
        return ob_get_clean(); 
        
    } 


    protected function get_results(array $attr = array()) 
    { 
    	extract($attr); 

        $mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($this->post_type);  
        $mypost->limit($limit);
        $results = $mypost->get(); 

        return $results;
    }


    abstract public function render();

}

