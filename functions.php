<?php
function stellar_init() {
	load_child_theme_textdomain('fivehundred', get_template_directory().'/languages/');
}

add_action('after_setup_theme', 'stellar_init');
add_action('after_setup_theme', 'stellar_setup');

require 'classes/class-content-cta-widget.php';
require 'classes/class-content-feature-widget.php';

function stellar_setup() {
	add_filter('fh_customization_style', 'stellar_color_styles');
}

add_action('wp_enqueue_scripts', 'stellar_styles_scripts');

function stellar_styles_scripts() {
	wp_register_style('stellar', get_stylesheet_uri());
	wp_register_style('open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700');
	wp_register_script('stellar', get_stylesheet_directory_uri().'/js/stellar.js');
	wp_enqueue_style('stellar');
	wp_enqueue_style('open-sans');
	wp_enqueue_script('jquery');
	wp_enqueue_script('stellar');
}

add_action('admin_enqueue_scripts', 'stellar_admin_scripts');

function stellar_admin_scripts() {
	wp_register_script('stellar-admin', get_stylesheet_directory_uri().'/js/stellar-admin.js');
	wp_enqueue_script('jquery');
	wp_enqueue_script('stellar-admin');
	wp_register_style('stellar-admin-css', get_stylesheet_directory_uri().'/css/admin.css');
	wp_enqueue_style('stellar-admin-css');
}

add_action('widgets_init', 'fivehundred_child_widgets_init');

function fivehundred_child_widgets_init() {
    register_widget('Stellar_Cta_Widget');
	register_widget('Stellar_Featured_Widget');
}

function stellar_register_sidebars() {
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => __('Home Hero Section Widget', 'fivehundred'),
			'id' => 'home-hero-widget',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => "</li>"
		));
	}
}

add_action( 'widgets_init', 'stellar_register_sidebars', 12 );


function stellar_theme_image_size() {
	add_image_size( 'fivehundred_featured', 800, 450, true); // For 500 Featured Project
}
add_action( 'after_setup_theme', 'stellar_theme_image_size', 11 );

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'singlepost-thumb', 790, 9999 ); // For Single Posts (cropped)
}

// pagination 
function stellar_pagination() {
	global $wp_query;

	$big = 999999999; // need an unlikely integer

	$links = paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'prev_text' => '<i class="fa fa-right"></i>',
		'next_text' => '<i class="fa fa-left"></i>'
	) );
?>
	<div class="pagination">
		<?php echo $links; ?>
	</div>
<?php
}
add_action( 'stellar_loop_after', 'stellar_pagination' );


// Menu Fallback
function stellar_default_menu() {
   $output = '<ul>';                  
   $output .= '<li><a href="'.admin_url('nav-menus.php').'">'.__('Set Your default menu', 'fivehundred').'</a></li>';
   $output .= '</ul>';
   echo $output;
}

// change sub-menu class name 
class Stellar_Sub_Menu extends Walker_Nav_Menu {
  function start_lvl( &$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown\">\n";
  }
  function end_lvl( &$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }
}

// comments 
if ( ! function_exists( 'fivehundred_comment' ) ) :
	function fivehundred_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class('cf'); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'fivehundred' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'fivehundred' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class('cf'); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="commentarrow"></div>
		<article id="comment-<?php comment_ID(); ?>" class="comment">
        <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fivehundred' ); ?></p>
            <?php endif; ?>
        	<div class="comment-author">
           		<?php echo get_avatar( $comment, 64 ); ?>
            </div>
            <div class="comment-parent-box">
            	<h3><?php comment_author(); ?></h3>
            	<div class="comment-meta vcard">
                    <?php
                        printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s at %2$s', 'fivehundred' ), get_comment_date(), get_comment_time() )
                        );
                    ?>
                </div><!-- .comment-meta -->
            
                <section class="comment-content comment">
                    <?php comment_text(); ?>
                    <?php edit_comment_link( __( 'Edit', 'fivehundred' ), '<p class="edit-link">', '</p>' ); ?>
                    	<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'fivehundred' ), 'after' => ' <span>&darr;</span>', 'depth' 						=> $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- .reply -->
                </section><!-- .comment-content -->
		</div>
	</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
	}
endif;

