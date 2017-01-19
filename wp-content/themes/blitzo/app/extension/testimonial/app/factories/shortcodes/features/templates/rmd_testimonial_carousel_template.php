<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$carousel_indicator_li = '';
$carousel_content_item = '';
$have_testimonial = FALSE;
$testimonial_ctr = 0;  

$shortcode_id = 'rmd_testimonial_sh_id'.$rmd_testimonial_shortcode_id;
$carousel_testimonial_id = $post_type.'_sld_id'.$rmd_testimonial_shortcode_id; 
 
 
if ( $results->have_posts() ) :  
  	while ( $results->have_posts() ) : $results->the_post();  

       	$title = get_the_title();
		$rmd_testimonial_content = get_post_meta(get_the_ID(), 'rmd_testimonial_content', true);  
		$rmd_testimonial_image = get_post_meta(get_the_ID(), 'rmd_testimonial_image', true);  
		$rmd_testimonial_name = get_post_meta(get_the_ID(), 'rmd_testimonial_name', true);  
		$rmd_testimonial_designation = get_post_meta(get_the_ID(), 'rmd_testimonial_designation', true);   
		
		// set up the deafult active slide
		$default_active_slide = ($testimonial_ctr == 0)? 'active' : '';

		// set up the carousel indicators 
		$carousel_indicator_li .= '<li style="background-color:'.$color.'" data-target="#'.$carousel_testimonial_id.'" data-slide-to="'.$testimonial_ctr.'" class="'.$default_active_slide.'"></li>'."\n";

		$carousel_testimonial_image = '';
		if(!empty($rmd_testimonial_image)) {
			$carousel_testimonial_image = '<div class="col-sm-12"><div class="testimonial-photo-container" style="background-image:url('.$rmd_testimonial_image.')" ></div></div>';
		}  
 
		$carousel_testimonial_content = '';
		if(!empty($rmd_testimonial_content)) {
			$carousel_testimonial_content = '<p class="testimonial-content" style="color:'.$color.'">'.$rmd_testimonial_content.'</p>';
		} 

		$carousel_testimonial_name = '';
		if(!empty($rmd_testimonial_name)) {
			$carousel_testimonial_name = '<small class="testimonial-name" style="color:'.$color.'" >'.$rmd_testimonial_name.'</small>';
		} 

		$carousel_testimonial_designation = '';
		if(!empty($rmd_testimonial_designation)) {
			$carousel_testimonial_designation = '<span class="testimonial-designation" style="color:'.$color.'" ">'.$rmd_testimonial_designation.'</span>';
		} 
		
 
		$show_prev_next = strtolower($show_prev_next);
		if($show_prev_next == 'yes') {
			$responsive_class = 'col-xs-12 col-sm-10 col-md-10';
			$hide_class = '';
		} else {
			$responsive_class = 'col-xs-12';
			$hide_class = 'hide';
		}

		// set up the carousel content item
		$carousel_content_item .= '<div class="item '.$default_active_slide.'"> 
							<div class="row">
								<div class="'.$hide_class.' hidden-xs col-sm-1 col-md-1"></div>
								<div class="'.$responsive_class.'">
									<div class="content" >
										<div class="row" >  
											'.$carousel_testimonial_image.' 
											<div class="col-sm-12">
												<blockquote>
													'.$carousel_testimonial_content.'
												  	'.$carousel_testimonial_name.'
												  	'.$carousel_testimonial_designation.'
											  	</blockquote>
											</div>
										</div>
									</div>
								</div> 
							</div>  
					    </div>'."\n";
		
		$have_testimonial = TRUE;
		$testimonial_ctr++;
  	endwhile;   
endif;  

wp_reset_postdata();


if($have_testimonial):    

	$testimonial_prev_next = ''; 
	$icon_prev = '';
	$icon_next = '';
	if(!empty($show_prev_next)) {
		$show_prev_next = strtolower($show_prev_next);
		if($show_prev_next == 'yes') { 
			$icon_prev = '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>';
			$icon_next = '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
		}   
		ob_start(); ?>
			<a style="color:<?php echo $color; ?>" class="left carousel-control" href=".<?php echo $carousel_testimonial_id; ?>" role="button" data-slide="prev">
				<?php echo $icon_prev; ?>
				<span class="sr-only">Previous</span>
			</a>
			<a style="color:<?php echo $color; ?>" class="right carousel-control" href=".<?php echo $carousel_testimonial_id; ?>" role="button" data-slide="next">
				<?php echo $icon_next; ?>
				<span class="sr-only">Next</span>
			</a> 
		<?php
		$testimonial_prev_next = ob_get_clean();  
	}

	$testimonial_indicatior = ''; 
	if(!empty($show_indicator)) {
		$show_indicator = strtolower($show_indicator);
		if($show_indicator == 'yes') {
			ob_start(); ?>
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php echo $carousel_indicator_li; ?>
				</ol>
			<?php
			$testimonial_indicatior = ob_get_clean();  
		}
	}


?>
	<div id="<?php echo $shortcode_id; ?>" class="rmd-testimonial-wrapper <?php echo "$type "?>" >   
		<div class="rmd-testimonial-content-container"> 
			<div id="<?php echo $carousel_testimonial_id; ?>" class="carousel slide <?php echo $carousel_testimonial_id; ?>" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php echo do_shortcode($carousel_content_item); ?>	 
				</div> 
				<?php echo $testimonial_prev_next; ?>	
				<?php echo $testimonial_indicatior; ?>			 
			</div>
		</div>
	</div> 
<?php
endif; 

 