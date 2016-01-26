var gulp          = require('gulp'),
    plumber       = require('gulp-plumber'),
    less          = require('gulp-less'),
    autoprefixer  = require('gulp-autoprefixer'),
    minifycss     = require('gulp-minify-css'),
    jshint        = require('gulp-jshint'),
    uglify        = require('gulp-uglify'),
    rename        = require('gulp-rename'),
    concat        = require('gulp-concat'),
    notify        = require('gulp-notify'),
    livereload    = require('gulp-livereload'),
    sourcemaps    = require('gulp-sourcemaps'),
    del           = require('del'),
    config        = require('./gulp-build/config.js'),
    lib           = require('./gulp-build/lib.js');

/**
 * LESS compiler
 */
gulp.task('less', function() {
    return gulp.src(lib.pathKey('less.theme'))
                .pipe(plumber({errorHandler: lib.onError}))
                // .pipe(sourcemaps.init())
                    .pipe(less())
                    .pipe(rename('main.min.css'))
                    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
                    .pipe(minifycss())
                // .pipe(sourcemaps.write('.'))
                .pipe(gulp.dest(lib.path('css/')))
                .pipe(livereload())
                .pipe(notify({ message: 'Theme - Less Files Compiled' }));
});

/**
 * CSSMin compiler
 */
gulp.task('cssmin', function() {
    return gulp.src(lib.pathKey('cssmin.app'))
                .pipe(plumber({errorHandler: lib.onError}))
                .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
                .pipe(concat('vendor.min.css'))
                .pipe(minifycss())
                .pipe(gulp.dest( lib.path('css/') ))
                .pipe(livereload())
                .pipe(notify({ message: 'CSS Compiled' }));
});

/**
 * Script (App) compiler
 */
gulp.task('scripts', function() {
    return gulp.src(lib.pathKey('uglify.app'))
                .pipe(plumber({errorHandler: lib.onError}))
                .pipe(concat('main.js'))
                .pipe(rename({ suffix: '.min' }))
                .pipe(uglify({
                    mangle: false,
                    compress: false,
                    output: {
                        beautify: true
                    }
                }))
                .pipe(gulp.dest( lib.path('js/dist/') ))
                .pipe(livereload())
                .pipe(notify({ message: 'Javascript Compiled' }));
});

/**
 * Script (Vendor) compiler
 */
gulp.task('scripts_vendor', function() {
    return gulp.src(lib.pathKey('concat.vendor'))
                .pipe(plumber({errorHandler: lib.onError}))
                .pipe(concat('vendor.js'))
                .pipe(uglify())
                .pipe(rename({ suffix: '.min' }))
                .pipe(gulp.dest( lib.path('js/dist/') ))
                .pipe(notify({ message: 'Vendor JS Compiled' }));
});

/*
|--------------------------------------------------------------------------
| OctoberCMS Backend 
|--------------------------------------------------------------------------
|
| Build system for our plugins
|
*/

/**
 * LESS compiler
 */
gulp.task('backend_less', function() {
    return gulp.src(lib.pathKey('less.backend'))
                .pipe(plumber({errorHandler: lib.onError}))
                // .pipe(sourcemaps.init())
                    .pipe(less())
                    .pipe(rename('main.min.css'))
                    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
                    .pipe(minifycss())
                // .pipe(sourcemaps.write('.'))
                .pipe(gulp.dest(lib.path('css/', 'backend_asset_path')))
                .pipe(livereload())
                .pipe(notify({ message: 'Backend - Less Files Compiled' }));
});


// Default task
gulp.task('default', [
                'less',
                'scripts',
                'scripts_vendor',
                'cssmin',
                'watch'
            ], function() {
});

// Watch tasks
gulp.task('watch', function() 
{
    // Watching Less files
    gulp.watch(config.watch.less.theme, ['less']);

    // Watching CSS vendor files
    gulp.watch(config.watch.vendor_css, ['cssmin']);

    // Watching Script (App) files
    gulp.watch(config.watch.scripts, ['scripts']);

    // Watching JS Vendor files
    gulp.watch(config.watch.vendor_scripts, ['scripts_vendor']);

});