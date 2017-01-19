<?php    
namespace theme\rmd\extension\content_manager\app\extension\column_container\app;
  
use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

 
class RMD_App_Handler 
{   
    protected $post_type = 'rmd_column_container'; 
    protected $label = 'Column Container';


    public function __construct()
    {        
        $this->create_custompost(); 
        $this->create_shortcode(); 
    }
    
    
    public function create_shortcode()
    {   
        $app = RMD_Facade_Loader::load_facade('Shortcode');  
        $app->create_shortcode($this->post_type);
    } 
 
  
    public function create_custompost()
    {     
        $app = RMD_Facade_Loader::load_facade('Custompost');  

        $app->create_post($this->post_type, $this->label); 
        $app->create_menu($this->post_type, $this->label);  
        $app->create_metabox_available_shortcode($this->post_type);
          
        $app->create_metabox_column_type($this->post_type);
        $app->create_metabox_wrapper_style($this->post_type);
        
        $app->create_metabox_column($this->post_type, 1);
        $app->create_metabox_column_container_style($this->post_type, 1);

        $app->create_metabox_column($this->post_type, 2);
        $app->create_metabox_column_container_style($this->post_type, 2);

        $app->create_metabox_column($this->post_type, 3);
        $app->create_metabox_column_container_style($this->post_type, 3);

        $app->create_metabox_column($this->post_type, 4); 
        $app->create_metabox_column_container_style($this->post_type, 4);

        $app->create_shortcode_column($this->post_type);

    } 
 

}
 

$RMD_App_Handler = new RMD_App_Handler();
 
