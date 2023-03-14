<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$links = array(
	'documentation_url' => 'https://docs.stylemixthemes.com/cost-calculator-builder/',
	'video_url'         => '',
	'support_url'       => 'https://support.stylemixthemes.com/tickets/new/support?item_id=29',
);
?>

<div class="wrap">
	<div id="welcome-panel" class="welcome-panel">
		<div class="welcome-panel-content">
			<div class="welcome-panel-header">
				<h2>Welcome to Support page!</h2>
				<p class="about-description">We’ve assembled some links to get you started.</p>
			</div>
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column">
					<div></div>
					<div class="welcome-panel-column-content">
						<h3>Getting Started</h3>
						<p>This user guide explains the basic design and the common operations that you can follow while using it.</p>
						<a class="button button-primary button-hero" href="<?php echo esc_url( $links['documentation_url'] ); ?>" target="_blank">Documentation</a>
					</div>
				</div>
				<?php if ( ! empty( $links['video_url'] ) ) : ?>
					<div class="welcome-panel-column">
						<div></div>
						<div class="welcome-panel-column-content">
							<h3>Watch Now</h3>
							<p>The Video Tutorials are aimed at helping you get handy tips and set up your site as quickly as possible.</p>
							<a class="button button-primary button-hero" href="<?php echo esc_url( $links['video_url'] ); ?>" target="_blank">Go to Tutorials</a>
						</div>
					</div>
				<?php endif; ?>
				<div class="welcome-panel-column">
					<div></div>
					<div class="welcome-panel-column-content">
						<h3>Support</h3>
						<p>We're experiencing a much larger number of tickets.<br> So the waiting time is longer than expected.</p>
						<a class="button button-primary button-hero" href="<?php echo esc_url( $links['support_url'] ); ?>" target="_blank">Create a Ticket</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
