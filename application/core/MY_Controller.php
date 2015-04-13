<?php

class MY_Controller extends CI_Controller {

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
	public function _render($view)
	{
		$this->mViewData['title'] = 'My Website';
		
		$this->load->view('header', $this->mViewData);
		$this->load->view('menu', $this->mViewData);
		$this->load->view($view, $this->mViewData);
		$this->load->view('footer', $this->mViewData);
	}

	// output JSON string
	public function _render_json()
	{
	}
}