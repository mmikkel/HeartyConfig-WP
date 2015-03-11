module.exports = function ( grunt, options ) {
	return {
		dist : {
			options : {
				log : false
			},
			files : [ {
				expand : true,
				cwd : options.buildCssDir,
				src : [ '*.css' ],
				dest : options.buildCssDir
			} ]
		}
	};
};
