<?php
// Creating the widget 
class hero_slide_widget extends WP_Widget {
	private $menu_count = 4;

	// The construct part  
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'hero_slide_widget', 
			// Widget name will appear in UI
			__('Hero slide', 'hero_slide_widget_domain'), 
			// Widget description
			array( 'description' => __( 'Et billede + tekster til en karusel', 'hero_slide_widget_domain' ), ) 
		);
	}
	
	public function widget( $args, $instance ) {
		$title = (isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( '', 'hero_slide_widget_domain' ));
		$subtitle = (isset( $instance[ 'subtitle' ] ) ? $instance[ 'subtitle' ] : __( '', 'hero_slide_widget_domain' ));
		$button = (isset( $instance[ 'button' ] ) ? $instance[ 'button' ] : __( '', 'hero_slide_widget_domain' ));
		$link = (isset( $instance[ 'link' ] ) ? $instance[ 'link' ] : __( '', 'hero_slide_widget_domain' ));
		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		?>
		<div class="slide" style="background-image: url(<?= $image; ?>);"></div>
		<div class="hero">
			<hgroup>
				<h1><?= $title; ?></h1>
				<h3><?= $subtitle; ?></h3>
			</hgroup>
			<a class="btn btn-hero" href="<?= $link; ?>"><?= $button; ?></a>
		</div>
		<?php
		// This is where you run the code and display the output
		echo $args['after_widget'];
	}
			  
	// Widget Backend 
	public function form( $instance ) {
		// Widget admin form
		$title = (isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( '', 'hero_slide_widget_domain' ));
		$subtitle = (isset( $instance[ 'subtitle' ] ) ? $instance[ 'subtitle' ] : __( '', 'hero_slide_widget_domain' ));
		$button = (isset( $instance[ 'button' ] ) ? $instance[ 'button' ] : __( '', 'hero_slide_widget_domain' ));
		$link = (isset( $instance[ 'link' ] ) ? $instance[ 'link' ] : __( '', 'hero_slide_widget_domain' ));
		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		?>
		<p>
			<label for="<?= $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			<label for="<?= $this->get_field_id( 'subtitle' ); ?>"><?php _e( 'Subtitle:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'subtitle' ); ?>" name="<?php echo $this->get_field_name( 'subtitle' ); ?>" type="text" value="<?php echo esc_attr( $subtitle ); ?>" />
			<label for="<?= $this->get_field_id( 'button' ); ?>"><?php _e( 'Button-text:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" type="text" value="<?php echo esc_attr( $button ); ?>" />
			<label for="<?= $this->get_field_id( 'link' ); ?>"><?php _e( 'Button-url:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image-url:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
		</p>
		<?php
	}
		  
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['subtitle'] = ( ! empty( $new_instance['subtitle'] ) ) ? strip_tags( $new_instance['subtitle'] ) : '';
		$instance['button'] = ( ! empty( $new_instance['button'] ) ) ? strip_tags( $new_instance['button'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? $new_instance['link'] : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
		return $instance;
	}
}
?>