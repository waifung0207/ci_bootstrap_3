<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {

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
		$form1->add_text('fullname', 'Full Name', 'Username', 'Administrator');
		$form1->add_submit('Update');
		$this->mViewData['form1'] = $form1;

		// Change Password form
		$form2 = $this->form_builder->create_form('admin/account/change_password');
		$form2->add_password('new_password', 'New Password');
		$form2->add_password('retype_password', 'Retype Password');
		$form2->add_submit();
		$this->mViewData['form2'] = $form2;

		$this->_render('account');
	}
	
	/**
	 * Logout user
	 */
	public function logout()
	{
		// TODO: clear session data then logout
		redirect('admin/login');
	}
}
