<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
	}

	/**
	 * User Management page (e.g. CRUD operations)
	 */
	public function index()
	{
		$crud = $this->crud->generate_crud('users');
		$this->crud->unset_fields(array('ip_address', 'salt', 'forgotten_password_code', 'forgotten_password_time', 'remember_code', 'created_on', 'last_login'));
		$crud->columns('groups', 'username', 'email', 'first_name', 'last_name', 'active');
		$crud->callback_field('last_login', array($this, 'callback_timestamp'));
		$crud->callback_field('created_on', array($this, 'callback_timestamp'));

		// only admin can create all groups of users, and reset user password
		if ($this->ion_auth->in_group('admin'))
		{
			$crud->set_relation_n_n('groups', 'users_groups', 'groups', 'user_id', 'group_id', 'name');
			$crud->add_action('Reset Password', '', 'admin/user/reset_password', 'fa fa-repeat');
		}
		else
		{
			$where = array('name' => 'members');
			$crud->set_relation_n_n('groups', 'users_groups', 'groups', 'user_id', 'group_id', 'name', NULL, $where);
		}
		
		$crud->unset_add();
		$crud->unset_delete();

		$this->mTitle = 'Users';
		$this->mViewData['crud_data'] = $this->crud->render();
		$this->render('crud');
	}

	/**
	 * Create user
	 */
	public function create()
	{
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			// passed validation
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$identity = empty($username) ? $email : $username;
			$additional_data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
			);
			$groups = $this->ion_auth->in_group('admin') ? $this->input->post('groups') : NULL;

			// create user (default group as "members")
			$user = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
			if ($user)
			{
				// success
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
			}
			else
			{
				// failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
			refresh();
		}

		// only "admin" can create all groups of users; otherwise can create "members" only
		if ($this->ion_auth->in_group('admin'))
		{
			$groups = $this->ion_auth->groups()->result();
			$this->mViewData['groups'] = $groups;
			$this->mTitle = 'Create User';
		}
		else
		{
			$this->mTitle = 'Create Member';	
		}

		$this->mViewData['form'] = $form;
		$this->render('user/create');
	}

	/**
	 * Reset password
	 */
	public function reset_password($user_id)
	{
		// only admin can reset user passwords
		$this->verify_auth('admin', 'admin/login');

		$form = $this->form_builder->create_form();
		if ($form->validate())
		{
			// pass validation
			$data = array('password' => $this->input->post('new_password'));
			if ($this->ion_auth->update($user_id, $data))
			{
				$messages = $this->ion_auth->messages();
				$this->system_message->set_success($messages);
			}
			else
			{
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
			}
			refresh();
		}

		$this->load->model('user_model', 'users');
		$target = $this->users->get($user_id);
		$this->mViewData['target'] = $target;

		$this->mViewData['form'] = $form;
		$this->render('user/reset_password');
	}
}
