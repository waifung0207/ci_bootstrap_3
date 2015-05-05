<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Wrapper to handle generation of Grocery CRUD & Image CRUD objects
 */
class Crud {

	protected $CI;
	protected $mCrud;
	protected $mUnsetFields = array();

	public function __construct()
	{
		$this->CI =& get_instance();

		// ensure database is loaded
		if ( !$this->CI->load->is_loaded('database') )
			$this->CI->load->database();
	}

	// Initialize CRUD table via Grocery CRUD library
	// Reference: http://www.grocerycrud.com/
	public function generate_crud($table, $subject = '')
	{
		// create CRUD object
		$this->CI->load->library('Grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table($table);

		// auto-generate subject
		if ( empty($subject) )
		{
			$this->CI->load->helper('inflector');
			$crud->set_subject(humanize(singular($table)));
		}

		// load settings from: application/config/grocery_crud.php
		$this->CI->load->config('grocery_crud');
		$this->mUnsetFields = $this->CI->config->item('grocery_crud_unset_fields');

		if ($this->CI->config->item('grocery_crud_unset_jquery'))
			$crud->unset_jquery();

		if ($this->CI->config->item('grocery_crud_unset_jquery_ui'))
			$crud->unset_jquery_ui();

		if ($this->CI->config->item('grocery_crud_unset_print'))
			$crud->unset_print();

		if ($this->CI->config->item('grocery_crud_unset_export'))
			$crud->unset_export();

		if ($this->CI->config->item('grocery_crud_unset_read'))
			$crud->unset_read();

		foreach ($this->CI->config->item('grocery_crud_display_as') as $key => $value)
			$crud->display_as($key, $value);

		// other custom logic to be done outside
		$this->mCrud = $crud;
		return $crud;
	}

	// Initialize CRUD album via Image CRUD library
	// Reference: http://www.grocerycrud.com/image-crud
	public function generate_image_crud($table, $url_field, $upload_path, $order_field = 'pos', $title_field = '')
	{
		// create CRUD object
		$this->CI->load->library('Image_crud');
		$crud = new image_CRUD();
		$crud->set_table($table);
		$crud->set_url_field($url_field);
		$crud->set_image_path($upload_path);

		// [Optional] field name of image order (e.g. "pos")
		if ( !empty($order_field) )
		{
			$crud->set_ordering_field($order_field);
		}

		// [Optional] field name of image caption (e.g. "caption")
		if ( !empty($title_field) )
		{
			$crud->set_title_field($title_field);
		}

		// other custom logic to be done outside
		$this->mCrud = $crud;
		return $crud;
	}

	// Append fields to unset
	public function unset_fields($fields)
	{
		if (is_array($fields))
			$this->mUnsetFields = array_merge($this->mUnsetFields, $fields);
		else
			$this->mUnsetFields[] = $fields;
	}

	// Add Font Awesome icon with link action
	public function add_action_icon($label, $url, $icon)
	{
		if ($this->mCrud!=NULL)
			$this->mCrud->add_action($label, '', $url, 'fa fa-'.$icon);
	}

	// Confirm rendering the CRUD object
	public function render()
	{
		if ( $this->mCrud!=NULL)
		{
			$crud = $this->mCrud;
			$crud->unset_fields($this->mUnsetFields);
			return $crud->render();
		}
	}
}