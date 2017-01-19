<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
$slider_indicator_li = '';
$slider_content_item = ''; 

$have_slider = FALSE;  
$num_slide = 0;

// This is the data from the shortcode
// we extrated it so that we can easily retrieve the setting.
extract($attr);

$slider_type = (!empty($slider_type))? $slider_type : 'fixed';

if ( $results->have_posts() ) : 

  	while ( $results->have_posts() ) : $results->the_post();  

  		$name = get_the_title();
  		
   		$rmd_slider_image = get_post_meta(get_the_ID(), 'rmd_slider_image', true); 
		$rmd_slider_image = trim($rmd_slider_image);

		$rmd_slider_caption_title = get_post_meta(get_the_ID(), 'rmd_slider_caption_title', true);  
		$rmd_slider_caption_title = trim($rmd_slider_caption_title);

		$rmd_slider_caption_content = get_post_meta(get_the_ID(), 'rmd_slider_caption_content', true);   
		$rmd_slider_caption_content = trim($rmd_slider_caption_content); 

		$rmd_slider_caption_alignment = get_post_meta(get_the_ID(), 'rmd_slider_caption_alignment', true);
		$rmd_slider_caption_alignment = (!empty($rmd_slider_caption_alignment))? $rmd_slider_caption_alignment : 'left'; 

		$rmd_slider_button_label = get_post_meta(get_the_ID(), 'rmd_slider_button_label', true); 
		$rmd_slider_button_label = trim($rmd_slider_button_label); 

		$rmd_slider_button_link = get_post_meta(get_the_ID(), 'rmd_slider_button_link', true);   
		$rmd_slider_button_link = trim($rmd_slider_button_link);

 
		if( !empty($rmd_slider_image)) { 

			// set up the deafult active slide
			$default_active_slide = ($num_slide == 0)? 'active' : '';

			// set up the carousel indicators 
			$slider_indicator_li .= '<li data-target="#'.$post_type.'" data-slide-to="'.$num_slide.'" class="'.$default_active_slide.'"></li>'."\n";

			// Full Screen - the image will be serve as a background image. 
			$slider_photo = '<img class="slider-img" src="'.$rmd_slider_image.'" alt="'.$name.'">';
			
			$slider_caption = '';
			if( $rmd_slider_caption_title == '' && $rmd_slider_caption_content == '' && $rmd_slider_button_link == '' ) {
				$slider_caption = '';
			} else {
  
				$rmd_slider_caption_title = $rmd_slider_caption_title ? '<div  class="caption-title">'.$rmd_slider_caption_title.'</div>' : '';
				 
				$rmd_slider_caption_content = $rmd_slider_caption_content ? '<div class="caption-content">'.$rmd_slider_caption_content.'</div>' : '';

				if( $rmd_slider_button_label == '' || $rmd_slider_button_link == '') {
					$slider_button = '';
				} else { 
					$slider_button = '<div class="caption-button-container"><a href="'.$rmd_slider_button_link.'"><div class="caption-button">'.$rmd_slider_button_label.'</div></a></div>';
				}

				$caption_hidden_classes = ''; //($slider_type == 'full-screen') ? '' : 'hidden-xs hidden-sm';
 
				// The slider caption # 2, is use for occupying space since the #1 has a position absolute style.
				$slider_caption = '<div class="carousel-caption-container '.$caption_hidden_classes.'">
						<div class="carousel-caption '.$rmd_slider_caption_alignment.'">
							'.$rmd_slider_caption_title.'
							'.$rmd_slider_caption_content.'
							'.$slider_button.'
						</div> 
					</div>';
			}

			// set up the carousel content item

			$background_image_style = ($slider_type == 'cover')? 'style="background-image:url('.$rmd_slider_image.')"' : '';

			$overlay_style = 'style="background-color:'.$slider_overlay_bgcolor.';opacity:'.$slider_overlay_opacity.'"';

			$slider_content_item .= '<div class="item '.$default_active_slide.'">  
					<div class="slider-image" '.$background_image_style.' >'.$slider_photo.'</div>
					<div '.$overlay_style.' class="slider-overlay" ></div> 
					'.do_shortcode($slider_caption).'
				</div>';

			$num_slide++;
			$have_slider = TRUE; 
			
		}     

  	endwhile;   
endif;  

wp_reset_postdata();


if($have_slider):   
  	
  	$slider_indicator_status = (!empty($slider_indicator_status))? $slider_indicator_status : 'yes';
  	$slider_navigation_status = (!empty($slider_navigation_status))? $slider_navigation_status : 'yes';

  	$slider_bgcolor_style = '';
  	if(!empty($slider_bgcolor)) {
  		$slider_bgcolor_style = 'style="background-color:'.$slider_bgcolor.'"';
  	}
  	
?>
	<div <?php echo $slider_bgcolor_style; ?> class="rmd-slider-wrapper <?php echo $slider_type; ?> <?php echo 'n'.$num_slide; ?>" >   
		<div class="container-fluid" >
			<div class="rmd-slider-container" >
				<div id="<?php echo $post_type; ?>" class="carousel slide <?php echo $transition_type; ?> <?php echo $post_type; ?>" data-ride="carousel">
					<!-- Indicators -->
					<?php if($slider_indicator_status == 'yes'): ?>
					<ol class="carousel-indicators">
						<?php echo $slider_indicator_li; ?>
					</ol>
					<?php endif; ?>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<?php echo $slider_content_item; ?>	 
					</div>
		 			
		 			<?php if($slider_navigation_status == 'yes'): ?>
						<?php if($num_slide > 1): ?>
						<!-- Left and right controls -->
						<a class="left carousel-control <?php echo $slider_type; ?>" href=".<?php echo $post_type; ?>" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href=".<?php echo $post_type; ?>" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
						<?php endif; ?> 
					<?php endif; ?>
				</div><!-- /.carousel -->
			</div>
		</div>
	</div>   
<?php else: ?>
	<div class="navbar-background" ></div>
<?php endif; 
