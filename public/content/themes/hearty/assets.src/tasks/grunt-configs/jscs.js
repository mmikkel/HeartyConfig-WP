module.exports = function ( grunt, options ) {
	var opts = options;
	return {
		options : {
			config : 'resources/jscs_conf.json'
		},
		self : {
			files : [ {
				expand : true,
				cwd : './',
				src : [
					'Gruntfile.js',
					'grunt-configs/**/*.js'
				],
				dest : './'
			} ]
		},
		common : {
			files : [ {
				expand : true,
				cwd : opts.devJsDir,
				src : [
					'main.js',
					'app/**/*.js'
				],
				dest : opts.devJsDir
			} ]
		}
	};
};
