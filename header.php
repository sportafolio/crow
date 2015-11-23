<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_template_part('head'); ?>

<body <?php body_class(); ?> id="fivehundred">
	
	<div id="wrapper" class="hfeed">
		<header id="header" class="<?php echo apply_filters('fh_header_class', ''); ?>">
			<?php get_template_part('headerwrapper', 'above'); ?>
			<div class="headerwrapper">
				<a href="#" class="menu-toggle"><i class="fa fa-bars"></i></a>
				<?php //get_template_part('nav', 'above-mobile'); ?>
				<?php get_template_part('branding'); ?>
				<?php get_template_part('nav', 'above'); ?>
			</div>
			<?php get_template_part('headerwrapper', 'below'); ?>
		</header>
	<?php if (isset($post) && $post->post_type == 'post' && is_home()) { ?>
		<div id="containerwrapper" class="<?php echo (isset($post) ? $post->post_type : ''); ?> containerwrapper-home">
	<?php } else { ?>
	<div id="containerwrapper" class="<?php echo (isset($post) ? $post->post_type : ''); ?> containerwrapper">
	<?php } ?>