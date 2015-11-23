<div class="entry-summary">
	<?php // Post Featured Image
	if ( has_post_thumbnail() ) {
			the_post_thumbnail('singlepost-thumb', array('class' => 'singlepost-thumb'));
		} 
	?>

	<?php get_template_part( 'entry', 'meta' ); ?>
	<h2 class="entry-title">
    	<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span> 
    </h2>
    <div class="clear"></div>
	<?php {
		if ($post->post_type == 'ignition_product') {
			echo apply_filters('the_content', get_post_meta($post->ID, 'ign_project_long_description', true));
		}
		else {
			the_excerpt();
		}
		if(is_search()) {
			wp_link_pages();
		}
	}
	?>
</div> 