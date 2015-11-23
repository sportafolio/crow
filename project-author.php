<?php
global $post, $campaign;
$author_id=$post->post_author;
$id = $post->ID;
$content = the_project_content($id);
$project_id = get_post_meta($id, 'ign_project_id', true);

$author = get_user_by( 'id', $post->post_author );
if (function_exists('is_id_pro') && is_id_pro() ) {
		$profile = ide_creator_info($post->ID);
}
$permalink_structure = get_option('permalink_structure');
$prefix = (empty($permalink_structure) ? '&' : '?');
?>

<h3 class="widget-title"><?php _e('About the author', 'fivehundred'); ?></h3>
<div class="author-bio">
	<div class="author-bio-info">
		<span class="author-name">
			<?php if (function_exists('is_id_pro') && is_id_pro() ) { 
					  echo $profile['name'];  
				  }
				  else {
					  the_author();
				  }
			 ?>
        </span>
        <?php if ( !empty($profile['location']) ) : ?>
            <span class="contact-location"><i class="icon-location"></i> <?php echo make_clickable( $profile['location'] ); ?></span>
        <?php endif; ?>
        <?php if ( !empty($profile['facebook']) ) : ?>
            <span class="contact-facebook"><?php echo '<a href="'.$profile['facebook'].'" target="_blank"><i class="icon-facebook"> </i></a>'; ?></span>
        <?php endif; ?>
        <?php if ( !empty($profile['twitter']) ) : ?>
            <span class="contact-twitter"><?php echo '<a href="'.$profile['twitter'].'" target="_blank"><i class="icon-twitter"> </i></a>'; ?></span>
        <?php endif; ?>
        <div class="clear"></div>
        <span class="author-count">
        	<?php
				$args = array(
					'author' => $post->post_author,
					'post_type' => 'ignition_product',
					'status' => 'publish',
					'posts_per_page' => -1
				);
				$posts = get_posts($args);
				$count = count($posts);
			?>
			<?php printf( _nx( 'Created<b> %1$d </b>Project', 'Created<b> %1$d </b>Projects', $count, '1: Number of Projects Single 2: Number of Projects Plural', 'fivehundred' ), $count ); 
			?> 
            </span>
             <?php if ( !empty($profile['url']) ) : ?>
		<span class="contact-link"><i class="icon-link"></i> 
			<?php 
				$string = '<a href="'.$profile['url'].'" target="_blank">'.$profile['url'].'</a>'; 
 				echo make_clickable( $string ); 
			?>
        </span>
		<?php endif; ?>
    </div>
    <div class="author-bio-profile">
     <?php if ( function_exists('is_id_pro') && is_id_pro() && !empty($profile['logo']) ) { ?>
	  <?php echo '<img class="avatar avatar-80 photo" width="64" height="64" src="'.$profile['logo'].'"/>'; ?>
      <?php } else { ?>
          <?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
      <?php } ?>
   </div>
</div>
<div class="clear"></div>