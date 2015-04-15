<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends MY_Controller {

	public function index()
	{
		$this->_push_breadcrumb('Examples');
		$this->_render('demo');
	}

	public function demo($demo_id)
	{
		$this->mViewData['demo_id'] = $demo_id;
		
		$this->_push_breadcrumb('Examples', 'example');
		$this->_push_breadcrumb('Example '.$demo_id);
		$this->_render('demo');
	}
}
