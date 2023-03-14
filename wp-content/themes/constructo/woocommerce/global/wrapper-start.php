<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$id = null;
$num_sidebars = 0;

if (is_shop()) {
	$id = get_option('woocommerce_shop_page_id');
	$num_sidebars = anps_num_sidebars($id);
}
?>

<section class="container">
	<div class="row">
		<?php if (is_shop()): ?>
			<?php anps_left_sidebar($id); ?>
		<?php endif; ?>

		<div class="col-md-<?php echo 12-$num_sidebars*3; ?>">
