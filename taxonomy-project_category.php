<?php global $post; ?>
<?php get_header(); ?>
<div id="container">
	<div id="site-description">
		<h1><?php single_cat_title(); ?></h1>
	</div>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="content">
			<div id="taxonomy-grid">
				<?php 
					// Start the loop
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						apply_filters('the_content', get_template_part('project'));
						endwhile;
						endif; 
					wp_reset_postdata();
				?>
				<?php get_template_part( 'nav', 'below' ); ?>
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
    <?php get_sidebar(); ?>
<div class="clear"></div>
</div>
<?php get_footer(); ?>