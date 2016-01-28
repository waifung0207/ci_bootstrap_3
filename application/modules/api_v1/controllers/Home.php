<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends API_Controller {

	public function index()
	{
		// API Doc page only accessible during development env
		if (ENVIRONMENT=='development')
		{
			$this->mBodyClass = 'swagger-section';
			$this->render('home', 'empty');
		}
		else
		{
			redirect();
		}
	}
}
