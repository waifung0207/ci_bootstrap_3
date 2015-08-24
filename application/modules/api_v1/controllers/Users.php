<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example to override functions from API_Controller
 * TODO: link with real data
 */
class Users extends API_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'users');
	}

	// [GET] /users
	protected function get_items()
	{
		$params = $this->input->get();
		$data = $this->users->get_many_by($params);
		$this->to_response($data);
	}

	// [GET] /users/{id}
	protected function get_item($id)
	{
		$data = $this->users->get($id);
		$this->to_response($data);
	}
}
