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
	'name' => 'CI Bootstrap 3 Demo',

	// Default page title
	// (set empty then MY_Controller will automatically generate one based on controller / action)
	'title' => '',

	// Default meta data (name => content)
	'meta'	=> array(
		'author'		=> 'Michael Chan (https://github.com/waifung0207)',
		'description'	=> 'CI Bootstrap 3'
	),

	// Default scripts to embed at page head / end
	'scripts' => array(
		'head'	=> array(
		),
		'foot'	=> array(
			'assets/dist/app.min.js'
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/app.min.css'
		)
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
		'element_demo' => array(
			'name'		=> 'Elements',
			'url'		=> 'element_demo',
			'children'  => array(
				'Carousel'				=> 'element_demo/carousel',
				'Pagination'			=> 'element_demo/pagination',
				'Item 1'				=> 'element_demo/item/1',
				'Item 2'				=> 'element_demo/item/2',
				'Item 3'				=> 'element_demo/item/3',
			)
		),
		'form_demo' => array(
			'name'		=> 'Forms',
			'url'		=> 'form_demo',
			'children'  => array(
				'Form (Basic)'			=> 'form_demo/basic',
				'Form (Bootstrap 3)'	=> 'form_demo/bs3',
			)
		),
		'blog_demo' => array(
			'name'		=> 'Blog',
			'url'		=> 'blog_demo',
			'children'  => array(
				'Posts'		=> 'blog_demo/posts',
			)
		),
		'auth_demo' => array(
			'name'		=> 'Auth',
			'url'		=> 'auth_demo',
			'children'  => array(
				'Sign Up'	=> 'auth_demo/sign_up',
				'Login'		=> 'auth_demo/login',
			)
		),
		'account_demo' => array(
			'name'		=> 'Account',
			'url'		=> 'account_demo',
		),
		'error_demo' => array(
			'name'		=> '404 Error',
			'url'		=> 'non_existed',
		),
	),

	// default page when redirect non-logged-in user
	'login_url' => 'demo_frontend/auth_demo/login',

	// restricted pages to specific groups of users, which will affect sidemenu item as well
	// pages out of this array will have no restriction
	'page_auth' => array(
	),
	
	// For debug purpose (available only when ENVIRONMENT = 'development')
	'debug' => array(
		'view_data'		=> FALSE,	// whether to display MY_Controller's mViewData at page end
		'profiler'		=> FALSE,	// whether to display CodeIgniter's profiler at page end
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_demo_frontend';