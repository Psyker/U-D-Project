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
import awspublish from 'gulp-awspublish'
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


gulp.task('publish', () => {
    // create a new publisher using S3 options
    // http://docs.aws.amazon.com/AWSJavaScriptSDK/latest/AWS/S3.html#constructor-property
    var publisher = awspublish.create({
        region: 'eu-west-2',
        accessKeyId: "AKIAIOB2A7PV7VM56CYA",
        secretAccessKey: "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",
        params: {
            Bucket: 'ud-batiments'
        },
        identityId: "EF4LQM1PM9XIJ"
    });

    // define custom headers
    let headers = {'Cache-Control': 'max-age=3600, no-transform, public'};

    return gulp.src('web/assets/dist/**')
    // gzip, Set Content-Encoding headers and add .gz extension
        .pipe(awspublish.gzip({ ext: '.gz' }))

        // publisher will add Content-Length, Content-Type and headers specified above
        // If not specified it will set x-amz-acl to public-read by default
        .pipe(publisher.publish(headers))

        // create a cache file to speed up consecutive uploads
        .pipe(publisher.cache())

        // print upload updates to console
        .pipe(awspublish.reporter());
});
