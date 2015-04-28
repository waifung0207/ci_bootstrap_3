<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Library to handle user authentication
 */
class Auth {

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
	 * Authentication for Frontend Website
	 */

	// Login user
	public function login($username, $password)
	{
		echo 'login';
	}

	// Sign out
	public function logout()
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


	/**
	 * Authentication for Admin Panel
	 */
	
	// Login admin
	public function login_admin($username, $password)
	{
		$CI =& get_instance();
		$CI->db->from('admin_users');
		$CI->db->where('username', $username);
		$CI->db->where('active', 1);
		$query = $CI->db->get();
		$user = $query->first_row();

		if ( !empty($user) && $this->verify_pw($password, $user->password) )
		{
			// success
			unset($user->password);
			return $user;
		}

		// failed
		return NULL;
	}
	
	// Sign out
	public function logout_admin()
	{

	}

}