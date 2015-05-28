<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends MY_Controller {

	public function index()
	{
		$this->render('demo');
	}
	
	public function demo($demo_id)
	{
		$this->mTitle = 'Example '.$demo_id;
		$this->push_breadcrumb('Examples');

		$this->mViewData['demo_id'] = $demo_id;
		$this->render('demo');
	}
}
