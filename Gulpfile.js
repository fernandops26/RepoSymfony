var gulp=require('gulp');
var sass = sass = require('gulp-sass');
var exec = require('child_process').exec;
var livereload = require('gulp-livereload');

gulp.task('sass', function () {
    gulp.src('./web/bundles/blog/sass/*.scss')
        .pipe(sass({sourceComments: 'map'}))
        .pipe(gulp.dest('./web/css/'));
});

gulp.task('installAssets', function () {
    exec('php bin/console assets:install --symlink', logStdOutAndErr);
});

gulp.task('watch', function () {
    var onChange = function (event) {
        console.log('File '+event.path+' has been '+event.type);
        // Tell LiveReload to reload the window
        livereload.reload();
    };
    // Starts the server
    livereload.listen();
    gulp.watch('./src/BlogBundle/Resources/public/sass/*.scss', ['sass'])
        .on('change', onChange);
    gulp.watch('./src/BlogBundle/Resources/views/**/*.twig')
        .on('change', onChange);
});

// Without this function exec() will not show any output
var logStdOutAndErr = function (err, stdout, stderr) {
    console.log(stdout + stderr);
};

gulp.task('default',['sass','installAssets','watch']);