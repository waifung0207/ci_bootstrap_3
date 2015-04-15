<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * User Management page (e.g. CRUD operations)
	 */
	public function index()
	{
		$crud = $this->_init_crud('users');
		$crud->unset_fields('password', 'activation_code', 'forgot_password_code', 'forgot_password_time', 'created_at');
		$crud->columns('role', 'email', 'first_name', 'last_name', 'active', 'created_at');
		
		$this->mViewData['crud_data'] = $crud->render();
		$this->_render_admin('crud');
	}
}
