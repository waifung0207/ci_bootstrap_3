<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends Admin_Controller {

	public function index()
	{
		$this->_render('home');
	}
}
