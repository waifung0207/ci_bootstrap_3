<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Enhanced Form Validation library by CI Bootstrap 3
 */
class MY_Form_validation extends CI_Form_validation {

	public $CI;

	public function __construct($rules = array())
	{
		parent::__construct($rules);
		$this->CI =& get_instance();
	}
	
	/**
	 * Custom rules
	 */
	// Check if the input value already exists in the specified database field.
	public function exists($str, $field)
	{
		sscanf($field, '%[^.].%[^.]', $table, $field);
		return isset($this->CI->db)
			? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 1)
			: FALSE;
	}
}