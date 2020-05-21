var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync'),
    cssnano = require('gulp-cssnano'),
    del = require('del'),
    cache = require('gulp-cache'),
    autoprefixer = require('gulp-autoprefixer'),
    rename = require('gulp-rename'),
    plumber = require('gulp-plumber');

gulp.task('sass', function() { 
    return gulp.src('scss/**/*.scss') 
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }))
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.reload({ stream: true }));

});

gulp.task('css-min', ['sass'], function() {
    return gulp.src('scss/styles.css')
        .pipe(cssnano())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./css'))
});

gulp.task('browser-sync', function() {
    browserSync({
        proxy:'http://y2aa-frontend.test',
        port:8080
    });
});

gulp.task('clear', function() {
    return cache.clearAll();
});

gulp.task('clean', function() {
    return del.sync(['css/styles.css']);
});

gulp.task('watch', ['browser-sync','clear','clean','build'], function() {
    gulp.watch('scss/**/*.scss', ['sass']);
    gulp.watch('css/*.css', browserSync.reload);
});

gulp.task('build', ['clean','clear', 'sass','css-min'], function() {
    // var buildMainCss = gulp.src(['scss/style.min.css','scss/style.css'])
    //     .pipe(gulp.dest('./css'));
});

gulp.task('default', ['watch']);