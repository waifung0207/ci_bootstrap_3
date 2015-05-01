<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Admin_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
		// Login form
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form('admin/login');
		$form->add_text('username', '', 'Username', 'admin');
		$form->add_password('password', '', 'Password', 'admin');
		$form->add_submit('Sign In', 'primary', TRUE);

		if ( !empty($this->input->post()) )
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ( $form->validate() )
			{
				// passed validation
				$this->load->library('auth_lib');
				$user = $this->auth_lib->login($this->mSite, $username, $password);

				if ( empty($user) )
				{
					// failed
					$form->add_custom_error('Invalid Login');
				}
				else
				{
					// success
					$this->session->set_userdata('admin_user', $user);
					redirect('admin');
				}
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('login', 'empty');
	}
}
