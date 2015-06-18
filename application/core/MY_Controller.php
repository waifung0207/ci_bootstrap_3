<?php

/**
 * Base controllers for different purposes
 * 	- MY_Controller: 
 * 	- Admin_Controller: 
 * 	- API_Controller: 
 */
class MY_Controller extends CI_Controller {

	// Values to be obtained automatically from router
	protected $mModule = '';			// module name (empty = Frontend Website)
	protected $mCtrler = 'home';		// current controller
	protected $mAction = 'index';		// controller function being called
	protected $mMethod = 'GET';			// HTTP request method

	// Config values from config/site.php
	protected $mSiteConfig = array();
	protected $mSiteName = '';

	// Values and objects to be overrided or accessible from child controllers
	protected $mTitle = '';
	protected $mMetaData = array();
	protected $mStylesheets = array();	// CSS files to be embedded on each page
	protected $mScripts = array();		// JS files to be embedded on each page
	protected $mGaID = '';				// Google Analytics User ID
	protected $mBodyClass = '';
	protected $mMenu = array();
	protected $mBreadcrumb = array();

	// Multilingual
	protected $mMultilingual = FALSE;
	protected $mLanguage = 'english';
	protected $mAvailableLanguages = array();

	// Data to pass into views
	protected $mViewData = array();

	// Login user
	protected $mUser = NULL;

	// Constructor
	public function __construct()
	{
		parent::__construct();

		// router info
		$this->mModule = $this->router->fetch_module();
		$this->mCtrler = $this->router->fetch_class();
		$this->mAction = $this->router->fetch_method();
		$this->mMethod = $this->input->server('REQUEST_METHOD');

		// initial setup
		$this->_setup();
	}

	// Setup values from file: config/site.php
	private function _setup()
	{
		$site_config = $this->config->item('site');

		// load default values
		$this->mSiteName = $site_config['name'];
		$this->mTitle = $site_config['title'];
		$this->mMetaData = $site_config['meta'];
		$this->mStylesheets = $site_config['stylesheets'];
		$this->mScripts = $site_config['scripts'];
		$this->mGaID = $site_config['ga_id'];
		$this->mBodyClass = $site_config['body_class'];
		$this->mMenu = $site_config['menu'];

		// multilingual setup
		$lang_config = $site_config['multilingual'];
		if ( !empty($lang_config) )
		{
			$this->mMultilingual = TRUE;

			// default language from config (NOT the one from CodeIgniter: application/config/config.php)
			$this->mLanguage = $this->session->has_userdata('language') ? $this->session->userdata('language') : $lang_config['default'];
			
			$this->mAvailableLanguages = $lang_config['available'];

			foreach ($lang_config['autoload'] as $file)
				$this->lang->load($file, $this->mAvailableLanguages[$this->mLanguage]['value']);
		}

		// push first entry to breadcrumb
		if ($this->mCtrler!='home')
		{
			$this->push_breadcrumb('Home', '');	
		}

		$this->mSiteConfig = $site_config;
	}

	// Verify user authentication
	protected function verify_auth($redirect_url = 'account/login')
	{
		// obtain user data from session; redirect to Login page if not found
		if ($this->session->has_userdata('user'))
			$this->mUser = $this->session->userdata('user');
		else
			redirect($redirect_url);
	}
	
	// Output template (layout + view)
	protected function render($inner_view, $layout = 'default')
	{
		// automatically generate page title
		if ( empty($this->mTitle) )
		{
			if ( $this->mAction=='index' )
				$this->mTitle = humanize($this->mCtrler);
			else
				$this->mTitle = humanize($this->mAction);
		}

		$this->mViewData['module'] = $this->mModule;
		$this->mViewData['ctrler'] = $this->mCtrler;
		$this->mViewData['action'] = $this->mAction;

		$this->mViewData['site_name'] = $this->mSiteName;
		$this->mViewData['title'] = $this->mTitle;
		$this->mViewData['meta'] = $this->mMetaData;
		//$this->mViewData['current_uri'] = ($this->mSite==='frontend') ? uri_string(): str_replace($this->mSite.'/', '', uri_string());
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;

		$this->mViewData['base_url'] = empty($this->mModule) ? base_url() : base_url($this->mModule).'/';
		$this->mViewData['body_class'] = $this->mBodyClass;		
		$this->mViewData['menu'] = $this->mMenu;
		$this->mViewData['ga_id'] = $this->mGaID;
		$this->mViewData['inner_view'] = $inner_view;
		$this->mViewData['user'] = $this->mUser;

		// automatically push current page to last record of breadcrumb
		$this->push_breadcrumb($this->mTitle);
		$this->mViewData['breadcrumb'] = $this->mBreadcrumb;

		// multilingual
		if ($this->mMultilingual)
		{
			$this->mViewData['available_languages'] = $this->mAvailableLanguages;
			$this->mViewData['language'] = $this->mLanguage;
		}

		// start loading view files
		$this->load->view('_partials/head', $this->mViewData);
		$this->load->view('_layouts/'.$layout, $this->mViewData);

		// debug tools
		$debug_config = $this->mSiteConfig['debug'];
		if (ENVIRONMENT==='development' && !empty($debug_config))
		{
			$this->output->enable_profiler($debug_config['profiler']);

			if ($debug_config['view_data'])
				$this->output->append_output('<hr/>'.print_r($this->mViewData, TRUE));
		}

		// close HTML
		$this->load->view('_partials/foot', $this->mViewData);		
	}

	// Output JSON string
	protected function render_json($data, $code = 200)
	{
		$this->output
			->set_status_header($code)
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	// Add breadcrumb entry
	// (Link will be disabled when it is the last entry, or URL set as '#')
	protected function push_breadcrumb($name, $url = '#', $append = TRUE)
	{
		$entry = array('name' => $name, 'url' => $url);

		if ($append)
			$this->mBreadcrumb[] = $entry;
		else
			array_unshift($this->mBreadcrumb, $entry);
	}
}

/**
 * For Admin module
 */
class Admin_Controller extends MY_Controller {

	// Constructor
	public function __construct()
	{
		parent::__construct();
		$this->verify_auth();
	}

	// Verify user authentication
	protected function verify_auth($redirect_url = 'admin/login')
	{
		// obtain user data from session; redirect to Login page if not found
		if ($this->session->has_userdata('admin_user'))
			$this->mUser = $this->session->userdata('admin_user');
		else
			redirect($redirect_url);
	}

	// Verify if the login user belongs to target role
	// ($role can be string or string array)
	protected function verify_role($role)
	{
		if ( empty($this->mUser) )
			redirect('admin/login');

		$pass = is_array($role) ? in_array($this->mUser->role, $role) : ($this->mUser->role==$role);
		
		if (!$pass)
			redirect('admin');
	}
}

/**
 * For API module
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
				$params = array_merge($params, json_decode(trim($data), TRUE));
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
				if ( empty($item_id) )
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