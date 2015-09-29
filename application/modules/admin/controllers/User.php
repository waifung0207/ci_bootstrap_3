<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	/**
	 * User Management page (e.g. CRUD operations)
	 */
	public function index()
	{
		$crud = $this->crud->generate_crud('users');
		$crud->columns('role', 'email', 'first_name', 'last_name', 'status', 'created_at');
		
		$this->mViewData['crud_data'] = $this->crud->render();		
		$this->render('crud');
	}
}
