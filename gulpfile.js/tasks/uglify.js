var gulp = require('gulp'),
	uglify = require('gulp-uglifyjs'),
	config = require('../config').js;

gulp.task('uglify:frontend', function() {
	return gulp.src(config.src.frontend)
		.pipe(uglify(config.dest_file.frontend, config.settings))
		.pipe(gulp.dest(config.dest));
});

gulp.task('uglify:admin', function() {
	return gulp.src(config.src.admin)
		.pipe(uglify(config.dest_file.admin, config.settings))
		.pipe(gulp.dest(config.dest));
});

gulp.task('uglify', ['uglify:frontend', 'uglify:admin']);