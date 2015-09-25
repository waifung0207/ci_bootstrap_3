<?php

class Cover_photo_model extends MY_Model {

	protected $where = array('status' => 'active');
	protected $order_by = array('pos', 'ASC');
	protected $limit = 5;
	protected $upload_fields = array('image_url' => UPLOAD_COVER_PHOTO);
}