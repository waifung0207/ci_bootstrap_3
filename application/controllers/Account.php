<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('user_model', 'users');

		// CI Bootstrap libraries
		$this->load->library('form_builder');
		$this->load->library('system_message');

		$this->push_breadcrumb('Account');
		$this->mViewData['enable_breadcrumb'] = TRUE;
	}

	/**
	 * Account - Sign Up
	 */
	public function sign_up()
	{
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$additional_fields = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			);
			$user_id = $this->users->sign_up($email, $password, $additional_fields);

			if ($user_id)
			{
				// success
				$this->system_message->set_success('Thanks for registration. We have sent you a email and please follow the instruction to activate your account.');
				redirect('account/login');
			}
			else
			{
				// failed
				$this->system_message->set_error('Failed to create user');
				refresh();
			}
		}

		// display form
		$this->mViewData['form'] = $form;
		$this->render('account/sign_up');
	}

	/**
	 * Account - Activation
	 */
	public function activate()
	{
		$code = $this->input->get_post('code');
		$activated = $this->users->activate($code);

		if ($activated)
			$this->system_message->set_success('Successfully activated. Please login to your account.');
		else
			$this->system_message->set_error('Invalid code.');

		redirect('account/login');
	}

	/**
	 * Account - Login
	 */
	public function login()
	{
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$user = $this->users->login($email, $password);

			if (empty($user))
			{
				// success - save user to session
				$this->session->set_userdata('user', $user);
				$this->system_message->set_success('Login success.');

				// TODO: redirect to user dashboard
				redirect('account/login');
			}
			else
			{
				// failed
				$this->system_message->set_error('Invalid login');
				refresh();
			}
		}

		// display form
		$this->mViewData['form'] = $form;
		$this->render('account/login');
	}

	/**
	 * Account - Forgot Password
	 */
	public function forgot_password()
	{
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$email = $this->input->post('email');
			$result = $this->users->forgot_password($email);

			if ($result)
			{
				// success
				$this->system_message->set_success('A email has been sent to you, please check your inbox and follow instruction to reset your password.');
				redirect('account/login');
			}
			else
			{
				// failed
				$this->system_message->set_error('Forgot password failed');
				refresh();
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->render('account/forgot_password');
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
			$this->system_message->set_error('Invalid Code');
			redirect('account/login');
		}

		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$result = $this->users->reset_password($code, $password);

			if ($result)
			{
				// success
				$this->system_message->set_success('Your password has been reset. Please login again.');
				redirect('account/login');
			}
			else
			{
				// failed
				$this->system_message->set_error('Reset password failed');
				refresh();
			}
		}

		$this->mViewData['form'] = $form;
		$this->mViewData['code'] = $code;
		$this->render('account/reset_password');
	}
}
