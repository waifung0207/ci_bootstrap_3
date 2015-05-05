<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	/**
	 * User Management page (e.g. CRUD operations)
	 */
	public function index()
	{
		$this->load->library('crud');
		$crud = $this->crud->generate_crud('users');
		$crud->unset_fields('password', 'activation_code', 'forgot_password_code', 'forgot_password_time', 'created_at');
		$crud->columns('group_id', 'email', 'first_name', 'last_name', 'active', 'created_at');
		$crud->set_relation('group_id', 'user_groups', 'name');
		
		$this->mViewData['crud_data'] = $crud->render();
		
		$this->_push_breadcrumb('User');
		$this->_render('crud');
	}
}
