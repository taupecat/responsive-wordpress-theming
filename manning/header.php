<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Manning
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

  <?php do_action( 'before' ); ?>

  <!-- Begin Site Header -->

  <header id="masthead" class="site-header" role="banner">

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

      <?php if ( get_option( 'site_logo' ) ): ?>
      <img src="<?php echo get_option( 'site_logo' ); ?>" alt="Logo" class="logo">
      <?php endif; ?>

      <div class="site-branding">
        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
        <div class="site-description"><?php bloginfo( 'description' ); ?></div>
      </div>
      <!-- // .site-branding -->

    </a>
    <!-- // [rel="home"] -->

    <!-- Begin Navigation -->

    <div class="navbar">

      <a href="#content" class="screen-reader-text skip-link"><?php _e( 'Skip to content', 'manning' ); ?></a>

      <nav id="site-navigation" class="primary-navigation" role="navigation">

        <a href="#!" id="toggle-primary-nav" class="menu-toggle"><?php _e( 'Menu', 'manning' ); ?></a>

        <?php wp_nav_menu( array( 
          'theme_location'  => 'primary',
          'container_class' => 'primary-navigation-container menu',
          'container_id'    => 'primary-navigation-container',
        ) ); ?>

      </nav>
      <!-- #site-navigation -->

      <!-- End Primary Navigation -->

    </div>
    <!-- // .navbar -->

    <!-- End Navigation -->

  </header>
  <!-- #masthead -->

  <!-- End Site Header -->

  <div id="content" class="site-content">
