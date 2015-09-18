<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo only
 */
class Demo extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_builder');
		$this->push_breadcrumb('Demo');
		$this->mViewData['enable_breadcrumb'] = TRUE;
	}

	public function index()
	{
		redirect('demo/item/1');
	}

	public function item($demo_id)
	{
		$this->mViewData['demo_id'] = $demo_id;
		$this->render('demo/item');
	}

	public function pagination()
	{
		// library from: application/libraries/MY_Pagination.php
		// config from: application/config/pagination.php
		$this->load->library('pagination');
		$this->mViewData['pagination'] = $this->pagination->render(200, 20);
		$this->render('demo/pagination');
	}
	
	// Form without Bootstrap theme
	// See views/demo/form_basic.php for sample code
	public function form_basic()
	{
		// library from: application/libraries/Form_builder.php
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			$this->system_message->set_success('Succcess!');
			refresh();
		}

		$this->mTitle = 'Form (Basic)';
		$this->mViewData['form'] = $form;
		$this->render('demo/form_basic');
	}
	
	public function form_bs3()
	{
		// library from: application/libraries/Form_builder.php
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			$this->system_message->set_success('Succcess!');
			refresh();
		}

		$this->mTitle = 'Form (Bootstrap 3)';
		$this->mViewData['form'] = $form;
		$this->render('demo/form_bs3');
	}

	// Example to work with database and models inherit from MY_Model
	public function db()
	{
		$this->load->database();
		$this->load->model('user_model', 'm');
		
		// set alias so we can use "u" in SELECT clause
		$this->m->set_table_alias('u');

		// Example 1: get multiple user records (with counts)
		$page = empty($this->input->get('p')) ? 1 : $this->input->get('p');
		$this->db->select('u.*, g.name AS group_name');
		$joins[] = array('user_groups AS g', 'u.group_id = g.id');
		$where = array('g.name' => 'member');
		$users = $this->m->get_many_by($where, $page, $joins, TRUE);
		var_dump($users);

		// Example 2: get a user record
		$user_id = 1;
		$this->db->select('u.*, g.name AS group_name');
		$user = $this->m->get_by_id($user_id, $joins);
		var_dump($user);

		// Example 3: get a user record
		$user_id = 1;
		$user_email = $this->m->get_field($user_id, 'email');
		var_dump($user_email);

		// Display profiler for debug purpose
		$this->output->enable_profiler(TRUE);
	}
}
