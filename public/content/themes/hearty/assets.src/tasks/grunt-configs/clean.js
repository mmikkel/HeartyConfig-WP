module.exports = function ( grunt, options ) {
	return {
		options : {
			force : true
		},
		fonts : options.distFontsDir,
        images : options.distImgDir,
        js : options.distJsDir,
        css : options.distCssDir,
        build : options.buildDir,
		dist : options.distDir
	};
};
