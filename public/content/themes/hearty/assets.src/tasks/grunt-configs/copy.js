module.exports = function ( grunt, options ) {
	return {
		fonts : {
			expand : true,
			cwd : options.devFontsDir,
			src : '**/*',
			dest : options.buildFontsDir
		},
		css : {
			expand : true,
			cwd : options.buildCssDir,
			src : '**/*',
			dest : options.distCssDir
		},
		js : {
			expand : true,
			cwd : options.buildJsDir,
			src : '**/*',
			dest : options.distJsDir
		},
		images : {
			expand : true,
			cwd : options.buildImgDir,
			src : '**/*',
			dest : options.distImgDir
		},
		dist : {
			expand : true,
			cwd : options.buildDir,
			src : '**/*',
			dest : options.distDir
		}
	};
};
