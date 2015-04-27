<?php

class MY_Controller extends CI_Controller {

	// Values to be obtained automatically from router
	protected $mSite = 'frontend';		// empty for Frontend, "admin" for Admin Panel, etc.
	protected $mCtrler = 'home';		// current controller
	protected $mAction = 'index';		// controller function being called
	protected $mMethod = 'GET';			// HTTP request method

	// Scripts and stylesheets to be embedded on each page
	protected $mStylesheets = array();
	protected $mScripts = array();

	// Values and objects to be accessible from child controllers
	protected $mLocale = '';
	protected $mAvailableLocales = '';
	protected $mTitlePrefix = '';
	protected $mTitle = '';
	protected $mMetaData = array();
	protected $mMenu = array();
	protected $mBreadcrumb = array();

	// Other default values from config file
	protected $mDefaults = array();

	// Data to pass into views
	protected $mViewData = array();

	// Constructor
	public function __construct()
	{
		parent::__construct();

		if ( !empty($this->router->directory) )
		{
			$this->mSite = str_replace('/', '', $this->router->directory);
		}

		$this->mCtrler = $this->router->fetch_class();
		$this->mAction = $this->router->fetch_method();
		$this->mMethod = $this->input->server('REQUEST_METHOD');
		
		$this->mScripts['head'] = array();		// for scripts that need to be loaded from the start
		$this->mScripts['foot'] = array();		// for scripts that can be loaded after page render

		// For pages which require authentication
		$this->_verify_auth();

		// Initial setup
		$this->_setup();

		// (optional) enable profiler
		if (ENVIRONMENT=='development')
		{
			//$this->output->enable_profiler(TRUE);
		}
	}
	
	// Output template for Frontend Website
	protected function _render($view, $layout = '', $body_class = NULL)
	{
		$this->mViewData['base_url'] = ($this->mSite==='frontend') ? site_url() : site_url($this->mSite).'/';
		$this->mViewData['inner_view'] = $this->mSite.'/'.$view;

		$this->mViewData['site'] = $this->mSite;
		$this->mViewData['ctrler'] = $this->mCtrler;
		$this->mViewData['action'] = $this->mAction;

		$this->mViewData['body_class'] = ($body_class===NULL) ? $this->mDefaults['body_class'] : $body_class;

		$this->mViewData['current_uri'] = ($this->mSite==='frontend') ? uri_string(): str_replace($this->mSite.'/', '', uri_string());
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;
		$this->mViewData['breadcrumb'] = $this->mBreadcrumb;
		$this->mViewData['menu'] = $this->mMenu;
		$this->mViewData['meta'] = $this->mMetaData;
		$this->mViewData['title'] = $this->mTitlePrefix.$this->mTitle;

		// load view files
		$layout = empty($layout) ? $this->mDefaults['layout'] : $layout;
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

	// Verify authentication for Admin Panel (or API site, etc.)
	private function _verify_auth()
	{
		// verify login data from session
		if ($this->mSite=='admin' && $this->mCtrler!='login')
		{
			// to be completed
		}
		else if ($this->mSite=='api')
		{
			// to be completed
		}
	}

	// Setup for different sites
	private function _setup()
	{
		// called at first so config/sites.php can contains lang() function
		$this->_setup_locale();

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

		// setup default values
		if ( !empty($config['defaults']) )
			$this->mDefaults = $config['defaults'];

		// other custom logic outside of config file
		switch ($this->mSite)
		{
			case 'frontend':
				$this->_push_breadcrumb('Home', '', FALSE);
				break;
			case 'admin':
				$this->_push_breadcrumb('Admin Panel', '', FALSE);
				break;
			case 'api':
				break;
		}
	}

	// Setup localization
	// TODO: get saved language from session
	private function _setup_locale()
	{
		// default language from CodeIgniter: application/config/config.php
		$default_locale = $this->config->item('language');
		$this->mLocale = $default_locale;

		// localization settings from: application/config/locale.php
		$this->config->load('locale');
		$config = $this->config->item('locale')[$this->mSite];		
		$this->mAvailableLocales = array();
		
		if ( !empty($config['enabled']) )
		{
			$this->load->helper('language');
			$this->mAvailableLocales = $config['available'];

			foreach ($config['autoload'] as $file)
				$this->lang->load($file, 'en');
		}
		
		$this->mViewData['locale'] = $this->mLocale;
		$this->mViewData['available_locales'] = $this->mAvailableLocales;
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

	// Initialize CRUD table via Grocery CRUD library
	// Reference: http://www.grocerycrud.com/
	protected function _init_crud($table, $subject = '')
	{
		// ensure database is loaded
		if ( !$this->load->is_loaded('database') )
		{
			$this->load->database();
		}

		// create CRUD object
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table($table);

		// auto-generate subject
		if ( empty($subject) )
		{
			if ( !$this->load->is_loaded('inflector') )
				$this->load->helper('inflector');

			$crud->set_subject(humanize(singular($table)));
		}

		// general settings
		$crud->unset_jquery();
		$crud->unset_print();
		$crud->unset_export();
		
		// other custom logic to be done outside
		return $crud;
	}

	// Initialize CRUD album via Image CRUD library
	// Reference: http://www.grocerycrud.com/image-crud
	protected function _init_image_crud($table, $url_field, $upload_path, $order_field = 'pos', $title_field = '')
	{
		// get config file
		$CI =& get_instance();
		$CI->config->load('crud');
		$params = $CI->config->item('image_crud');

		// create CRUD object
		$CI->load->library('image_CRUD');
		$crud = new image_CRUD();
		$crud->set_table($table);
		$crud->set_url_field($url_field);
		$crud->set_image_path($upload_path);

		// [Optional] field name of image order (e.g. "pos")
		if ( !empty($order_field) )
		{
			$crud->set_ordering_field($order_field);
		}

		// [Optional] field name of image caption (e.g. "caption")
		if ( !empty($title_field) )
		{
			$crud->set_title_field($title_field);
		}

		// other custom logic to be done outside
		return $crud;
	}
}