<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example to override functions from API_Controller
 * TODO: link with real data
 */
class Users extends API_Controller {

	// [GET] /users
	protected function get_items()
	{
		$data = array(
			array('id' => 1, 'name' => 'User 1'),
			array('id' => 2, 'name' => 'User 2'),
			array('id' => 3, 'name' => 'User 3'),
		);
		$this->to_response($data);
	}

	// [GET] /users/{id}
	protected function get_item($id)
	{
		$data = array('id' => $id, 'name' => 'User '.$id);
		$this->to_response($data);
	}
}
