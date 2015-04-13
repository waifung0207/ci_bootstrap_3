<?php

class MY_Controller extends CI_Controller {

	protected $mStylesheets = array();
	protected $mScripts = array();

	protected $mViewData = array();

	// constructor
	public function __construct()
	{
		parent::__construct();

		// (optional) enable profiler
		if (ENVIRONMENT=='development')
		{
			//$this->output->enable_profiler(TRUE);
		}
	}
	
	// output template
	protected function _render($view)
	{
		$this->mStylesheets[] = 'app.min.css';
		$this->mScripts[] = 'app.min.js';

		$this->mViewData['title'] = 'My Website';
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;
		
		$this->load->view('header', $this->mViewData);
		$this->load->view('menu', $this->mViewData);
		$this->load->view($view, $this->mViewData);
		$this->load->view('footer', $this->mViewData);
	}
	
	// output template
	protected function _render_admin($view)
	{
		$this->mStylesheets[] = 'admin.min.css';
		$this->mScripts[] = 'admin.min.js';

		$this->mViewData['title'] = 'Admin Panel';
		$this->mViewData['stylesheets'] = $this->mStylesheets;
		$this->mViewData['scripts'] = $this->mScripts;

		$this->load->view('header', $this->mViewData);
		$this->load->view('admin/menu', $this->mViewData);
		$this->load->view('admin/'.$view, $this->mViewData);
		$this->load->view('footer', $this->mViewData);
	}
	
	// output JSON string
	protected function _render_json($data)
	{
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));
	}
}