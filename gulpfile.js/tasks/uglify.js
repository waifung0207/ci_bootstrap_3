var gulp = require('gulp'),
	uglify = require('gulp-uglify'),
	concat = require('gulp-concat'),
	sourcemaps = require('gulp-sourcemaps'),
	handleErrors = require('../lib/handleErrors'),
	config = require('../config').uglify;

gulp.task('uglify:frontend_lib', function() {
	return gulp.src(config.src.frontend_lib)
		.pipe(sourcemaps.init())
		.pipe(uglify(config.options))
		.pipe(concat(config.dest_file.frontend_lib))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest.frontend));
});

gulp.task('uglify:frontend', function() {
	return gulp.src(config.src.frontend)
		.pipe(sourcemaps.init())
		.pipe(uglify(config.options))
		.pipe(concat(config.dest_file.frontend))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest.frontend));
});

gulp.task('uglify:adminlte', function() {
	return gulp.src(config.src.adminlte)
		.pipe(sourcemaps.init())
		.pipe(uglify(config.options))
		.pipe(concat(config.dest_file.adminlte))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest.admin));
});

gulp.task('uglify:admin_lib', function() {
	return gulp.src(config.src.admin_lib)
		.pipe(sourcemaps.init())
		.pipe(uglify(config.options))
		.pipe(concat(config.dest_file.admin_lib))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest.admin));
});

gulp.task('uglify:admin', function() {
	return gulp.src(config.src.admin)
		.pipe(sourcemaps.init())
		.pipe(uglify(config.options))
		.pipe(concat(config.dest_file.admin))
		.pipe(sourcemaps.write('.'))
		.on('error', handleErrors)
		.pipe(gulp.dest(config.dest.admin));
});

gulp.task('uglify:lib', ['uglify:frontend_lib', 'uglify:adminlte', 'uglify:admin_lib']);

gulp.task('uglify', ['uglify:frontend', 'uglify:admin']);