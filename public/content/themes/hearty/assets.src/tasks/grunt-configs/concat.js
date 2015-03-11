module.exports = function ( grunt, options ) {
	return {
		app : {
			nonull : true,
			src : [
				options.devJsDir + 'app.js',
				options.devJsDir + 'app/**/*.js'
			],
			dest : options.buildJsDir + 'app.js'
		},
		plugins : {
			nonull : true,
			src : [
				'bower_components/iscroll/build/iscroll.js',
				'bower_components/underscore/underscore.js',
				'bower_components/fastclick/lib/fastclick.js',
				'bower_components/verge/verge.js',
				'bower_components/imagesLoaded/imagesLoaded.pkgd.js',
				'bower_components/gsap/src/uncompressed/easing/EasePack.js',
				'bower_components/gsap/src/uncompressed/plugins/CSSPlugin.js',
				'bower_components/gsap/src/uncompressed/TweenMax.js',
				'bower_components/gsap/src/uncompressed/jquery.gsap.js',
				'bower_components/purl/purl.js',
				'bower_components/js-signals/dist/signals.js',
				'bower_components/parallax/deploy/jquery.parallax.js',
				'bower_components/the-modal/jquery.the-modal.js',
				'bower_components/PreloadJS/lib/preloadjs-0.6.0.combined.js',
				'bower_components/history.js/scripts/bundled-uncompressed/html4+html5/jquery.history.js',
				'bower_components/EaselJS/lib/easeljs-0.8.0.combined.js',
				options.devJsDir + 'vendor/**/*.js'
			],
			dest : options.buildJsDir + 'plugins.js'
		},
		polyfills : {
			nonull : true,
			src : [
				options.devJsDir + 'polyfills/**/*.js'
			],
			dest : options.buildJsDir + 'polyfills.js'
		},
		modernizr : {
			nonull : true,
			src : [
				'bower_components/modernizr/modernizr.js',
			],
			dest : options.buildJsDir + 'modernizr.custom.js'
		},
		// foundation : {
		// 	nonull : true,
		// 	src : [
		// 		'bower_components/foundation/js/foundation/foundation.js',
		// 		'bower_components/foundation/js/foundation/foundation.interchange.js'
		// 	],
		// 	dest : options.buildJsDir + 'foundation.custom.js'
		// }
	};
};
