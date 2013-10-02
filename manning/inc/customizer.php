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
		'title' 	=> __( 'Logo', 'manning' ),
		'priority' 	=> 20,
	) );

	$wp_customize->add_setting( 'logo', array(
		'default'		=> '',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize, 'logo_Image',
		array(
			'label'			=> __( 'Image', 'manning' ),
			'section'		=> 'logo',
			'settings'		=> 'logo',
		)
	) );


	/**
	 * Add the ability to customize link, sidebar and primary navigation menu
	 * colors.  Add these into the existing theme customizer "colors" section.
	 */
	
	$wp_customize->add_setting( 'sidebar_bg_color', array(
		'default' 		=> '#E9E2DD',
		'transport'		=> 'postMessage',
		'capability'	=> 'edit_theme_options',
		'type'			=> 'theme_mod'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control (
		$wp_customize,
		'sidebar_bg_color',
		array(
			'label'		=> __( 'Sidebar Background Color', 'manning' ),
			'section'	=> 'colors',
			'settings'	=> 'sidebar_bg_color',
		)
	) );

	$wp_customize->add_setting( 'menu_bg_color', array(
		'default' 		=> '#951C1C',
		'transport'		=> 'postMessage',
		'capability'	=> 'edit_theme_options',
		'type'			=> 'theme_mod'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control (
		$wp_customize,
		'menu_bg_color',
		array(
			'label'		=> __( 'Menu Background Color', 'manning' ),
			'section'	=> 'colors',
			'settings'	=> 'menu_bg_color',
		)
	) );
}
add_action( 'customize_register', 'manning_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function manning_customize_preview_js() {
	wp_enqueue_script( 'manning_colorjs', get_template_directory_uri() . '/js/color.js', false, '20130508', true );
	wp_enqueue_script( 'manning_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview', 'manning_colorjs' ), '20130508', true );
}
add_action( 'customize_preview_init', 'manning_customize_preview_js' );
