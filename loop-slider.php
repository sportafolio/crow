 <div class="fullwindow sliderimages-fullwindow">
   <div class="fullwindow-internal sliderimages"> 
    <?php if ( is_active_sidebar('home-hero-widget') ) : ?>
	<?php dynamic_sidebar('home-hero-widget'); ?>
            <?php else : ?>
    <?php
	$theme_settings = get_option('fivehundred_theme_settings');
	$stellar_header_text = get_option('stellar_header_text');
	$imageurl = get_bloginfo('stylesheet_directory') .'/images/demo-image.jpg';
	
	if (empty($theme_settings['stellar_slider_value'])) { ?>
        <div class="stellar_placeholder_image">
            <div class="stellar_demo_image" style="background-image: url(<?php echo ((isset($imageurl)) ? $imageurl : ''); ?>);" ></div>
            <?php if(!empty($stellar_header_text)) { ?>
            <div class="stellar_header_text"><h1><?php echo (!empty($stellar_header_text) ? $stellar_header_text : ''); ?></h1></div>
            </div> <!-- placeholder image close for if text is available -->
            <?php } else { ?>
            <div class="stellar_placeholder">
                <h1><?php bloginfo('name'); ?></h1>
                <h3 class="site-description"><?php bloginfo('description'); ?></h3>
            </div>
        </div> <!-- placeholder image -->
        <?php } ?>
       <?php 
			$theme_settings['stellar_slider_value'] = null;
		}
	 ?>
	<?php 
		if (empty($theme_settings['stellar_slider']) || $theme_settings['stellar_slider'] == "static_image")  {
			$static_image = wp_get_attachment_image_src($theme_settings['stellar_slider_value'], 'full');
	?>	
		<?php if(!empty($static_image)) { 
		?>
	 	<div class="slider-image-wrapper">
			<div class="slider-static-image" style="background-image: url(<?php echo ((isset($static_image[0])) ? $static_image[0] : ''); ?>);"></div>
            <?php 
				if(!empty($stellar_header_text)) {
			 ?>
              	<div class="stellar_header_text"><h1><?php echo (!empty($stellar_header_text) ? $stellar_header_text : ''); ?></h1></div>
             <?php } else { 
			 ?>
             <div class="stellar_placeholder">
                <h1><?php bloginfo('name'); ?></h1>
                <h3 class="site-description"><?php bloginfo('description'); ?></h3>
             </div>
             <?php } 
			 ?>
        </div> <!-- slider image wrppaer -->
        <? }
		?>
	<?php } else  { 
	?>	<?php if(!empty($theme_settings['stellar_slider_value'])) { 
		?>
    	<div class="stellar_slider">
			<?php echo (!empty($theme_settings['stellar_slider_value']) ? do_shortcode($theme_settings['stellar_slider_value']) : ''); ?>
        </div> <!-- shortcode  -->
        <?php } 
		?>
	<?php } ?>
 <?php endif; ?>
 </div> <!-- slider image -->
</div> <!-- slider fullwindow -->