//excerpt length
add_filter( 'excerpt_length', 'sp_custom_excerpt_length', 999 );
function sp_custom_excerpt_length( $length ) {
    // custom excerpt length
    return 60;
}

add_filter('excerpt_more', 'sp_custom_excerpt_more');

function sp_custom_excerpt_more($more) {
    // add more link to excerpt
    global $post;
    return '<a class="button more-link" href="'. get_permalink($post->ID) . '">'. __('read more', 'fivehundred') .'</a>';
}

// Showing option for Slider in Stellar
function stellar_slider_options() {
	$theme_settings = get_option('fivehundred_theme_settings');
	if (isset($theme_settings['stellar_slider']) && $theme_settings['stellar_slider'] == "static_image") {
		// Getting attachment
		$static_image = wp_get_attachment_image_src($theme_settings['stellar_slider_value']);
	}
	echo '
		<tr>
			<td>
				<label for="stellar_slider"><h2>'.__('Home Feature Options', 'fivehundred').'</h2></label><br/>
				<select id="stellar-slider" name="stellar_slider">
					<option value="static_image" '.((isset($theme_settings['stellar_slider']) && $theme_settings['stellar_slider'] == "static_image") ? 'selected="selected"' : '').'>'.__('Static Image', 'fivehundred').'</option>
					<option value="slider" '.((isset($theme_settings['stellar_slider']) && $theme_settings['stellar_slider'] == "slider") ? 'selected="selected"' : '').'>'.__('Slider Shortcode', 'fivehundred').'</option>
					<option value="hero-widget" '.((isset($theme_settings['stellar_slider']) && $theme_settings['stellar_slider'] == "hero-widget") ? 'selected="selected"' : '').'>'.__('Home Hero Section Widget', 'fivehundred').'</option>
				</select>
				<!-- Media editor for static image -->
				<div class="ignitiondeck static-image" style="'.((isset($theme_settings['stellar_slider']) && $theme_settings['stellar_slider'] == "static_image") ? 'display:block;' : 'display:none;').'">
					<button type="button" id="stellar-static-image-button" class="button insert-media add_media" data-input="stellar-static-image">Add Image</button><br/>
					<img id="stellar-image-holder" src="'.((isset($static_image[0])) ? $static_image[0] : '').'" width="20%" style="'.((isset($static_image[0])) ? 'display:block;' : 'display:none;').'" />
					<input type="hidden" id="stellar-static-image" name="stellar-static-image" class="main-setting" value="'.((isset($theme_settings['stellar_slider_value']) && $theme_settings['stellar_slider'] == "static_image") ? $theme_settings['stellar_slider_value'] : '').'" />
				</div>
				<div class="shortcode-rev-slider" style="'.((isset($theme_settings['stellar_slider']) && $theme_settings['stellar_slider'] == "slider") ? 'display:block;' : 'display:none;').'">
					<input type="text" id="rev-slider-shortcode" name="rev-slider-shortcode" value="'.((isset($theme_settings['stellar_slider_value']) && $theme_settings['stellar_slider'] == "slider") ? $theme_settings['stellar_slider_value'] : '').'" />
				</div>
				<div class="hero-widget" style="'.((isset($theme_settings['stellar_slider']) && $theme_settings['stellar_slider'] == "hero-widget") ? 'display:block;' : 'display:none;').'"><br />
					'.__('Click link to', 'fivehundred').' <a href="'.admin_url('widgets.php').'">'.__('Set Your Home Hero Section Widget', 'fivehundred').'</a>
					<p>'.__('Recommended: Use 500 wide custom widget for best result, you will need to make widget active to make it work', 'fivehundred').'</p>
				</div>
			</td>
		</tr>';
}
add_action('fivehundred_extra_fields', 'stellar_slider_options');

// Saving option in fivehundred theme settings
function stellar_save_slider_option($settings, $posts) {
	if (isset($posts['stellar_slider']) && !empty($posts['stellar_slider'])) {
		$settings['stellar_slider'] = $posts['stellar_slider'];
		if ($posts['stellar_slider'] == "static_image") {
			$settings['stellar_slider_value'] = $posts['stellar-static-image'];
		} else if ($posts['stellar_slider'] == "slider") {
			$settings['stellar_slider_value'] = $posts['rev-slider-shortcode'];
		}
	}
	return $settings;
}
add_filter('fh_theme_settings', 'stellar_save_slider_option', 10, 2);

