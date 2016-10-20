<?php

function wptuts_setup() {

	load_theme_textdomain('wptuts');

	add_theme_support('title-tag');

	add_theme_support('custom-logo', array(
		'height' => 31, 
		'width' => 134, 
		'flex-height' => true
	));

	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(730,446);

	add_theme_support('html5', array(
		'search_form', 
		'comment-form', 
		'comment-list', 
		'gallery', 
		'caption'
	));

	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'gallery'
	));

	register_nav_menu('primary', 'Primary menu');
}

add_action('after_setup_theme', 'wptuts_setup');


function wptuts_scripts() {
	
	wp_enqueue_style( 'boostrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'style-css', get_stylesheet_uri() );
	
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script( 'css3-animate-it', get_template_directory_uri() . '/js/css3-animate-it.js');
	wp_enqueue_script( 'agency', get_template_directory_uri() . '/js/agency.js');
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.min.js');
}

add_action( 'wp_enqueue_scripts', 'wptuts_scripts' );

add_filter('excerpt_more', function($more) {
	return '';
});

function wptuts_the_breadcrumb(){
	global $post;
	if(!is_home()){ 
	   echo '<li><a href="'.site_url().'"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li> <li> / </li> ';
		if(is_single()){ // posts
		the_category(', ');
		echo " <li> / </li> ";
		echo '<li>';
			the_title();
		echo '</li>';
		}
		elseif (is_page()) { // pages
			if ($post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) echo $crumb . '<li> / </li> ';
			}
			echo the_title();
		}
		elseif (is_category()) { // category
			global $wp_query;
			$obj_cat = $wp_query->get_queried_object();
			$current_cat = $obj_cat->term_id;
			$current_cat = get_category($current_cat);
			$parent_cat = get_category($current_cat->parent);
			if ($current_cat->parent != 0) 
				echo(get_category_parents($parent_cat, TRUE, ' <li> / </li> '));
			single_cat_title();
		}
		elseif (is_search()) { // search pages
			echo 'Search results "' . get_search_query() . '"';
		}
		elseif (is_tag()) { // tags
			echo single_tag_title('', false);
		}
		elseif (is_day()) { // archive (days)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li> ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> <li> / </li> ';
			echo get_the_time('d');
		}
		elseif (is_month()) { // archive (months)
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> <li> / </li>';
			echo get_the_time('F');
		}
		elseif (is_year()) { // archive (years)
			echo get_the_time('Y');
		}
		elseif (is_author()) { // authors
			global $author;
			$userdata = get_userdata($author);
			echo '<li>Posted ' . $userdata->display_name . '</li>';
		} elseif (is_404()) { // if page not found
			echo '<li>Error 404</li>';
		}
	 
		if (get_query_var('paged')) // number of page
			echo ' (' . get_query_var('paged').'- page)';
	 
	} else { // home
	   $pageNum=(get_query_var('paged')) ? get_query_var('paged') : 1;
	   if($pageNum>1)
	      echo '<li><a href="'.site_url().'"><i class="fa fa-home" aria-hidden="true"></i>Home</a></li> <li> / </li> <li>'.$pageNum.'- page</li>'; //fix close <i> and add <li>-page</li>
	   else
	      echo '<li><i class="fa fa-home" aria-hidden="true"></i>Home</li>';
	}
}
/**
* Pagination
*/
function wptuts_pagination( $args = array() ) {
    
    $defaults = array(
        'range'           => 4,
        'custom_query'    => FALSE,
        'previous_string' => __( 'Previous', 'text-domain' ),
        'next_string'     => __( 'Next', 'text-domain' ),
        'before_output'   => '<div class="next_page"><ul class="page-numbers">',
        'after_output'    => '</ul></div>'
    );
    
    $args = wp_parse_args( 
        $args, 
        apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
    );
    
    $args['range'] = (int) $args['range'] - 1;
    if ( !$args['custom_query'] )
        $args['custom_query'] = @$GLOBALS['wp_query'];
    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval( get_query_var( 'paged' ) );
    $ceil  = ceil( $args['range'] / 2 );
    
    if ( $count <= 1 )
        return FALSE;
    
    if ( !$page )
        $page = 1;
    
    if ( $count > $args['range'] ) {
        if ( $page <= $args['range'] ) {
            $min = 1;
            $max = $args['range'] + 1;
        } elseif ( $page >= ($count - $ceil) ) {
            $min = $count - $args['range'];
            $max = $count;
        } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }
    
    $echo = '';
    $previous = intval($page) - 1;
    $previous = esc_attr( get_pagenum_link($previous) );
    
    if ( $previous && (1 != $page) )
        $echo .= '<li><a href="' . $previous . '" class="page-numbers" title="' . __( 'previous', 'text-domain') . '">' . $args['previous_string'] . '</a></li>';
    
    if ( !empty($min) && !empty($max) ) {
        for( $i = $min; $i <= $max; $i++ ) {
            if ($page == $i) {
                $echo .= '<li class="active"><span class="page-numbers current">' . str_pad( (int)$i, 1, '0', STR_PAD_LEFT ) . '</span></li>';
            } else {
                $echo .= sprintf( '<li><a href="%s" class="page-numbers">%2d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
            }
        }
    }
    
    $next = intval($page) + 1;
    $next = esc_attr( get_pagenum_link($next) );
    if ($next && ($count != $page) )
        $echo .= '<li><a href="' . $next . '" class="page-numbers" title="' . __( 'next', 'text-domain') . '">' . $args['next_string'] . '</a></li>';

    if ( isset($echo) )
        echo $args['before_output'] . $echo . $args['after_output'];
}

function wptuts_customize_register( $wp_customize ) {
   
   $wp_customize->add_setting( 'header_social' , array(
    'default'     => __('Share Your Favorite Mobile Apps With Your Friends', 'wptuts'),
    'transport'   => 'refresh',
	));
   $wp_customize->add_setting( 'facebook_social' , array(
    'default'     => __('Url facebook', 'wptuts'),
    'transport'   => 'refresh',
	));
    $wp_customize->add_setting( 'twitter_social' , array(
    'default'     => __('Url twitter', 'wptuts'),
    'transport'   => 'refresh',
	));
	$wp_customize->add_setting( 'linkedin_social' , array(
    'default'     => __('Url linkedin', 'wptuts'),
    'transport'   => 'refresh',
	));

	$wp_customize->add_setting( 'footer_copy' , array(
    'default'     => __('Copyright text', 'wptuts'),
    'transport'   => 'refresh',
	));

   	$wp_customize->add_section( 'social_section' , array(
    'title'      => __( 'Social settings', 'wptuts' ),
    'priority'   => 30,
	));

	$wp_customize->add_section( 'footer_setting' , array(
    'title'      => __( 'Footer settings', 'wptuts' ),
    'priority'   => 31,
	));

   $wp_customize->add_control(
	'header_social', 
	array(
		'label'    => __( 'Social header in footer', 'wptuts' ),
		'section'  => 'social_section',
		'settings' => 'header_social',
		'type'     => 'text',
	));

   $wp_customize->add_control(
	'facebook_social', 
	array(
		'label'    => __( 'Facebook profile url', 'wptuts' ),
		'section'  => 'social_section',
		'settings' => 'facebook_social',
		'type'     => 'text',
	));

   $wp_customize->add_control(
	'linkedin_social', 
	array(
		'label'    => __( 'Linkedin profile url', 'wptuts' ),
		'section'  => 'social_section',
		'settings' => 'linkedin_social',
		'type'     => 'text',
	));

   $wp_customize->add_control(
	'twitter_social', 
	array(
		'label'    => __( 'Twitter profile url', 'wptuts' ),
		'section'  => 'social_section',
		'settings' => 'twitter_social',
		'type'     => 'text',
	));

    $wp_customize->add_control(
	'footer_copy', 
	array(
		'label'    => __( 'Footer settings', 'wptuts' ),
		'section'  => 'footer_setting',
		'settings' => 'footer_copy',
		'type'     => 'textarea',
	));
}
add_action( 'customize_register', 'wptuts_customize_register' );