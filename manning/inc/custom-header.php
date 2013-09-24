<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package Manning
 */

/**
 * Create custom image sizes for headers at smaller breakpoints
 */
add_image_size('header-medium', 900, 255, true);
add_image_size('header-narrow', 600, 255, true);


/**
 * manning_custom_header_setup()
 * 
 * Enable theme custom header support.  Define the parameters of 
 * our custom header, the default image for the header, and our
 * callbacks for further custom header functionality
 */
function manning_custom_header_setup() {
  add_theme_support( 'custom-header', apply_filters( 'manning_custom_header_args', array(
    'default-image'          => '%s/images/sunset-wide.jpg',
    'default-text-color'     => 'FFFFFF',
    'width'                  => 1160,
    'height'                 => 255,
    'flex-width'             => true,
    'flex-height'            => true,
    'wp-head-callback'       => 'manning_header_style',
    'admin-head-callback'    => 'manning_admin_header_style',
    'admin-preview-callback' => 'manning_admin_header_image',
  ) ) );


  /*
   * Default custom headers packaged with the theme.
   * %s is a placeholder for the theme template directory URI.
   *
   * Since these headers are not in the media library, the various
   * different size versions (large, medium, small and thumb)
   * need to be prepared and placed in the images/headers directory
   * manually.
   */
  register_default_headers( array(
    'sunset' => array(
      'url'           => '%s/images/sunset-wide.jpg',
      'thumbnail_url' => '%s/images/sunset-thumb.jpg',
      'description'   => _x( 'Sunset', 'manning' )
    ),
    'rocks' => array(
      'url'           => '%s/images/rocks-wide.jpg',
      'thumbnail_url' => '%s/images/rocks-thumb.jpg',
      'description'   => _x( 'Rocks', 'manning' )
    ),
    'placekitten' => array(
      'url'           => '%s/images/cat-wide.jpg',
      'thumbnail_url' => '%s/images/cat-thumb.jpg',
      'description'   => _x( 'Adorable Placekitten', 'manning' )
    ),
  ) );
}
add_action( 'after_setup_theme', 'manning_custom_header_setup' );

if ( ! function_exists( 'manning_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see manning_custom_header_setup().
 */
function manning_header_style() {
  $header_image      = get_custom_header();
  $header_text_color = get_header_textcolor();

  /**
   * If we don't have a header and if no custom options for text
   * are set, let's bail.
   */
  if ( empty( $header_image ) && ( HEADER_TEXTCOLOR == $header_text_color ) )
    return;


  /**
   * Look first if the custom header image was uploaded
   * by checking for the attachment ID.  If so, work with
   * that one to get the proper header sizes (as defined
   * above).
   */
  if ( isset( $header_image->attachment_id ) ) {

    // Large
    $header_image_wide = esc_url( $header_image->url );

    // Medium
    $header_image_medium_src = wp_get_attachment_image_src( intval( $header_image->attachment_id ), 'header-medium' );
    if ( isset( $header_image_medium_src[0] ) ) {
      $header_image_medium = esc_url( $header_image_medium_src[0] );
    } else {
      $header_image_medium = $header_image_wide;
    }

    // Small
    $header_image_narrow_src = wp_get_attachment_image_src( intval( $header_image->attachment_id ), 'header-narrow' );
    if ( isset( $header_image_narrow_src[0] ) ) {
      $header_image_narrwo = esc_url( $header_image_narrow_src[0] );
    } else {
      $header_image_narrow = $header_image_wide;
    }

  } else {

    /**
     * One of the default choices was selected.
     */
  
    // Large
    $header_image_wide = esc_url( $header_image->url );

    // Medium
    $header_image_medium = esc_url( str_replace( '-wide', '-medium', $header_image->url ) );

    // Small
    $header_image_narrow = esc_url( str_replace( '-wide', '-narrow', $header_image->url ) );
  }

  /**
   * If we get this far, we have custom styles. Let's do this.
   *
   * The only CSS we need to define for our header area is the image
   * itself; everything else is handled by the Sass in our project.
   */
  ?>
  <style type="text/css">
  header[role="banner"] a[rel="home"] {
    background-image: url(<?php echo $header_image_narrow; ?>);
  }

  @media only all and (min-width: 40em) {
    header[role="banner"] a[rel="home"] {
      background-image: url(<?php echo $header_image_medium; ?>);
    }
  }

  @media only all and (min-width: 64em) {
    header[role="banner"] a[rel="home"] {
      background-image: url(<?php echo $header_image_wide; ?>);
    }
  }
  <?php
    // Has the text been hidden?
    if ( 'blank' == $header_text_color ) :
  ?>
    .site-title,
    .site-description {
      position: absolute;
      clip: rect(1px, 1px, 1px, 1px);
    }
  <?php
    // If the user has set a custom color for the text use that
    else :
  ?>
    .site-title,
    .site-description {
      color: #<?php echo $header_text_color; ?>;
    }
  <?php endif; ?>
  </style>
  <?php
}
endif; // manning_header_style

if ( ! function_exists( 'manning_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see manning_custom_header_setup().
 */
function manning_admin_header_style() {
?>
  <style type="text/css">
    .appearance_page_custom-header #headimg {
      border: none;
    }
    #headimg {
      background: url(<?php esc_url( header_image() ); ?>) no-repeat center top;
      font-family: "Open Sans", sans-serif;
      height: 255px;
      padding: 4em 0;
    }
    #headimg .displaying-header-text {
      font-weight: 400;
      padding: 0 5%;
      text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.75);
    }
    #headimg h1 {
      font-size: 42px;
    }
    #headimg div {
      font-size: 24px;
    }
  </style>
<?php
}
endif; // manning_admin_header_style

if ( ! function_exists( 'manning_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see manning_custom_header_setup().
 */
function manning_admin_header_image() {
  $style        = sprintf( ' style="color: #%s;"', get_header_textcolor() );
  $header_image = get_header_image();
?>
  <div id="headimg">
    <h1 class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'name' ); ?></h1>
    <div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
  </div>
<?php
}
endif; // manning_admin_header_image


/**
 * Load Open Sans from Google Fonts.
 */
function manning_custom_header_font() {
  wp_enqueue_style( 'manning-fonts', esc_url_raw('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700') );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'manning_custom_header_font' );
