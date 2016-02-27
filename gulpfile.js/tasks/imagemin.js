var gulp = require('gulp'),
	changed = require('gulp-changed'),
	imagemin = require('gulp-imagemin'),
	config = require('../config').imagemin;

gulp.task('imagemin', function() {
	return gulp.src(config.src)
		.pipe(changed(config.dest))			// Ignore unchanged files
		.pipe(imagemin(config.options))		// Optimize
		.pipe(gulp.dest(config.dest));
});