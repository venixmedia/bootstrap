/* ==========================================================================
   Menu Mobile Toggle
   ========================================================================== */
   
	jQuery(document).ready(function($){
		
		jQuery('.main-navigation').append('<div class="mobile-toggle"></div>');
	 
		jQuery(".mobile-toggle").on("click", function(){
		
			jQuery(".nav-menu").slideToggle("fast");
			jQuery(this).toggleClass("active");
			
		});
		
	});	
	
/* ==========================================================================
   Sidebar Mobile Toggle
   ========================================================================== */	
   
	jQuery(document).ready(function($){
		
		jQuery('.sidebar').append('<div class="sidebar-toggle"></div>');
	 
		jQuery(".sidebar-toggle").on("click", function(){
		
			jQuery(".sidebar .widget").slideToggle("fast");
			jQuery(this).toggleClass("active");
			
		});
		
	});

/* ==========================================================================
   Social Icon Fade
   ========================================================================== */	
	
	jQuery(".social ul li").hover(function() { // Mouse over
	
			jQuery(this).siblings().stop().fadeTo(300, 0.3);
			jQuery(this).parent().siblings().stop().fadeTo(0, 1); 
			
	}, function() { // Mouse out
	
			jQuery(this).siblings().stop().fadeTo(300, 1);
			jQuery(this).parent().siblings().stop().fadeTo(300, 1);
			
	});
	
/* ==========================================================================
   ColorBox Lightbox
   ========================================================================== */	

	jQuery(document).ready(function($){	

  	jQuery("a[href$='.jpg'], a[href$='.png'], a[href$='.jpeg'], a[href$='.gif']").magnificPopup({type:'image'});

	jQuery(".gallery a[href$='.jpg'], .gallery a[href$='.png'], .gallery a[href$='.jpeg'], .gallery a[href$='.gif']").attr('rel','gallery').magnificPopup({type:'image', gallery:{
    enabled:true}});		

	});	