<?php    
namespace theme\rmd\extension\menu_manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_Menu_Manager_Loader 
{    
    public function __construct()
    {    
        $this->load_app();   
    }
  
    public function load_app()
    {  
        require_once(dirname(__FILE__).'/app/RMD_Facade_Loader.php');  
        require_once(dirname(__FILE__).'/app/RMD_App_Handler.php');  
    }  
} 

$RMD_Menu_Manager_Loader = new RMD_Menu_Manager_Loader();
