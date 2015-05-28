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
	'name' => 'CI Bootstrap 3',

	// Default page title
	// (set empty then MY_Controller will automatically generate one according to controller / action)
	'title' => '',

	// Meta data (key-value pairs)
	'meta' => array(
		'author'		=> 'Michael Chan (waifung.hk)',
		'description'	=> 'Site description',
	),

	// Stylesheets files to be included
	'stylesheets' => array(
		'assets/dist/app.min.css',
	),

	// Scripts files to be included:
	// 1. before end of </head>
	// 2. before end of </body>
	'scripts' => array(
		'head' => array(
		),
		'foot' => array(
			'assets/dist/app.min.js'
		),
	),
	
	// Multilingual settings (set empty array to disable this)
	'multilingual' => array(
		'default'		=> 'en',			// to decide which of the "available" languages should be used
		'available'		=> array(			// availabe languages with names to display on site (e.g. on menu)
			'en' => array(					// abbr. value to be used on URL, or linked with database fields
				'label'	=> 'English',		// label to be displayed on language switcher
				'value'	=> 'english',		// to match with CodeIgniter folders inside application/language/
			),
			'zh' => array(
				'label'	=> '繁體中文',
				'value'	=> 'chinese_traditional',
			),
			'cn' => array(
				'label'	=> '简体中文',
				'value'	=> 'chinese_simplified',
			),
		),
		'autoload'		=> array('general'),	// language files to autoload
	),

	// Google Analytics User ID (UA-XXXXXXXX-X)
	'ga_id' => '',

	// Class name assigned to <body>
	'body_class' => '',
	
	// Menu items
	// (or directly update view file: applications/views/_partials/navbar.php)
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
		),
		// Example to add sections with subpages
		'example' => array(
			'name'		=> 'Example',
			'url'		=> 'example',
			'children'  => array(
				'Form Basic'			=> 'example/form_basic',
				'Form Advanced'			=> 'example/form_advanced',
				'Example 1'				=> 'example/demo/1',
				'Example 2'				=> 'example/demo/2',
				'Example 3'				=> 'example/demo/3',
			)
		),
		// end of example
		'sign_up' => array(
			'name'		=> 'Sign Up',
			'url'		=> 'account/sign_up',
		),
		'login' => array(
			'name'		=> 'Login',
			'url'		=> 'account/login',
		),
	),

	// For debug purpose (available only when ENVIRONMENT = 'development')
	'debug' => array(
		'view_data'		=> FALSE,	// whether to display MY_Controller's mViewData at page end
		'profiler'		=> FALSE,	// whether to display CodeIgniter's profiler at page end
	),
);