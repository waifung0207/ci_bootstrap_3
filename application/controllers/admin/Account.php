<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	/**
	 * Account Settings
	 */
	public function index()
	{
		$this->mTitle = "Account Settings";
		$this->_render_admin('account');
	}
	
	/**
	 * Logout user
	 */
	public function logout()
	{
		// TODO: clear session data then logout
		redirect('admin/login');
	}
}
