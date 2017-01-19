<?php
namespace theme\rmd\extension\google_map\app\facades;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 

	public function create_google_map_shortcode($shortcode_google_map)
    {  
    	add_shortcode($shortcode_google_map, array($this, '_create_google_map_shortcode'));
    } 


    public function _create_google_map_shortcode($atts = array(), $content = null)
    { 
        $attr = shortcode_atts( array(
            'width' => '',
            'height' => ''
            ), $atts ); 
      
		extract($attr);

		$dimension = '';
		if(!empty($width)) {
			$dimension .= "width:$width;";
		}
		if(!empty($height)) {
			$dimension .= "height:$height;";
		}
		if(!empty($dimension)) {
			$dimension = 'style="'.$dimension.'"';
		} 

		$rmd_setting_google_map_code = get_option('rmd_setting_google_map_code'); 
		 
        ob_start(); 
        ?>	 
        	<div <?php echo $dimension; ?> class="rmd-google-map-container"><?php echo $rmd_setting_google_map_code; ?></div>
        <?php
        return ob_get_clean(); 
    } 

	
}
	
 