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
	 * 	@SWG\Parameter(
	 * 		in="header",
	 * 		name="X-API-KEY",
	 * 		description="API Key",
	 * 		required=false,
	 * 		type="string"
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="List of users",
	 * 		@SWG\Schema(type="array", @SWG\Items(ref="#/definitions/DemoUser"))
	 * 	)
	 * )
	 */
	public function users_get()
	{
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
		$data = $this->users
			->select('id, username, email, active, first_name, last_name')
			->get($id);
		$this->response($data);
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

	/**
	 * @SWG\Post(
	 * 	path="/demo/sign_up",
	 * 	tags={"demo"},
	 * 	summary="Create new user",
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="User info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/DemoSignUp")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function sign_up_post()
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
	 * @SWG\Post(
	 * 	path="/demo/activate",
	 * 	tags={"demo"},
	 * 	summary="Activate a user",
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="Login info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/DemoActivate")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function activate_post()
	{
		$user_id = $this->post('id');
		$code = $this->post('code');
		$activation = $this->ion_auth->activate($user_id, $code);

		// result
		($activation) ? $this->success($this->ion_auth->messages()) : $this->error($this->ion_auth->errors());
	}

	/**
	 * @SWG\Post(
	 * 	path="/demo/login",
	 * 	tags={"demo"},
	 * 	summary="Login a user and get API key",
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="Login info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/DemoLogin")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function login_post()
	{
		$email = $this->post('email');
		$password = $this->post('password');

		// proceed to login user
		$logged_in = $this->ion_auth->login($email, $password, FALSE);

		// result
		if ($logged_in)
		{
			// get User object and remove unnecessary fields
			$user = $this->ion_auth->user()->row();
			unset($user->password);
			unset($user->salt);
			unset($user->ip_address);
			unset($user->activation_code);
			unset($user->forgotten_password_code);
			unset($user->forgotten_password_time);
			unset($user->remember_code);

			// TODO: append API key
			$user->api_key = '';

			// return result
			$this->response($user);
		}
		else
		{
			$this->error($this->ion_auth->errors());
		}
	}

	/**
	 * @SWG\Post(
	 * 	path="/demo/forgot_password",
	 * 	tags={"demo"},
	 * 	summary="Submission of Forgot Password form",
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="Forgot Password info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/DemoForgotPassword")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function forgot_password_post()
	{
		// proceed to forgot password
		$email = $this->post('email');
		$forgotten = $this->ion_auth->forgotten_password($email);

		if ($forgotten)
		{
			// TODO: send email to user
			$code = $forgotten['forgotten_password_code'];

			$this->success($this->ion_auth->messages());
		}
		else
		{
			$this->error($this->ion_auth->errors());
		}
	}

	/**
	 * @SWG\Post(
	 * 	path="/demo/reset_password",
	 * 	tags={"demo"},
	 * 	summary="Submission of Reset Password form",
	 * 	@SWG\Parameter(
	 * 		in="body",
	 * 		name="body",
	 * 		description="Reset Password info",
	 * 		required=true,
	 * 		@SWG\Schema(ref="#/definitions/DemoResetPassword")
	 * 	),
	 * 	@SWG\Response(
	 * 		response="200",
	 * 		description="Successful operation"
	 * 	)
	 * )
	 */
	public function reset_password_post()
	{
		// proceed to reset password
		$code = $this->post('code');
		$password = $this->post('password');
		$password_confirm = $this->post('password_confirm');

		// verify passwords are the same (TODO: better validation)
		if ($password===$password_confirm)
		{
			// verify reset code
			$reset = $this->ion_auth->forgotten_password_complete($code);

			if ($reset)
			{
				// proceed to change user password
				$updated = $this->ion_auth->reset_password($reset['identity'], $password);
				($updated) ? $this->success($this->ion_auth->messages()) : $this->error($this->ion_auth->errors());
			}
			else
			{
				$this->error($this->ion_auth->errors());
			}
		}
		else
		{
			$this->error('Password not identical');
		}
	}
}
