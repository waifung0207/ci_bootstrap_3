<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Demo Controller with Swagger annotations
 * Reference: https://github.com/zircote/swagger-php/
 */
class Demo extends API_Controller {

	/**
	 * @SWG\Get(
	 * 	path="/demo",
	 * 	tags={"demo"},
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Sample result",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Demo"))
	 * 	)
	 * )
	 */
	public function index_get()
	{
		$data = array(
			array('id' => 1, 'name' => 'Demo 1'),
			array('id' => 2, 'name' => 'Demo 2'),
			array('id' => 3, 'name' => 'Demo 3'),
		);
		$this->response($data);
	}

	/**
	 * @SWG\Get(
	 * 	path="/demo/{id}",
	 * 	tags={"demo"},
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Demo ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Sample result",
	 * 		@SWG\Schema(ref="#/definitions/Demo")
	 * 	)
	 * )
	 */
	public function id_get($id)
	{
		$data = array('id' => $id, 'name' => 'Demo '.$id);
		$this->response($data);
	}

	/**
	 * @SWG\Post(
	 * 	path="/demo",
	 * 	tags={"demo"},
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="Created info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/Demo")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function index_post()
	{
		$params = elements(array('filter', 'valid', 'fields', 'here'), $this->post());
		$this->created();
	}

	/**
	 * @SWG\Put(
	 * 	path="/demo/{id}",
	 * 	tags={"demo"},
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Demo ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function id_put($id)
	{
		$params = elements(array('filter', 'valid', 'fields', 'here'), $this->put());
		$this->error_not_implemented();
	}

	/**
	 * @SWG\Delete(
	 * 	path="/demo/{id}",
	 * 	tags={"demo"},
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Demo ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function id_delete($id)
	{
		$this->accepted();
	}
	
	/**
	 * @SWG\Get(
	 * 	path="/demo/{id}/subitem",
	 * 	tags={"demo"},
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="Demo ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Sample result",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Demo"))
	 * 	)
	 * )
	 */
	public function subitem_get($parent_id)
	{
		$data = array(
			array('id' => 1, 'name' => 'Parent '.$parent_id.' - Subitem 1'),
			array('id' => 2, 'name' => 'Parent '.$parent_id.' - Subitem 2'),
			array('id' => 3, 'name' => 'Parent '.$parent_id.' - Subitem 3'),
		);
		$this->response($data);
	}

	/**
	 * @SWG\Get(
	 * 	path="/demo/users",
	 * 	tags={"demo"},
	 * 	summary="List out users",
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="List of users",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/DemoUser"))
	 * 	)
	 * )
	 */
	public function users_get()
	{
		$this->load->model('user_model', 'users');
		$data = $this->users
			->select('id, username, email, active, first_name, last_name')
			->get_all();
		$this->response($data);
	}

	/**
	 * @SWG\Get(
	 * 	path="/demo/user/{id}",
	 * 	tags={"demo"},
	 * 	summary="Look up a user",
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="User ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="User object",
	 * 		@SWG\Schema(ref="#/definitions/DemoUser")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="404",
	 * 		description="Invalid user ID"
	 * 	)
	 * )
	 */
	public function user_get($id)
	{
		$this->load->model('user_model', 'users');
		$data = $this->users
			->select('id, username, email, active, first_name, last_name')
			->get($id);
		$this->response($data);
	}

	/**
	 * @SWG\Post(
	 * 	path="/demo/user",
	 * 	tags={"demo"},
	 * 	summary="Create new user",
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="User info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/DemoUserPost")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function user_post()
	{
		// required fields
		$password = $this->post('password');
		$email = $this->post('email');
		$username = $this->post('email');

		// additional fields
		$additional_data = elements(array('first_name', 'last_name'), $this->post());

		// set user to "members" group
		$group = array('1');

		// proceed to create user
		$user_id = $this->ion_auth->register($username, $password, $email, $additional_data, $group);

		// result
		($user_id) ? $this->success($this->ion_auth->messages()) : $this->error($this->ion_auth->errors());
	}

	/**
	 * @SWG\Put(
	 * 	path="/demo/user/{id}",
	 * 	tags={"demo"},
	 * 	summary="Update an existing user",
	 * 	@SWG\Parameter(
	 * 		in="path",
	 * 		name="id",
	 * 		description="User ID",
	 * 		required=true,
	 * 		type="integer"
	 * 	),
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="User info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/DemoUserPut")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	// TODO: user should be able to update their own account only
	public function user_put($id)
	{
		$data = elements(array('first_name', 'last_name'), $this->put());

		// proceed to update user
		$updated = $this->ion_auth->update($id, $data);

		// result
		($updated) ? $this->success($this->ion_auth->messages()) : $this->error($this->ion_auth->errors());
	}
}
