<?php
namespace theme\rmd\extension\widget_manager\app\facades;

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
                if(!empty($name)) {

                    $id = str_replace(' ', '-', strtolower(trim($name))); 
                    $description = get_post_meta(get_the_ID(), 'rmd_wm_description', true); 

                    register_sidebar( array(
                        'name'          => esc_html__( $name, 'blitzo' ),
                        'id'            => $id,
                        'description'   => esc_html__( $description, 'blitzo' ),
                        'before_widget' => '<section id="%1$s" class="col-md-4 widget %2$s">',
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
 
 