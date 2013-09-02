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

</div>
<!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
