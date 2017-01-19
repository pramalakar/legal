<?php
namespace theme\rmd\extension\social_media\app\facades;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Facade
{      
    protected $shortcode_social_media = '';


	public function create_footer_section_filter($shortcode_social_media = '')
	{  
        $this->shortcode_social_media = $shortcode_social_media;

		add_filter('rmd_footer_social_media', array($this, '_create_footer_section_filter'));

	} 


  	public function _create_footer_section_filter($content)
    {  
        if(empty($this->shortcode_social_media)) return $content;

        if ( shortcode_exists( $this->shortcode_social_media ) ) {
  
            ob_start(); ?>     
                <div class="footer-social-media-wrapper">
                    <?php echo do_shortcode('['.$this->shortcode_social_media.']'); ?>
                </div>
            <?php
            $social_media = ob_get_clean(); 
           
            return $social_media."\n";

        }
        return $content;
    } 
  	 

}  
  

 