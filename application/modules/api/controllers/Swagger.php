<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Swagger extends MY_Controller {
	
	// Output Swagger JSON
	public function index()
	{
		// Define constants according to server environment
		// Reference: https://github.com/zircote/swagger-php/blob/master/docs/Getting-started.md#using-variables-in-annotations
		switch (ENVIRONMENT)
		{
			case 'development':
				define('API_HOST', $this->input->server('HTTP_HOST').'/ci_bootstrap_3');
				break;
			case 'testing':
			case 'production':
			default:
				define('API_HOST', '');
				break;
		}
		
		// folders which include files with Swagger annotations
		$module_dir = APPPATH.'modules/'.$this->mModule;
		$paths = array(
			$module_dir.'/swagger',
			$module_dir.'/controllers',
		);
		$swagger = \Swagger\scan($paths);

		// output JSON
		header('Content-Type: application/json');		
		echo $swagger;
	}
}
