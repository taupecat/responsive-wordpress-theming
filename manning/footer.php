<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Manning
 */
?>

	</div><!-- #content -->

<?php
/**
 * Only display footer if there is something to display.
 */

if ( is_active_sidebar( 'footer-widget-area' ) ||
		 is_active_sidebar( 'footer-widget-area-2' ) ||
		 is_active_sidebar( 'footer-widget-area-3' ) ||
		 is_active_sidebar( 'footer-widget-area-4' ) ):
?>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="site-info">

			<?php for ( $i = 1; $i < 5; $i++ ): ?>

				<!-- Begin Footer Widget Area <?php echo $i; ?> -->

				<section id="footer-widget-area-<?php echo $i; ?>" class="footer-widget-area footer-widget-area-<?php echo $i; ?>">
					<?php dynamic_sidebar( 'footer-widget-area-' . $i ); ?>
				</section>

				<!-- End Footer Widget Area <?php echo $i; ?> -->

			<?php endfor; ?>

		</div>
		<!-- // .site-info -->

	</footer>
	<!-- #colophon -->

<?php
/**
 * End our testing for an active footer widget area.
 */
endif;
?>

</div>
<!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
