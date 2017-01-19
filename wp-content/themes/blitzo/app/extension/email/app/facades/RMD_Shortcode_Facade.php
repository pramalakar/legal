<?php
namespace theme\rmd\extension\email\app\facades;

use theme\rmd\core\formvalidation as Validator;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 
	protected $nonce_field = array(
        'name' => 'rmd_cf_nonce_name',
        'action' => 'rmd_cf_nonce_action',
        );


	public function create_email_test_shortcode($shortcode)
	{
		add_shortcode($shortcode, array($this, '_create_email_test_shortcode')); 
	}


	public function _create_email_test_shortcode($atts = array(), $content = null)
    {  
        $attr = shortcode_atts( array(), $atts );    

        if(!current_user_can( 'manage_options' )) return ''; 

        $submission_response = $this->_check_email_submission(); 
        $nonce_field = $this->nonce_field; 
		
        ob_start();  
		include(dirname(__FILE__).'/templates/template_email_test.php'); 
		return ob_get_clean(); 
    } 
    

    protected function _check_email_submission()
    {  
        // For debugging purposes.
        global $phpmailer;

        if(current_user_can( 'manage_options' )) { 

            add_action('phpmailer_init', function($phpmailer){
                // Set SMTPDebug to true
                $phpmailer->SMTPDebug = true; 
            });  

            // if the <form> element is POSTed, run the following code
            if ( isset($_POST['rmd_cf_submit']) ) 
            {   
                $nonce_field = $this->nonce_field;
     
                $validate_response = $this->_validate_form_fields();

                if($validate_response === FALSE) return;

                // validate nonce field.
                if ( ! isset( $_POST[$nonce_field['name']] ) || ! wp_verify_nonce( $_POST[$nonce_field['name']], $nonce_field['action'] ) ) {
                    return 'error'; 
                }  
     

                $email_data = $this->_get_email_data();
                extract($email_data);  
                 
                // Start output buffering to grab smtp debugging output
                ob_start();
                // If email has been process for sending, display a success message
                $wp_mail_result = wp_mail( $to, $subject, $full_message, $headers );
                
                // Grab the smtp debugging output
                $smtp_debug = ob_get_clean(); 

                // Start output buffering to grab the output to be returned to the shortcode
                ob_start(); 
                ?>
                <div><p><strong><?php _e('Test Message Sent'); ?></strong></p>
                <p><?php _e('The result was:'); ?></p>
                <pre><?php var_dump($wp_mail_result); ?></pre>
                <p><?php _e('The full debugging output is shown below:'); ?></p>
                <pre><?php var_dump($phpmailer); ?></pre>
                <p><?php _e('The SMTP debugging output is shown below:'); ?></p>
                <pre><?php echo $smtp_debug ?></pre>
                </div>          
                <?php
                // Destroy $phpmailer so it doesn't cause issues later
                unset($phpmailer);

                // Return the compiled debugging output.
                return ob_get_clean(); 

            }  
        }

        return '';
    } 


	
	protected function _validate_form_fields()
    {
        Validator\RMD_Validator_Handler::set_fields(array(
            'rmd_cf_name' => array( 'label'=> 'Name', 'validation' => array('required')), 
            'rmd_cf_email' => array( 'label'=> 'Email Address', 'validation' => array('required', 'email'))
        )); 
        return Validator\RMD_Validator_Handler::run(); 
    }


    protected function _get_email_data() 
    { 
        $name     = sanitize_text_field( $_POST["rmd_cf_name"] ); 
        $email    = sanitize_email( $_POST["rmd_cf_email"] );  
        $subject  = 'Test Email';
        $message  = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';

        // set the e-mail headers with the user's name, e-mail address and character encoding
        $headers  = "From: ".$name." <".$email.">\n"; 
        $headers .= "Content-Type: text/plain; charset=UTF-8\n";
        $headers .= "Content-Transfer-Encoding: 8bit\n"; 

        $full_message = 'Name: '.$name."\n"; 
        $full_message .= 'Email: '.$email."\n";
        $full_message .= 'Message: '.$message."\n";

        $to = $email;

        return compact('to', 'subject', 'full_message', 'headers');

    }


}
	
 