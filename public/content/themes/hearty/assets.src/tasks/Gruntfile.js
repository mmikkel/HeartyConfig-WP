/* global module: false, process: false */

/* =======================================================
	HEARTY STARTER GRUNTFILE

	@version 1.0.0
* ======================================================= */

module.exports = function ( grunt ) {

	if ( grunt.option( 'time' ) !== undefined && grunt.option( 'time' ) ) {
		require( 'time-grunt' )( grunt );
	}

	var devDir = '../src/',
		buildDir = '../build/',
		distDir = '../../assets/',
		pkg = grunt.file.readJSON( 'package.json' ),
		banner = '/*! <%= pkg.name %> | @author <%= pkg.author %> | <%= grunt.template.today("dd-mm-yyyy") %> */\n',

		options = {

			banner : banner,
			pkg : pkg,

			isDev : ( grunt.option( 'dev' ) !== undefined ) ? Boolean( grunt.option( 'dev' ) ) : process.env.GRUNT_ISDEV === '1',

			devDir : devDir,
			buildDir : buildDir,
			distDir : distDir,

			devJsDir : devDir + 'scripts/',
			devCssDir : devDir + 'styles/',
			devImgDir : devDir + 'images/',
			devFontsDir : devDir + 'webfonts',

			buildJsDir : buildDir + 'js/',
			buildCssDir : buildDir + 'css/',
			buildImgDir : buildDir + 'img/',
			buildFontsDir : buildDir + 'fonts/',

			distJsDir : distDir + 'js/',
			distCssDir : distDir + 'css/',
			distImgDir : distDir + 'img/',
			distFontsDir : distDir + 'fonts/'

		};

	/*
	 * Load tasks
	 */
	require( 'load-grunt-config' )( grunt, {
		configPath : require( 'path' ).join( process.cwd(), 'grunt-configs' ),
		data : options,
		jitGrunt : {
			staticMappings : {
				// jscs:disable
				cmq : 'grunt-combine-media-queries',
				px_to_rem : 'grunt-px-to-rem',
				versioncheck : 'grunt-version-check',
				scsslint: 'grunt-scss-lint'
				// jscs:enable
			}
		}
	} );

	if ( options.isDev ) {
		grunt.log.subhead( 'Running Grunt in DEV mode' );
	}

	/*
	 * Register tasks
	 */

	grunt.registerTask( 'build', [ 'clean:build', 'compile:css', 'compile:js', 'images', 'clean:dist', 'copy', 'growl:complete' ] );
	grunt.registerTask( 'default', [ 'build', 'watch' ] );
	grunt.registerTask( 'vc', [ 'versioncheck' ] );

	/*
	 * Stylesheets
	 */
	grunt.registerTask( 'compile:css', function () {
		grunt.task.run( [ 'sass', 'autoprefixer' ] );

		if ( ! options.isDev ) {
			grunt.task.run( [ 'cmq', 'cssmin' ] );
		}
	} );

	/*
	 * Javascripts
	 */
	grunt.registerTask( 'compile:js', function () {
		grunt.task.run( [ 'concat', 'uglify' ] ); //'lint:js',

		// if ( ! options.isDev ) {
		// 	grunt.task.run( [ 'newer:uglify' ] );
		// }
	} );
	grunt.registerTask( 'compile:js_app', function () {
		grunt.task.run( [ 'concat:app', 'uglify:js_app' ] ); //'lint:js',

		// if ( ! options.isDev ) {
		// 	grunt.task.run( [ 'newer:uglify:js_app' ] );
		// }
	} );

	//grunt.registerTask( 'lint:self', [ 'newer:jshint:self', 'newer:jscs:self' ] );
	grunt.registerTask( 'lint:js', [ 'newer:jshint:common' ] );
	grunt.registerTask( 'lint:css', [ 'newer:scsslint' ] );

	/*
	 * Images
	 */
	grunt.registerTask( 'images', [ 'newer:imagemin', 'newer:svgmin' ] );

};
