<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php wp_title(); ?></title>
    <link type='text/css' rel='stylesheet' href='<?php bloginfo('template_url'); ?>/css/bootstrap.css' />
    <link type='text/css' rel='stylesheet' href='<?php bloginfo('template_url'); ?>/style.css' />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
    <?php wp_head(''); ?>
</head>
	
<body <?php body_class(); ?> >
    <div id="wrapper" class="hfeed">
	<div id="header_wrapper" class="bg-head" style="background-image:URL('<?php header_image(); ?>');">
            <header id="site-head" class="site-head">
		<div class="head-top-inner">		
                    <?php lupercalia_social_links_callback(); ?>
                    <?php lupercalia_logo_image_callback(); ?>
                </div>
                <div id="main_nav" class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav navbar-nav' ) ); ?>
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </div>
            </header> <!-- #site-head -->
        </div> <!-- #header_wrapper -->
	<div id="content_wrapper" class="site-main container">
            <?php lupercalia_breadcrumb(); ?>