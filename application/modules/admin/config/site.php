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
	// (set empty then MY_Controller will automatically generate one based on controller / action)
	'title' => '',

	// Default meta data (name => content)
	'meta'	=> array(
		'author'		=> 'Michael Chan (https://github.com/waifung0207)',
		'description'	=> 'CI Bootstrap 3 Admin Panel'
	),

	// Default scripts to embed at page head / end
	'scripts' => array(
		'head'	=> array(
			'assets/dist/adminlte.min.js',
			'assets/dist/admin.min.js'
		),
		'foot'	=> array(
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/adminlte.min.css',
			'assets/dist/admin.min.css'
		)
	),

	// Multilingual settings (set empty array to disable this)
	'multilingual' => array(),

	// AdminLTE settings
	'adminlte' => array(
		'webmaster'	=> array('skin' => 'skin-red'),
		'admin'		=> array('skin' => 'skin-purple'),
		'manager'	=> array('skin' => 'skin-black'),
		'staff'		=> array('skin' => 'skin-blue')
	),

	// Menu items which support icon fonts, e.g. Font Awesome
	// (or directly update view file: /application/modules/admin/views/_partials/sidemenu.php)
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
			'children'  => array(
				'List'			=> 'user',
				'Create'		=> 'user/create',
				'User Groups'	=> 'user/group',
			)
		),
		'demo' => array(
			'name'		=> 'Demo',
			'url'		=> 'demo',
			'icon'		=> 'ion ion-load-b',	// use Ionicons (instead of FontAwesome)
			'children'  => array(
				'AdminLTE'			=> 'demo/adminlte',
				'Blog Posts'		=> 'demo/blog_post',
				'Blog Categories'	=> 'demo/blog_category',
				'Blog Tags'			=> 'demo/blog_tag',
				'Cover Photos'		=> 'demo/cover_photo',
				'Pagination'		=> 'demo/pagination',
				'Sortable'			=> 'demo/sortable',
				'Item 1'			=> 'demo/item/1',
				'Item 2'			=> 'demo/item/2',
				'Item 3'			=> 'demo/item/3',
			)
		),
		'panel' => array(
			'name'		=> 'Admin Panel',
			'url'		=> 'panel',
			'icon'		=> 'fa fa-cog',
			'children'  => array(
				'Admin Users'			=> 'panel/admin_user',
				'Create Admin User'		=> 'panel/admin_user_create',
				'Admin User Groups'		=> 'panel/admin_user_group',
			)
		),
		'logout' => array(
			'name'		=> 'Sign Out',
			'url'		=> 'panel/logout',
			'icon'		=> 'fa fa-sign-out',
		)
	),

	// default page when redirect non-logged-in user
	'login_url' => 'admin/login',

	// restricted pages to specific groups of users, which will affect sidemenu item as well
	// pages out of this array will have no restriction (except required admin user login)
	'page_auth' => array(
		'user/create'				=> array('webmaster', 'admin', 'manager'),
		'user/group'				=> array('webmaster', 'admin', 'manager'),
		'panel'						=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'	=> array('webmaster'),
		'panel/admin_user_group'	=> array('webmaster'),
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

	// For debug purpose (available only when ENVIRONMENT = 'development')
	'debug' => array(
		'view_data'		=> FALSE,	// whether to display MY_Controller's mViewData at page end
		'profiler'		=> FALSE,	// whether to display CodeIgniter's profiler at page end
	),
);