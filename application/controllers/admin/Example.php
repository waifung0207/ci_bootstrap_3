<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo only
 */
class Example extends Admin_Controller {

	public function index()
	{
		$this->mTitle = 'Example';
		$this->_push_breadcrumb('Examples');
		$this->_render('demo');
	}

	public function demo($demo_id)
	{
		$this->mViewData['demo_id'] = $demo_id;

		$this->mTitle = 'Example '.$demo_id;
		$this->_push_breadcrumb('Example', 'example');
		$this->_push_breadcrumb('Example '.$demo_id);
		$this->_render('demo');
	}
}
