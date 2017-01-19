<?php 
namespace theme\rmd\core\formvalidation;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
} 
/***
 *  HOW TO USE:

    RMD_Validator_Handler::set_fields(array(
        'input_name_1' => array( 'label'=> 'Full Name', 'validation' => array('required')),
        'input_emal_1' => array( 'label'=> 'Email Address', 'validation' => array('email','required')),
        'input_numb_1' => array( 'label'=> 'Number', 'validation' => array('numeric')),
    )); 
    $response = RMD_Validator_Handler::run(); 
 */
/***
 *  DISPLAY ALERT IF ANY:

    RMD_Validator_Handler::display_alert();
 */ 
 
class RMD_Validator_Handler
{         
    protected static $_fields = array();
    protected static $_validation_success = TRUE;
    protected static $_field_config = array(
        'label' => '',
        'validation' => array(),
        'messages' => array()
        );

    /**
     *  set_fields - This method is use to set the fields that we want to validate.
     *
     *  @param  array       $fields - the form fields that you want to validate. Just base an example above.
     *  @return void
     */
    public static function set_fields(array $fields = array())
    {
        self::$_fields = $fields;
    }


    /**
     *  run - This method will start the process of validation a form.
     *
     *  @return boolean     TRUE on success otherwise FALSE.
     */
    public static function run() 
    {
    	require_once(dirname(__FILE__).'/rmd_validator_factory/RMD_Validator_Factory.php');

        if(isset($_POST)) {
            foreach ($_POST as $key => $value) {
                $_POST[$key] = trim($value);
            }
        }

        $fields = self::$_fields;
        foreach ($fields as $field_name => $field) 
        {   
            $field = array_merge(self::$_field_config, $field);

            $field_label = $field['label'];
            $validations = $field['validation'];
            $messages = $field['messages']; 
 
            foreach ($validations as $key => $validation) 
            {
                $message = (isset($messages[$validation]))? $messages[$validation] : '';

                $validate_attr = array(
                    'validator_type' => $validation,
                    'field_name' => $field_name,
                    'field_label' => $field_label,
                    'field_message' => $message
                    ); 

                $factory = new RMD_Validator_Factory(); 
                $created_validator = $factory->create_validator($validate_attr);   
                if( $created_validator !== false ) {
                    $response = $created_validator->render(); 
                    if( $response === FALSE ) {
                        self::$_validation_success = $response;
                    }
                }
            } 
        }


        return self::$_validation_success;
        
    }


    /**
     *  display_alert - This will display an alert message particularly for the validation error(s).
     *
     *  @return void      
     */
    public static function display_alert() 
    {
        if( ! isset($_SESSION['rmd_form_validation'])) return;

        $validation_messages = $_SESSION['rmd_form_validation']; 
        $messages = implode(' ', $validation_messages); 
        ?> 
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $messages; ?>
            </div>
        <?php

        unset($_SESSION['rmd_form_validation']);
    }   

}
	 
 

