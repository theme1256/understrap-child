<?php
/**
 * Sidebar - hero setup
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function count_sidebar_widgets( $sidebar_id ) {
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return __( 'Invalid sidebar ID' );
    return count( $the_sidebars[$sidebar_id] );
}
?>

<?php if ( is_active_sidebar( 'hero' ) ) : ?>

	<!-- ******************* The Hero Widget Area ******************* -->

	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

		<div class="carousel-inner" role="listbox">

			<?php dynamic_sidebar( 'hero' ); ?>

		</div>
		
		<?php if (intval(count_sidebar_widgets( 'hero' )) == 1): ?>
		<?php else: ?>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">

			<span class="carousel-control-prev-icon" aria-hidden="true"></span>

			<span class="sr-only"><?php esc_html_e( 'Previous', 'understrap' ); ?></span>

		</a>

		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">

			<span class="carousel-control-next-icon" aria-hidden="true"></span>

			<span class="sr-only"><?php esc_html_e( 'Next', 'understrap' ); ?></span>

		</a>
		<?php endif; ?>
	</div><!-- .carousel -->

<?php endif; ?>