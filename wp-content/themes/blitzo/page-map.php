<?php
/**
 * Template Name: Page - Google Map
 *
 * @package Blitzo
 */
 
// I set the loop here because there are some metabox setting that I need in the header part like for the slider.
while ( have_posts() ) : the_post();  

get_header('map');  
  
	get_template_part( 'template-parts/_page' );  

get_footer();

endwhile; // End of the loop.