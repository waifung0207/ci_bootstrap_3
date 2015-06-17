var gulp = require('gulp'),
	gulpSequence = require('gulp-sequence');

gulp.task('serve', function(cb) {
	
	// make sure build task is completed before calling browserSync
	gulpSequence('build', ['browserSync', 'watch'], cb);
});