<?php
/**
* stellar cta widget
*/
class Stellar_Cta_Widget extends WP_Widget {
	/**
	* Register widget with WordPress
	*/
	
	function __construct() {
		parent::__construct(
			'Stellar_Cta_Widget',
			__('Stellar CTA Widget', 'fivehundred'),
			array('description' => __('Background image with headline overlay.', 'fivehundred')),
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
			
			if (isset($instance['bg-color'])) {
				$bg_color = html_entity_decode($instance['bg-color']);
			}
			else {
				$bg_color = '';
			}
			
			if (isset($instance['title'])) {
				$title = $instance['title'];
			}
			else {
				$title = '';
			}
			
			if (isset($instance['sub_title'])) {
				$sub_title = $instance['sub_title'];
			}
			else {
				$sub_title = '';
			}
			
			if (isset($instance['custom_class'])) {
				$custom_class = html_entity_decode($instance['custom_class']);
			}
			else {
				$custom_class = '';
			}
			
			if (isset($instance['image'])) {
				$image = html_entity_decode($instance['image']);
			}
			else {
				$image = '';
			}
			
			if (isset($instance['cta_icon'])) {
				$cta_icon = html_entity_decode($instance['cta_icon']);
			}
			else {
				$cta_icon = '';
			}
			
			if (isset($instance['cta_button'])) {
				$cta_button = html_entity_decode($instance['cta_button']);
			}
			else {
				$cta_button = '';
			}
			
			if (isset($instance['cta_link'])) {
				$cta_link = html_entity_decode($instance['cta_link']);
			}
			else {
				$cta_link = '';
			}
			
			if (isset($instance['text_color'])) {
				$text_color = html_entity_decode($instance['text_color']);
			}
			else {
				$text_color = '';
			}
			echo '<div class="fullwindow ctabox" '.(!empty($height) ? 'style="height: '.$height.'px;";' : '').'><div class="fullwindow-internal '.
			$custom_class.'" style=" height: '.$height.'px; background-color: '.$bg_color.';" ';
			echo '">';	
			echo '<div  style="background-image: url('.$image.');"><div class="constrained">';
			echo '<div class="fh_widget ign-cta-container '.$custom_class.'">';
			echo '<div class="ctaicon"><i class="fa '.$cta_icon.'"></i></div>';
			echo '<div class="ctacontent"><h1 style="color:'.$text_color.' !important;">'.$title.'</h1>';
			echo '<p style="color:'.$text_color.' !important;">'.$sub_title.'</p></div>';
			echo '<div class="ctabutton"><a href="'.$cta_link.'">'.$cta_button.'</a></div>';
			echo '</div></div></div></div></div>';
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
		if (isset($instance['image'])) {
			$image = $instance['image'];
		}
		if (isset($instance['title'])) {
			$title = $instance['title'];
		}
		if (isset($instance['custom_class'])) {
			$custom_class = $instance['custom_class'];
		}
		if (isset($instance['text_color'])) {
			$text_color = $instance['text_color'];
		}
		if (isset($instance['sub_title'])) {
			$sub_title = $instance['sub_title'];
		}
		if (isset($instance['cta_link'])) {
			$cta_link = $instance['cta_link'];
		}
		if (isset($instance['cta_icon'])) {
			$cta_icon = $instance['cta_icon'];
		}
			
		if (isset($instance['height'])) {
			$height = $instance['height'];
		}
		
		if (isset($instance['bg-color'])) {
			$bg_color = $instance['bg-color'];
		}
		if (isset($instance['cta_button'])) {
			$cta_button = $instance['cta_button'];
		}
		$form = '<p>';
		$form .= '<label for="'.$this->get_field_id( 'title' ).'">'.__('Title', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" value="'.(isset($title) ? $title : '').'"/>';
		$form .= '<label for="'.$this->get_field_id( 'sub_title' ).'">'.__('Sub Title', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'sub_title' ).'" name="'.$this->get_field_name( 'sub_title' ).'" value="'.(isset($title) ? $sub_title : '').'"/>';
		$form .= '<label for="'.$this->get_field_id( 'cta_button' ).'">'.__('CTA button text', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'cta_button' ).'" name="'.$this->get_field_name( 'cta_button' ).'" value="'.(isset($title) ? $cta_button : '').'"/>';
		$form .= '<label for="'.$this->get_field_id( 'cta_link' ).'">'.__('CTA link', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'cta_link' ).'" name="'.$this->get_field_name( 'cta_link' ).'" value="'.(isset($title) ? $cta_link : '').'"/>';
		$form .= '</label></p>';
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'height' ).'">'.__('Content Height (numbers only, measured in pixels)', 'fivehundred').':';
		$form .= '<input type="text" class="widefat" id="'.$this->get_field_id( 'height' ).'" name="'.$this->get_field_name( 'height' ).'" value="'.(isset($height) ? $height : '').'">';
		$form .= '</label><span style="font-size: 90%; color: #666;">'.__('This must be set to ensure content below it does not roll up underneath it.', 'fivehundred').'</span></p>';
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'bg-color' ).'">'.__('Content background color').':';
		$form .= '<input type="text" class="widefat" id="'.$this->get_field_id( 'bg-color' ).'" name="'.$this->get_field_name( 'bg-color' ).'" value="'.(isset($bg_color) ? $bg_color : '').'">';
		$form .= '</label><span style="font-size: 90%; color: #666;">'.__('This is optional and can be used if no background image is set, use # - ie: #ffffff', 'fivehundred').'</span></p>';
		$form .= '<p>';
		$form .= '<label for="'.$this->get_field_id( 'image' ).'">'.__('Image', 'fivehundred').':</label>';
		$form .= '<input type="text" class="widefat alert-image" id="'.$this->get_field_id( 'image' ).'" name="'.$this->get_field_name( 'image' ).'" value="'.(!empty($image) ? $image : '').'">';
		$form .= '<button class="button fh_media_button" name="fh_media_button" id="'.$this->get_field_id( 'media' ).'">'.__('Add Image', 'fivehundred').'</button></p>';
		
		$form .='<p><label for="'.$this->get_field_id( 'cta_icon' ).'">'.__('CTA Icon (Font Awesome icon, Ex: fa-bullhorn) ', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'cta_icon' ).'" name="'.$this->get_field_name( 'cta_icon' ).'" value="'.(isset($text_color) ? $cta_icon: '').'"/>';
		$form .= '</p>';
		
		$form .='<p><label for="'.$this->get_field_id( 'text_color' ).'">'.__('Text Color (Hex Color including # - ie: #ffffff) ', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'text_color' ).'" name="'.$this->get_field_name( 'text_color' ).'" value="'.(isset($text_color) ? $text_color : '').'"/>';
		$form .= '</p>';
		
		$form .='<p><label for="'.$this->get_field_id( 'custom_class' ).'">'.__('Custom Class Name (not required)', 'fivehundred').':';
		$form .= '<input class="widefat" type="text" id="'.$this->get_field_id( 'custom_class' ).'" name="'.$this->get_field_name( 'custom_class' ).'" value="'.(isset($custom_class) ? $custom_class : '').'"/></p>';
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
		$instance['title'] = esc_attr(strip_tags($new_instance['title']));
		$instance['height'] = esc_attr(strip_tags($new_instance['height']));
		$instance['bg-color'] = esc_attr(strip_tags($new_instance['bg-color']));
		$instance['sub_title'] = esc_attr(strip_tags($new_instance['sub_title']));
		$instance['cta_button'] = esc_attr(strip_tags($new_instance['cta_button']));
		$instance['cta_icon'] = esc_attr(strip_tags($new_instance['cta_icon']));
		$instance['cta_link'] = esc_attr($new_instance['cta_link']);
		$instance['image'] = esc_attr($new_instance['image']);
		$instance['custom_class'] = esc_attr($new_instance['custom_class']);
		$instance['text_color'] = esc_attr($new_instance['text_color']);
		return $instance;
	}
}
?>