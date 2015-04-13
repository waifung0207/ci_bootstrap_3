var gulp = require('gulp'),
	minifyCSS = require('gulp-minify-css'),
	concat = require('gulp-concat'),
	sourcemaps = require('gulp-sourcemaps'),
	config = require('../config').css;

gulp.task('cssmin:frontend', function() {
	return gulp.src(config.src.frontend)
		.pipe(sourcemaps.init())
		.pipe(minifyCSS(config.settings))
		.pipe(concat(config.dest_file.frontend))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(config.dest));
});

gulp.task('cssmin:admin', function() {
	return gulp.src(config.src.admin)
		.pipe(sourcemaps.init())
		.pipe(minifyCSS(config.settings))
		.pipe(concat(config.dest_file.admin))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(config.dest));
});

gulp.task('cssmin', ['cssmin:frontend', 'cssmin:admin']);