<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends API_Controller {

	public function index()
	{
		$data = array('id' => 1, 'name' => 'Dummy user');
		$this->to_response($data);
	}
}
