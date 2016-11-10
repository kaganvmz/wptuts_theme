<?php get_header(); ?>
<?php get_template_part('template-parts/breadcrumbs'); ?>

<section class="post_blog_bg primary-bg">
	<div class="container">
		<div class="row">
        	<div class="col-md-8">
        	<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); 

				get_template_part('template-parts/content', 'page');

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile; ?>
			<?php endif; ?>
				<?php wptuts_pagination(); ?>	
			</div>	
			
			<!--sidebar here-->
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>