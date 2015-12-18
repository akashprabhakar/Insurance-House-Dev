<?php

class ANT_FHG_Widget extends WP_Widget
{
	public function __construct() {
		parent::__construct(
	 		'wysiwyg_widgets_widget', // Base ID
			'Annet FHG Blocks Widget', // Name
			array( 'description' => __('Displays one of your Widget Blocks.', 'ant-fhg-widgets') ) // Args
		);

		add_filter( 'ww_content', 'wptexturize') ;
		add_filter( 'ww_content', 'convert_smilies' );
		add_filter( 'ww_content', 'convert_chars' );
		add_filter( 'ww_content', 'wpautop' );
		add_filter( 'ww_content', 'shortcode_unautop' );
		add_filter( 'ww_content', 'do_shortcode', 11);
	}

 	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$id = ($instance['ant-fhg-widget-id']) ? $instance['ant-fhg-widget-id'] : 0;

		$show_title = (isset($instance['show_title'])) ? $instance['show_title'] : 1;
		$post = get_post($id);

		echo $before_widget;

		if(!empty($id) && $post) {

			if($show_title) { 
				// first check $instance['title'] so titles are not changes for people upgrading from an older version of the plugin
				// titles WILL change when they re-save their widget.. 
				$title = (isset($instance['title'])) ? $instance['title'] : $post->post_title;
				$title = apply_filters( 'widget_title', $title );
			}

			$content = apply_filters('ww_content', $post->post_content, $id);

			?>
			
			<!-- Widget by WYSIWYG Widgets v<?php echo WYWI_VERSION_NUMBER ?> - http://wordpress.org/plugins/ant-fhg-widgets/ -->
			<?php if($show_title) { echo $before_title . $title . $after_title; } ?>
			<?php echo $content; ?>
			<!-- / WYSIWYG Widgets -->

			<?php

		} elseif(current_user_can('manage_options')) { ?>
				<p>
					<?php if(empty($id)) { 
						_e('Please select a Widget Block to show in this area.', 'ant-fhg-widgets');
					} else { 
						printf(__('No widget block found with ID %d, please select an existing Widget Block in the widget settings.', 'ant-fhg-widgets'), $id);
					} ?>
				</p>
		<?php 
		}

		echo $after_widget;
		
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
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['ant-fhg-widget-id'] = $new_instance['ant-fhg-widget-id'];
		$instance['show_title'] = (isset($new_instance['show_title']) && $new_instance['show_title'] == 1) ? 1 : 0;
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$posts = (array) get_posts(array(
			'post_type' => 'ant-fhg-widget',
			'numberposts' => -1
		));

		$show_title = (isset($instance['show_title'])) ? $instance['show_title'] : 1;
		$selected_widget_id = (isset($instance['ant-fhg-widget-id'])) ? $instance['ant-fhg-widget-id'] : 0;
		$title = ($selected_widget_id) ? get_the_title($selected_widget_id) : 'No widget block selected.';
		?>

		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="hidden" value="<?php echo esc_attr( $title ); ?>" />

		<p>	
			<label for="<?php echo $this->get_field_id( 'ant-fhg-widget-id' ); ?>"><?php _e( 'Widget Block to show:', 'ant-fhg-widgets' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('ant-fhg-widget-id'); ?>" name="<?php echo $this->get_field_name( 'ant-fhg-widget-id' ); ?>" required>
				<option value="0" disabled <?php selected($selected_widget_id, 0); ?>><?php if(empty($posts)) { _e('No widget blocks found', 'ant-fhg-widgets'); } else { _e('Select a widget block', 'ant-fhg-widgets'); } ?></option>
				<?php foreach($posts as $p) { ?>
					<option value="<?php echo $p->ID; ?>" <?php selected($selected_widget_id, $p->ID); ?>><?php echo $p->post_title; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label><input type="checkbox" id="<?php echo $this->get_field_id('show_title'); ?>" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked($show_title, 1); ?> /> <?php _e("Show title?", "ant-fhg-widgets"); ?></label>
		</p>

		<p class="help"><?php printf(__('Manage your widget blocks %shere%s', 'ant-fhg-widgets'), '<a href="'. admin_url('edit.php?post_type=ant-fhg-widget') .'">', '</a>'); ?></p>
		<?php
	}

}