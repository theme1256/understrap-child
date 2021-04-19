<?php
// Creating the widget 
class big_footer_menu_widget extends WP_Widget {
	private $menu_count = 4;

	// The construct part  
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'big_footer_menu_widget', 
			// Widget name will appear in UI
			__('Footer-menu', 'big_footer_menu_widget_domain'), 
			// Widget description
			array( 'description' => __( 'Alternativ menu, bruges i footeren', 'big_footer_menu_widget_domain' ), ) 
		);
	}
	
	public function widget( $args, $instance ) {
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		echo "<div class='row'>";
		for ($i = 0; $i < $this->menu_count; $i++) {
			echo "<div class='col-6 col-md-3'>";
			$title = apply_filters( 'widget_title', $instance['title' . $i] );
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];

			if (!empty($instance["menu" . $i])) {
			?>
			<ul class="list-unstyled">
				<?php foreach (wp_get_nav_menu_items($instance["menu" . $i]) as $line) {?>
				<li><a class="nav-link" href="<?= $line->url; ?>"><?= $line->title; ?></a></li>
				<?php } ?>
			</ul>
			<?php
			}
			echo "</div>";
		}

		// This is where you run the code and display the output
		echo "</div>";
		echo $args['after_widget'];
	}
			  
	// Widget Backend 
	public function form( $instance ) {
		$menus = get_terms('nav_menu');

		// Widget admin form
		for ($i = 0; $i < $this->menu_count; $i++) {
			$title = (isset( $instance[ 'title' . $i ] ) ? $instance[ 'title' . $i ] : __( '', 'big_footer_menu_widget_domain' ));
			$menu_id = (isset( $instance[ 'menu' . $i ] ) ? $instance[ 'menu' . $i ] : __( 0, 'big_footer_menu_widget_domain' ));
			?>
			<p>
				<label for="<?= $this->get_field_id( 'title' . $i ); ?>"><?php _e( 'Title ' . ($i+1) . ':' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' . $i ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				<label for="<?= $this->get_field_id( 'menu' . $i ); ?>"><?php _e( 'Menu ' . ($i+1) . ':' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'menu' ); ?>" name="<?php echo $this->get_field_name( 'menu' . $i ); ?>" >
					<option value=""><?php _e( "— Vælg —" ) ?></option>
					<?php foreach( $menus as $menu) { ?>
					<option value="<?= $menu->term_id; ?>" <?= ($menu_id == $menu->term_id ? "selected" : ""); ?>><?= $menu->name; ?></option>
					<?php } ?>
				</select>
			</p>
			<?php
		}
	}
		  
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		for ($i = 0; $i < $this->menu_count; $i++) {
			$instance['title' . $i] = ( ! empty( $new_instance['title' . $i] ) ) ? strip_tags( $new_instance['title' . $i] ) : '';
			$instance['menu' . $i] = ( ! empty( $new_instance['menu' . $i] ) ) ? strip_tags( $new_instance['menu' . $i] ) : '';
		}
		return $instance;
	}
}
?>