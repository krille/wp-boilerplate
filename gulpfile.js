var p = require('./package.json')
var gulp = require('gulp')
var sass = require('gulp-sass')
var gutil = require('gulp-util')
var merge = require('merge-stream')
var concat = require('gulp-concat')
var uglify = require('gulp-uglify')
var eslint = require('gulp-eslint')
var plumber = require('gulp-plumber')
var postcss = require('gulp-postcss')
var syntaxSCSS = require('postcss-scss')
var svgSprite = require('gulp-svg-sprite')
var reporter = require('postcss-reporter')
var sourcemaps = require('gulp-sourcemaps')
var autoprefixer = require('autoprefixer')

var onError = function (err) {
	gutil.log(err)
	gutil.beep()
	this.emit('end') // don't break gulp.watch
}

var basePath = 'public/wp-content/themes/THEME-NAME/'

var cssProcessors = [
	autoprefixer({browsers: ['last 2 versions', 'ie >= 10']}),
	require('css-mqpacker'),
	require('cssnano')
]

gulp.task('copy-files', function () {
	var cssFramework = gulp.src('node_modules/bootstrap/scss/**')
		.pipe(gulp.dest(basePath + 'css/bootstrap'))

	var jquery = gulp.src('node_modules/jquery/dist/jquery.min.js')
		.pipe(gulp.dest(basePath + 'js/libs'))

	return merge(cssFramework, jquery)
})

gulp.task('scss-lint', ['copy-files'], function () {
	var processors = [
		require('stylelint'),
		reporter({
			clearMessages: true
		})
	]

	return gulp.src([
		basePath + 'css/**/*.scss',
		'!' + basePath + 'css/_custom.scss',
		'!' + basePath + 'css/bootstrap/**'
	]).pipe(postcss(processors, {syntax: syntaxSCSS}))
})

gulp.task('css', ['copy-files'], function () {
	return gulp.src(basePath + 'css/' + p.name + '.scss')
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(postcss(cssProcessors))
		.pipe(concat(p.name + '.min.css'))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(basePath + 'css'))
})

gulp.task('js-lint', function () {
	return gulp.src([basePath + 'js/' + p.name + '.js'])
		.pipe(eslint())
		.pipe(eslint.formatEach())
})

gulp.task('js', function () {
	return gulp.src([
		'node_modules/lazysizes/lazysizes.js',
		'node_modules/svg4everybody/dist/svg4everybody.js',
		basePath + 'js/' + p.name + '.js'
	])
		.pipe(plumber({
			errorHandler: onError
		}))
		.pipe(sourcemaps.init())
		.pipe(uglify())
		.pipe(concat(p.name + '.min.js'))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(basePath + 'js'))
})

gulp.task('images', function () {
	var imagemin = require('gulp-imagemin')

	return gulp.src([
		basePath + 'img/**/*',
		'!' + basePath + 'img/**/*.svg',
		'!' + basePath + 'img/sprites/*'
	])
	.pipe(imagemin([
		imagemin.gifsicle({interlaced: true}),
		imagemin.jpegtran({progressive: true}),
		imagemin.optipng({optimizationLevel: 5})
	], {
		verbose: true
	}))
	.pipe(gulp.dest(basePath + 'img'))
})

gulp.task('svg-icons', function () {
	return gulp.src(basePath + 'svg/**/*.svg')
		.pipe(svgSprite({
			mode: {
				symbol: {
					render: {
						css: false,
						scss: false
					},
					dest: basePath + 'img/sprites',
					sprite: 'icon-sprite.svg',
					example: true
				}
			},
			svg: {
				xmlDeclaration: false,
				doctypeDeclaration: false
			}
		}))
		.pipe(gulp.dest('.'))
})

gulp.task('watch', function () {
	// Watch .scss files
	gulp.watch([basePath + 'css/**/*.scss', '!' + basePath + 'css/bootstrap/**/*', '!' + basePath + 'css/*.min.*'], ['css', 'scss-lint'])

	// Watch .js files
	gulp.watch(basePath + 'js/' + p.name + '.js', ['js', 'js-lint'])
})

// The default task (called when you run `gulp` from cli)
gulp.task('default', ['images', 'svg-icons', 'js-lint', 'js', 'scss-lint', 'css'])

gulp.task('cloud', ['js', 'css'])
