<?php
namespace theme\rmd\extension\slider\app\facades;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Facade
{        
    protected $post_type = '';


    public function create_slider_filter($post_type)
    {
        $this->post_type = $post_type;

        add_filter('rmd_site_slider', array($this,'_create_slider_filter'));
    }

	
    public function _create_slider_filter($content)
    {   
        global $post;

        if(is_search()) return $content; 

        if(empty($post)) return $content;
 
        $shortcode = $this->post_type;
        $rmd_setting_slider_category = get_post_meta($post->ID, 'rmd_setting_slider_category', true);
        $rmd_setting_slider_type = get_post_meta($post->ID, 'rmd_setting_slider_type', true);
        $rmd_setting_slider_bgcolor = get_post_meta($post->ID, 'rmd_setting_slider_bgcolor', true);
        $rmd_setting_slider_overlay_bgcolor = get_post_meta($post->ID, 'rmd_setting_slider_overlay_bgcolor', true);
        $rmd_setting_slider_overlay_opacity = get_post_meta($post->ID, 'rmd_setting_slider_overlay_opacity', true);
        $rmd_setting_slider_navigation_status = get_post_meta($post->ID, 'rmd_setting_slider_navigation_status', true);
        $rmd_setting_slider_indicator_status = get_post_meta($post->ID, 'rmd_setting_slider_indicator_status', true);

        if ( shortcode_exists( $shortcode ) ) {

            if(empty($rmd_setting_slider_category)) return $content;
            
            $attr_str = 'slider_category="'.$rmd_setting_slider_category.'" ';
            $attr_str .= 'slider_type="'.$rmd_setting_slider_type.'" ';
            $attr_str .= 'slider_bgcolor="'.$rmd_setting_slider_bgcolor.'" ';
            $attr_str .= 'slider_overlay_bgcolor="'.$rmd_setting_slider_overlay_bgcolor.'" ';
            $attr_str .= 'slider_overlay_opacity="'.$rmd_setting_slider_overlay_opacity.'" ';
            $attr_str .= 'slider_navigation_status="'.$rmd_setting_slider_navigation_status.'" ';
            $attr_str .= 'slider_indicator_status="'.$rmd_setting_slider_indicator_status.'" ';
            return do_shortcode('['.$shortcode.' '.$attr_str.']'); 
        }  
        return $content; 
    } 
  	

}  
  

 