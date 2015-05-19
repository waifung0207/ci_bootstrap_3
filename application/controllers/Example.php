<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo only
 */
class Example extends Frontend_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_builder');
		$this->mTitle = humanize($this->mAction);
		$this->_push_breadcrumb('Example');
		$this->_push_breadcrumb($this->mTitle);
	}

	public function index()
	{
		redirect('example/demo/1');
	}

	public function demo($demo_id)
	{
		$this->mViewData['demo_id'] = $demo_id;
		$this->_render('demo');
	}

	public function form_basic()
	{
		$form = $this->form_builder->create_form('example/form_basic');
		$form->add_text('name', 'Name');
		$form->add_text('email', 'Email');
		$form->add_text('subject', 'Subject');
		$form->add_textarea('message', 'Message');
		$form->add_recaptcha();
		$form->add_submit();
		
		if ( !empty($this->input->post()) &&  $form->validate() )
		{
			// passed validation
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if ( empty($user_id) )
			{
				// failed
				$form->add_custom_error('Failed to create user');
			}
			else
			{
				// success
				set_alert('success', 'Thanks for registration. We have sent you a email and please follow the instruction to activate your account.');
				redirect('account/login');
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->_render('example/form_basic');
	}
	
	public function form_advanced()
	{
		// Required for reCAPTCHA
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';

		$form = $this->form_builder->create_form('example/form_advanced');
		$form->add_text('name', 'Name');
		$form->add_text('email', 'Email');
		$form->add_text('subject', 'Subject');
		$form->add_textarea('message', 'Message');
		$form->set_horizontal();
		$form->add_submit();

		$this->mViewData['form'] = $form;
		$this->_render('example/form_advanced');
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
