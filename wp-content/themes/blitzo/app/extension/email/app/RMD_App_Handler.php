<?php    
namespace theme\rmd\extension\email\app;
  
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

 
class RMD_App_Handler 
{   
    protected $shortcode_email_test = 'rmd_email_test'; 
 

    public function __construct()
    {     
        $this->create_setting();
        $this->create_shortcode();    
    }


    public function create_setting()
    { 
        $shortcode_email_test = $this->shortcode_email_test; 

        $app = RMD_Facade_Loader::load_facade('Setting'); 
        $app->create_email_setting(compact('shortcode_email_test'));
    }


    public function create_shortcode()
    {  
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 
        $app->create_email_test_shortcode($this->shortcode_email_test);
    }
 

}
 

$RMD_App_Handler = new RMD_App_Handler();
 
