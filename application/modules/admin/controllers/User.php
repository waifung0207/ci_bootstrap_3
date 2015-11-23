<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	/**
	 * User Management page (e.g. CRUD operations)
	 */
	public function index()
	{
		$crud = $this->crud->generate_crud('users');
		$this->crud->unset_fields(array('ip_address', 'salt', 'forgotten_password_code', 'forgotten_password_time', 'remember_code', 'created_on', 'last_login'));
		$crud->columns('groups', 'username', 'email', 'first_name', 'last_name', 'active');
		$crud->set_relation_n_n('groups', 'users_groups', 'groups', 'user_id', 'group_id', 'name', NULL, array('name' => 'members'));
		$crud->callback_field('last_login', array($this, 'callback_timestamp'));
		$crud->callback_field('created_on', array($this, 'callback_timestamp'));

		$this->mTitle = 'Users';
		$this->mViewData['crud_data'] = $this->crud->render();
		$this->render('crud');
	}
}
