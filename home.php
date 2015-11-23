<?php
/*
Template Name: Blog Page
*/
?>
<?php get_header(); ?>
<div id="container" class="blog">
	<h2 class="blog-title"><?php echo _e('Blog','fivehundred'); ?></h2>
	<div id="content">
		<?php get_template_part( 'loop', 'blog' ); ?>
		<?php get_template_part( 'nav', 'below' ); ?>
	</div>
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>