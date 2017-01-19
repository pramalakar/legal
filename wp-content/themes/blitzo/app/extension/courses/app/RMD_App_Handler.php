<?php    
namespace theme\rmd\extension\courses\app;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_App_Handler 
{    
    protected $old_post_type_course = 'rmd_courses';  

    protected $post_type_course = 'courses'; 
    protected $shortcode_course = 'rmd_courses';    

    protected $post_type_course_outline = 'courses_outline'; 
    protected $shortcode_course_outline = 'rmd_courses_outline';  


    public function __construct()
    {     
        $this->create_custompost();
        $this->create_setting();
        $this->create_shortcode();
        $this->create_filter();
        $this->create_tablelist(); 
    }


    public function create_filter()
    {  
        $app = RMD_Facade_Loader::load_facade('Filter'); 
        if($app) { 
            $app->create_course_outline_filter($this->shortcode_course_outline);   
        }
    } 


    public function create_custompost()
    {  
        $app = RMD_Facade_Loader::load_facade('Custompost'); 
        if($app) { 
            $app->create_post_courses($this->post_type_course, $this->post_type_course_outline);  
            $app->create_post_course_outline($this->post_type_course, $this->post_type_course_outline);  
        }
    } 

    
    public function create_setting()
    {
        $app = RMD_Facade_Loader::load_facade('Setting');  
        if($app) {
            $shortcode = $this->shortcode_course;
            $app->create_shortcode_setting(compact('shortcode'));  
        }
    }



    public function create_shortcode()
    {  
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 
        if($app) { 
            $app->create_courses_shortcode($this->post_type_course, $this->shortcode_course); 
            $app->create_course_outline_shortcode($this->post_type_course_outline, $this->shortcode_course_outline);
        } 
    }


    public function create_tablelist()
    {
        $app = RMD_Facade_Loader::load_facade('Tablelist');  
        if($app) {
            $app->create_courses_outline_courses_column($this->post_type_course_outline);   
        }
    }


 
     
}


$RMD_App_Handler = new RMD_App_Handler();
