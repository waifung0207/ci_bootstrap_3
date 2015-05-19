<?php

class MY_Controller extends CI_Controller {

	// Values and objects to be overrided or accessible from child controllers
	protected $mSite = '';
	protected $mSiteConfig = array();
	protected $mBaseUrl = '';
	protected $mBodyClass = '';
	protected $mDefaultLayout = 'empty';
	protected $mLanguage = '';
	protected $mAvailableLanguages = '';
	protected $mTitlePrefix = '';
	protected $mTitle = '';
	protected $mMetaData = array();
	protected $mMenu = array();
	protected $mBreadcrumb = array();

	// Values to be obtained automatically from router
	protected $mCtrler = 'home';		// current controller
	protected $mAction = 'index';		// controller function being called
	protected $mMethod = 'GET';			// HTTP request method

	// Scripts and stylesheets to be embedded on each page
	protected $mStylesheets = array();
	protected $mScripts = array();

	// Data to pass into views
	protected $mViewData = array();

	// Constructor
	public function __construct()
	{
		parent::__construct();

		$this->mCtrler = $this->router->fetch_class();
		$this->mAction = $this->router->fetch_method();
		$this->mMethod = $this->input->server('REQUEST_METHOD');
		
		$this->mScripts['head'] = array();		// for scripts that need to be loaded from the start
		$this->mScripts['foot'] = array();		// for scripts that can be loaded after page render

		// Initial setup
		$this->_setup();

		// (optional) enable profiler
		if (ENVIRONMENT=='development')
		{
			//$this->output->enable_profiler(TRUE);
		}
	}
	
	// Output template for Frontend Website
	protected function _render($view, $layout = '')
	{
		// automatically generate page title
		if ( empty($this->mTitle) )
		{
			if ( $this->mAction=='index' )
				$this->mTitle = humanize($this->mCtrler);
			else
				$this->mTitle = humanize($this->mAction);
		}

		// automatically push current page to last record of breadcrumb
		$this->_push_breadcrumb($this->mTitle);
		$this->mViewData['breadcrumb'] = $this->mBreadcrumb;
		
		$this->mViewData['base_url'] = $this->mBaseUrl;
		$this->mViewData['inner_view'] = $this->mSite.'/'.$view;
		$this->mViewData['body_class'] = $this->mBodyClass;

		$this->mViewData['site'] = $this->mSite;
		$this->mViewData['ctrler'] = $this->mCtrler;
		$this->mViewData['action'] = $this->mAction;

		$this->mViewData['current_uri'] = ($this->mSite==='frontend') ? uri_string(): str_replace($this->mSite.'/', '', uri_string());
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;
		$this->mViewData['menu'] = $this->mMenu;
		$this->mViewData['meta'] = $this->mMetaData;
		$this->mViewData['title'] = $this->mTitlePrefix.$this->mTitle;

		// load view files
		$layout = empty($layout) ? $this->mDefaultLayout : $layout;
		$this->load->view('common/head', $this->mViewData);
		$this->load->view('layouts/'.$layout, $this->mViewData);
		$this->load->view('common/foot', $this->mViewData);
	}
	
	// Output JSON string
	protected function _render_json($data)
	{
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}

	// Setup for different sites
	private function _setup()
	{
		// called at first so config/sites.php can contains lang() function
		$this->_setup_language();

		// get site-specific configuration from file "application/config/sites.php"
		$this->config->load('sites');
		$config = $this->config->item('sites')[$this->mSite];

		// setup autoloading (libraries, helpers, models, language files, etc.)
		if ( !empty($config['autoload']) )
			$this->_setup_autoload($config['autoload']);

		// setup metadata
		if ( !empty($config['meta']) )
			$this->_setup_meta($config['meta']);

		// setup assets (stylesheets, scripts)
		if ( !empty($config['assets']) )
		{
			$this->mStylesheets = $config['assets']['stylesheets'];
			$this->mScripts['head'] = $config['assets']['scripts_head'];
			$this->mScripts['foot'] = $config['assets']['scripts_foot'];	
		}

		// setup menu
		if ( !empty($config['menu']) )
			$this->mMenu = $config['menu'];

		$this->mSiteConfig = $config;
	}

