<?php get_header(); ?>
<?php get_template_part('template-parts/breadcrumbs'); ?>
<section class="post_blog_bg primary-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			
        	<div class="col-md-8">
        	<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
				 <article class="blog_post">
					<h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h4>
						
						<div class="blog_category">
							<ul> 
								<li> <?php the_category(', ');?></li>
							</ul>
						</div>	
						
						<div class="blog_text">
							<ul>
								<li> | </li>
								<li> Post By : <?php the_author_posts_link(); ?></li>
								<li> | </li>
								<li>  On : <?php the_time('j F Y');?> </li>
							</ul>
						</div>
						
						<div class="blog_post_img">
							<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
						</div>
						
						 <?php the_excerpt(); ?>
					
						<a href="<?php the_permalink(); ?>"> <?php esc_html_e('Continue reading', 'wptuts')?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
						
					
				</article>
				<!-- do stuff ... -->
				<?php endwhile; ?>
			<?php endif; ?>
				<?php wptuts_pagination(); ?>	
			</div>	
			
			<!--sidebar here-->
			<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>