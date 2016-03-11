var gulp = require('gulp'),
	watch = require('gulp-watch'),
	config = require('../config');

gulp.task('watch', function() {

	// watch JS files
	gulp.watch(config.uglify.src.frontend, ['uglify:frontend']);
	gulp.watch(config.uglify.src.admin, ['uglify:admin']);

	// watch CSS files
	gulp.watch(config.cssmin.src.frontend, ['cssmin:frontend']);
	gulp.watch(config.cssmin.src.admin, ['cssmin:admin']);

	// watch images
	gulp.watch(config.imagemin.src, ['imagemin']);
});