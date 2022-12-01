<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'custom/footer', 'hero' ); ?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info row">

						<div class="col-6">
							Copyright &copy; <?= \date("Y"); ?>
						</div>
						<div class="col-6 text-right">
							<a href="<?= get_privacy_policy_url(); ?>"><?php _e("Privatlivspolitik"); ?></a>
						</div>

					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

<script type="text/javascript">
jQuery(function() {
	jQuery("#main .type-page .entry-header").remove();
});
</script>

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>