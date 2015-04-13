var gulp = require('gulp'),
	changed = require('gulp-changed'),
	imagemin = require('gulp-imagemin'),
	config = require('../config').images,
	reload = require('browser-sync').reload;

gulp.task('images', function() {
	return gulp.src(config.src)
		.pipe(changed(config.dest))			// Ignore unchanged files
		.pipe(imagemin())					// Optimize
		.pipe(gulp.dest(config.dest))
		.pipe(reload({stream:true}));
});