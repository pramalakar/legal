<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blitzo
 */

?>

<footer class="footer-wrapper" > 
	<?php
		$rmd_setting_footer_widget_column = get_option('rmd_setting_footer_widget_column');
		$rmd_setting_footer_widget_column = (!empty($rmd_setting_footer_widget_column))? $rmd_setting_footer_widget_column : 'four';
		 
		$responsive_class_fw1 = '';
		$responsive_class_fw2 = '';
		$responsive_class_fw3 = '';
		$responsive_class_fw4 = '';

		switch ($rmd_setting_footer_widget_column) {
			case 'four':
			default:
				$responsive_class_fw1 = 'col-md-3';
				$responsive_class_fw2 = 'col-md-3';
				$responsive_class_fw3 = 'col-md-3';
				$responsive_class_fw4 = 'col-md-3';
				break;
			case 'three': 
				$responsive_class_fw1 = 'col-md-4';
				$responsive_class_fw2 = 'col-md-4';
				$responsive_class_fw3 = 'col-md-4'; 
				break;
			case 'two': 
				$responsive_class_fw1 = 'col-md-6';
				$responsive_class_fw2 = 'col-md-6'; 
				break;
			case 'one': 
				$responsive_class_fw1 = 'col-md-12';  
				break;
			case '123': 
				$responsive_class_fw1 = 'col-md-4';
				$responsive_class_fw2 = 'col-md-8'; 
				break;
			case '213': 
				$responsive_class_fw1 = 'col-md-8';
				$responsive_class_fw2 = 'col-md-4'; 
				break;
			case '134': 
				$responsive_class_fw1 = 'col-md-3';
				$responsive_class_fw2 = 'col-md-9'; 
				break;
			case '314': 
				$responsive_class_fw1 = 'col-md-9';
				$responsive_class_fw2 = 'col-md-3'; 
				break;
		}
	?>
	<?php if ( is_active_sidebar( 'footer-widget-1' )
			|| is_active_sidebar( 'footer-widget-2' ) 
			|| is_active_sidebar( 'footer-widget-3' ) 
			|| is_active_sidebar( 'footer-widget-4' )): ?>

	<div class="footer-inner-widget-wrapper" >
		<div class="container" >
			<div class="row"> 
				<div class="<?php echo $responsive_class_fw1; ?>" >    
					<?php if ( is_active_sidebar( 'footer-widget-1' ) ): ?>
						<aside class="widget-area" role="complementary">
							<?php dynamic_sidebar( 'footer-widget-1' ); ?>
						</aside><!-- #secondary -->
					<?php endif; ?>
				</div>  
				<?php if($rmd_setting_footer_widget_column == 'four'
					|| $rmd_setting_footer_widget_column == 'three'
					|| $rmd_setting_footer_widget_column == 'two'
					|| $rmd_setting_footer_widget_column == '123'
					|| $rmd_setting_footer_widget_column == '213'
					|| $rmd_setting_footer_widget_column == '134'
					|| $rmd_setting_footer_widget_column == '314'
					): ?>
					<div class="<?php echo $responsive_class_fw2; ?>" > 
						<?php if ( is_active_sidebar( 'footer-widget-2' ) ): ?>
							<aside class="widget-area" role="complementary">
								<?php dynamic_sidebar( 'footer-widget-2' ); ?>
							</aside><!-- #secondary -->
						<?php endif; ?>
					</div> 
				<?php endif; ?>
				<?php if($rmd_setting_footer_widget_column == 'four'
					|| $rmd_setting_footer_widget_column == 'three'
					): ?>
					<div class="<?php echo $responsive_class_fw3; ?>" > 
						<?php if ( is_active_sidebar( 'footer-widget-3' ) ): ?>
							<aside class="widget-area" role="complementary">
								<?php dynamic_sidebar( 'footer-widget-3' ); ?>
							</aside><!-- #secondary -->
						<?php endif; ?>
					</div> 
				<?php endif; ?>
				<?php if($rmd_setting_footer_widget_column == 'four'): ?>
					<div class="<?php echo $responsive_class_fw4; ?>" > 
						<?php if ( is_active_sidebar( 'footer-widget-4' ) ): ?>
							<aside class="widget-area" role="complementary">
								<?php dynamic_sidebar( 'footer-widget-4' ); ?>
							</aside><!-- #secondary -->
						<?php endif; ?>
					</div> 
				<?php endif; ?>
			</div> 
		</div> 
	</div>   
	<?php endif; ?> 
	<div class="footer-inner-copyright-wrapper" >
		<div class="container" >
			<div class="footer-copyright-container">
				<div class="row"> 
					<div class="col-md-6 text-left" >
						<?php echo '<p class="copyright">'.apply_filters('rmd_site_copyright', '&copy;  '.get_bloginfo('name').'. All rights reserved. ').' Legal Practice Intelligence | www.legalpracticeintelligence.com.au</p>'; ?>  
					</div>
					<div class="col-md-6 text-right" >
						<?php echo apply_filters('rmd_site_powered_by', ''); ?>  
					</div>
				<!-- 	<div class="col-md-12 text-center" >
						<?php echo apply_filters('rmd_footer_social_media', ''); ?>
					</div> -->
					<!-- <div class="col-md-12 text-center" > 
						<?php echo apply_filters('rmd_site_powered_by', ''); ?>  
					</div>  -->
				</div> 
			</div>
		</div> 
	</div>

</footer> 
 
</div><!-- /.rmd-container -->

<div class="back-to-top">
   <span class="arrow glyphicon glyphicon-menu-up"></span>
</div> 

<?php wp_footer(); ?> 
 
</body>
</html>

