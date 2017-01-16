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
	'site_name' => '',

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

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
		),
		'foot'	=> array(
											'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
											'assets/dist/pe/js/common.js',
											'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'           			
											
											
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(

			'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
			'assets/dist/pe/css/pe_custome.css'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => 'body_pe',	
	
	// Multilingual settings
	/*'languages' => array(
		'default'		=> 'en',
		'autoload'		=> array('general'),
		'available'		=> array(
			'en' => array(
				'label'	=> 'English',
				'value'	=> 'english'
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
	),*/

	// Google Analytics User ID
	'ga_id' => '',

	// Menu items
	'menu' => array(

		'about' => array(
			'name'		=> 'About',
			'url'		=> '',
		),
		'services' => array(
			'name'		=> 'Services',
			'url'		=> '',
		),
		'samples' => array(
			'name'		=> 'Samples',
			'url'		=> '',
		),
		'order' => array(
			'name'		=> 'Order',
			'url'		=> '',
		),
		'support' => array(
			'name'		=> 'Support',
			'url'		=> '',
		),
	),

	// Login page
	'login_url' => 'login',

	// Restricted pages
	'page_auth' => array(
	),

	// Email config
	'email' => array(
		'from_email'		=> '',
		'from_name'			=> '',
		'subject_prefix'	=> '',
		
		// Mailgun HTTP API
		'mailgun_api'		=> array(
			'domain'			=> '',
			'private_api_key'	=> ''
		),
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_frontend';