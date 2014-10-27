// --- INIT
var gulp = require('gulp');						// Gulp.
autoprefixer = require('gulp-autoprefixer');	// Auto prefix for multiple browsers.
concat = require('gulp-concat');				// Concats JS files.
minify = require('gulp-minify-css');			// Minifies CSS.
notify = require('gulp-notify');				// Fires off OS X Notifications.
rename = require('gulp-rename');				// Renames files.
sass = require('gulp-sass');					// Compiles sass to CSS.
uglify = require('gulp-uglify');				// Minifies JS.

// --- PATHS
var paths = {
	'dev': {
		'js': './app/assets/js/',
		'sass': './app/assets/sass/',
		'vendor': './bower_components/'
	},
	'build': {
		'css': './css/',
		'fonts': './fonts/',
		'js': './js/'
	}
};

// --- TASKS
gulp.task('css', function()
{
	return gulp.src(paths.dev.sass + 'app.scss')
		.pipe(sass())
		.pipe(autoprefixer('last 10 version'))
		.pipe(minify({keepBreaks: false, keepSpecialComments: 0}))
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest(paths.build.css))
		.pipe(notify('SASS compiled, prefixed, and minified to CSS.'));
});

gulp.task('js', function()
{
	return gulp.src([
		paths.dev.vendor + 'jquery/dist/jquery.js',
		paths.dev.vendor + 'bootstrap-sass-official/assets/javascripts/bootstrap.js',
		paths.dev.js     + 'app.js'
	])
		.pipe(concat('app.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(paths.build.js))
		.pipe(notify('JS compiled and minified.'))
});

// --- WATCH
gulp.task('watch', function()
{
	gulp.watch(paths.dev.sass + '/**/*.scss', ['css']);
	gulp.watch(paths.dev.js + '/**/*.js', ['js']);
});

// --- DEFAULT
gulp.task('default', ['css', 'js', 'watch']);