<?php   
namespace theme\rmd\extension\ads\app;
  

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class RMD_App_Handler
{    
    protected $shortcode_phone_1 = 'rmd_contact_phone_1';
    protected $shortcode_phone_2 = 'rmd_contact_phone_2';
    protected $shortcode_email_1 = 'rmd_contact_email_1';
    protected $shortcode_email_2 = 'rmd_contact_email_2';
    protected $shortcode_address = 'rmd_contact_address';


    public function __construct()
    {    
        $this->create_setting();
        $this->create_fitler(); 
        $this->create_shortcode(); 
    } 
    

    public function create_shortcode()
    { 
        $app = RMD_Facade_Loader::load_facade('Shortcode'); 

        $app->create_contact_phone_1_shortcode($this->shortcode_phone_1);
        $app->create_contact_phone_2_shortcode($this->shortcode_phone_2);
        $app->create_contact_email_1_shortcode($this->shortcode_email_1);
        $app->create_contact_email_2_shortcode($this->shortcode_email_2); 
        $app->create_contact_address_shortcode($this->shortcode_address);  
    }
 

    public function create_fitler()
    { 
        $app = RMD_Facade_Loader::load_facade('Filter'); 
        $app->create_menu_contacts_filter();
    }



    public function create_setting()
    { 
        $shortcode_phone_1 = $this->shortcode_phone_1;
        $shortcode_phone_2 = $this->shortcode_phone_2;
        $shortcode_email_1 = $this->shortcode_email_1;
        $shortcode_email_2 = $this->shortcode_email_2;
        $shortcode_address = $this->shortcode_address;

        $app = RMD_Facade_Loader::load_facade('Setting'); 
        $app->create_ads_setting(compact(
            'shortcode_phone_1',
            'shortcode_phone_2',
            'shortcode_email_1', 
            'shortcode_email_2', 
            'shortcode_address'
            ));

    }

 
}


$RMD_App_Handler = new RMD_App_Handler();
