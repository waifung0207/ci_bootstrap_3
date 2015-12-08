<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	/**
	 * Account Settings
	 */
	public function index()
	{
		$this->mTitle = "Account Settings";
		
		// Update Info form
		$form1 = $this->form_builder->create_form('admin/account/update_info');
		$this->mViewData['form1'] = $form1;

		// Change Password form
		$form2 = $this->form_builder->create_form('admin/account/change_password');
		$this->mViewData['form2'] = $form2;

		$this->render('account');
	}

	/**
	 * Submission of Update Info form
	 */
	public function update_info()
	{
		//$this->load->model('admin_user_model', 'admin_users');
		//$updated = $this->admin_users->update_info($this->mUser->id, $this->input->post());
		$data = $this->input->post();
		if ($this->ion_auth->update($this->mUser->id, $data))
		{
			//$this->system_message->set_success('Successfully updated account info.');
			//$this->mUser->first_name = $this->input->post('first_name');
			//$this->session->set_userdata('admin_user', $this->mUser);
			$messages = $this->ion_auth->messages();
			$this->system_message->set_success($messages);
		}
		else
		{
			//$this->system_message->set_error('Failed to update info.');
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
		}

		redirect('admin/account');
	}

	/**
	 * Submission of Change Password form
	 */
	public function change_password()
	{
		$data = array('password' => $this->input->post('new_password'));
		if ($this->ion_auth->update($this->mUser->id, $data))
		{
			$messages = $this->ion_auth->messages();
			$this->system_message->set_success($messages);
		}
		else
		{
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
		}

		redirect('admin/account');
	}
	
	/**
	 * Logout user
	 */
	public function logout()
	{
		$this->ion_auth->logout();
		redirect('admin/login');
	}
}
