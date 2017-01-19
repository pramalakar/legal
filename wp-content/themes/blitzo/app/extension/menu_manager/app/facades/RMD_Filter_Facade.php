<?php
namespace theme\rmd\extension\menu_manager\app\facades;

use theme\rmd\core\wpquery as Wpquery;
use theme\rmd\core\database as Crud;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Filter_Facade
{      
    protected $post_type = '';


	public function create_is_dropdown_widget_filter($post_type)
	{   
        $this->post_type = $post_type;

		add_filter('rmd_is_dropdown_widget', array($this, '_create_is_dropdown_widget_filter'), 10, 2);
	} 


  	public function _create_is_dropdown_widget_filter($content, $menu_id)
    {  
        if(empty($menu_id)) return $content; 
        return $this->verify_registered_nav_menu($menu_id); 
    } 
  	 

    protected function verify_registered_nav_menu($menu_id)
    {
        $mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($this->post_type); 
        $mypost->where_meta_query('rmd_mm_nav_menu_id', $menu_id);
        $results = $mypost->get();  

        if( $results->have_posts() ) {
            $response = TRUE;
        } else {
            $response = FALSE;
        }
        wp_reset_postdata();

        return $response;
    }


    public function create_dropdown_widget_filter($post_type)
    {   
        $this->post_type = $post_type; 
        add_filter('rmd_dropdown_widget', array($this, '_create_dropdown_widget_filter'), 10, 2);
    } 


    public function _create_dropdown_widget_filter($content, $menu_id)
    {   
        $rmd_mm_num_col_widget = 0;
        $have_active_widget = FALSE;
        $content = '';

        $mypost = new Wpquery\RMD_Wpquery;  
        $mypost->where_post_type($this->post_type); 
        $mypost->where_meta_query('rmd_mm_nav_menu_id', $menu_id);
        $results = $mypost->get();  

        if($results->have_posts()):
            while ( $results->have_posts() ) : $results->the_post();  
                $rmd_mm_num_col_widget = get_post_meta(get_the_ID(), 'rmd_mm_num_col_widget', true); 
                $rmd_mm_num_col_widget = (!empty($rmd_mm_num_col_widget))? $rmd_mm_num_col_widget : 1;

                for ($i=1; $i <= $rmd_mm_num_col_widget; $i++) {  
                    $widget_sidebar = 'rmd_mm_nav_menu_id_'.$i.'_'.$menu_id;  
                    if ( is_active_sidebar( $widget_sidebar ) ) {
                        ob_start();
                        ?>
                        <aside class="widget-area" role="complementary">
                            <?php dynamic_sidebar( $widget_sidebar ); ?>
                        </aside>
                        <?php
                        $content .= ob_get_clean();  
                    } 
                }  

            endwhile;   
        endif;   
        wp_reset_postdata();
 
        if( $rmd_mm_num_col_widget > 0) {
            return '<div class="rmd-nav-widget-wrapper nav-widget-column-'.$rmd_mm_num_col_widget.'">'. $content.'</div>';
        } 

        return '';

    } 
     

    public function create_is_parent_dropdown_widget_filter($post_type)
    {   
        $this->post_type = $post_type;

        add_filter('rmd_is_parent_dropdown_widget', array($this, '_create_is_parent_dropdown_widget_filter'), 10, 2);
    } 


    public function _create_is_parent_dropdown_widget_filter($content, $menu_id)
    {  
        if(empty($menu_id)) return $content; 
        return $this->verify_parent_registered_nav_menu($menu_id); 
    } 
     

    protected function verify_parent_registered_nav_menu($menu_id)
    {
        global $wpdb;
        $table_posts = $wpdb->prefix.'posts';  
        $table_postmeta = $wpdb->prefix.'postmeta';  
        $rel_fields  = "$table_posts.ID = $table_postmeta.post_id";

        $crud = new Crud\RMD_Crud($table_posts);
        $crud = new Crud\RMD_Crud_Select($crud, array('ID')); 
        $crud = new Crud\RMD_Crud_Join($crud, array( $table_postmeta => $rel_fields )); 
        $crud = new Crud\RMD_Crud_Where($crud, array(
            array("$table_posts.post_type",'=','nav_menu_item'), 
            array("$table_postmeta.meta_key",'=','_menu_item_menu_item_parent'), 
            array("$table_postmeta.meta_value",'=',$menu_id), 
        )); 
        $response = $crud->get();

        $have_registered_nav_menu = FALSE;
        if(!empty($response)) {
            foreach ($response as $key => $row) {
                $response2 = $this->verify_registered_nav_menu($row['ID']);
                if( $response2 ) {
                    $have_registered_nav_menu = TRUE;
                }
            }
        }

        return $have_registered_nav_menu;
 
    }


}  
  

 