<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends MY_Controller {

	public function demo($id)
	{
		$this->mViewData['demo_id'] = $id;
		$this->_render('demo');
	}
}
