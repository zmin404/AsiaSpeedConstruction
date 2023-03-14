<?php 
$google = get_option('anps_social_info');

if ( isset($google['google_analytics']) && $google['google_analytics']!= "" ): ?>

		<script type="text/javascript">
		
			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', '<?php echo esc_js($google['google_analytics']); ?>']);
			  _gaq.push(['_trackPageview']);
			
			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
		
		</script>

<?php endif; ?>