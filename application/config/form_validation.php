<?php

/**
 * Config file for form validation
 * Reference: http://www.codeigniter.com/user_guide/libraries/form_validation.html
 * (Under section "Creating Sets of Rules")
 */

$config = array(

	// Sign Up
	'auth/sign_up' => array(
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
			'rules'		=> 'required|min_length[8]',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[password]',
		),
	),

	// Login
	'auth/login' => array(
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

	// Forgot Password
	'auth/forgot_password' => array(
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
	),

	// Reset Password
	'auth/reset_password' => array(
		array(
			'field'		=> 'password',
			'label'		=> 'Password',
			'rules'		=> 'required|min_length[8]',
		),
		array(
			'field'		=> 'retype_password',
			'label'		=> 'Retype Password',
			'rules'		=> 'required|matches[password]',
		),
	),

	// Demo only
	'demo/form_basic' => array(
		array(
			'field'		=> 'name',
			'label'		=> 'Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
		array(
			'field'		=> 'subject',
			'label'		=> 'Subject',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'message',
			'label'		=> 'Message',
			'rules'		=> 'required',
		),
	),
	'demo/form_bs3' => array(
		array(
			'field'		=> 'name',
			'label'		=> 'Name',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'email',
			'label'		=> 'Email',
			'rules'		=> 'required|valid_email',
		),
		array(
			'field'		=> 'subject',
			'label'		=> 'Subject',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'message',
			'label'		=> 'Message',
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
