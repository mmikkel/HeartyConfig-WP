module.exports = function ( grunt, options ) {
	var opts = options;

	return {
		grunt : {
			files : [
				'Gruntfile.js',
				'./grunt-configs/**/*.js'
			],
			tasks : [
				'build'
			]
		},
		js_app : {
			files : [
				opts.devJsDir + 'app.js',
				opts.devJsDir + 'app/**/*.js',
			],
			tasks : [
				'compile:js_app',
				'clean:js',
				'copy:js',
				'growl:complete'
			],
			options : {
				spawn : false
			}
		},
		js_vendor : {
			files : [
				opts.devJsDir + 'vendor/**/*.js',
				opts.devJsDir + 'polyfills/**/*.js'
			],
			tasks : [
				'compile:js',
				'clean:js',
				'copy:js',
				'growl:complete'
			],
			options : {
				spawn : false
			}
		},
		css : {
			files : [
				opts.devCssDir + '**/*.scss'
			],
			tasks : [
				'compile:css',
				'clean:css',
				'copy:css',
				'growl:complete'
			],
			options : {
				spawn : false
			}
		},
		images : {
			files : [
				opts.devImgDir + '**/*.{png,jpg,gif,svg}'
			],
			tasks : [
				'images',
				'clean:images',
				'copy:images',
				'growl:complete'
			]
		},
		fonts : {
			files : [
				opts.devFontsDir + '**/*'
			],
			tasks : [
				'clean:fonts',
				'copy:fonts',
				'growl:complete'
			]
		}
	};
};
