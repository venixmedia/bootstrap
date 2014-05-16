<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Aexis
 * @since Twenty Aexis
 */

get_header(); ?>

<div id="primary" class="rows">
    <section id="content" role="main" class="col-xs-12 col-sm-9">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php// get_template_part( 'content', 'page' ); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                </div><!-- .entry-content -->

                <footer class="entry-meta">
                    <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-meta -->
            </article><!-- #post -->

            <?php// comments_template( '', true ); ?>
        <?php endwhile; // end of the loop. ?>
    </section><!-- #content -->
    <section id="sidebar_section" class="col-xs-12 col-sm-3">
        <?php get_sidebar(); ?>
    </section><!-- #sidebar_section -->
</div><!-- #primary -->

<?php get_footer(); ?>