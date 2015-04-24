<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
		$this->load->library('form_validation');

		if ( !empty($this->input->post()) )
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ( $this->form_validation->run('admin/login') )
			{
				// success
				$this->load->library('auth');
				if ( $this->auth->login_admin($username, $password) )
				{
					redirect('admin');
				}
			}
		}

		// Login form
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form('admin/login');
		$form->add_text('username', '', 'Username', 'admin');
		$form->add_password('password', '', 'Password', 'admin');
		$form->add_submit('Sign In', 'primary', TRUE);
		$this->mViewData['form'] = $form;

		// display form when no POST data, or validation failed
		$this->_render('login', 'empty', 'login-page');
	}
}
