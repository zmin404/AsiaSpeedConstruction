<?php global $blog_class, $blog_post_class, $counter, $number_of_columns; ?>
<?php $post = get_post(get_the_ID()); ?>
    <?php $post_category = get_the_category(get_the_ID()); ?>
    <?php $proceed = true; ?>
    <?php if (isset($post_category[0]->category_parent) && $post_category[0]->category_parent != 0): ?>
        <?php $category_parent = get_the_category_by_ID($post_category[0]->category_parent); ?>
        <?php
        if ($category_parent == "Portfolio") {
            $proceed = false;
        }
        ?>
    <?php endif; ?>
    <?php if ($proceed): ?>
        <?php if ($blog_class == "blog-two-column" || $blog_class == "blog-three-column" || $blog_class == "blog-four-column"): ?>
            <?php
            if ($counter == $number_of_columns || $first) {
                $counter = 0;
                $first = false;
            }
            ?>
        <?php endif; ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix " . $blog_post_class); ?>>
            <?php $check_if_text_only = true; ?>
            <?php if (strpos(get_post_field('post_content', get_the_ID()), '[vimeo hide="true"]') > -1): ?>
            <?php
            $check_if_text_only = false;
            $content = get_post_field('post_content', get_the_ID());
            $start = strpos($content, '[vimeo hide="true"]');
            $end = strpos($content, "[/vimeo]");
            echo "<div class='video-outer video-see'>" . do_shortcode(substr($content, $start, $end - $start + 8)) . "</div>";
            ?>
                        <?php elseif (strpos(get_post_field('post_content', get_the_ID()), '[youtube hide="true"]') > -1): ?>
        <?php
        $check_if_text_only = false;
        $content = get_post_field('post_content', get_the_ID());
        $start = strpos($content, '[youtube hide="true"]');
        $end = strpos($content, "[/youtube]");
        echo "<div class='video-outer video-see'>" . do_shortcode(substr($content, $start, $end - $start + 10)) . "</div>";
        ?>
            <?php elseif (get_the_post_thumbnail($post->ID, $blog_class) == ""): ?>
            <?php else: ?>
                <div class="post-media">
                    <?php $wp_image_class = explode(' ', $blog_class); ?>
                    <?php echo get_the_post_thumbnail($post->ID, $wp_image_class[0]); ?>
                </div>
            <?php endif; ?>
            
            <div class="post-inner">
            <header class="clearfix">
                <h2>
                    <?php the_title(); ?>
                    <span><?php echo get_the_date(); ?></span>
                    <span class="glyphicon first glyphicon-calendar"></span>
                </h2>
                <div class="post-meta">
                    <span class="first glyphicon glyphicon-user"></span>
                    <span><?php echo get_the_author(); ?></span>
                    <span class="glyphicon glyphicon-tag"></span>
                    
                    <?php
                        $categories = wp_get_post_categories(get_the_ID());
                        foreach ($categories as $cat) {
                            $cat = get_category($cat);
                            echo '<a class="post-meta-cat" href="' . get_category_link( $cat ) . '">' . esc_html($cat->name) . '</a>';
                        }
                    ?>
                    <span class="glyphicon glyphicon-comment"></span>
                    <a href="<?php echo the_permalink(); ?>#comments"><?php echo __('Comments', 'constructo'); ?> / <?php echo esc_html($post->comment_count); ?></a>
                </div>
            </header>
            <?php
                $meta = get_post_meta(get_the_ID());
                $gallery_images = $meta["gallery_images"]; 
            ?>
            <div class="post-content">
                <?php the_content(); ?>                  
            </div>
        </div>
        <?php
            $posttags = get_the_tags();
            if ($posttags):?>
                <footer>
                    <span class="glyphicon first glyphicon-tag"></span>
                    <?php
                        $first_tag = true;
                        foreach ($posttags as $tag) {
                            if ( ! $first_tag) {
                                echo ' / ';
                            }
                            echo '<a href="' . esc_url(home_url('/')) . 'tag/' . esc_html($tag->slug). '/">';
                            echo esc_html($tag->name);
                            echo '</a>';
                            $first_tag = false;
                        }
                    ?>
                </footer>
        <?php endif; ?>
    </article>
    <?php
    if ($counter == $number_of_columns) {
        echo "<div class='clearfix'></div>";
    }
    ?>
<?php endif; ?>