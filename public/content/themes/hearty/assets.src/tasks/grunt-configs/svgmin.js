module.exports = function ( grunt, options ) {
	return {
		dist : {
			options : {
				plugins : [
					{ removeViewBox : true } ,
					{ removeUselessStrokeAndFill : true },
					{ removeEmptyAttrs : true },
					{ removeDoctype : true }
				]
			},
			files : [ {
				expand : true,
				cwd : options.devImgDir,
				src : [ '**/*.svg', '!logo*.svg' ],
				dest : options.buildImgDir
			} ]
		},
		logo : {
			options : {
				plugins : [
					{ removeViewBox : false } ,
					{ removeUselessStrokeAndFill : true },
					{ removeEmptyAttrs : true },
					{ convertShapeToPath : false },
					{ removeDoctype : true },
					{ cleanupIDs : false }
				]
			},
			files : [ {
				expand : true,
				cwd : options.devImgDir,
				src : [ '**/logo*.svg' ],
				dest : options.buildImgDir
			} ]
		}
	};
};
