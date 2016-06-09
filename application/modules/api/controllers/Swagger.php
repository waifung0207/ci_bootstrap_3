<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Swagger extends MY_Controller {
	
	// Output Swagger JSON
	public function index()
	{
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
