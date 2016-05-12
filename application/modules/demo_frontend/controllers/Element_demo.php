<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo purpose only
 */
class Element_demo extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->render('home');
	}

	public function item($demo_id)
	{
		$this->mViewData['demo_id'] = $demo_id;
		$this->render('element/item');
	}
	
	// Bootstrap Carousel
	public function carousel()
	{
		// grab records from database table "cover_photos"
		$this->load->model('demo_cover_photo_model', 'photos');
		$this->mViewData['photos'] = $this->photos->get_all();
		$this->render('element/carousel');
	}

	public function pagination()
	{
		// library from: application/libraries/MY_Pagination.php
		// config from: application/config/pagination.php
		$this->load->library('pagination');
		$this->mViewData['pagination'] = $this->pagination->render(200, 20);
		$this->render('element/pagination');
	}
}
