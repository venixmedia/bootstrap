<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div id="single_page" class="rows">
    <section id="content" role="main" class="col-xs-12 col-sm-9">
        <?php while ( have_posts() ) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content">
                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->
            <footer class="entry-meta">
                <?php twentytwelve_entry_meta(); ?>
                <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
                <?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
                    <div class="author-info">
                        <div class="author-avatar">
                            <?php
                                /** This filter is documented in author.php */
                                $author_bio_avatar_size = apply_filters( 'twentytwelve_author_bio_avatar_size', 68 );
                                echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
                            ?>
                        </div><!-- .author-avatar -->
                        <div class="author-description">
                            <h2><?php printf( __( 'About %s', 'twentytwelve' ), get_the_author() ); ?></h2>
                            <p><?php the_author_meta( 'description' ); ?></p>
                            <div class="author-link">
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                    <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentytwelve' ), get_the_author() ); ?>
                                </a>
                            </div><!-- .author-link	-->
                        </div><!-- .author-description -->
                    </div><!-- .author-info -->
                <?php endif; ?>
            </footer>
        </article>

            <?php //get_template_part( 'content', get_post_format() ); ?>

            <nav class="nav-single">
                <h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
                <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> %title' ); ?></span>
                <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
            </nav><!-- .nav-single -->

            <?php comments_template( '', true ); ?>

        <?php endwhile; // end of the loop. ?>
    </section><!-- #content -->
    <section id="sidebar_section" class="col-xs-12 col-sm-3">
        <?php get_sidebar(); ?>
    </section><!-- #sidebar_section -->
</div><!-- #primary -->

<?php get_footer(); ?>