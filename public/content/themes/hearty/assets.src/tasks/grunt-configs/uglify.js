module.exports = function ( grunt, options ) {
	return {
		javascript : {
			files : [ {
				expand : true,
				cwd : options.buildJsDir,
				src : [
					'*.js'
				],
				ext : '.min.js',
				dest : options.buildJsDir
			} ]
		},
		js_app : {
			files : [ {
				expand : true,
				cwd : options.buildJsDir,
				src : [
					'app.js'
				],
				ext : '.min.js',
				dest : options.buildJsDir
			} ]
		},
	};
};
