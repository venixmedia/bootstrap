<?php get_header(); ?>

	<section id="content" class="content clearfix <?php echo lupercalia_sidebar_float_check(); ?>" role="main">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="entry-thumbnail">
					
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					
						<?php the_post_thumbnail('blog-featured'); ?>
						
					<?php else : ?>

						<img src="<?php echo get_template_directory_uri(); ?>/imgs/no-thumbnail.jpg" />
					
					<?php endif; ?>
					
					</div> <!-- .entry-thumbnail -->			
				
				<header class="entry-header">
				
					<div class="entry-title">
					
						<div class="entry-meta">
						
							<?php lupercalia_post_meta(); ?>
							
						</div> <!-- .entry-meta -->

						<h1 class="entry-title">
						
							<?php the_title(); ?>
							
						</h1>

					</div> <!-- .entry-title -->
				
				</header><!-- .entry-header -->

				
				<div class="entry-content">
				
					<?php the_content(); ?>
					
					<?php lupercalia_wp_link_pages(); ?>
					
					<?php the_tags('<div class="tagcloud"> ', ' ' , '</div>'); ?> 
					
				</div> <!-- .entry-content -->
				
				<?php lupercalia_author_info(); ?>
				
				<?php lupercalia_relatedpost(); ?>
	
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