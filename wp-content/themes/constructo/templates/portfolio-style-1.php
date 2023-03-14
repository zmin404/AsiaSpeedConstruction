<div class="col-md-8"><?php echo anps_header_media_portfolio_single(get_the_ID(), 'style-1'); ?></div>
<div class="col-md-4">
    <?php the_content(); ?>
    <div class="row">
        <div class="col-md-12 buttons folionav">
            <?php previous_post_link('%link', '<button class="btn btn-lg style-5"><i class="fa fa-angle-left"></i> &nbsp; ' . __('prev', 'constructo') . "</button>"); ?>
            <?php next_post_link('%link', '<button class="btn btn-lg style-5">' . __("next", 'constructo') . ' &nbsp; <i class="fa fa-angle-right"></i></button>'); ?>
        </div>
    </div>
</div>