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
		$this->verify_auth();
		
		$main_group = $this->mUserGroups[0]->name;
		//$this->mMenu = $this->mMenu['authorized_groups'][$main_group]['menu'];
		$this->mUsefulLinks = $this->mSiteConfig['useful_links'];

		// get menu belongs to a user role
		//$this->mMenu = $this->mMenu[$this->mUserGroups[0]];
	}

	// Verify user authentication
	protected function verify_auth($redirect_url = 'admin/login')
	{
		// verify with authorized groups from: /application/modules/admin/config/site.php
		$groups = array_keys($this->mSiteConfig['authorized_groups']);

		// verify user login, otherwise redirect to Login page
		if ($this->ion_auth->logged_in() && $this->ion_auth->in_group($groups))
		{
			$this->mUser = $this->ion_auth->user()->row();
			$this->mUserGroups = $this->ion_auth->get_users_groups($this->mUser->id)->result();
		}
		else
		{
			redirect($redirect_url);
		}
	}

	// Verify if the login user belongs to target role
	// ($role can be string or string array)
	protected function verify_role($role)
	{
		if ( empty($this->mUser) )
			redirect('admin/login');

		$pass = is_array($role) ? in_array($this->mUser->role, $role) : ($this->mUser->role==$role);
		
		if (!$pass)
			redirect('admin');
	}

	// Render template (override parent)
	protected function render($view_file)
	{
		// load skin according to user role
		$config = $this->mSiteConfig['authorized_groups'][$this->mUserGroups[0]->name];
		$this->mViewData['body_class'] = $config['adminlte_skin'];

		// additional view data
		$this->mViewData['useful_links'] = $this->mUsefulLinks;

		parent::render($view_file);
	}
}