<?php
/**
 * Footer - hero setup
 *
 * @package UnderStrap Child
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_active_sidebar( 'footer-hero' )  ) : ?>

<div class="wrapper" id="wrapper-footer-hero">
	<div class="<?php echo esc_attr( $container ); ?>">
		<?php dynamic_sidebar( 'footer-hero' ); ?>
	</div>
</div>
 
<?php endif; ?>