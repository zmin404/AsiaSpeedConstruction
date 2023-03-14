<?php
/* number of sidebars */
$meta = get_post_meta(get_queried_object_id());
$num_of_sidebars = 0;

$left_sidebar = get_option('post_sidebar_left');

if (isset($meta['sbg_selected_sidebar']) && $meta['sbg_selected_sidebar'][0] != "0") {
    if ($meta['sbg_selected_sidebar'][0] == "-1") {
        $left_sidebar = false;
    } else {
        $left_sidebar = $meta['sbg_selected_sidebar'][0];
    }
}

if ($left_sidebar) {
    $num_of_sidebars++;
}

/* Right Sidebar */

$right_sidebar = get_option('post_sidebar_right');

if (isset($meta['sbg_selected_sidebar_replacement']) && $meta['sbg_selected_sidebar_replacement'][0] != "0") {
    if ($meta['sbg_selected_sidebar_replacement'][0] == "-1") {
        $right_sidebar = false;
    } else {
        $right_sidebar = $meta['sbg_selected_sidebar_replacement'][0];
    }
}

if ($right_sidebar) {
    $num_of_sidebars++;
}

if ($num_of_sidebars == "0") {
    $image_class = "blog-full";
} else {
    $image_class = "large";
}

//var_dump($image_class); exit;
/* get blog categories */
$post_categories = wp_get_post_categories(get_the_ID());
?>
<?php if (anps_header_media_single(get_the_ID()) != "" && $num_of_sidebars > 0) : ?>
    <article <?php post_class('style-2'); ?>>
        <header>
            <?php echo anps_header_media_single(get_the_ID(), 'blog-full'); ?>

            <div class="post-meta">
                <ul>
                    <?php if (get_option('anps_post_meta_comments') != '1') : ?>
                        <li class="post-meta-comments"><i class='hovercolor fa fa-comment-o'></i><a href='<?php echo get_permalink() . "#comments"; ?>'><?php echo get_comments_number() . " " . _n('comment', 'comments', get_comments_number(), 'constructo'); ?></a></li>
                    <?php endif; ?>
                    <?php if (get_option('anps_post_meta_categories') != '1') : ?>
                        <li class="post-meta-categories"><i class='hovercolor fa fa-folder-o'></i><span>
                                <?php $first_item = false;
                                foreach ($post_categories as $c) {
                                    $cat = get_category($c);
                                    if ($first_item) {
                                        echo ", ";
                                    }
                                    $first_item = true;
                                    echo "<a href='" . get_category_link($c) . "'>" . $cat->name . "</a>";
                                } ?>
                            </span></li>
                    <?php endif; ?>
                    <?php if (get_option('anps_post_meta_author') != '1') : ?>
                        <li class="post-meta-author"><i class='hovercolor fa fa-user'></i><span><?php echo __("posted by", 'constructo') . " <a href='" . get_author_posts_url(get_the_author_meta('ID')) . "' class='author'>" . get_the_author() . "</a>"; ?></span></li>
                    <?php endif; ?>
                    <?php if (get_option('anps_post_meta_date') != '1') : ?>
                        <li class="post-meta-date"><i class='hovercolor fa fa-calendar'></i><span><?php echo get_the_date(); ?></span></li>
                    <?php endif; ?>
                </ul>
            </div>
        </header>
        <h1><?php the_title(); ?></h1>
        <div class="post-content"><?php the_content(); ?></div>
    </article>
<?php elseif ($num_of_sidebars == "0") : ?>
    <article <?php post_class('style-2'); ?>>
        <header class="text-center">
            <?php echo anps_header_media_single(get_the_ID(), 'blog-full'); ?>
            <h1 class="single-blog"><?php the_title(); ?></h1>
            <div class='post-meta'>
                <ul>
                    <?php if (get_option('anps_post_meta_comments') != '1') : ?>
                        <li class="post-meta-comments"><i class='fa fa-comment'></i><a href='<?php echo get_permalink() . "#comments"; ?>'><?php echo get_comments_number() . " " . __("comments", 'constructo'); ?></a></li>
                    <?php endif; ?>
                    <?php if (get_option('anps_post_meta_categories') != '1') : ?>
                        <li class="post-meta-categories"><i class='fa fa-folder-open'></i>
                            <?php
                            $first_item = false;
                            $post_data = "";
                            foreach ($post_categories as $c) {
                                $cat = get_category($c);
                                if ($first_item) {
                                    $post_data .= ", ";
                                }
                                $first_item = true;
                                $post_data .= "<a href='" . get_category_link($c) . "'>" . esc_html($cat->name) . "</a>";
                            } ?>
                            <?php echo $post_data; ?>
                        <?php endif; ?>
                        </li>
                        <?php if (get_option('anps_post_meta_author') != '1') : ?>
                            <li class="post-meta-author"><i class='fa fa-user'></i><?php echo __("posted by", 'constructo') . " <a href='" . get_author_posts_url(get_the_author_meta('ID')) . "' class='author'>" . get_the_author() . "</a>"; ?></li>
                        <?php endif; ?>
                        <?php if (get_option('anps_post_meta_date') != '1') : ?>
                            <li class="post-meta-date"><i class='fa fa-calendar'></i><?php echo get_the_date() ?></li>
                        <?php endif; ?>
                </ul>
            </div>
        </header>
        <div class='post-content'><?php echo the_content(); ?></div>
    </article>
<?php else : ?>
    <article <?php post_class('style-2'); ?>>
        <header>
            <?php if (get_option('anps_post_meta_date') != '1') : ?>
                <span><?php echo get_the_date("j.m.Y") ?></span>
            <?php endif; ?>
            <h1><?php the_title(); ?></h1>
            <div class='post-meta'>
                <ul>
                    <?php if (get_option('anps_post_meta_comments') != '1') : ?>
                        <li><i class='fa fa-comment'></i><a href='<?php echo get_permalink() . "#comments"; ?>'><?php echo get_comments_number() . " " . __("comments", 'constructo'); ?></a></li>
                    <?php endif; ?>
                    <?php if (get_option('anps_post_meta_categories') != '1') : ?>
                        <li><i class='fa fa-folder-open'></i>
                            <?php
                            $first_item = false;
                            $post_data = "";
                            foreach ($post_categories as $c) {
                                $cat = get_category($c);
                                if ($first_item) {
                                    $post_data .= ", ";
                                }
                                $first_item = true;
                                $post_data .= "<a href='" . get_category_link($c) . "'>" . esc_html($cat->name) . "</a>";
                            } ?>
                            <?php echo $post_data; ?>
                        </li>
                    <?php endif; ?>
                    <?php if (get_option('anps_post_meta_author') != '1') : ?>
                        <li><i class='fa fa-user'></i><?php echo __("posted by", 'constructo') . " <a href='" . get_author_posts_url(get_the_author_meta('ID')) . "' class='author'>" . get_the_author() . "</a>"; ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </header>
        <div class='post-content'><?php echo the_content(); ?></div>
    </article>
<?php endif; ?>