<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller {

	// Override 404 error
	// Match with $route['404_override'] value from /application/config/routes.php
	public function page_missing()
	{
		$this->output->set_status_header('404');
		$this->mTitle = '404 Page Not Found';
		$this->render('errors/custom/error_404');
	}
}