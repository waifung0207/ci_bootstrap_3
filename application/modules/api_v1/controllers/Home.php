<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends API_Controller {

	public function index()
	{
		// API Doc page only accessible during development env
		if (ENVIRONMENT=='development')
			$this->render('home');
		else
			redirect();
	}
}
