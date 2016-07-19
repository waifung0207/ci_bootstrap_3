<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends Admin_Controller {

	public function index()
	{
		$crud = $this->generate_crud('config');
		$this->mPageTitle = 'App Config';
		$this->render_crud();
	}
}