<?php get_header(); ?>
<?php get_template_part('template-parts/breadcrumbs'); ?>

<section class="post_blog_bg primary-bg">
	<div class="container">
		<div class="row">
        	<div class="col-md-8">
        	<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); 

				get_template_part('template-parts/content', 'search');

			endwhile; ?>
			<?php else: ?>
				<?php get_template_part('template-parts/content', 'none'); ?>
			<?php endif; ?>
				<?php wptuts_pagination(); ?>	
			</div>	
			
			<!--sidebar here-->
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>