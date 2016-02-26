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
	public function index_get()
	{
		$data = $this->users
			->select('id, username, email, active, first_name, last_name')
			->get_all();
		$this->response($data);
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
	public function id_get($id)
	{
		$data = $this->users
			->select('id, username, email, active, first_name, last_name')
			->get($id);
		$this->response($data);
	}
}
