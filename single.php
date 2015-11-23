<?php get_header(); ?>
<div id="container">
	<h2 class="blog-title"><?php echo _e('Blog Post','fivehundred'); ?></h2>
	<article id="content" class="blog">
		<?php get_template_part( 'nav', 'above-single' ); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'entry','content' ); ?>
		<?php comments_template('/comments.php', true); ?>
		<?php endwhile; endif; ?>
		<?php get_template_part('nav','below-single'); ?>
	</article>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>