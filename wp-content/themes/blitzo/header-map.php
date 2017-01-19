<?php
/**
 * The header for our theme for the Page - Google Map
 *
 * This is the template that displays all of the <head> section.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blitzo
 */

global $floated_class;

$rmd_setting_google_map_transparent_header = get_option('rmd_setting_google_map_transparent_header'); 
$floated_class = (!empty($rmd_setting_google_map_transparent_header) && $rmd_setting_google_map_transparent_header == 'yes')? 'floated': ''; 
// The floated class will make the header transparent and pull up the map.

?>
<?php get_template_part( 'template-parts/_header' ); ?>
<?php echo apply_filters('rmd_site_google_map', ''); ?>  
<div class="rmd-container" > <!-- For the slider purposes to hide the slider navigation. -->

