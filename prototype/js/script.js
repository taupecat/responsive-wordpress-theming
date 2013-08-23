/**
 * script.js
 * 
 * Supplemental JavaScript to control certain responsive aspects
 * of our WordPress theme.
 */

/*jslint browser: true*/

(function () {

  "use strict";

  /**
   * Properties
   */

  var

  // Cache our global jQuery selectors
  $primaryNavContainer = $("#primary-navigation-container"),

  /**
   * Methods
   */

  /**
   * Control the appearance of the menu
   * Basically, remove 'style="display: none;"' from the inline
   * element once the window width reaches a certain threshhold.
   */
  
  fixNavDisplay = function () {

    // At widths >= 600px, make sure our menu container is visible
    if (window.matchMedia("(min-width: 600px)").matches) {
      if ($primaryNavContainer.is(":hidden")) {
        $primaryNavContainer.show();
      }

    // At widths < 600px, make sure our menu container is hidden
    } else {
      if ($primaryNavContainer.is(":visible")) {
        $primaryNavContainer.hide();
      }
    }
  },
  

  /**
   * Toggle the menu open and closed in narrow view
   */
  togglePrimaryNav = function () {

    var $togglePrimaryNav = $("#toggle-primary-nav");

    // On click, toggle the view of the primary navigation
    $togglePrimaryNav.on("click", function (event) {

      // Disable link's default functionality
      event.preventDefault();

      // Toggle the primary navigation container open and closed via slide
      $primaryNavContainer.slideToggle(function () {
        $togglePrimaryNav.toggleClass('open');
      });

    });

  },

  init = function () {
    togglePrimaryNav();
  };

  init();

  $(window).resize(function () {
    fixNavDisplay();
  });

}(jQuery));
