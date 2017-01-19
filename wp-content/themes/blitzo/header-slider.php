<?php
/**
 * The header for our theme for the Page - Slider
 *
 * This is the template that displays all of the <head> section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blitzo
 */

global $floated_class;

$rmd_setting_slider_transparent_header = get_post_meta(get_the_ID(), 'rmd_setting_slider_transparent_header', true);  
$floated_class = (!empty($rmd_setting_slider_transparent_header) && $rmd_setting_slider_transparent_header == 'yes')? 'floated': ''; 
// The floated class will make the header transparent and pull up the slider. 

?>
<?php get_template_part( 'template-parts/_header' ); ?> 
<?php echo apply_filters('rmd_site_slider', ''); ?>  
<div class="rmd-container" > <!-- For the slider purposes to hide the slider navigation. -->

