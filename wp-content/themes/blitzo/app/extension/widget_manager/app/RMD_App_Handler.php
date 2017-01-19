<?php    
namespace theme\rmd\extension\widget_manager\app;
 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

 
class RMD_App_Handler 
{   
    protected $post_type = 'rmd_widget_manager';  


    public function __construct()
    {       
        $this->create_custompost();   
        $this->create_tablelist();  
        $this->create_widget();  
    }


    public function create_widget()
    {   
        $app = RMD_Facade_Loader::load_facade('Widget'); 
        $app->create_widget_area($this->post_type); 
    } 


    public function create_tablelist()
    {   
        $app = RMD_Facade_Loader::load_facade('Tablelist'); 
        $app->create_description_column($this->post_type); 
    } 


    public function create_custompost()
    {  
        $app = RMD_Facade_Loader::load_facade('Custompost'); 
        $app->create_post($this->post_type);
        $app->create_metabox($this->post_type); 
    } 


}
 

$RMD_App_Handler = new RMD_App_Handler();
 
