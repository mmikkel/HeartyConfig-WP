module.exports = function ( grunt, options ) {
	return {
		dist : {
			options : {
				fallback : false,
				ignore : [ 'border-left', 'border-right', 'border-top', 'border-bottom', 'border' ]
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
