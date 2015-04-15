<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function signup()
	{
		$this->_push_breadcrumb('Account');
		$this->_push_breadcrumb('Sign Up');
		$this->_render('account/signup');
	}

	public function login()
	{
		$this->_push_breadcrumb('Account');
		$this->_push_breadcrumb('Login');
		$this->_render('account/login');
	}
}
