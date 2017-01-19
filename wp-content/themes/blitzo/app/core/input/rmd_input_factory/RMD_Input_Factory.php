<?php
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Input_Factory - the factory class for generating input field.
 */ 
class RMD_Input_Factory
{
	protected $base_class = 'RMD_Input'; 
	protected $input_type = 'text';
	protected $prefix = 'RMD_';
	protected $suffix = '_Input';

	public function create_input($input_attr)
	{ 	
		$this->input_type = isset($input_attr['input_type']) ? $input_attr['input_type'] : $this->input_type; 
		$this->input_type = ucwords($this->input_type);

		require_once(dirname(__FILE__).'/inputs/RMD_Input.php');

		$filename = $this->prefix.$this->input_type.$this->suffix;
		require_once(dirname(__FILE__).'/inputs/'.$filename.'.php');

		$target_class = "\\theme\\rmd\\core\\input\\$filename";
		if( class_exists($target_class) ) {
			return new $target_class($input_attr);
		} 
		return false;
	}

}
 
