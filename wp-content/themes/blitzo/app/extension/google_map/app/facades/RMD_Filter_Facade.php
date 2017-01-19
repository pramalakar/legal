<?php
namespace theme\rmd\extension\google_map\app\facades;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Facade
{      
    protected $shortcode_google_map = '';


	public function create_google_map_filter($shortcode_google_map = '')
	{  
        $this->shortcode_google_map = $shortcode_google_map;

		add_filter('rmd_site_google_map', array($this, '_create_google_map_filter'));

	} 


  	public function _create_google_map_filter($content)
    {  
        if(empty($this->shortcode_google_map)) return $content;

        if ( shortcode_exists( $this->shortcode_google_map ) ) {

            $rmd_setting_google_map_code = get_option('rmd_setting_google_map_code'); 

            if(empty( $rmd_setting_google_map_code )) return $content;
            
            $rmd_setting_google_map_type = get_option('rmd_setting_google_map_type');
            $rmd_setting_google_map_type = (!empty($rmd_setting_google_map_type))? $rmd_setting_google_map_type : 'fixed';

            $rmd_setting_google_map_height_lg = get_option('rmd_setting_google_map_height_lg');
            $rmd_setting_google_map_height_lg = (!empty($rmd_setting_google_map_height_lg))? $rmd_setting_google_map_height_lg : '400px';

            $rmd_setting_google_map_height_md = get_option('rmd_setting_google_map_height_md');
            $rmd_setting_google_map_height_md = (!empty($rmd_setting_google_map_height_md))? $rmd_setting_google_map_height_md : '400px';

            $rmd_setting_google_map_height_sm = get_option('rmd_setting_google_map_height_sm');
            $rmd_setting_google_map_height_sm = (!empty($rmd_setting_google_map_height_sm))? $rmd_setting_google_map_height_sm : '400px';

            $rmd_setting_google_map_height_xs = get_option('rmd_setting_google_map_height_xs');
            $rmd_setting_google_map_height_xs = (!empty($rmd_setting_google_map_height_xs))? $rmd_setting_google_map_height_xs : '400px';


            $padding_top_xs = '0px';
            $padding_top_md = '0px';
            $padding_top_lg = '0px';

            $height_xs = '';
            if(!empty($rmd_setting_google_map_height_xs)) {
                $height_xs = 'height:calc('.$rmd_setting_google_map_height_xs.' + '.$padding_top_xs.');';
            }

            $height_sm = '';
            if(!empty($rmd_setting_google_map_height_sm)) {
                $height_sm = 'height:calc('.$rmd_setting_google_map_height_sm.' + '.$padding_top_xs.');';
            }

            $height_md = '';
            if(!empty($rmd_setting_google_map_height_md)) {
                $height_md = 'height:calc('.$rmd_setting_google_map_height_md.' + '.$padding_top_md.');';
            }

            $height_lg = '';
            if(!empty($rmd_setting_google_map_height_lg)) {
                $height_lg = 'height:calc('.$rmd_setting_google_map_height_lg.' + '.$padding_top_lg.');';
            }

            ob_start(); ?> 
                <style type="text/css"> 
                    @media only screen and (min-width : 320px), (max-width: 320px){   
                        .rmd-google-map-wrapper.fluid, .rmd-google-map-wrapper.fixed {  <?php echo $height_xs; ?> padding-top: <?php echo $padding_top_xs; ?>;  } 
                        .rmd-google-map-wrapper.fluid .rmd-google-map-container, .rmd-google-map-wrapper.fixed .rmd-google-map-container { height:<?php echo $rmd_setting_google_map_height_xs; ?>; }
                    }  
                    @media only screen and (min-width : 768px) {
                        .rmd-google-map-wrapper.fluid, .rmd-google-map-wrapper.fixed { <?php echo $height_sm; ?> padding-top: <?php echo $padding_top_xs; ?>; } 
                        .rmd-google-map-wrapper.fluid .rmd-google-map-container, .rmd-google-map-wrapper.fixed .rmd-google-map-container { height:<?php echo $rmd_setting_google_map_height_sm; ?>; }
                    } 
                    @media only screen and (min-width : 992px) {
                        .rmd-google-map-wrapper.fluid, .rmd-google-map-wrapper.fixed { <?php echo $height_md; ?>  padding-top: <?php echo $padding_top_md; ?>; }  
                        .rmd-google-map-wrapper.fluid .rmd-google-map-container, .rmd-google-map-wrapper.fixed .rmd-google-map-container { height:<?php echo $rmd_setting_google_map_height_md; ?>; }
                    } 
                    @media only screen and (min-width : 1200px) {
                        .rmd-google-map-wrapper.fluid, .rmd-google-map-wrapper.fixed { <?php echo $height_lg; ?> padding-top:<?php echo $padding_top_lg; ?>; }  
                        .rmd-google-map-wrapper.fluid .rmd-google-map-container, .rmd-google-map-wrapper.fixed .rmd-google-map-container {  height:<?php echo $rmd_setting_google_map_height_lg; ?>; }
                    }
                </style>
            <?php 
                $stylesheet = ob_get_clean();  
                $stylesheet = \RMD_String_Helper::minify_string($stylesheet); 
             
            ob_start(); ?>    
                <div class="navbar-background" style="border-bottom:none !important"></div>
                <div class="rmd-google-map-wrapper <?php echo $rmd_setting_google_map_type; ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12"><?php echo do_shortcode('['.$this->shortcode_google_map.' height="" width=""]'); ?></div>
                        </div>
                    </div>
                </div>
            <?php
            $google_map = ob_get_clean(); 
           
            return $stylesheet.$google_map."\n";

        }
        return $content;
    } 
  	

}  
  

 