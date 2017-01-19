<?php   
namespace theme\rmd\extension\career;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_Career_Loader 
{    
    public function __construct()
    {   
        $this->load_assets();
        $this->load_app();   
    }

    public function load_assets()
    {  
        require_once(dirname(__FILE__).'/assets/RMD_Assets_Handler.php');  
    } 

    public function load_app()
    {  
        require_once(dirname(__FILE__).'/app/RMD_Facade_Loader.php'); 
        require_once(dirname(__FILE__).'/app/RMD_App_Handler.php');  
    }  
}
 
$RMD_Career_Loader = new RMD_Career_Loader();
