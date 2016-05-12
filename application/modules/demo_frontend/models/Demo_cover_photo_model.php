<?php

class Demo_cover_photo_model extends MY_Model {

	protected $where = array('status' => 'active');
	protected $order_by = array('pos', 'ASC');
	protected $upload_fields = array('image_url' => UPLOAD_DEMO_COVER_PHOTO);
}