<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example to override functions from API_Controller
 */
class Demo extends API_Controller {

	// [GET] /demo
	protected function get_items()
	{
		$data = array(
			array('id' => 1, 'name' => 'Demo 1'),
			array('id' => 2, 'name' => 'Demo 2'),
			array('id' => 3, 'name' => 'Demo 3'),
		);
		$this->to_response($data);
	}

	// [GET] /demo/{id}
	protected function get_item($id)
	{
		$data = array('id' => $id, 'name' => 'Demo '.$id);
		$this->to_response($data);
	}
	
	// [GET] /demo/{parent_id}/{subitem}
	protected function get_subitems($parent_id, $subitem)
	{
		$data = array(
			array('id' => 1, 'name' => 'Parent '.$parent_id.' - '.$subitem.' 1'),
			array('id' => 2, 'name' => 'Parent '.$parent_id.' - '.$subitem.' 2'),
			array('id' => 3, 'name' => 'Parent '.$parent_id.' - '.$subitem.' 3'),
		);
		$this->to_response($data);
	}

	// [POST] /demo
	protected function create_item()
	{
		$params = elements(array('filter', 'valid', 'fields', 'here'), $this->mParams);
		$this->to_created();
	}

	// [PUT] /demo/{id}
	protected function update_item($id)
	{
		$params = elements(array('filter', 'valid', 'fields', 'here'), $this->mParams);
		$this->to_accepted();
	}

	// [DELETE] /demo/{id}
	protected function remove_item($id)
	{
		$this->to_accepted();
	}
}
