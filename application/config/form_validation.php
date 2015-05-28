<?php

/**
 * Config file for form validation
 * Reference: http://www.codeigniter.com/user_guide/libraries/form_validation.html
 * (Under section "Creating Sets of Rules")
 */

$config = array(

	// Frontend Website - Sign Up
	'account/sign_up' => array(
		array(
			'field'		=> 'first_name',
			'label'		=> 'First Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'last_name',
			'label'		=> 'Last Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email|is_unique[users.email]',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required|min_length[6]',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[password]',
		),
	),

	// Frontend Website - Login
	'account/login' => array(
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required',
		),
	),

	// Frontend Website - Forgot Password
	'account/forgot_password' => array(
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
	),

	// Frontend Website - Reset Password
	'account/reset_password' => array(
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required|min_length[6]',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[password]',
		),
	),

	// Admin Panel - Login
	'admin/login/index' => array(
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

	// Admin Panel - Update Info
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

	// Admin Panel - Change Password
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


/**
 * Google reCAPTCHA settings:
 * https://www.google.com/recaptcha/
 */
$config['recaptcha'] = array(
	'site_key'		=> '6Lc1MAYTAAAAAOdhZ0qvGMUFuBD-J6fJIP3DvX-b',
	'secret_key'	=> '6Lc1MAYTAAAAAEARt-nT1En9NBonssoo4vWI12Nl',
);
