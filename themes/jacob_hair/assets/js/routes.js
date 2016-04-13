;(function (window, $, App) {

    'use strict';

    App.Routes = {
        // Fired in all pages
        'init': function  () {
        	App.Nav.init()
        	App.Timely.init()

            $('#tilesMain').dragScroll();

            function onResize()
            {
                var colHeight = ($('.tile-column').first().width() * 2);
                var countColumns  = $('.tile-column').length;
                $('#tilesMain > .tiles-inner').css('width', (countColumns * (colHeight / 2) + 5) + 'px');
                $('.tile').css('width', (colHeight / 2) + 'px');
                $('#tilesMain').css('height', colHeight + 'px');
            }

            $(window).on('resize', onResize)
            onResize()



        }
        
    };

})(window, jQuery, App);