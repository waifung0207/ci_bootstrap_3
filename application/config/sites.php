<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Sites
| -------------------------------------------------------------------------
| This file lets you define site-specific values
|
*/

$config['sites'] = array(

	/**
	 * Frontend Website
	 */
	'frontend' => array(

		'autoload' => array(
			'libraries'	=> array('database'),
			'helpers'	=> array('session', 'inflector'),
			'models'	=> array(
				//'User_model'	=> 'users',
			),
		),

		'meta' => array(
			'title_prefix'	=> 'Frontend Website - ',
			'custom'		=> array(
				'author'		=> 'Michael Chan (waifung.hk)',
				'description'	=> 'Frontend Website description'
			)
		),

		'assets' => array(
			'stylesheets' => array(
				dist_url('app.min.css'),
			),
			'scripts_head'	=> array(
			),
			'scripts_foot'	=> array(
				dist_url('app.min.js'),
			),
		),
		
		// menu items, with demonstration of localization
		'menu' => array(
			'home' => array(
				'name'		=> lang('home'),
				'url'		=> '',
			),
			// Example to add sections with subpages
			'example' => array(
				'name'		=> lang('example'),
				'url'		=> 'example',
				'children'  => array(
					'Form Basic'			=> 'example/form_basic',
					'Form Advanced'			=> 'example/form_advanced',
					lang('example').' 1'	=> 'example/demo/1',
					lang('example').' 2'	=> 'example/demo/2',
					lang('example').' 3'	=> 'example/demo/3',
				)
			),
			// end of example
			'sign_up' => array(
				'name'		=> lang('sign_up'),
				'url'		=> 'account/sign_up',
			),
			'login' => array(
				'name'		=> lang('login'),
				'url'		=> 'account/login',
			),
		),
	),

	/**
	 * Admin Panel
	 */
	'admin' => array(

		'autoload' => array(
			'libraries'	=> array('database'),
			'helpers'	=> array('session', 'inflector'),
			'models'	=> array(),
		),

		'meta' => array(
			'title_prefix'	=> 'Admin Panel - ',
			'custom'		=> array(
				'author'		=> 'Michael Chan (waifung.hk)',
				'description'	=> 'Admin Panel description'
			)
		),

		'assets' => array(
			'stylesheets'	=> array(
				dist_url('admin.min.css'),
			),
			'scripts_head'	=> array(
				dist_url('admin.min.js'),
			),
			'scripts_foot'	=> array(),
		),

		'menu' => array(			
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
			'admin_user' => array(
				'name'		=> 'Admin Users',
				'url'		=> 'admin_user',
				'icon'		=> 'fa fa-cogs'
			),*/
			'logout' => array(
				'name'		=> 'Sign Out',
				'url'		=> 'account/logout',
				'icon'		=> 'fa fa-sign-out',
			),
		),
	),

	/**
	 * API Site
	 */
	'api' => array(

		'autoload' => array(
			'libraries'	=> array(),
			'helpers'	=> array(),
			'models'	=> array(),
		),
	),

);