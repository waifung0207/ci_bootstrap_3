<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views when calling 
| MY_Controller's render() function. 
|
| Most of them can be overrided from child controllers, includes:
| 	- $this->mSiteName
| 	- $this->mPageTitlePrefix
| 	- $this->mPageTitle
| 	- $this->mBodyClass
| 	- $this->mMetaData
| 	- $this->mScripts
| 	- $this->mStylesheets
|	- $this->mMenu
| 	- $this->mPageAuth
*/

$config['ci_bootstrap'] = array(

	/*
	| -------------------------------------------------------------------------
	| Common configuration
	| -------------------------------------------------------------------------
	| For both Frontend Website, Admin Panel and API Site
	*/

	// Site name
	'site_name' => 'CI Bootstrap 3',

	// Default page title prefix
	'page_title_prefix' => 'CI Bootstrap 3 - ',

	// Default page title
	// (set empty then MY_Controller will automatically generate one based on controller / action)
	'page_title' => '',

	// Default meta data
	// (name => content)
	'meta_data'	=> array(
		'author'		=> 'Michael Chan (https://github.com/waifung0207)',
		'description'	=> 'CI Bootstrap 3',
		'keywords'		=> 'PHP,CodeIgniter,CRUD'
	),

	// Default scripts to embed at page head or end
	// (position => script array)
	'scripts' => array(
		'head'	=> array(
		),
		'foot'	=> array(
			'assets/dist/app.min.js'
		),
	),

	// Default stylesheets to embed at page head
	// (media => stylesheet array)
	'stylesheets' => array(
		'screen' => array(
			// for screen display
			'assets/dist/app.min.css'
		),
		'print' => array(
			// for print media
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',

	// Multilingual settings (set empty array to disable this)
	'languages' => array(
		'default'		=> 'en',				// to decide which of the "available" languages should be used
		'autoload'		=> array('general'),	// language files to autoload
		'available'		=> array(				// availabe languages with names to display on site (e.g. on menu)
			'en' => array(						// abbr. value to be used on URL, or linked with database fields
				'label'	=> 'English',			// label to be displayed on language switcher
				'value'	=> 'english'			// to match with CodeIgniter folders inside application/language/
			),
			'zh' => array(
				'label'	=> '繁體中文',
				'value'	=> 'traditional-chinese'
			),
			'cn' => array(
				'label'	=> '简体中文',
				'value'	=> 'simplified-chinese'
			),
			'es' => array(
				'label'	=> 'Español',
				'value' => 'spanish'
			)
		)
	),
	
	// Google Analytics User ID
	'ga_id' => 'UA-XXXXXXXX-X',

	// Menu items
	// (or directly update view file: /application/modules/admin/views/_partials/sidemenu.php)
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
			'icon'		=> 'fa fa-home',
		),
		'auth' => array(
			'name'		=> 'Auth',
			'url'		=> 'auth',
			'icon'		=> 'fa fa-users',
			'children'  => array(
				'Login'			=> 'auth/login',
				'Sign Up'		=> 'auth/sign_up',
			)
		),
	),

	// Login page (to redirect non-logged-in users)
	'login_url' => 'auth/login',

	// Restricted pages to specific groups of users, which will affect sidemenu item as well
	// pages out of this array will have no restriction (except required admin user login)
	'page_auth' => array(
		// Example: Frontend Website pages for registered users
		'dashboard'					=> array('members'),
		'account'					=> array('members'),

		// Example: Admin Panel pages for admin users
		'user/create'				=> array('webmaster', 'admin', 'manager'),
		'user/group'				=> array('webmaster', 'admin', 'manager'),
		'panel'						=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'	=> array('webmaster'),
		'panel/admin_user_group'	=> array('webmaster'),
	),

	// Email config (to be used in MY_Email library)
	'email' => array(
		'from_email'		=> 'noreply@email.com',
		'from_name'			=> 'CI Bootstrap',
		'subject_prefix'	=> '[CI Bootstrap] ',

		// Mailgun HTTP API
		'mailgun_api'		=> array(
			'domain'			=> '',
			'private_api_key'	=> ''
		),
	),

	// Debug tools (available only when ENVIRONMENT = 'development')
	'debug' => array(
		'view_data'	=> FALSE,	// whether to display MY_Controller's mViewData at page end
		'profiler'	=> FALSE	// whether to display CodeIgniter's profiler at page end
	),

	/*
	| -------------------------------------------------------------------------
	| Configuration for Admin Panel only
	| -------------------------------------------------------------------------
	*/
	
	// AdminLTE settings
	// (admin user group => configuration, e.g. CSS class for skin)
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-red',
			'admin'		=> 'skin-purple',
			'manager'	=> 'skin-black',
			'staff'		=> 'skin-blue',
		)
	),

	// Useful links to display at bottom of sidemenu (e.g. to pages outside Admin Panel)
	'useful_links' => array(
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'Frontend Website',
			'url'		=> '',
			'target'	=> '_blank',
			'color'		=> 'text-aqua'
		),
		array(
			'auth'		=> array('webmaster', 'admin'),
			'name'		=> 'API Site',
			'url'		=> 'api',
			'target'	=> '_blank',
			'color'		=> 'text-orange'
		),
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'staff'),
			'name'		=> 'Github Repo',
			'url'		=> CI_BOOTSTRAP_REPO,
			'target'	=> '_blank',
			'color'		=> 'text-green'
		),
	),

	/*
	| -------------------------------------------------------------------------
	| Configuration for API Site only
	| -------------------------------------------------------------------------
	*/
	
	// Raw PHP Headers (e.g. enable CORS or not) to send at page start
	'headers' => array(
		'Access-Control-Allow-Origin: *',
		'Access-Control-Request-Method: GET, POST, PUT, DELETE, OPTIONS',
		'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization',
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/

// Allow different modules to use different login sessions
$config['sess_cookie_name'] = 'ci_session_example';