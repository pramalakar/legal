<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blitzo
 */
 
// I set the loop here because there are some metabox setting that I need in the header part like for the slider.
while ( have_posts() ) : the_post();  

get_header(); 

	get_template_part( 'template-parts/_page' ); 

get_footer();

endwhile; // End of the loop.

 
