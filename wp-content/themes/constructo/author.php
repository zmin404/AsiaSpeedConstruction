<?php get_header(); ?>
	<?php if ( have_posts() ) : the_post(); ?>
		<section class="blog-section"><div class="container">
			<?php 
				rewind_posts();
				global $counter_blog;
				$counter_blog = 1;
				while ( have_posts() ) : the_post();
					global $counter_blog;
					get_template_part( 'content', get_post_format() );
					$counter_blog++;
				endwhile;
			?>
		</div></section>
	<?php endif; ?>
<?php get_footer();
