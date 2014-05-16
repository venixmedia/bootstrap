<?php

/* ------------------------------------------------------------------------- *
 * Base Functionality
/* ------------------------------------------------------------------------- */

/* ------------------------------------------------------------------------- */
/* Variable Init
/* ------------------------------------------------------------------------- */

	$slider_id = 0;
	$option = get_option('lupercalia_options');
	
/* ------------------------------------------------------------------------- */
/* Includes 
/* ------------------------------------------------------------------------- */

require_once ( 'theme_options/lupercalia_options_page.php' );

/* ------------------------------------------------------------------------- */
/* Theme SetUp
/* ------------------------------------------------------------------------- */

function lupercalia_setup() {

	// Enable custom menu
	register_nav_menu( 'primary', __( 'Navigation Menu', 'lupercalia' ) );
	
	// Enable featured image
	add_theme_support( 'post-thumbnails' );
	
	// Custom thumbnail size - blog featured
	add_image_size( 'blog-featured', 600, 338, true );
	
	// Enable RSS Feed
	add_theme_support( 'automatic-feed-links' );
	
	// Content width
	if ( ! isset( $content_width ) ) $content_width = 692;
	
	// TINYMCE Style
	function lupercalia_theme_add_editor_styles() {
		add_editor_style( 'custom-editor-style.css' );
	}
	add_action( 'init', 'lupercalia_theme_add_editor_styles' );	
	
}
add_action( 'after_setup_theme', 'lupercalia_setup' );	

/* ------------------------------------------------------------------------- */
/* Custom Background 
/* Allows users to change theme's background color or choose an image as 
/* background.
/* ------------------------------------------------------------------------- */

	$defaults = array(
	
		'default-color' => 'fafafa',
		
	);
	
	add_theme_support( 'custom-background', $defaults );

/* ------------------------------------------------------------------------- */
/* Custom Header 
/* Allows users to change header's background or choose an image as background.
/* By default six background images are registered to be chosen.
/* ------------------------------------------------------------------------- */

function lupercalia_custom_header_setup() {

	$args = array(
		'default-image' => get_template_directory_uri() . '/imgs/header/head-bg1.png',
		'height'        => 120,
		'width'         => 1600,
	);
	
	add_theme_support( 'custom-header', $args );

	register_default_headers( array(
		'header1' => array(
			'url'           => '%s/imgs/header/head-bg1.png',
			'thumbnail_url' => '%s/imgs/header/head-bg1.png',
			'description'   => _x( 'Header 1', 'header image description', 'lupercalia' )
		),
		'header2' => array(
			'url'           => '%s/imgs/header/head-bg2.png',
			'thumbnail_url' => '%s/imgs/header/head-bg2.png',
			'description'   => _x( 'Header 2', 'header image description', 'lupercalia' )
		),
		'header3' => array(
			'url'           => '%s/imgs/header/head-bg3.png',
			'thumbnail_url' => '%s/imgs/header/head-bg3.png',
			'description'   => _x( 'Header 3', 'header image description', 'lupercalia' )
		),
		'header4' => array(
			'url'           => '%s/imgs/header/head-bg4.png',
			'thumbnail_url' => '%s/imgs/header/head-bg4.png',
			'description'   => _x( 'Header 4', 'header image description', 'lupercalia' )
		),
		'header5' => array(
			'url'           => '%s/imgs/header/head-bg5.png',
			'thumbnail_url' => '%s/imgs/header/head-bg5.png',
			'description'   => _x( 'Header 5', 'header image description', 'lupercalia' )
		),	
		'header6' => array(
			'url'           => '%s/imgs/header/head-bg6.png',
			'thumbnail_url' => '%s/imgs/header/head-bg6.png',
			'description'   => _x( 'Header 6', 'header image description', 'lupercalia' )
		),		
	) );
}
add_action( 'after_setup_theme', 'lupercalia_custom_header_setup', 11 );

/* ------------------------------------------------------------------------- */
/* Enqueue JavaScript and CSS
/* ------------------------------------------------------------------------- */

function lupercalia_scripts_styles() {

	global $option;
	
	// Lupercalia Theme 
	wp_enqueue_script( 'lupercalia-slider', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true);
	wp_enqueue_style( 'lupercalia-style', get_stylesheet_uri());
	
	if ($option['general_csscolor_field']) :
		wp_enqueue_style( 'lupercalia-style-color', get_template_directory_uri() . '/css/' . $option['general_csscolor_field'] . '.css');
	endif;
	
	// FlexSlider
	wp_enqueue_script( 'flexslider-scripts', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '', true);
	wp_enqueue_style( 'flexslider-style', get_template_directory_uri() . '/js/flexslider.css');
	
	// ColorBox
	wp_enqueue_script( 'colorbox-scripts', get_template_directory_uri() . '/js/jquery.colorbox-min.js', array('jquery'), '', true);
	wp_enqueue_style( 'colorbox-style', get_template_directory_uri() . '/js/colorbox.css');
	
	if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
}

add_action( 'wp_enqueue_scripts', 'lupercalia_scripts_styles' );

/* ------------------------------------------------------------------------- */
/* Register sidebars
/* ------------------------------------------------------------------------- */

