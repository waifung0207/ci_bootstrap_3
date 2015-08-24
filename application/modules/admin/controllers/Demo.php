<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends Admin_Controller {

	public function index()
	{
		redirect('demo/item/1');
	}
	
	public function item($demo_id)
	{
		$this->mTitle = 'Item '.$demo_id;
		$this->push_breadcrumb('Demo');

		$this->mViewData['demo_id'] = $demo_id;
		$this->render('demo/item');
	}
	
	public function pagination()
	{
		$this->load->library('pagination');
		$this->mViewData['pagination'] = $this->pagination->render(200, 20);
		$this->render('demo/pagination');
	}
	
	public function sortable()
	{
		$this->mTitle = 'Sortable';
		$this->push_breadcrumb('Demo');

		$this->mViewData['entries'] = array(
			'Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5'
		);
		$this->render('demo/sortable');
	}
}
