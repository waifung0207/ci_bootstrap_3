<?php

/**
 * Base Controller for Admin module
 */
class Admin_Controller extends MY_Controller {

	protected $mUsefulLinks = array();

	// Constructor
	public function __construct()
	{
		parent::__construct();

		// only authorized user groups can access Admin Panel
		$groups = array_keys($this->mSiteConfig['authorized_groups']);
		$this->verify_auth($groups, 'admin/login');
		
		$this->mUsefulLinks = $this->mSiteConfig['useful_links'];
	}

	// Render template (override parent)
	protected function render($view_file)
	{
		// load skin according to user role
		$config = $this->mSiteConfig['authorized_groups'][$this->mUserMainGroup];
		$this->mViewData['body_class'] = $config['adminlte_skin'];

		// additional view data
		$this->mViewData['useful_links'] = $this->mUsefulLinks;

		parent::render($view_file);
	}
}