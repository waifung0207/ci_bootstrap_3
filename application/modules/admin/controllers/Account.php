<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin_Controller {

	/**
	 * Account Settings
	 */
	public function index()
	{
		$this->mTitle = "Account Settings";

		// Update Info form
		$this->load->library('form_builder');
		$form1 = $this->form_builder->create_form('admin/account/update_info');
		$form1->set_form_url('admin/account');
		$form1->add_text('full_name', 'Full Name', 'Username', $this->mUser->full_name);
		$form1->add_submit('Update');
		$this->mViewData['form1'] = $form1;

		// Change Password form
		$form2 = $this->form_builder->create_form('admin/account/change_password');
		$form2->set_form_url('admin/account');
		$form2->add_password('new_password', 'New Password');
		$form2->add_password('retype_password', 'Retype Password');
		$form2->add_submit();
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
			set_alert('success', 'Successfully updated account info.');
			$this->mUser->full_name = $this->input->post('full_name');
			$this->session->set_userdata('admin_user', $this->mUser);
		}
		else
		{
			set_alert('danger', 'Failed to update info.');
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
		{
			set_alert('success', 'Successfully changed password.');
		}
		else
		{
			set_alert('danger', 'Failed to changed password.');
		}

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
