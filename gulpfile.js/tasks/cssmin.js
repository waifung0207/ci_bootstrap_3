var gulp = require('gulp'),
	cleanCSS = require('gulp-clean-css'),
	concat = require('gulp-concat'),
	sourcemaps = require('gulp-sourcemaps'),
	handleErrors = require('../lib/handleErrors'),
	config = require('../config').cssmin;

gulp.task('cssmin:frontend', function() {
	return gulp.src(config.src.frontend)
		.pipe(sourcemaps.init())
		.pipe(cleanCSS(config.options))
		.pipe(concat(config.dest_file.frontend))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest));
});

gulp.task('cssmin:admin', function() {
	return gulp.src(config.src.admin)
		.pipe(sourcemaps.init())
		.pipe(cleanCSS(config.options))
		.pipe(concat(config.dest_file.admin))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest));
});

gulp.task('cssmin:adminlte', function() {
	return gulp.src(config.src.adminlte)
		.pipe(sourcemaps.init())
		.pipe(cleanCSS(config.options))
		.pipe(concat(config.dest_file.adminlte))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest));
});

gulp.task('cssmin', ['cssmin:frontend', 'cssmin:admin', 'cssmin:adminlte']);