	// Setup localization
	private function _setup_language()
	{
		// language settings from: application/config/language.php
		$this->config->load('language');
		$config = $this->config->item('site_languages')[$this->mSite];	

		// default language from config (NOT the one from CodeIgniter: application/config/config.php)
		$this->mLanguage = $this->session->has_userdata('language') ? $this->session->userdata('language') : $config['default'];
		
		if ( !empty($config['enabled']) )
		{
			$this->mAvailableLanguages = $config['available'];

			foreach ($config['autoload'] as $file)
				$this->lang->load($file, $this->mAvailableLanguages[$this->mLanguage]['value']);

			$this->mViewData['available_languages'] = $this->mAvailableLanguages;
		}

		$this->mViewData['language'] = $this->mLanguage;
	}

	// Setup autoloading
	private function _setup_autoload($config)
	{
		foreach ($config['libraries'] as $file)
		{
			if ($file==='database')
				$this->load->database();
			else
				$this->load->library($file);
		}
		
		foreach ($config['helpers'] as $file)
			$this->load->helper($file);

		foreach ($config['models'] as $file => $alias)
			$this->load->model($file, $alias);
	}

	// Setup metadata
	private function _setup_meta($config)
	{
		$this->mTitlePrefix = empty($config['title_prefix']) ? '' : $config['title_prefix'];
		
		foreach ($config['custom'] as $key => $value)
			$this->mMetaData[$key] = $value;
	}

	// Add breadcrumb entry
	// (Link will be disabled when it is the last entry, or URL set as '#')
	protected function _push_breadcrumb($name, $url = '#', $append = TRUE)
	{
		$entry = array('name' => $name, 'url' => $url);

		if ($append)
			$this->mBreadcrumb[] = $entry;
		else
			array_unshift($this->mBreadcrumb, $entry);
	}
}


/**
 * Base controller for Frontend Website
 */
class Frontend_Controller extends MY_Controller {

	protected $mSite = 'frontend';
	protected $mDefaultLayout = 'frontend_default';

	public function __construct()
	{
		parent::__construct();
		$this->mBaseUrl = site_url();

		if ($this->mCtrler!='home')
		{
			$this->_push_breadcrumb('Home', '', FALSE);	
		}
	}
}


/**
 * Base controller for Admin Panel
 */
class Admin_Controller extends MY_Controller {

	// override parent values
	protected $mSite = 'admin';
	protected $mDefaultLayout = 'admin_default';

	// values for Admin Panel only
	protected $mUser = array();

	public function __construct()
	{
		parent::__construct();
		$this->mBaseUrl = site_url($this->mSite).'/';
		$this->_push_breadcrumb('Admin Panel', '', FALSE);

		if ($this->mCtrler!='login')
		{
			// Check with user login
			$this->_verify_auth();
		}
	}

	// Override parent
	protected function _render($view, $layout = '')
	{
		$this->mBodyClass = ($this->mCtrler=='login') ? 'login-page' : 'skin-purple';
		parent::_render($view, $layout);
	}

	// Verify authentication
	private function _verify_auth()
	{
		// obtain user data from session; redirect to Login page if not found
		if ($this->session->has_userdata('admin_user'))
		{
			$this->mUser = $this->session->userdata('admin_user');
			$this->mViewData['user'] = $this->mUser;
		}
		else
		{
			redirect('admin/login');
		}
	}

	// Verify if the login user belongs to target role
	// $role can be string or string array
	protected function _verify_role($role)
	{
		if ( empty($this->mUser) )
			redirect('admin/login');

		$pass = is_array($role) ? in_array($this->mUser->role, $role) : ($this->mUser->role==$role);
		
		if (!$pass)
			redirect('admin');
	}
}


/**
 * Base controller for API Site
 */
class Api_Controller extends MY_Controller {

	protected $mSite = 'api';

	public function __construct()
	{
		parent::__construct();
		$this->mBaseUrl = site_url($this->mSite).'/';
		$this->_verify_auth();
	}

	// Verify authentication
	private function _verify_auth()
	{
		// to be completed
	}
}