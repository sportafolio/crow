<?php
/*
Template Name: Home Page
*/
?>

<?php
global $post;
$id = $post->ID;
if ($id > 0) {
  $content = the_project_content($id);
  $project_id = get_post_meta($id, 'ign_project_id', true);
  $settings = get_option('fivehundred_theme_settings');
  if (!empty($settings)) {
    $display_count = $settings['home_projects'];
  }
}
$num_projects = wp_count_posts('ignition_product');
  if (!empty($num_projects->publish)) {
    $num_projects_pub = $num_projects->publish;
    if (isset($display_count) && $display_count < $num_projects_pub) {
      $show_more = 1;
    }
    else {
      $show_more = 0;
    }
  }
?>

<?php get_header(); ?>
<div id="container">
	<div id="content">
    
<!-- slider section -->
		
             <?php get_template_part('loop','slider'); ?>
    	
<!-- client logo section -->
         <div class="clear"></div>
                 <?php get_template_part('loop','seen'); ?>
        <div class="clear"></div>
<!-- project grid section -->
        <div id="project-grid" class="home-grid">
		<div class="grid-content">
            <?php 
            if (is_front_page()) {
                get_template_part('loop', 'project');
            }
            else {
                $paged = (get_query_var('paged') ? get_query_var('paged') : 1);
                $query = new WP_Query(array('paged' => 'paged', 'posts_per_page' =>1, 'paged' => $paged));
    
                // Start the loop
                if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                    get_template_part('entry');
                    endwhile;
                    endif; 
                wp_reset_postdata();
                ?>
            <?php } ?>
         <ul>
          <?php echo ($show_more ? '<li class="ign-more-projects front-page"><a href="'.get_post_type_archive_link("ignition_product").'">'. __('All', 'fivehundred').' <span>'.__('Projects', 'fivehundred').'</span></a></li>' : ''); ?>
      </ul>
</div>
    </div>
     
           
    <div class="clear"></div>
    
   <!-- featured theme info -->
          <?php get_template_part('loop','featured'); ?>
   <div class="clear"></div>
   
   <!-- Big CTA -->
          <?php get_template_part('template','cta'); ?>
   <div class="clear"></div>   

   </div> <!-- content wrapper -->
  </div> <!-- container wrapper-->
<!-- container end -->
<div class="clear"></div>

<?php get_footer(); ?>