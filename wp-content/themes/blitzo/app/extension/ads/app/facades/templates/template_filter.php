<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
 
$have_contact = FALSE;
$contact_tag = '';
 
$rmd_setting_contact_phone_number_1 = get_option('rmd_setting_contact_phone_number_1');
if(!empty($rmd_setting_contact_phone_number_1)) {
    $rmd_setting_contact_phone_icon_1 = get_option('rmd_setting_contact_phone_icon_1');
    $rmd_setting_contact_phone_icon_1 = (!empty($rmd_setting_contact_phone_icon_1))? $rmd_setting_contact_phone_icon_1 : 'glyphicon-phone';
    $contact_tag .= '<li><p class="contact"><span class="icon glyphicon '.$rmd_setting_contact_phone_icon_1.'" aria-hidden="true"></span> '.$rmd_setting_contact_phone_number_1.'</p></li>';
    $have_contact = TRUE;
}

$rmd_setting_contact_phone_number_2 = get_option('rmd_setting_contact_phone_number_2');
if(!empty($rmd_setting_contact_phone_number_2)) {
    $rmd_setting_contact_phone_icon_2 = get_option('rmd_setting_contact_phone_icon_2');
    $rmd_setting_contact_phone_icon_2 = (!empty($rmd_setting_contact_phone_icon_2))? $rmd_setting_contact_phone_icon_2 : 'glyphicon-phone';
    $contact_tag .= '<li><p class="contact"><span class="icon glyphicon '.$rmd_setting_contact_phone_icon_2.'" aria-hidden="true"></span> '.$rmd_setting_contact_phone_number_2.'</p></li>';
    $have_contact = TRUE;
}

$rmd_setting_contact_email_address_1 = get_option('rmd_setting_contact_email_address_1');
if(!empty($rmd_setting_contact_email_address_1)) {
    $contact_tag .= '<li><p class="contact"><span class="icon fa fa-envelope-o" aria-hidden="true"></span> '.$rmd_setting_contact_email_address_1.'</p></li>';
    $have_contact = TRUE;
}

$rmd_setting_contact_email_address_2 = get_option('rmd_setting_contact_email_address_2');
if(!empty($rmd_setting_contact_email_address_2)) {
    $contact_tag .= '<li><p class="contact"><span class="icon fa fa-envelope-o" aria-hidden="true"></span> '.$rmd_setting_contact_email_address_2.'</p></li>';
    $have_contact = TRUE;
} 
 
if($have_contact): 
?>
    <ul class="nav navbar-nav navbar-right rmd-menu-contact-container">
        <li class="dropdown"><a title="Page 1" href="#"><i class="fa fa-phone" aria-hidden="true"></i></a>
            <ul role="menu" class=" dropdown-menu"><?php echo $contact_tag; ?></ul>
        </li>
    </ul>
<?php
endif;