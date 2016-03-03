// Get modules.
var gulp = require('gulp');                     // Gulp.
autoprefixer = require('gulp-autoprefixer');    // Auto prefix for multiple browsers.
concat = require('gulp-concat');                // Concats JS files.
minify = require('gulp-minify-css');            // Minifies CSS.
notify = require('gulp-notify');                // Fires off OS X Notifications.
rename = require('gulp-rename');                // Renames files.
sass = require('gulp-sass');                    // Compiles sass to CSS.
uglify = require('gulp-uglify');                // Minifies JS.

// Frequently used paths.
var paths = {
    'dev': {
        'js': './resources/assets/js/',
        'sass': './resources/assets/sass/',
        'vendor': './bower_components/'
    },
    'build': {
        'css': './public/css/',
        'fonts': './public/fonts/',
        'js': './public/js/'
    }
};

// Task styles.
gulp.task('styles', function()
{
    return gulp.src(paths.dev.sass + 'app.scss')
        .pipe(sass({precision: 8}))
        .pipe(autoprefixer('last 10 version'))
        .pipe(minify({keepBreaks: false, keepSpecialComments: 0}))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(paths.build.css))
        .pipe(notify('SASS compiled, prefixed, and minified to CSS.'));
});

// Task fonts.
gulp.task('fonts', function()
{
    gulp.src([paths.dev.vendor + 'fontawesome/fonts/**/*.*']).pipe(gulp.dest(paths.build.fonts + 'fontawesome/'));
    gulp.src([paths.dev.vendor + 'materialize/dist/font/material-design-icons/**/*.*']).pipe(gulp.dest(paths.build.fonts + 'material-design-icons/'));
    gulp.src([paths.dev.vendor + 'materialize/dist/font/roboto/**/*.*']).pipe(gulp.dest(paths.build.fonts + 'roboto/'));
});

// Task scripts.
gulp.task('scripts', function()
{
    gulp.src([
            paths.dev.vendor + 'jquery/dist/jquery.js',
            paths.dev.vendor + 'materialize/dist/js/materialize.js',
        ])
        .pipe(concat('vendor.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(paths.build.js));

    return gulp.src([
            paths.dev.js    + 'app.js'
        ])
        .pipe(concat('app.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(paths.build.js))
        .pipe(notify('JS compiled and minified.'));
});

// Task watch.
gulp.task('watch', function()
{
    gulp.watch(paths.dev.sass + '**/*.scss', ['styles']);
    gulp.watch(paths.dev.js + '**/*.js', ['scripts']);
});

// The default task.
gulp.task('default', ['styles', 'fonts', 'scripts', 'watch']);
