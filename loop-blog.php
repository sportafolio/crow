<?php
$posts_per_page = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if (empty($posts_per_page)) {
	$posts_per_page = 10;
}
$args = array('post_type' => 'post', 'posts_per_page' => $posts_per_page, 'paged' => $paged);
$wp_query = new WP_Query($args);
// Start the loop
		if ( $wp_query->have_posts() ){
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				get_template_part('entry');
			}
		}
		wp_reset_postdata();
?>