// add extra logo option for internal pages
function stellar_extra_fields() {
	global $wpdb;
	$stellar_header_text = get_option('stellar_header_text');
    $stellar_inner_logo = get_option('stellar_inner_logo');
	if (isset($_POST['submit-theme-settings'])) {
		if (isset($_POST['stellar_header_text'])) {
            $stellar_header_text = esc_attr($_POST['stellar_header_text']);
			update_option('stellar_header_text', $stellar_header_text);
			}
		else {
			delete_option('stellar_header_text');
		}
		if (isset($_POST['stellar_inner_logo'])) {
            $stellar_inner_logo = esc_attr($_POST['stellar_inner_logo']);
			update_option('stellar_inner_logo', $stellar_inner_logo);
			}
		else {
			delete_option('stellar_inner_logo');
		}
	}
	$output = '<tr class="slider-static-text"><td>';
	$output .= '<p>';
	$output .= '<label for="header text"><h2>'.__('Add Header Text (optional)', 'fivehundred').'</h2></label>';
	$output .= '<label for="header text"><h4>'.__('If left empty it will use site title and tagline', 'fivehundred').'</h4></label>';
	$output .= '</p>';
	$output .='<p>'.__('Will only be displayed with static image option.','fivehundered').'</p>';
	$output .= '<input type="text" name="stellar_header_text" id="stellar_header_text" value="'.(isset($stellar_header_text) ? $stellar_header_text : '').'"/>';
	$output .='</td></tr>';
	$output .= '<tr><td>';
	$output .= '<p>';
	$output .= '<label for="header image"><h2>'.__('Add Header Logo for inner pages', 'fivehundred').'</h2></label>';
	$output .= '</p>';
	$output .='<p>'.__('Maximum image dimensions are 170 pixels wide and/or 96 pixels high.','fivehundered').'</p>';
	$output .= '<div class="uploader-header">';
	$output .= '<input type="text" name="stellar_inner_logo" id="stellar_inner_logo" value="'.(isset($stellar_inner_logo) ? $stellar_inner_logo : '').'"/>';
  	$output .= '<input type="button" class="button" name="header-upload" id="header-upload" value="Upload Image" /><br/>';
  	$output .= '<span id="header-preview">'.(isset($stellar_inner_logo) ? '<img src="'.$stellar_inner_logo.'" style="width: 20%;"/>' : '').'</span>';
	$output .= '</div>';
	$output .= '</td> </tr>';
	echo $output;	
}
add_action('fivehundred_extra_fields', 'stellar_extra_fields');

// remove extra bump due to admin bar 
add_action('get_header', 'stellar_filter_head');

function stellar_filter_head() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}

//Color Customization

