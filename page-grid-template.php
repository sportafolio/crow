<?php
/*
Template Name: Project Grid (Page)
*/
?>
<?php 
	global $post;
	$settings = get_option('fivehundred_theme_settings');
	$social_settings = maybe_unserialize(get_option('idsocial_settings'));
  	$social_settings = $social_settings['theme_500'];
 	$display_count = $settings['home_projects'];
	$num_projects = wp_count_posts('ignition_product');
	$num_projects_pub = $num_projects->publish;
	if ($display_count < $num_projects_pub) {
		$show_more = 1;
	}
	else {
		$show_more = 0;
	}
	 $url = site_url('/');
  $tagline = get_bloginfo('description'); 
  if ($social_settings) {
    $twitter = (isset($social_settings['twitter']) ? $social_settings['twitter'] : '');
    $fb = (isset($social_settings['fb']) ? $social_settings['fb'] : '');
    $google = (isset($social_settings['google']) ? $social_settings['google'] : '');
    $li = (isset($social_settings['li']) ? $social_settings['li'] : '');
    $via = (isset($social_settings['twitter_via']) ? $social_settings['twitter_via'] : '');
    $fbname = (isset($social_settings['fb_via']) ? $social_settings['fb_via'] : '');
    $gname = (isset($social_settings['g_via']) ? $social_settings['g_via'] : '');
    $liname = (isset($social_settings['li_via']) ? $social_settings['li_via'] : '');
    $about_us = (isset($social_settings['about']) ? $social_settings['about'] : '');
  }
  else {
    $via = null;
    $fbname = null;
    $gname = null;
    $liname = null;
    $twitter = null;
    $fb = null;
    $google = null;
    $li = null;
    $about_us = null;
  }
?>
<?php get_header(); ?>
<div id="container">
	<div id="site-description">
		<h1><?php the_title(); ?></h1>
	</div>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="content" class="fullwidth">
			<div id="project-grid">
					<?php get_template_part('loop', 'project'); ?>				
			</div>
			<div style="clear: both;"></div>
			<div  id="home-sharing">
			<ul>
				<!-- prob want to get category here -->
				<?php echo ($show_more ? '<li class="ign-more-projects"><a href="'.get_post_type_archive_link("ignition_product").'">'. __('More', 'fivehundred').' <span>'.__('Projects', 'fivehundred').'</span></a></li>' : ''); ?>
			</ul>
			</div>
			<div id="about-us" class="entry-content">
				<div id="about"><?php echo $about_us; ?></div>
			</div>
			<div id="home-widget">
				<?php get_sidebar('home'); ?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>