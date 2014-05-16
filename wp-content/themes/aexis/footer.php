<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Aexis
 * @since Aexis 1.0
 */
?>
    </div><!-- #main .container -->
    <footer id="main_footer" role="contentinfo">
        <div class="site-info">
            <?php do_action( 'twentytwelve_credits' ); ?>
            <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
</div><!-- #wrapper -->

<?php wp_footer(); ?>
</body>
</html>