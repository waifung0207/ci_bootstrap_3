<?php

class MY_Controller extends CI_Controller {

	// Scripts / stylesheets to be embedded on each page
	protected $mStylesheets = array();
	protected $mScripts = array();

	// Page title and meta data
	protected $mTitle = '';
	protected $mMetaData = array();

	// Data to pass into views
	protected $mMenu = array();
	protected $mViewData = array();

	// Constructor
	public function __construct()
	{
		parent::__construct();

		$this->mScripts['head'] = array();		// for scripts that need to be loaded from the start
		$this->mScripts['foot'] = array();		// for scripts that can be loaded after page render

		// (optional) enable profiler
		if (ENVIRONMENT=='development')
		{
			//$this->output->enable_profiler(TRUE);
		}
	}
	
	// Output template for Frontend Website
	protected function _render($view, $layout = 'default')
	{
		// prepend scripts
		array_unshift($this->mStylesheets, 'app.min.css');
		array_unshift($this->mScripts['foot'], 'app.min.js');

		$this->mViewData['base_url'] = site_url();
		$this->mViewData['title'] = empty($this->mTitle) ? 'My Website' : $this->mTitle;
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;
		$this->mViewData['inner_view'] = $view;

		// menu items
		$this->config->load('menu');
		$menu = $this->config->item('menu');
		$this->mViewData['menu'] = $menu;

		$this->load->view('_common/head', $this->mViewData);
		$this->load->view('_layouts/'.$layout, $this->mViewData);
		$this->load->view('_common/foot', $this->mViewData);
	}
	
	// Output template for Admin Panel
	protected function _render_admin($view, $layout = 'admin', $body_class = 'skin-purple')
	{
		// prepend scripts
		array_unshift($this->mStylesheets, 'admin.min.css');
		array_unshift($this->mScripts['head'], 'admin.min.js');

		$this->mViewData['base_url'] = site_url('admin').'/';
		$this->mViewData['title'] = empty($this->mTitle) ? 'Admin Panel' : $this->mTitle;
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;
		$this->mViewData['inner_view'] = 'admin/'.$view;
		$this->mViewData['body_class'] = $body_class;

		// menu items
		$this->config->load('menu');
		$menu = $this->config->item('menu_admin');
		$this->mViewData['menu'] = $menu;

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