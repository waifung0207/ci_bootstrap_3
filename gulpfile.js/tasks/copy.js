var gulp = require('gulp'),
	config = require('../config').copy;

gulp.task('copy:fonts', function() {
	gulp.src(config.src.fonts)
		.pipe(gulp.dest(config.dest.fonts));
});

gulp.task('copy:files', function() {
	gulp.src(config.src.files)
		.pipe(gulp.dest(config.dest.files));
});

gulp.task('copy', ['copy:fonts', 'copy:files']);