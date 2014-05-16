<?php
    /*
        Template Name: Blog Post
    */
?>
<?php get_header(); the_post();?>
<div class="row">
    <section class="col-xs-12 col-sm-9">
	<?php
         //   print_r($post);
        ?>
        <section class="col-xs-12 col-sm-9">
            <h1><?php echo $post->post_title; ?></h1>
            <p><?php echo $post->post_content; ?></p>
        </section>
        <section class="col-xs-12 col-sm-3">
            <?php if(get_post_meta($post->ID, 'intro', true)): ?>
            <div class="qoute_box">
                <p><?php echo get_post_meta($post->ID, 'intro', true); ?></p>
            </div>
            <?php endif; ?>
        </section>
        
    </section> 	
    <section class="col-xs-12 col-sm-3">
        <?php get_sidebar(); ?>	
    </section>			
<?php get_footer(); ?>