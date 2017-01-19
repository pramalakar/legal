<?php
namespace theme\rmd\extension\email\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Setting_Facade 
{	    
	protected $config = array(
		'shortcode_email_test' => ''
		);


	public function __construct() 
	{
		// Set the phpmailer smtp setting
        add_action('phpmailer_init', array($this, '_set_phpmailer_init_smtp'));
	}


	public function _set_phpmailer_init_smtp($phpmailer) 
    {
        
        // Check that mailer is not blank, and if mailer=smtp, host is not blank
        if ( ! get_option('rmd_cf_setting_mailer') || ( get_option('rmd_cf_setting_mailer') == 'smtp' && ! get_option('rmd_cf_setting_smtp_host') ) ) {
            return;
        }

        // Set the mailer type as per config above, this overrides the already called isMail method
        $phpmailer->Mailer = get_option('rmd_cf_setting_mailer');
         
        // Set the SMTPSecure value, if set to none, leave this blank
        $phpmailer->SMTPSecure = get_option('rmd_cf_setting_smtp_encryption') == 'none' ? '' : get_option('rmd_cf_setting_smtp_encryption');
        
        // If we're sending via SMTP, set the host
        if (get_option('rmd_cf_setting_mailer') == "smtp") {
            
            // Set the SMTPSecure value, if set to none, leave this blank
            $phpmailer->SMTPSecure = get_option('rmd_cf_setting_smtp_encryption') == 'none' ? '' : get_option('rmd_cf_setting_smtp_encryption');
            
            // Set the other options
            $phpmailer->Host = get_option('rmd_cf_setting_smtp_host'); //'smtp.gmail.com'; 
            $phpmailer->Port = get_option('rmd_cf_setting_smtp_port'); //587; 
            
            // If we're using smtp auth, set the username & password
            if (get_option('rmd_cf_setting_smtp_authentication') == "yes") {
                $phpmailer->SMTPAuth = TRUE;
                $phpmailer->Username = get_option('rmd_cf_setting_smtp_username');
                $phpmailer->Password = get_option('rmd_cf_setting_smtp_password');
            }
        }  

    }  


	public function create_email_setting(array $config = array())
	{   
		$this->config = array_merge($this->config, $config);

		$inputs_config = array( 
			$this->_get_common_config(),
			$this->_get_smtp_config()
			);

		$config = array(
			'tag_title'  	=> 'Email Setting',
			'menu_title' 	=> 'Email', 
			'page_title' 	=> 'Email Setting',
			'menu_slug'  	=> 'rmd-contact-form-setting',
			'parent_slug'  	=> 'rmd-theme-setting',  
			'inputs' 		=> $inputs_config, 
		);
		$adminpage_type = 'submenu';
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);

	}


	public function _get_common_config()
	{
		extract($this->config);

		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type' => 'none',
					'input_label' => 'Available Shortcode',
					'input_value'  => '<code>['.$shortcode_email_test.']</code>', 
					'input_description' => '<p>This is inteded for debugging purposes.</p>'
				),   
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Mailer',
					'input_name'  => 'rmd_cf_setting_mailer', 
					'input_option' => array(
						'mail' => 'Send emails via PHP mail() function.',
						'smtp' => 'Send emails via SMTP.',						
						),
					'input_description' => '' 
				),  
			)
		);
	}


	public function _get_smtp_config()
	{
		return array(
			'section_title' => 'SMTP Options',
			'section_description' => '<em>Note: Set the receptient email same as with the username. To achieve on sending the email to the right recipient, just manage the email forwarding on your hosting account.</em>',
			'inputs' => array(
				array(
					'input_label' => 'SMTP Host',
					'input_name'  => 'rmd_cf_setting_smtp_host', 
					'input_description' => ''
				),   
				array(
					'input_label' => 'SMTP Port',
					'input_name'  => 'rmd_cf_setting_smtp_port', 
					'input_description' => ''
				), 
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Encryption',
					'input_name'  => 'rmd_cf_setting_smtp_encryption', 
					'input_option' => array(
						'none' => 'No encryption.',
						'ssl' => 'Use SSL encryption.',
						'tls' => 'Use TLS encryption.'
						),
					'input_description' => 'TLS encryption is not the same as STARTTLS. For most servers SSL is the recommended option.' 
				),
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Authentication',
					'input_name'  => 'rmd_cf_setting_smtp_authentication', 
					'input_option' => array(
						'no' => 'No: Do not use SMTP authentication.',
						'yes' => 'Yes: Use SMTP authentication.', 
						),
					'input_description' => 'If this is set to no, the values below are ignored.' 
				),  

				array(
					'input_label' => 'Username',
					'input_name'  => 'rmd_cf_setting_smtp_username', 
					'input_description' => ''
				),

				array(
					'input_label' => 'Password',
					'input_name'  => 'rmd_cf_setting_smtp_password', 
					'input_description' => ''
				),
			)
		);
	}

}

 
