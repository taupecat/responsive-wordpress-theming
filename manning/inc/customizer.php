<?php
/**
 * manning Theme Customizer
 *
 * @package Manning
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function manning_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


  /**
   * Add the ability to upload a custom logo into the header.
   */

  $wp_customize->add_section( 'logo', array(
    'title'     => __( 'Logo', 'manning' ),
    'priority'  => 70,
  ) );

  $wp_customize->add_setting( 'logo', array(
    'default'     => '',      // The default is no logo at all.
    'type'        => 'option',
    'capability'  => 'edit_theme_options'
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'logo_image',
    array(
      'label'     => __( 'Image', 'manning' ),
      'section'   => 'logo',
      'settings'  => 'logo',
    )
  ) );


  /**
   * Add the ability to customize sidebar and primary navigation menu
   * colors.  Add these into the existing theme customizer "colors" section.
   */
  
  $wp_customize->add_setting( 'sidebar_bg_color', array(
    'default'     => '#E9E2DD',
    'transport'   => 'postMessage',
    'capability'  => 'edit_theme_options',
    'type'      => 'theme_mod'
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control (
    $wp_customize,
    'sidebar_bg_color',
    array(
      'label'   => __( 'Sidebar Background Color', 'manning' ),
      'section' => 'colors',
      'settings'  => 'sidebar_bg_color',
    )
  ) );

  $wp_customize->add_setting( 'menu_bg_color', array(
    'default'     => '#951C1C',
    'transport'   => 'postMessage',
    'capability'  => 'edit_theme_options',
    'type'      => 'theme_mod'
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control (
    $wp_customize,
    'menu_bg_color',
    array(
      'label'   => __( 'Menu Background Color', 'manning' ),
      'section' => 'colors',
      'settings'  => 'menu_bg_color',
    )
  ) );
}
add_action( 'customize_register', 'manning_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function manning_customize_preview_js() {
  wp_enqueue_script( 'manning_colorjs', get_template_directory_uri() . '/js/color-js-master/color.js', false, '20131007', true );
  wp_enqueue_script( 'manning_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'manning_colorjs' ), '20130508', true );
}
add_action( 'customize_preview_init', 'manning_customize_preview_js' );


/**
 * Write out our color choices as a <style> block in the page head
 * via the wp_head() action hook.
 */
function manning_customize_style_output() {
  $manning_customize_style = '<style>';

  $sidebar_bg_color = get_theme_mod( 'sidebar_bg_color', false );

  // Sidebar background color
  if ( $sidebar_bg_color )
    $manning_customize_style .= '.sidebar-primary, .sidebar-secondary { background-color: ' . $sidebar_bg_color . '; }';

  // Primary navigation background color
  // Break the hex out into HSL, darken by the same 0.4 ratio we used in the customizer JavaScript,
  // and use that color for the gradient shading and drop down backgrounds.  For that, we're going
  // to use the Manning_Color object I've put in inc/color.php.
  require_once get_template_directory() . '/inc/color.php';

  $menu_bg_color = get_theme_mod( 'menu_bg_color', false );
  if ( $menu_bg_color ) {
    $menu_bg_color_obj = new Manning_Color( $menu_bg_color );
    $menu_bg_color_obj->darkenByRatio(0.4);

    $manning_customize_style .= '.navbar { background-color: ' . $menu_bg_color . ';';
    $manning_customize_style .= 'background-image: -webkit-gradient( linear, 50% 0%, 50% 100%, color-stop( 0%, ' . $menu_bg_color . '), color-stop(100%, ' . $menu_bg_color_obj->colorHex . '));';
    $manning_customize_style .= 'background-image: -webkit-linear-gradient(top, ' . $menu_bg_color . ' 0%, ' . $menu_bg_color_obj->colorHex . ' 100%)';
    $manning_customize_style .= 'background-image: -moz-linear-gradient(top, ' . $menu_bg_color . ' 0%, ' . $menu_bg_color_obj->colorHex . ' 100%)';
    $manning_customize_style .= 'background-image: -o-linear-gradient(top, ' . $menu_bg_color . ' 0%, ' . $menu_bg_color_obj->colorHex . ' 100%)';
    $manning_customize_style .= 'background-image: linear-gradient(top, ' . $menu_bg_color . ' 0%, ' . $menu_bg_color_obj->colorHex . ' 100%) }';

    $manning_customize_style .= '.navbar .primary-navigation ul { background-color: ' . $menu_bg_color_obj->colorHex . ' }';
  }


  $manning_customize_style .= '</style>';

  echo $manning_customize_style;
}
add_action( 'wp_head', 'manning_customize_style_output' );
