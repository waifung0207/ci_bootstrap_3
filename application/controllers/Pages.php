<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Pages extends MY_Controller {

	public function index()
	{
		$this->render('home', 'full_width');
	}
	public function home()
	{
		$this->render('pages/home', 'full_width');
	}
		public function login()
	{
		$this->render('pages/login', 'full_width');
	}
		public function new_signup()
	{
		$this->render('pages/new_signup', 'full_width');
	}
		public function forgot_password()
	{
		$this->render('pages/forgot_password', 'full_width');
	}
		public function signup()
	{
		$this->render('pages/signup', 'full_width');
	}
	public function account_info()
	{
		$this->render('pages/account_info', 'full_width');
	}
	public function test()
	{
		$this->render('pages/test', 'full_width');
	}
		public function email_varify_thanks()
	{
		$this->render('pages/email_varify_thanks', 'full_width');
	}
}
