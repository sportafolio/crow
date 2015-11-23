<?php
$settings = get_option('fivehundred_theme_settings');
if (!empty($settings['logo'])) {
	$logo = $settings['logo'];
}
$stellar_inner_logo = get_option('stellar_inner_logo');
?>

<div id="branding">
	<div id="site-title">
		<a href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home">
        <?php if(is_front_page()) 
				echo (!empty($logo) ? '<img id="logo" src="'.$logo.'"/>' : bloginfo( 'name' ));
      	 	else 
			if(!empty($stellar_inner_logo))
			{ 
			 	echo (!empty($stellar_inner_logo) ? '<img id="logo" src="'.$stellar_inner_logo.'"/>' : bloginfo( 'name' )); 
			 }
			 else {
			 	echo (!empty($logo) ? '<img id="logo" src="'.$logo.'"/>' : bloginfo( 'name' ));
			 }
		?>
		</a>
	</div>
</div>