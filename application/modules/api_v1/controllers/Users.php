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
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="List of users",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/User"))
	 * 	)
	 * )
	 */
	protected function get_items()
	{
		$params = $this->input->get();
		$data = $this->users
			->select('id, username, email, active, first_name, last_name, company, phone')
			->get_many_by($params);
		$this->to_response($data);
	}

	/**
	 * @SWG\Get(
	 * 	path="/users/{id}",
	 * 	tags={"user"},
	 * 	@SWG\Parameter(
	 * 		name="id",
	 * 		in="path",
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
			->select('id, username, email, active, first_name, last_name, company, phone')
			->get($id);
		$this->to_response($data);
	}
}
