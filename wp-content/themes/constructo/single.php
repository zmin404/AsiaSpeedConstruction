<?php
$coming_soon = anps_get_option('', '0', 'coming_soon');
if(($coming_soon || $coming_soon!="0")&&!is_super_admin()) {
    get_header();
    $post_soon = get_post($coming_soon);
    echo do_shortcode($post_soon->post_content);
    get_footer();
} else {
get_header(); 
$meta = get_post_meta(get_the_ID());
$num_of_sidebars = 0;

/* Left Sidebar */

$left_sidebar = anps_get_option('', '', 'post_sidebar_left');

if( isset($meta['sbg_selected_sidebar']) && $meta['sbg_selected_sidebar'][0] != "0" ) {
    if( $meta['sbg_selected_sidebar'][0] == "-1" ) {
        $left_sidebar = false;
    } else {
        $left_sidebar = $meta['sbg_selected_sidebar'][0];
    }
}

if ( $left_sidebar ) {
    $num_of_sidebars++;
}

/* Right Sidebar */

$right_sidebar = anps_get_option('', '', 'post_sidebar_right');

if (isset($meta['sbg_selected_sidebar_replacement']) && $meta['sbg_selected_sidebar_replacement'][0] != "0") {
    if( $meta['sbg_selected_sidebar_replacement'][0] == "-1" ) {
        $right_sidebar = false;
    } else {
        $right_sidebar = $meta['sbg_selected_sidebar_replacement'][0];
    }
}

if( $right_sidebar ) {
    $num_of_sidebars++;
}

global $row_inner;

if ($num_of_sidebars > 0) {
    $row_inner = true;
}
?>
<?php
 // if(get_post_type() == "post") : ?>
<section class="blog-single">
    <div class="container">
        <div class="row">
        <?php if ($left_sidebar != "0" && $left_sidebar != "-1" && $left_sidebar): ?>
            <aside class="sidebar col-md-<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?>">
            	<ul><?php dynamic_sidebar($left_sidebar); ?></ul>
            </aside>   
	<?php endif; ?>
        <div class="<?php if($num_of_sidebars == 1) { echo "col-md-9"; } else if($num_of_sidebars == 2) { echo "col-md-6"; } else { echo "col-md-12"; } ?>">
<?php while(have_posts()) {
    the_post(); 
    get_template_part( 'content-single-blog', get_post_format() );
    wp_link_pages();
    comments_template();
    break;
}    
//endif; ?>
        </div>
         <?php if ($right_sidebar != "0" && $right_sidebar != "-1" && $right_sidebar): ?>
            <aside class="sidebar col-md-<?php if($num_of_sidebars == 1) { echo "3"; } else if($num_of_sidebars == 2) { echo "3"; } ?>">
            	<ul>
            		<?php dynamic_sidebar($right_sidebar); ?>
            	</ul>	
            </aside>   
        <?php endif; ?>
      </div>
      </div>
</section>
<?php get_footer(); 
} ?>