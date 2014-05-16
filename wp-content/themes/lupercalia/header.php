<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
	
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=.94, minimum-scale=0.8, maximum-scale=1.2, user-scalable=no" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?> 
	</head>
	
	<body <?php body_class(); ?> >
	
	<div id="page" class="hfeed">
	
		<div id="masthead" role="banner">
		
			<div class="bg-head" style="background-image:URL('<?php header_image(); ?>');">
		
				<header id="site-head" class="site-head">
				
					<div class="head-top-inner">
					
						<?php lupercalia_social_links_callback(); ?>
						<?php lupercalia_logo_image_callback(); ?>
						
					</div>
					
					<div id="navbar" class="navbar clearfix">
								
						<nav id="site-navigation" class="main-navigation clearfix" role="navigation">

							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu clearfix' ) ); ?>
							
						</nav> <!-- #site-navigation -->
								
					</div> <!-- #navbar -->	

				</header> <!-- #site-head -->

			</div> <!-- .bg-head -->
			
			<?php lupercalia_front_page_branding_section(); ?>
	
	</div> <!-- #masthead -->
	
	<div id="main" class="site-main">
	
		<?php lupercalia_breadcrumb(); ?>