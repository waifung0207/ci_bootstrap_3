var gulp = require('gulp'),
    php = require('gulp-connect-php'),
    config = require('../config').php;

gulp.task('php', function() {
    php.server(config.settings);
});