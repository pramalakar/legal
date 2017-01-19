<?php
namespace theme\rmd\extension\courses\app\facades;

use theme\rmd\core\wpquery as Wpquery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Shortcode_Facade  
{	 
	protected $post_type_course = '';
    protected $post_type_course_outline = '';
  

	public function create_courses_shortcode($post_type, $shortcode)
    {  	 
        $this->post_type_course = $post_type;

    	add_shortcode($shortcode, array($this, '_create_courses_shortcode'));
    } 


    public function _create_courses_shortcode($atts = array(), $content = null)
    { 	
        $attr = shortcode_atts( array(), $atts ); 
       	
       	if(empty($this->post_type_course)) return;

        extract($attr);

       	$content_tag = '';

        $read_more_label = get_option('rmd_read_more_btn_lbl');
        $read_more_label = (!empty($read_more_label))? $read_more_label : 'Read More';

       	$mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($this->post_type_course);  
        $results = $mypost->get();  
        if ( $results->have_posts() ) : 
        	while ( $results->have_posts() ) : $results->the_post(); 
        		$id = get_the_ID();
        		$title = get_the_title();  

 				$image = get_post_meta($id, 'rmd_courses_preview_image', TRUE);
 				$image_tag = (!empty($image))? '<div class="text-center"><img class="hidden-xs hidden-sm " src="'.$image.'"></div>' : '';
 				$image_xs_tag = (!empty($image))? '<div class="text-center hidden-md hidden-lg "><img class="" src="'.$image.'"><div class="rmd-empty-space"></div></div>' : '';

 				$title_tag = (!empty($title))? '<h2 style="padding-top:5px;">'.$title.'</h2>' : '';

 				$description = get_post_meta($id, 'rmd_courses_preview_content', TRUE);
                $description .= '<div style="padding:15px 0px"><a href="'.get_permalink().'" class="btn btn-theme btn-len-md" >'.$read_more_label.'</a></div>';
 				$description_tag = (!empty($description))? $description : '';

 				$content_responsive_class = 'col-md-12';
 				if(!empty($image_tag)) {
 					$image_tag = '<div class="col-md-3">'.$image_tag.'</div>';
 					$content_responsive_class = 'col-md-9';
 				} 

 				$content_tag .= '<div class="row">
 					'.$image_tag.'
 					<div class="'.$content_responsive_class.'">'.$title_tag.$image_xs_tag.$description_tag.'</div>
 					<div class="col-md-12"><div style="width:100%;height:70px"></div></div>
 				</div>';

        	endwhile;   
		endif;  

		wp_reset_postdata();

		return do_shortcode($content_tag);  
    } 



    public function create_course_outline_shortcode($post_type, $shortcode)
    {    
        $this->post_type_course_outline = $post_type;

        add_shortcode($shortcode, array($this, '_create_course_outline_shortcode'));
    } 


    public function _create_course_outline_shortcode($atts = array(), $content = null)
    {   
        $attr = shortcode_atts( array(
            'course_id' => ''
            ), $atts ); 
        
        extract($attr);

        if(empty($this->post_type_course_outline)) return;

        if(empty($course_id)) return;

        $content_tag = '';

        $apply_now_link = get_option('rmd_apply_now_btn_link');
        $apply_now_label = get_option('rmd_apply_now_btn_lbl');
        $apply_now_label = (!empty($apply_now_label))? $apply_now_label : 'APPLY NOW'; 
        $apply_now_btn = (!empty($apply_now_link))? '<a style="min-width:180px;" href="'.$apply_now_link.'" class="btn btn-theme" >'.$apply_now_label.'</a>' : '';
 
        $course_oultine_label = get_option('rmd_course_outline_btn_lbl');
        $course_oultine_label = (!empty($course_oultine_label))? $course_oultine_label : 'COURSE OUTLINE'; 

        $mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($this->post_type_course_outline);  
        $mypost->where_meta_query('rmd_courses_category', $course_id);

        $results = $mypost->get();  
        if ( $results->have_posts() ) : 
            while ( $results->have_posts() ) : $results->the_post(); 
                $id = get_the_ID();
                $title = get_the_title();  

                $image = get_post_meta($id, 'rmd_courses_preview_image', TRUE);
                $image_tag = (!empty($image))? '<div class="text-center"><img class="hidden-xs hidden-sm " src="'.$image.'"></div>' : '';
                $image_xs_tag = (!empty($image))? '<div class="text-center hidden-md hidden-lg "><img class="" src="'.$image.'"><div class="rmd-empty-space"></div></div>' : '';

                $title_tag = (!empty($title))? '<h2 style="padding-top:5px;">'.$title.'</h2>' : '';

                $description = get_post_meta($id, 'rmd_courses_preview_content', TRUE);
                $description .= '<div style="padding:15px 0px">
                    <a style="min-width:180px;" href="'.get_permalink().'" class="btn btn-theme btn-outline-solid btn-arrow" >'.$course_oultine_label.'</a>
                    <div class="rmd-xs-empty-space"></div>
                    '.$apply_now_btn.'
                </div>';
                $description_tag = (!empty($description))? $description : '';

                $content_responsive_class = 'col-md-12';
                if(!empty($image_tag)) {
                    $image_tag = '<div class="col-md-3">'.$image_tag.'</div>';
                    $content_responsive_class = 'col-md-9';
                } 

                $content_tag .= '<div class="row">
                    '.$image_tag.'
                    <div class="'.$content_responsive_class.'">'.$title_tag.$image_xs_tag.$description_tag.'</div>
                    <div class="col-md-12"><div style="width:100%;height:70px"></div></div>
                </div>';

            endwhile;   
        endif;  

        wp_reset_postdata();

        return do_shortcode($content_tag);  
    } 
 
	
}
	
 