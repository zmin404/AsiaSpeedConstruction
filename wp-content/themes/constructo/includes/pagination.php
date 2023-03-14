<?php 
global $wp_rewrite;			
if(isset($wp_query->query_vars['paged'])&&$wp_query->query_vars['paged']>1) {
    $current = $wp_query->query_vars['paged'];
} elseif(isset($wp_query->query_vars['page'])&&$wp_query->query_vars['page']>1) {
    $current = $wp_query->query_vars['page']; 
} else {
    $current = 1;
}
$pagination = array(
	'base' => @esc_url(add_query_arg('page','%#%')),
	'format' => '',
	'total' => $wp_query->max_num_pages,
	'current' => $current,
	'show_all' => false,
        'prev_text'    => '',
        'next_text'    => '',
	'type' => 'list',
	);
if( $wp_rewrite->using_permalinks() )
	$pagination['base'] = user_trailingslashit( trailingslashit( esc_url(remove_query_arg('s',get_pagenum_link(1)) ) ) . 'page/%#%/', 'paged');
if( !empty($wp_query->query_vars['s']) )
	$pagination['add_args'] = array('s'=>get_query_var('s')); ?>
<div class="page-numbers-wrapper"><?php echo paginate_links($pagination); ?></div>
<div class="none">
	<?php wp_link_pages(""); ?>
</div>