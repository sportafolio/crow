<nav id="menu-header" class="menu">
	<div class="search-wrapper">
        <div id="header-search" class="search-form">
            <?php get_search_form(); ?>
        </div>
        <a class="search">
            <i class="fa fa-search"></i>
        </a>
        <a class="search-close" id="search-close">
            <i class="fa fa-close"></i>
        </a>
    </div>
	<?php 
	// Using wp_nav_menu() to display menu
	wp_nav_menu( array( 
		'menu' => 'main-menu', // Select the menu to show by Name
		'class' => '',
		'container' => false, // Remove the navigation container div
		'theme_location' => 'main-menu',
		'walker' => new Stellar_Sub_Menu(),
		'fallback_cb' => 'stellar_default_menu'
		)
	);
	?>
</nav>