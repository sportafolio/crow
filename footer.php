</div>
</div>

<footer>
<?php if ( is_active_sidebar('footer-widget-area') ) : ?>
<div id="footer-container">
<div class="fullwindow">
    <div id="footerlist" class="fullwindow-internal footercontent">
        <div class="constrained">
            <div class="ign-content-fullalt">
                <ul class="footer_widgets">
					<?php dynamic_sidebar('footer-widget-area'); ?>
                </ul>    
            </div>
        </div>
<?php endif; ?>
    <!-- footer widgets -->
    <div class="clear"></div>
        <div class="fullwindow-internal bottom-footer">
            <div class="constrained">
                <div id="copyright">
                
                </div>
                <div class="centercircle">
                	<div class="toparrow">
                    	<span class="go-text"><?php _e('GO TO', 'fivehundred'); ?></span>
                    	<a href="#wrapper" class="totop"><i class="fa fa-chevron-circle-up"></i></a>
                    	<span class="go-text"> <?php _e('THE TOP', 'fivehundred'); ?></span>
                    </div>
                </div>
                <div class="footerright">
                    <nav id="menu-footer">
						<?php
							if ( has_nav_menu( 'footer-menu' ) ) {
							// Using wp_nav_menu() to display menu
							wp_nav_menu( array( 
							'menu' => 'footer-menu', // Select the menu to show by Name
							'container' => false, // Remove the navigation container div
							'theme_location' => 'footer-menu' 
							)
							);
							}
                        ?>
                    </nav>
                     <?php get_template_part('template','social-share'); ?>
                     <!-- social share -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>