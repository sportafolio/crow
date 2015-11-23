<?php
global $post;
$id = $post->ID;
$content = the_project_content($id);
$project_id = get_post_meta($id, 'ign_project_id', true);
if (function_exists('is_id_pro') && is_id_pro() ) {
	$profile = ide_creator_info($post->ID);
}
idcf_get_project();
?>
<?php 
get_header(); 
?>
	<div id="site-description" class="project-single">
		<?php echo idcf_get_project_title(); ?>
        <?php echo idcf_get_short_description(); ?>
        <span class="product-author-details">
          <i class="fa fa-user"></i>
          <span>
			  <?php  if (function_exists('is_id_pro') && is_id_pro() ) { 
                      echo $profile['name'];  
                  }
                  else {
                      the_author();
                  }
              ?>
          </span>
              <?php
                    $terms = wp_get_post_terms( $post->ID, 'project_category');
                    if(!empty($terms)) {
                        ?>
                        <i class="fa fa-folder-open"></i>
                        <span class="project-tag-single">
                        <?php
                        $site_url = home_url();
                        $cat_name = "";
                        foreach($terms as $term){
                            if($term->count > 0){
                                $cat_name .= "<a href='".esc_url( $site_url )."/project-category/".$term->slug."'>".$term->name."</a>";
                                break;
                            }
                        }
                        if($term->count > 0){ echo $cat_name; }
                    }
              ?>
           </span>
          <i class="fa fa-clock-o"></i> <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?>
        </span> 
	</div>
	<article id="content" class="ignition_project">
		<?php get_template_part( 'project', 'hDeck' ); ?>
     </article>
      <div id="ign-project-content" class="ign-project-content">	
      
	<div class="entry-content content_tab_container">
		<?php get_template_part('nav', 'above-project'); ?>
		<div class="ign-content-long content_tab description_tab active">
            <h3 class="product-dashed-heading"><?php echo _e('Project Description', 'fivehundred'); ?></h3>
			<?php echo apply_filters('the_content', $content->long_description); ?>
		</div>
		<div id="updateslink" class="content_tab updates_tab">
			<?php echo apply_filters('fivehundred_updates', do_shortcode( '[project_updates product="'.$project_id.'"]')); ?>
		</div>
					
		<div id="faqlink" class="content_tab faq_tab">
			<?php echo apply_filters('fivehundred_faq', do_shortcode( '[project_faq product="'.$project_id.'"]')); ?>
		</div>
		<div class="content_tab comments_tab">
			<?php comments_template('/comments.php', true); ?>
		</div>
		<?php do_action('fh_below_project', $project_id, $id); ?>
	</div>
	<?php get_template_part( 'project', 'sidebar' ); ?>
	<div class="clear"></div>
</div>
