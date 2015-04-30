<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo only
 */
class Example extends Frontend_Controller {

	public function index()
	{
		$this->mTitle = 'Example';
		$this->_push_breadcrumb('Examples');
		$this->_render('demo');
	}

	public function demo($demo_id)
	{
		$this->mViewData['demo_id'] = $demo_id;
		
		$this->mTitle = 'Example '.$demo_id;
		$this->_push_breadcrumb('Example', 'example');
		$this->_push_breadcrumb('Example '.$demo_id);
		$this->_render('demo');
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
