var gulp = require('gulp'),
	cleanCSS = require('gulp-clean-css'),
	concat = require('gulp-concat'),
	sourcemaps = require('gulp-sourcemaps'),
	handleErrors = require('../lib/handleErrors'),
	config = require('../config').cssmin;

gulp.task('cssmin:frontend_lib', function() {
	return gulp.src(config.src.frontend_lib)
		.pipe(sourcemaps.init())
		.pipe(cleanCSS(config.options))
		.pipe(concat(config.dest_file.frontend_lib))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest.frontend));
});

gulp.task('cssmin:adminlte', function() {
	return gulp.src(config.src.adminlte)
		.pipe(sourcemaps.init())
		.pipe(cleanCSS(config.options))
		.pipe(concat(config.dest_file.adminlte))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest.admin));
});

gulp.task('cssmin:admin_lib', function() {
	return gulp.src(config.src.admin_lib)
		.pipe(sourcemaps.init())
		.pipe(cleanCSS(config.options))
		.pipe(concat(config.dest_file.admin_lib))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest.admin));
});

gulp.task('cssmin', ['cssmin:frontend_lib', 'cssmin:adminlte', 'cssmin:admin_lib']);