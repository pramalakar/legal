<?php
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Textarea_Input - this class will manage to create textarea input field.
 */
/***
 *	HOW TO USE:
	
	$input_attr = array(
			'input_type'  => 'textarea',
			'input_label' => 'My Extra Title',
			'input_name'  => 'my_extra_title',
			'input_value' => '',
			'input_class' => 'my-class-name',
			'input_description' => 'This is a sample description for the input'
		);
	echo RMD_Input_Handler::render($input_attr);

 *
 */ 
 
class RMD_Textarea_Input extends RMD_Input 
{
	public function render()
	{	 
		$input = $this->input_attr; 

		ob_start();  ?>
		<div class="input-container <?php echo $input['input_display']; ?>" >
		<?php if( ! empty($input['input_label'])): ?>
			<div class="label-column" >
				<label style="display:block; margin-top:5px; margin-bottom:5px" for="<?php echo $input['input_name']; ?>" ><?php echo $input['input_label']; ?></label> 
			</div>
		<?php endif;  ?>
		<div class="input-column">
			<textarea style="height:200px;padding:5px 8px; width:<?php echo $input['input_width']; ?>" id="<?php echo $input['input_name']; ?>" name="<?php echo $input['input_name']; ?>" class="<?php echo $input['input_class']; ?>"><?php echo $input['input_value']; ?></textarea>
			<?php if( ! empty($input['input_description'])): ?>
				<em style="display: block;" class="input-description"><?php echo $input['input_description']; ?></em> 
			<?php endif;  ?>
		</div>
		</div>
		<?php return ob_get_clean();  
	}
}
