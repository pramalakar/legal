<?php
namespace theme\rmd\theme\app\facades;
 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Header_Facade
{      

	public function create_filter_site_logo()
	{
		add_filter('rmd_site_logo', array($this, '_create_filter_site_logo'));
	}

	public function _create_filter_site_logo()
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
		else: 
		?>
			<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<h1><?php bloginfo( 'name' ); ?></h1>  
			</a>
		<?php
		endif; 
 
		return ob_get_clean(); 

	}


	public function create_filter_site_favicon()
	{  
		add_filter('rmd_site_favicon', function($content){
			$rmd_setting_site_favicon = get_option('rmd_setting_site_favicon'); 
			if( ! empty($rmd_setting_site_favicon )):  
				$content =  $rmd_setting_site_favicon;  
			endif;  
			return $content;
		});  
	}
 

}  
  

 