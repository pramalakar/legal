<?php
/**
 *	RMD_App_Loader - The main class that handle the initial configuration or settings. 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_App_Loader
{ 
	/**
	 * 	This will manage on calling the necessaray methods for the initial configuration.
	 */
	public function __construct()
	{   
		global $my_die_alert;
		$my_die_alert = '<div style="width:50%; border:1px solid #eee; box-shadow:2px 2px 5px rgb(100,100,100); margin:50px auto;text-align:left; font-family:arial; padding:30px 30px">Are you sure you want to do this?</div>';

		$this->_start_session();
		$this->_set_define_path();  

		$this->_set_require_core_files();   
		$this->_set_require_theme_files();  
		$this->_set_require_extension_files();
			
	}   


	/** 
	 *	This method will manage to require the necessarry core files like the controller.php, model.php and loader.php.
	 */
	protected function _set_require_core_files()
	{   
		require_once(RMD_CORE_PATH.'RMD_Core_Loader.php'); 
	}
	

	protected function _set_require_extension_files()
	{      
		$files = array(
			//'career/RMD_Career_Loader.php',
			'courses/RMD_Courses_Loader.php',
			'banner/RMD_Banner_Loader.php',
			'slider/RMD_Slider_Loader.php', 
			'seo/RMD_SEO_Loader.php', 
			'gallery/RMD_Gallery_Loader.php',
			'testimonial/RMD_Testimonial_Loader.php',
			'contacts/RMD_Contacts_Loader.php',
			'google_map/RMD_Google_Map_Loader.php',
			'call_button/RMD_Call_Button_Loader.php',
			'email/RMD_Email_Loader.php', 
			'column_manager/RMD_Column_Manager_Loader.php',
			'widget_manager/RMD_Widget_Manager_Loader.php',
			'menu_manager/RMD_Menu_Manager_Loader.php',
			'content_manager/RMD_Content_Manager_Loader.php', 
			'blog_post/RMD_Blog_Post_Loader.php', 
			'social_media/RMD_Social_Media_Loader.php',
			'ads/RMD_Ads_Loader.php', 
			);
		
		foreach ($files as $key => $file) {
			require_once(RMD_EXTENSION_PATH.$file);
		} 
	}


	protected function _set_require_theme_files()
	{   
		require_once(RMD_THEME_PATH.'RMD_Theme_Loader.php'); 
	}


	/**
	 * 	This will manage on defining the path within the plugin.
	 */
	protected function _set_define_path()
	{ 
		define('RMD_APP_PATH', dirname(__FILE__).'/');
		define('RMD_CORE_PATH', RMD_APP_PATH.'core/');  
		define('RMD_EXTENSION_PATH', RMD_APP_PATH.'extension/');  
		define('RMD_THEME_PATH', RMD_APP_PATH.'theme/');     
	}



		/**
	 * 	This will manage the start of the session.
	 */
	protected function _start_session() 
	{	 
		if(!session_id()) {
			session_start();
		}  
	}

}  

$RMD_App_Loader = new RMD_App_Loader();



