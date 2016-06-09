var gulp = require('gulp'),
	watch = require('gulp-watch'),
	config = require('../config');

gulp.task('watch', function() {

	// watch JS files
	gulp.watch(config.uglify.src.frontend, ['uglify:frontend']);
	gulp.watch(config.uglify.src.admin, ['uglify:admin']);

	// watch SASS / CSS files
	gulp.watch(config.sass.src.frontend, ['sass:frontend']);
	gulp.watch(config.sass.src.admin, ['sass:admin']);

	// watch images
	gulp.watch(config.imagemin.src, ['imagemin']);
});