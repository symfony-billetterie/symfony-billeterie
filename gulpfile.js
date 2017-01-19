var gulp = require('gulp'), //== https://github.com/gulpjs/gulp
    path = require('path'), //== http://nodejs.org/api/path.html
    sass = require('gulp-sass'), //== https://github.com/dlmanning/gulp-sass/
    spritesmith = require('gulp.spritesmith'), //== https://github.com/twolfson/gulp.spritesmith
    rename = require('gulp-rename'), //== https://github.com/hparra/gulp-rename
    rimraf = require('gulp-rimraf'), //== https://github.com/robrich/gulp-rimraf
    chalk = require('chalk'), //== https://github.com/sindresorhus/chalk
    plumber = require('gulp-plumber'), //== https://github.com/floatdrop/gulp-plumber
    notify = require("gulp-notify"), //== https://github.com/mikaelbr/gulp-notify
    shell = require('gulp-shell'), //== https://github.com/sun-zheng-an/gulp-shell
    uglify = require('gulp-uglify'), //== https://github.com/terinjokes/gulp-uglify
    concat = require('gulp-concat'), //== https://github.com/contra/gulp-concat
    sourcemaps = require('gulp-sourcemaps'), //== https://github.com/floridoo/gulp-sourcemaps
    yaml = require("js-yaml"), //== https://github.com/nodeca/js-yaml
    fs = require("fs"),

    source = {
        img: './web/img',
        sprites: './web/img/sprites',
        sass: './app/Resources/assets/sass',
        sassWatch: './app/Resources/assets/sass/**/**/*.scss',
        jsWatch: './app/Resources/assets/js/app/app.js',
        js: './app/Resources/assets/js',
        yml: './app/config/assets.yml'
    };

dist = {
    css: './web/css',
    img: './web/img',
    sprites: './web/img/sprites',
    js: './web/js'
};

//== sprites :: gulp icons or logos (sprite alone), gulp icons-sass gulp logos-sass (sprite + sass)
var hashName = '', hash = '', hashPattern = "abcdefghijklmnopqrstuvwxyz0123456789";

function makeHash(hashName) {

    for (var i = 0; i < 11; i++) {
        hashName += hashPattern.charAt(Math.floor(Math.random() * hashPattern.length));
    }
    hash = hashName;
}

function spriteVersionning(spriteImg, pattern) {

    spriteImg.img.pipe(rename({suffix: '-' + hash}))
        .pipe(gulp.dest(dist.sprites));
    spriteImg.css.pipe(gulp.dest(dist.sprites));
    gulp.src(dist.sprites + pattern).pipe(rimraf({force: true}));
}

function makeSprite(spriteVar, name) {

    makeHash(hash);
    console.log(
        chalk.white('hash generated ')
        + chalk.cyan.bold(hash)
    );
    spriteVar = gulp.src(source.img + '/sprites/' + name + '/*.png').pipe(spritesmith({
        cssSpritesheetName: hash,
        imgName: name + '.png',
        imgPath: '../img/sprites/' + name, // css write
        cssName: '_' + name + '.scss', // relative to img folder...
        cssTemplate: source.sass + '/app/base/_' + name + '.scss.mustache',
        padding: 2
    }));
    spriteVersionning(spriteVar, '/' + name + '-*.png');
}


gulp.task('icons', function () {
    var icons = '';
    makeSprite(icons, 'icons');
});
/*
 gulp.task('logos', function() {
 var logos = '';
 makeSprite(logos, 'logos');
 });
 */

gulp.task('sass-after-sprite', function () {
    setTimeout(function () {
        gulp.start('sass');
    }, 1500);
});
gulp.task('icons-sass', ['icons', 'sass-after-sprite']);
//gulp.task('logos-sass', ['logos', 'sass-after-sprite']);


//== sass :: gulp sass
gulp.task('sass', function () {
    gulp.src([source.sassWatch])
        .pipe(sourcemaps.init())
        .pipe(plumber({
            errorHandler: notify.onError({
                message: "Error: <%= error.message %>",
                sound: true
            })
        }))
        .pipe(sass({
            outputStyle: 'compressed',
            includePaths: [source.sass],
            errLogToConsole: true
        }))
        .pipe(rename({extname: '.css'}))
        .pipe(plumber.stop())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(dist.css));
});

loadJsTasks();

function loadJsTasks() {
    assets = yaml.safeLoad(fs.readFileSync(source.yml));
    var tasks = [];
    for (file in assets.assets.js) {
        createJsTask(file, assets.assets.js[file]);
        tasks.push('js-' + file);
    }

    gulp.task('js', tasks);
}

function createJsTask(name, sources) {
    gulp.task('js-' + name, function () {
        test = [];
        for (file in sources) {
            test.push(source.js + '/' + name + '/' + sources[file]);
        }

        return gulp.src(test)
            .pipe(sourcemaps.init())
            .pipe(plumber({
                errorHandler: notify.onError({
                    message: "Error: <%= error.message %>",
                    sound: true
                })
            }))
            .pipe(concat(name + '.min.js'))
            .pipe(uglify())
            .pipe(plumber.stop())
            .pipe(sourcemaps.write('./'))
            .pipe(gulp.dest(dist.js));
    });
}


//== shell :: gulp bs (browsersync)
gulp.task('bs', shell.task([
    'browser-sync start --proxy \
    "https://skeleton.sf" \
    --startPath "app_dev.php/" \
    --files "./web/css/*.css, ./web/js/*.js, app/Resources/views/**/**/**/*.html.twig"'
]));

//== watch
gulp.task('watch', function () {

    function logWatch(files, tasks) {

        var match = new RegExp('.*(?=' + tasks + ')');
        gulp.watch([files], [tasks]).on('change', function (evt) {
            console.log(
                chalk.cyan.bold(evt.path.replace(match, ''))
                + chalk.white(' ' + evt.type)
            );
        });
        console.log(
            chalk.green(files)
        );
    }

    logWatch(source.sassWatch, 'sass');
    logWatch(source.jsWatch, 'js-app');
});