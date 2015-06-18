<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function index()
	{
		$data = array('msg' => 'To be completed');
		$this->render_json($data);
	}
}
