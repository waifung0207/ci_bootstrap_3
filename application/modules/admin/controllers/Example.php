<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends Admin_Controller {

	public function index()
	{
		$this->render('demo');
	}
	
	public function demo($demo_id)
	{
		$this->mTitle = 'Example '.$demo_id;
		$this->push_breadcrumb('Examples');

		$this->mViewData['demo_id'] = $demo_id;
		$this->render('demo/dummy');
	}
	
	public function sortable()
	{
		$this->mTitle = 'Sortable Demo';
		$this->push_breadcrumb('Examples');

		$this->mViewData['entries'] = array(
			'Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5'
		);
		$this->render('demo/sortable');
	}
}
