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
		$this->load->model('admin_user_model', 'admin_users');
		$updated = $this->admin_users->update_info($this->mUser->id, $this->input->post());

		if ($updated)
		{
			$this->system_message->set_success('Successfully updated account info.');
			$this->mUser->full_name = $this->input->post('full_name');
			$this->session->set_userdata('admin_user', $this->mUser);
		}
		else
		{
			$this->system_message->set_error('Failed to update info.');
		}

		redirect('admin/account');
	}

	/**
	 * Submission of Change Password form
	 */
	public function change_password()
	{
		$this->load->model('admin_user_model', 'admin_users');
		$updated = $this->admin_users->change_password($this->mUser->id, $this->input->post('new_password'));

		if ($updated)
			$this->system_message->set_success('Successfully changed password.');
		else
			$this->system_message->set_error('Failed to changed password.');

		redirect('admin/account');
	}
	
	/**
	 * Logout user
	 */
	public function logout()
	{
		// clear session data then logout
		$this->session->unset_userdata('admin_user');
		redirect('admin/login');
	}
}
