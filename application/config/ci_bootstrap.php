<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views when calling 
| MY_Controller's render() function. 
|
| Each of them can be overrided from child controllers.
|
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'CI Bootstrap 3',

	// Default page title prefix
	'page_title_prefix' => 'CI Bootstrap 3 - ',

	// Default page title
	// (set empty then MY_Controller will automatically generate one based on controller / action)
	'page_title' => '',

	// Default meta data (name => content)
	'meta'	=> array(
		'author'		=> 'Michael Chan (https://github.com/waifung0207)',
		'description'	=> 'CI Bootstrap 3'
	),

	// Default scripts to embed at page head or end globally (position => script array)
	'scripts' => array(
		'head'	=> array(
		),
		'foot'	=> array(
			'assets/dist/app.min.js'
		),
	),

	// Default stylesheets to embed at page head globally (media => stylesheet array)
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/app.min.css'
		)
	),
	
	// Multilingual settings - set empty array for single language website
	// (need to match with Multilingual routing from /application/config/routes.php)
	'multilingual' => array(
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
	),

	// default page when redirect non-logged-in user
	'login_url' => '',

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
$config['sess_cookie_name'] = 'ci_session_frontend';