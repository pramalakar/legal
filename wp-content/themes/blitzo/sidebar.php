<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blitzo
 */

global $post;
?> 
<?php
if(!empty($post)):
	$widget_sidebar = get_post_meta($post->ID, 'rmd_page_option_widget_sidebar', true); 
	$widget_sidebar = (!empty($widget_sidebar))? $widget_sidebar : 'sidebar'; ?> 
	<?php if ( is_active_sidebar( $widget_sidebar ) ): ?>
		<aside class="widget-area" role="complementary">
			<?php dynamic_sidebar( $widget_sidebar ); ?>
		</aside>
	<?php endif; ?> 
<?php else: ?> 
	<?php if ( is_active_sidebar( 'sidebar' ) ): ?>
		<aside class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</aside>
	<?php endif; ?>
<?php endif;  
 