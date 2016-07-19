<?php 

class Tutorial_model extends MY_Model {

	protected $upload_fields = array(
		'thumbnail_url'		=> UPLOAD_TUTORIAL,
		'file_url'			=> UPLOAD_TUTORIAL
	);

	public function get_by_list_id($list_id)
	{
		$this->db->select($this->_table.'.*');
		$this->db->join('tutorials_lists', $this->_table.'.id = tutorials_lists.tutorial_id', 'RIGHT');
		$this->db->where('tutorials_lists.list_id', $list_id);
		return parent::get_all();
	}
}