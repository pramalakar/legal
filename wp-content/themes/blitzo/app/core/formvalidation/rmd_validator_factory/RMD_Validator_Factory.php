<?php
namespace theme\rmd\core\formvalidation;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/** 
 *	RMD_Validator_Factory - the factory class for generating a specific validator.
 */ 
class RMD_Validator_Factory
{
	protected $base_class = 'RMD_Validator'; 
	protected $validator_type = '';
	protected $prefix = 'RMD_';
	protected $suffix = '_Validator';

	public function create_validator(array $validate_attr = array())
	{ 	
		$this->validator_type = isset($validate_attr['validator_type']) ? $validate_attr['validator_type'] : $this->validator_type; 
		if( empty($this->validator_type) ) return false;

		$this->validator_type = ucwords($this->validator_type);
 		
 		require_once(dirname(__FILE__).'/validators/RMD_Validator.php');

		$filename = $this->prefix.$this->validator_type.$this->suffix;
		require_once(dirname(__FILE__).'/validators/'.$filename.'.php');

		$target_class = "\\theme\\rmd\\core\\formvalidation\\$filename";
		if( class_exists($target_class) ) {
			return new $target_class($validate_attr);
		} 
		return false;
	}

}
 
