<?php
namespace theme\rmd\extension\column_manager\app\facades;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	

	// if ( shortcode_exists( 'rmd_column_manager' ) ) {
	// 	echo do_shortcode('[rmd_column_manager]'); 
	// }
	public function create_parent_shortcode($shortcode) 
	{ 
		add_shortcode($shortcode, array($this, '_create_parent_shortcode'));
	}


	public function _create_parent_shortcode($atts = array(), $content = null)
    {   
        $attr = shortcode_atts( 
            array( 
                'title' => '', 
                'id' => '' 
            ), $atts ); 

        extract($attr);
        if(empty($id)) return '';  

        ob_start();  
		include(dirname(__FILE__).'/templates/template.php'); 
		return ob_get_clean(); 
    } 
 	

    // if ( shortcode_exists( 'rmd_column_manager_page_children' ) ) {
	// 	echo do_shortcode('[rmd_column_manager_page_children]'); 
	// }
 	public function create_child_shortcode($shortcode) 
	{
		add_shortcode($shortcode, array($this, '_create_child_shortcode'));
	}


	public function _create_child_shortcode($atts = array(), $content = null)
    {   
       $attr = shortcode_atts( 
            array(  
                'parent_id' => '' 
            ), $atts ); 

        extract($attr);
        if(empty($parent_id)) return '';  

        ob_start();  
		include(dirname(__FILE__).'/templates/template_page_children.php'); 
		return ob_get_clean();
    } 
 

}
	
 