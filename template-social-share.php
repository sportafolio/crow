<?php 
	global $post;
	$settings = get_option('fivehundred_theme_settings');
	$idsocial_settings = maybe_unserialize(get_option('idsocial_settings'));
	$twitter = 0;
	$fb = 0;
	$google = 0;
	$li = 0;
	$via = '';
	$fbname = '';
	$gname = '';
	$liname = '';
	if (isset($idsocial_settings)) {
		if (!empty($idsocial_settings['theme_500'])) {
			$social_settings = $idsocial_settings['theme_500'];
			if (!empty($social_settings)) {
				$twitter = (isset($social_settings['twitter']) ? $social_settings['twitter'] : 0);
				$fb = (isset($social_settings['fb']) ? $social_settings['fb'] : 0);
				$google = (isset($social_settings['google']) ? $social_settings['google'] : 0);
				$li = (isset($social_settings['li']) ? $social_settings['li'] : 0);
				$via = (isset($social_settings['twitter']) ? $social_settings['twitter_via'] : '');
				$fbname = (isset($social_settings['fb']) ? $social_settings['fb_via'] : '');
				$gname = (isset($social_settings['google']) ? $social_settings['g_via'] : '');
				$liname = (isset($social_settings['li']) ? $social_settings['li_via'] : '');
			}
		}
	}
?>
<div  id="home-sharing">
      <ul>
          <?php echo ($twitter ? '<li class="twitter-btn"><a href="http://twitter.com/'.$via.'" target="_blank" ><span>'.__('Follow', 'fivehundred').'</span></a></li>' : ''); ?>
          <?php echo ($fb  ? '<li class="facebook-btn"><a href="http://www.facebook.com/'.$fbname.'" target="_blank"><span>'.__('Like', 'fivehundred').'</span></a></li>' : ''); ?>
          <?php echo ($google ? '<li class="gplus-btn"><a href="https://plus.google.com/'.$gname.'" target="_blank"><span>'.__('+1', 'fivehundred').'</span></a></li>' : ''); ?>
          <?php echo ($li ? '<li class="linkedin-btn"><a href="http://linkedin.com/in/'.$liname.'" target="_blank"><span>'.__('Connect', 'fivehundred').'</span></a></li>' : ''); ?>
          <!-- prob want to get category here -->
      </ul>
</div>