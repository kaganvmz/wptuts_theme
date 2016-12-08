 <article id="post-<?php the_ID(); ?>" <?php post_class('blog_post'); ?> >
	
	<h4> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </h4>
		
	<div class="blog_post_img">
		<a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail(); ?> </a>
	</div>
					
</article>