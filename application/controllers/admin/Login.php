<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function index()
	{
		$this->_render('admin/login');
	}
}
