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
		$crud->columns('group_id', 'email', 'first_name', 'last_name', 'active', 'created_at');
		$crud->set_relation('group_id', 'user_groups', 'name');
		
		$this->mViewData['crud_data'] = $this->crud->render();
		
		$this->_push_breadcrumb('User');
		$this->_render('crud');
	}
}
