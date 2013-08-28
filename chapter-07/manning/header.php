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

      <img src="http://placehold.it/123x123&amp;text=[logo]" class="logo" width="123" height="123">

      <div class="site-branding">
        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
        <div class="site-description"><?php bloginfo( 'description' ); ?></div>
      </div>
      <!-- // .site-branding -->

    </a>
    <!-- // [rel="home"] -->

    <!-- Begin Navigation/Search Bar -->

    <div class="navbar">

      <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'manning' ); ?>"><?php _e( 'Skip to content', 'manning' ); ?></a></div>

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

      <!-- Begin Search Form -->

      <a href="#!" class="toggle-search">Search</a>

      <form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">

        <label>
          <span class="screen-reader-text"><?php _e( 'Search for:', 'manning' ); ?></span>
          <input type="search" placeholder="<?php esc_attr_e( 'Search &hellip;', 'manning' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'manning' ); ?>" />
        </label>

        <input type="submit" class="searchsubmit" value="<?php esc_attr_e( 'Search', 'manning' ); ?>" />

      </form>

      <!-- End Search Form -->

    </div>
    <!-- // .navbar -->

    <!-- End Navigation/Search Bar -->

  </header>
  <!-- #masthead -->

  <!-- End Site Header -->

  <div id="content" class="site-content">
