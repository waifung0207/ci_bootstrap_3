<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locale extends MY_Controller {

	public function set()
	{
		// to be completed
		/*
		if ( in_array($locale, array('en', 'zh', 'cn')) )
		{
			$this->session->set_userdata('locale', $locale);
			
			$this->load->library('user_agent');
			redirect($this->agent->referrer());
		}*/

		$this->load->library('user_agent');
		redirect($this->agent->referrer());
	}
}
