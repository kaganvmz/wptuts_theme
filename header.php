<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<header class="navbar-fixed-top">
	<div class="container">
    	<div class="row">
        	<div class="header_top">
        		<div class="col-md-2">
            		<div class="logo_img">
						<?php the_custom_logo(); ?>
					</div>
				</div>
					
				<div class="col-md-10">
					<div class="menu_bar">	
						<nav role="navigation" class="navbar navbar-default">
							<div class="navbar-header">
                                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                    <span class="sr-only"><?php esc_html_e('Toggle navigation', 'wptuts'); ?></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                  </button>
							   </div>
							   
							  	<div class="collapse navbar-collapse" id="navbar">
							  		<?php 
							  			wp_nav_menu(array(
							  				'theme_location' => 'primary',
							  				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							  				'menu_class' => 'nav navbar-nav',
							  				'menu_id' => '',
							  				'depth' => 1
							  			));
							  		?>    
                          		</div>
						</nav>
					</div>
    	        </div>
			  
			  </div>
			</div>
		</div>
</header>
