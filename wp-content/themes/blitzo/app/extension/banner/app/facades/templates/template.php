<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$overlay_style = '';
$overlay_style .= (!empty($overlay_color))? 'background-color:'.$overlay_color.';' : ''; 
$overlay_style .= (!empty($overlay_transparency))? 'opacity:'.$overlay_transparency.';' : 'opacity:0;';

if(!empty($overlay_style)) {
	$overlay_style = ' style="'.$overlay_style.'"';
}

?>
<div class="rmd-banner-wrapper" style="background-image:url(<?php echo $image; ?>)"> 
	<div class="rmd-background-fluid" <?php echo $overlay_style; ?> ></div>
	<?php if(!empty($text_content)): ?>
	<div class="rmd-text-content-container" >
		<div class="rmd-text-content" >
			<?php echo do_shortcode($text_content); ?>
		</div>
	</div>
	<?php endif; ?>
</div> 
