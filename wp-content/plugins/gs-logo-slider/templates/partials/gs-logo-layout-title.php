<?php

/**
 * GS Logo Slider - Logo Title Layout
 * @author GS Plugins <hello@gsplugins.com>
 * 
 * This template can be overridden by copying it to yourtheme/gs-logo/partials/gs-logo-layout-title.php
 * 
 * @package GS_Logo_Slider/Templates
 * @version 1.0.0
 */

if ( $title == "on" ) : ?>
    <h3 class="gs_logo_title"><?php the_title(); ?></h3>
<?php endif; ?>