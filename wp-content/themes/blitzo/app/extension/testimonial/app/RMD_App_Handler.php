<?php    
namespace theme\rmd\extension\testimonial\app;
  
use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

 
class RMD_App_Handler 
{   
    protected $post_type = 'rmd_testimonial';   


    public function __construct()
    {            
        $this->create_custompost(); 
        $this->create_tablelist(); 
        $this->create_settings();  
        $this->create_shortcodes();
 
    }


    public function create_shortcodes()
    {
        $post_type = $this->post_type;   
        
        $app = RMD_Factory_Loader::load_factory('shortcodes'); 
        if($app) {
            $app->render(compact('post_type'));
        } 
    }


    public function create_settings()
    {
        $post_type = $this->post_type;   
        
        $app = RMD_Factory_Loader::load_factory('settings'); 
        if($app) {
            $app->render(compact('post_type'));
        } 
    }


    public function create_tablelist()
    { 
        $app = RMD_Facade_Loader::load_facade('Tablelist'); 
        $app->create_image_column($this->post_type);
        $app->create_content_column($this->post_type);
    }
    
  

    public function create_custompost()
    {   
        $app = RMD_Facade_Loader::load_facade('Custompost'); 
        $app->create_post($this->post_type);
        $app->create_metabox_testimonial_details($this->post_type);
    } 
 
}
 

$RMD_App_Handler = new RMD_App_Handler();
 
