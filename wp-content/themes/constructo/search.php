<?php get_header(); ?>
<div class="container search-page">
    <?php if ( have_posts() ) : $num = wp_count_posts(); ?>
        <ol class="search-posts">
            <?php while ( have_posts() ) : the_post(); ?>
                <li>
                    <a href="<?php echo the_permalink(); ?>">
                        <h2><i class="fa fa-check-square-o"></i><?php the_title(); ?></h2>
                    </a>
                </li>
            <?php endwhile; ?>
        </ol>
        <?php  get_template_part('includes/pagination'); ?>
    <?php else : ?>
        <h2 class="no-results"><?php _e('no results found for:', 'constructo'); ?> <span><?php echo esc_attr($_GET['s']); ?></span></h2>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
