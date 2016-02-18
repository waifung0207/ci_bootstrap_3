<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller with Swagger annotations
 * Reference: https://github.com/zircote/swagger-php/
 */
class Users extends API_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'users');
	}

	/**
	 * @SWG\Get(
	 * 	path="/users",
	 * 	tags={"user"},
	 * 	summary="List out users",
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="List of users",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/User"))
	 * 	)
	 * )
	 */
	protected function get_items()
	{
		$data = $this->users
			->select('id, username, email, active, first_name, last_name')
			->get_all();
		$this->to_response($data);
	}

	/**
	 * @SWG\Post(
	 * 	path="/users",
	 * 	tags={"user"},
	 * 	summary="Create new user",
	 * 	consumes={"application/json"},
	 * 	produces={"application/json"},
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="Created user info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/User")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation",
	 * 		@SWG\Schema(ref="#/definitions/User")
	 * 	)
	 * )
	 */
	protected function create_item()
	{
		parent::create_item();
	}

	/**
	 * @SWG\Put(
	 * 	path="/users/{id}",
	 * 	tags={"user"},
	 * 	summary="Update an existing user",
	 * 	consumes={"application/json"},
	 * 	produces={"application/json"},
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
	 * 		description="Updated user info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/User")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation",
	 * 		@SWG\Schema(ref="#/definitions/User")
	 * 	)
	 * )
	 */
	protected function update_item($id)
	{
		parent::update_item($id);
	}

	/**
	 * @SWG\Get(
	 * 	path="/users/{id}",
	 * 	tags={"user"},
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
	 * 		@SWG\Schema(ref="#/definitions/User")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="404",
	 * 		description="Invalid user ID"
	 * 	)
	 * )
	 */
	protected function get_item($id)
	{
		$data = $this->users
			->select('id, username, email, active, first_name, last_name')
			->get($id);
		$this->to_response($data);
	}
}
