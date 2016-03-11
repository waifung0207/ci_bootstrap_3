<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Site (by CI Bootstrap 3)
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views when calling 
| MY_Controller's render() function. 
|
| Each of them can be overrided from child controllers.
|
*/

$config['site'] = array(

	// Site name
	'name' => 'API Site',

	// Default page title
	// (set empty then MY_Controller will automatically generate one based on controller / action)
	'title' => '',

	// Default meta data (name => content)
	'meta'	=> array(
		'author'		=> 'Michael Chan (https://github.com/waifung0207)',
		'description'	=> 'API Documentation'
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

	// Raw PHP Headers (e.g. enable CORS or not) to send at page start
	'headers' => array(
		'Access-Control-Allow-Origin: *',
		'Access-Control-Request-Method: GET, POST, PUT, DELETE, OPTIONS',
		'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization',
	),

	// For debug purpose (available only when ENVIRONMENT = 'development')
	'debug' => array(
		'view_data'		=> FALSE,	// whether to display MY_Controller's mViewData at page end
		'profiler'		=> FALSE,	// whether to display CodeIgniter's profiler at page end
	),
);