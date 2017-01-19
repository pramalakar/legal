<?php
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Color_Input - this class will manage to create color input field.
 */
/***
 *	HOW TO USE:
	
	$input_attr = array(
			'input_type'  => 'color2',
			'input_label' => 'My Extra Title',
			'input_name'  => 'my_extra_title',
			'input_value' => '',
			'input_class' => 'my-class-name',
			'input_description' => 'This is a sample description for the input'
		);
	echo RMD_Input_Handler::render($input_attr);

 *
 */ 
 
class RMD_Color2_Input extends RMD_Input 
{
	public function render()
	{	  
		$input = $this->input_attr;
 	
 		$input_color_style = '';
 		if( !empty($input['input_name']) ) {
 			$input_color_style = 'style="border:1px solid '.$input['input_value'].'; border-left-width:35px"'; 
 		}

		ob_start();  ?>
		<div class="input-container <?php echo $input['input_display']; ?>" >
		<?php if( ! empty($input['input_label'])): ?>
		<div class="label-column" >
			<label style="display:block; margin-top:5px; margin-bottom:5px" for="<?php echo $input['input_name']; ?>" ><?php echo $input['input_label']; ?></label> 
		</div>
		<?php endif;  ?>
		<div class="input-column">
			<div style="position:relative;">
				<input style="padding:5px 8px" <?php echo $input_color_style; ?> type="text" name="<?php echo $input['input_name']; ?>" id="<?php echo $input['input_name']; ?>" value="<?php echo $input['input_value']; ?>" class="<?php echo $input['input_class']; ?> rmd-color-picker-2" />
	         	<div id="<?php echo $input['input_name']; ?>_cp" class="rmd-color-picker-cp-2" style="border:1px solid rgba(200,200,200,0.5); position:absolute;left:35px;background:#fff;z-index:9999;"></div>
	        </div> 
		<?php if( ! empty($input['input_description'])): ?>
			<em style="display: block;" class="input-description"><?php echo $input['input_description']; ?></em> 
		<?php endif;  ?>
		</div>
		</div>
		<?php return ob_get_clean();
	}
}
