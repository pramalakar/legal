<?php    
namespace theme\rmd\extension\content_manager\app\extension\wrap_text\app;
 
use theme\rmd\extension\content_manager\app\extension\wrap_text\app\factories as Factory; 
use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

 
class RMD_App_Handler
{     
    protected $post_type = 'rmd_wrap_text'; 
    protected $label = 'Wrap Text';

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
          
        $app->create_metabox_content_details($this->post_type); 
        $app->create_metabox_content_setting($this->post_type);

        $app->create_shortcode_column($this->post_type);

    } 
  

}
 

$RMD_App_Handler = new RMD_App_Handler();
 
