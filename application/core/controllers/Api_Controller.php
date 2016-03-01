<?php

require_once(APPPATH.'modules/api/libraries/REST_Controller.php');

/**
 * Base Controller for API module
 */
class API_Controller extends REST_Controller {

	// The user who is consuming the API endpoint
	protected $mApiKey;
	protected $mUserID;
	protected $mUser;

	// Constructor
	public function __construct()
	{
		parent::__construct();

		// send PHP headers when necessary (e.g. enable CORS)
		$site_config = $this->config->item('site');
		$headers = empty($site_config['headers']) ? array() : $site_config['headers'];
		foreach ($headers as $header)
		{
			header($header);
		}

		$this->verify_token();
	}

	// Verify access token (e.g. API Key, JSON Web Token)
	protected function verify_token()
	{
		$this->mApiKey = $this->input->get_request_header('X-API-KEY');
		$key = $this->api_keys->get_by('key', $this->mApiKey);
		$this->mUserID = empty($key) ? NULL : $key->user_id;
		$this->mUser = empty($this->mUserID) ? NULL : $this->users->get($this->mUserID);
	}

	// Verify user authentication
	// $group parameter can be name, ID, name array, ID array, or mixed array
	// Reference: http://benedmunds.com/ion_auth/#in_group
	protected function verify_auth($groups = 'members')
	{
		$groups = is_string($groups) ? array($groups) : $groups;

		// user groups not match with requirement
		if ( !$this->ion_auth->in_group($groups, $this->mUserID) )
			$this->error_unauthorized();
	}
	
	// Shortcut functions following REST_Controller convention
	protected function success($msg = NULL)
	{
		$data = array('status' => TRUE);
		if ( !empty($msg) ) $data['message'] = $msg;
		$this->response($data, REST_Controller::HTTP_OK);
	}

	protected function created($msg = NULL)
	{
		$data = array('status' => TRUE);
		if ( !empty($msg) ) $data['message'] = $msg;
		$this->response($data, REST_Controller::HTTP_CREATED);
	}
	
	protected function accepted($msg = NULL)
	{
		$data = array('status' => TRUE);
		if ( !empty($msg) ) $data['message'] = $msg;
		$this->response($data, REST_Controller::HTTP_ACCEPTED);
	}

	protected function error($msg = 'An error occurs', $code = REST_Controller::HTTP_OK, $additional_data = array())
	{
		$data = array('status' => FALSE, 'error' => $msg);

		// (optional) append additional data
		if (!empty($additional_data))
			$data['data'] = $additional_data;

		$this->response($data, $code);
	}
	
	protected function error_bad_request()
	{
		$data = array('status' => FALSE);
		$this->response($data, REST_Controller::HTTP_BAD_REQUEST);
	}
	
	protected function error_unauthorized()
	{
		$data = array('status' => FALSE);
		$this->response($data, REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	protected function error_forbidden()
	{
		$data = array('status' => FALSE);
		$this->response($data, REST_Controller::HTTP_FORBIDDEN);
	}
	
	protected function error_not_found()
	{
		$data = array('status' => FALSE);
		$this->response($data, REST_Controller::HTTP_NOT_FOUND);
	}
	
	protected function error_method_not_allowed()
	{
		$data = array('status' => FALSE);
		$this->response($data, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
	}

	protected function error_not_implemented($additional_data = array())
	{
		// show "not implemented" info only during development mode
		if (ENVIRONMENT=='development')
		{
			$trace = debug_backtrace();
			$caller = $trace[1];

			$data = array(
				'url'			=> current_url(),
				'module'		=> $this->router->fetch_module(),
				'controller'	=> $this->router->fetch_class(),
				'action'		=> $this->router->fetch_method(),
			);

			if (!empty($additional_data))
				$data = array_merge($data, $additional_data);

			$this->error('Not implemented', REST_Controller::HTTP_NOT_IMPLEMENTED, $data);
		}
		else
		{
			$this->error_not_found();
		}
	}
}