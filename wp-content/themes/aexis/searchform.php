<form role="search" method="get" class="search-form form-horizontal" action="<?php echo(esc_url(home_url( '/' ))); ?>">
    <div class="form-group">
        <label>
            <span class="screen-reader-text"><?php printf(_x( 'Search for:', 'label' )); ?></span>
            <input type="search" class="search-field form-control" placeholder="<?php printf(esc_attr_x( 'Search &hellip;', 'placeholder' )); ?>" value="<?php get_search_query(); ?>" name="s" title="<?php printf(esc_attr_x( 'Search for:', 'label' )); ?>" />
        </label>
        <input type="submit" class="search-submit btn btn-default" value="<?php echo(esc_attr_x( 'Search', 'submit button' )); ?>" />
    </div>
</form>
