<?php 
/**
* Created By: Prakash Malakar
* Date: 03/01/2017
* Time: 2:10 PM
*/

function d_directory_options_mb( $post ){
	$directory_data		=	get_post_meta( $post->ID, 'directory_data', true );

	if(!$directory_data ){
		$directory_data			=	array(
			'businessname'		=>	'',
			'state'				=>	'NSW',
			'category'			=>	'',
			'phone'				=>	'',
			'email'				=>	'',
			'website'			=>	''
		);
	}
?>


<div class="form-group">
	<label>Business Name</label>
	<input type="text" class="form-control" name="d_inputBusinessName" value="<?php echo $directory_data['businessname']; ?>">
</div>
<div class="form-group">
	<label>State</label>
	<input type="text" class="form-control" name="d_inputState" value="<?php echo $directory_data['state']; ?>">
</div>
<div class="form-group">
	<label>Category</label>
	<input type="text" class="form-control" name="d_inputCategory" value="<?php echo $directory_data['category']; ?>">
</div>
<div class="form-group">
	<label>Phone</label>
	<input type="text" class="form-control" name="d_inputPhone" value="<?php echo $directory_data['phone']; ?>">
</div>
<div class="form-group">
	<label>Email</label>
	<input type="text" class="form-control" name="d_inputEmail" value="<?php echo $directory_data['email']; ?>">
</div>
<div class="form-group">
	<label>Website</label>
	<input type="text" class="form-control" name="d_inputWebsite" value="<?php echo $directory_data['website']; ?>">
</div>

<?php
}





