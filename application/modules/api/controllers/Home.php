<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		// API Doc page only accessible during development env
		if (ENVIRONMENT=='development')
		{
			$this->mTitle = 'API Doc';
			$this->mBodyClass = 'swagger-section';
			$this->render('home', 'empty');
		}
		else
		{
			redirect();
		}
	}
}
