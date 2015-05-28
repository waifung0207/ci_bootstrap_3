<?php

/**
 * Config file for form validation
 * Reference: http://www.codeigniter.com/user_guide/libraries/form_validation.html
 * (Under section "Creating Sets of Rules")
 */

$config = array(

	// Login
	'login/index' => array(
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
	),

	// Update Info
	'admin/account/update_info' => array(
		array(
			'field'		=> 'username',
			'label'		=> 'Username',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
	),

	// Change Password
	'admin/account/change_password' => array(
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required',
		),
	),

);