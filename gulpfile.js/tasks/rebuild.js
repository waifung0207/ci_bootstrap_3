var gulp = require('gulp'),
	gulpSequence = require('gulp-sequence');

gulp.task('rebuild', gulpSequence('clean',
	['copy', 'imagemin'],
	['cssmin', 'uglify:lib'],
	['sass', 'uglify']
));