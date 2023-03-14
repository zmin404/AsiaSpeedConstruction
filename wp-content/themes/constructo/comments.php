<?php if ( post_password_required() ) : ?>
<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'constructo'); ?></p>
<?php return; endif; ?>
<?php if ( have_comments() ) : ?>
    <h4 id="comments" class="comments-title"><?php echo __('Comments', 'constructo') . " (".get_comments_number().")"; ?></h4>
	<ul class="comment-list">
        <?php
    	   wp_list_comments(array( 'callback' => 'anps_comment' ));
        ?>
	</ul>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<?php previous_comments_link( __( '&larr; Older Comments', 'constructo') ); ?>
	<?php next_comments_link( __( 'Newer Comments &rarr;', 'constructo') ); ?>
<?php endif; ?>
<?php else :
	if ( ! comments_open() ) :
?>
	<p class="comments-closed"><?php _e( 'Comments are closed.', 'constructo'); ?></p>
<?php endif; ?>
<?php endif; ?>


<?php
if(!isset($fields)) {
    $fields =  array(
        'author' => '<div class="form-group"><input type="text" id="author" name="author" placeholder="'. __( 'Name', 'constructo').'"><i class="fa fa-user"></i></div>',
        'email'  => '<div class="form-group"><input type="text" id="email" name="email" placeholder="'. __( 'E-mail', 'constructo').'"><i class="fa fa-envelope"></i></div>'
    );
}
if ( is_user_logged_in() ) {
    $defaults = array(
    'fields'               => apply_filters( 'comment_form_default_fields', $fields),
    'comment_field'        => '<div class="col-md-12"><textarea id="message" placeholder="' . __("Message", 'constructo') . '" name="comment" rows="5"></textarea></div></div>',
    'must_log_in'          => '<p class="must-log-in">You must be logged in to leave a reply.</p>',
    'logged_in_as'         => '<h4 class="comment-heading">' . __('Post comment', 'constructo') . '</h4><div class="row contact-form">',
    'comment_notes_before' => '<h2 class="comment-heading">' . __('Leave a reply', 'constructo') . '</h2><div id="comment-form">',
    'title_reply' => '',
    'comment_notes_after'  => '<div class="contact-buttons text-left"><button type="reset" class="btn btn-md">' . __('Reset', 'constructo') . '</button>
                               <button data-form="submit" class="btn btn-md">' . __('Submit', 'constructo') . '</button>
                               </div>',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit'
 );
} else {
    $defaults = array(
    'fields'               => apply_filters( 'comment_form_default_fields', $fields),
    'comment_field'        => '</div><div class="col-md-7"><textarea id="message" placeholder="' . __("Message", 'constructo') . '" name="comment" rows="5"></textarea></div>',
    'must_log_in'          => '<p class="must-log-in">You must be logged in to leave a reply.</p>',
    'logged_in_as'         => '<div class="row contact-form"><h4 class="comment-heading">' . __('Post comment', 'constructo') . '</h4>',
    'comment_notes_before' => '<h4 class="comment-heading">' . __('Post comment', 'constructo') . '</h4><div class="row contact-form"><div class="col-md-5">',
    'title_reply' => '',
    'comment_notes_after'  => '</div><div class="contact-buttons text-left"><button type="reset" class="btn btn-md">' . __('Reset', 'constructo') . '</button>
                               <button data-form="submit" class="btn btn-md">' . __('Submit', 'constructo') . '</button>
                               </div>',
    'id_form'              => 'commentform',
    'id_submit'            => 'submit'
 );
}
comment_form( $defaults );
