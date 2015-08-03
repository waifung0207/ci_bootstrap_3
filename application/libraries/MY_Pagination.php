<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Overriding CodeIgniter library
 */
class MY_Pagination extends CI_Pagination {

	public function __construct($params = array())
	{
		parent::__construct($params);
	}

	public function render($total_rows, $per_page = 20, $base_url = NULL)
	{
		$config['base_url'] = $base_url ? $base_url : current_url();
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$this->initialize($config);
		return $this->create_links();
	}
}