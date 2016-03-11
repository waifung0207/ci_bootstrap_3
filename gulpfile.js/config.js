/**
 * Gulp configuration file
 */

// basic paths
var dir_bower = "./bower_components",
	dir_asset = "./assets",				// base folder for all assets
	dir_dist = dir_asset + "/dist",		// destination for post-processed scripts and images
	dir_fonts = dir_asset + "/fonts",	// destination for font files
	dir_theme = dir_asset + "/theme";	// default folder for theme files

module.exports = {
	
	// Task: clean up destination folder
	// Plugin: del (https://github.com/sindresorhus/del)
	clean: {
		src: [
			dir_dist + "**/*",
			dir_fonts + "**/*",
			"!" + dir_dist + "/index.html",
			"!" + dir_fonts + "/index.html",
		]
	},

	// Task: copy required files & folders to destination folder
	copy: {
		src: {
			fonts: [
				// bower files
				dir_bower + '/bootstrap/dist/fonts/**',
				dir_bower + '/font-awesome/fonts/**',
				dir_bower + '/ionicons/fonts/**'
			],
			files: [
				// files (JS / CSS / etc.) directly copy to destination folder
			]
		},
		dest: {
			fonts: dir_fonts,
			files: dir_dist
		}
	},

	// Task: concat and minify CSS files
	// Plugin: gulp-clean-css (https://github.com/scniro/gulp-clean-css)
	cssmin: {
		src: {
			// Frontend Website
			frontend: [
				// bower files
				dir_bower + '/bootstrap/dist/css/bootstrap.min.css',
				dir_bower + '/font-awesome/css/font-awesome.min.css',
				// custom files
				dir_asset + '/css/frontend.css'
			],
			// Admin Panel - AdminLTE theme
			adminlte: [
				dir_bower + '/admin-lte/bootstrap/css/bootstrap.min.css',
				dir_bower + '/admin-lte/dist/css/AdminLTE.min.css',
				dir_bower + '/admin-lte/dist/css/skins/_all-skins.min.css',
			],
			// Admin Panel - 3rd party libraries and custom scripts
			admin: [
				// bower files
				dir_bower + '/font-awesome/css/font-awesome.min.css',
				dir_bower + '/ionicons/css/ionicons.min.css',
				dir_bower + '/spectrum/spectrum.css',
				// custom files
				dir_asset + '/css/admin.css'
			]
		},
		dest: dir_dist,
		dest_file: {
			frontend: 'app.min.css',
			admin: 'admin.min.css',
			adminlte: 'adminlte.min.css'
		},
		options: {
			advanced: true,	// set "false" for faster operation, but slightly larger output files
			keepSpecialComments: 0
		}
	},

	// Task: concat and minify (uglify) JS files
	// Plugin: gulp-uglify (https://github.com/terinjokes/gulp-uglify)
	uglify: {
		src: {
			// Frontend Website
			frontend: [
				// bower files
				dir_bower + '/jquery/dist/jquery.min.js',
				dir_bower + '/bootstrap/dist/js/bootstrap.min.js',
				// custom files
				dir_asset + '/js/frontend.js'
			],
			// Admin Panel - AdminLTE theme
			adminlte: [
				// use jQuery 1.x for compatibility with Grocery CRUD
				dir_bower + '/jquery-legacy/dist/jquery.min.js',
				dir_bower + '/jquery-migrate/jquery-migrate.min.js',
				dir_bower + '/admin-lte/bootstrap/js/bootstrap.min.js',
				dir_bower + '/admin-lte/plugins/fastclick/fastclick.js',
				dir_bower + '/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js',
				dir_bower + '/admin-lte/dist/js/app.min.js',
				// include other plugins below when necessary
			],
			// Admin Panel - 3rd party libraries and custom stylesheets
			admin: [
				// bower files
				dir_bower + '/Sortable/Sortable.min.js',
				dir_bower + '/spectrum/spectrum.js',
				// custom files
				dir_asset + '/js/admin.js'
			]
		},
		dest: dir_dist,
		dest_file: {
			frontend: 'app.min.js',
			admin: 'admin.min.js',
			adminlte: 'adminlte.min.js'
		},
		options: {
		}
	},

	// Tasks: optimize images
	// Plugin: gulp-imagemin (https://github.com/sindresorhus/gulp-imagemin)
	imagemin: {
		src: dir_asset + "/images/**/*.{png,jpg,gif,svg}",
		dest: dir_dist + "/images",
		options: {
		}
	}
};