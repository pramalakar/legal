<?php
namespace theme\rmd\theme\app\facades;
 
use theme\rmd\core\wpquery as Wpquery;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Footer_Facade
{      

	public function create_filter_site_copyright() 
	{
		add_filter('rmd_site_copyright', function($content){
			$rmd_setting_footer_copyright = get_option('rmd_setting_footer_copyright'); 
			if( ! empty($rmd_setting_footer_copyright )):  
				$content = $rmd_setting_footer_copyright;  
			endif;  
			return $content;
		});
	}


	public function create_filter_site_powered_by() 
	{
		add_filter('rmd_site_powered_by', function($content){
			return '<p class="powered-by" > Developed by <a href="http://blitzo.com.au/" target="_blank" >Blitzo Studio</a></p>';
		});
	}



	public function create_filter_site_logo() 
	{
		add_filter('rmd_footer_site_logo', array($this, '_create_filter_site_logo'));
	}


	public function _create_filter_site_logo($content)
	{
		$rmd_setting_site_logo = get_option('rmd_setting_site_logo'); 
		$rmd_setting_site_logo_xs = get_option('rmd_setting_site_logo_xs'); 

		ob_start(); 
    	if( ! empty($rmd_setting_site_logo) || ! empty($rmd_setting_site_logo_xs) ): 
 
    		if( ! empty($rmd_setting_site_logo)): ?>
    			<a class="site-logo hidden-xs" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img alt="<?php bloginfo('name'); ?>" src="<?php echo $rmd_setting_site_logo; ?>" class="img-responsive" >
				</a> 
    		<?php else: ?>
    			<a class="site-logo hidden-xs" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img alt="<?php bloginfo('name'); ?>" src="<?php echo $rmd_setting_site_logo_xs; ?>" class="img-responsive" >
				</a>
    		<?php endif;
    		if( ! empty($rmd_setting_site_logo_xs)): ?>
    			<a class="site-logo visible-xs-inline" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img alt="<?php bloginfo('name'); ?>" src="<?php echo $rmd_setting_site_logo_xs; ?>" class="img-responsive" >
				</a> 
    		<?php else: ?>
    			<a class="site-logo visible-xs-inline" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img alt="<?php bloginfo('name'); ?>" src="<?php echo $rmd_setting_site_logo; ?>" class="img-responsive" >
				</a>
			<?php
    		endif;  
		endif; 
 
		$content = ob_get_clean(); 

		return $content;

	}
 

}  
  

 