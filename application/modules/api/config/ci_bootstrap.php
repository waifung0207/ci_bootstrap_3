<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views 
| when calling MY_Controller's render() function. 
| 
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'API Doc',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',
	
	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),

	// Default scripts to embed at page head / end
	'scripts' => array(
		'head'	=> array(
			'assets/api/lib/jquery-1.8.0.min.js',
			'assets/api/lib/jquery.slideto.min.js',
			'assets/api/lib/jquery.wiggle.min.js',
			'assets/api/lib/jquery.ba-bbq.min.js',
			'assets/api/lib/handlebars-2.0.0.js',
			'assets/api/lib/underscore-min.js',
			'assets/api/lib/backbone-min.js',
			'assets/api/swagger-ui.min.js',
			'assets/api/lib/highlight.7.3.pack.js',
			'assets/api/lib/jsoneditor.min.js',
			'assets/api/lib/marked.js',
			'assets/api/lib/swagger-oauth.js',
			
			// Some basic translations (uncomment translator.js and a language when needed)
			//'assets/api/lang/translator.js',
			//'assets/api/lang/en.js',
			//'assets/api/lang/zh-cn.js',
		),
		'foot'	=> array(
		),
	),
	
	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/api/css/typography.css',
			'assets/api/css/reset.css',
			'assets/api/css/screen.css',
		),
		'print' => array(
			'assets/api/css/reset.css',
			'assets/api/css/print.css',
		)
	),

	// Raw PHP Headers
	'headers' => array(
		'Access-Control-Allow-Origin: *',
		'Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS',
		'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, X-API-KEY',
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);