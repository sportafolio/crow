<?php global $post;
$author = get_user_by( 'id', $post->post_author );
?>
<?php get_header(); ?>
<div id="container">
	<div id="site-description">
        <h1 class="entry-title">
   			 <?php $post = $posts[0];
				if (is_home()):
					echo get_the_title( get_option('page_for_posts', true) );
				elseif (is_search()):
					_e( 'Search Results for: %s','fivehundred'); ?>: &ldquo;<?php echo get_search_query(); ?>&rdquo;
					<?php
				elseif (is_category()):
					_e('Cateogry','fivehundred'); ?>: &ldquo;<?php single_cat_title(); ?>&rdquo;
					<?php
				elseif(is_tag()) :
					_e('Tagged','fivehundred'); ?>: &ldquo;<?php single_tag_title(); ?>&rdquo;
					<?php
				elseif (is_day()) :
					_e('Archive for','fivehundred'); echo ' '; the_time('F jS, Y');
				elseif (is_month()) :
					_e('Archive for','fivehundred'); echo ' '; the_time('F, Y');
				elseif (is_year()) :
					_e('Archive for','fivehundred'); echo ' '; the_time('Y');
				elseif (is_author()) :
					_e('Post By','fivehundred'); ?>: &ldquo;<?php echo $author->display_name; ?>&rdquo;
                    <?php
				else :
					_e('Archives','fivehundred');
				endif; ?>
    	</h1>
	</div>
	
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div id="content">
			<div id="archive-grid">
				<?php 
					// Start the loop
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part('entry');
						endwhile;
						endif; 
				?>
			</div>
			<div style="clear: both;"></div>
            <?php get_template_part( 'nav', 'below' ); ?>
		</div>
	</div>
    <?php get_sidebar(); ?>
<div class="clear"></div>
</div>
<?php get_footer(); ?>