function stellar_color_styles($css) {
	$primary_color = get_option('fh_primary_color');
	$primary_light_color = get_option('fh_primary_light_color');
	$primary_dark_color = get_option('fh_primary_dark_color');
	$secondary_color = get_option('fh_secondary_color');
	$secondary_dark_color = get_option('fh_secondary_dark_color');
	$text_color = get_option('fh_text_color');
	$text_subtle_color = get_option('fh_text_subtle_color');
	$text_onprimary_color = get_option('fh_text_onprimary_color');
	$site_background_color = get_option('fh_site_background_color');
	$container_background_color = get_option('fh_container_background_color');
	$customized = false;
	if (!empty($primary_color) || !empty($primary_light_color) || !empty($primary_dark_color) || !empty($secondary_color) || !empty($secondary_dark_color) || !empty($text_color) || !empty($text_subtle_color) || !empty($text_onprimary_color) || !empty($site_background_color) || !empty($container_background_color))
	{
		$customized = true;
	}
	if ($customized) {
		// Convert Sidebar from Hex to RGB
		if ( !empty($primary_color) && $primary_color !== '#47D79C') {
			$hexs = str_replace("#", "", $primary_color);

			if (strlen($hexs) == 3) {
				$rs = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gs = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bs = hexdec(substr($hexs,2,1).substr($hexs,2,1));

			}
			else {
				$rs = hexdec(substr($hexs,0,2));
				$gs = hexdec(substr($hexs,2,2));
				$bs = hexdec(substr($hexs,4,2));
			}
		}
		if ( !empty($primary_light_color) && $primary_light_color !== '#47D79C') {
			$hexs = str_replace("#", "", $primary_light_color);

			if (strlen($hexs) == 3) {
				$rs = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gs = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bs = hexdec(substr($hexs,2,1).substr($hexs,2,1));

			}
			else {
				$rs = hexdec(substr($hexs,0,2));
				$gs = hexdec(substr($hexs,2,2));
				$bs = hexdec(substr($hexs,4,2));
			}
		}
		if ( !empty($text_color) && $text_color !== '#444') {
			$hexs = str_replace("#", "", $text_color);

			if (strlen($hexs) == 3) {
				$rt = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gt = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bt = hexdec(substr($hexs,2,1).substr($hexs,2,1));

			}
			else {
				$rt = hexdec(substr($hexs,0,2));
				$gt = hexdec(substr($hexs,2,2));
				$bt = hexdec(substr($hexs,4,2));
			}
		}
		if (!empty($site_background_color) && $site_background_color !== '#f7f7f7') {
			$hexs = str_replace("#", "", $site_background_color);

			if (strlen($hexs) == 3) {
				$rb = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gb = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bb = hexdec(substr($hexs,2,1).substr($hexs,2,1));
			}
			else {
				$rb = hexdec(substr($hexs,0,2));
				$gb = hexdec(substr($hexs,2,2));
				$bb = hexdec(substr($hexs,4,2));
			} 
		}
		if (!empty($container_background_color) && $container_background_color !== '#fff') {
			$hexs = str_replace("#", "", $container_background_color);

			if (strlen($hexs) == 3) {
				$rc = hexdec(substr($hexs,0,1).substr($hexs,0,1));
				$gc = hexdec(substr($hexs,1,1).substr($hexs,1,1));
				$bc = hexdec(substr($hexs,2,1).substr($hexs,2,1));
			}
			else {
				$rc = hexdec(substr($hexs,0,2));
				$gc = hexdec(substr($hexs,2,2));
				$bc = hexdec(substr($hexs,4,2));
			} 
		}
		$css = 
		'<style>		
		body, .content_tabs li, .campaigns, .pagination li a {
		 	background-color: '.$site_background_color.'; 
		} 
		#header #menu-header .dropdown, #content.blog, #ign-project-content .entry-content, #project-grid .ign-project-summary, 
		#ign-project-content #sidebar, #content, .fh_widget, .widget-container, #header, .fh_widget .ign-content-video, #sidebar .fh_widget,
		#ign-project-content #sidebar .project-sidebar-wrapper #ign-product-levels a {
		 	background: '.$container_background_color.';
		}
		.footer_widgets .footer-widget-container a:hover {
			color: '.$primary_light_color.' !important;
		}
		#footerlist .widget-content, .footer_widgets .footer-widget-container h3, footer .centercircle span a, footer .centercircle span,
		.footer_widgets .footer-widget-container .subscribetext, .widgeticons i, footer #copyright, .button, a.button,
		.footerright li a, .footerright #home-sharing ul li a, footer_widgets input[type=submit],
		.footer_widgets .footer-widget-container a, footer #copyright a, .ign-supportnow a,
		#searchform input[type="submit"]:hover, form input[type="submit"]:hover, form input[type="button"]:hover, 
		.footer_widgets input[type=submit]:hover,
		form input[type="submit"], form input[type="button"],
		 #searchform input[type="submit"], .memberdeck input[type="submit"], 
		 .memberdeck form .form-row input[type="submit"], .md-requiredlogin #wp-submit, 
		 #fivehundred .ignitiondeck#stellar_lightbox form input[type="submit"], #content .ignitiondeck form#fes input[type="submit"],
		 .footer_widgets input::-webkit-input-placeholder,
		 .memberdeck input[type="submit"]:hover, .memberdeck form .form-row input[type="submit"]:hover, .md-requiredlogin #wp-submit:hover, 
		 #fivehundred .ignitiondeck#stellar_lightbox form input[type="submit"]:hover, #content .ignitiondeck form#fes input[type="submit"]:hover,
		 .fh_widget.ign-cta-container .ctabutton a, .fh_widget.ign-cta-container .ctaicon i, .footer_widgets input,
		 .home header#header #menu-header ul li.createaccount a, #header #menu-header ul li.createaccount a:hover, 
		 .home header#header #menu-header ul li.login a, #header #menu-header ul li.login a:hover,
		#containerwrapper .sliderimages-fullwindow .fullwindow-internal .stellar_placeholder_image .stellar_placeholder h1,
		#containerwrapper .sliderimages-fullwindow .fullwindow-internal .slider-image-wrapper .stellar_header_text h2, 
		#containerwrapper .sliderimages-fullwindow .fullwindow-internal .stellar_placeholder_image .stellar_header_text h1,
		#containerwrapper .sliderimages-fullwindow .fullwindow-internal .stellar_placeholder_image .stellar_placeholder h3.site-description, 	
		#containerwrapper .sliderimages-fullwindow .fullwindow-internal .stellar_placeholder_image .stellar_header_text h3.site-description {
			color: '.$text_onprimary_color.' !important;
		}
		.footer_widgets input {
			border-color: '.$text_onprimary_color.';
		}
		body, #header #menu-header a, .entry-content p, .home-feature .featuredbox li .ign-content-text,
		.blog .posts-link .prev-post a:hover, .blog .posts-link .next-post a:hover, .entry-content h2.entry-title > a, form label, form p
		.widget-container li a, .widget-container ul li a, #project-grid .ign-project-summary .ign-summary-container h3.ign-summary-author, 
		.woocommerce-cart table.cart td a, .woocommerce-cart table.cart th a, .woocommerce ul.products li.product h3, #project-grid .ign-project-summary 
		.ign-summary-container .ign-progress-wrapper .ign-progress-percentage, #project-grid .ign-project-summary .ign-summary-container 
		.ign-progress-wrapper .ign-progress-raised, #project-grid .ign-project-summary .ign-summary-container .ign-summary-days,
		#project-grid .ign-project-summary .ign-summary-container, .widget-container li.cat-item a, .ign-project-title .product-author-details span,
		.pagination li a, #sidebar .author-bio .author-bio-info, #sidebar .author-bio .author-bio-info .contact-link a, 
		.entry-content h3, .comment-content h3,
		 #content.fullwidth .sectionheading h1, .sectionheading h1, .sectionheading span,
		#content.fullwidth .sectionheading span, #site-description h1, #site-description.project-single h3, #site-description.project-single p,
		.ignition_project #ign-hDeck-right .internal strong, .ignition_project #ign-hDeck-right .internal div, #site-description.project-single span,
		.ign-project-title .product-author-details i, #ign-project-content .entry-content, 
		.ignitiondeck.backer_profile .backer_projects li.backer_project_mini .backer_project_title a, .memberdeck .md-profile .project-name,
		 #content.blog, #header #menu-header ul li.createaccount a, #header #menu-header ul li.login a,
		 #ign-project-content #sidebar .project-sidebar-wrapper #ign-product-levels a
		#ign-project-content #sidebar .project-sidebar-wrapper #ign-product-levels a:hover, 
		#ign-project-content #sidebar .project-sidebar-wrapper #ign-product-levels a:hover .level-group .ign-level-counts,
		#ign-project-content #sidebar .project-sidebar-wrapper #ign-product-levels a .level-group .ign-level-counts, .entry-summary p,
		.memberdeck .checkout-title-bar span.checkout-project-title, .entry-summary h2.entry-title > span a, 
		.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,
		.product_meta span a,
		.ignitiondeck form#fes .form-row input, .ignitiondeck form .form-row input, #fivehundred .ignitiondeck#stellar_lightbox form input {
		 	color: '.$text_color.';
		}
		#header #menu-header ul li:hover:after, .ignitiondeck.backer_profile .backer_projects li.backer_project_mini .backers_days_left,
		form input[type="submit"], form input[type="button"], #searchform input[type="submit"], .memberdeck button, .memberdeck input[type="submit"], 
		.memberdeck form .form-row input[type="submit"], .md-requiredlogin #wp-submit, #fivehundred .ignitiondeck#stellar_lightbox form input[type="submit"],		
		#content .ignitiondeck form#fes input[type="submit"], .content_tabs li.active, .ignition_project #ign-hDeck-left .feature-image-wrapper 
		.video.hasvideo:after, #header #menu-header ul li.createaccount:hover, #header #menu-header ul li.login:hover, .footer_widgets input[type=submit],
		.slidercta a.ctagreen, .slidercta a:hover.ctagrey, #project-grid .ign-project-summary .ign-summary-container .ign-summary-item .ign-summary-image,
		#ign-project-content #sidebar #ign-product-levels a:hover, .grid-header ul li.filter_choice a, .memberdeck .md-profile .project-status, 
		.pagination li.selected a, .pagination li span.current, .edd-submit.button, .edd-submit.button.blue, .edd-submit.button.gray, 
		.edd-submit.button:focus, .edd-submit.button.blue:focus, .edd-submit.button.gray:focus, .edd-submit.button:active, 
		.edd-submit.button.blue:active, .edd-submit.button.gray:active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce 
		div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs 
		ul.tabs li a, .woocommerce span.onsale, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs 
		ul.tabs li:hover, .ignition_project #ign-hDeck-left .feature-image-wrapper, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, 
		.woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button,
		.woocommerce input.button, .ign-supportnow a, .button, a.button, .fh_widget.ign-cta-container .ctabutton a  {
		 	background-color: '.$primary_color.';
		}
		#header #menu-header .dropdown li a:hover, .entry-content a, .blog .posts-link .prev-post a, .blog .posts-link .next-post a, 
		.ignitiondeck.backer_profile .backer_projects li.backer_project_mini .backers_funded, .ignitiondeck.backer_profile .backer_data 
		.backer_supported, .md-profile .project-funded , .md-box table td a i, .ignition_project #ign-hDeck-right .internal #ign-share-button a,
		.woocommerce .woocommerce-message:before, .home #header #menu-header a:hover, #header #menu-header .dropdown:before,
		#project-grid .ign-project-summary .ign-summary-container .ign-summary-item .ign-summary-image .ign-summary-learnmore span > i, 
		.ignition_project #ign-hDeck-right .ign-product-goal > strong, #header .menu-toggle i, 
		.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce ul.products li.product .price,
		.pagination li a.next:after, .woocommerce .woocommerce-info::before, .pagination li a.prev:before, 
		#comments ol.commentlist li .comment-content .edit-link a:hover, #wp-calendar #today, 
		.memberdeck .checkout-title-bar span.currency-symbol .checkout-tooltip i.tooltip-color, 
		.memberdeck form a, .ignitiondeck.backer_profile .backer_data .backer_supported, 
		.ignitiondeck.backer_profile .backer_projects li.backer_project_mini .backers_funded, .memberdeck .md-profile .project-funded, 
		footer .centercircle .toparrow a, .memberdeck button:hover, .memberdeck .checkout-title-bar span.currency-symbol {
		 	color: '.$primary_color.';
		}
		#containerwrapper .sliderimages-fullwindow .fullwindow-internal .ign-content-fullalt .ign-text-container h3,
		#containerwrapper .sliderimages-fullwindow .fullwindow-internal .ign-content-fullalt .ign-text-container .ign-content-text, 
		.widget-content, form input[type="submit"], form input[type="button"], #searchform input[type="submit"], .memberdeck button, .memberdeck 
		input[type="submit"], .memberdeck form .form-row input[type="submit"], .md-requiredlogin #wp-submit, #fivehundred .ignitiondeck#stellar_lightbox 
		form input[type="submit"], #content .ignitiondeck form#fes input[type="submit"], .content_tabs li.active, .ignition_project #ign-hDeck-left 
		.feature-image-wrapper .video.hasvideo:after, #header-search.search-form form input[type=submit]:hover,
		.widget-container.widget_archive label, .widget-container.widget_archive form p, form .widget-container.widget_archive p,
		 .slidercta a:hover.ctagreen, .slidercta a.ctagrey, .fh_widget.ign-cta-container .ctabutton a:hover, 
		.content_tabs li:hover, .grid-header ul li.filter_choice a:hover, .ign-supportnow a:hover, 
		.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond 
		input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], 
		.woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, 
		.woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce 
		a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce 
		button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce 
		button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce 
		input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce 
		input.button.alt:disabled[disabled]:hover, #ign-hDeck-left .video.hasvideo:hover:after, .button:hover, a.button:hover, 
		.ignition_project #ign-hDeck-right .internal #ign-share-button a:hover, .content_tabs li,
		.home #header #menu-header a, #header #menu-header ul li.createaccount:hover a, #header 
		#menu-header ul li.login:hover a, .slidercta a.ctagreen, .slidercta a:hover.ctagrey, 
		.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, 
		.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, 
		.grid-header ul li.filter_choice a, .sliderimages h1, 
		.sliderimages h3, woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce 	
		input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce 
		input.button:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, 
		.woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce span.onsale, 
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li:hover, 
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li:hover,
		.edd-submit.button, .edd-submit.button.blue, .edd-submit.button.gray, .edd-submit.button:focus, .edd-submit.button.blue:focus, 
		.edd-submit.button.gray:focus, .edd-submit.button:active, .edd-submit.button.blue:active, .edd-submit.button.gray:active,
		.edd-submit.button:hover, .edd-submit.button.blue:hover, .edd-submit.button.gray:hover,
		.memberdeck .md-profile .md-credits span.green, .memberdeck .md-profile .md-credits span, .memberdeck .dashboardmenu a, 
		.memberdeck .dashboardmenu a:visited, .memberdeck .md-profile .project-status { 
			color: '.$text_onprimary_color.'; 
		}
		#header-search.search-form form input[type=submit]:hover, #ign-project-content #sidebar #ign-product-levels a, footer 
		.fullwindow-internal.bottom-footer, footer .centercircle, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce	
		button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce 
		button.button:hover, .woocommerce input.button:hover, .edd-submit.button:hover, .edd-submit.button.blue:hover, .edd-submit.button.gray:hover { 
			background-color: '.$primary_light_color.'; 
		}
		
		'.(isset($rs) ? '
		#searchform input[type="submit"]:hover, form input[type="submit"]:hover, form input[type="button"]:hover, .footer_widgets 
	    input[type=submit]:hover, .slidercta a:hover.ctagreen, .slidercta a.ctagrey, .fh_widget.ign-cta-container .ctabutton a:hover, 
		.content_tabs li:hover, .grid-header ul li.filter_choice a:hover, .ign-supportnow a:hover, 
		#ign-project-content #sidebar .project-sidebar-wrapper #ign-product-levels a:hover, .memberdeck button:hover, 
		.memberdeck input[type="submit"]:hover, .memberdeck form .form-row input[type="submit"]:hover, .md-requiredlogin #wp-submit:hover, 
		#fivehundred .ignitiondeck#stellar_lightbox form input[type="submit"]:hover, #content .ignitiondeck form#fes input[type="submit"]:hover,
		.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond 
		input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], 
		.woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, 
		.woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce 
		a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce 
		button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce 
		button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce 
		input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce 
		input.button.alt:disabled[disabled]:hover, #ign-hDeck-left .video.hasvideo:hover:after, .button:hover, a.button:hover { 
			 background-color: rgba(' . $rs . ',' . $gs . ', ' . $bs . ', .1);
		}': '').'
		
		'.(isset($rs) ? '
		.ignition_project #ign-hDeck-right .internal #ign-share-button a:hover {
			border: 2px solid  rgba(' . $rs . ',' . $gs . ', ' . $bs . ', .1);
		}':'').'
		 
		.widget-container li a:hover, .widget-container ul li a:hover, .ign-more-projects a, .ign-more-projects:after,
		footer #copyright a:hover, .ign-more-projects a:hover { 
			color: '.$secondary_color.';
		}
		.ignition_project #ign-hDeck-right .internal #ign-share-button a {
			border: 2px solid '.$primary_color.';
		}
		.woocommerce .woocommerce-message { 
			border-top-color: '.$primary_color.';
		}
		#header-search.search-form form input[type=text], 
		#project-grid .ign-project-summary .ign-summary-container .ign-progress-wrapper .ign-progress-percentage, 
		#project-grid .ign-project-summary .ign-summary-container .ign-progress-wrapper .ign-progress-raised, 
		#project-grid .ign-project-summary .ign-summary-container {
			border-color: '.$primary_color.';
		}
		#header #menu-header .dropdown {
			border-top-color: '.$primary_color.';
		}
		#project-grid .ign-project-summary:hover {
			border-color: '.$primary_color.';
		}
		#project-grid .ign-project-summary .ign-summary-container .ign-progress-wrapper .ign-progress-bar, .footercontent,
		.memberdeck .dashboardmenu li:hover, .memberdeck .dashboardmenu li.active a, .ignitiondeck form#fes input[type=submit]:hover, 
		.ignitiondeck form input[type=submit]:hover {
			background-color: '.$primary_dark_color.'; 
		}
		.ignition_project #ign-hDeck-right .ign-progress-wrapper .ign-progress-bar {
			border-color: '.$primary_dark_color.'; 
		}
		.content_tabs {
			border-bottom-color: '.$primary_color.';
		}
		
		#container .ign-video-headline h3, .fh_widget.ign-content-normal .ign-text-container h3, #sidebar h3.widget-title, 
		.widget-container li.cat-item a:hover, .widget-container li.cat-item:hover, .home-feature .featuredbox li h1, .home-feature .featuredbox li i {
			color: '.$secondary_dark_color.';
		}
		.widget-container li.cat-item:hover {
			border-top-color: '.$secondary_dark_color.'; 
			border-bottom-color: '.$secondary_dark_color.';
		}
		.woocommerce ul.products li.product:hover, .woocommerce-page ul.products li.product:hover { 
			border-color: '.$primary_color.';
		}
		.woocommerce .woocommerce-info { 
			border-top-color: '.$primary_color.';
		}
		.pagination li.selected a, .pagination li span.current {
			border-bottom: 2px solid '.$primary_color.'; 
		}		
		.memberdeck .checkout-title-bar span.active {
			color: '.$text_subtle_color.'; 
		}
		.memberdeck .checkout-title-bar span.active:after {
			border-bottom-color: '.$primary_color.';
		}
		.memberdeck .checkout-title-bar span.currency-symbol, {
			color: '.$primary_dark_color.';
		}
		.memberdeck form .payment-type-selector a.active, .memberdeck form .payment-type-selector a:hover {
			border-color: '.$primary_color.';
		}
		a.comment-reply-link, a.comment-reply-link:hover, a.comment-reply-link:focus, a.comment-reply-link:active, a.comment-reply-link, 
		.ignitiondeck form .main-btn, .ignitiondeck form input[type=submit], a.comment-reply-link, .ignitiondeck form .main-btn,
		.ignitiondeck form input[type=submit]:hover, .memberdeck .dashboardmenu a, .memberdeck .dashboardmenu a:hover { 
			color: '.$text_subtle_color.';
		}
		.ignitiondeck .fes_section h3, .memberdeck .md-profile.paypal-settings h3, .memberdeck .md-profile.mail-chimp h3, 
		.memberdeck .md-profile.stripe-settings h3, .memberdeck form .form-row label, .ignitiondeck form#fes .form-row label, 
		.ignitiondeck form .form-row label
		.ignitiondeck form#fes .form-row textarea, .ignitiondeck form .form-row textarea, .ignitiondeck form#fes .form-row input, .ignitiondeck form 
		.form-row input, .ignitiondeck form#fes .form-row .idc-dropdown__select, .ignitiondeck form .form-row .idc-dropdown__select, .ignitiondeck form#fes 
		.form-row.pretty_dropdown select, .ignitiondeck form .form-row.pretty_dropdown select, 
		#content .ignitiondeck form#fes input, .wp-core-ui .button, .wp-core-ui .button-secondary, #content .ignitiondeck form#fes textarea,
		.memberdeck form .form-row input { 
			color:  '.$text_color.';
		}
		.ignitiondeck form#fes input[type=submit], .ignitiondeck form input[type=submit] {
			background: '.$primary_color.'; 
			background-color: '.$primary_color.' ; 
			color: '.$text_onprimary_color.'!important;
		}
		.ignitiondeck form#fes input[type=submit]:hover, .ignitiondeck form input[type=submit]:hover {
			background: '.$primary_dark_color.';
		}
		.memberdeck form a:hover {
			color: '.$primary_dark_color.';
		}
		.ignitiondeck.backer_profile .backer_projects li.backer_project_mini .backers_days_left {
			background-color: '.$primary_color.' ; 
			color: '.$text_onprimary_color.'!important;
		}
		</style>';
		return (isset($css) ? $css : '');
	}
}

?>
