<?php

/**
 * Base model to enhance form validation library
 */
class MY_Form_validation extends CI_Form_validation {

	public function __construct()
	{
		parent::__construct();
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