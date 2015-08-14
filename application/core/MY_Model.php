<?php

/**
 * Custom model based on "CodeIgniter Base Model":
 * https://github.com/jamierumbelow/codeigniter-base-model
 */

require APPPATH."core/Base_Model.php";

class MY_Model extends Base_Model {

	/**
	 * Extra functions on top of Base_Model
	 */	
	// Get a field value from single result (by ID)
	public function get_field($id, $field)
	{
		$this->db->select($field);
		$record = $this->get($id);
		return (empty($record) || empty($record->$field)) ? NULL : $record->$field;
	}

	// update a field value
	public function update_field($id, $field, $value, $escape = TRUE)
	{
		// note: use CodeIgniter Query Builder instead of Base_model update() function, which does not allow escape set as FALSE
		$this->db->set($field, $value, $escape);
		$this->db->where($this->primary_key, $id);
		return $this->db->update($this->_table);
	}

	// increment a field value
	public function increment_field($id, $field, $diff = 1)
	{
		return $this->update_field($id, $field, $field.'+'.$diff, FALSE);
	}

	// decrement a field value
	public function decrement_field($id, $field, $diff = 1)
	{
		return $this->update_field($id, $field, $field.'-'.$diff, FALSE);
	}

	// Get multiple records with pagination (to be completed)
	public function get_many_with_pagination($where, $page = 1, $limit = 20)
	{
		$offset = ($page<=1) ? 0 : ($page-1)*$limit;
		$this->db->limit($limit, $offset);
		$results = $this->get_many_by($where);

		return array(
			'data'			=> $results,
			'pagination'	=> array(
				'from_num'		=> 0,
				'to_num'		=> 0,
				'total_count'	=> count($results),
				'curr_page'		=> $page,
				'total_pages'	=> count($results),
			)
		);
	}
}