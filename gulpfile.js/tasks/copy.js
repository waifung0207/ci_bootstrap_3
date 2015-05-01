var gulp = require('gulp'),
	config = require('../config').copy;

gulp.task('copy:fonts', function() {
	gulp.src(config.src.fonts)
		.pipe(gulp.dest(config.dest.fonts));
});

gulp.task('copy:scripts', function() {
	gulp.src(config.src.scripts)
		.pipe(gulp.dest(config.dest.scripts));
});

gulp.task('copy', ['copy:fonts', 'copy:scripts']);