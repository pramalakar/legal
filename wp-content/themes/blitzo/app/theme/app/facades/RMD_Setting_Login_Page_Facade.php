<?php
namespace theme\rmd\theme\app\facades;

use theme\rmd\core\adminpage as Adminpage;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Setting_Login_Page_Facade
{      
	protected $site_logo = '';


	public function create_setting()
	{   
 		$rmd_setting_login_site_logo = get_option('rmd_setting_login_site_logo');  
		$rmd_setting_login_site_logo_xs = get_option('rmd_setting_login_site_logo_xs'); 
 
		if( !empty($rmd_setting_login_site_logo) ) {
			$this->site_logo = $rmd_setting_login_site_logo;
		} else {
			$this->site_logo = $rmd_setting_login_site_logo_xs;
		} 

		$this->_create_setting(); 
 
		add_action('login_head', array($this, '_create_login_page_logo_style'));
		add_action('login_footer', array($this, '_create_login_page_logo_script'));
		   
	}


	protected function _create_setting()
	{
		$inputs_config = array(
			$this->_get_config() 
			);  
		
		$config = array(
			'tag_title'  		=> 'Login Page Setting',
			'menu_title'		=> 'Login Page', 
			'page_title' 		=> 'Login Page Setting',
			'menu_slug'			=> 'rmd-login-page-setting',  
			'inputs' 			=> $inputs_config,
			'parent_slug'		=> 'rmd-theme-setting', 
		);

		$adminpage_type = 'submenu'; 
		Adminpage\RMD_Adminpage_Handler::render($adminpage_type, $config);
 
	}


  	public function _create_login_page_logo_script() 
	{ 
		$site_url = get_bloginfo('url'); 
		$site_name = get_bloginfo('name');

		ob_start(); ?> 
		<script type="text/javascript">
			(function($){
				var link = $('.login').find('h1').find('a'); 
				link.attr('href','<?php echo $site_url; ?>');
				link.attr('title','<?php echo $site_name; ?>');
			})(jQuery);
		</script> 
		<?php
		$script = ob_get_clean();  
		//$script = trim(preg_replace('/\s+/', ' ', $script)); 
		echo $script."\n"; 
	}


	public function _create_login_page_logo_style() 
	{   
		$rmd_setting_login_bgcolor = get_option('rmd_setting_login_bgcolor'); 
		$rmd_setting_login_textcolor = get_option('rmd_setting_login_textcolor');   

		$site_logo = $this->site_logo;
		$site_name = get_bloginfo('name'); 

		$site_logo_name_style = '';
		if( !empty($site_logo) ) {
			$site_logo_name_style = '.login h1 a {
				background-image: url('.$site_logo.');
				background-size: auto 100% !important;
				height: 84px; 
				max-width:320px;
				width:100%;
			}';

		} else {
			if( !empty($site_name) ) {
				$site_logo_name_style = '.login h1 a {
					background-image: none;
					height: auto;
					text-indent: 0px;
					font-size: 30px; 
					color: '.$rmd_setting_login_textcolor.';
				}';
			} 
		}

		$body_style = (!empty($rmd_setting_login_bgcolor))? $rmd_setting_login_bgcolor : '';
		$body_style = (!empty($body_style))? 'body { background-color: '.$body_style.'; }' : '';

		$text_style = (!empty($rmd_setting_login_textcolor))? $rmd_setting_login_textcolor : '';
		$text_style = (!empty($text_style))? '.login #backtoblog a, .login #nav a  { color: '.$rmd_setting_login_textcolor.'; } ' : '';


		ob_start(); ?> 
		<style type="text/css"> 
			<?php echo $body_style; ?>
			<?php echo $text_style; ?>

			.login h1 {    
			    width: 100vw; 
			    position: relative;
			    left:-50vw;
			    margin-left: 50%;
			    display: flex;
			    align-items: center;
			    justify-content: center; 
			    padding:0px 30px;
			    box-sizing:border-box;
			} 

			.login h1 a {     
			    font-weight: bold; 
			    width: auto; 
			    margin:0px auto;
			} 

			.login #login_error, .login .message {
			    margin-top:15px;
			}

			.login form {
				background-color: #fff;
				-webkit-box-shadow: 0px 1px 7px 0px rgba(0,0,0,0.5);
				-moz-box-shadow: 0px 1px 7px 0px rgba(0,0,0,0.5);
				box-shadow: 0px 1px 7px 0px rgba(0,0,0,0.5); 
				box-sizing: border-box;
			} 
			
			<?php echo $site_logo_name_style; ?> 
		</style>
		<?php 
		$stylesheet = ob_get_clean();  
		$stylesheet = trim(preg_replace('/\s+/', ' ', $stylesheet));

		echo $stylesheet."\n";  

	}



	protected function _get_config()
	{
		return array(
			'section_title' => '',
			'section_description' => '',
			'inputs' => array( 
				array(
					'input_type'  => 'mediauploader',
					'input_label' => 'Site Logo',
					'input_name'  => 'rmd_setting_login_site_logo',
					'input_media_caption' => array('upload'=>'Please Upload Image','remove'=>'Please Remove Image'),
					'input_media_modal_heading' => 'Insert Image',
					'input_media_modal_button' => 'Set it now'
				),
				array(
					'input_type'  => 'mediauploader',
					'input_label' => 'Site Logo for small devices',
					'input_name'  => 'rmd_setting_login_site_logo_xs',
					'input_media_caption' => array('upload'=>'Please Upload Image','remove'=>'Please Remove Image'),
					'input_media_modal_heading' => 'Insert Image',
					'input_media_modal_button' => 'Set it now'
				),
				array(
					'input_type'  => 'color',
					'input_label' => 'Background Color',
					'input_name'  => 'rmd_setting_login_bgcolor',
					'input_value' => '',
					'input_class' => 'widefat',
					'input_description' => '', 
				),
				array(
					'input_type'  => 'color',
					'input_label' => 'Text Color',
					'input_name'  => 'rmd_setting_login_textcolor',
					'input_value' => '',
					'input_class' => 'widefat',
					'input_description' => '', 
				),
			)
		);
	} 

 
}  
  

 