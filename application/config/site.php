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
				'value'	=> 'traditional-chinese',
			),
			'cn' => array(
				'label'	=> '简体中文',
				'value'	=> 'simplified-chinese',
			),
		),
		'autoload'		=> array('general'),	// language files to autoload
	),

	// Google Analytics User ID (UA-XXXXXXXX-X)
	'ga_id' => '',
	
	// Menu items
	// (or directly update view file: applications/views/_partials/navbar.php)
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
		),
		// Demo to add sections with subpages
		'demo' => array(
			'name'		=> 'Demo',
			'url'		=> 'demo',
			'children'  => array(
				'Form (Basic)'			=> 'demo/form_basic',
				'Form (Bootstrap 3)'	=> 'demo/form_bs3',
				'Carousel'				=> 'demo/carousel',
				'Blog Posts'			=> 'demo/blog_posts',
				'Pagination'			=> 'demo/pagination',
				'Item 1'				=> 'demo/item/1',
				'Item 2'				=> 'demo/item/2',
				'Item 3'				=> 'demo/item/3',
				'Custom 404'			=> 'demo/non_existed',
			)
		),
		// end of demo
		'sign_up' => array(
			'name'		=> 'Sign Up',
			'url'		=> 'account/sign_up',
		),
		'login' => array(
			'name'		=> 'Login',
			'url'		=> 'account/login',
		),
	),

	// User authenication (to be completed)
	'auth' => array(

		// Field name for logging in (e.g. email, username)
		'login_field'		=> 'email',

		// Activation settings
		'activation'		=> array(
			'enabled'		=> TRUE,
			'url'			=> 'account/activate',
			'email'			=> 'frontend_activation',
			'email_subject'	=> 'Activation',
		),

		// Forgot Password settings
		'forgot_password'	=> array(
			'url'			=> 'account/reset_password',
			'email'			=> 'frontend_forgot_password',
			'email_subject'	=> 'Forgot Password',
		),
	),

	// For debug purpose (available only when ENVIRONMENT = 'development')
	'debug' => array(
		'view_data'		=> FALSE,	// whether to display MY_Controller's mViewData at page end
		'profiler'		=> FALSE,	// whether to display CodeIgniter's profiler at page end
	),
);