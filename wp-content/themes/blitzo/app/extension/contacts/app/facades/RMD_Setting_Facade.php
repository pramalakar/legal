<?php
namespace theme\rmd\extension\contacts\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 

class RMD_Setting_Facade
{         
	protected $config = array(
		'background_color' => '#333', 
		'border_color' => '#646464',
		'text_color' => '#fff'
		);


	public function create_contacts_setting(array $config = array())
	{  
		$this->config = array_merge($this->config, $config);

		$inputs_config = array(   
			$this->_get_contact_phone_config(1),
			$this->_get_contact_phone_config(2),
			$this->_get_contact_email_config(1),
			$this->_get_contact_email_config(2),
			$this->_get_contact_address_config(),  
			);  
		 
		$config = array(
			'tag_title'  	=> 'Contacts Setting',
			'menu_title' 	=> 'Contacts',  
			'page_title' 	=> 'Contacts Setting',
			'menu_slug'  	=> 'rmd-contacts-setting', 
			'parent_slug'	=> 'rmd-theme-setting',
			'inputs' 		=> $inputs_config
		);

		$adminpage_type = 'submenu'; 
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);  
		 
	} 
	   


	protected function _get_contact_email_config($idnum)
	{
		extract($this->config);

		return array(
			'section_title' => 'Email Address '.$idnum,
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type'  => 'text',
					'input_label' => 'Email Address',
					'input_name'  => 'rmd_setting_contact_email_address_'.$idnum,
					'input_description' => '<p>Available Shortcode: <code>[rmd_contact_email_'.$idnum.']</code></p>'
				)				  
			)
		);
	} 


	protected function _get_contact_phone_config($idnum)
	{ 
		return array(
			'section_title' => 'Phone No. '.$idnum,
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type'  => 'text',
					'input_label' => 'Phone No.',
					'input_name'  => 'rmd_setting_contact_phone_number_'.$idnum,
					'input_description' => '<p>Available Shortcode: <code>[rmd_contact_phone_'.$idnum.']</code></p>'
				), 
				array(
					'input_type'  => 'text',
					'input_label' => 'Call Button Label',
					'input_name'  => 'rmd_setting_call_button_label_'.$idnum,
					'input_description' => 'This will be used if the call button is enabled<br>Ex., Call Now or &lt;span class="glyphicon glyphicon-earphone"&gt;&lt;/span&gt;'
				),
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Phone Icon',
					'input_name'  => 'rmd_setting_contact_phone_icon_'.$idnum,
					'input_option' => array(
						'glyphicon-phone' => 'Smartphone',
						'glyphicon-phone-alt' => 'Telephone',
						)
				), 		
				array(
					'input_type'  => 'dropdown',
					'input_label' => 'Show at Call Button',
					'input_name'  => 'rmd_setting_contact_phone_number_'.$idnum.'_status',
					'input_option' => array(
						'yes' => 'Yes',
						'no' => 'No'
						),
					'input_description' => '<p>This is intended for the small devices.</p>'
				), 	  
			)
		);
	} 


	protected function _get_contact_address_config()
	{
		extract($this->config);

		return array(
			'section_title' => 'Address Details',
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type'  => 'wpeditor',
					'input_label' => 'Address',
					'input_name'  => 'rmd_setting_contact_address',
					'input_value' => '',
					'input_class' => 'widefat',
					'input_description' => '', 
					'input_width' => '90%',
					'input_wpeditor_settings'	=> array( 
							'media_buttons' => false,
							'tinymce' => array(
								'toolbar1' => 'bold, italic, alignleft, aligncenter, alignright, alignjustify, hr, link, unlink, forecolor, fontsizeselect',
								'toolbar2' => false
								),
						),
					'input_description' => '<p>Available Shortcode: <code>['.$shortcode_address.']</code></p>'
				),	
			)
		);
	} 
 
		 
}  
