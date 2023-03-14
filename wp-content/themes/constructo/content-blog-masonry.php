<?php 
global $blog_columns; 
global $counter_blog;
/* get blog categories */ 
$post_categories = wp_get_post_categories(get_the_ID()); 
/* get the content */ 
if(get_option("rss_use_excerpt") == "0"){ 
    global $more;
    $more = 0;
    $content_text = get_the_content('');
    $content_text = apply_filters('the_content', $content_text);
} else {                     
    global $more;
    $more = 0;
    //$content_text = get_the_excerpt(); 
    $content_text = apply_filters('the_excerpt', get_the_excerpt()); 
}
if($blog_columns==" col-md-3") {
    $image_class = "blog-masonry-3-columns";
} elseif($blog_columns==" col-md-4") {
    $image_class = "blog-masonry-3-columns";
} 
$sticky_class = "";
if(is_sticky(get_the_ID())) {
    $sticky_class = " post-sticky";
}
$post_data = "<article class='post".$blog_columns."$sticky_class'>";
$post_data .= "<header>";
if(is_sticky(get_the_ID()) && strlen(anps_header_media(get_the_ID())) > 0 ) {
$post_data .= "<div class='absolute stickymark'><div class='triangle-topleft hovercolor'></div><i class='nav_background_color fa fa-thumb-tack'></i></div>";
}
$post_data .= "<a class='post-hover' href='".get_permalink()."'>".anps_header_media(get_the_ID(), $image_class)."</a>";
if (is_sticky(get_the_ID()) && strlen(anps_header_media(get_the_ID(), $image_class)) < 1 ) {
$post_data .= "<a href='".get_permalink()."' title='".get_the_title()."'><h1><i class='fa fa-thumb-tack hovercolor'></i>&nbsp;".get_the_title()."</h1></a>";
 }
else {
    $post_data .= "<a href='".get_permalink()."' title='".get_the_title()."'><h1>".get_the_title()."</h1></a>";
}
if( get_option('anps_post_meta_date') != '1' ) {
   $post_data .= "<span class='post-meta-date'>".get_the_date()."</span>";
}
if( get_option('anps_post_meta_comments') != '1' ) {
    if( get_option('anps_post_meta_date') != '1' ) {
        $post_data .= " <span class='post-meta-divider'>/</span> ";
    }
    $post_data .= "<span class='post-meta-comments'>".get_comments_number()." "._n('comment', 'comments', get_comments_number(), 'constructo')."</span>";
}
$post_data .= "</header>";
$post_data .= "<div class='post-content'>".$content_text."</div>"; 
$post_data .= "</article>";
echo $post_data;