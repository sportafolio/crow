<?php get_header(); ?>
<div id="container">
	<div id="site-description">
		<h1><?php _e('Oops, This is awkward','fivehundred'); ?></h1>
	</div>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="content">
			<?php //get_template_part( 'nav', 'above' ); ?>
			<div id="404-grid">
				<div id="post-0" class="post error404 not-found">
					<h1 class="entry-title"><?php _e('Not Found','fivehundred'); ?></h1>
					<div class="entry-content">
						<p><?php _e('Nothing found for the requested page. Try a search instead?','fivehundred'); ?></p>
						<?php get_search_form(); ?>
					</div>
				</div>
				<?php get_template_part( 'nav', 'below' ); ?>
				<div style="clear: both;"></div>
			</div>
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>