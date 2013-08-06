(function ($) {

    var $window = $(window),
        $mainColumn = $('#main-column'),
        $rightColumn = $('#right-column'),
        $totalColumnWidth = $('#total-page-width'),
        $mainColumnWidth = $('#main-column-width'),
        $rightColumnWidth = $('#right-column-width'),
        widths = {},
        
    getWidths = function() {
        widths.window = $window.outerWidth();
        widths.main = $mainColumn.outerWidth();
        widths.right = $rightColumn.outerWidth();
    },
    
    printWidths = function() {
        $totalColumnWidth.text( widths.window );
        $mainColumnWidth.text( widths.main );
        $rightColumnWidth.text( widths.right );
    },
    
    init = function() {
        getWidths();
        printWidths();
    };
    
    init();
    
    $window.resize(function() {
        init();
    });

}(jQuery));
