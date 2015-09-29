<?php

/**
 * Custom model based on "CodeIgniter Base Model":
 * https://github.com/jamierumbelow/codeigniter-base-model
 */

require APPPATH."core/Base_Model.php";

class MY_Model extends Base_Model {

	// Override variables from Base_Model
	public $before_get = array('callback_before_get');
	public $after_get = array('callback_after_get');

	// Variables from CI Bootstrap
	// (sample usage: see Cover_photo_model, Blog_post_model)
	protected $where = array();
	protected $order_by = array();
	protected $limit;
	protected $upload_fields = array();

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

	// Get multiple records with pagination
	public function paginate($page = 1, $where = array(), $limit = NULL)
	{
		// decide per-page limit by: 1) $this->limit; 2) a default value (10)
		if ( !empty($this->limit) && $limit===NULL )
			$limit = $this->limit;
		else if ( $limit===NULL )
			$limit = 10;

		// avoid overrided by $this->limit
		$this->limit = NULL;

		// get filtered results
		$where = array_merge($where, $this->where);
		$offset = ($page<=1) ? 0 : ($page-1)*$limit;
		$this->db->limit($limit, $offset);
		$results = parent::get_many_by($where);

		// get counts (e.g. for pagination)
		$count_results = count($results);
		$count_total = parent::count_by($where);
		$total_pages = ceil($count_total / $limit);
		$counts = array(
			'from_num'		=> ($count_results==0) ? 0 : $offset + 1,
			'to_num'		=> ($count_results==0) ? 0 : $offset + $count_results,
			'total_num'		=> $count_total,
			'curr_page'		=> $page,
			'total_pages'	=> ($count_results==0) ? 1 : $total_pages,
			'limit'			=> $limit,
		);

		return array('data' => $results, 'counts' => $counts);
	}
	
	/**
	 * Callback functions
	 */
	protected function callback_before_get($result)
	{
		// default filter
		if ( !empty($this->where) )
			$this->db->where($this->where);

		// default order
		switch (count($this->order_by))
		{
			case 1: $this->db->order_by($this->order_by[0]); break;
			case 2: $this->db->order_by($this->order_by[0], $this->order_by[1]); break;
			case 3: $this->db->order_by($this->order_by[0], $this->order_by[1], $this->order_by[2]); break;
		}

		// default limit
		if ( !empty($this->limit) )
			$this->db->limit($this->limit);
	}

	protected function callback_after_get($result)
	{
		// prepend folder path to upload assets
		if ( !empty($this->upload_fields) )
		{
			foreach ($this->upload_fields as $key => $folder)
			{
				if ( !empty($result->$key) )
				{
					$result->$key = base_url($folder.'/'.$result->$key);
				}
			}
		}

		return $result;
	}
}