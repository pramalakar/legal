<?php    
namespace theme\rmd\extension\content_manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class RMD_Content_Manager_Loader 
{    
    public function __construct()
    {   
        $this->load_dependencies();
        $this->load_assets();
        $this->load_extension();   

    }

    public function load_dependencies()
    {  
        require_once(dirname(__FILE__).'/app/RMD_Base_Content_Manager.php');  
    }   


    public function load_assets()
    {   
        $directories = array_diff(scandir(dirname(__FILE__).'/app/extension/'), array('..', '.'));  
        foreach ($directories as $key => $dir) {  

            $dirpath = dirname(__FILE__).'/app/extension/'.$dir;
            if(is_dir($dirpath)) {  
                if(file_exists($dirpath.'/assets/RMD_Assets_Handler.php')) { 
                    require_once($dirpath.'/assets/RMD_Assets_Handler.php');  
                } 
            }
        }
 
    } 


    public function load_extension()
    {  
        $directories = array_diff(scandir(dirname(__FILE__).'/app/extension/'), array('..', '.'));  

        foreach ($directories as $key => $dir) { 
            $dirpath = dirname(__FILE__).'/app/extension/'.$dir; 
            if(is_dir($dirpath)) {   
                if(file_exists($dirpath.'/app/RMD_Facade_Loader.php')) {
                    require_once($dirpath.'/app/RMD_Facade_Loader.php');  
                }
                if(file_exists($dirpath.'/app/RMD_App_Handler.php')) {
                    require_once($dirpath.'/app/RMD_App_Handler.php');  
                }  
            }
        } 
    } 

} 

$RMD_Content_Manager_Loader = new RMD_Content_Manager_Loader();
