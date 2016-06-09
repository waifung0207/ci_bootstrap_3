var gulp = require('gulp'),
	sass = require('gulp-sass'),
	cleanCSS = require('gulp-clean-css'),
	concat = require('gulp-concat'),
	sourcemaps = require('gulp-sourcemaps'),
	config = require('../config').sass,
	config_cssmin = require('../config').cssmin;

gulp.task('sass:frontend', function() {
	return gulp.src(config.src.frontend)
		.pipe(sourcemaps.init())
		.pipe(sass(config.options).on('error', sass.logError))
		.pipe(cleanCSS(config_cssmin.options))
		.pipe(concat(config.dest_file.frontend))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(config.dest.frontend));
});

gulp.task('sass:admin', function() {
	return gulp.src(config.src.admin)
		.pipe(sourcemaps.init())
		.pipe(sass(config.options).on('error', sass.logError))
		.pipe(cleanCSS(config_cssmin.options))
		.pipe(concat(config.dest_file.admin))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(config.dest.admin));
});

gulp.task('sass', ['sass:frontend', 'sass:admin']);