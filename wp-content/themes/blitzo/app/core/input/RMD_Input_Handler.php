<?php  
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Input_Handler - this class is use to generate a specific input based on its input type.
 */ 

class RMD_Input_Handler
{	 
	public static function render($input_attr)
	{
		require_once(dirname(__FILE__).'/rmd_input_factory/RMD_Input_Factory.php');

		$factory = new RMD_Input_Factory(); 
		$created_input = $factory->create_input($input_attr); 
		if( $created_input !== false ) {
			return $created_input->render();
		}
	}
}
 