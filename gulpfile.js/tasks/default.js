var gulp = require('gulp'),
	gulpSequence = require('gulp-sequence');

gulp.task('default', gulpSequence('build', 'watch'));