<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()
	{
		$this->load->model('user_model', 'users');
		$this->load->model('admin_user_model', 'admin_users');
		$this->mViewData['count'] = array(
			'users'				=> $this->users->count_all(),
			'admin_users'		=> $this->admin_users->count_all(),
		);
		$this->render('home');
	}
}
