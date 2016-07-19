<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorial extends Admin_Controller {

	// Tutorials
	public function index()
	{
		$crud = $this->generate_crud('tutorials');

		$crud->set_field_upload('thumbnail_url', UPLOAD_TUTORIAL);
		$crud->set_field_upload('file_url', UPLOAD_TUTORIAL);
		$crud->field_type('file_size', 'readonly');

		$this->mPageTitle = 'Tutorials';
		$this->render_crud();
	}

	// Tutorial Lists
	public function lists()
	{
		$crud = $this->generate_crud('tutorial_lists');
		$crud->set_relation_n_n('Tutorials', 'tutorials_lists', 'tutorials', 'list_id', 'tutorial_id', '{name}');

		$this->mPageTitle = 'Tutorial Lists';
		$this->render_crud();
	}
}