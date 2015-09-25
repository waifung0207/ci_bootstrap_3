<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cover_photo extends Admin_Controller {

	// Cover Photos
	public function index()
	{
		$crud = $this->crud->generate_image_crud('cover_photos', 'image_url', UPLOAD_COVER_PHOTO);
		$this->mTitle = 'Cover Photos';
		$this->mViewData['crud_data'] = $crud->render();
		$this->render('crud');
	}
}
