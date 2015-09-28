<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller,
// instead of Admin_Controller since no authentication is required
class Login extends MY_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$this->load->model('admin_user_model', 'users');
			$user = $this->users->login($username, $password);

			if ( empty($user) )
			{
				// login failed
				$this->system_message->set_error('Invalid Login');
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
		$this->mViewData['body_class'] = 'login-page';
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render('login', 'empty');
	}
}
