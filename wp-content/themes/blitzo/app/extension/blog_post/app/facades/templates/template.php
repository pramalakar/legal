<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$have_result = FALSE;
$col_tag = '';

if ( $results->have_posts() ) :   
  while ( $results->have_posts() ) : $results->the_post();  
		
		$post_title = get_the_title(); 
		$featured_image = get_the_post_thumbnail( get_the_ID(), 'large', array( 'alt' => $post_title ) );
       	$featured_image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
       	
       	$featured_image_style = '';
       	if(!empty($featured_image_url)) {
       		$featured_image_style = 'style="background-image:url('.$featured_image_url.');"';
       	}
 		 
		$responsive_classes = RMD_Resposive_Helper::get_column_classes( $new_column );

       	$col_tag .= '<div class="'.$responsive_classes.'" > 
			 	<div class="latest-post-container col-num-'.$new_column.'"> 
			 		<a href="'.get_the_permalink().'" >
			 			<div class="hidden-xs featured-image" '.$featured_image_style.' > </div>
			 			<div class="visible-xs-block featured-image-xs text-center" >'.$featured_image.'</div>
			 		</a>
			 		<a href="'.get_the_permalink().'" ><div class="post-title" >'.$post_title.'</div></a>
			 		<div class="post-content" >'.get_the_excerpt().'</div>
			 		<a class="read-more-link" href="'.get_the_permalink().'" >Read More &nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
			 		<div class="date-posted" >'.get_the_date('M d, Y').'</div>
			 	</div> 
		 </div>';

		$have_result = TRUE;

  endwhile;   
endif;  

wp_reset_postdata();  

?>
<?php if($have_result): ?>
	<div class="latest-post-wrapper">  
		<div class="row" ><?php echo $col_tag; ?></div> 
	</div>
<?php endif; ?>
