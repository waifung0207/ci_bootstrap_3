<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	/**
	 * User Management page (e.g. CRUD operations)
	 */
	public function index()
	{
		// TODO: includes Grocery CRUD library
		$this->_render_admin('crud');
	}
}
