<?php
get_header();

global $blog_class, $blog_post_class, $counter, $number_of_columns;
?>

<div class="site-content container" role="main">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <article class="post style-2" id="post-<?php the_ID(); ?>" <?php post_class("clearfix " . $blog_post_class); ?>>
            <?php $check_if_text_only = true; ?>
            <?php if (strpos(get_post_field('post_content', get_the_ID()), "[vimeo]") > -1): ?>
            <?php
            $check_if_text_only = false;
            $content = get_post_field('post_content', get_the_ID());
            $start = strpos($content, "[vimeo]");
            $end = strpos($content, "[/vimeo]");

            echo "<div class='video-outer'>" . do_shortcode(substr($content, $start, $end - $start + 8)) . "</div>";
            ?>
                        <?php elseif (strpos(get_post_field('post_content', get_the_ID()), "[youtube]") > -1): ?>
        <?php
        $check_if_text_only = false;
        $content = get_post_field('post_content', get_the_ID());
        $start = strpos($content, "[youtube]");
        $end = strpos($content, "[/youtube]");

        echo "<div class='video-outer'>" . do_shortcode(substr($content, $start, $end - $start + 10)) . "</div>";
        ?>
            <?php elseif (get_the_post_thumbnail($post->ID, $blog_class) == ""): ?>

            <?php else: ?>
                <div class="post-media">
                    <?php $wp_image_class = explode(' ', $blog_class); ?>
                    <?php echo get_the_post_thumbnail($post->ID, $wp_image_class[0]); ?>
                </div>
            <?php endif; ?>

            <div class="post-inner">
    <header>
        <?php echo anps_header_media_single(get_the_ID(), 'blog-full'); ?>


    </header>

            <?php
                $meta = get_post_meta(get_the_ID());
                $gallery_images;

                if( isset( $meta["gallery_images"] ) ) {
                    $gallery_images = $meta["gallery_images"];
                }
            ?>

            <div class="post-content nobuttontopmargin">

                <div class="text-center">
				<?php if ( wp_attachment_is_image() ) :
					$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
					foreach ( $attachments as $k => $attachment ) {
						if ( $attachment->ID == $post->ID )
							break;
					}
					$k++;
					// If there is more than 1 image attachment in a gallery
					if ( count( $attachments ) > 1 ) {
						if ( isset( $attachments[ $k ] ) )
							// get the URL of the next image attachment
							$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
						else
							// or get the URL of the first image attachment
							$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
					} else {
						// or, if there's only 1 image attachment, get the URL of the image
						$next_attachment_url = wp_get_attachment_url();
					}
				?>
										<p><a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
											$attachment_size = apply_filters( 'widebox_attachment_size', 900 );
											echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
										?></a></p>
				<?php else : ?>
										<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
				<?php endif; ?>


                <div class="post-meta text-center">
                    <ul>
                        <li><i class='hovercolor fa fa-comment-o'></i><a href='<?php echo get_permalink() . "#comments"; ?>'><?php echo get_comments_number()." ".__("comments", 'constructo'); ?></a></li>
                        <li><i class='hovercolor fa fa-user'></i><span><?php echo __("posted by", 'constructo')." <a href='".get_author_posts_url(get_the_author_meta('ID'))."' class='author'>".get_the_author()."</a>"; ?></span></li>
                        <li><i class='hovercolor fa fa-calendar'></i><span><?php echo get_the_date(); ?></span></li>
                    </ul>
                </div>
                <?php the_content(); ?>
                </div>
				<?php comments_template(); ?>

				<?php endwhile; ?>

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

                            echo '<a href="' . esc_url(home_url('/')) . 'tag/' . $tag->slug . '/">';
                            echo esc_html($tag->name);
                            echo '</a>';

                            $first_tag = false;

                        }
                    ?>
                </footer>
        <?php endif; ?>

    </article>

</div>

<?php get_footer(); ?>
