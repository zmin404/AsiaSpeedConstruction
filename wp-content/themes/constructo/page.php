<?php
$coming_soon = anps_get_option('', '0', 'coming_soon');

if(($coming_soon || $coming_soon!="0")&&!is_super_admin()) {
    $post_soon = new WP_Query( 'p=' . $coming_soon . '&post_type=page' );

    while ($post_soon->have_posts()) {
        $post_soon->the_post();
        get_header();
        echo '<div class="container">';
        echo the_content();
        echo '</div>';
        get_footer();
    }
    wp_reset_postdata();
} else {
get_header();?>
<?php if (get_option('anps_vc_legacy', '0') == 'on') {
    get_template_part( 'templates/template-legacy', 'page' );
} else {
    get_template_part( 'templates/template', 'page' );
}
?>

<?php get_footer();
} ?>
