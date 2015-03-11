module.exports = function ( grunt, options ) {
	return {
		dist : {
			files : [ {
				expand : true,
				cwd : options.devImgDir,
				src : [ '**/*.{png,jpg,gif}' ],
				dest : options.buildImgDir
			} ]
		}
	};
};
