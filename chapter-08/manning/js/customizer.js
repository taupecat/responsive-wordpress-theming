/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
  // Site title and description.
  wp.customize( 'blogname', function( value ) {
    value.bind( function( to ) {
      $( '.site-title a' ).text( to );
    } );
  } );
  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.site-description' ).text( to );
    } );
  } );
  // Header text color.
  wp.customize( 'header_textcolor', function( value ) {
    value.bind( function( to ) {
      if ( 'blank' === to ) {
        $( '.site-title, .site-description' ).css( {
          'clip': 'rect(1px, 1px, 1px, 1px)',
          'position': 'absolute'
        } );
      } else {
        $( '.site-title, .site-description' ).css( {
          'clip': 'auto',
          'color': to,
          'position': 'relative'
        } );
      }
    } );
  } );
// Sidebar background color.
wp.customize( 'sidebar_bg_color', function( value ) {
  value.bind( function( to ) {
    $( '.sidebar-primary, .sidebar-secondary' ).css( {
      'background-color': to,
    } );
  } );
} );
// Primary nav menu background color.
wp.customize( 'menu_bg_color', function( value ) {
  value.bind( function( to ) {

    // Convert the provided color to something a little darker
    // for our menu bar's slight gradient effect.
    var Color = net.brehaut.Color( to ),
      darker = Color.darkenByRatio( 0.4 ).toString();

    // Update the navbar to our gradient
    $( '.navbar' ).css( 'background-color', to ).
      css( 'background-image', '-webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, ' + to + '), color-stop(100%, ' + darker + '))' ).
      css( 'background-image', '-webkit-linear-gradient(top, ' + to + ' 0%, ' + darker + ' 100%)' ).
      css( 'background-image', '-moz-linear-gradient(top, ' + to + ' 0%, ' + darker + ' 100%)' ).
      css( 'background-image', '-o-linear-gradient(top, ' + to + ' 0%, ' + darker + ' 100%)' ).
      css( 'background-image', 'linear-gradient(top, ' + to + ' 0%, ' + darker + ' 100%)' );

    // Update the ULs in the primary navigation to the darker variant of
    // the selected color
    $( '.navbar .primary-navigation ul' ).css( {
      'background-color': darker
    });
  } );
} );
} )( jQuery );
