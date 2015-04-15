<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Menu
| -------------------------------------------------------------------------
| This file lets you define navigation menu items on sidebar.
|
*/

// Frontend Website
$config['menu'] = array(

	'home' => array(
		'name'		=> 'Home',
		'url'		=> '',
	),

	// Example to add sections with subpages
	'example' => array(
		'name'		=> 'Examples',
		'url'		=> 'example',
		'children'  => array(
			'Example 1'		=> 'example/demo/1',
			'Example 2'		=> 'example/demo/2',
			'Example 3'		=> 'example/demo/3',
		)
	),
	// end of example

	'signup' => array(
		'name'		=> 'Sign Up',
		'url'		=> 'account/signup',
	),

	'login' => array(
		'name'		=> 'Login',
		'url'		=> 'account/login',
	),
);


// Admin Panel
$config['menu_admin'] = array(

	'home' => array(
		'name'		=> 'Home',
		'url'		=> '',
		'icon'		=> 'fa fa-home',
	),

	'user' => array(
		'name'		=> 'Users',
		'url'		=> 'user',
		'icon'		=> 'fa fa-users',
	),

	// Example to add sections with subpages
	'example' => array(
		'name'		=> 'Examples',
		'url'		=> 'example',
		'icon'		=> 'fa fa-cog',
		'children'  => array(
			'Example 1'		=> 'example/demo/1',
			'Example 2'		=> 'example/demo/2',
			'Example 3'		=> 'example/demo/3',
		)
	),
	// end of example

	/*
	'backend_user' => array(
		'name'		=> 'Backend Users',
		'url'		=> 'backend_user',
		'icon'		=> 'fa fa-cogs'
	),*/

	'logout' => array(
		'name'		=> 'Sign Out',
		'url'		=> 'account/logout',
		'icon'		=> 'fa fa-sign-out',
	),

);