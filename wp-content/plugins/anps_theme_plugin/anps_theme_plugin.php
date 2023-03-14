<?php
/*
Plugin Name: Anps Theme plugin
Plugin URI: https://anpsthemes.com
Description: Anps theme plugin
Author: AnpsThemes
Version: 1.1.0
Author URI: https://anpsthemes.com
*/

if(!defined('WPINC')) {
    die;
}


/*updates*/
require 'plugin-updates/plugin-update-checker.php';
$AnpsUpdateChecker = PucFactory::buildUpdateChecker(
    'https://astudio.si/preview/plugins/constructo/update.json',
    __FILE__
);

/* Portfolio */
include_once 'portfolio.php';
add_action('init', 'anps_portfolio');
function anps_portfolio() {
    new Portfolio();
}
/* Team */
include_once 'team.php';
add_action('init', 'anps_team');
function anps_team() {
    new Team();
}
