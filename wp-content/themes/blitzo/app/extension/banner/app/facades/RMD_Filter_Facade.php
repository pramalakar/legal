<?php
namespace theme\rmd\extension\banner\app\facades;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Facade
{        
    protected $shortcode = '';

    public function create_banner_filter($shortcode)
    {
        $this->shortcode = $shortcode; 
        add_filter('rmd_site_banner', array($this,'_create_banner_filter'));
    }

	
    public function _create_banner_filter($content)
    {   
        global $post;

        if(is_search()) return $content; 

        if(empty($post)) return $content;
 
        $shortcode = $this->shortcode;
        $rmd_banner_image = get_post_meta($post->ID, 'rmd_banner_image', true);
        $rmd_banner_text_content = get_post_meta($post->ID, 'rmd_banner_text_content', true); 
        $rmd_banner_overlay_bgcolor = get_post_meta($post->ID, 'rmd_banner_overlay_bgcolor', true); 
        $rmd_banner_overlay_opacity = get_post_meta($post->ID, 'rmd_banner_overlay_opacity', true); 

        if ( shortcode_exists( $shortcode ) ) {  

            $attr_str = 'image="'.$rmd_banner_image.'" ';
            $attr_str .= 'text_content="'.$rmd_banner_text_content.'" '; 
            $attr_str .= 'overlay_color="'.$rmd_banner_overlay_bgcolor.'" '; 
            $attr_str .= 'overlay_transparency="'.$rmd_banner_overlay_opacity.'" '; 

            return do_shortcode('['.$shortcode.' '.$attr_str.']'); 
        }  
        return $content; 
    } 
  	

}  
  

 