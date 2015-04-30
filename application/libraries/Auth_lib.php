<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to handle user authentication
 */
class Auth_lib {

	protected $CI;
	protected $mConfig;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	/**
	 * Hash & verify password function (compatibility handled by CodeIgniter 3)
	 * Reference: http://www.codeigniter.com/user_guide/general/compatibility_functions.html
	 */

	// Created hashed password
	public function hash_pw($plain_pw)
	{
		return password_hash($plain_pw, PASSWORD_DEFAULT);
	}

	// Verify password
	function verify_pw($plain_pw, $hashed_pw)
	{
		return password_verify($plain_pw, $hashed_pw);
	}

	/**
	 * Authentication
	 */

	// Login user
	public function login($site, $username, $password)
	{
		$CI =& get_instance();
		switch ($site)
		{
			case 'frontend':
				$CI->load->model('user_model', 'users');
				break;
			case 'admin':
				$CI->load->model('admin_user_model', 'users');
				break;
			default:
				return FALSE;
		}
		
		$where = array(
			'username'	=> $username,
			'active'	=> 1
		);
		$user = $CI->users->get_by($where);

		if ( !empty($user) && $this->verify_pw($password, $user->password) )
		{
			// success - return user object without password field
			unset($user->password);
			return $user;
		}

		// failed
		return FALSE;
	}

	// Sign out
	public function logout($site)
	{

	}

	// Reset Password operation
	public function reset_password()
	{

	}

	// Forgot Password operation
	public function forgot_password()
	{

	}

}