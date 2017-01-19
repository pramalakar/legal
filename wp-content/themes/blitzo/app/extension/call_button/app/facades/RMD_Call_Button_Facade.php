<?php
namespace theme\rmd\extension\call_button\app\facades;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 

class RMD_Call_Button_Facade
{        
	protected $config = array(
		'default_phone_label' => '<span style="font-size:25px;line-height:48px;" class="glyphicon glyphicon-earphone"></span>',
		'default_map_label' => '<span style="font-size:25px;line-height:48px;" class="glyphicon glyphicon-map-marker"></span>',
		'background_color' => '#272727', 
		'border_color' => '#646464',
		'text_color' => '#fff',
		'call_button_status' => 'yes', 
		);

	protected $count_enable_button = 0;
	protected $button_tag = '';


	public function create_call_button()
	{ 
		extract($this->config);

 		$rmd_setting_call_button_status = get_option('rmd_setting_call_button_status'); 
 		$rmd_setting_call_button_status = (!empty($rmd_setting_call_button_status))? $rmd_setting_call_button_status : $call_button_status;
		 

		$rmd_setting_contact_phone_number_1 = get_option('rmd_setting_contact_phone_number_1');
		if(!empty($rmd_setting_contact_phone_number_1)) {
			$rmd_setting_contact_phone_number_1_status = get_option('rmd_setting_contact_phone_number_1_status');
			
			$rmd_setting_call_button_label_1 = get_option('rmd_setting_call_button_label_1'); 
			$label = ($rmd_setting_call_button_label_1) ? $rmd_setting_call_button_label_1 : $default_phone_label; 
			$href  = "tel:$rmd_setting_contact_phone_number_1";

			if(!empty($rmd_setting_contact_phone_number_1_status)) {
				if($rmd_setting_contact_phone_number_1_status == 'yes') {
					$this->count_enable_button++; 
					$this->button_tag .= $this->create_button($href, $label);
				}
			} else {
				$this->count_enable_button++;
				$this->button_tag .= $this->create_button($href, $label);
			}
		}


		$rmd_setting_contact_phone_number_2 = get_option('rmd_setting_contact_phone_number_2');
		if(!empty($rmd_setting_contact_phone_number_2)) {
			$rmd_setting_contact_phone_number_2_status = get_option('rmd_setting_contact_phone_number_2_status');

			$rmd_setting_call_button_label_2 = get_option('rmd_setting_call_button_label_2'); 
			$label = ($rmd_setting_call_button_label_2) ? $rmd_setting_call_button_label_2 : $default_phone_label; 
			$href  = "tel:$rmd_setting_contact_phone_number_2";

			if(!empty($rmd_setting_contact_phone_number_2_status)) {
				if($rmd_setting_contact_phone_number_2_status == 'yes') {
					$this->count_enable_button++;
					$this->button_tag .= $this->create_button($href, $label);
				}
			} else {
				$this->count_enable_button++;
				$this->button_tag .= $this->create_button($href, $label);
			}
		}


		$rmd_setting_map_link = get_option('rmd_setting_map_link');
		if(!empty($rmd_setting_map_link)) {
			$rmd_setting_contact_map_status = get_option('rmd_setting_contact_map_status');

			$rmd_setting_map_button_label = get_option('rmd_setting_map_button_label'); 
			$label = ($rmd_setting_map_button_label) ? $rmd_setting_map_button_label : $default_map_label; 
			$href  = "$rmd_setting_map_link";

			if(!empty($rmd_setting_contact_map_status)) {
				if($rmd_setting_contact_map_status == 'yes') {
					$this->count_enable_button++;
					$this->button_tag .= $this->create_button($href, $label, TRUE);
				}
			} else {
				$this->count_enable_button++;
				$this->button_tag .= $this->create_button($href, $label, TRUE);
			}
		} 
   

		if( ($this->count_enable_button > 0) && ($rmd_setting_call_button_status == 'yes') ) { 

			add_action('wp_enqueue_scripts', function(){
				wp_enqueue_style('rmd-call-button-style-css'); 
			} ); 

			add_action('wp_head', array($this, '_create_color_style'));
			add_action('wp_head', array($this, '_create_custom_css'));
			add_action('wp_footer', array($this, '_create_call_button'));

		} else {
			add_action('wp_head', array($this, '_minimize_back_to_top_bottom_space_style'));
		} 
		 
	} 
 

	public function _create_custom_css() 
	{ 
		$rmd_call_button_custom_css = get_option('rmd_call_button_custom_css');  

		$stylesheet = '';
		if( !empty($rmd_call_button_custom_css)): 
			ob_start(); ?> 
			    <style type="text/css"> 
			         <?php echo $rmd_call_button_custom_css."\n"; ?>
			    </style>
			<?php 
			$stylesheet = ob_get_clean();  
			$stylesheet = trim(preg_replace('/\s+/', ' ', $stylesheet));
		endif;

		echo $stylesheet."\n";
	}


	/**
	 *	This will manage the back to top space bottom to minimize once it does not have a call button.
	 */
	public function _minimize_back_to_top_bottom_space_style() 
	{ 
		?>
		<style type="text/css"> .back-to-top { bottom: 20px; } </style> 
		<?php   
	}


	public function _create_color_style() 
	{
		extract($this->config);  


		$rmd_call_button_background_color = get_option('rmd_call_button_background_color'); 
		if( ! empty($rmd_call_button_background_color) && $rmd_call_button_background_color !== '#'){
			$this->config['background_color'] = $rmd_call_button_background_color;
		} 

		$rmd_call_button_border_color = get_option('rmd_call_button_border_color'); 
		if( ! empty($rmd_call_button_border_color) && $rmd_call_button_border_color !== '#'){
			$this->config['border_color'] = $rmd_call_button_border_color;
		} 

		$rmd_call_button_text_color = get_option('rmd_call_button_text_color'); 
		if( ! empty($rmd_call_button_text_color) && $rmd_call_button_text_color !== '#'){
			$this->config['text_color'] = $rmd_call_button_text_color;
		}   

		extract($this->config);
  		
  		$stylesheet = '';
		if($this->count_enable_button > 0): 
			$button_width = 100/$this->count_enable_button;
			$button_width = $button_width.'%';

			ob_start(); ?>
			<style type="text/css"> 
				.rmd-call-button-container { 
					background-color: <?php echo $background_color; ?> !important;  
					border-top-color: <?php echo $border_color; ?> !important; 
				}
				.rmd-call-button-container a { 
					color: <?php echo $text_color; ?> !important; 
					width:  <?php echo $button_width; ?> !important;  
					border-right-color: <?php echo $border_color; ?> !important; 
				} 
			</style> 
			<?php 
			$stylesheet = ob_get_clean();  
			$stylesheet = trim(preg_replace('/\s+/', ' ', $stylesheet));
		endif; 

		echo $stylesheet."\n";

	}


	protected function create_button($href, $label, $new_tab = FALSE)
	{ 
		$target = ($new_tab)? 'target="_blank"' : '';
		return '<a '.$target.' href="'.$href.'" >'.$label.'</a>';
	}


	public function _create_call_button() 
	{ 
		echo ($this->count_enable_button > 0)? '<div class="rmd-call-button-container visible-xs-block" >'.$this->button_tag.'</div>' : '';
	} 
		 
}  
