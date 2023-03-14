<?php if ( ! isset($_COOKIE['responsive_on_demand']) || $_COOKIE['responsive_on_demand'] == 'off' ):  ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<style>
		body, html {
			overflow-x: hidden;
		}
	</style>
<?php endif; ?>