module.exports = function ( grunt, options ) {
	var opts = options;
	return {
		
		options : {
			includePaths : [ 'bower_components/foundation/scss' ]
		},

		dist : {
			options : {
				outputStyle : 'compressed'
			},
			files : [ {
				expand : true,
				cwd : opts.devCssDir,
				src : [ '*.scss', '!_*' ],
				dest : opts.buildCssDir,
				rename : function ( dest, src ) {
					return dest + src.replace( 'scss', 'css' );
				}
			} ]
		}
	};
};
