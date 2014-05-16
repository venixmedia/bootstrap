<?php get_header(); ?>

	<section id="content" class="content clearfix <?php echo lupercalia_sidebar_float_check(); ?>" role="main">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="entry-thumbnail">
					
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					
						<?php the_post_thumbnail('blog-featured'); ?>
					
					<?php endif; ?>
					
				</div> <!-- .entry-thumbnail -->			
				
				<header class="entry-header">
				
					<div class="entry-title">
					
						<h1 class="entry-title">
						
							<?php the_title(); ?>
							
						</h1>

					</div> <!-- .entry-title -->
				
				</header><!-- .entry-header -->

				
				<div class="entry-content">
				
					<?php the_content(); ?>
					
					<?php the_tags('<div class="tagcloud"> ', ' ' , '</div>'); ?> 
					
				</div> <!-- .entry-content -->

				<?php comments_template(); ?>
			
			</article> <!-- #post-id -->

	<?php endwhile?>
				
	<?php else: ?>
				
		<article>	
		
			<div class="entry-content">
						
				<p><?php _e( 'Not found', 'lupercalia' ); ?></p>
				<p><?php _e('Error 404', 'lupercalia'); ?> <br /> <?php _e('We are sorry, but not was found.', 'lupercalia'); ?> </p>		

			</div> <!-- .entry-content -->
			
		</article>
		
	<?php endif; ?>
	
	</section> <!-- #content -->	
				
	<?php get_sidebar(); ?>	
		
<?php get_footer(); ?>		