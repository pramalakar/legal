<?php   
namespace theme\rmd\extension\call_button\app;
  

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class RMD_App_Handler
{      
    public function __construct()
    {    
        $this->create_setting(); 
        $this->create_call_button();  
    } 
    
     
    public function create_setting()
    {  
        $app = RMD_Facade_Loader::load_facade('Setting'); 
        $app->create_setting(); 
    }



    public function create_call_button()
    { 
        $app = RMD_Facade_Loader::load_facade('Call_Button'); 
        $app->create_call_button();
    }  
 
}


$RMD_App_Handler = new RMD_App_Handler();
