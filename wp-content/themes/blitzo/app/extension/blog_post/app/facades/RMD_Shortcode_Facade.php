<?php
namespace theme\rmd\extension\blog_post\app\facades;

use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 

	public function create_blog_post_shortcode($shortcode_blog_post)
    {  
    	add_shortcode($shortcode_blog_post, array($this, '_create_blog_post_shortcode'));
    } 


    public function _create_blog_post_shortcode($atts = array(), $content = null)
    { 
        $attr = shortcode_atts( array(
            'column' => '',
            'limit' => ''
            ), $atts ); 
      
		extract($attr);
 		
 		$new_column = 3;
		if(!empty($column)) {
			$new_column = $column;
		} else {
			$rmd_setting_blog_post_num_column = get_option('rmd_setting_blog_post_num_column'); 
			$new_column = (!empty($rmd_setting_blog_post_num_column))? $rmd_setting_blog_post_num_column : $new_column;
		}

		$new_limit = 3;
		if(!empty($limit)) {
			$new_limit = $limit;
		} else {
			$rmd_setting_blog_post_num_post = get_option('rmd_setting_blog_post_num_post'); 
			$new_limit = (!empty($rmd_setting_blog_post_num_post))? $rmd_setting_blog_post_num_post : $new_limit;
		}

		$mypost = new Wpquery\RMD_Wpquery;
		$mypost->where_post_type('post'); 
		$mypost->order_by_date();
		$mypost->limit($new_limit); 
		$results = $mypost->get(); 
		 
       	ob_start(); 
        include(dirname(__FILE__).'/templates/template.php'); 
        return ob_get_clean();  
    } 

	
}
	
 