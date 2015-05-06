<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('inflector');
		$this->load->model('user_model', 'users');

		$this->mTitle = humanize($this->mAction);
		$this->_push_breadcrumb('Account');
		$this->_push_breadcrumb($this->mTitle);
	}

	/**
	 * Account - Sign Up
	 */
	public function sign_up()
	{
		// Required for reCAPTCHA
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';
		
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form('account/sign_up');
		$form->add_text('first_name', 'First Name', TRUE);
		$form->add_text('last_name', 'Last Name', TRUE);
		$form->add_text('email', 'Email', TRUE);
		$form->add_password('password', 'Password', TRUE);
		$form->add_password('retype_password', 'Retype Password', TRUE);
		$form->add_custom_html('<div class="form-group">Have an Account? <a href="account/login">Log In</a></div>');
		$form->add_recaptcha();
		$form->add_submit();

		if ( !empty($this->input->post()) &&  $form->validate() )
		{
			// passed validation
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$additional_fields = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			);
			$user_id = $this->users->sign_up($email, $password, $additional_fields);

			if ( empty($user_id) )
			{
				// failed
				$form->add_custom_error('Failed to create user');
			}
			else
			{
				// success
				set_alert('success', 'Thanks for registration. We have sent you a email and please follow the instruction to activate your account.');
				redirect('account/login');
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('account/form');
	}

	/**
	 * Account - Activation
	 */
	public function activate()
	{
		$code = $this->input->get_post('code');
		$activated = $this->users->activate($code);

		if ($activated)
			set_alert('success', 'Successfully activated. Please login to your account.');
		else
			set_alert('danger', 'Invalid code.');

		redirect('account/login');
	}

	/**
	 * Account - Login
	 */
	public function login()
	{
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form('account/login');
		$form->add_text('email', 'Email');
		$form->add_password('password', 'Password');
		$form->add_custom_html('<div class="form-group">Don\'t have Account? <a href="account/sign_up">Sign Up</a></div>');
		$form->add_custom_html('<div class="form-group"><a href="account/forgot_password">Forgot password?</a></div>');
		$form->add_submit('Login');

		if ( !empty($this->input->post()) &&  $form->validate() )
		{
			// passed validation
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$user = $this->users->login($email, $password);

			if (empty($user))
			{
				// failed
				$form->add_custom_error('Invalid login');
			}
			else
			{
				// success - save user to session
				$this->session->set_userdata('user', $user);
				set_alert('success', 'Login success.');

				// TODO: redirect to user dashboard
				redirect('account/login');
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('account/form');
	}

	/**
	 * Account - Forgot Password
	 */
	public function forgot_password()
	{
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form('account/forgot_password');
		$form->add_text('email', 'Email', TRUE);
		$form->add_submit();
		
		if ( !empty($this->input->post()) &&  $form->validate() )
		{
			// passed validation
			$email = $this->input->post('email');
			$result = $this->users->forgot_password($email);

			if ($result)
			{
				set_alert('success', 'A email has been sent to you, please check your inbox and follow instruction to reset your password.');
				redirect('account/login');
			}
			else
			{
				$form->add_custom_error('Forgot password failed');
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('account/form');
	}

	/**
	 * Account - Reset Password
	 */
	public function reset_password()
	{
		// skip when code not found or invalid
		$code = $this->input->get_post('code');
		if ( !$this->users->verify_forgot_password_code($code) )
		{
			set_alert('danger', 'Invalid Code');
			redirect('account/login');
		}

		$this->load->library('form_builder');
		$form = $this->form_builder->create_form('account/reset_password');
		$form->add_password('password', 'Password', TRUE);
		$form->add_password('retype_password', 'Retype Password', TRUE);
		$form->add_hidden('code', $code);
		$form->add_submit();

		if ( !empty($this->input->post()) &&  $form->validate() )
		{
			// passed validation
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$result = $this->users->reset_password($code, $password);

			if ($result)
			{
				set_alert('success', 'Your password has been reset. Please login again.');
				redirect('account/login');
			}
			else
			{
				$form->add_custom_error('Reset password failed');
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('account/form');
	}
}
