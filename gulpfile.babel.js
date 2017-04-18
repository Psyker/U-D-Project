/**
 * Created by renanbronchart on 18/04/2017.
 */

import gulp from "gulp"
import browserify from "browserify"
import source from "vinyl-source-stream"
import buffer from 'vinyl-buffer'
import sourcemaps from 'gulp-sourcemaps'
import sass from "gulp-sass"
import concat from "gulp-concat"
import plugins from "gulp-load-plugins"
const $ = plugins();


gulp.task("transpile", () => {
    return browserify("web/assets/app/js/app.js", { debug: true })
        .transform("babelify")
        .bundle()
        .pipe(source("bundle.js"))
        .pipe(buffer())
        .pipe(gulp.dest("./web/assets/dist/js"))
        .pipe(sourcemaps.init())
        .pipe(concat('bundle.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest("./web/assets/dist/js"));
});


gulp.task('sass', () => {
    return gulp.src('web/assets/app/sass/style.sass')
                .pipe($.sourcemaps.init())
                .pipe($.sass())
                .pipe($.autoprefixer())
                .pipe($.csso())
                .pipe($.sourcemaps.write('./'))
                .pipe($.rename({
                    suffix: '.min'
                }))
                .pipe(gulp.dest('./web/assets/dist/css/'))
});

gulp.task('watch', ['transpile', 'sass'], () => {
    gulp.watch('web/assets/app/**/*.js', ['transpile'])
    gulp.watch('web/assets/app/**/*.sass', ['sass'])
});

gulp.task('default', ['transpile', 'sass']);
