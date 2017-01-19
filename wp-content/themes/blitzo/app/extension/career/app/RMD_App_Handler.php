<?php    
namespace theme\rmd\extension\career\app;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_App_Handler 
{   
    protected $post_type = 'career'; 
    protected $taxonomy = 'career_cat';    
 
    public function __construct()
    {    
        $this->create_custompost(); 
            
        // search form
        // widget - serach form ghap
        // Category list for career in widget
    }


    public function create_custompost()
    {  
        $app = RMD_Facade_Loader::load_facade('Custompost'); 
        $app->create_post($this->post_type);  
        $app->create_category($this->post_type, $this->taxonomy);
    } 

     
}


$RMD_App_Handler = new RMD_App_Handler();
