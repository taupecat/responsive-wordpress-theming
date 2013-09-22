<?php
/**
 * The Sidebar containing the primary and secondary widget areas in their
 * default place in the DOM structure.
 *
 * @package Manning
 */

/**
 * Check to see if the secondary sidebar is active
 * (that is, has any active widgets) AND we're on the
 * home page.  If both of those conditions are true,
 * set a class on our left sidebar (and also on in our
 * main content area) to change the proportions to what
 * they would be on sub pages (which never have a right
 * sidebar) in the wide view.
 */

if ( ( is_front_page() || is_home() ) && ! is_active_sidebar( 'sidebar-secondary' ) ) {
  $left_sidebar_class = 'sidebar-left no-secondary-sidebar';
} else {
  $left_sidebar_class = 'sidebar-left';
}
?>

<!-- Begin Left Sidebar -->

<div id="sidebar-left" class="<?php echo $left_sidebar_class; ?>">

  <!-- Begin Primary Sidebar -->

  <div id="sidebar-primary" class="widget-area sidebar sidebar-primary" role="complementary">
    <?php do_action( 'before_sidebar' ); ?>
    <?php if ( ! dynamic_sidebar( 'sidebar-primary' ) ) : ?>

    <aside id="search" class="widget widget_search">
      <?php get_search_form(); ?>
    </aside>

    <aside id="archives" class="widget">
      <h1 class="widget-title"><?php _e( 'Archives', 'manning' ); ?></h1>
      <ul>
        <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
      </ul>
    </aside>

    <aside id="meta" class="widget">
      <h1 class="widget-title"><?php _e( 'Meta', 'manning' ); ?></h1>
      <ul>
        <?php wp_register(); ?>
        <li><?php wp_loginout(); ?></li>
        <?php wp_meta(); ?>
      </ul>
    </aside>

    <?php endif; // end sidebar widget area ?>
  </div>
  <!-- // #sidebar-primary -->

  <!-- End Primary Sidebar -->


<?php
/**
 * Only display the secondary sidebar if it contains widgets to display.
 */

if ( ( is_home() || is_front_page() ) && is_active_sidebar( 'sidebar-secondary' ) ):
?>

  <!-- Begin Secondary Sidebar -->

  <div id="sidebar-secondary" class="widget-area sidebar sidebar-secondary" role="complementary">

    <?php do_action( 'before_sidebar' ); ?>

    <?php dynamic_sidebar( 'sidebar-secondary' ); ?>

  </div>
  <!-- #sidebar-secondary -->

  <!-- End Secondary Sidebar -->

  <?php endif; // display secondary sidebar? ?>

</div>
<!-- #sidebar-left -->

<!-- End Left Sidebar -->
