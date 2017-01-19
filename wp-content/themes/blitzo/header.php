<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blitzo
 */

?>  
<?php get_template_part( 'template-parts/_header' ); ?>
<?php echo apply_filters('rmd_site_banner', ''); ?>  
<div class="navbar-background"></div>
<div class="rmd-container" > <!-- For the slider purposes to hide the slider navigation. --> 
