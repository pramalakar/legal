<?php 
namespace theme\rmd\core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


class RMD_Core_Loader
{  
	public function __construct()
	{ 
		require_once( dirname(__FILE__).'/adminenqueue/RMD_Admin_Enqueue.php');
		require_once( dirname(__FILE__).'/input/RMD_Input_Handler.php');
		require_once( dirname(__FILE__).'/adminpage/RMD_Adminpage_Handler.php');
		require_once( dirname(__FILE__).'/database/RMD_Crud_Handler.php');
		require_once( dirname(__FILE__).'/formvalidation/RMD_Validator_Handler.php'); 
		require_once( dirname(__FILE__).'/wplist/RMD_Wplist_Handler.php');
		require_once( dirname(__FILE__).'/wppost/RMD_Wppost_Handler.php');
		require_once( dirname(__FILE__).'/wpquery/RMD_Wpquery.php');

		// common files
		$common_files = array_diff(scandir(dirname(__FILE__).'/common/'), array('..', '.')); 
		foreach ($common_files as $key => $file) {
			$fileinfo = pathinfo($file);   
			if(isset($fileinfo['extension'])) {
				if($fileinfo['extension'] == 'php') {
					require_once(dirname(__FILE__).'/common/'.$file); 
				}  
			} 
		} // end of foreach


		// helper files
		$helper_files = array_diff(scandir(dirname(__FILE__).'/helper/'), array('..', '.')); 
		foreach ($helper_files as $key => $file) {
			$fileinfo = pathinfo($file);   
			if(isset($fileinfo['extension'])) {
				if($fileinfo['extension'] == 'php') {
					require_once(dirname(__FILE__).'/helper/'.$file); 
				}  
			} 
		} // end of foreach

	} // end of __construct

} // end of class RMD_Core_Loader 

 
$RMD_Core_Loader = new RMD_Core_Loader();
 

