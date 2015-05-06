<?php

/**
 * Base model to work with features of:
 * 	- CRUD (create, read, update, delete)
 * 	- Pagination when getting records
 * 	- Check if an record exists
 * 	- Increment / decrement single field
 */
class MY_Model extends CI_Model {

	protected $mTable;
	protected $mTableAlias = '';
	protected $mPrimaryKey = 'id';

	// default values
	protected $mLimit = 20;
	protected $mOrderBy = array('id', 'ASC', NULL);

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * READ operations (Note: logic of SELECT fields can be used BEFORE calling these functions)
	 */
	// Get single record (by params)
	public function get_by($where, $joins = array())
	{
		$table = $this->_get_table_name(TRUE);
		$this->_join_tables($joins);
		$this->db->order_by($this->mOrderBy[0], $this->mOrderBy[1]);
		return $this->db->get_where($table, $where, 1)->row();
	}

	// Get single record (by ID)
	public function get_by_id($id, $joins = array())
	{
		$primary_key = empty($this->mTableAlias) ? $this->_get_table_name().'.'.$this->mPrimaryKey : $this->mTableAlias.'.'.$this->mPrimaryKey;
		$this->_join_tables($joins);
		$where = array($primary_key => $id);
		return $this->get_by($where);
	}

	// Get a field value from single record (by ID)
	public function get_field($id, $field)
	{
		$this->db->select($field);
		$record = $this->get_by_id($id);
		return (empty($record) || empty($record->$field)) ? NULL : $record->$field;
	}

	// Get a field value from single record (by params)
	public function get_field_by($where, $field)
	{
		$this->db->select($field);
		$this->db->order_by($this->mOrderBy[0], $this->mOrderBy[1], $this->mOrderBy[2]);
		$record = $this->get_by($where);
		return (empty($record) || empty($record->$field)) ? NULL : $record->$field;
	}

	// Get all records (no filtering)
	public function get_all($page = 1)
	{
		return $this->get_many_by(array(), $page);
	}

	// Get multiple records (filtered by params)
	public function get_many_by($where, $page = 1, $joins = array(), $with_count = FALSE)
	{
		$table = $this->_get_table_name(TRUE);
		$limit = $this->mLimit;
		$offset = ($page<=1) ? 0 : ($page-1)*$limit;

		$this->db->from($table);
		$this->_join_tables($joins);
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by($this->mOrderBy[0], $this->mOrderBy[1], $this->mOrderBy[2]);
		$records = $this->db->get()->result();

		if (!$with_count)
		{
			return $records;
		}
		else
		{
			$this->db->from($table);
			$this->db->where($where);
			$this->_join_tables($joins);
			$count_total = $this->db->count_all_results();
			
			$count_records = count($records);
			$total_pages = ceil($count_total / $limit);

			if ($count_records==0)
			{
				return array(
					'data'			=> array(),
					'total_count'	=> $count_total,
					'total_pages'	=> $total_pages,
				);
			}

			return array(
				'data'			=> $records,																// result data
				'from_num'		=> $count_records==0 ? 0 : $offset+1,										// starting record num
				'to_num'		=> ($count_records<$limit) ? $offset+$count_records : $offset+$limit,		// ending record num
				'total_count'	=> $count_total,															// total count from db
				'curr_page'		=> $page,																	// current page number
				'total_pages'	=> $total_pages,															// total page count
			);
		}
	}

	/**
	 * CREATE operations
	 */
	public function create($data)
	{
		$table = $this->_get_table_name();
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	public function create_many($data)
	{
		$table = $this->_get_table_name();
		return $this->db->insert_batch($table, $data);
	}

	/**
	 * UPDATE operations
	 */
	public function update($id, $data)
	{
		$table = $this->_get_table_name();
		$this->db->where($this->mPrimaryKey, $id);
		return $this->db->update($table, $data);
	}
	public function update_many($data, $where_key)
	{
		$table = $this->_get_table_name();
		return $this->db->update_batch($table, $data, $where_key);
	}
	public function update_field($id, $field, $value, $escape = TRUE)
	{
		$table = $this->_get_table_name();
		$this->db->set($field, $value, $escape);
		$this->db->where($this->mPrimaryKey, $id);
		return $this->db->update($table);
	}
	public function increment_field($id, $field, $diff = 1)
	{
		return $this->update_field($id, $field, $field.'+'.$diff, FALSE);
	}
	public function decrement_field($id, $field, $diff = 1)
	{
		return $this->update_field($id, $field, $field.'-'.$diff, FALSE);
	}

	/**
	 * DELETE operations
	 */
	public function delete($id)
	{
		$where = array($this->mPrimaryKey => $id);
		return $this->db->delete_by($where);
	}
	public function delete_by($where)
	{
		$table = $this->_get_table_name();
		return $this->db->delete($table, $where);
	}

	/**
	 * Count functions
	 */
	public function count_all()
	{
		$table = $this->_get_table_name();
		return $this->db->count_all($table);
	}
	public function count_by($where)
	{
		$table = $this->_get_table_name();
		$this->db->where($where);
		return $this->db->count_all_results($table);
	}

	/**
	 * Setter functions
	 */
	public function set_table_alias($alias)
	{
		// update table alias (e.g. "u") so the query will execute like "SELECT * FROM users AS u"
		$this->mTableAlias = $alias;
	}
	public function set_limit($limit)
	{
		// affect maximum number of records for Read operations
		$this->mLimit = $limit;
	}
	public function set_order_by($order_by, $direction = 'ASC', $escape = NULL)
	{
		if (strtoupper($order_by)==='RANDOM')
		{
			$order_by = 'id';
			$direction = 'RANDOM';
			$escape = NULL;
		}
		$this->mOrderBy = array($order_by, $direction, $escape);
	}

	/**
	 * Other utility functions
	 */
	// Check record exists
	public function exists($params)
	{
		if (is_array($params))
			$this->db->where($params);
		else
			$this->db->where($this->mPrimaryKey, $params);

		$table = $this->_get_table_name();
		return $this->db->count_all_results($table)==1;
	}

	/**
	 * Private functions
	 */
	private function _get_table_name($with_alias = FALSE)
	{
		if ($this->mTable===NULL)
		{
			// automatically get table name (e.g. User_model => users)
			$this->load->helper('inflector');
			$class = strtolower(get_class($this));
			$name = plural(str_replace('_model', '', $class));
		}
		else
		{
			$name = $this->mTable;
		}

		// (optional) append table alias
		return (empty($this->mTableAlias) || !$with_alias) ? $name : $name.' AS '.$this->mTableAlias;
	}

	// work with multiple joins
	private function _join_tables($joins)
	{
		if ( empty($joins) )
			return;

		foreach ($joins as $join)
		{
			$count_params = count($join);
			if ($count_params==2)
				$this->db->join($join[0], $join[1]);
			else if ($count_params==3)
				$this->db->join($join[0], $join[1], $join[2]);
			else if ($count_params==4)
				$this->db->join($join[0], $join[1], $join[2], $join[3]);
		}
	}
}