<?php
$coming_soon = anps_get_option('', '0', 'coming_soon');
if (($coming_soon || $coming_soon != "0") && !is_super_admin()) {
    get_header();
    $post_soon = get_post($coming_soon);
    echo do_shortcode($post_soon->post_content);
    get_footer();
} else {
    $meta = get_post_meta(get_queried_object_id());
    $num_of_sidebars = 0;
    $left_sidebar = 0;
    if (isset($meta['sbg_selected_sidebar'])) {
        $left_sidebar = $meta['sbg_selected_sidebar'];
        if ($left_sidebar[0] != "0") {
            $num_of_sidebars++;
        }
    }
    $right_sidebar = 0;
    if (isset($meta['sbg_selected_sidebar_replacement'])) {
        $right_sidebar = $meta['sbg_selected_sidebar_replacement'];
        if ($right_sidebar[0] != "0") {
            $num_of_sidebars++;
        }
    }
    /* The loop */
    get_header();


    global $row_inner;

    if ($num_of_sidebars > 0) {
        $row_inner = true;
    }
?>
    <section class="container">
        <div class="row">
            <?php
            if ($num_of_sidebars == 0) {
                echo '<div class="col-md-12">';
            }
            ?>

            <?php if (have_posts()) : ?>
                <?php if (isset($left_sidebar[0]) && $left_sidebar[0] != "0" && $left_sidebar[0] != null) : ?>
                    <aside class="sidebar col-md-<?php if ($num_of_sidebars == 1) {
                                                        echo "3";
                                                    } else if ($num_of_sidebars == 2) {
                                                        echo "3";
                                                    } ?>">
                        <ul>
                            <?php dynamic_sidebar($left_sidebar[0]);
                            wp_reset_query(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>

                <?php if ($num_of_sidebars == 0) : ?>
                    <?php

                    if (get_post_type() == 'post') {
                        echo do_shortcode("[blog]");
                    } else {
                        while (have_posts()) {
                            the_post();
                            get_template_part('content', get_post_format());
                        }
                    }
                    ?>
                <?php else : ?>

                    <div class='col-md-<?php echo 12 - esc_attr($num_of_sidebars) * 3; ?>'>
                        <?php
                        if (get_post_type() == 'post') {
                            echo do_shortcode("[blog]");
                        } else {
                            while (have_posts()) {
                                the_post();
                                get_template_part('content', get_post_format());
                            }
                        }
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($right_sidebar[0]) && $right_sidebar[0] != "0") : ?>
                    <aside class="sidebar col-md-<?php if ($num_of_sidebars == 1) {
                                                        echo "3";
                                                    } else if ($num_of_sidebars == 2) {
                                                        echo "3";
                                                    } ?>">
                        <ul>
                            <?php dynamic_sidebar($right_sidebar[0]); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            <?php endif; /* end if posts */ ?>

            <?php
            if ($num_of_sidebars == 0) {
                echo '</div>'; /* end no sidebars wrapper */
            }
            ?>
        </div>
    </section>
<?php get_footer();
}
