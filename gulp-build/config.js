/**
 * Gulp configuration, so Gulpfile.js can focus on running task
 * instead of configuring stuff.
 */

var asset_path = "themes/jacob_hair/assets/";

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
            asset_path + "vendor/*/js/*.js",
            asset_path + "js/true-packed.js"
        ]
    },
    uglify : {
        app : [
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
            asset_path + 'js/init.js'
        ],
        vendor_scripts : [
            asset_path + 'vendor/**/js/*.js'
        ],
    }

}; // ./ config

module.exports = exports = config;