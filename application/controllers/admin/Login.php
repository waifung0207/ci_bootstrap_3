<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
		if ( !empty($this->input->post()) )
		{
			// TODO: implement authentication logic
			redirect('admin');
		}
		
		$this->_render_admin('login', 'empty', 'login-page');
	}
}
