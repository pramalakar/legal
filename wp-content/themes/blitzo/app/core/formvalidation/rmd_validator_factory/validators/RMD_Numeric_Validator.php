<?php 
namespace theme\rmd\core\formvalidation;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/***
 *   HOW TO USE:

    RMD_Validator_Handler::set_fields(array(
        'input_name' => array( 'label'=> 'Full Name', 'validation' => array('numeric')),
    )); 
    $response = RMD_Validator_Handler::run(); 
 
 */  
 
class RMD_Numeric_Validator extends RMD_Validator 
{
	public function render()
	{	  
		extract($this->validate_attr); 
		return $this->validate_field($field_name, $field_label, $field_message);
	}


	protected function validate_field($field_name, $field_label, $field_message) 
	{
		if(isset($_POST[$field_name]) && !empty($_POST[$field_name])) { 
            if( ! is_numeric($_POST[$field_name])) {
                $message = (!empty($field_message))? $field_message : $this->get_validation_message($field_label);
            	$this->set_session_validated_field($message);
                return FALSE;
            } 
        }
        return TRUE; 
	}


	protected function get_validation_message($field_label)
	{
		return '<p><strong>'.$field_label.'</strong> requires a numeric value.</p>';
	}  

} 