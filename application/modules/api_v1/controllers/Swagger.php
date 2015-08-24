<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Swagger extends API_Controller {
	
	// Output Swagger JSON
	public function index()
	{
		// basic setup
		$this->load->library('swagger_generator');
		$s = $this->swagger_generator->init('CI Bootstrap 3 API', 'API documentation for CI Bootstrap 3');
		//$s->add_contact('info@email.com', 'CI Bootstrap 3');
		
		// Tags (like "group" for endpoints)
		$s->add_tag('user', '(For demo only)');

		// Definitions
		$s->add_definition('User', array(
			'id'				=> array('type' => 'INT', 'description' => 'Unique ID'),
			'name'				=> array('type' => 'STRING'),
		));

		// Path - [GET] /users
		$p = $s->add_path('GET', '/users', 'user');
		$p->mSummary = 'Get list of users';
		$p->add_response('User', TRUE);
		$p->add_query_param('status', 'Filter by user status', 'ARRAY_STRING', ['active', 'hidden']);
		$p->add_query_param('tags', 'Filter by user tags', 'ARRAY_STRING');

		// Path - [GET] /users/{id}
		$p = $s->add_path('GET', '/users/{id}', 'user');
		$p->mSummary = 'Get user info';
		$p->add_path_param('id', 'Record ID', 'INT', TRUE);
		$p->add_response('User');
		$p->add_error(404, 'Record not found');

		$s->render();
	}
}
