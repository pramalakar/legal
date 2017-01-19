<?php
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Dropdown_Input - this class will manage to create dropdown input field.
 */
/***
 *	HOW TO USE:
	
	$input_attr = array(
			input_type'  => 'themecolor',
			'input_label' => 'Theme Color',
			'input_name'  => 'rmd_setting_theme_color',
			'input_value' => '',
			'input_class' => '',
			'input_option' => array(
				'rmd-theme-color-1-css' => array('#0f202e','#354a55','#ed1c24','#ffffff', '#485c67'),
				'value2' => array('green','yellow','red'),
				'value3' => array('red','blue','yellow'),
				),
			'input_description' => ''
		);
	echo RMD_Input_Handler::render($input_attr);

 *
 */
  
class RMD_Themecolor_Input extends RMD_Input 
{
	public function render()
	{	 
		$input = $this->input_attr; 
 		$options = (!empty($input['input_option']))? $input['input_option'] : $input['input_data'];

 		$option_tag = ''; 
 		$option_ctr = 1;
 		foreach ( $options as $option_value => $option_colors) {
 			$checked = ($input['input_value'] == $option_value)? 'checked' : ''; 
 			 
			$colors_tag = '';	
			foreach ($option_colors as $key => $color) {
				$colors_tag .= '<div style="background-color:'.$color.'" class="theme-color"></div>';
			}

			$id = 'id'.$option_ctr.$input['input_name'];

			$option_tag .= '<label class="theme-color-label" for="'.$id.'" >
 					<input '.$checked.' type="radio" id="'.$id.'" name="'.$input['input_name'].'" value="'.$option_value.'" /> 
					<div class="theme-color-container">'.$colors_tag.'</div>
				</label>';

			$option_ctr++;
 		}

		ob_start();  ?>
		<div class="input-container <?php echo $input['input_display']; ?>" style="width:<?php echo $input['input_width']; ?>" >
			<?php if( ! empty($input['input_label'])): ?>
				<div class="label-column" >
					<label style="display:block; margin-top:5px; margin-bottom:5px" for="<?php echo $input['input_name']; ?>" ><?php echo $input['input_label']; ?></label> 
				</div>
			<?php endif;  ?>
			<div class="input-column">
				<?php echo $option_tag; ?>
				<?php if( ! empty($input['input_description'])): ?>
					<em style="display: block;" class="input-description"><?php echo $input['input_description']; ?></em> 
				<?php endif;  ?>
			</div>  
		</div>
		<?php return ob_get_clean();
	}
}
 