;(function (window, $, App) {

    'use strict';

    App.Routes = {
        // Fired in all pages
        'init': function  () {
        	App.Nav.init()
        	App.Timely.init()
        }
        
    };

})(window, jQuery, App);