<?php   
namespace theme\rmd\extension\gallery\app\factories\settings;

use theme\rmd\core\adminpage as Adminpage;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RMD_Handler
{	  
	protected $base_class = 'RMD_Setting';
	protected $extension_dir = 'gallery';
	protected $factory_dir = 'settings';
	protected $feature_dir = 'features';
	protected $input_config = array();
	 
	 
	public function render(array $config = array())
	{ 
		extract($config);

		if(empty($post_type)) return; 

		$files = array_diff(scandir(dirname(__FILE__).'/'.$this->feature_dir.'/'), array('..', '.'));  
        foreach ($files as $key => $file) {  
            $path = dirname(__FILE__).'/'.$this->feature_dir.'/'.$file;

            $filename = $this->get_filename_no_ext($path); 
            if( $filename ) { 
  		       	$factory = $this->create_factory($filename);  
				if( $factory ) {  
					$this->input_config[] = $factory->render();
				} 
            } 
        }

        $this->create_admin_setting();
	}



	public function create_admin_setting()
	{   
		$config = array(
			'tag_title'  	=> 'Gallery Shortcodes',
			'menu_title' 	=> 'Gallery', 
			'page_title' 	=> 'Gallery Shortcodes',
			'menu_slug'  	=> 'rmd-gallery-setting',
			'parent_slug'  	=> 'rmd-theme-setting',
			'inputs'		=> $this->input_config
		);
		$adminpage_type = 'submenu';
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);
	}



	/**
	 *	This will manage to retrieve and validate the path, if it exist and php file.
	 *
	 *	@param 	string 		$path - THe path of the file.
	 *	@return string 		Return the filename.
	 */
	private function get_filename_no_ext($path)
	{
		if( ! file_exists($path)) return;

		$pathinfo = pathinfo($path);

		if( ! isset($pathinfo['extension'])) return;

		if($pathinfo['extension'] != 'php') return;

		return $pathinfo['filename'];

	}


	/**
	 *	This will manage to create the factory by loading a particular object/factory file and returning the object.
	 *
	 * 	@param 	string 			$filename - The name of the file to be loaded. Filename is the same as the classname.
	 *	@return object/null 	Return class object if success, otherwise null.
	 */
	private function create_factory($filename = null)
	{ 	  
		if(empty($filename)) return; 
 
		require_once(dirname(__FILE__).'/'.$this->base_class.'.php');

		require_once(dirname(__FILE__).'/'.$this->feature_dir.'/'.$filename.'.php');
 
		$parent_class = "\\theme\\rmd\\extension\\$this->extension_dir\\app\\factories\\$this->factory_dir\\$this->base_class";
		$target_class = "\\theme\\rmd\\extension\\$this->extension_dir\\app\\factories\\$this->factory_dir\\$filename";

		if( class_exists($target_class) ) {  
			$object = new $target_class(); 
			if( is_subclass_of($object, $parent_class) ) {
				return $object;
			} else {
				if( WP_DEBUG ) exit("The $target_class is not a child of $parent_class");
			}
		} 
		return;
	}

}
