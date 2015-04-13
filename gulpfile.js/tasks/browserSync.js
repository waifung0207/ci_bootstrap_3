/**
 * Reference: http://fettblog.eu/php-browsersync-grunt-gulp/
 */
var gulp = require('gulp'),
	browserSync = require('browser-sync'),
	config = require('../config').browserSync;

gulp.task('browserSync', ['php'], function() {
	browserSync(config.settings);
});
