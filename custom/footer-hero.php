<?php

/**
 * Footer - hero setup
 *
 * @package UnderStrap Child
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');
?>

<?php if (is_active_sidebar('footer-hero')) : ?>

	<div class="wrapper" id="wrapper-footer-hero">
		<div class="<?php echo esc_attr($container); ?>">
			<div id="carouselFooterHero" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<?php dynamic_sidebar('footer-hero'); ?>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		jQuery(function() {
			var carousel = jQuery("#carouselFooterHero .carousel-inner");
			var h = 0;
			carousel.find(".widget").each(function(i, e) {
				carousel.append("<div class='carousel-item" + (i == 0 ? " active" : "") + "'>" + e.outerHTML + "</div>");
				if (jQuery(e).height() > h) {
					h = jQuery(e).height()+16;
					carousel.height(h);
				}
				e.remove();
			});
		});
	</script>
<?php endif; ?>