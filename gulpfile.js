let gulp = require("gulp");
let sass = require("gulp-sass");
let browserSync = require("browser-sync");
let del = require("del");

function style(){
  return gulp.src('./scss/**/*.scss')
    .pipe(sass())
    .pipe(gulp.dest('./css'))
    .pipe(browserSync.stream())
}

function watcher(){
  browserSync({
    proxy:"localhost/test-subskill",
    baseDir: "./",
  });

  gulp.watch('./scss/**/*.scss', style).on('change', browserSync.reload)
  gulp.watch('**/*.php').on('change', browserSync.reload)
  // gulp.watch('./app/*.html').on('change', browserSync.reload)
  gulp.watch('./app/js/**/*.js').on('change', browserSync.reload)
}

function clean(){
  return del('dist');
}

module.exports = {
  style,
  clean,
  watch: gulp.series(clean, style, watcher)
}