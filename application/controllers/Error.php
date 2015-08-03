<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Override 404 error
 */
class Error extends MY_Controller {

	public function index()
	{
		$this->output->set_status_header('404');
		$this->mTitle = '404 Error Page';
		$this->render('errors/custom/error_404');
	}
}