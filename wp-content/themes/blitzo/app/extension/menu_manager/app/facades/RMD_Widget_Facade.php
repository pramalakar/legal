<?php
namespace theme\rmd\extension\menu_manager\app\facades;

use theme\rmd\core\wpquery as Wpquery;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class RMD_Widget_Facade
{     
	protected $post_type = '';

	public function create_widget_area($post_type)
	{
		$this->post_type = $post_type; 
		add_action( 'widgets_init', array($this, '_create_widget_area') ); 
	}


	public function _create_widget_area()
    {   
        $mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($this->post_type); 
        $results = $mypost->get();  

        if ( $results->have_posts() ) :  
            while ( $results->have_posts() ) : $results->the_post();  

                $name = get_the_title();
                $rmd_mm_nav_menu_id = get_post_meta(get_the_ID(), 'rmd_mm_nav_menu_id', true); 
                $rmd_mm_num_col_widget = get_post_meta(get_the_ID(), 'rmd_mm_num_col_widget', true); 
                $rmd_mm_num_col_widget = (!empty($rmd_mm_num_col_widget))? $rmd_mm_num_col_widget : 1;
                $description = '';

                if(empty($name)) continue;
                
                if(empty($rmd_mm_nav_menu_id) || $rmd_mm_nav_menu_id == 'none') continue;

                for ($i=1; $i <= $rmd_mm_num_col_widget ; $i++) { 

                    $id = 'rmd_mm_nav_menu_id_'.$i.'_'.$rmd_mm_nav_menu_id;
                    $new_name = $name.' '.$i;

                    register_sidebar( array(
                        'name'          => esc_html__( $new_name, 'blitzo' ),
                        'id'            => $id,
                        'description'   => esc_html__( $description, 'blitzo' ),
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h2 class="widget-title">',
                        'after_title'   => '</h2>',
                    ) );
                }

            endwhile;   
        endif;   
        wp_reset_postdata();
 
    }




}  
 
 