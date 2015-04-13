var gulp = require('gulp'),
	config = require('../config').copy;

gulp.task('copy', function() {
	gulp.src(config.src.fonts)
		.pipe(gulp.dest(config.dest.fonts));
});