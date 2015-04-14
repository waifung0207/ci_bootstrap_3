var gulp = require('gulp'),
	watch = require('gulp-watch'),
	config = require('../config'),
	browserSync = require('browser-sync');

// create tasks that ensures the compilations are complete before reloading browsers
gulp.task('watch:js-frontend', ['uglify:frontend'], browserSync.reload);
gulp.task('watch:js-admin', ['uglify:admin'], browserSync.reload);
gulp.task('watch:css-frontend', ['cssmin:frontend'], browserSync.reload);
gulp.task('watch:css-admin', ['cssmin:admin'], browserSync.reload);
gulp.task('watch:images', ['images'], browserSync.reload);

gulp.task('watch', function(callback) {

	// watch PHP files
	gulp.watch(config.php.src, browserSync.reload);

	// watch JS files
	gulp.watch(config.js.src.frontend, ['watch:js-frontend']);
	gulp.watch(config.js.src.admin, ['watch:js-admin']);

	// watch CSS files
	gulp.watch(config.css.src.frontend, ['watch:css-frontend']);
	gulp.watch(config.css.src.admin, ['watch:css-admin']);

	// watch images
	gulp.watch(config.images.src, ['watch:images']);

});