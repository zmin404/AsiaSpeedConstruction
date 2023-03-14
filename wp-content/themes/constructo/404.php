<?php
$error_page = get_option('anps_error_page', '0');
if($error_page != '0') {
    $args = array(
    'p' => $error_page,
    'post_type' => 'page');

    query_posts( $args );

    the_post();
}
?>
<?php get_header(); ?>
<section class="container">
<?php
	if(isset($error_page) && $error_page != '0') {
		query_posts('post_type=page&p=' . $error_page);
                
        while(have_posts()) { the_post();
            the_content();
        }
        
        wp_reset_query();
	} else {
		?>
			<h1 style="text-align: center;"><?php _e('It seems that something went wrong!', 'constructo'); ?></h1>
			<h6 style="text-align: center;"><span style="color: #c7c7c7;"><?php _e('This page does not exist.', 'constructo'); ?></span></h6>
		<?php
	}
?>
</section>
<?php get_footer(); ?>