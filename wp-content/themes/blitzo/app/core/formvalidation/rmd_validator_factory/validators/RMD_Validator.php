<?php
namespace theme\rmd\core\formvalidation;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
abstract class RMD_Validator 
{
	protected $validate_attr = array(
            'validator_type' => '',
            'field_name' => '',
            'field_label' => '',
            'field_message' => '',
            );
  

	public function __construct(array $validate_attr = array())
	{ 
		$this->validate_attr = $validate_attr;
	}


	public function set_session_validated_field($message)
    {
        $_SESSION['rmd_form_validation'][] = $message;
    }


	abstract protected function validate_field($field_name, $field_label, $field_message);

	abstract protected function get_validation_message($field_label);

	abstract protected function render();
}