function lupercalia_widgets_init() {	
	
	register_sidebar(array(
		'name'          => __('Front Page Top Section', 'lupercalia' ),
		'id'			=> 'front-page-top-section',
		'description' => __( 'This widget is located on the front page below the front page branding area.', 'lupercalia' ),
		'before_widget' => '<section id="front-page-top-section" class="widget front-page-section">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'name'          => __('Front Page Middle Section 1', 'lupercalia' ),
		'id'			=> 'front-page-middle-section-1',
		'description' => __( 'This widget is located on the front page below the front page top section area.', 'lupercalia' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => __('Front Page Middle Section 2', 'lupercalia' ),
		'id'			=> 'front-page-middle-section-2',
		'description' => __( 'This widget is located on the front page below the front page top section area.', 'lupercalia' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => __('Front Page Middle Section 3', 'lupercalia' ),
		'id'			=> 'front-page-middle-section-3',
		'description' => __( 'This widget is located on the front page below the front page top section area.', 'lupercalia' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));	
	
	register_sidebar(array(
		'name'          => __('Home Sidebar', 'lupercalia' ),
		'id'			=> 'home-sidebar',
		'description' => __( 'This sidebar is located on the home page of the site.', 'lupercalia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'name'          => __('Pages Sidebar', 'lupercalia' ),
		'id'			=> 'page-sidebar',
		'description' => __( 'This sidebar is located on the pages of the site.', 'lupercalia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));	
	
	register_sidebar(array(
		'name'          => __('Blog Single Pages Sidebar', 'lupercalia' ),
		'id'			=> 'single-sidebar',
		'description' => __( 'This sidebar is located on the blog single pages of the site.', 'lupercalia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar(array(
		'name'          => __('Search Pages Sidebar', 'lupercalia' ),
		'id'			=> 'search-sidebar',
		'description' => __( 'This sidebar is located on the search pages of the site.', 'lupercalia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));	

	register_sidebar(array(
		'name'          => __('Archives Sidebar', 'lupercalia' ),
		'id'			=> 'archive-sidebar',
		'description' => __( 'This sidebar is located on the archives/tags/attachments/categories pages of the site.', 'lupercalia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));		
	
	register_sidebar(array(
		'name'          => __('Footer 1', 'lupercalia' ),
		'id'			=> 'footer-1',
		'description' => __( 'This widget is located above the footer area.', 'lupercalia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));	

	register_sidebar(array(
		'name'          => __('Footer 2', 'lupercalia' ),
		'id'			=> 'footer-2',
		'description' => __( 'This widget is located above the footer area.', 'lupercalia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));	

	register_sidebar(array(
		'name'          => __('Footer 3', 'lupercalia' ),
		'id'			=> 'footer-3',
		'description' => __( 'This widget is located above the footer area.', 'lupercalia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));		
	
}
add_action( 'widgets_init', 'lupercalia_widgets_init' );

/* ------------------------------------------------------------------------- */
/* Languages
/* ------------------------------------------------------------------------- */

load_theme_textdomain( 'lupercalia', get_template_directory().'/languages' );
 
$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

/* ------------------------------------------------------------------------- *
 * Theme Functions
/* ------------------------------------------------------------------------- */

/* ------------------------------------------------------------------------- */
/* wp_title() Filter
/* ------------------------------------------------------------------------- */

function lupercalia_wp_title( $title ) {

	global $paged, $page;

	if ( is_feed() ) :
		return $title;
	endif;
		
	if ( is_front_page() ) :
		$title = bloginfo('name'); echo ' - '; bloginfo('description'); 
	endif;
	
	if ( !is_front_page() ) :
		$title.= ''.' - '.''.get_bloginfo('name'); 
	endif;

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) :
		$title = "$title | " . sprintf( __( 'Page %s', 'lupercalia' ), max( $paged, $page ) );
	endif;
	
	return $title;
}
add_filter( 'wp_title', 'lupercalia_wp_title', 10, 2 );

/* ------------------------------------------------------------------------- */
/* Excerpt Length
/* Changes default post excerpt length
/* ------------------------------------------------------------------------- */

	function lupercalia_excerpt_length( $length ) {
	
		return 20;
	
	}
	add_filter( 'excerpt_length', 'lupercalia_excerpt_length', 999 );
	
/* ------------------------------------------------------------------------- */
/* Excerpt "More Link"
/* Changes default post excerpt "more link"
/* ------------------------------------------------------------------------- */

	function lupercalia_excerpt_more( $more ) {
		
		$return = " (...)";
		return $return;
		
	}
	add_filter('excerpt_more', 'lupercalia_excerpt_more');	
	

/* ------------------------------------------------------------------------- */
/* Pagination
/* Shows pagination when posts overtake maximum post per page. 
/* ------------------------------------------------------------------------- */	
	
	if ( ! function_exists( 'lupercalia_pagination' ) ) :
	
		function lupercalia_pagination() {
		
			global $wp_query;

			$big = 999999999;
			
			?> <div class="pagination"> <?php
			
			echo paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $wp_query->max_num_pages,
				'end_size'     => 0,
				'mid_size'     => 1,
				'prev_text'    => '&laquo;',
				'next_text'    => '&raquo;',
			) );
			
			?> </div> <?php
			
		}
		
	endif;
	

/* ------------------------------------------------------------------------- */
/* Logo Image Callback
/* Print logo image if one is upload by option page. 
/* ------------------------------------------------------------------------- */

function lupercalia_logo_image_callback() {

	global $option;
	
	if ( ! empty($option['general_logo_field']) ) : ?>
	
		<a class="home-link" href="<?php echo esc_url( home_url() ); ?> ">
		
			<img class="logo" src="<?php echo esc_html($option['general_logo_field']); ?>" />
			
		</a> <!-- .home-link -->
		
	<?php else : ?>
	
		<a class="home-link" href="<?php echo esc_url( home_url() ); ?> ">
		
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			<h4 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			
		</a> <!-- .home-link -->
		
	<?php endif;
}

/* ------------------------------------------------------------------------- */
/*  Social Links Callback
/* ------------------------------------------------------------------------- */

function lupercalia_social_links_callback() {
	
	global $option;
	
	if ( !empty($option['contact_facebook_field']) || !empty($option['contact_flickr_field']) || !empty($option['contact_googleplus_field']) || !empty($option['contact_instagram_field']) || !empty($option['contact_linkedin_field']) || !empty($option['contact_pinterest_field']) || !empty($option['contact_twitter_field']) || !empty($option['contact_vimeo_field']) || !empty($option['contact_youtube_field']) ) : 
	
		echo "<div id='social' class='social'><ul>";
	
		if ( !empty($option['contact_facebook_field']) ) :
			echo "<li class='facebook'><a href='" . esc_url($option['contact_facebook_field']) . "' title='" . esc_html__('Facebook', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
		
		if ( !empty($option['contact_flickr_field']) ) :
			echo "<li class='flickr'><a href='" . esc_url($option['contact_flickr_field']) . "' title='" . esc_html__('Flickr', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
		
		if ( !empty($option['contact_googleplus_field']) ) :
			echo "<li class='googleplus'><a href='" . esc_url($option['contact_googleplus_field']) . "' title='" . esc_html__('Google+', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
		
		if ( !empty($option['contact_instagram_field']) ) :
			echo "<li class='instagram'><a href='" . esc_url($option['contact_instagram_field']) . "' title='" . esc_html__('Instagram', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
		
		if ( !empty($option['contact_linkedin_field']) ) :
			echo "<li class='linkedin'><a href='" . esc_url($option['contact_linkedin_field']) . "' title='" . esc_html__('Linkedin', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
		
		if ( !empty($option['contact_pinterest_field']) ) :
			echo "<li class='pinterest'><a href='" . esc_url($option['contact_pinterest_field']) . "' title='" . esc_html__('Pinterest', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
		
		if ( !empty($option['contact_twitter_field']) ) :
			echo "<li class='twitter'><a href='" . esc_url($option['contact_twitter_field']) . "' title='" . esc_html__('Twitter', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
		
		if ( !empty($option['contact_vimeo_field']) ) :
			echo "<li class='vimeo'><a href='" . esc_url($option['contact_vimeo_field']) . "' title='" . esc_html__('Vimeo', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
		
		if ( !empty($option['contact_youtube_field']) ) :
			echo "<li class='youtube'><a href='" . esc_url($option['contact_youtube_field']) . "' title='" . esc_html__('Youtube', 'lupercalia') . "' target='_blank'></a></li>";
		endif;
	
	echo "</ul></div>";	
	
	endif;
	
}

/* ------------------------------------------------------------------------- */
/* Sidebar Callback
/* ------------------------------------------------------------------------- */

	function lupercalia_sidebar() {

		if ( is_active_sidebar('home-sidebar') and is_home() ) : 
		
			dynamic_sidebar('home-sidebar');
			
		elseif ( is_active_sidebar('page-sidebar') and is_page() ) :
		
			dynamic_sidebar('page-sidebar');
		
		elseif ( is_active_sidebar('single-sidebar') and is_single() ) :
		
			dynamic_sidebar('single-sidebar');		
			
		elseif ( is_active_sidebar('search-sidebar') and is_search() ) :
		
			dynamic_sidebar('search-sidebar');

		elseif ( is_active_sidebar('archive-sidebar') and is_archive() || is_tag() || is_category() || is_attachment() ) :
		
			dynamic_sidebar('archive-sidebar');					
		
		else : ?>
		
		<aside id="archives" class="widget widget_archive">	
		
			<h3 class="widget-title"><?php _e( 'Archives', 'lupercalia' ); ?></h3>
			<ul>
			
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				
			</ul>
			
		</aside> <!-- .widget .widget_archive -->
		

		<aside id="meta" class="widget">
		
			<h3 class="widget-title"><?php _e( 'Meta', 'lupercalia' ); ?></h3>
			<ul>
			
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
				
			</ul>
			
		</aside> <!-- .widget -->
		
		<?php endif;
	
	}

/* ------------------------------------------------------------------------- */
/* Post Category
/* Return post categories IDs.
/* ------------------------------------------------------------------------- */

function lupercalia_post_category() {

	$cat_ID = array(); 
	$categories = get_the_category(); //get all categories for this post
	
	foreach($categories as $category) {
		array_push( $cat_ID, $category->cat_ID );
	}
	
	return $cat_ID;
}

/* ------------------------------------------------------------------------- */	
/*  FlexSlider Script
/* ------------------------------------------------------------------------- */

function lupercalia_slider_script ( $args = array() ) {

	$defaults = array (
		"visible_items" => 1,
		"auto_play" => true,
		"mobile_items" => 2,
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract($args, EXTR_SKIP);

	$script = "<script>jQuery(window).load(function() {
				
			   jQuery('.flexslider-" . $slider_id . "').flexslider({
				animation: 'slide',				
				itemMargin: 5,
				controlNav: false, 
				itemWidth: 210,
				minItems: " . $mobile_items . ",
				maxItems: " . $visible_items . ",
				slideshow: " . $auto_play . ",
		
			  });
		 });</script>";
			
	return $script;

}

/* ------------------------------------------------------------------------- */	
/*  FlexSlider Carousel
/* ------------------------------------------------------------------------- */

function lupercalia_slider ( $args = array() ) {

	GLOBAL $slider_id;
	GLOBAL $post;
	$slider_id++;
	
	$defaults = array (
		"category_id" => 0,
		"visible_items" => 1,
		"num_posts" => 4,
		"post_offset" => 0,
		"auto_play" => true,
		"mobile_items" => 1,
		"orderby" => 'ASC',
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract($args, EXTR_SKIP);
	
	$script = lupercalia_slider_script( array ( "visible_items" => $visible_items, "auto_play" => $auto_play, "mobile_items" => $mobile_items,"slider_id" => $slider_id ) );
	
	echo $script; ?>

	<div class="flexslider-<?php echo $slider_id; ?>">
		
		<ul class="slides">
				
			<?php 
			
			$the_query = new WP_Query( array( 'category__in' => $category_id, 'offset' => $post_offset, 'showposts' => $num_posts, 'post__not_in' => array($post->ID), 'orderby' => $orderby, ) );
			
			if ( $the_query->have_posts() ) :
			
				while ($the_query->have_posts() ) : $the_query->the_post(); ?>
				
					<li>
							
						<?php if ( has_post_thumbnail() ) : ?>
						
							<div class="amazingcarousel-image">
							
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_post_thumbnail('blog-featured'); ?> </a>
								
							</div> <!-- .amazingcarousel-image -->
						
						<?php else : ?>
						
							<div class="amazingcarousel-image">
							
								<a href="<?php the_permalink() ?>"><img width="692" height="471" src="<?php echo get_template_directory_uri(); ?>/imgs/no-thumbnail.jpg" /></a>
								
							</div> <!-- .amazingcarousel-image -->
						
						<?php endif; ?>
							
						<div class="amazingcarousel-text">
						
							<div class="amazingcarousel-title">
							
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								
							</div> <!-- .amazingcarousel-titlw -->
							
							<div class="amazingcarousel-description">
							
								<?php echo get_the_excerpt(); ?>
								
							</div> <!-- .amazingcarousel-description -->
							
						</div>	<!-- .amazingcarousel-text -->
							
					</li>
				
				<?php endwhile; ?>
				
				<?php wp_reset_postdata(); ?>
				
			<?php endif; ?>
				
		</ul> <!-- .slides- -->
		
	</div> <!-- .flexslider- -->
	
	<?php
}

/* ------------------------------------------------------------------------- */	
/* Related Post Slider
/* Shows related posts by category if exist posts to be displayed. 
/* ------------------------------------------------------------------------- */

function lupercalia_relatedpost() { 

	global $post;
	global $option;

	$the_query = new WP_query( array( 'category__in' => lupercalia_post_category(), 'post__not_in' => array($post->ID) ) );
	
	if ( $the_query->have_posts() ) :
	
		if ($option['relatedposts_slider_field']['relatedposts_slider_hide_field'] != 'yes') :
		
			if ($option) :
			
				$args = array (
				
					'category_id' => lupercalia_post_category(), 
					'num_posts' => $option['relatedposts_slider_field']['relatedposts_slider_numposts_field'],
					'visible_items' => $option['relatedposts_slider_field']['relatedposts_slider_visibleitems_field'], 
					'mobile_items' => $option['relatedposts_slider_field']['relatedposts_slider_mobileitems_field'],  
					'auto_play' => $option['relatedposts_slider_field']['relatedposts_slider_autoplay_field'],
					'orderby' => $option['relatedposts_slider_field']['relatedposts_slider_random_field'],
					
				); 
				
			else :
			
				$args = array ( 'num_posts' => 5, 'visible_items' => 3, 'category_id' => lupercalia_post_category(), 'mobile_items' => 2, "auto_play" => 'false', 'orderby' => 'rand' );
			
			endif;
			
			echo "<div id='relatedpost' class='relatedpost'>";
			
				echo "<h3 class='relatedpost-title'>" . esc_html__('You might also like:', 'lupercalia') . "</h3>";
				
				lupercalia_slider( $args );
			
			echo "</div>";			
			
		endif;	
	
	endif;
}

/* ------------------------------------------------------------------------- */	
/* Front Page Slider
/* Prints front page bottom section slider
/* ------------------------------------------------------------------------- */

function lupercalia_front_page_slider() {

	global $option;
	
	if ($option['frontpage_slider_field']['frontpage_slider_hide_field'] != 'yes') :
	
		echo "<h3 class='relatedpost-title'>" . esc_html__('Last entries from blog:', 'lupercalia') . "</h3>";
	
		if ($option) :
		
			$args = array (
			
				'category_id' => $option['frontpage_slider_field']['frontpage_slider_category_field'], 
				'post_offset' => $option['frontpage_slider_field']['frontpage_slider_offset_field'],
				'num_posts' => $option['frontpage_slider_field']['frontpage_slider_numposts_field'],
				'visible_items' => $option['frontpage_slider_field']['frontpage_slider_visibleitems_field'], 
				'mobile_items' => $option['frontpage_slider_field']['frontpage_slider_mobileitems_field'],  
				'auto_play' => $option['frontpage_slider_field']['frontpage_slider_autoplay_field'],
				'orderby' => $option['frontpage_slider_field']['frontpage_slider_random_field'],
				
			); 
			
		else :
		
			$args = array ( 'visible_items' => 3, 'mobile_items' => 2, "auto_play" => 'false', 'orderby' => 'ASC' );
			
		endif;
		
		lupercalia_slider($args);
	
	endif;
	
}

/* ------------------------------------------------------------------------- */	
/* Home Page Slider
/* Prints home blog slider.
/* ------------------------------------------------------------------------- */

function lupercalia_blog_slider() {

	global $option;
	
	if ($option['home_slider_field']['home_slider_hide_field'] != 'yes' and is_home()) :
	
		if ($option) :
		
			$args = array (
			
				'category_id' => $option['home_slider_field']['home_slider_category_field'], 
				'post_offset' => $option['home_slider_field']['home_slider_offset_field'],
				'num_posts' => $option['home_slider_field']['home_slider_numposts_field'],
				'visible_items' => $option['home_slider_field']['home_slider_visibleitems_field'], 
				'mobile_items' => $option['home_slider_field']['home_slider_mobileitems_field'],  
				'auto_play' => $option['home_slider_field']['home_slider_autoplay_field'],
				'orderby' => $option['home_slider_field']['home_slider_random_field'],
				
			); 
			
		else :
		
			$args = array ( 'visible_items' => 1, 'mobile_items' => 1, "auto_play" => 'true', 'orderby' => 'ASC' );
			
		endif;
		
		lupercalia_slider($args);
	
	endif;

}

/* ------------------------------------------------------------------------- */	
/* Front Page Branding Section
/* Returns front page branding section setted on theme settings page.
/* ------------------------------------------------------------------------- */	

function lupercalia_front_page_branding_section() {

	global $slider_id;
	global $option;
	
	if (get_option( 'show_on_front' ) == 'page' && is_front_page() ) : 
	
	$slider_id++;

	$script = lupercalia_slider_script( array ( "visible_items" => 1, "auto_play" => 'true', "mobile_items" => 1, "slider_id" => $slider_id ) ); 
	
	echo $script; ?>
	
		<div id="branding" class="branding" role="banner">

			<?php if ( $option['frontpage_branding_field'] ) : ?>
			
				<div class="flexslider-<?php echo $slider_id; ?>">
					
					<ul class="slides">

						<?php $arrayimg = count($option['frontpage_branding_field']['slider_image']); ?>
							
						<?php for ($i = 0; $i < $arrayimg; $i++) : ?>						
					
							<li>

								<?php if ( $option['frontpage_branding_field']['slider_image'][$i] ) : ?>
								
									<div class="amazingcarousel-image">
										<img src="<?php echo esc_url($option['frontpage_branding_field']['slider_image'][$i]); ?>" />
									</div> <!-- .amazingcarousel-image -->
								
								<?php else : ?>
								
									<div class="amazingcarousel-image">
										<img width="692" height="471" src="<?php echo get_template_directory_uri(); ?>/imgs/no-thumbnail.jpg" />
									</div> <!-- .amazingcarousel-image -->
								
								<?php endif; ?>
									
								<div class="amazingcarousel-text">
								
									<div class="amazingcarousel-title">
										<?php echo $option['frontpage_branding_field']['slider_title'][$i]; ?>
									</div> <!-- .amazingcarousel-title -->
									
									<div class="amazingcarousel-description">
										<?php echo $option['frontpage_branding_field']['slider_desc'][$i]; ?>
									</div> <!-- .amazingcarousel-description -->
								
								</div>	<!-- .amazingcarousel-text -->
									
							</li>

						<?php endfor; ?>	
	
					</ul> <!-- .slides -->
					
				</div>	<!-- .flexslider- -->

			<?php else : ?>
			
				<div class="flexslider-<?php echo $slider_id; ?>">
					
					<ul class="slides">

						<li>

							<div class="amazingcarousel-image">
							
								<img width="692" height="471" src="<?php echo get_template_directory_uri(); ?>/imgs/slider-sample.png" />
								
							</div> <!-- .amazingcarousel-image -->
							
							<div class="amazingcarousel-text">
							
								<div class="amazingcarousel-title">
								
									Slider 1 Title
								
								</div> <!-- .amazingcarousel-title -->
								
								<div class="amazingcarousel-description">
								
									Slider 1 Description <?php if ( is_user_logged_in() ) : echo "<a href=". get_admin_url() . "themes.php?page=lupercalia_options_page" ."> (add slider)</a>"; endif ?>
									
								</div> <!-- .amazingcarousel-description -->
							
							</div>	<!-- .amazingcarousel-text -->
								
						</li>
						
						<li>
							
							<div class="amazingcarousel-image">
							
								<img width="692" height="471" src="<?php echo get_template_directory_uri(); ?>/imgs/slider-sample.png" />
								
							</div><!-- .amazingcarousel-image -->
							
							<div class="amazingcarousel-text">
							
								<div class="amazingcarousel-title">
								
									Slider 2 Title
									
								</div> <!-- .amazingcarousel-title -->
								
								<div class="amazingcarousel-description">
								
									Slider 2 Description <?php if ( is_user_logged_in() ) : echo "<a href=". get_admin_url() . "themes.php?page=lupercalia_options_page" ."> (add slider)</a>"; endif ?>
									
								</div> <!-- .amazingcarousel-description -->
								
							</div>	<!-- .amazingcarousel-text -->
								
						</li>

						<li>
							
							<div class="amazingcarousel-image">
							
								<img width="692" height="471" src="<?php echo get_template_directory_uri(); ?>/imgs/slider-sample.png" />
								
							</div> <!-- .amazingcarousel-image -->
							
							<div class="amazingcarousel-text">
							
								<div class="amazingcarousel-title">
								
									Slider 3 Title
									
								</div> <!-- .amazingcarousel-title -->
								
								<div class="amazingcarousel-description">
								
									Slider 3 Description <?php if ( is_user_logged_in() ) : echo "<a href=". get_admin_url() . "themes.php?page=lupercalia_options_page" ."> (add slider)</a>"; endif ?>
									
								</div> <!-- .amazingcarousel-description -->
								
							</div>	<!-- .amazingcarousel-text -->
								
						</li>						

					</ul> <!-- .slides -->
					
				</div> <!-- .flexslider- -->
			
			<?php endif; ?>
	
		</div> <!-- #branding -->
	
	<?php endif; ?>
	
<?php }

/* ------------------------------------------------------------------------- */	
/* Front Page Section Callback
/* Prints front page section.
/* ------------------------------------------------------------------------- */	
	
	function lupercalia_front_page_section_callback() {
		
		$middle_section1 = is_active_sidebar('front-page-middle-section-1');
		$middle_section2 = is_active_sidebar('front-page-middle-section-2');
		$middle_section3 = is_active_sidebar('front-page-middle-section-3'); 
		
		if ( !dynamic_sidebar('front-page-top-section') ) : endif;
		
		if ( $middle_section1 && $middle_section2 && $middle_section3 ) : ?>
		
			<section class="front-page-section front-page-middle-section clearfix">
			
				<div class="middle-section3">
				
					<?php dynamic_sidebar('front-page-middle-section-1'); ?>
					
				</div> <!-- .middle-section3 -->			
				
				<div class="middle-section3">
				
					<?php dynamic_sidebar('front-page-middle-section-2'); ?>
					
				</div> <!-- .middle-section3 -->
				
				<div class="middle-section3">
				
					<?php dynamic_sidebar('front-page-middle-section-3'); ?>
					
				</div> <!-- .middle-section3 -->
				
			</section>	
			
		<?php elseif ( $middle_section1 && $middle_section2 ) : ?>
		
			<section class="front-page-section front-page-middle-section clearfix">
			
				<div class="middle-section2">
				
					<?php dynamic_sidebar('front-page-middle-section-1'); ?>

				</div> <!-- .middle-section2 -->
				
				<div class="middle-section2">
				
					<?php dynamic_sidebar('front-page-middle-section-2'); ?>
					
				</div> <!-- .middle-section2 -->	
				
			</section>	
			
		<?php elseif ( $middle_section1 && $middle_section3 ) : ?>
		
			<section class="front-page-section front-page-middle-section clearfix">
			
				<div class="middle-section2">
				
					<?php dynamic_sidebar('front-page-middle-section-1'); ?>
					
				</div> <!-- .middle-section2 -->			
				
				<div class="middle-section2">
				
					<?php dynamic_sidebar('front-page-middle-section-3'); ?>
					
				</div> <!-- .middle-section2 -->	
				
			</section>	
			
		<?php elseif ( $middle_section2 && $middle_section3 ) : ?>
		
			<section class="front-page-section front-page-middle-section clearfix">
			
				<div class="middle-section2">
				
					<?php dynamic_sidebar('front-page-middle-section-2'); ?>
					
				</div> <!-- .middle-section2 -->
				
				<div class="middle-section2">
				
					<?php dynamic_sidebar('front-page-middle-section-3'); ?>
					
				</div> <!-- .middle-section2 -->	
				
			</section>	
			
		<?php elseif ( $middle_section3 ) : ?>
		
			<section class="front-page-section front-page-middle-section">
			
				<div class="middle-section1">
				
					<?php dynamic_sidebar('front-page-middle-section-3'); ?>
					
				</div> <!-- .middle-section1 -->
			
			</section>	
			
		<?php elseif ( $middle_section2 ) : ?>
		
			<section class="front-page-section front-page-middle-section">
			
				<div class="middle-section1">
				
					<?php dynamic_sidebar('front-page-middle-section-2'); ?>
					
				</div> <!-- .middle-section1 -->
				
			</section>	
			
		<?php elseif ( $middle_section1 ) : ?>
		
			<section class="front-page-section front-page-middle-section">
			
				<div class="middle-section1">
				
					<?php dynamic_sidebar('front-page-middle-section-1'); ?>
					
				</div> <!-- .middle-section1 -->
				
			</section>	
			
		<?php endif; ?>
		
		<div class="front-page-section front-page-middle-section">
		
			<?php lupercalia_front_page_slider(); ?>
		
		</div> <!-- .front-page-bottom-section -->
		
	<?php }
	
	
function lupercalia_wp_link_pages() {

	$defaults = array(
		'before'           => '<div class="pagination">',
		'after'            => '</div>',
		'link_before'      => '<span class="page-numbers">',
		'link_after'       => '</span>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( '&raquo;', 'lupercalia' ),
		'previouspagelink' => __( '&laquo;', 'lupercalia' ),
		'pagelink'         => '%',
		'echo'             => 1
	);
	
	wp_link_pages($defaults);
	
}					

/* ------------------------------------------------------------------------- */		
/* Post Meta Callback
/* Prints post category(is) and date.
/* ------------------------------------------------------------------------- */	

	function lupercalia_post_meta() {
	
		if ( ! is_page() ) : ?>	
		
			<span class="category">
			
				<span class="icon-check"></span>
				<small><?php the_category(', '); ?></small>
				
			</span> <!-- .category -->
			
			<span class="date">
				
				<span class="icon-calendar"></span>
				<small><?php echo get_the_date(); ?></small>
				
			</span> <!-- .date -->
		
		<?php endif;
	
	}

/* ------------------------------------------------------------------------- */		
/* Footer Section
/* Checks which footer widgets are being used and display them dynamically.
/* ------------------------------------------------------------------------- */	
	
	function lupercalia_footer_section_callback() {
		
		$footer1 = is_active_sidebar('footer-1');
		$footer2 = is_active_sidebar('footer-2');
		$footer3 = is_active_sidebar('footer-3');
		
		if ( $footer1 && $footer2 && $footer3 ) : ?>
		
			<div class="footer-section-wrap">
			
				<section class="footer-section clearfix">
				
					<div class="footer3">
					
						<?php dynamic_sidebar('footer-1'); ?>
						
					</div> <!-- .footer3 -->			
					
					<div class="footer3">
					
						<?php dynamic_sidebar('footer-2'); ?>
					
					</div>	<!-- .footer3 -->
					
					<div class="footer3">
					
						<?php dynamic_sidebar('footer-3'); ?>
					
					</div> <!-- .footer3 -->
					
				</section> <!-- .footer-section -->	
				
			</div> <!-- .footer-section-wrap -->	
			
		<?php elseif ( $footer1 && $footer2 ) : ?>
		
			<div class="footer-section-wrap">
			
				<section class="footer-section clearfix">
				
					<div class="footer2">
					
						<?php dynamic_sidebar('footer-1'); ?>
						
					</div> <!-- .footer2 -->			
					
					<div class="footer2">
						
						<?php dynamic_sidebar('footer-2'); ?>
						
					</div> <!-- .footer2 -->	
					
				</section> <!-- .footer-section -->	
				
			</div> <!-- .footer-section-wrap -->
			
		<?php elseif ( $footer1 && $footer3 ) : ?>
		
			<div class="footer-section-wrap">
			
				<section class="footer-section clearfix">
				
					<div class="footer2">
					
						<?php dynamic_sidebar('footer-1'); ?>
						
					</div> <!-- .footer2 -->			
					
					<div class="footer2">
						
						<?php dynamic_sidebar('footer-3'); ?>
						
					</div> <!-- .footer2 -->	
				
				</section> <!-- .footer-section -->	
			
			</div> <!-- .footer-section-wrap -->
			
		<?php elseif ( $footer2 && $footer3 ) : ?>
		
			<div class="footer-section-wrap">
			
				<section class="footer-section clearfix">
				
					<div class="footer2">
					
						<?php dynamic_sidebar('footer-2'); ?>
						
					</div> <!-- .footer2 -->		
					
					<div class="footer2">
					
						<?php dynamic_sidebar('footer-3'); ?>
					
					</div> <!-- .footer2 -->
				
				</section> <!-- .footer-section -->
			
			</div> <!-- .footer-section-wrap -->
			
		<?php elseif ( $footer3 ) : ?>
		
			<div class="footer-section-wrap">
			
				<section class="footer-section">
				
					<div class="footer1">
					
						<?php dynamic_sidebar('footer-3'); ?>
						
					</div> <!-- .footer1 -->
					
				</section> <!-- .footer-section -->
				
			</div> <!-- .footer-section-wrap -->
			
		<?php elseif ( $footer2 ) : ?>
		
			<div class="footer-section-wrap">
			
				<section class="footer-section">
				
					<div class="footer1">
					
						<?php dynamic_sidebar('footer-2'); ?>
						
					</div> <!-- .footer1 -->
					
				</section> <!-- .footer-section -->
				
			</div>	<!-- .footer-section-wrap -->		
			
		<?php elseif ( $footer1 ) : ?>
		
			<div class="footer-section-wrap">
			
				<section class="footer-section">
					
					<div class="footer1">
					
						<?php dynamic_sidebar('footer-1'); ?>
						
					</div> <!-- .footer1 -->
				
				</section>	<!-- .footer-section-wrap -->
			</div>
			
		<?php		
		
		endif;
	
	}	

/* ------------------------------------------------------------------------- */		
/* Sidebar Float Check
/* Return sidebar position for each page setted on theme setting page.
/* ------------------------------------------------------------------------- */		

function lupercalia_sidebar_float_check() {

	global $option;
	
	if ( is_home() ) :
		
		$sidebar = $option['sidebar_home_field'];

	elseif ( is_page() ) :
	
		$sidebar = $option['sidebar_page_field'];
		
	elseif ( is_single() ) :

		$sidebar = $option['sidebar_single_field'];
		
	elseif ( is_archive() ) :

		$sidebar = $option['sidebar_archive_field'];

	elseif ( is_search() ) :

		$sidebar = $option['sidebar_search_field'];	

	else :

		$sidebar = "right";	
	
	endif;
	
	if ( $sidebar == "left" ) :
	
		$sidebar = "float-right";
		
	else :
	
		$sidebar = "float-left";
		
	endif;
	
	return $sidebar;
}

/* ------------------------------------------------------------------------- */	
/* Breadcrumb Callback
/* Checks if breadcrumb is enabled and shows its content above navigation menu. 
/* ------------------------------------------------------------------------- */	

function lupercalia_breadcrumb() {
	
	global $post;
	$parent_id  = $parent_id_2 = $post->post_parent; 
	global $option;
	
	if ( !is_home() and !is_front_page() and $option['general_breadcrumb_field'] != "yes") : 
	
		echo "<div id='breadcrumb' class='breadcrumb'>"; 
	
		echo '<a href="' . esc_url( home_url() ) . '">Home</a>';
		
		if ( is_single() ) :
			echo " &raquo; "; 
			the_category(', ');
			echo " &raquo; "; 
			the_title(); 
			
		elseif ( is_category() ) :
			echo " &raquo; Category: "; 
			single_cat_title();

		elseif ( is_page() && $post->post_parent ) :
			echo ' &raquo; <a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . "</a>";
			echo ' &raquo; ';
			the_title();
			
		elseif ( is_page() ) :
			echo ' &raquo; ';
			the_title();
		
		elseif ( is_tag() ) :
			echo ' &raquo; ';
			esc_html__( 'Tag: ', 'lupercalia' );
			single_tag_title();
		
		elseif ( is_day() ) :
			echo ' &raquo; ';
			esc_html__( 'Archive: ', 'lupercalia' );
			echo get_the_date();
		
		elseif ( is_month() ) :
			echo " &raquo; "; 
			esc_html__( 'Archive: ', 'lupercalia' );
			echo get_the_date();
		
		elseif ( is_year() ) :
			echo " &raquo; "; 
			esc_html__( 'Archive: ', 'lupercalia' );
			echo get_the_date();
		
		elseif (is_author()) :
			echo " &raquo; Author: ";
			the_author();
		
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) :
			echo " &raquo; " . esc_html__('Site archives', 'lupercalia');
		
		elseif (is_search()) :
			echo " &raquo; " . esc_html__('Search result(s) for: ', 'lupercalia');
			the_search_query();
			
		elseif (is_404()) :
			echo " &raquo; " . esc_html__('Error 404: ', 'lupercalia');
			the_search_query();	
			
		endif;
		
		echo "</div>";
		
	endif;
}

/* ------------------------------------------------------------------------- */	
/*  Author Info Callback
/* ------------------------------------------------------------------------- */

function lupercalia_author_info() {

	if ( get_the_author_meta('description') ) : ?>
	
		<footer class="entry-footer clearfix">
			
			<div class="author-image">
			
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 105 ); ?>
				
			</div> <!-- .author-image -->
			
			<div class="author-description">
			
				<div class="author-name">
				
					<h4><?php the_author_posts_link(); ?></h4>
					
				</div> <!-- .author-name -->
				
					<?php the_author_meta('description'); ?>
					
			</div> <!-- .author-description -->
		
		</footer> <!-- .entry-footer -->
		
	<?php endif;
}

/* ------------------------------------------------------------------------- */	
/*  CUSTOM GALLERY
/* ------------------------------------------------------------------------- */

function lupercalia_post_gallery($output, $attr) {
    global $post, $slider_id;
	$slider_id++;
	
    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';
	
	$script = lupercalia_slider_script( array ( "visible_items" => $columns, "auto_play" => 'true', "mobile_items" => 1, "slider_id" => $slider_id ) );

    // Here's your actual output, you may customize it to your need
	$output = $script;
    $output .= "<div class='flexslider-" . $slider_id . "'>";
	$output .= "<ul class='slides'>";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
		// $img = wp_get_attachment_image_src($id, 'medium');
		// $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
        $img = wp_get_attachment_image_src($id, 'blog-featured');
		$url = wp_get_attachment_image_src($id, 'full');
		$title = $attachment->post_title;
		$description = $attachment->post_excerpt;		
		
        $output .= "<li>\n";
		
		$output .= "<div class='amazingcarousel-image'>";
		$output .= "<div class='gallery'>";
        $output .= "<a href=\"{$url[0]}\"><img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" /></a>\n";
		$output .= "</div>\n"; // <!-- .gallery -->
		$output .= "</div>\n"; 
		$output .= "<div class='amazingcarousel-text'>";
		$output .= "<div class='amazingcarousel-description'>";
		$output .= "<div class='gallery-caption'>";
		$output .= $title;
		$output .= "</div>\n"; // <!-- .gallery-caption -->
		$output .= "</div>\n"; // <!-- .amazingcarousel-description -->
		$output .= "</div>\n"; // <!-- .amazingcarousel-text -->
		
	
		$output .= "</li>\n";
    }

    $output .= "</ul>\n";
    $output .= "</div>\n";
	
    return $output;
}
add_filter('post_gallery', 'lupercalia_post_gallery', 10, 2);

/* ------------------------------------------------------------------------- */	
/*  CUSTOM COMMENTS LIST
/* ------------------------------------------------------------------------- */

function lupercalia_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		
			<?php if ( 'div' != $args['style'] ) : ?>
			
				<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
				
			<?php endif; ?>
			
			<div class="comment-meta commentmetadata">
			
				<div class="comment-meta-user">
				
					<div class="comment-author vcard">
			
						<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>	
				
					</div> <!-- .comment-author .vcard -->
					
				</div>	<!-- .comment-meta-user -->
				
				<div class="comment-meta-time">
				
					<?php echo get_comment_author_link(); ?><br />
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __('%1$s at %2$s', 'lupercalia' ), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'lupercalia'),'  ','' );
						?>
						
				</div> <!-- .comment-meta-time -->
				
			</div> <!-- .comment-meta .commentmetadata -->

			<?php if ($comment->comment_approved == '0') : ?>
			
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'lupercalia' ) ?></em><br />
			
			<?php endif; ?>
	
			<?php comment_text() ?>

			<div class="reply">
			
				<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				
			</div> <!-- .reply -->
		
			<?php if ( 'div' != $args['style'] ) : ?>
			
		</div> <!-- .comment-body -->
		
		<?php endif; ?>
<?php

}


add_action('wp_head', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}


