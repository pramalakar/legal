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
			'input_type'  => 'dropdown',
			'input_label' => 'My Extra Title',
			'input_name'  => 'my_extra_title',
			'input_value' => '',
			'input_class' => 'my-class-name',
			'input_description' => 'This is a sample description for the input',
			'input_option' => array(
				'option_value_1' => 'Option Label 1',
				'option_value_2' => 'Option Label 2'
			) // you can still use the input_data
		);
	echo RMD_Input_Handler::render($input_attr);

 *
 */ 

 
class RMD_Dropdown_Input extends RMD_Input 
{
	public function render()
	{	 
		$input = $this->input_attr; 
 		$options = (!empty($input['input_option']))? $input['input_option'] : $input['input_data'];

 		$option_str = '';

 		foreach ( $options as $option_value => $option_label) {
 			$selected = ($input['input_value'] == $option_value)? 'selected' : ''; 
 			$option_str .= '<option '.$selected.' value="'.$option_value.'" >'.$option_label.'</option>';
 		}

		ob_start();  ?>
		<div class="input-container <?php echo $input['input_display']; ?>" >
		<?php if( ! empty($input['input_label'])): ?>
			<div class="label-column" >
				<label style="display:block; margin-top:5px; margin-bottom:5px" for="<?php echo $input['input_name']; ?>" ><?php echo $input['input_label']; ?></label> 
			</div>
		<?php endif;  ?>
		<div class="input-column">
			<select style="height:32px;padding:0px 5px; width:<?php echo $input['input_width']; ?>" id="<?php echo $input['input_name']; ?>" name="<?php echo $input['input_name']; ?>" class="<?php echo $input['input_class']; ?>"> <?php echo $option_str; ?> </select>
			<?php if( ! empty($input['input_description'])): ?>
				<em style="display: block;" class="input-description"><?php echo $input['input_description']; ?></em> 
			<?php endif;  ?>
			</div>
		</div>
		<?php return ob_get_clean();
	}
}
 