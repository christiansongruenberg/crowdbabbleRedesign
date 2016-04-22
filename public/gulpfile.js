//////////////////////////////////////////////////////////////////////////////
//// Dependencies
//////////////////////////////////////////////////////////////////////////////

var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    sass = require('gulp-sass'),
    livereload = require('gulp-livereload');


//////////////////////////////////////////////////////////////////////////////
//// Tasks
//////////////////////////////////////////////////////////////////////////////

gulp.task('scripts', function(){
   gulp.src('resources/javascript/**/*.js')
       .pipe(rename({suffix: '.min'}))
       .pipe(uglify())
       .pipe(gulp.dest('assets/javascript'))
       .pipe(livereload());
});

gulp.task('sass', function(){
   gulp.src('resources/scss/**/*.scss')
       .pipe(rename({suffix: '.min'}))
       .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
       .pipe(gulp.dest('assets/css'))
       .pipe(livereload());
});

gulp.task('twig', function(){
   gulp.src('resources/views/**/*.twig')
       .pipe(livereload());
});

gulp.task('watch', function(){

    livereload.listen();

    gulp.watch('resources/javascript/**/*.js', ['scripts']);
    gulp.watch('resources/scss/**/*.scss', ['sass']);
    gulp.watch('resources/views/**/*.twig', ['twig']);
});

gulp.task('default', ['watch']);