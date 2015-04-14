<?php

class MY_Controller extends CI_Controller {

	// Scripts / stylesheets to be embedded on each page
	protected $mStylesheets = array();
	protected $mScripts = array();

	// Page title and meta data
	protected $mTitle = '';
	protected $mMetaData = array();

	// Data to pass into views
	protected $mViewData = array();

	// Constructor
	public function __construct()
	{
		parent::__construct();

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
		array_unshift($this->mScripts, 'app.min.js');

		$this->mViewData['base_url'] = site_url();
		$this->mViewData['title'] = empty($this->mTitle) ? 'My Website' : $this->mTitle;
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;
		$this->mViewData['inner_view'] = $view;

		$this->load->view('_common/head', $this->mViewData);
		$this->load->view('_layouts/'.$layout, $this->mViewData);
		$this->load->view('_common/foot', $this->mViewData);
	}
	
	// Output template for Admin Panel
	protected function _render_admin($view, $layout = 'admin', $body_class = 'skin-purple')
	{
		// prepend scripts
		array_unshift($this->mStylesheets, 'admin.min.css');
		array_unshift($this->mScripts, 'admin.min.js');

		$this->mViewData['base_url'] = site_url('admin').'/';
		$this->mViewData['title'] = empty($this->mTitle) ? 'Admin Panel' : $this->mTitle;
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;
		$this->mViewData['inner_view'] = 'admin/'.$view;
		$this->mViewData['body_class'] = $body_class;

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

	// Initialize CRUB table via Grocery CRUD library
	protected function _enable_crud($table)
	{
		// TODO: implementation
	}
}