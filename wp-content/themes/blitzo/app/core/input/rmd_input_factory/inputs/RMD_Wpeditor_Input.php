<?php
namespace theme\rmd\core\input;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	RMD_Wpeditor_Input - this class will manage to create wp editor field.
 */
/***
 *	HOW TO USE:
	
	$input_attr = array(
			'input_type'  => 'wpeditor',
			'input_label' => 'My Extra Title',
			'input_name'  => 'my_extra_title',
			'input_value' => '',
			'input_class' => 'my-class-name',
			'input_description' => 'This is a sample description for the input'
		);
	echo RMD_Input_Handler::render($input_attr);

 *
 */ 
 
class RMD_Wpeditor_Input extends RMD_Input 
{
	public function render()
	{	 
		$input = $this->input_attr;
 		
 		$value = trim($input['input_value']);
 		$cur_value = ( !empty($value) )? $value : $input['input_default'];
 		
		ob_start();  ?>
		<div class="input-container <?php echo $input['input_display']; ?>" >
		<?php if( ! empty($input['input_label'])): ?>
			<div class="label-column" >
				<label style="display:block; margin-top:5px; margin-bottom:5px" for="<?php echo $input['input_name']; ?>" ><?php echo $input['input_label']; ?></label> 
			</div>
		<?php endif;  ?>  
		<div class="input-column" >
			<style type="text/css">
				#wp-<?php echo $input['input_name']; ?>-wrap iframe,
				#wp-<?php echo $input['input_name']; ?>-wrap textarea {
					width: <?php echo $input['input_width']; ?>; 
				}  
			</style>
			<?php
				// wp_editor( $content, $editor_id, $settings = array() );
				// https://codex.wordpress.org/Function_Reference/wp_editor
				wp_editor( htmlspecialchars_decode($cur_value), $input['input_name'], $input['input_wpeditor_settings']);
			?>

			<?php if( ! empty($input['input_description'])): ?>
				<em style="display: block;" class="input-description"><?php echo $input['input_description']; ?></em> 
			<?php endif;  ?>
		</div>
		</div>
		<?php return ob_get_clean(); 
	}
}


