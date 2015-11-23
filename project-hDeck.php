<?php
global $post;
$id = $post->ID;
//$hDeck = the_project_hDeck($id);
$project_id = get_post_meta($id, 'ign_project_id', true);
if (class_exists('Deck')) {
	$hdeck = new Deck($project_id);
	if (method_exists($hdeck, 'hDeck')) {
		$hDeck = $hdeck->hDeck();
	}
	else {
		$hDeck = the_project_hDeck($id);
	}
	$permalinks = get_option('permalink_structure');
	$summary = the_project_summary($id);
//	$video = the_project_video($id);
	do_action('fh_hDeck_before');
}
idcf_get_project();

?>

<?php if (isset($hDeck)) { ?>
<div id="ign-hDeck-wrapper">
	<div id="ign-hdeck-wrapperbg">
		<div id="ign-hDeck-header">
                  <div id="ign-hDeck-left">
                  		<div class="feature-image-wrapper">
                        	<div class="video feature-image <?php 
							$video = idcf_get_project_video();
							 echo (!empty($video) ? 'hasvideo' : ''); ?>" style="background-image: url(<?php idcf_the_project_image_url(); ?>)">
							 <?php echo $video; ?> </div>

                      </div>
                    </div>
                  <div id="ign-hDeck-right">
                      <div class="internal">
                          	<div class="ign-product-goal" style="clear: both;">
							 	 <strong><?php idcf_the_raised_fund($featured = true, $no_markup = true); ?></strong>
							</div> 
                            <div class="ign-pledged">
								<?php _e('pledged of', 'fivehundred'); ?>
								<?php echo idcf_get_the_goal($featured = false, $no_markup = true); ?>
								<?php _e('goal', 'fivehundred'); ?>
                          </div>
                           <div class="ign-product-supporters">
                              <strong><?php echo idcf_get_total_pledgers($featured = false, $no_markup = true); ?></strong>
                          </div>
                          <div class="ign-supporters"><?php _e('backers', 'fivehundred'); ?></div>
                          <div class="ign-days-left">
                              <strong><?php idcf_the_days_left($only_days = true); ?></strong>
                          </div>
                          <div><?php _e('Days Left', 'fivehundred'); ?></div>

                          <div id="hDeck-right-bottom">
                            <div class="ign-supportnow" data-projectid="<?php echo $project_id; ?>">
                            
                                <?php if ($hDeck->end_type == 'closed' && $hDeck->days_left <= 0) {?>
                                
                                <a class="expired"><?php _e('Project Closed', 'fivehundred'); ?>
                                 <span class="expire-tooltip"><?php _e('You no longer can pledge on the project', 'fivehundred'); ?></span>
                                 </a>
                               
                                
                                <?php }
								else { ?>
                                <?php if (function_exists('is_id_licensed') && is_id_licensed()) { ?>
                                
                                    <?php if (empty($permalinks) || $permalinks == '') { ?>
                                        <a href="<?php the_permalink(); ?>&purchaseform=500&amp;prodid=<?php echo (isset($project_id) ? $project_id : ''); ?>"><?php _e('Support Now', 'fivehundred'); ?></a>
                                        <div class="ign-project-end">
											<?php _e('Project Ends on', 'fivehundred'); ?> <?php echo idcf_get_project_end_date($no_markup = true); ?>
                            			</div>
                                    <?php }
									
                                    else { ?>
                                    
                                        <a href="<?php the_permalink(); ?>?purchaseform=500&amp;prodid=<?php echo (isset($project_id) ? $project_id : ''); ?>"><?php _e('Support Now', 'fivehundred'); ?></a>
                                        <div class="ign-project-end">
								<?php _e('Project Ends on', 'fivehundred'); ?> <?php echo idcf_get_project_end_date($no_markup = true); ?>
                            </div>
                                    <?php } ?>
                                    
                                <?php } ?>
                            <?php }?>
                            </div>
                            
                        </div>
                        <div id="ign-share-button">
                        	<a href="#"><?php _e('Share project', 'fivehundred'); ?></a>
                        </div>
                        
                            <div id="ign-hDeck-social">
                            	<?php do_action('idf_general_social_buttons', $post->ID, ''); ?>
                           </div>
                        </div> <!-- internal -->
                  </div> <!-- hdeck-right -->
        </div>
	</div>
</div>

<?php } 
else { ?>
<div id="ign-hDeck-wrapper">
	<div id="ign-hdeck-wrapperbg">
		<div id="ign-hDeck-header">
			<div id="ign-hDeck-left">
			</div>
			<div id="ign-hDeck-right">
				<div class="internal">
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php } ?>