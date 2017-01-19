<?php
namespace theme\rmd\theme\app\facades;
 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
class RMD_Utilities_Facade
{      

	public function create_custom_toolbar()
	{
		add_action('admin_bar_menu', array($this, '_create_custom_toolbar'), 999 );
	}


	public function _create_custom_toolbar($wp_admin_bar)
    { 
        // adds a top level parent node I called Custom Made 
        $wp_admin_bar->add_node( array(
            'id'    => 'rmd-theme-setting',
            'title' => '<em>BLITZO</em>',
            'href'   =>  esc_url( admin_url( 'admin.php?page=rmd-theme-setting' ) ), // Top level link Custom Made links to an external web site.
        )); 
    }
  


	public function create_custom_quicktags()
	{  
		add_action( 'admin_print_footer_scripts', array($this, '_create_custom_quicktags') );
	}
 	

 	public function _create_custom_quicktags() 
    {
        if (wp_script_is('quicktags')){
        ?>
            <script type="text/javascript"> 
            QTags.addButton( 'rmd_paragraph', 'p', '<p>', '</p>', 'p', 'Paragraph tag', 1 );
            QTags.addButton( 'rmd_div', 'div', '<div class="" style="" ></div>', '', 'div', 'Div tag' );
            QTags.addButton( 'rmd_hr', 'hr', '<hr/>', '', 'hr', 'HR tag' );
            QTags.addButton( 'rmd_br', 'br', '<br/>', '', 'br', 'BR tag' );
            QTags.addButton( 'rmd_table', 'table', '<table class="table table-bordered table-striped" ><thead><tr><th> Heading </th></tr></thead><tbody><tr><td> Content </td></tr></tbody></table>', '', 'table', 'Table tag' );
            QTags.addButton( 'rmd_tr', 'tr', '<tr><td> Content </td></tr>', '', 'tr', 'TR tag' );
            QTags.addButton( 'rmd_th', 'th', '<th> Heading </th>', '', 'th', 'TH tag' );
            QTags.addButton( 'rmd_td', 'td', '<td> Content </td>', '', 'td', 'TD tag' );

            QTags.addButton( 'rmd_checkmark', 'Check Mark', '<p><i class="fa fa-check" aria-hidden="true"> </i> Check mark</p>', '', '', 'Custom check mark.' );
            
            QTags.addButton( 'rmd_container_fluid', 'Container Fluid', '<div class="rmd-container-fluid" style="background-color:transparent" > </div>', '', '', 'Custom fluid container.' );
            
            QTags.addButton( 'rmd_theme_button', 'Theme Btn', '<a href="[rmd_site_url slug=#]" class="btn btn-theme" > Button </a>', '', '', 'Custom theme button' );
            QTags.addButton( 'rmd_white_button', 'White Btn', '<a href="[rmd_site_url slug=#]" class="btn btn-white" > Button </a>', '', '', 'Custom white button' );
            QTags.addButton( 'rmd_black_button', 'Black Btn', '<a href="[rmd_site_url slug=#]" class="btn btn-black" > Button </a>', '', '', 'Custom black button' );
           
            QTags.addButton( 'rmd_empty_space', 'Empty Spc', '<div class="rmd-empty-space"></div>', '', '', 'Custom empty space' );
            QTags.addButton( 'rmd_xs_empty_space', 'XS - Empty Spc', '<div class="rmd-xs-empty-space"></div>', '', '', 'Custom empty space for extra small devices' );
            QTags.addButton( 'rmd_sm_empty_space', 'SM - Empty Spc', '<div class="rmd-sm-empty-space"></div>', '', '', 'Custom empty space for small devices' );
            QTags.addButton( 'rmd_md_empty_space', 'MD - Empty Spc', '<div class="rmd-md-empty-space"></div>', '', '', 'Custom empty space for medium devices' );
            QTags.addButton( 'rmd_lg_empty_space', 'LG - Empty Spc', '<div class="rmd-lg-empty-space"></div>', '', '', 'Custom empty space for large devices' );
 
            QTags.addButton( 'rmd_1_col', '1 Col', '<div class="row"><div class="col-md-12"> Column content </div></div>', '', '', 'One Column Grid' );
            QTags.addButton( 'rmd_2_col', '2 Cols', '<div class="row"><div class="col-md-6"> Column content </div><div class="col-md-6"> Column content </div></div>', '', '', 'Two Columns Grid' );
            QTags.addButton( 'rmd_3_col', '3 Cols', '<div class="row"><div class="col-md-4"> Column content </div><div class="col-md-4"> Column content </div><div class="col-md-4"> Column content </div></div>', '', '', 'Three Columns Grid' );
            QTags.addButton( 'rmd_4_col', '4 Cols', '<div class="row"><div class="col-md-3"> Column content </div><div class="col-md-3"> Column content </div><div class="col-md-3"> Column content </div><div class="col-md-3"> Column content </div></div>', '', '', 'Four Columns Grid' );
           </script>
        <?php
        }
    }


    public function create_shortcode_site_url() 
    {
        add_shortcode('rmd_site_url', function($atts = array(), $content = null){
            $attr = shortcode_atts( array( 'slug'=>'' ), $atts );
            extract($attr);
            return get_bloginfo('url').'/'.$slug;
        });
    }

}  
  

 