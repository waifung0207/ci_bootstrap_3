<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Authentication Settings
| -------------------------------------------------------------------
| Configuration of user authentication
| */

$config['auth'] = array(

	// Frontend Website
	'frontend' => array(

		// Field name for logging in (e.g. email, username)
		'login_field'		=> 'email',

		// Activation settings
		'activation'		=> array(
			'enabled'		=> TRUE,
			'url'			=> 'account/activate',
			'email'			=> 'frontend_activation',
			'email_subject'	=> 'Activation',
		),

		// Forgot Password settings
		'forgot_password'	=> array(
			'url'			=> 'account/reset_password',
			'email'			=> 'frontend_forgot_password',
			'email_subject'	=> 'Forgot Password',
		),
	),

	// Admin Panel
	'admin' => array(

		// Field name for logging in (e.g. email, username)
		'login_field'		=> 'username',

		// Reset Password settings
		/*
		'reset_password'	=> array(
			'enabled'		=> TRUE,
			'email'			=> 'reset_password',
		),*/
	),
);
