<?php
/**
* Stellar Featured Widget
*/
class Stellar_Featured_Widget extends WP_Widget {
	/**
	* Register widget with WordPress
	*/
	function __construct() {
		parent::__construct(
			'Stellar_featured_widget',
			__('Stellar Feature Widget', 'fivehundred'),
			array('description' => __('A three column widget used for displaying features or descriptions on the home page.', 'fivehundred')),
			array('width' => 'auto'));
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget($args, $instance) {
		if (!empty($instance)) {
			if (isset($instance['height'])) {
				$height = html_entity_decode($instance['height']);
			}
			else {
				$height = 100;
			}
			
			if (isset($instance['padding_top'])) {
				$padding_top = html_entity_decode($instance['padding_top']);
			}
			else {
				$padding_top = '';
			}
			if (isset($instance['padding_bottom'])) {
				$padding_bottom = html_entity_decode($instance['padding_bottom']);
			}
			else {
				$padding_bottom = '';
			}
			if (isset($instance['title'])) {
				$title = $instance['title'];
			}
			else {
				$title = '';
			}
			
			if (isset($instance['icon1'])) {
				$icon1 = html_entity_decode($instance['icon1']);
			}
			else {
				$icon1 = '';
			}
			
			if (isset($instance['title1'])) {
				$title1 = html_entity_decode($instance['title1']);
			}
			else {
				$title1 = '';
			}
			
			if (isset($instance['text1'])) {
				$text1 = html_entity_decode($instance['text1']);
			}
			else {
				$text1 = '';
			}
			
			if (isset($instance['icon2'])) {
				$icon2 = html_entity_decode($instance['icon2']);
			}
			else {
				$icon2 = '';
			}
			
			if (isset($instance['text2'])) {
				$text2 = html_entity_decode($instance['text2']);
			}
			else {
				$text2 = '';
			}
			
			if (isset($instance['title2'])) {
				$title2 = html_entity_decode($instance['title2']);
			}
			else {
				$title2 = '';
			}
			
			if (isset($instance['icon3'])) {
				$icon3 = html_entity_decode($instance['icon3']);
			}
			else {
				$icon3 = '';
			}
			
			if (isset($instance['title3'])) {
				$title3 = html_entity_decode($instance['title3']);
			}
			else {
				$title3 = '';
			}
			
			if (isset($instance['text3'])) {
				$text3 = html_entity_decode($instance['text3']);
			}
			else {
				$text3 = '';
			}
			
			
			
			if (isset($instance['custom_class'])) {
				$custom_class = html_entity_decode($instance['custom_class']);
			}
			else {
				$custom_class = '';
			}
			
			echo '<div class="fullwindow home-feature" '.(!empty($height) ? 'style="height: '.$height.'px;";' : '').'><div class="fullwindow-internal '.
			$custom_class.'" style="height: '.$height.'px; ';
			echo '">';	
			echo '<div class="constrained">';
			echo'<div class="ign-content-fullalt" style="';	
			echo (!empty($height) ? 'height: '.$height.'px;' : '');		
			echo (!empty($padding_top) ? ' padding-top: '.$padding_top.'px;' : ''); 
			echo (!empty($padding_bottom) ? ' padding-bottom: '.$padding_bottom.'px;' : '');
			echo '">';
			echo '<h1>'.$title.'</h1>';
			echo '<ul class="featuredbox"><li>';
			echo (!empty($icon1) ? '<i class="fa '.$icon1.'"></i>' : '');
			echo '<h1 class="featuretitle">'.$title1.'</h1>';
			echo'<div class="ign-content-text">'.$text1.'</div>';
			echo '</li>';
			echo '<li>';
			echo (!empty($icon2) ? '<i class="fa '.$icon2.'"></i>' : '');
			echo '<h1 class="featuretitle">'.$title2.'</h1>';
			echo'<div class="ign-content-text">'.$text2.'</div>';
			echo '</li>';
			echo '<li>';
			echo (!empty($icon3) ? '<i class="fa '.$icon3.'"></i>' : '');
			echo '<h1 class="featuretitle">'.$title3.'</h1>';
			echo'<div class="ign-content-text">'.$text3.'</div>';
			echo '</li></ul><div class="clear"></div>';
			echo '</div></div></div></div>';
		}
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	function form($instance) {
		if (isset($instance['text1'])) {
			$text1 = $instance['text1'];
		}
		if (isset($instance['title1'])) {
			$title1 = $instance['title1'];
		}
		if (isset($instance['icon1'])) {
			$icon1 = $instance['icon1'];
		}
		if (isset($instance['text2'])) {
			$text2 = $instance['text2'];
		}
		if (isset($instance['title2'])) {
			$title2 = $instance['title2'];
		}
		if (isset($instance['icon2'])) {
			$icon2 = $instance['icon2'];
		}
		if (isset($instance['text3'])) {
			$text3 = $instance['text3'];
		}
		if (isset($instance['title3'])) {
			$title3 = $instance['title3'];
		}
		if (isset($instance['icon3'])) {
			$icon3 = $instance['icon3'];
		}
		
		if (isset($instance['height'])) {
			$height = $instance['height'];
		}
		if (isset($instance['padding_top'])) {
			$padding_top = $instance['padding_top'];
		}
		if (isset($instance['padding_bottom'])) {
			$padding_bottom = $instance['padding_bottom'];
		}
		if (isset($instance['title'])) {
			$title = $instance['title'];
		}
		
		if (isset($instance['custom_class'])) {
			$custom_class = $instance['custom_class'];
		}
		/** 



		remove inline styles here and place into CSS or better yet, use WP default classes
		


		*/
		$form = '<p>';
		$form .= '<label for="'.$this->get_field_id( 'title' ).'">'.__('Header Title ', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" value="'.(isset($title) ? $title : '').'"/>';
		$form .= '</label></p>';
		
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'height' ).'">'.__('Content Height (numbers only, measured in pixels)', 'fivehundred').':';
		$form .= '<input type="text" class="widefat" id="'.$this->get_field_id( 'height' ).'" name="'.$this->get_field_name( 'height' ).'" value="'.(isset($height) ? $height : '').'">';
		$form .= '</label><span style="font-size: 90%; color: #666;">'.__('This must be set to ensure content below it does not roll up underneath it.', 'fivehundred').'</span></p>';
		
		$form .= '<div style="width: 49.5%; display: inline-block; margin-right: 1%;"><label for="'.$this->get_field_id( 'padding_top' ).'">'.__('Padding Top (optional)', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'padding_top' ).'" name="'.$this->get_field_name( 'padding_top' ).'" value="'.(isset($padding_top) ? $padding_top : '').'"/></div>';
		
		$form .= '<div style="width: 49.5%; display: inline-block;"><label for="'.$this->get_field_id( 'padding_bottom' ).'">'.__('Padding Bottom (optional)', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'padding_bottom' ).'" name="'.$this->get_field_name( 'padding_bottom' ).'" value="'.(isset($padding_bottom) ? $padding_bottom : '').'"/>';
		$form .= '</div><div style="font-size: 90%; color: #666; text-align: center; margin-bottom: 10px;">'.__('Numbers only, measured in pixels.', 'fivehundred').'</div>';
		
		$form .= '<div style="font-size: 90%; color: #666; text-align: center; margin-bottom: 10px;">'.__('Pick your icons and paste the icon codes into the fields below. <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank"> List of icons available here</a>', 'fivehundred').'</div>';
		$form .= '<div style="width: 49.5%; display: inline-block; margin-right: 1%; margin-bottom:2px;">';
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'icon1' ).'">'.__('Icon 1', 'fivehundred').':</label>';
		$form .= '</p>';
$form .= '<input type="text" class="" id="'.$this->get_field_id( 'icon1' ).'" name="'.$this->get_field_name( 'icon1' ).'" value="'.(!empty($icon1) ? $icon1 : '').'">';
		$form .= '</div>';
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'title1' ).'">'.__('title 1', 'fivehundred').':</label></p><p>';
		$form .= '<input type="text" class="" id="'.$this->get_field_id( 'title1' ).'" name="'.$this->get_field_name( 'title1' ).'" value="'.(!empty($title1) ? $title1 : '').'">';
		$form .= '</p><p><label for="'.$this->get_field_id( 'text1' ).'">'.__('Content 1', 'fivehundred').':</label>';
		$form .= '</p>';
		$form .= '<textarea class="widefat" rows="5" cols="20" id="'.$this->get_field_id( 'text1' ).'" name="'.$this->get_field_name( 'text1' ).'">';
		$form .= (!empty($text1) ? $text1 : '');
		$form .= '</textarea>';
		
		$form .= '<div style="width: 49.5%; display: inline-block; margin-right: 1%; margin-bottom:2px;">';
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'icon2' ).'">'.__('Icon 2', 'fivehundred').':</label>';
		$form .= '</p>';
		$form .= '<input type="text" class="" id="'.$this->get_field_id( 'icon2' ).'" name="'.$this->get_field_name( 'icon2' ).'" value="'.(!empty($icon2) ? $icon2 : '').'">';
		$form .= '</div>';
		
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'title2' ).'">'.__('title 2', 'fivehundred').':</label></p><p>';
		$form .= '<input type="text" class="" id="'.$this->get_field_id( 'title2' ).'" name="'.$this->get_field_name( 'title2' ).'" value="'.(!empty($title2) ? $title2 : '').'">';
		$form .= '</p><p><label for="'.$this->get_field_id( 'text2' ).'">'.__('Content 2', 'fivehundred').':</label>';
		$form .= '<label></p>';
		$form .= '<textarea class="widefat" rows="5" cols="20" id="'.$this->get_field_id( 'text2' ).'" name="'.$this->get_field_name( 'text2' ).'">';
		$form .= (!empty($text2) ? $text2 : '');
		$form .= '</textarea>';
		
		$form .= '<div style="width: 49.5%; display: inline-block; margin-right: 1%; margin-bottom:2px;">';
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'icon3' ).'">'.__('Icon 3', 'fivehundred').':</label>';
		$form .= '</p>';
		$form .= '<input type="text" class="" id="'.$this->get_field_id( 'icon3' ).'" name="'.$this->get_field_name( 'icon3' ).'" value="'.(!empty($icon3) ? $icon3 : '').'">';
		$form .= '</div>';
		
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'title3' ).'">'.__('title 3', 'fivehundred').':</label></p><p>';
		$form .= '<input type="text" class="" id="'.$this->get_field_id( 'title3' ).'" name="'.$this->get_field_name( 'title3' ).'" value="'.(!empty($title3) ? $title3 : '').'">';
		$form .= '</p><p><label for="'.$this->get_field_id( 'text3' ).'">'.__('Content 3', 'fivehundred').':</label>';
		$form .= '<label></p>';
		$form .= '<textarea class="widefat" rows="5" cols="20" id="'.$this->get_field_id( 'text3' ).'" name="'.$this->get_field_name( 'text3' ).'">';
		$form .= (!empty($text3) ? $text3 : '');
		$form .= '</textarea>';
		
		
		$form .='<label for="'.$this->get_field_id( 'custom_class' ).'">'.__('Custom Class Name (not required)', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'custom_class' ).'" name="'.$this->get_field_name( 'custom_class' ).'" value="'.(isset($custom_class) ? $custom_class : '').'"/>';
		$form .= '<div style="font-size: 90%; color: #666; text-align: center; margin-bottom: 10px;">'.__('you may add multiple classes by seperating with spaces <br> (ie: class class_two)', 'fivehundred').'</div>';

		echo $form;
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['height'] = esc_attr(strip_tags($new_instance['height']));
		$instance['title'] = esc_attr(strip_tags($new_instance['title']));
		$instance['padding_top'] = esc_attr($new_instance['padding_top']);
		$instance['padding_bottom'] = esc_attr($new_instance['padding_bottom']);
		$instance['text1'] = esc_attr($new_instance['text1']);
		$instance['icon1'] = esc_attr($new_instance['icon1']);
		$instance['text2'] = esc_attr($new_instance['text2']);
		$instance['icon2'] = esc_attr($new_instance['icon2']);
		$instance['text3'] = esc_attr($new_instance['text3']);
		$instance['icon3'] = esc_attr($new_instance['icon3']);
		$instance['title1'] = esc_attr($new_instance['title1']);
		$instance['title2'] = esc_attr($new_instance['title2']);
		$instance['title3'] = esc_attr($new_instance['title3']);
		$instance['custom_class'] = esc_attr($new_instance['custom_class']);

		return $instance;
	}
}
?>