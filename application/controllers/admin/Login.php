<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Admin_Controller {

	public function index()
	{
		$this->_render_admin('login');
	}
}
