const {src, dest, watch, parallel} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin');
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const webp = require('gulp-webp');

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'expanded'}))
        .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/css'));
}

function javascript() {
    return src(paths.js)
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/js'));
}

function imagenes(done) {
        src(paths.imagenes)
        .pipe(cache(imagemin({optimizationLevel: 3})))
        .pipe(dest('public/build/img'))
    
    done();
}

function versionWebp(done) {
    const opciones = {
        quality: 50
    };
    src('src/img/**/*.{png,jpg}')
        .pipe( webp(opciones) )
        .pipe( dest('public/build/img') )
    done();
}

function watchArchivos() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
}

exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.convertImg = parallel(imagenes, versionWebp);
exports.default = parallel(css, javascript, watchArchivos);
