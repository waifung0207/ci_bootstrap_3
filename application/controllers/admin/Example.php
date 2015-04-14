<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends MY_Controller {

	public function demo($demo_id)
	{
		$this->mViewData['demo_id'] = $demo_id;
		$this->_render_admin('demo');
	}
}
