<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Overriding CodeIgniter email library
 */
class MY_Email extends CI_Email {

	public function __construct($config = array())
	{
		parent::__construct($config);
	}
}