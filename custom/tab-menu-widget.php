<?php
// Creating the widget 
class bs_tab_menu_widget extends WP_Widget {
	// The construct part  
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'bs_tab_menu_widget', 
			// Widget name will appear in UI
			__('Tab-menu', 'bs_tab_menu_widget_domain'), 
			// Widget description
			array( 'description' => __( 'Alternativ menu, som vises som bootstrap-tabs', 'bs_tab_menu_widget_domain' ), ) 
		);
	}
	
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		if (!empty($instance["menu"])) {
			$o_id = get_queried_object_id();
		?>
		<div class="nav flex-column nav-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<?php foreach (wp_get_nav_menu_items($instance["menu"]) as $line) {?>
			<a class="nav-link <?= ($o_id == $line->object_id ? "active" : "");?>" href="<?= $line->url; ?>"><?= $line->title; ?></a>
			<?php } ?>
		</div>
		<?php
		}

		// This is where you run the code and display the output
		echo $args['after_widget'];
	}
			  
	// Widget Backend 
	public function form( $instance ) {
		$title = (isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( '', 'bs_tab_menu_widget_domain' ));
		$menu_id = (isset( $instance[ 'menu' ] ) ? $instance[ 'menu' ] : __( 0, 'bs_tab_menu_widget_domain' ));
		// Widget admin form
		?>
		<p>
			<label for="<?= $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			<label for="<?= $this->get_field_id( 'menu' ); ?>"><?php _e( 'Menu:' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'menu' ); ?>" name="<?php echo $this->get_field_name( 'menu' ); ?>" >
				<option value=""><?php _e( "— Vælg —" ) ?></option>
				<?php foreach( get_terms('nav_menu') as $menu) { ?>
				<option value="<?= $menu->term_id; ?>" <?= ($menu_id == $menu->term_id ? "selected" : ""); ?>><?= $menu->name; ?></option>
				<?php } ?>
			</select>
		</p>
		<?php 
	}
		  
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['menu'] = ( ! empty( $new_instance['menu'] ) ) ? strip_tags( $new_instance['menu'] ) : '';
		return $instance;
	}
}
?>