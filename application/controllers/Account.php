<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function signup()
	{
		$this->_render('account/signup');
	}

	public function login()
	{
		$this->_render('account/login');
	}
}
