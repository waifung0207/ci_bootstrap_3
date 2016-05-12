<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo purpose only
 */
class Home extends MY_Controller {

	public function index()
	{
		$this->render('home');
	}
}
