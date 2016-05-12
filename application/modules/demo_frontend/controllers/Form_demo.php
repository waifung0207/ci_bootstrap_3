<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * For demo purpose only
 */
class Form_demo extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->push_breadcrumb('Forms');
	}

	// Form without Bootstrap theme
	// See views/demo/form_basic.php for sample code
	public function basic()
	{
		// library from: application/libraries/Form_builder.php
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			$this->system_message->set_success('Success!');
			refresh();
		}

		// require reCAPTCHA script at page head
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';

		$this->mTitle = 'Form (Basic)';
		$this->mViewData['form'] = $form;
		$this->render('form/basic');
	}
	
	public function bs3()
	{
		// library from: application/libraries/Form_builder.php
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			$this->system_message->set_success('Success!');
			refresh();
		}

		// require reCAPTCHA script at page head
		$this->mScripts['head'][] = 'https://www.google.com/recaptcha/api.js';
		
		$this->mTitle = 'Form (Bootstrap 3)';
		$this->mViewData['form'] = $form;
		$this->render('form/bs3');
	}
}
