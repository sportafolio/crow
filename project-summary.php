<?php
global $post;
$id = $post->ID;
$summary = the_project_summary($id);
//$video = the_project_video($id);

$author = get_user_by( 'id', $post->post_author );
if (function_exists('is_id_pro') && is_id_pro() ) {
	$profile = ide_creator_info($post->ID);
}
$permalink_structure = get_option('permalink_structure');
$prefix = (empty($permalink_structure) ? '&' : '?');
do_action('fh_project_summary_before');

$project_id = get_post_meta($id, 'ign_project_id', true);
if (class_exists('Deck')) {
	$deck = new Deck($project_id);
	$the_deck = $deck->the_deck();
	$levels = $the_deck->level_data;
	//$levels = the_levels($id);
	$type = get_post_meta($id, 'ign_project_type', true);
	$end_type = get_post_meta($id, 'ign_end_type', true);
	$project = new ID_Project($project_id);
	$days_left = $project->days_left();
}
 idcf_get_project();

?>
<div class="ign-project-summary <?php echo (!empty($summary->successful) ? 'successful' : 'unsuccessful'); ?> <?php echo 'post-'.$id; ?>">
	<?php if ( $summary->successful) : ?>
        <div class="campaign-ribbon success">
            <a href="<?php the_permalink(); ?>"><?php _e( 'Successful', 'fivehundred' ); ?></a>
        </div>
	<?php elseif (!$summary->successful && $days_left <= '0') : ?>
        <div class="campaign-ribbon unsuccess">
            <a href="<?php the_permalink(); ?>"><?php _e( 'Unsuccessful', 'fivehundred' ); ?></a>
        </div>
	<?php endif; ?>
	<a href="<?php echo the_permalink(); ?>">
      <div class="ign-summary-container">
      		<div class="ign-summary-item">
                <div class="ign-summary-image" style="background-image: url(<?php idcf_the_project_image_url(); ?>)">	
                        <div class="ign-summary-learnmore"><span class="search"><i class="fa fa-search"></i></span></div> 
                </div>
             </div>
            <div class="title"><?php echo idcf_get_project_title(); ?>
            	 <div class="project-tag">
				  <?php
                      $terms = wp_get_post_terms( $post->ID, 'project_category');
					  if(!empty($terms)) {
                      $site_url = home_url();
                      $cat_name = "";
                       foreach($terms as $term){
                          if($term->count > 0){
                              $cat_name .= $term->name;
                              break;
                          }
                       }
                      if($term->count > 0){ echo $cat_name; }
					  }
                   ?>
                  </div>
            </div>
            <h3 class="ign-summary-author">
            	<span><?php _e('by', 'fivehundred'); ?> 
						<?php  if (function_exists('is_id_pro') && is_id_pro() ) { 
								echo $profile['name'];  
							}
							else {
								the_author();
							}
						?>
               </span>
            </h3>
            <span class="ign-summary-desc"><?php echo idcf_get_short_description(); ?></span>
             <?php if ( !empty($profile['location']) ) : ?>
				<span class="ign-summary-loc contact-location"><i class="icon-link"></i> <?php echo make_clickable( $profile['location'] ); ?></span>
			<?php endif; ?>
            <div class="clear"></div>
            <div class="ign-progress-wrapper">
              <div class="ign-progress-bar" style="width: <?php idcf_the_funded_percent(); echo '%'; ?>"></div>
              <div class="ign-progress-percentage"><?php idcf_the_funded_percent($round_figure = true); echo '%'; ?> <span> <?php _e('Funded', 'fivehundred'); ?></span></div>
  				<?php idcf_the_raised_fund(); ?>
           </div>
           <div class="ign-summary-days">
               <?php idcf_the_days_left($only_days = true); ?><span><?php _e('Days left', 'fivehundred'); ?></span>
          </div>
      </div>
   </a>
</div>