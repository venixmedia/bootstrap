<?php get_header();

	if ( 'posts' == get_option( 'show_on_front' ) ) :
	
		get_template_part('index');
		
	else :
	
		echo lupercalia_front_page_section_callback();
		
	endif;
	
get_footer(); ?>