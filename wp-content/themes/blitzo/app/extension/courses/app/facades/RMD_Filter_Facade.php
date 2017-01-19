<?php
namespace theme\rmd\extension\courses\app\facades;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Facade
{        
    protected $shortcode = '';

    public function create_course_outline_filter($shortcode)
    {
        $this->shortcode = $shortcode; 
        add_filter('rmd_course_outline', array($this,'_create_course_outline'), 10, 2);
    }

	
    public function _create_course_outline($content, $course_id)
    {    
        if(is_search()) return $content;  
    
        if( ! shortcode_exists( $this->shortcode ) ) return $content;

        return do_shortcode('['.$this->shortcode.' course_id='.$course_id.']'); 
    } 
  	

}  
  

 