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

	// User groups that is allowed to login Admin Panel;
	// each group will have different AdminLTE skin
	'authorized_groups' => array(
		'admin'		=> array('adminlte_skin' => 'skin-purple'),
		'manager'	=> array('adminlte_skin' => 'skin-black'),
		'staff'		=> array('adminlte_skin' => 'skin-blue')
	),

	// Menu items which support icon fonts, e.g. Font Awesome
	// (or directly update view file: /application/modules/admin/views/_partials/sidemenu.php)
	'menu' => array(
		'home' => array(
			'groups'	=> array('admin', 'manager', 'staff'),
			'name'		=> 'Home',
			'url'		=> '',
			'icon'		=> 'fa fa-home',
		),
		'user' => array(
			'groups'	=> array('admin'),
			'name'		=> 'Users',
			'url'		=> 'user',
			'icon'		=> 'fa fa-users',
			'children'  => array(
				'List'		=> 'user',
				'Create'	=> 'user/create',
			)
		),
		'cover_photo' => array(
			'groups'	=> array('admin'),
			'name'		=> 'Cover Photos',
			'url'		=> 'cover_photo',
			'icon'		=> 'fa fa-photo',
		),
		'blog' => array(
			'groups'	=> array('admin'),
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
			'groups'	=> array('admin', 'manager', 'staff'),
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
		'logout' => array(
			'groups'	=> array('admin', 'manager', 'staff'),
			'name'		=> 'Sign Out',
			'url'		=> 'account/logout',
			'icon'		=> 'fa fa-sign-out',
		)
	),

	// Useful links to display at bottom of sidemenu (e.g. to pages outside Admin Panel)
	'useful_links' => array(
		array(
			'groups'	=> array('admin', 'manager', 'staff'),
			'name'		=> 'Frontend Website',
			'url'		=> '',
			'target'	=> '_blank',
			'color'		=> 'text-aqua'
		),
		array(
			'groups'	=> array('admin'),
			'name'		=> 'API Site',
			'url'		=> 'api',
			'target'	=> '_blank',
			'color'		=> 'text-orange'
		),
		array(
			'groups'	=> array('admin', 'manager', 'staff'),
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