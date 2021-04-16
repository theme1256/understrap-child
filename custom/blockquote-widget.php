<?php
// Creating the widget 
class blockquote_widget extends WP_Widget {
	private $menu_count = 4;

	// The construct part  
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'blockquote_widget', 
			// Widget name will appear in UI
			__('Blockquote', 'blockquote_widget_domain'), 
			// Widget description
			array( 'description' => __( 'Et stort citat', 'blockquote_widget_domain' ), ) 
		);
	}
	
	public function widget( $args, $instance ) {
		$title = (isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Hvad siger kunderne', 'blockquote_widget_domain' ));
		$quote = (isset( $instance[ 'quote' ] ) ? $instance[ 'quote' ] : __( '', 'hero_slide_widget_domain' ));
		$by = (isset( $instance[ 'by' ] ) ? $instance[ 'by' ] : __( '', 'hero_slide_widget_domain' ));

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		?>
		<h2 class="has-text-align-center"><?= $title; ?></h2>
		<blockquote class="blockquote text-center">
			<p>“<?= $quote; ?>”</p>
			<footer class="blockquote-footer"><cite title="<?= $by; ?>"><?= $by; ?></cite></footer>
		</blockquote>
		<?php
		// This is where you run the code and display the output
		echo $args['after_widget'];
	}
			  
	// Widget Backend 
	public function form( $instance ) {
		// Widget admin form
		$title = (isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Hvad siger kunderne', 'blockquote_widget_domain' ));
		$quote = (isset( $instance[ 'quote' ] ) ? $instance[ 'quote' ] : __( '', 'hero_slide_widget_domain' ));
		$by = (isset( $instance[ 'by' ] ) ? $instance[ 'by' ] : __( '', 'hero_slide_widget_domain' ));
		?>
		<p>
			<label for="<?= $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			<label for="<?= $this->get_field_id( 'quote' ); ?>"><?php _e( 'Citat:' ); ?></label> 
			<textarea class="widefat" rows="16" id="<?php echo $this->get_field_id('quote'); ?>" name="<?php echo $this->get_field_name('quote'); ?>"><?php echo $quote; ?></textarea>
			<label for="<?= $this->get_field_id( 'by' ); ?>"><?php _e( 'Citat af:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'by' ); ?>" name="<?php echo $this->get_field_name( 'by' ); ?>" type="text" value="<?php echo esc_attr( $by ); ?>" />
		</p>
		<?php
	}
		  
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['quote'] = ( ! empty( $new_instance['quote'] ) ) ? strip_tags( $new_instance['quote'] ) : '';
		$instance['by'] = ( ! empty( $new_instance['by'] ) ) ? strip_tags( $new_instance['by'] ) : '';
		return $instance;
	}
}
?>