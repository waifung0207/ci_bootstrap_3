<?php

/**
 * Base controllers for different purposes
 * 	- MY_Controller: 
 * 	- Admin_Controller: 
 * 	- API_Controller: 
 */
class MY_Controller extends MX_Controller {

	// Values to be obtained automatically from router
	protected $mModule = '';			// module name (empty = Frontend Website)
	protected $mCtrler = 'home';		// current controller
	protected $mAction = 'index';		// controller function being called
	protected $mMethod = 'GET';			// HTTP request method

	// Config values from config/site.php
	protected $mSiteConfig = array();
	protected $mSiteName = '';
	protected $mMetaData = array();
	protected $mScripts = array();
	protected $mStylesheets = array();

	// Values and objects to be overrided or accessible from child controllers
	protected $mTitle = '';
	protected $mMenu = array();
	protected $mBreadcrumb = array();
	protected $mBodyClass = '';

	// Multilingual
	protected $mMultilingual = FALSE;
	protected $mLanguage = 'english';
	protected $mAvailableLanguages = array();

	// Data to pass into views
	protected $mViewData = array();

	// Login user
	protected $mPageAuth = array();
	protected $mUser = NULL;
	protected $mUserGroups = array();
	protected $mUserMainGroup;
	
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
		$this->mMenu = empty($site_config['menu']) ? array() : $site_config['menu'];
		$this->mMetaData = empty($site_config['meta']) ? array() : $site_config['meta'];
		$this->mScripts = $site_config['scripts'];
		$this->mStylesheets = $site_config['stylesheets'];
		$this->mPageAuth = empty($site_config['page_auth']) ? array() : $site_config['page_auth'];

		// restrict pages
		$uri = empty($this->mModule) ? $this->uri->uri_string() : str_replace($this->mModule.'/', '', $this->uri->uri_string());
		if ( !empty($this->mPageAuth[$uri]) && !$this->ion_auth->in_group($this->mPageAuth[$uri]) )
		{
			$redirect_url = empty($this->mModule) ? 'error' : $this->mModule.'/error';
			redirect($redirect_url);
		}

		// multilingual setup
		$lang_config = empty($site_config['multilingual']) ? array() : $site_config['multilingual'];
		if ( !empty($lang_config) )
		{
			$this->mMultilingual = TRUE;
			$this->load->helper('language');

			// default language from config (NOT the one from CodeIgniter: application/config/config.php)
			$this->mLanguage = $this->session->has_userdata('language') ? $this->session->userdata('language') : $lang_config['default'];
			
			$this->mAvailableLanguages = $lang_config['available'];

			foreach ($lang_config['autoload'] as $file)
				$this->lang->load($file, $this->mAvailableLanguages[$this->mLanguage]['value']);
		}

		// push first entry to breadcrumb
		if ($this->mCtrler!='home')
		{
			$page = $this->mMultilingual ? lang('home') : 'Home';
			$this->push_breadcrumb($page, '');	
		}

		// get user data if logged in
		if ( $this->ion_auth->logged_in() )
		{
			$this->mUser = $this->ion_auth->user()->row();
			if ( !empty($this->mUser) )
			{
				$this->mUserGroups = $this->ion_auth->get_users_groups($this->mUser->id)->result();

				// TODO: get group with most permissions (instead of getting first group)
				$this->mUserMainGroup = $this->mUserGroups[0]->name;	
			}
		}

		$this->mSiteConfig = $site_config;
	}

	// Verify user login (regardless of user group)
	protected function verify_login($redirect_url = NULL)
	{
		if ( !$this->ion_auth->logged_in() )
		{
			if ( $redirect_url==NULL )
				$redirect_url = $this->mSiteConfig['login_url'];

			redirect($redirect_url);
		}
	}

	// Verify user authentication
	// $group parameter can be name, ID, name array, ID array, or mixed array
	// Reference: http://benedmunds.com/ion_auth/#in_group
	protected function verify_auth($group = 'members', $redirect_url = NULL)
	{
		if ( !$this->ion_auth->logged_in() || !$this->ion_auth->in_group($group) )
		{
			if ( $redirect_url==NULL )
				$redirect_url = $this->mSiteConfig['login_url'];
			
			redirect($redirect_url);
		}
	}

	// Add script files, either append or prepend to $this->mScripts array
	// ($files can be string or string array)
	protected function add_script($files, $append = TRUE, $position = 'foot')
	{
		$files = is_string($files) ? array($files) : $files;
		$position = ($position==='head' || $position==='foot') ? $position : 'foot';

		if ($append)
			$this->mScripts[$position] = array_merge($this->mScripts[$position], $files);
		else
			$this->mScripts[$position] = array_merge($files, $this->mScripts[$position]);
	}

	// Add stylesheet files, either append or prepend to $this->mStylesheets array
	// ($files can be string or string array)
	protected function add_stylesheet($files, $append = TRUE, $media = 'screen')
	{
		$files = is_string($files) ? array($files) : $files;

		if ($append)
			$this->mStylesheets[$media] = array_merge($this->mStylesheets[$media], $files);
		else
			$this->mStylesheets[$media] = array_merge($files, $this->mStylesheets[$media]);
	}

	// Render template
	protected function render($view_file, $layout = 'default')
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
		$this->mViewData['page_title'] = $this->mTitle;
		$this->mViewData['current_uri'] = empty($this->mModule) ? uri_string(): str_replace($this->mModule.'/', '', uri_string());
		$this->mViewData['meta_data'] = $this->mMetaData;
		$this->mViewData['scripts'] = $this->mScripts;
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['page_auth'] = $this->mPageAuth;

		$this->mViewData['base_url'] = empty($this->mModule) ? base_url() : base_url($this->mModule).'/';
		$this->mViewData['menu'] = $this->mMenu;
		$this->mViewData['user'] = $this->mUser;
		$this->mViewData['ga_id'] = empty($this->mSiteConfig['ga_id']) ? '' : $this->mSiteConfig['ga_id'];
		$this->mViewData['body_class'] = $this->mBodyClass;

		// automatically push current page to last record of breadcrumb
		$this->push_breadcrumb($this->mTitle);
		$this->mViewData['breadcrumb'] = $this->mBreadcrumb;

		// multilingual
		if ($this->mMultilingual)
		{
			$this->mViewData['available_languages'] = $this->mAvailableLanguages;
			$this->mViewData['language'] = $this->mLanguage;
		}

		// debug tools
		$debug_config = $this->mSiteConfig['debug'];
		if (ENVIRONMENT==='development' && !empty($debug_config))
		{
			$this->output->enable_profiler($debug_config['profiler']);

			/*
			if ($debug_config['view_data'])
				$this->output->append_output('<hr/>'.print_r($this->mViewData, TRUE));*/
		}

		$this->mViewData['inner_view'] = $view_file;
		$this->load->view('_base/head', $this->mViewData);
		$this->load->view('_layouts/'.$layout, $this->mViewData);
		$this->load->view('_base/foot', $this->mViewData);
	}

	// Output JSON string
	protected function render_json($data, $code = 200)
	{
		$this->output
			->set_status_header($code)
			->set_content_type('application/json')
			->set_output(json_encode($data));
			
		// force output immediately and interrupt other scripts
		global $OUT;
		$OUT->_display();
		exit;
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

// include base controllers
require APPPATH."core/controllers/Admin_Controller.php";
require APPPATH."core/controllers/Api_Controller.php";