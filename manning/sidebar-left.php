<?php
/**
 * The Sidebar containing the primary and secondary widget areas in their
 * default place in the DOM structure.
 *
 * @package Manning
 */
?>
  <!-- Begin Left Sidebar -->

  <div id="sidebar-left" class="sidebar-left">

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



    <?php if ( is_home() || is_front_page() ): ?>

    <!-- Begin Secondary Sidebar -->

    <div id="sidebar-secondary" class="widget-area sidebar sidebar-secondary" role="complementary">
      <?php do_action( 'before_sidebar' ); ?>

      <?php dynamic_sidebar( 'sidebar-secondary' ); ?>

    </div>
    <!-- #sidebar-secondary -->

    <!-- End Secondary Sidebar -->

    <?php endif; ?>



  </div>
  <!-- #sidebar-left -->

  <!-- End Left Sidebar -->
