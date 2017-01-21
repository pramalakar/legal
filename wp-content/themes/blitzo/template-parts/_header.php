<?php
/**
 * Template part for the header templates
 * 
 * @package Blitzo
 */

global $floated_class;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1"> <?php echo apply_filters('rmd_site_meta_description', ''); ?> <?php echo apply_filters('rmd_site_meta_keywords', ''); ?> 
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"> 
<link rel="shortcut icon" href="<?php echo apply_filters('rmd_site_favicon', ''); ?>" />   
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Montserrat:400,700" rel="stylesheet">
<?php wp_head(); ?>  
<?php echo apply_filters('rmd_site_google_analytics', ''); ?> 
</head>
<body <?php body_class(); ?>>  
<header class="header-wrapper <?php echo $floated_class; ?>"> 
	<?php
		$rmd_setting_header_top_widget_column_layout = get_option('rmd_setting_header_top_widget_column_layout');
		$rmd_setting_header_top_widget_column_layout = (!empty($rmd_setting_header_top_widget_column_layout))? $rmd_setting_header_top_widget_column_layout : '112';
		 
		$responsive_class_htwl1 = '';
		$responsive_class_htwl2 = ''; 

		switch ($rmd_setting_header_top_widget_column_layout) {
			case '112':
			default:
				$responsive_class_htwl1 = 'col-md-6';
				$responsive_class_htwl2 = 'col-md-6'; 
				break; 
			case '123': 
				$responsive_class_htwl1 = 'col-md-4';
				$responsive_class_htwl2 = 'col-md-8'; 
				break;
			case '213': 
				$responsive_class_htwl1 = 'col-md-8';
				$responsive_class_htwl2 = 'col-md-4'; 
				break;
			case '134': 
				$responsive_class_htwl1 = 'col-md-3';
				$responsive_class_htwl2 = 'col-md-9'; 
				break;
			case '314': 
				$responsive_class_htwl1 = 'col-md-9';
				$responsive_class_htwl2 = 'col-md-3'; 
				break;
		} 
	?>
	<?php
		$rmd_setting_header_top_widget_status = get_option('rmd_setting_header_top_widget_status');
		if($rmd_setting_header_top_widget_status == 'yes'):
	?>
	<div class="header-inner-top-wrapper" >
		<div class="container hidden-xs hidden-sm" >
			<div class="row" > 
				<div class="<?php echo $responsive_class_htwl1; ?>">
					<div class="header-top-left-container text-left" >
						<?php if ( is_active_sidebar( 'heade_top_left_widget' ) ): ?>
							<?php dynamic_sidebar( 'heade_top_left_widget' ); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="<?php echo $responsive_class_htwl2; ?>">
					<div class="header-top-right-container" >
						<!-- <?php if ( is_active_sidebar( 'heade_top_right_widget' ) ): ?>
							<?php dynamic_sidebar( 'heade_top_right_widget' ); ?>
						<?php endif; ?>  -->
						<!-- REPLACED WITH LOGGED IN STATUS -->
						<?php if ( is_active_sidebar( 'heade_top_right_widget' ) ): ?>
							<?php $auth = SwpmAuth::get_instance();	?>
							<?php if ( $auth->is_logged_in() ): ?>
							<a class="btn"><?php echo  SwpmUtils::_('Logged in as ') ?><?php echo $auth->get('user_name'); ?></a>
							    <a href="?swpm-logout=true" class="btn btn-danger"><?php echo  SwpmUtils::_('Logout') ?></a>
							<?php else: ?>
								<?php dynamic_sidebar( 'heade_top_right_widget' ); ?>
							<?php endif; ?>
						<?php endif; ?> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

    <!-- Static navbar -->
    <nav class="navbar navbar-default">
	    <div class="container">
		    <div class="navbar-header">
		      	<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#side-navmenu" data-canvas="body">
				    <span class="icon-bar top-bar"></span>
					<span class="icon-bar middle-bar"></span>
					<span class="icon-bar bottom-bar"></span>
				</button> 
		        <div class="site-logo-container">  
		        	<?php echo apply_filters('rmd_site_logo', ''); ?>   
				</div>  
		    </div> 
		    <div class="site-logo-container lg-fr md-fr">
		    	<?php the_ad(461); ?>
		    	<!--<img src="http://placehold.it/340x80">-->
		    </div>
	<!-- 	    <div id="navbar" class="navbar-collapse collapse">
		    	<div class="nav navbar-nav navbar-right main-menu">Replace below menu with ads </div>
		    </div> -->
	      	<!-- <div id="navbar" class="navbar-collapse collapse">  
	      		<?php echo apply_filters('rmd_menu_contacts', ''); ?>
			  	<?php
			        wp_nav_menu( array(
			            'menu'              => 'primary',
			            'theme_location'    => 'primary',
			            'depth'             => 2, 
			            'menu_class'        => 'nav navbar-nav navbar-right main-menu', //nav navbar-nav 
			            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			            'walker'            => new wp_bootstrap_navwalker())
			        );
			    ?>      
		  	</div> --><!--/.nav-collapse -->  
	    </div><!--/.container-fluid -->  
	</nav> 
	<nav id="navbar-main" class="navbar navbar-default container-fluid <?php echo $floated_class; ?> hidden-xs hidden-sm" >
		<div id="navbar" class="navbar-collapse collapse">  
			<div class="tablewrap">
				<div class="tablecell valignmiddle col-md-10 col-sm-12">
					<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#side-navmenu" data-canvas="body" style="display: block; background-color:black;z-index: 100;">
					    <span class="icon-bar top-bar"></span>
						<span class="icon-bar middle-bar"></span>
						<span class="icon-bar bottom-bar"></span>
					</button> 
			  		<?php echo apply_filters('rmd_menu_contacts', ''); ?>
				  	<?php
				        wp_nav_menu( array(
				            'menu'              => 'primary',
				            'theme_location'    => 'primary',
				            'depth'             => 2, 
				            'menu_class'        => 'nav navbar-nav navbar-left main-menu', //nav navbar-nav 
				            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				            'walker'            => new wp_bootstrap_navwalker())
				        );
				    ?>
		    	</div>
		    	<div class="tablecell valignmiddle col-md-2 hidden-xs hidden-sm text-right">
		    		<?php echo date('l jS F Y'); ?>  
		    	</div> 
		    </div>
	  	</div>
  	</nav>
</header>
<nav id="side-navmenu" class="navmenu navmenu-default navmenu-fixed-left offcanvas side-navmenu" role="navigation">  
  	<div class="side-navmenu-widget-container" >
	  	<?php if ( is_active_sidebar( 'side_navmenu_widget' ) ): ?>
			<?php dynamic_sidebar( 'side_navmenu_widget' ); ?>
		<?php endif; ?>
	</div>
  	<?php
        wp_nav_menu( array(
            'menu'              => 'primary',
            'theme_location'    => 'primary',
            'depth'             => 2, 
            'menu_class'        => 'nav navbar-nav', //nav navbar-nav 
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
        );
    ?>   
</nav>
<div class="breadcrumbs bg-darkgray text-white">
	<h6 class="container entry-title"><?php if(function_exists('bcn_display'))
	{
		bcn_display();
	}?>
	</h6>
</div>

