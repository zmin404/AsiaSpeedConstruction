<?php
    if ( ! is_active_sidebar( 'copyright-footer-left'  ) && ! is_active_sidebar( 'copyright-footer-right' )) { return; }
?>
<div class="copyright-footer">
    <div class="container clearfix">
        <div class="row-fluid">
            <?php if ( is_active_sidebar( 'copyright-footer-left' ) ) : ?>
                <ul class="col-md-7">
                    <?php do_shortcode(dynamic_sidebar( 'copyright-footer-left' )); ?>
                </ul>
            <?php endif; ?>

            <?php if ( is_active_sidebar( 'copyright-footer-right' ) ) : ?>
                <ul class="col-md-5">
                    <?php do_shortcode(dynamic_sidebar( 'copyright-footer-right' )); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>