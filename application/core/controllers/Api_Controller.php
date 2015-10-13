<?php

/**
 * Base Controller for API module
 */
class API_Controller extends MY_Controller {

	// Combined paramters from:
	// 1. GET parameter (query string from URL)
	// 2. POST body (from form data)
	// 3. POST body (from JSON body)
	protected $mParams;

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->verify_token();
		$this->parse_request();
	}
	
	// Verify access token (e.g. API Key, JSON Web Token)
	protected function verify_token()
	{
		// TODO: implement API Key or JWT handling
		$this->mUser = NULL;
	}
	
	// Verify request method
	protected function verify_method($method, $error_response = NULL, $error_code = 404)
	{
		if ($this->mMethod!=strtoupper($method))
		{
			if ($error_response===NULL)
				$this->to_error_method_not_allowed();
			else
				$this->render_json($error_response, $error_code);
		}
	}
	
	// Verify user role
	protected function verify_role($role, $error_response = NULL, $error_code = 404)
	{
		if ( empty($this->mUser) || $this->mUser->role!=strtolower($role) )
		{
			if ($error_response===NULL)
				$this->to_error_unauthorized();
			else
				$this->render_json($error_response, $error_code);
		}
	}

	// Parse request to obtain request info (method, body)
	protected function parse_request()
	{
		// GET parameters
		$params = $this->input->get();

		// request body
		if ( in_array($this->mMethod, array('POST', 'PUT')) )
		{
			$content_type = $this->input->server('CONTENT_TYPE');
			$is_form_request = ($content_type=='application/x-www-form-urlencoded');
			$is_json_request = ($content_type=='application/json' || $content_type=='application/json; charset=UTF-8');

			if ($is_form_request)
			{
				// check CodeIgniter input
				$form_data = $this->input->post();

				if ( !empty($form_data) )
				{
					// save parameters from form body
					$params = array_merge($params, $form_data);
				}
				else
				{
					// query string from text body
					$data = file_get_contents("php://input");
					parse_str($data, $temp);
					$params = array_merge($params, $temp);
				}
			}
			else if ($is_json_request)
			{
				// JSON from text body
				$data = file_get_contents("php://input");
				if ( !empty($data) )
				{
					$params = array_merge($params, json_decode(trim($data), TRUE));
				}
			}
		}

		// TODO: sanitize $mParams
		$this->mParams = $params;
	}

	// shortcut method to get single value from parameters
	protected function param($key, $default_val = NULL)
	{
		if ( empty($this->mParams[$key]) )
			return $default_val;
		else
			return $this->mParams[$key];
	}

	/**
	 * Basic RESTful endpoints
	 * 
	 * For instance, the following URL patterns will be consumed by Items controller
	 * 	[GET] /items					=> get_items()
	 * 	[GET] /items/{id}				=> get_item(id)
	 * 	[GET] /items/{id}/{subitem}		=> get_subitems(id, subitem)
	 * 	[POST] /items 					=> create_item()
	 * 	[POST] /items/{id}/{subitem}	=> create_subitem(id, subitem)
	 * 	[PUT] /items/{id}				=> update_item(id)
	 * 	[DELETE] /items/{id}			=> remove_item(id)
	 *
	 * Other custom endpoints can be added into the child controller instead, e.g.:
	 * 	[GET] /items/hello 				=> should call hello() function inside Items controller
	 */
	public function index()
	{
		$item_id = $this->uri->rsegment(3);
		$subitem = strtolower($this->uri->rsegment(4));

		switch($this->mMethod)
		{
			case 'GET':
				if ( !empty($subitem) )
					$this->get_subitems($item_id, $subitem);
				else if ( !empty($item_id) )
					$this->get_item($item_id);
				else
					$this->get_items();
				break;
			case 'POST':
			case 'POST':
				if ( !empty($item_id) && !empty($subitem) )
					$this->create_subitem($item_id, $subitem);
				else if ( empty($item_id) )
					$this->create_item();
				else
					$this->to_error_not_found();
				break;
			case 'PUT':
				if ( !empty($item_id) )
					$this->update_item($item_id);
				else
					$this->to_error_not_found();
				break;
			case 'DELETE':
				if ( !empty($item_id) )
					$this->remove_item($item_id);
				else
					$this->to_error_not_found();
				break;
			default:
				$this->to_error_not_found();
				break;
		}
	}

	/**
	 * Functions to be override by child controllers
	 */
	protected function get_items()
	{
		$this->to_not_implemented();
	}

	protected function get_item($id)
	{
		$data = array('item_id' => (int)$id);
		$this->to_not_implemented($data);
	}

	protected function get_subitems($parent_id, $subitem)
	{
		$data = array(
			'parent_id' => (int)$parent_id,
			'subitem' => $subitem
		);
		$this->to_not_implemented($data);
	}
	
	protected function create_item()
	{
		$data = array('params' => $this->mParams);
		$this->to_not_implemented($data);
	}

	protected function create_subitem($parent_id, $subitem)
	{
		$data = array(
			'parent_id' => (int)$parent_id,
			'subitem' => $subitem
		);
		$this->to_not_implemented($data);
	}

	protected function update_item($id)
	{
		$data = array(
			'item_id' => (int)$id,
			'params' => $this->mParams
		);
		$this->to_not_implemented($data);
	}

	protected function remove_item($id)
	{
		$data = array('item_id' => (int)$id);
		$this->to_not_implemented($data);
	}

	/**
	 * Wrapper functions to return responses
	 * Reference: http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
	 */
	protected function to_response($data)
	{
		$this->render_json($data);
	}

	protected function to_created()
	{
		$data = array('message' => 'Created');
		$this->render_json($data, 201);
	}
	
	protected function to_accepted()
	{
		$data = array('message' => 'Accepted');
		$this->render_json($data, 201);
	}

	/**
	 * Wrapper function to return error
	 */
	protected function to_error($msg = 'An error occurs', $code = 200, $additional_data = array())
	{
		$data = array('error' => $msg);

		// (optional) append additional data
		if (!empty($additional_data))
			$data['data'] = $additional_data;

		$this->render_json($data, $code);
	}

	protected function to_error_bad_request()
	{
		$this->to_error('Bad Request', 400);
	}

	protected function to_error_unauthorized()
	{
		$this->to_error('Unauthorized', 401);
	}

	protected function to_error_forbidden()
	{
		$this->to_error('Forbidden', 403);
	}

	protected function to_error_not_found()
	{
		$this->to_error('Not Found', 404);
	}

	protected function to_error_method_not_allowed()
	{
		$this->to_error('Method Not Allowed', 405);
	}

	protected function to_not_implemented($additional_data = array())
	{
		// show "not implemented" info only during development mode
		if (ENVIRONMENT=='development')
		{
			$trace = debug_backtrace();
			$caller = $trace[1];

			$data['url'] = current_url();
			$data['controller']	= $this->mCtrler;
			$data['function'] = $caller['function'];
			$data = array_merge($data, $additional_data);

			$this->to_error('Not Implemented', 501, $data);
		}
		else
		{
			$this->to_error_not_found();
		}
	}
}