<?php

/**
 * Base Controller for Admin module
 */
class Admin_Controller extends MY_Controller {

	protected $mLoginUrl = 'admin/login';
	protected $mUsefulLinks = array();

	// Constructor
	public function __construct()
	{
		parent::__construct();

		// only login users can access Admin Panel
		$this->verify_login();

		// store site config values
		$this->mUsefulLinks = $this->mSiteConfig['useful_links'];
	}

	// Render template (override parent)
	protected function render($view_file)
	{
		// load skin according to user role
		$config = $this->mSiteConfig['adminlte'][$this->mUserMainGroup];
		$this->mViewData['body_class'] = $config['skin'];

		// additional view data
		$this->mViewData['useful_links'] = $this->mUsefulLinks;

		parent::render($view_file);
	}
}