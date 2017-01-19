<?php
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Color2_Input - this class will manage to create color input field.
 */
/***
 *	HOW TO USE:
	
	$input_attr = array(
			'input_type'  => 'color',
			'input_label' => 'My Extra Title',
			'input_name'  => 'my_extra_title',
			'input_value' => '',
			'input_default' => '#ffffff', // this is use to set a default value to be set by the default button
			'input_class' => 'my-class-name',
			'input_description' => 'This is a sample description for the input'
		);
	echo RMD_Input_Handler::render($input_attr);

 *
 */ 

 
class RMD_Color_Input extends RMD_Input 
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
			<div style="position:relative;">
				<div class="form-field"> 
		            <input style="width:100px" data-std="<?php echo $input['input_default']; ?>" id="<?php echo $input['input_name']; ?>"  name="<?php echo $input['input_name']; ?>" type="text" value="<?php echo $input['input_value']; ?>" class="<?php echo $input['input_class']; ?> rmd-color-picker" />
		        </div>
			</div> 
			<?php if( ! empty($input['input_description'])): ?>
				<em style="display: block;" class="input-description"><?php echo $input['input_description']; ?></em> 
			<?php endif;  ?>
		</div>
		</div>
		<?php return ob_get_clean(); 
	} 

}
 