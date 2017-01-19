<?php  
namespace theme\rmd\core\helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
class RMD_Alert_Message
{  
    
	public static function set_alert($message = '', $type = 'success')
    {
        $_SESSION['rmd_alert_message'] = array( 'message'=> $message, 'type'=> $type);
    }

    public static function display_alert() 
    {
        if( ! isset($_SESSION['rmd_alert_message'])) return;

        $message = $_SESSION['rmd_alert_message']['message'];
        $type    = $_SESSION['rmd_alert_message']['type'];

        $styles = '';

        if($type == 'success') {
            $styles = 'margin:0px 0px 15px; border-left: 4px solid #46b450; background: #fff';
        }
        if($type == 'error') {
            $styles = 'margin:0px 0px 15px; border-left: 4px solid #d43f3a; background: #fff';
        }
        ?>
        <div style="<?php echo $styles; ?>" class="notice is-dismissible"> 
            <p><?php echo $message; ?></p>
            <button type="button" class="notice-dismiss">
            <span class="screen-reader-text">Dismiss this notice.</span>
            </button>
        </div> 
        <?php

        unset($_SESSION['rmd_alert_message']);
    }   


    public static function display_wooc_alert()
    {
        if( ! isset($_SESSION['rmd_alert_message'])) return;

        $message = $_SESSION['rmd_alert_message']['message'];
        $type    = $_SESSION['rmd_alert_message']['type'];

        $css_class = '';

        if($type == 'success') {
            $css_class = 'woocommerce-message';
        }elseif($type == 'error') {
            $css_class = 'woocommerce-error';;
        }
                     
        ?>
        <ul class="<?php echo $css_class; ?>">
            <li><?php echo $message; ?></li>
        </ul> 
        <?php 

        unset($_SESSION['rmd_alert_message']);
    }



}
		 
 

 