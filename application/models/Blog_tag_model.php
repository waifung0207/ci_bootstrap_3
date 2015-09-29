<?php 

class Blog_tag_model extends MY_Model {

	public function get_by_post_id($post_id)
	{
		$this->db->select($this->_table.'.*');
		$this->db->join('blog_post_tag_rel', $this->_table.'.id = blog_post_tag_rel.tag_id', 'RIGHT');
		$this->db->where('blog_post_tag_rel.post_id', $post_id);
		$query = $this->db->get($this->_table);
		return $query->result();
	}
}