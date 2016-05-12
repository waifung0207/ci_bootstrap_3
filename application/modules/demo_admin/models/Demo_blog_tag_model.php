<?php 

class Demo_blog_tag_model extends MY_Model {

	public function get_by_post_id($post_id)
	{
		$this->db->select($this->_table.'.*');
		$this->db->join('demo_blog_posts_tags', $this->_table.'.id = demo_blog_posts_tags.tag_id', 'RIGHT');
		$this->db->where('demo_blog_posts_tags.post_id', $post_id);
		$query = $this->db->get($this->_table);
		return $query->result();
	}
}