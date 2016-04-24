/**
 * Gulp configuration, so Gulpfile.js can focus on running task
 * instead of configuring stuff.
 */

var asset_path = "themes/jacob_hair/assets/";
var storm_path = "modules/system/assets/ui/";

var config = {
    // Path to assets
    asset_path: asset_path,

    /**
     * Source paths
     */
    less : {
        theme: [
            asset_path + "less/theme.less"
        ]
    },
    concat : {
        vendor : [
            asset_path + "vendor/modernizr-2.7.0.min.js",
            asset_path + "vendor/bootstrap/js/tooltip.js",
            asset_path + "vendor/bootstrap/js/*.js",

            // Storm UI
            // Need to re-think whether or not wise to directly reference these files
            storm_path + 'vendor/select2/js/select2.full.js',
            storm_path + 'vendor/modernizr/modernizr.js',
            storm_path + 'js/foundation.baseclass.js',
            storm_path + 'js/foundation.controlutils.js',
            storm_path + 'js/input.trigger.js',
            storm_path + 'js/input.hotkey.js',
            storm_path + 'js/loader.base.js',
            storm_path + 'js/checkbox.js',
            storm_path + 'js/select.js',
            storm_path + 'js/tooltip.js',

            asset_path + "vendor/*/js/*.js",
            asset_path + "js/true-packed.js"
        ]
    },
    uglify : {
        app : [
            asset_path + "vendor/bootstrap/js/tooltip.js",
            asset_path + "vendor/bootstrap/js/*.js",

            storm_path + 'vendor/modernizr/modernizr.js',
            storm_path + 'vendor/mousewheel/mousewheel.js',
            storm_path + 'js/foundation.baseclass.js',
            storm_path + 'js/foundation.controlutils.js',
            storm_path + 'js/flashmessage.js',
            storm_path + 'js/drag.scroll.js',
            storm_path + 'js/popup.js',
            asset_path + 'vendor/slick/js/*.js',

            asset_path + "js/ui/*.js",
            asset_path + "js/init.js",
            asset_path + "js/partials/_*.js",
            asset_path + "js/routes.js"
        ],
    },
    cssmin : {
        app : [
            asset_path + "vendor/*/css/*.css"
        ]
    },

    /**
     * Watch files
     */
    watch: {
        less : {
            theme: [
                asset_path + 'less/theme.less',
                asset_path + 'less/**/*.less',
                asset_path + 'vendor/*/less/**/*.less'
            ]
        },
        vendor_css : [
            asset_path + 'vendor/**/css/*.css'
        ],
        scripts : [
            asset_path + 'js/partials/*.js',
            asset_path + 'js/init.js',
            asset_path + 'js/routes.js'
        ],
        vendor_scripts : [
            asset_path + 'vendor/**/js/*.js'
        ],
    }

}; // ./ config

module.exports = exports = config;
