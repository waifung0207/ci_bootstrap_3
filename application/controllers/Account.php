<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('ion_auth');

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
			$identity = $this->input->post('email');
			$password = $this->input->post('password');
			$additional_data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			);

			// create user (default group as "members")
			if ($this->ion_auth->register($identity, $password, $identity, $additional_data))
			{
				// success
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
				redirect('account/login');
			}
			else
			{
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				refresh();
			}
		}

		// display form
		$this->mViewData['form'] = $form;
		$this->render('account/sign_up');
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
			$identity = $this->input->post('email');
			$password = $this->input->post('password');
			$remember = ($this->input->post('remember')=='on');

			if ($this->ion_auth->login($identity, $password, $remember))
			{
				// success
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);

				// TODO: redirect to user dashboard
				redirect('account/login');
			}
			else
			{
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				refresh();
			}
		}

		// display form
		$this->mViewData['form'] = $form;
		$this->render('account/login');
	}

	/**
	 * Account - Logout
	 */
	public function logout()
	{
		$this->ion_auth->logout();	
		redirect();
	}

	/**
	 * Account - Activation
	 */
	public function activate()
	{
		// To be integrated with Ion Auth
		redirect('account/login');
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
			$identity = $this->input->post('email');

			if ( $this->ion_auth->forgotten_password($identity) )
			{
				// success
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
				redirect('account/login');
			}
			else
			{
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				refresh();
			}
		}

		// display form
		$this->mViewData['form'] = $form;
		$this->render('account/forgot_password');
	}

	/**
	 * Account - Reset Password
	 */
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			redirect('');
		}

		// check whether code is valid
		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			$form = $this->form_builder->create_form();

			if ($form->validate())
			{
				// passed validation
				$identity = $user->email;
				$password = $this->input->post('password');

				// confirm update password
				if ( $this->ion_auth->reset_password($identity, $password) )
				{
					// success
					$messages = $this->ion_auth->messages();
					$this->system_message->set_success($messages);
					redirect('account/login');
				}
				else
				{
					// failed
					$errors = $this->ion_auth->errors();
					$this->system_message->set_error($errors);
					redirect('account/reset_password/' . $code);
				}
			}

			// display form
			$this->mViewData['form'] = $form;
			$this->render('account/reset_password');
		}
		else
		{
			// code invalid
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
			redirect('account/forgot_password', 'refresh');
		}
	}
}
