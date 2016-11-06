<footer class="third-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="footer_top">
					<h4> <?php echo get_theme_mod('header_social'); ?> </h4>
					
					<ul>
						<?php if(get_theme_mod('facebook_social') != ''):?>
						<li> <a href="<?php echo get_theme_mod('facebook_social'); ?>"> <i class="fa fa-facebook" aria-hidden="true"></i> </a> </li>
						<?php endif; ?>
						<?php if(get_theme_mod('twitter_social') != ''):?>
						<li> <a href="<?php echo get_theme_mod('twitter_social'); ?>"> <i class="fa fa-twitter" aria-hidden="true"></i> </a> </li>
						<?php endif; ?>
						<?php if(get_theme_mod('linkedin_social') != ''):?>
						<li> <a href="<?php echo get_theme_mod('linkedin_social'); ?>"> <i class="fa fa-linkedin" aria-hidden="true"></i> </a> </li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer_bottom fourth-bg"><?php echo get_theme_mod('footer_copy'); ?></div>	
</footer>


</body>
<?php wp_footer(); ?>
  </html>