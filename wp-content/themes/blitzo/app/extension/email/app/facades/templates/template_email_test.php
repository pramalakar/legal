<?php
use theme\rmd\core\formvalidation as Validator;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} 
?>
<form id="rmdContactForm" method="post" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>">
 
	<div id="rmdAlertContainer">

		<?php Validator\RMD_Validator_Handler::display_alert(); ?>

		<?php if(isset($submission_response)): ?> 
			<?php echo $submission_response; ?>
		<?php endif; ?>    
		
	</div>

	<div class="row">
		<div class="col-md-5" >
			<div class="form-group"> 
			    <input type="text" placeholder="Name is required..." class="form-control" id="rmd_cf_name" name="rmd_cf_name" value="<?php echo (isset($_POST['rmd_cf_name']))? esc_attr($_POST['rmd_cf_name']) : ''; ?>" >
			</div>
		</div> 
		<div class="col-md-5" >
			<div class="form-group"> 
			    <input type="text" placeholder="Email is required..." class="form-control" id="rmd_cf_email" name="rmd_cf_email" value="<?php echo (isset($_POST['rmd_cf_email']))? esc_attr($_POST['rmd_cf_email']) : ''; ?>" >
			</div> 
		</div>
		<div class="col-md-2" >
			<input type="submit" value="Send" class="btn btn-black btn-block" name="rmd_cf_submit" id="rmd_cf_submit" />
		</div>
	</div>    
	<?php wp_nonce_field($nonce_field['action'], $nonce_field['name']); ?>
</form>