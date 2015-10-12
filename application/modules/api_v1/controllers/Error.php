<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Override 404 error
 */
class Error extends Api_Controller {

	public function index()
	{
		$this->to_error_not_found();
	}
}