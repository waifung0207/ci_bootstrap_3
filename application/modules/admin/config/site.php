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
	'name' => 'Admin Panel',

	// Default page title
	// (set empty then MY_Controller will automatically generate one according to controller / action)
	'title' => '',

	// Multilingual settings (set empty array to disable this)
	'multilingual' => array(),

	// AdminLTE settings
	'adminlte' => array(
		'skins' => array(
			// change skin according to login user's role
			'admin'		=> 'skin-purple',
			'staff'		=> 'skin-blue',
		)
	),

	// Menu items which support icon fonts, e.g. Font Awesome
	// (or directly update view file: /application/modules/admin/views/_partials/sidemenu.php)
	'menu' => array(

		// [Admin role]
		'admin' => array(
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
			'cover_photo' => array(
				'name'		=> 'Cover Photos',
				'url'		=> 'cover_photo',
				'icon'		=> 'fa fa-photo',
			),
			'blog' => array(
				'name'		=> 'Blog',
				'url'		=> 'blog',
				'icon'		=> 'fa fa-pencil',
				'children'  => array(
					'Posts'			=> 'blog/post',
					'Categories'	=> 'blog/category',
					'Tags'			=> 'blog/tag',
				)
			),
			'demo' => array(
				'name'		=> 'Demo',
				'url'		=> 'demo',
				'icon'		=> 'ion ion-gear-b',	// use Ionicons (instead of FontAwesome)
				'children'  => array(
					'Pagination'	=> 'demo/pagination',
					'Sortable'		=> 'demo/sortable',
					'Item 1'		=> 'demo/item/1',
					'Item 2'		=> 'demo/item/2',
					'Item 3'		=> 'demo/item/3',
				)
			),
			// end of demo
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

		// [Staff role]
		'staff' => array(
			'home' => array(
				'name'		=> 'Home',
				'url'		=> '',
				'icon'		=> 'fa fa-home',
			),
			'demo' => array(
				'name'		=> 'Demo',
				'url'		=> 'demo',
				'icon'		=> 'ion ion-gear-b',
				'children'  => array(
					'Item 1'		=> 'demo/item/1',
					'Item 2'		=> 'demo/item/2',
					'Item 3'		=> 'demo/item/3',
				)
			),
			'logout' => array(
				'name'		=> 'Sign Out',
				'url'		=> 'account/logout',
				'icon'		=> 'fa fa-sign-out',
			),
		),
	),

	// User authenication (to be completed)
	'auth' => array(
		
		// Field name for logging in (e.g. email, username)
		'login_field'		=> 'username',
		
		// Reset Password settings
		/*
		'reset_password'	=> array(
			'enabled'		=> TRUE,
			'email'			=> 'reset_password',
		),*/
	),

	// For debug purpose (available only when ENVIRONMENT = 'development')
	'debug' => array(
		'view_data'		=> FALSE,	// whether to display MY_Controller's mViewData at page end
		'profiler'		=> FALSE,	// whether to display CodeIgniter's profiler at page end
	),
);