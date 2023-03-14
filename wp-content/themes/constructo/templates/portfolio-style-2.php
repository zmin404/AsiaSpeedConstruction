<?php
    global $num_of_sidebars;
    $class_left = $num_of_sidebars > 0 ? 'col-md-12' : 'col-md-8';
    $class_right = $num_of_sidebars > 0 ? 'col-md-12' : 'col-md-4';
?>
<div class="row">
    <div class="<?php echo esc_attr($class_left); ?>">
        <?php
        $hide_img = get_post_meta($post->ID, $key ='anps_hide_portfolio_img', $single = true );
        if($hide_img==0) {
            echo anps_header_media_portfolio_single(get_the_ID(), 'style-2');
        }
        ?>
    </div>
    <div class="<?php echo esc_attr($class_right); ?>">
        <?php the_content(); ?>
    </div>
</div>