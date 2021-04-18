
var gulp        = require('gulp'),
    bump        = require('gulp-bump'),
    sass        = require('gulp-sass'),
    notify      = require("gulp-notify"),
    uglify      = require('gulp-uglify'),
    rename      = require('gulp-rename'),
    concat      = require('gulp-concat'),
    bower       = require('gulp-bower'),
    concatCss   = require('gulp-concat-css'),
    minifycss   = require('gulp-minify-css');
    browser_sync        = require('browser-sync');


/* mappar */
// ./ = current working directory (Same folder gulp is in) src.css./src/sass/
var root    = './';
var src     = {
    'css':root+'src/sass/',
    'js':root+'src/js/',
    'fonts':root+'src/fonts/',
    'images':root+'src/images/',
    'bower_components':root+'bower_components/',
    'node_modules':root+'node_modules/'
};
var assets  = {
    'css':root+'assets/css/',
    'js':root+'assets/js/'
};

gulp.task('icons', function() {
    gulp.src(src.fonts + '/fontawesome/webfonts/**.*')
        .pipe(gulp.dest('./assets/fonts'));
    gulp.src(src.bower_components + '/bootstrap-sass/assets/fonts/bootstrap/**.*')
        .pipe(gulp.dest('./assets/fonts/bootstrap'));
});

gulp.task('images', function() {
    gulp.src(src.images + '/**.*')
        .pipe(gulp.dest('./assets/images'));
});

gulp.task('sass', function(){
    var config              = {};
    config.sourceComments   = 'map';
    config.outputStyle      = 'compressed';
    gulp.src([
            src.css + 'main.scss'
        ])
        .pipe(sass(config).on('error', function(err) {
            return notify().write(err);
        }))
        // .pipe(concatCss('all.css'))
        .pipe(rename('all.min.css'))
        .pipe(minifycss())
        .pipe(gulp.dest(assets.css))
        .pipe(browser_sync.stream())
        .pipe(notify({message:'CSS Has finished running dawg!'}));

    gulp.src('./website.json')
        .pipe(bump({type: 'patch', key: 'css'}))
        .pipe(gulp.dest('./'))
});


gulp.task('js', function() {
    gulp.src([
            src.js+'/global.js',
            src.bower_components+'/bootstrap/dist/js/bootstrap.min.js',
            src.node_modules+'/bs-custom-file-input/dist/bs-custom-file-input.min.js',
            src.bower_components+'/jquery-nitea-equal-height/jquery-nitea-equal-height.js',
            src.js+'/formvalidation.io/formValidation.min.js',
            src.js+'/formvalidation.io/framework/bootstrap.min.js',
            src.js+'/formvalidation.io/addons/mandatoryIcon.min.js',
            // src.js+'/formvalidation.io/addons/reCaptcha2.min.js',
            src.js+'/recaptcha-init.js',
            src.js+'/form-contact.js',
            src.js+'/form-offer.js',
            src.js+'/form-service.js',
            src.js+'/form-inventory.js',
            src.js+'/form-appliances.js',
            src.js+'/form-product.js',
            src.js+'/form-gas-stove.js',
            src.js+'/form-commercial-cool.js',
            src.js+'/form-subscribe.js'
        ])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('./assets/js'))
        .pipe(rename('all.min.js'))
        .pipe(uglify({output: {beautify: false}}))
        .pipe(gulp.dest('./assets/js'))
        .pipe(browser_sync.stream())
        .pipe(notify({ message: 'JS Has finished running dawg!' }));

    gulp.src('./website.json')
        .pipe(bump({type: 'patch', key: 'js'}))
        .pipe(gulp.dest('./'));

});


gulp.task('serve', ['sass'], function()
{
    browser_sync.init({
        proxy: 'soderkyl.se.nitea.net'
    });
});

gulp.task('watch', function() {

    gulp.watch('src/sass/**/*.scss', ['sass']);
    // in js and all children folders
    gulp.watch('src/js/**/*.js', ['js']);

});

// gulp.task('default', ['icons', 'sass', 'js', 'watch', 'serve']);
gulp.task('default', [ 'sass', 'js', 'icons', 'images', 'watch', 'serve']);

