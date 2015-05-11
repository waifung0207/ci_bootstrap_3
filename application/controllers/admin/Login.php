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
		
		if ( !empty($this->input->post()) && $form->validate() )
		{
			// passed validation
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('admin_user_model', 'users');
			$user = $this->users->login($username, $password);

			if ( empty($user) )
			{
				// login failed
				set_alert('danger', 'Invalid Login');
				refresh();
			}
			else
			{
				// login success
				$this->session->set_userdata('admin_user', $user);
				redirect('admin');
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('login', 'empty');
	}
}
