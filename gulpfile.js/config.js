/**
 * Gulp configuration file
 */

// basic paths
var dir_bower = "./bower_components",
	dir_asset = "./assets",				// base folder for all assets
	dir_dist = dir_asset + "/dist",		// destination for post-processed scripts and images
	dir_fonts = dir_dist + "/fonts",	// destination for font files
	dir_theme = dir_asset + "/theme";	// default folder for theme files

module.exports = {
	
	// Task: clean up destination folder
	// Plugin: del (https://github.com/sindresorhus/del)
	clean: {
		src: [
			dir_dist + "**/*",
			"!" + dir_dist + "/index.html"
		]
	},

	// Task: copy required files & folders to destination folder
	copy: {
		src: {
			// Font files from Bower packages
			fonts: [
				dir_bower + '/bootstrap/dist/fonts/**',
				dir_bower + '/font-awesome/fonts/**',
				dir_bower + '/ionicons/fonts/**'
			],
			// Files (JS / CSS / etc.) directly copy to destination folder
			files: [
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
			// Frontend Website - 3rd party libraries
			frontend_lib: [
				dir_bower + '/bootstrap/dist/css/bootstrap.min.css',
				dir_bower + '/font-awesome/css/font-awesome.min.css',
			],
			// Admin Panel - AdminLTE theme
			adminlte: [
				dir_bower + '/admin-lte/bootstrap/css/bootstrap.min.css',
				dir_bower + '/admin-lte/dist/css/AdminLTE.min.css',
				dir_bower + '/admin-lte/dist/css/skins/_all-skins.min.css',
			],
			// Admin Panel - 3rd party libraries
			admin_lib: [
				dir_bower + '/font-awesome/css/font-awesome.min.css',
				dir_bower + '/ionicons/css/ionicons.min.css',
				dir_bower + '/spectrum/spectrum.css'
			]
		},
		dest: {
			frontend: 	dir_dist + '/frontend',
			admin: 		dir_dist + '/admin'
		},
		dest_file: {
			frontend_lib: 	'lib.min.css',
			adminlte: 		'adminlte.min.css',
			admin_lib: 		'lib.min.css'
		},
		options: {
			advanced: true,	// set "false" for faster operation, but slightly larger output files
			keepSpecialComments: 0
		}
	},

	// Task: compile SASS files (and concat with CSS files)
	// Plugin: gulp-sass (https://github.com/dlmanning/gulp-sass)
	sass: {
		src: {
			// Frontend Website
			frontend: [
				// Main SASS file
				dir_asset + '/sass/frontend.scss',

				// Bootstrap examples (http://getbootstrap.com/getting-started/#examples)
				// Comment this to remove preset styles
				dir_asset + '/css/bootstrap-examples/sticky-footer-navbar.css',

				// Custom CSS file  (recommended to avoid this)
				dir_asset + '/css/frontend.css'
			],
			// Admin Panel
			admin: [
				// Main SASS file
				dir_asset + '/sass/admin.scss',

				// Custom CSS file (recommended to avoid this)
				dir_asset + '/css/admin.css'
			]
		},
		dest: {
			frontend: 	dir_dist + '/frontend',
			admin: 		dir_dist + '/admin'
		},
		dest_file: {
			frontend: 	'app.min.css',
			admin: 		'app.min.css'
		},
		options: {
			outputStyle: 'compressed'
		}
	},

	// Task: concat and minify (uglify) JS files
	// Plugin: gulp-uglify (https://github.com/terinjokes/gulp-uglify)
	uglify: {
		src: {
			// Frontend Website - 3rd party libraries
			frontend_lib: [
				dir_bower + '/jquery/dist/jquery.min.js',
				dir_bower + '/bootstrap/dist/js/bootstrap.min.js',
			],
			// Frontend Website - custom scripts
			frontend: [
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
			// Admin Panel - 3rd party libraries
			admin_lib: [
				dir_bower + '/Sortable/Sortable.min.js',
				dir_bower + '/spectrum/spectrum.js',
			],
			// Admin Panel - custom scripts
			admin: [
				dir_asset + '/js/admin.js'
			]
		},
		dest: {
			frontend: 		dir_dist + '/frontend',
			admin: 			dir_dist + '/admin'
		},
		dest_file: {
			frontend_lib: 	'lib.min.js',
			frontend: 		'app.min.js',
			adminlte: 		'adminlte.min.js',
			admin_lib:		'lib.min.js',
			admin: 			'app.min.js',
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