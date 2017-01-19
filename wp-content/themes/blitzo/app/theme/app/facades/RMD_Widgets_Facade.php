<?php
namespace theme\rmd\theme\app\facades;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Widgets_Facade 
{     

 	public function create_site_logo_widget()
 	{
 		/* Site Logo Widget */
		add_action('widgets_init', function(){
			$target_class = "\\theme\\rmd\\theme\\app\\facades\\RMD_Site_Logo_Widget"; 
			register_widget($target_class);
		});
 	}


	public function create_side_navmenu_widget_area() 
	{
		add_action('widgets_init',function(){
			register_sidebar( array(
				'name'          => esc_html__( 'Side Navmenu Widget', 'blitzo' ),
				'id'            => 'side_navmenu_widget',
				'description'   => esc_html__( 'Add widgets here.', 'blitzo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		} );  
	}



	public function create_header_top_left_widget_area() 
	{
		add_action('widgets_init',function(){
			register_sidebar( array(
				'name'          => esc_html__( 'Header Top - Left Widget', 'blitzo' ),
				'id'            => 'heade_top_left_widget',
				'description'   => esc_html__( 'Add widgets here.', 'blitzo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) ); 
		});
	}


	public function create_header_top_right_widget_area() 
	{
		add_action('widgets_init',function(){
			register_sidebar( array(
				'name'          => esc_html__( 'Header Top - Right Widget', 'blitzo' ),
				'id'            => 'heade_top_right_widget',
				'description'   => esc_html__( 'Add widgets here.', 'blitzo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		});
	}
  


	public function create_sidebar_widget_area() 
	{
		add_action('widgets_init',function(){
			register_sidebar( array(
				'name'          => esc_html__( 'Sidebar', 'blitzo' ),
				'id'            => 'sidebar',
				'description'   => esc_html__( 'Add widgets here.', 'blitzo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		}); 
	}


	public function create_footer_1_widget_area() 
	{ 
		add_action('widgets_init',function(){
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Widget 1', 'blitzo' ),
				'id'            => 'footer-widget-1',
				'description'   => esc_html__( 'Add widgets here.', 'blitzo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		});
	}


	public function create_footer_2_widget_area() 
	{  
		add_action('widgets_init',function(){
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Widget 2', 'blitzo' ),
				'id'            => 'footer-widget-2',
				'description'   => esc_html__( 'Add widgets here.', 'blitzo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) ); 
		});
	}


	public function create_footer_3_widget_area() 
	{  
		add_action('widgets_init',function(){
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Widget 3', 'blitzo' ),
				'id'            => 'footer-widget-3',
				'description'   => esc_html__( 'Add widgets here.', 'blitzo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) ); 
		});
	}


	public function create_footer_4_widget_area() 
	{  
		add_action('widgets_init',function(){
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Widget 4', 'blitzo' ),
				'id'            => 'footer-widget-4',
				'description'   => esc_html__( 'Add widgets here.', 'blitzo' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			) );
		});
	} 
		 
}
	  
 


class RMD_Site_Logo_Widget extends \WP_Widget  
{
	 
	public function __construct() 
	{ 
		$widget_options = array(
			'classname'   => 'rmd-widget-site-logo', // for css
			'description' => 'This will display the site logo.'
			);
		parent::__construct( 'rmd_site_logo', 'Blitzo - Site Logo', $widget_options ); 

	}


	public function form($instance) 
	{
		$default = array(
			'rmd_site_logo_title' => '',
			'rmd_site_logo_alignment' => 'text-left',  
			);
		$instance = wp_parse_args( (array) $instance, $default);

		$rmd_site_logo_title = $instance['rmd_site_logo_title'];
		$rmd_site_logo_alignment = $instance['rmd_site_logo_alignment']; 

		?>
		<!-- <p><label for="<?php //echo $this->get_field_name('rmd_site_logo_title'); ?>">Title</label>
		<input type="text" class="widefat" name="<?php //echo $this->get_field_name('rmd_site_logo_title'); ?>"  value="<?php //echo $rmd_site_logo_title; ?>" />
		</p> -->
		<p><label for="<?php echo $this->get_field_name('rmd_site_logo_alignment'); ?>">Alignment</label>
			<select class="widefat" name="<?php echo $this->get_field_name('rmd_site_logo_alignment'); ?>" >
				<option <?php echo ($rmd_site_logo_alignment == 'text-left')? 'selected' : '';?> value="text-left" >Left</option>
				<option <?php echo ($rmd_site_logo_alignment == 'text-center')? 'selected' : '';?> value="text-center" >Center</option>
				<option <?php echo ($rmd_site_logo_alignment == 'text-right')? 'selected' : '';?> value="text-right" >Right</option>
			</select> 
		</p> 
		<?php
	}


	public function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['rmd_site_logo_title'] = $new_instance['rmd_site_logo_title']; 
		$instance['rmd_site_logo_alignment'] = $new_instance['rmd_site_logo_alignment']; 
		return $instance;
	}


	public function widget($args, $instance) 
	{	
		extract($args);

		$title = apply_filters('widget_title',$instance['rmd_site_logo_title']);  
		$rmd_setting_site_logo = get_option('rmd_setting_site_logo'); 
		$rmd_setting_site_logo_xs = get_option('rmd_setting_site_logo_xs'); 

		$alignment = (isset($instance['rmd_site_logo_alignment']))? $instance['rmd_site_logo_alignment'] : 'text-left';

		echo $before_widget;

		if(!empty($title)) {
			//echo $before_title.$title.$after_title;
		}
		 
		if( ! empty($rmd_setting_site_logo) || ! empty($rmd_setting_site_logo_xs) ): 
 			echo '<div class="'.$alignment.'" >';
    		if( ! empty($rmd_setting_site_logo)): ?>
    			<a class="site-logo hidden-xs" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img style="display:inline-block" alt="<?php bloginfo('name'); ?>" src="<?php echo $rmd_setting_site_logo; ?>" class="img-responsive" >
				</a> 
    		<?php else: ?>
    			<a class="site-logo hidden-xs" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img style="display:inline-block" alt="<?php bloginfo('name'); ?>" src="<?php echo $rmd_setting_site_logo_xs; ?>" class="img-responsive" >
				</a>
    		<?php endif;
    		if( ! empty($rmd_setting_site_logo_xs)): ?>
    			<a class="site-logo visible-xs-inline" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img style="display:inline-block" alt="<?php bloginfo('name'); ?>" src="<?php echo $rmd_setting_site_logo_xs; ?>" class="img-responsive" >
				</a> 
    		<?php else: ?>
    			<a class="site-logo visible-xs-inline" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img style="display:inline-block" alt="<?php bloginfo('name'); ?>" src="<?php echo $rmd_setting_site_logo; ?>" class="img-responsive" >
				</a>
			<?php
    		endif;  
    		echo '</div>';
		endif; 

		echo $after_widget; 

	}

}
 