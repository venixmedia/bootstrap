<?php get_header(); ?>
<div class="row">
    <section class="col-xs-12 col-sm-9">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-thumbnail">			
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('blog-featured'); ?></a>
                    <?php else : ?>
                        <a href="<?php the_permalink() ?>"><img width="692" height="471" src="<?php echo get_template_directory_uri(); ?>/imgs/no-thumbnail.jpg" /></a>
                    <?php endif; ?>
                </div> <!-- .entry-thumbnail -->	

                <div class="entry-hover">
                    <header class="entry-header">
                        <div class="entry-title">
                            <div class="entry-meta">
                                <?php lupercalia_post_meta(); ?>
                            </div> <!-- .entry-meta -->
                            <h3 class="entry-title">
                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                            </h3>
                        </div> <!-- .entry-title -->
                    </header><!-- .entry-header -->
                    <div class="entry-content">
                            <?php the_excerpt(); ?>
                    </div> <!-- .entry-content -->
                    <div class="content-fade"></div> <!-- .content-fade -->
                </div> <!-- .entry-hover -->
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
        <?php lupercalia_pagination(); ?>
    </section>	
    <section class="col-xs-12 col-sm-3">
        <?php get_sidebar(); ?>	
    </section>			
<?php get_footer(); ?>		