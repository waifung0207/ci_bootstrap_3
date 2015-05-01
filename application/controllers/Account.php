<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Frontend_Controller {

	public function signup()
	{
		$this->_push_breadcrumb('Account');
		$this->_push_breadcrumb('Sign Up');

		// Required for reCAPTCHA
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';

		// Sign Up form
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form('account/signup');
		$form->add_text('first_name', 'First Name');
		$form->add_text('last_name', 'Last Name');
		$form->add_text('email', 'Email');
		$form->add_password('password', 'Password');
		$form->add_password('retype_password', 'Retype Password');
		$form->add_recaptcha('6Lc1MAYTAAAAAOdhZ0qvGMUFuBD-J6fJIP3DvX-b', '6Lc1MAYTAAAAAEARt-nT1En9NBonssoo4vWI12Nl');
		$form->add_submit();

		if ( !empty($this->input->post()) )
		{
			if ( $form->validate() )
			{
				// passed validation
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('account/signup');
	}

	public function login()
	{
		$this->_push_breadcrumb('Account');
		$this->_push_breadcrumb('Login');

		// Login form
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form('account/login');
		$form->add_text('email', 'Email');
		$form->add_password('password', 'Password');
		$form->add_submit('Login');

		if ( !empty($this->input->post()) )
		{
			if ( $form->validate() )
			{
				// passed validation
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('account/login');
	}
}
