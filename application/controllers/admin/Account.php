<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin_Controller {

	/**
	 * Account Settings
	 */
	public function index()
	{
		$this->mTitle = "Account Settings";
		$this->_push_breadcrumb('Account');

		// Update Info form
		$this->load->library('form_builder');
		$form1 = $this->form_builder->create_form('admin/account/update_info');
		$form1->set_form_url('admin/account');
		$form1->add_text('fullname', 'Full Name', 'Username', 'Administrator');
		$form1->add_submit('Update');
		$this->mViewData['form1'] = $form1;

		// Change Password form
		$form2 = $this->form_builder->create_form('admin/account/change_password');
		$form2->set_form_url('admin/account');
		$form2->add_password('new_password', 'New Password');
		$form2->add_password('retype_password', 'Retype Password');
		$form2->add_submit();
		$this->mViewData['form2'] = $form2;

		$this->_render('account');
	}
	
	/**
	 * Submission of Update Info form
	 */
	public function update_info()
	{
		// TODO: update database
		redirect('admin/account');
	}

	/**
	 * Submission of Change Password form
	 */
	public function change_password()
	{
		// TODO: update database
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
