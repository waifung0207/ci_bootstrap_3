<?php

class MY_Controller extends CI_Controller {

	// Values to be obtained automatically from router
	protected $mSite = '';				// empty for Frontend, "admin" for Admin Panel, etc.
	protected $mCtrler = 'home';		// current controller
	protected $mAction = 'index';		// controller function being called
	protected $mMethod = 'GET';			// HTTP request method

	// Scripts and stylesheets to be embedded on each page
	protected $mStylesheets = array();
	protected $mScripts = array();

	// Values and objects to be accessible from child controllers
	protected $mLocale = '';
	protected $mTitle = '';
	protected $mMetaData = array();
	protected $mBreadcrumb = array();

	// Data to pass into views
	protected $mViewData = array();

	// Constructor
	public function __construct()
	{
		parent::__construct();

		$this->mSite = str_replace('/', '', $this->router->directory);
		$this->mCtrler = $this->router->fetch_class();
		$this->mAction = $this->router->fetch_method();
		$this->mMethod = $this->input->server('REQUEST_METHOD');
		
		$this->mScripts['head'] = array();		// for scripts that need to be loaded from the start
		$this->mScripts['foot'] = array();		// for scripts that can be loaded after page render

		// For pages which require authentication
		$this->_verify_auth();

		// Other setup functions
		$this->_setup_autoload();
		$this->_setup_locale();
		$this->_setup_scripts();
		$this->_setup_meta();
		$this->_push_breadcrumb('Home', '', FALSE);

		// (optional) enable profiler
		if (ENVIRONMENT=='development')
		{
			//$this->output->enable_profiler(TRUE);
		}
	}
	
	// Output template for Frontend Website
	protected function _render($view, $layout = '', $body_class = '')
	{
		$this->mViewData['base_url'] = empty($this->mSite) ? site_url() : site_url($this->mSite).'/';
		$this->mViewData['inner_view'] = empty($this->mSite) ? $view : $this->mSite.'/'.$view;
		$this->mViewData['body_class'] = ($this->mSite=='admin' && empty($body_class)) ? 'skin-purple' : $body_class;

		$this->mViewData['site'] = $this->mSite;
		$this->mViewData['ctrler'] = $this->mCtrler;
		$this->mViewData['action'] = $this->mAction;
		$this->mViewData['current_uri'] = empty($this->mSite) ? uri_string(): str_replace($this->mSite.'/', '', uri_string());
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;
		$this->mViewData['breadcrumb'] = $this->mBreadcrumb;
		$this->_setup_menu();

		if ( empty($layout) )
		{
			// default layout (vary from different sites)
			$layout = ($this->mSite=='admin') ? 'admin' : 'default';
		}

		$this->load->view('_common/head', $this->mViewData);
		$this->load->view('_layouts/'.$layout, $this->mViewData);
		$this->load->view('_common/foot', $this->mViewData);
	}
	
	// Output JSON string
	protected function _render_json($data)
	{
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
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

	/**
	 * Private setup functions
	 */
	
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

	// Setup autoloading for different sites
	private function _setup_autoload()
	{
		// to be completed
	}

	// Setup localization
	// TODO: multilingual support (read current language from session, autoload files)
	private function _setup_locale()
	{
		// to be completed
		$this->mLocale = 'en';
	}

	// Setup script and stylesheet assets
	private function _setup_scripts()
	{
		if ($this->mSite==='admin')
		{
			// Admin Panel
			$this->mStylesheets[] = 'admin.min.css';
			$this->mScripts['head'][] = 'admin.min.js';
		}
		else
		{
			// Frontend Website
			$this->mStylesheets[] = 'app.min.css';
			$this->mScripts['foot'][] = 'app.min.js';
		}
	}

	// Setup title and meta data
	// TODO: obtain default values from config file
	private function _setup_meta()
	{
		$this->mMetaData['author'] = '';

		if ($this->mSite==='admin')
		{
			// Admin Panel
			$title = empty($this->mTitle) ? 'Admin Panel' : 'Admin Panel - '.$this->mTitle;
			$this->mMetaData['description'] = 'Admin Panel description';
		}
		else
		{
			// Frontend Website
			$title = empty($this->mTitle) ? 'Frontend Website' : 'Frontend Website - '.$this->mTitle;
			$this->mMetaData['description'] = 'Frontend Website description';
		}

		$this->mViewData['title'] = $title;
		$this->mViewData['meta'] = $this->mMetaData;
	}

	// Setup menu items (navbar)
	private function _setup_menu()
	{
		// menu items
		$this->config->load('menu');
		$menu_name = empty($this->mSite) ? 'menu' : 'menu_'.$this->mSite;
		$this->mViewData['menu'] = $this->config->item($menu_name);
	}
}