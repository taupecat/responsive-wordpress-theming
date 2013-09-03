<?php
/**
 * Any empty container to put our secondary (home page only)
 * sidebar in the wide view (via JavaScript DOM manipulation).
 *
 * @package Manning
 */
?>
<!-- Begin Right Sidebar -->

<div id="sidebar-right" class="sidebar-right">

  <!-- TEMPORARY -->

  <!-- Begin Secondary Sidebar -->

  <div id="sidebar-secondary" class="widget-area sidebar sidebar-secondary" role="complementary">

    <?php do_action( 'before_sidebar' ); ?>

    <?php dynamic_sidebar( 'sidebar-secondary' ); ?>

  </div>
  <!-- #sidebar-secondary -->

  <!-- End Secondary Sidebar -->

</div>
<!-- // #sidebar-right -->

<!-- End Right Sidebar -->
