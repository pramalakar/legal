<?php 
namespace theme\rmd\core\database;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Crud_Handler - this class will manage to compile or load all the necessary files for managing CRUD functionalities.
 */ 
 
class RMD_Crud_Handler
{	 
	public static function render()
	{
		require_once(dirname(__FILE__).'/rmd_crud_decorator/RMD_Crud_Interface.php');
		require_once(dirname(__FILE__).'/rmd_crud_decorator/RMD_Crud_Common_Methods.php');
		require_once(dirname(__FILE__).'/rmd_crud_decorator/RMD_Crud.php');
		require_once(dirname(__FILE__).'/rmd_crud_decorator/RMD_Crud_Clause.php');

		$clauses_path = dirname(__FILE__).'/rmd_crud_decorator/clauses/';
		$clauses_files = array_diff(scandir( $clauses_path ), array('..', '.')); 
		foreach ($clauses_files as $key => $file) {
			$fileinfo = pathinfo($file);  
			if(isset($fileinfo['extension'])) {
				if($fileinfo['extension'] == 'php') {
					require_once($clauses_path.$file);  
				} 
			} 
		}
	}

}
 
RMD_Crud_Handler::render();
 